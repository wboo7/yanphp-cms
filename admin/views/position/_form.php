<?php
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?= $this->render('Breadcrumb');?>
<div class="panel panel-default">
    <div class="panel-body">
        <?php $form = ActiveForm::begin(); ?>
        <?=$form->field($model,'name')?>
        <?=Html::submitButton(Yii::t('app','Commit'),['class'=>'btn btn-default'])?>
        <?php ActiveForm::end(); ?>
    </div>
</div>


