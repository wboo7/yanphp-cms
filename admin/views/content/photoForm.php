<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

?>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name') ?>

<?php ActiveForm::end(); ?>





