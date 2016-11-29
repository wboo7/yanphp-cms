/*
 * @Descript: 后台全局功能js（在footer.htm模板引用）
 */
;
(function (win) {
    //全局ajax处理
    $.ajaxSetup({
        complete: function (jqXHR) {
            //登录失效处理
            if (jqXHR.responseText.state === 'logout') {
                location.href = GV.URL.LOGIN;
            }
        },

        error: function (jqXHR, textStatus, errorThrown) {
            //请求失败处理
            alert(errorThrown ? errorThrown : '操作失败');
        }
    });


    //不支持placeholder浏览器下对placeholder进行处理
    if (document.createElement('input').placeholder !== '') {
        $('[placeholder]').focus(function () {
            var input = $(this);
            if (input.val() == input.attr('placeholder')) {
                input.val('');
                input.removeClass('placeholder');
            }
        }).blur(function () {
            var input = $(this);
            if (input.val() == '' || input.val() == input.attr('placeholder')) {
                input.addClass('placeholder');
                input.val(input.attr('placeholder'));
            }
        }).blur().parents('form').submit(function () {
            $(this).find('[placeholder]').each(function () {
                var input = $(this);
                if (input.val() == input.attr('placeholder')) {
                    input.val('');
                }
            });
        });
    }


    //批量提交
    if ($('.J_ajax_submit').length) {
        Yan.use('dialog', function () {

            $('.J_ajax_submit').on('click', function (e) {
                e.preventDefault();
                var $this = $(this),
                    msg = $this.attr('data-msg');


                var params = {
                    message: msg ? msg : '确定要删除吗？',
                    type: 'confirm',
                    isMask: false,
                    follow: $(this),//跟随触发事件的元素显示
                    onOk: function () {
                        $('form.J_ajaxForm').ajaxSubmit({
                            dataType: 'json',

                            success: function (data, statusText, xhr, $form) {
                                if (data.state === 'success') {
                                    var location = window.location;
                                    location.href = location.pathname + location.search;
                                } else {
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

    //拾色器
    var color_pick = $('.J_color_pick');
    if (color_pick.length) {
        Yan.use('colorPicker', function () {
            color_pick.each(function () {
                $(this).colorPicker({
                    //	default_color : 'url("'+ GV.URL.IMAGE_RES +'/transparent.png")',		//写死
                    callback: function (color) {
                        var id = $(this).attr('data-id'),

                            input = $(this).next('.J_hidden_color');

                        $('#' + id).css('color', color);
                        input.val(color.length === 7 ? color : '');
                    }
                });
            });
        });
    }



    //日期选择器
    //var dateInput = $("input.Y_date")
    //if (dateInput.length) {
    //    Yan.css('datetimepicker');
    //    Yan.use('datetimepicker', 'datetimepickerzhcn',function () {
    //        dateInput.datetimepicker({
    //            //language:  'fr',
    //            format:'yyyy/mm/dd hh:i:s',
    //            weekStart: 1,
    //            todayBtn:  1,
    //            autoclose: 1,
    //            todayHighlight: 1,
    //            startView: 2,
    //            forceParse: 0,
    //            showMeridian: 1
    //        });
    //
    //    });
    //}

    //日期+时间选择器
    var dateTimeInput = $("input.J_datetime");
    if (dateTimeInput.length) {
        Yan.use('datePicker', function () {
            dateTimeInput.datePicker({time: true});
        });
    }

    //代码复制
    var copy_btn = $('a.J_copy_clipboard'); //复制按钮
    if (copy_btn.length) {
        Yan.use('dialog', 'textCopy', function () {
            for (i = 0, len = copy_btn.length; i < len; i++) {
                var item = $(copy_btn[i]);
                item.textCopy({
                    content: $('#' + item.data('rel')).val()
                });
            }
        });
    }

    //.全选反选
    if($('.check-all').length)
    {
        $('.check-all').each(function(){
            var that =this;
            var $this = $(this);
            var $item = $('.'+$this.data('item-class'));
            $this.click(function(){
                $item.attr("checked",that.checked);
            })
        });

        $('.check-all').click(function(){
            var $item = $('.'+$(this).data('item-class'));
            $item.prop("checked",this.checked);
        });
    }



})(window);



function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1, c.length);
        }
        if (c.indexOf(nameEQ) == 0) {
            return c.substring(nameEQ.length, c.length);
        }
    }
    ;
    return null;
}

function setCookie(name, value, days, domain) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
        var expires = '; expires=' + date.toGMTString();
    } else {
        var expires = '';
    }
    document.cookie = name + "=" + value + expires + "; domain=" + domain + "; path=/";
}
