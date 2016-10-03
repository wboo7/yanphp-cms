<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Attachment */

$this->title = 'Create Attachment';
$this->params['breadcrumbs'][] = ['label' => 'Attachments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attachment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
