<?php
use common\libs\Yanphp;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use vova07\imperavi\Widget;

?>
<ul class="breadcrumb">
    <li><a href=""><?= $model->catname; ?></a></li>
</ul>
<div class="panel panel-default">
	<div class="panel-body">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#div_setting_1"><?=Yii::t('app','Base Option')?></a></li>

        </ul>
        <?php $form = ActiveForm::begin([
            'action' => '?r=content/index&catid=' . $model->id
        ]); ?>
        <div class="tab-content">
            <div id="div_setting_1" class="tab-pane fade active in">

                <?=
                $form->field($model, 'content')->widget(Widget::className(), [
                    'settings' => [
                        'lang' => 'en',
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
            <div class="from-group">
                <input type="submit" class="btn btn-default" value="<?=Yii::t('app','Commit')?>"/>
            </div>

        </div>

        <?php ActiveForm::end(); ?>
	</div>
</div>


