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

$this->title = 'Friends';
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
                <div class="friend-index">

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            //['class' => 'yii\grid\SerialColumn'],

                            'id',
                            'title',
                            [
                                'attribute'=>'filepath',
                                'format'=>'raw',
                                'value'=>function($model){
                                    return Html::img(\common\libs\Bridge::getRootUrl().'uploads/friend/'.$model->filepath,['style'=>'width:150px;']);
                                }
                            ],
                            'link',
                            'listorder',
                            [
                                'attribute'=>'status',
                                'value'=>function($model){
                                    return $model->status ? Yii::t('app','Open') : Yii::t('app','Close');
                                }
                            ],


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
</div>

