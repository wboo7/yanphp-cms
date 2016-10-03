<?php
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use admin\models\FieldForm;
?>
    <ul class="breadcrumb">
        <li><a href="?r=form/index"><?=Yii::t('app','Form List')?></a></li>
        <li><a href="?r=form/create"><?=Yii::t('app','Form Create')?></a></li>
        <li><a href="?r=form/lists&table=<?=Yii::$app->request->get('table')?>"><?=Yii::t('app','Data List')?></a></li>

    </ul>
<div class="row">
    <div class="col-md-12">
        <div class="y_panel">
            <div class="y_title"><?=Yii::t('app','Field Create')?>（<?=$table?>）</div>
            <div class="y_content">
                <div class="alert alert-success">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                	<strong><?=Yii::t('app','Tip')?>！</strong> <?=Yii::t('app','Filed For Simple,Everything Is VarChar Or Text.')?>
                </div>
                <?php $form=ActiveForm::begin();?>
                <?=$form->field($model,'type')->dropDownList(FieldForm::$types)?>
                <?php if(Yii::$app->request->get('field')):?>
                    <?=$form->field($model,'name')->textInput(['placeholder'=>Yii::t('app','English Field Tag Input'),'readonly'=>'readonly'])?>
                <?php else:?>
                    <?=$form->field($model,'name')->textInput(['placeholder'=>Yii::t('app','English Field Tag Input')])?>
                <?php endif;?>

                <?=$form->field($model,'comment')->textInput(['placeholder'=>Yii::t('app','Field Comment Input')])?>
                <?=$form->field($model,'length')->textInput(['placeholder'=>Yii::t('app','Field Length Input')])?>
                <?=$form->field($model,'defaultValue')->textInput(['placeholder'=>Yii::t('app','Default Value Input')])?>
                <?=Html::submitButton(Yii::t('app','Commit'),['class'=>'btn btn-default'])?>
                <?php $form->end();?>
            </div>
        </div>
    </div>
</div>
