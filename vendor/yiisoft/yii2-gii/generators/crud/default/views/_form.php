<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>
/**
* @link http://www.yanphp.com/
* @copyright Copyright (c) 2016 YANPHP Software LLC
* @license http://www.yanphp.com/license/
*/
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
<?php
if(in_array('content',$generator->getColumnNames()))
    echo 'use vova07\imperavi\Widget;';
?>

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

    <?= "<?php " ?>$form = ActiveForm::begin(); ?>

<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes)) {
        if($attribute == 'content')
        {
             $out = <<<str
        <?=
        \$form->field(\$model, 'content')->widget(Widget::className(), [
            'settings' => [
                'lang' => 'en',
                'minHeight' => 200,
                'imageUpload' => Yii::getAlias('@web/index.php/home/upload/image-upload'),
                'plugins' => [
                    'imagemanager',
                    'textdirection',
                    'fontcolor',
                    'definedlinks',

                ]
            ]
        ]);
        ?>
str;

         echo $out."\n";

        }
        else
        {

            if($attribute !== 'created_at' && $attribute !== 'updated_at')
            {
                echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
            }


        }


    }
} ?>
    <div class="form-group">
        <?= "<?= " ?>Html::submitButton($model->isNewRecord ? <?= $generator->generateString('创建') ?> : <?= $generator->generateString('更新') ?>, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?= "<?php " ?>ActiveForm::end(); ?>

</div>
