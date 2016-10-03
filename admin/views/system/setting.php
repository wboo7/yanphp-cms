<?php
use yii\widgets\ActiveForm;
?>
<div class="row">
    <div class="col-md-12">
        <div class="y_panel">
            <div class="y_title"><?=Yii::t('app','System Setting')?></div>
            <div class="y_content">
                <?php $form = ActiveForm::begin();?>
                    <?=$form->field($model,'language')->dropDownList(\admin\models\SettingForm::$lans)?>
                    <?=\yii\helpers\Html::submitButton(Yii::t('app','Commit'),['class'=>'btn btn-default'])?>
                <?php $form->end();?>
            </div>
        </div>
    </div>
</div>

