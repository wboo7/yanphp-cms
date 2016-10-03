<?php
/**
* @link http://www.yanphp.com/
* @copyright Copyright (c) 2016 YANPHP Software LLC
* @license http://www.yanphp.com/license/
*/
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Friend */

$this->title = 'Create Friend';
$this->params['breadcrumbs'][] = ['label' => 'Banners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<ul class="breadcrumb">
    <li><a href="<?=Url::to(['index'])?>"><?=Yii::t('app','List')?></a></li>
    <li><a href="<?=Url::to(['create'])?>"><?=Yii::t('app','Create')?></a></li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="y_panel">
            <div class="y_content">
                <div class="banner-create">


                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>

                </div>

            </div>
        </div>
    </div>
</div>
