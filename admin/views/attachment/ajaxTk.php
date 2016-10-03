<?php
use yii\widgets\LinkPager;

?>
<ul class="attachment-list">
    <?php foreach ($tk_datas as $v): ?>
        <li>
            <div class="img-wrap"><a href="javascript:;"><div class="icon"></div><img data-id="<?= $v['id'] ?>" src="<?= $v['filepath'] ?>"></a>
            </div>
        </li>

    <?php endforeach; ?>

</ul>
<?= LinkPager::widget(['pagination' => $pages]) ?>

<div style="clear: both;"></div>
