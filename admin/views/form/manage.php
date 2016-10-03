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
    <li><a href="?r=form/lists&table=<?=Yii::$app->request->get('table')?>"><?=Yii::t('app','Data List')?></a></li>
    <li><a href="?r=form/add&table=<?=Yii::$app->request->get('table')?>"><?=Yii::t('app','Field Create')?></a></li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="y_panel">
            <div class="y_title"><?=Yii::t('app','Field List')?>（<?=Yii::$app->request->get('table');?>）</div>
            <div class="y_content">
                <div class="form-index">


                    <div class="grid-view">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>

                                    <th><?=Yii::t('app','Field Tag')?></th>
                                    <th><?=Yii::t('app','Field Comment')?></th>
                                    <th><?=Yii::t('app','Type')?></th>
                                    <th><?=Yii::t('app','Length')?></th>
                                    <th><?=Yii::t('app','Default Value')?></th>
                                    <th></th>

                            </tr>
                            </thead>
                            <tbody>

                              <?php if($fields):?>

                                  <?php foreach($fields as $v):?>
                              <tr>
                                  <td><?=$v->name?></td>
                                  <td><?=$v->comment?></td>
                                  <td><?=$v->dbType?></td>
                                  <td><?=$v->size?></td>
                                  <td><?=$v->defaultValue?></td>
                                  <td>
                                      <?php if(!in_array($v->name,\common\models\Form::$defaultFields)):?>
                                          <a href="?r=form/add&table=<?=Yii::$app->request->get('table')?>&field=<?=$v->name?>" class="fa fa-pencil" title="修改字段"></a>
                                          <a data-confirm-title="提示" data-confirm-message="确定删除该字段吗？" role="modal-remote" data-url="?r=form/field-delete&table=<?=Yii::$app->request->get('table')?>&field=<?=$v->name?>" class="fa fa-trash" title="删除字段"></a>

                                          <?php else:?>
                                          默认
                                      <?php endif;?>
                                  </td>
                              </tr>
                                  <?php endforeach;?>
                              <?php endif;?>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>