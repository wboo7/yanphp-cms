<?php
/**
 * @link http://www.yanphp.com/
 * @copyright Copyright (c) 2016 YANPHP Software LLC
 * @license http://www.yanphp.com/license/
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin Roles';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('breadcrumb')?>

<div class="row">
    <div class="col-md-12">
        <div class="y_panel">
            <div class="y_content">
                <div class="admin-role-index">


                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id',
                            'name',
                            'description',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template'=>'{update} {delete}'
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>

