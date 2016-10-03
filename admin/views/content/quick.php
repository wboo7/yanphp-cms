<style type="text/css">
    <!--
    .showMsg {
        background: #fff;
        border: 1px solid #1e64c8;
        zoom: 1;
        width: 450px;
        height: 172px;
    }

    .showMsg h5 {
        margin-top: 0;
        background-image: url(<?=Yii::getAlias('@web/statics/admin/images/msg.png')?>);
        background-repeat: no-repeat;
        color: #fff;
        padding-left: 35px;
        height: 25px;
        line-height: 26px;
        *line-height: 28px;
        overflow: hidden;
        font-size: 14px;
        text-align: left
    }

    .showMsg .content {
        margin-top: 50px;
        font-size: 14px;
        height: 64px;
        position: relative
    }

    #search_div {
        position: absolute;
        top: 23px;
        border: 1px solid #dfdfdf;
        text-align: left;
        padding: 1px;
        left: 89px;
        *left: 88px;
        width: 263px;
        *width: 260px;
        background-color: #FFF;
        display: none;
        font-size: 12px
    }

    #search_div li {
        line-height: 24px;
    }

    #search_div li a {
        padding-left: 6px;
        display: block
    }

    #search_div li a:hover {
        background-color: #e2eaff
    }

    -->
</style>
<div class="showMsg" style="text-align:center;margin-top:200px;margin-left:auto;margin-right: auto;">
    <h5><?php echo '快速进入'; ?></h5>

    <div class="content">
        <input type="text" size="41" placeholder="请输入栏目名称（非单页）" class="form-control search-input" style="width: 300px;margin: auto;">

        <ul id="search_div"></ul>
    </div>
</div>

<!--<script>-->
<!--    var timer = null;-->
<!--    $('.search-input').keyup(function () {-->
<!--        $('#search_div').html('').hide();-->
<!--        var keywords = $.trim($(this).val());-->
<!--        if (keywords == '') return;-->
<!--        clearTimeout(timer);-->
<!--        timer = setTimeout(function () {-->
<!--            $.ajax({-->
<!--                url: '?r=content/category-search&q=' + encodeURI(keywords),-->
<!--                dataType: 'json',-->
<!--                type: 'get',-->
<!--                success: function (c) {-->
<!--                    if(c.state>0)-->
<!--                        return;-->
<!--                    var data = c.data;-->
<!---->
<!--                    var li = '';-->
<!--                    for (var i = 0; i < data.length; i++) {-->
<!--                        li += '<li><a href="?r=content/lists&catid=' + data[i].id + '">' + data[i].catname + '</a></li>';-->
<!--                    }-->
<!---->
<!--                    $('#search_div').html(li).show();-->
<!---->
<!--                }-->
<!---->
<!--            });-->
<!---->
<!--        }, 300);-->
<!--    });-->
<!--    $(document).click(function(){-->
<!--        $('#search_div').html('').hide();-->
<!--    });-->
<!--</script>-->
