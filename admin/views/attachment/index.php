<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$module = ['content' => '内容模块'];
$this->title = 'Attachments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-content">

    <ul class="breadcrumb">
        <li class="current"><a href="?r=attachment/index">所有附件</a></li>
        <li class="current"><a href="?r=attachment/index&status=0">未使用附件[<?=$unuse?>]</a></li>
        <li>
            <a class="J_ajax_del" data-msg="确定清理所有未使用附件吗？" href="?r=attachment/clean">清理碎片</a>
            <span data-original-title="清理碎片" class="glyphicon glyphicon-question-sign dpsblue pointer f14" data-toggle="popover" title="" data-content="清理未使用的附件碎片是个好习惯，可以节省服务器的磁盘空间"></span>
        </li>

    </ul>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>模块</th>

            <th>附件名称</th>
            <th>附件大小</th>
            <th>上传时间</th>
            <th>管理操作</th>
        </tr>
        </thead>
        <?php foreach ($listData as $v): ?>
            <tr>
                <td><?= $v['id'] ?></td>
                <td><?= $module[$v['module']] ?></td>

                <td><?= $v['filename'] ?></td>
                <td><?= round($v['filesize'] / 1024, 2) ?> KB</td>
                <td><?= date('Y-m-d H:i', $v['uploadtime']) ?></td>

                <td>
                    <a href="" data-src="<?= Yii::getAlias('@web/') . $v['filepath'] ?>"
                       class="glyphicon glyphicon-eye-open preview" title="预览"></a>
                    <a href="?r=attachment/delete&id=<?= $v['id']?>" class="J_ajax_del glyphicon glyphicon-trash" title="删除"></a>
                </td>

            </tr>
        <?php endforeach; ?>
    </table>
    <?php if (!empty($pages)): ?>
        <?php

        echo LinkPager::widget([
            'pagination' => $pages,
        ]);
        ?>
    <?php endif; ?>

</div>
<script>
    $(function () {

        $('[data-toggle="popover"]').popover({trigger:'hover'});

        $('.preview').click(function (e) {
            e.preventDefault();
            var src = $(this).attr('data-src');
            Yan.use('dialog',function(){
                Yan.dialog.alert('<img src='+src+'>');
            });

        });
    });
</script>