<?php
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?= $this->render('Breadcrumb');?>
<div class="panel panel-default">
	<div class="panel-body">
        <?php $form = ActiveForm::begin([ 'options' => ['class' => 'J_ajaxForm']]); ?>
        <?=$form->field($model,'name')?>
        <?=Html::button(Yii::t('app','Commit'),['class'=>'btn btn-default J_ajax_submit_btn'])?>
        <?php ActiveForm::end(); ?>
	</div>
</div>


