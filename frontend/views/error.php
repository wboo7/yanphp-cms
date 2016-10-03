

<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;


?>

<h3>操作提示</h3>
<hr>
<div class="alert alert-danger" role="alert">
    <?php
    echo '<span class="glyphicon glyphicon-info-sign" style="font-size:16px;"></span> '.$data.'<a href="'.$back.'">返回</a>';
    ?>
</div>




