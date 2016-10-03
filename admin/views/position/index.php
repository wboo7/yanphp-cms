<?php
use yii\widgets\LinkPager;
?>
<?= $this->render('Breadcrumb');?>

<div class="panel panel-default">
	<div class="panel-body table-responsive">
        <table class="table table-striped table-bordered">
            <tr>
                <th>id</th>
                <th><?=Yii::t('app','Title')?></th>
                <th><?=Yii::t('app','Content Id')?></th>
                <th><?=Yii::t('app','Position Belong')?></th>
                <th><?=Yii::t('app','Position Id')?></th>
                <th><?=Yii::t('app','Category Belong')?></th>
                <th><?=Yii::t('app','Model Belong')?></th>
                <th ><?=Yii::t('app','Status')?></th>
            </tr>
            <?php foreach($listData as $vo):?>
                <tr>
                    <td><?= $vo['id']?></td>
                    <td><?= $vo['content']['title']?></td>
                    <td><?= $vo['content']['id']?></td>

                    <td><?= $vo['category']['name']?></td>
                    <td><?= $vo['category']['id']?></td>
                    <td><?= $vo['categoryContent']['catname']?></td>
                    <td><?= $vo['categoryContent']['model']['name']?></td>
                    <td>
                        <a title="移除" href="?r=position/delete&id=<?=$vo['id']?>" class="J_ajax_del glyphicon glyphicon-trash"></a>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>

	</div>
    <div class="panel-footer">
          <?php if(!empty($pages)):?>
              <?php

              echo LinkPager::widget([
                  'pagination' => $pages,
              ]);
              ?>
         <?php endif; ?>
    </div>
</div>
