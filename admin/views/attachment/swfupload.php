<?php
use common\libs\Yanphp;
use yii\helpers\Html;

use yii\helpers\ArrayHelper;

?>

<link rel="stylesheet" href="statics/plugin/swfupload/swfupload.css"/>
<script src="statics/plugin/swfupload/unpack_swfupload.js"></script>
<script src="statics/plugin/swfupload/fileprogress.js"></script>
<script src="statics/plugin/swfupload/handlers_attachment.js"></script>

<style>
    #startUpload {
        cursor: pointer;
        margin-top: 1px;
        margin-left: 5px;
        float: left;
        width: 75px;
        height: 28px;
        background: url("<?= Yii::getAlias('@web/')?>statics/plugin/swfupload/images/swfUpload.png");
    }

    #button-control {
        height: 28px;
        line-height: 28px;
        float: left;
    }

    .swfupload {
        vertical-align: middle;
    }

    .upload-main {
        padding: 10px 15px;
        height: 350px;
    }

    .tab-content {
        background: white;
    }

    /*#fsUploadProgress{padding:10px;border:1px solid #ddd;margin-top: 5px;}*/
    fieldset {
        padding: 0;
        margin: 0;
        border: 0;
        min-width: 0
    }

    legend {
        width: 50px;
        font-size: 12px;
        margin: 0;
        font-weight: 700;
        color: #347ADD;
        background: transparent none repeat scroll 0% 0%;
        border: medium none;
        padding: 3px 8px;
    }

    #bottom-button {
        text-align: right;
        margin-right: 5px;
    }

    .attachment-list li img {
        width: 80px;
    }

</style>
</head>

<script type="text/javascript">
    var swfu = '';
    $(document).ready(function () {
        swfu = new SWFUpload({
            flash_url: "<?= Yii::getAlias('@web/')?>statics/plugin/swfupload/swfupload.swf?" + Math.random(),
            upload_url: "admin.php?r=attachment/doswfupload",
            file_post_name: "Filedata",
            post_params: {
                PHPSESSID: "<?= session_id()?>",
                module: "<?= $module?>",
                ys: 1
            },
            file_size_limit: "2048",
            file_types: "<?php echo $fileTypes ?>",
            file_types_description: "All Files",
            file_upload_limit: "1",
            custom_settings: {
                progressTarget: "fsUploadProgress",
                cancelButtonId: "btnCancel",
                textareaid: "<?php echo $textareaid;?>",

            },

            button_image_url: "<?= Yii::getAlias('@web/')?>statics/plugin/swfupload/images/swfBnt.png",
            button_width: 75,
            button_height: 28,
            button_placeholder_id: "buttonPlaceHolder",
            button_text_style: "",
            button_text_top_padding: 3,
            button_text_left_padding: 12,
            button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
            button_cursor: SWFUpload.CURSOR.HAND,

            file_dialog_start_handler: fileDialogStart,
            file_queued_handler: fileQueued,
            file_queue_error_handler: fileQueueError,
            file_dialog_complete_handler: fileDialogComplete,
            upload_progress_handler: uploadProgress,
            upload_error_handler: uploadError,
            upload_success_handler: uploadSuccess,
            upload_complete_handler: uploadComplete
//
            //   debug:true
        });
    })

</script>
<div class="upload-main">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#div_setting_1">上传附件</a></li>
        <li><a data-toggle="tab" href="#div_setting_2">图库</a></li>


    </ul>
    <div class="tab-content">
        <input type="hidden" id="uploaded_file">
        <input type="hidden" id="attachment_id">

        <div id="div_setting_1" class="tab-pane fade in active">
            <div id="button-control">
                <span id="buttonPlaceHolder"></span>

            </div>

            <div id="startUpload" onClick="swfu.startUpload();">
            </div>
            <div style="clear: both;"></div>
            <div style="font-size: 12px;margin-top:5px;">
                最多上传<font color="red"> 1</font> 个附件,单文件最大 <font class="red">2 MB</font>
                支持 jpg、jpeg、gif、png、bmp 格式。
            </div>
            <input id="ys" value="1" checked="checked" onclick="change_params()" type="checkbox">
            是否压缩
            <fieldset class="blue pad-10" id="swfupload">
                <legend>列表</legend>
                <ul class="attachment-list" id="fsUploadProgress">

                </ul>
            </fieldset>

        </div>

        <div id="div_setting_2" class="tab-pane fade">

        </div>

    </div>
</div>
<div id="bottom-button">
    <button id="button-ok" class="btn btn-default">确定</button>
    <button id="button-cancel" class="btn">取消</button>
</div>
<script>
    function change_params() {
        if ($('#ys').attr('checked')) {
            swfu.addPostParam('ys', '1');
        } else {
            swfu.removePostParam('ys');
        }
    }
    function thumbCallback(value, attachment_id) {
        parent.document.getElementById("<?= $textareaid?>").value = value;
        parent.document.getElementById("<?= $textareaid?>" + '_preview').src = value;
        parent.document.getElementById('attachment_id').value = attachment_id;

    }
    function photosCallback(value, attachment_id) {
        var $pdom = $(parent.document);
        var str = '<li><input type="hidden" name="attachment[]" value="' + attachment_id + '"><input type="hidden" name="photos[]" value="' + value + '"><div class="img-wrap"><span title="删除该图片" class="photos-delete">×</span><img src="' + value + '"></div><div class="photos-alt"><input type="text" name="photos_alt[]" value="图片标题"></div></li>';
        $(str).appendTo($pdom.find('.photos-list'));
        $pdom.find('.photos-delete').click(function () {
            $(this).parent().parent().remove();
        });
    }

    $(function () {

        $('#button-ok').click(function () {
            var value = $('#uploaded_file').val();
            var attachment_id = $('#attachment_id').val();
            if (value && attachment_id) {
                var callback = <?= $callback?>;
                callback(value, attachment_id);
                parent.Yan.dialog.closeAll();
            }
            else {
                alert('未选中图片')
            }
        });

        $('#button-cancel').click(function () {
            parent.Yan.dialog.closeAll();
        });

        function bindImgEvent() {
            $('.attachment-list li a').unbind().bind('click', function () {
                var id = $(this).find('img').attr('data-id');
                var src = $(this).find('img').attr('src');

                var hasClass = $(this).hasClass('on');
                $('.attachment-list li a').removeClass('on');
                if (!hasClass) {
                    $(this).addClass('on');
                    $('#uploaded_file').val(src);
                    $('#attachment_id').val(id);
                }
                else {
                    $(this).removeClass('on');
                    $('#uploaded_file').val('');
                    $('#attachment_id').val('');
                }
            });
        }

        bindImgEvent();

        $.ajax({
            url: 'admin.php?r=attachment/ajax-tk',
            dataType: 'html',
            success: function (html) {
                $('#div_setting_2').html(html);
                bindClick();
                bindImgEvent();
            }
        });
        function bindClick() {
            $('.pagination a').unbind().bind('click', function (e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('href'),
                    dataType: 'html',
                    success: function (html) {
                        $('#div_setting_2').html(html);
                        bindClick();
                        bindImgEvent();
                    }
                });

            });
        }

    })
</script>
