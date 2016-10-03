<?php
use yii\helpers\Url;
?>

<ul class="breadcrumb">
    <li><a href="<?= Url::to(['index']) ?>"><?=Yii::t('app','Role List')?></a></li>
    <li><a href="<?= Url::to(['create']) ?>"><?=Yii::t('app','Role Create')?></a></li>
    <li><a href="<?= Url::to(['admin']) ?>"><?=Yii::t('app','Admin List')?></a></li>
    <li><a href="<?= Url::to(['admin-create']) ?>"><?=Yii::t('app','Admin Create')?></a></li>
    <li><a href="<?= Url::to(['action']) ?>"><?=Yii::t('app','Permission List')?></a></li>
    <li><a href="<?= Url::to(['create-action']) ?>"><?=Yii::t('app','Permission Create')?></a></li>
</ul>