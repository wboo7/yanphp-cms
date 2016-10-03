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
    <li><a href="?r=form/add&table=<?=Yii::$app->request->get('table')?>"><?=Yii::t('app','Field Create')?></a></li>

</ul>
<div class="row">
    <div class="col-md-12">
        <div class="y_panel">
            <div class="y_title"><?=$tableForm->name?></div>
            <div class="y_content">
                <div class="form-index">


                    <div class="grid-view">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <?php foreach($fields as $v):?>
                                    <th><?=$v['Comment']?></th>
                                <?php endforeach;?>
                                    <th></th>
                            </tr>
                            </thead>
                            <tbody>

                              <?php if($lists):?>

                                  <?php foreach($lists as $v):?>
                              <tr>
                                  <?php foreach($v as $k2=>$v2):?>
                                      <td>
                                          <?php if(in_array($k2,['created_at','updated_at'])):?>
                                                <?=date('Y年m月d日 H时i分',$v2)?>
                                              <?php else:?>
                                                <?=$v2?>
                                          <?php endif;?>

                                      </td>

                                  <?php endforeach;?>
                                  <td>
                                      <a title="编辑" href="?r=form/item-update&table=<?=Yii::$app->request->get('table')?>&id=<?=$v['id']?>"><span class="fa fa-pencil"></span></a>
                                      <a role="modal-remote" data-confirm-title="提示" data-confirm-message="确定删除吗？"  data-url="?r=form/item-delete&table=<?=Yii::$app->request->get('table')?>&id=<?=$v['id']?>"><span class="fa fa-trash"></span></a>
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