<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>
/**
* @link http://www.yanphp.com/
* @copyright Copyright (c) 2016 YANPHP Software LLC
* @license http://www.yanphp.com/license/
*/
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = <?= $generator->generateString('Create ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<ul class="breadcrumb">
    <li><a href="<?="<?="?>Url::to(['index'])<?="?>"?>">列表</a></li>
    <li><a href="<?="<?="?>Url::to(['create'])<?="?>"?>">创建</a></li>
</ul>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-create">


    <?= "<?= " ?>$this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
