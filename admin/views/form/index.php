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

$this->title = 'Forms';
$this->params['breadcrumbs'][] = $this->title;
?>
<ul class="breadcrumb">
    <li><a href="?r=form/index"><?=Yii::t('app','Form List')?></a></li>
    <li><a href="?r=form/create"><?=Yii::t('app','Form Create')?></a></li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="y_panel">
            <div class="y_content">
                <div class="form-index">


                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id',
                            'table_name',
                            'name',
                            'description',
                            'created_at:datetime',
                            'updated_at:datetime',

                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template'=>'{lists} {add} {manage} {update} {delete}',
                                'buttons'=>[
                                    'lists'=>function($url,$model)
                                    {
                                        return Html::a('<span class="fa fa-bars"></span>', '?r=form/lists&table='.$model->table_name, ['title'=>Yii::t('app','Data List')]);
                                    },
                                    'add'=>function($url,$model)
                                    {
                                        return Html::a('<span class="fa fa-plus"></span>', '?r=form/add&table='.$model->table_name, ['title'=>Yii::t('app','Field Create'),]);
                                    },
                                    'manage'=>function($url,$model)
                                    {
                                        return Html::a('<span class="fa fa-sliders"></span>', '?r=form/manage&table='.$model->table_name, ['title'=>Yii::t('app','Field Manage')]);
                                    },
                                    'delete'=>function($url,$model)
                                    {
                                        return '<a role="modal-remote" data-confirm-title="'.Yii::t('app','Tip').'" data-confirm-message="'.Yii::t('app','Delete The Form ?').'" data-url="?r=form/delete&id='.$model->id.'"><span class="fa fa-trash"></a>';

                                    },
                                ],
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>

