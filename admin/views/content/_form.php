<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\libs\KingEditor;

use vova07\imperavi\Widget;

?>

<style>
    .form-control {
        background: #fafafa;
        border: 1px solid #cecece;
        border-radius: 0;
    }

    .photobox {
        position: relative;
    }

    .add-photo {
        position: absolute;
        left: 25px;
        top: 25px;
        font-size: 16px;
    }
</style>
<ul class="breadcrumb">
    <li><a href="<?= Url::to(['content/index', 'catid' => $model->catid]) ?>"><?= $catModel->catname ?></a></li>
    <li><a href="<?= Url::to(['content/create', 'catid' => $model->catid]) ?>"><?=Yii::t('app','Content Create')?></a></li>
</ul>

<div class="row">
    <div class="col-md-12">
        <div class="y_panel">
            <div class="y_content">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


                    <div class="row">
                        <div class="col-md-10">
                            <?= Html::activeHiddenInput($model, 'catid') ?>
                            <?= $form->field($model, 'title') ?>
                            <?= $form->field($model, 'keywords') ?>
                            <?= $form->field($model, 'description')->textarea(['row' => 2]) ?>
                            <div class="form-group">


                                <?=
                                $form->field($model, 'content')->widget(Widget::className(), [
                                    'settings' => [
                                        'lang' => 'zh_cn',
                                        'minHeight' => 350,
                                        'imageUpload' => Yii::getAlias('@web/index.php/content/public/image-upload-content'),
                                        'plugins' => [
                                            // 'clips',
                                            //'fullscreen',
                                            'imagemanager',
                                            'textdirection',
                                            'fontcolor',
                                            'definedlinks',

                                        ]
                                    ]
                                ]);
                                ?>

                            </div>
                            <?= $form->field($model, 'ext1') ?>
                            <?= $form->field($model, 'ext2') ?>
                            <?= $form->field($model, 'ext3') ?>
                            <?= $form->field($model, 'ext4') ?>
                            <?= $form->field($model, 'ext5') ?>

                        </div>
                        <div class="col-md-2" style="padding-left:0;">
                            <div class="form-group">
                                <label class="control-label" for="content-thumb"><?=Yii::t('app','Thumb')?></label>

                                <div style="border:1px solid #cecece;padding:10px;position: relative;width: 100%;">
                                    <img width="65px" height="45px" src="<?= \common\models\Content::getThumbUrl($model->thumb) ?>">
                             <span
                                 style="font-size:16px;position: absolute;right:20px;top:25px;width:20px;height:20px;overflow: hidden;"
                                 class="glyphicon glyphicon-circle-arrow-up">
                                 <?= $form->field($model, 'file', ['options' => ['style' => 'position:absolute;left:0;top:0;opacity:0;']])->fileInput()->label(false) ?>
                             </span>
                                </div>
                                <?= Html::hiddenInput('attaid') ?>
                                <div class="help-block"></div>
                            </div>

                            <?= $form->field($model, 'listorder') ?>
                            <div class="form-group">
                                <label><?=Yii::t('app','Position')?></label>

                                <div style="background: #fafafa;border:1px solid #ececec;padding:5px 10px;">
                                    <?= Html::checkboxList('position', $positions, ArrayHelper::map($positionCategorys, 'id', 'name')) ?>
                                </div>
                            </div>

                            <?php if ($modelModel->tablename == 'video'): ?>
                                <?=$form->field($model,'videourl')?>
                            <?php endif;?>

                            <?php if ($modelModel->tablename == 'picture'): ?>
                                <style>
                                    .photobox {
                                        position: relative;
                                    }

                                    .photobox .btn-group {
                                        position: absolute;
                                        right: 5px;
                                        bottom: 5px;
                                    }
                                    .photobox:hover .btn-group-hidden{
                                        display: block;
                                    }
                                    .btn-group-hidden{
                                        display: none;
                                    }

                                    .btn-gray {
                                        background: #fafafa;
                                    }

                                    .btn-file {
                                        position: relative;
                                    }

                                    .btn-file input[type="file"] {
                                        position: absolute;
                                        top: 0px;
                                        right: 0px;
                                        min-width: 100%;
                                        min-height: 100%;
                                        text-align: right;
                                        opacity: 0;
                                        background: transparent none repeat scroll 0px 0px;
                                        cursor: inherit;
                                        display: block;
                                    }
                                </style>
                                <div class="form-group">
                                    <label class="control-label" for="content-thumb"><?=Yii::t('app','Atlas')?></label>


                                    <?php if ($model->photos): ?>

                                        <?php foreach ($model->photos as $vo): ?>


                                            <div style="border:1px solid #cecece;padding:3px;margin-bottom: 5px;">
                                                <div class="photobox">
                                                    <img width="100%" height="100%"
                                                         src="<?= \common\libs\Bridge::getRootUrl().'uploads/content/'.$vo['filepath'] ?>">

                                                    <div class="btn-group btn-group-xs btn-group-hidden" role="group" aria-label="body">
                                                        <button role="modal-remote" href="<?= Url::to(['content/show-photo','id'=>$vo['id']]) ?>" type="button" title="<?=Yii::t('app','Zoom In')?>" class="btn btn-gray">
                                                            <span class="glyphicon glyphicon-search"></span>
                                                        </button>
                                                        <button role="modal-remote" href="<?= Url::to(['content/edit-photo','id'=>$vo['id']]) ?>"
                                                                type="button" title="<?=Yii::t('app','Edit')?>" class="btn btn-gray"><span
                                                                class="glyphicon glyphicon-pencil"></span></button>
                                                        <a href="<?= Url::to(['content/delete-photo', 'id' => $vo['id']]) ?>"
                                                           title="<?=Yii::t('app','Delete Picture')?>" class="btn btn-gray"><span
                                                                class="glyphicon glyphicon-trash"></span></a>
                                                    </div>
                                                </div>
                                            </div>


                                        <?php endforeach; ?>

                                    <?php endif; ?>

                                    <div class="form-group">
                                 <span class="btn btn-default btn-file">
                                     <span class="glyphicon glyphicon-plus"></span>
                                     <?= Html::activeFileInput($model, 'filePhoto') ?>
                                 </span>
                                    </div>
                                    <?= Html::hiddenInput('attaid') ?>
                                    <div class="help-block"></div>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>




                    <input type="submit" class="btn btn-default content-submit" name="dosubmit" value="<?=Yii::t('app','Commit')?>"/>


                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>





<script>
    $(function () {
        $('[type=file]').change(function () {
            $('.content-submit').trigger('click');
        });



    });

</script>




