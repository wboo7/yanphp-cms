<?php
use common\libs\Yanphp;

?>

<ul class="breadcrumb">
    <li><a href="?r=model/index"><?=Yii::t('app','Model List')?></a></li>

</ul>
<div class="panel panel-default">
    <div class="panel-body table-responsive">
        <table class="table table-striped table-bordered">

            <thead>
            <tr>

                <th>id</th>
                <th><?=Yii::t('app','Model Name')?></th>
                <th><?=Yii::t('app','Description')?></th>
                <th><?=Yii::t('app','Category Template')?></th>
                <th><?=Yii::t('app','Category List Template')?></th>
                <th><?=Yii::t('app','Category Show Template')?></th>
                <th><?=Yii::t('app','Category Loaded')?></th>
                <th><?=Yii::t('app','Type')?></th>
                <th><?=Yii::t('app','Action')?></th>


            </tr>
            </thead>


            <?php foreach ($listData as $vo): ?>
                <tr>


                    <td><?= $vo['id'] ?></td>
                    <td><?= $vo['name'] ?></td>

                    <td><?= $vo['description'] ?></td>
                    <td><?= $vo['category_template'] ? $vo['category_template'] : '--' ?></td>
                    <td><?= $vo['list_template'] ? $vo['list_template'] : '--' ?></td>
                    <td><?= $vo['show_template'] ? $vo['show_template'] : '--' ?></td>
                    <td>
                        <?php if ($vo['category']): ?>
                            <?php foreach ($vo['category'] as $v): ?>
                                【<?= $v['catname'] ?>】
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $vo['system'] ? '默认' : '--' ?></td>
                    <td>
                        <a href="?r=model/create&pid=<?= $vo['id'] ?>" class="fa fa-copy"
                           title="克隆一个"></a>
                        <?php if (!$vo['system']): ?>
                            <a href="?r=model/create&id=<?= $vo['id'] ?>" class="fa fa-pencil"
                               title="修改模型"></a>
                            <a role="modal-remote" data-confirm-title="提示" data-confirm-message="确定删除模型吗？"  data-url="?r=model/delete&id=<?= $vo['id'] ?>" class="fa fa-trash"
                               title="删除模型"></a>
                        <?php endif; ?>

                    </td>


                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="panel-footer">
        <?php if (!empty($pages)): ?>
            <?php

            echo LinkPager::widget([
                'pagination' => $pages,
            ]);
            ?>
        <?php endif; ?>
    </div>
</div>
