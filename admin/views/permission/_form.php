<?php
/**
* @link http://www.yanphp.com/
* @copyright Copyright (c) 2016 YANPHP Software LLC
* @license http://www.yanphp.com/license/
*/
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AdminRole */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-12">
        <div class="y_panel">
            <div class="y_content">
                <div class="admin-role-form">

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
                    <?php
                    $actions = \common\models\AdminAction::find()
                        ->asArray()
                        ->indexBy('route')
                        ->orderBy('name DESC')
                        ->all();
                    $selects = \yii\helpers\ArrayHelper::toArray($model->assignment);
                    $ids = [];
                    if($selects)
                    {
                        foreach($selects as $v)
                        {
                            $ids[] = $v['action_id'];
                        }
                    }

                    ?>
                    <div class="form-group">
                        <label><?=Yii::t('app','Permission Assignment')?></label>
                        <div >
                            <?php if($actions):?>
                                <?php foreach($actions as $k=>$v):?>
                                    <input type="checkbox" name="AdminRole[assignment][]" <?= in_array($v['id'],$ids)?'checked="checked"':''?>  value="<?=$v['id']?>"> <?=$v['name']?>
                                <?php endforeach;?>
                            <?php endif;?>
                        </div>


                    </div>



                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>

