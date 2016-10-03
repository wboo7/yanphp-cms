;
(function () {

    if ($.browser.msie) {
        //ie 都不缓存
        $.ajaxSetup({
            cache: false
        });
    }

    if ($('.J_dialog').length) {
        Yan.use('dialog', function () {
            $('.J_dialog').on('click',function (e) {
                e.preventDefault();
                var _this = $(this);

                Yan.dialog.open($(this).attr('href'), {
                    onClose: function () {
                        _this.focus();//关闭时让触发弹窗的元素获取焦点
                    },
                    title: _this.attr('title')
                });
            });

        });
    }

    //所有的ajax form提交,由于大多业务逻辑都是一样的，故统一处理
    var ajaxForm_list = $('form.J_ajaxForm');
    if (ajaxForm_list.length) {
        Yan.use('dialog', 'ajaxForm', function () {

            if ($.browser.msie) {
                //ie8及以下，表单中只有一个可见的input:text时，会整个页面会跳转提交
                ajaxForm_list.on('submit', function (e) {
                    //表单中只有一个可见的input:text时，enter提交无效
                    e.preventDefault();
                });
            }

            $('button.J_ajax_submit_btn').on('click', function (e) {
                e.preventDefault();

                var btn = $(this),
                    form = btn.parents('form.J_ajaxForm');

                //批量操作 判断选项
                if (btn.data('subcheck')) {
                    btn.parent().find('span').remove();
                    if (form.find('input.J_check:checked').length) {
                        var msg = btn.data('msg');
                        if (msg) {
                            Yan.dialog({
                                type: 'confirm',
                                isMask: false,
                                message: btn.data('msg'),
                                follow: btn,
                                onOk: function () {
                                    btn.data('subcheck', false);
                                    btn.click();
                                }
                            });
                        } else {
                            btn.data('subcheck', false);
                            btn.click();
                        }

                    } else {
                        $('<span class="tips_error">请至少选择一项</span>').appendTo(btn.parent()).fadeIn('fast');
                    }
                    return false;
                }

                //ie处理placeholder提交问题
                if ($.browser.msie) {
                    form.find('[placeholder]').each(function () {
                        var input = $(this);
                        if (input.val() == input.attr('placeholder')) {
                            input.val('');
                        }
                    });
                }

                form.ajaxSubmit({
                    url: btn.data('action') ? btn.data('action') : form.attr('action'),	//按钮上是否自定义提交地址(多按钮情况)
                    dataType: 'json',
                    beforeSubmit: function (arr, $form, options) {
                        var text = btn.text();


                        btn.text(text + '中...').attr('disabled', true).addClass('disabled');
                    },
                    success: function (data, statusText, xhr, $form) {
                        var text = btn.text();

                        btn.removeClass('disabled').text(text.replace('中...', '')).parent().find('span').remove();

                        if (data.state === 'success') {
                            $('<span class="tips_success">' + data.message + '</span>').appendTo(btn.parent()).fadeIn('slow').delay(1000).fadeOut(function () {
                                if (data.referer) {
                                    //返回带跳转地址
                                    if (window.parent.Yan.dialog) {
                                        //iframe弹出页
                                        window.parent.location.href = decodeURIComponent(data.referer);
                                    } else {
                                        window.location.href = decodeURIComponent(data.referer);
                                    }
                                } else {
                                    if (window.parent.Yan.dialog) {
                                        reloadPage(window.parent);
                                    } else {
                                        reloadPage(window);
                                    }
                                }
                            });
                        } else if (data.state === 'fail')
                        {
                            $('<span class="tips_error">' + data.message + '</span>').appendTo(btn.parent()).fadeIn('fast');
                            btn.removeAttr('disabled').removeClass('disabled');
                        }
                    }
                });
            });

        });
    }

    if ($('a.J_ajaxDelete').length) {
        Yan.use('dialog', function () {

            $('.J_ajaxDelete').on('click', function (e) {
                e.preventDefault();
                var $this = $(this), href = $this.prop('href'), msg = $this.data('msg');

                var params = {
                    message: msg ? msg : '确定要删除吗？',
                    type: 'confirm',
                    isMask: false,
                    follow: $(this),//跟随触发事件的元素显示
                    onOk: function () {
                        $.ajax({
                            url: href,
                            type: 'get',
                            dataType: 'json',

                            success: function (data) {
                                if (data.state === 'success') {
                                    if (data.referer) {
                                        location.href = decodeURIComponent(data.referer);
                                    } else {
                                        reloadPage(window);
                                    }
                                } else if (data.state === 'fail') {
                                    Yan.dialog.alert(data.message);
                                }
                            }
                        });
                    }
                };
                Yan.dialog(params);
            });

        });
    }

    if ($('a.J_ajax').length) {
        Yan.use('dialog', function () {

            $('.J_ajax').on('click', function (e) {
                e.preventDefault();
                var $this = $(this), href = $this.prop('href'), msg = $this.data('msg');

                var params = {
                    message: msg ? msg : '确定执行此操作吗？',
                    type: 'confirm',
                    isMask: false,
                    follow: $(this),//跟随触发事件的元素显示
                    onOk: function () {
                        $.ajax({
                            url: href,
                            type: 'get',
                            dataType: 'json',

                            success: function (data) {
                                if (data.state === 'success') {
                                    if (data.referer) {
                                        location.href = decodeURIComponent(data.referer);
                                    } else {
                                        reloadPage(window);
                                    }
                                } else if (data.state === 'fail') {
                                    Yan.dialog.alert(data.message);
                                }
                                else if(data.state === 'download')
                                {
                                   // window.location.target="_blank" ;
                                    //window.location.href ='?r=programe/download&url='+data.message;
                                   // window.location.href ='http://www.baidu.com';
                                    window.open('/index.php/member/programe/download?url='+data.message)
                                }
                            }
                        });
                    }
                };
                Yan.dialog(params);
            });

        });
    }

    //日期选择器
    var dateInput = $("input.J_date")
    if (dateInput.length) {
        Yan.use('datePicker', function () {
            dateInput.datePicker();
        });
    }

    //日期+时间选择器
    var dateTimeInput = $("input.J_datetime");
    if (dateTimeInput.length) {
        Yan.use('datePicker', function () {
            dateTimeInput.datePicker({time: true});
        });
    }

    //重新刷新页面，使用location.reload()有可能导致重新提交
    function reloadPage(win) {
        var location = win.location;
        location.href = location.pathname + location.search;
    }




})();

