<?php
use common\libs\Yanphp;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\libs\KingEditor;


?>

    <ul class="breadcrumb">
        <li><a href="?r=category-content/index"><?=Yii::t('app','Category Manage')?>></a></li>
        <li><a href="?r=category-content/create"><?=Yii::t('app','Category Create')?></a></li>
        
    </ul>

<div class="panel panel-default">
	<div class="panel-body">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#div_setting_1" data-toggle="tab"><?=Yii::t('app','Base Option')?></a></li>
            <li><a href="#div_setting_2" data-toggle="tab"><?=Yii::t('app','Other Setting')?></a></li>
        </ul>

        <?php $form = ActiveForm::begin(); ?>

        <div class="tab-content">
            <div id="div_setting_1" class="tab-pane fade active in">


                <?=$form->field($model,'modelid')->dropDownList(ArrayHelper::map($modeldata,'id','name'))?>



                <?=$form->field($model,'parentid')->dropDownList(ArrayHelper::map($categorys,'id', 'format_name'))?>
                <?=$form->field($model,'catname')?>
                <?=$form->field($model,'ismenu')->radioList([Yii::t('app','No'),Yii::t('app','Yes')])?>


            </div>
            <div id="div_setting_2" class="tab-pane fade">
                <?=$form->field($model,'keywords')?>
                <?=$form->field($model,'description')?>

<!--                --><?php //if($model->model->type == \common\models\Model::TYPE_PAGE):?>
<!--                    <div class="form-group">-->
<!--                        --><?//= KingEditor::run($model, "content",$model->content ,'100%','500px'); ?>
<!--                    </div>-->
<!--                --><?php //endif;?>


            </div>


            <input name="dosubmit" value="<?=Yii::t('app','Commit')?>" class="btn btn-default" type="submit">
        </div>


        <?php ActiveForm::end(); ?>
	</div>
</div>






