<?php
use common\libs\Yanphp;
use yii\widgets\LinkPager;
?>
<ul class="breadcrumb">
    <li class="current"><a href="?r=msg/index">留言列表</a></li>
    <li><a href="?r=msg/form">管理表单</a></li>

</ul>
<div class="panel panel-default">
	<div class="panel-body table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <?php foreach($fields as $v):?>
                    <td><?= $v['Comment']?></td>
                <?php endforeach;?>
                <td></td>
            </tr>
            </thead>

            <?php foreach($listData as $v):?>
                <tr>
                    <?php foreach($v as $v2):?>
                        <td><?= $v2?></td>
                    <?php endforeach;?>
                    <td>
                    <td>
                        <a class="fa fa-pencil" href="?=msg/update"></a>
                        <a data-confirm-title="提示" data-confirm-message="确定删除吗？" role="modal-remote" class="fa fa-trash" data-url="?r=msg/delete&id=<?=$v['id']?>"></a>
                    </td>
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




