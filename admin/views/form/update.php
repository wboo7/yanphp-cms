<?php
/**
* @link http://www.yanphp.com/
* @copyright Copyright (c) 2016 YANPHP Software LLC
* @license http://www.yanphp.com/license/
*/
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\Form */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<ul class="breadcrumb">
    <li><a href="?r=form/index"><?=Yii::t('app','Form List')?></a></li>
    <li><a href="?r=form/create"><?=Yii::t('app','Form Create')?></a></li>
    <li><?=$this->title?></li>
</ul>
<div class="form-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
