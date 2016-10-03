<?php
/**
* @link http://www.yanphp.com/
* @copyright Copyright (c) 2016 YANPHP Software LLC
* @license http://www.yanphp.com/license/
*/
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\AdminRole */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Admin Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<?= $this->render('breadcrumb')?>
<div class="admin-role-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
