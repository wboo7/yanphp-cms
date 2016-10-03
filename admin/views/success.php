
<?php
$this->title = Yii::t('app','Operate Success');
?>
<div class="alert alert-success" role="alert">
    <?php
    echo '<span class="glyphicon glyphicon-info-sign" style="font-size:16px;"></span> '.$data.'<a href="'.$url.'">'.Yii::t('app','Back').'</a>';
    ?>
</div>

