<?php
use yii\widgets\ActiveForm;
?>
<div class="row">
    <div class="col-md-12">
        <div class="y_panel">
            <div class="y_title"><?=Yii::t('app','Password Edit')?></div>
            <div class="y_content">
                <?php $form = ActiveForm::begin();?>
                <?=$form->field($model,'password')->passwordInput()?>
                <?=$form->field($model,'repassword')->passwordInput()?>
                <?=\yii\helpers\Html::submitButton(Yii::t('app','Commit'),['class'=>'btn btn-default'])?>
                <?php $form->end();?>
            </div>
        </div>
    </div>
</div>

