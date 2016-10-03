<?php

use common\models\Config;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<form action="?r=config/create" method="post" role="form" class="form-horizontal">


    <div class="form-group clearfix">
        <label class="control-label col-md-2 col-sm-3 col-xs-12"><?=Yii::t('app','Chinese Name')?></label>
        <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" name="Config[name]" class="form-control" placeholder="<?=Yii::t('app','Name Input')?>">
        </div>
    </div>

    <div class="form-group clearfix">
        <label class="control-label col-md-2 col-sm-3 col-xs-12"><?=Yii::t('app','English Name')?></label>
        <div class="col-md-9 col-sm-9 col-xs-12">
            <input name="Config[id]" type="text" class="form-control" placeholder="<?=Yii::t('app','English Name Input')?>">
        </div>
    </div>
    <div class="form-group clearfix">
        <label class="control-label col-md-2 col-sm-3 col-xs-12"><?=Yii::t('app','Type')?></label>
        <div class="col-md-9 col-sm-9 col-xs-12">
            <label><input type="radio" name="Config[type]" value="0" checked> <?=Yii::t('app','Char')?> </label>
            <label><input type="radio" name="Config[type]" value="2"> <?=Yii::t('app','Text')?> </label>
            <label><input type="radio" name="Config[type]" value="1"> <?=Yii::t('app','Picture')?></label>

        </div>
    </div>

</form>






