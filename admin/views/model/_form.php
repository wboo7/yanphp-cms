<?php
use common\libs\Yanphp;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\libs\KingEditor;


?>

<ul class="breadcrumb">
    <li><a href="?r=model/index"><?=Yii::t('app','Model List')?></a></li>
</ul>


<div class="panel panel-default">


    <div class="panel-body">
        <?php $form = ActiveForm::begin(); ?>
       <?php if($model->isNewRecord):?>
           <div class="alert alert-info" role="alert">
               <strong><?=Yii::t('app','Take Care !')?></strong> <?=Yii::t('app','Please Edit The Cloned Template')?>。
           </div>
       <?php endif;?>


        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'description')->textarea(['row' => 2]) ?>

        <?php if($model->list_template):?>
            <?= $form->field($model, 'list_template') ?>
        <?php endif;?>

        <?= $form->field($model, 'show_template') ?>
        <?=$form->field($model,'type')->hiddenInput()->label(false)?>
        <?=$form->field($model,'tablename')->hiddenInput()->label(false)?>
        <input name="dosubmit" value="<?=Yii::t('app','Commit')?>" class="btn btn-default" type="submit">
        <?php ActiveForm::end(); ?>
    </div>

</div>








