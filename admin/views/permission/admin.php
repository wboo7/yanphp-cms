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
<?=$this->render('breadcrumb')?>
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
                            'username',
                            'role.name',
                            'loginip',
                            'logindate:datetime',

                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template'=>'{update} {delete}',
                                'buttons'=>[
                                    'update'=>function($url,$model,$key){
                                        return Html::a('<span class="fa fa-pencil"></span>',Url::to(['admin-create','id'=>$model->id]));
                                    },
                                    'delete'=>function($url,$model,$key){
                                        $options = [
                                            'title' => Yii::t('yii', 'Delete'),
                                            'aria-label' => Yii::t('yii', 'Delete'),
                                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                            'data-method' => 'post',
                                            'data-pjax' => '0',
                                        ];
                                        return Html::a('<span class="fa fa-trash"></span>',Url::to(['delete-admin','id'=>$model->id]),$options);
                                    }


                                ]
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>

