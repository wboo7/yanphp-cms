<?php
?>
<?= $this->render('Breadcrumb');?>
<div class="panel panel-default">
	<div class="panel-body table-responsive">
        <table class="table table-striped table-bordered">
            <tr>
                <th>Id</th>
                <th><?=Yii::t('app','Title')?></th>

                <th ><?=Yii::t('app','Action')?></th>
            </tr>
            <?php foreach($listData as $vo):?>
                <tr>
                    <td><?= $vo['id']?></td>
                    <td><?= $vo['name']?></td>

                    <td>
                        <a title="移除" data-msg="确定要删除和所有数据吗？" href="?r=position/delete-category&id=<?=$vo['id']?>" class="glyphicon glyphicon-trash"></a>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>
	</div>
</div>
