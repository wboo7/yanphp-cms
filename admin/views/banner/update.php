<?php
/**
* @link http://www.yanphp.com/
* @copyright Copyright (c) 2016 YANPHP Software LLC
* @license http://www.yanphp.com/license/
*/
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\Banner */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Banners', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<ul class="breadcrumb">
    <li><a href="<?=Url::to(['index'])?>">列表</a></li>
    <li><a href="<?=Url::to(['create'])?>">创建</a></li>
    <li><?=$this->title?></li>
</ul>
<div class="banner-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
