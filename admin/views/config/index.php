<?php

use common\models\Config;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="row">
    <div class="col-md-12">
        <div class="y_panel">
            <div class="y_title"><?=Yii::t('app','Site Config')?></div>
            <div class="y_content">
                <form method="post" action="" class="form-horizontal form-label-left" enctype="multipart/form-data">

                    <?php
                    $lists = Config::find()
                        ->asArray()
                        ->all();
                    ?>
                    <?php if($lists):?>
                        <?php foreach($lists as $v):?>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-3 col-xs-12"><?=$v['name']?><br><?=$v['id']?></label>
                                <div class="col-md-9 col-sm-9 col-xs-10">
                                    <?php if($v['type'] == Config::TYPE_INPUT):?>
                                        <input type="text" name="<?=$v['id']?>" class="form-control" value="<?=$v['value']?>">

                                    <?php endif;?>
                                    <?php if($v['type'] == Config::TYPE_IMAGE):?>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <img class="img-responsive" src="<?=\common\libs\Bridge::getRootUrl().'uploads/config/'.$v['value']?>">
                                            </div>
                                            <div class="col-md-4">

                                                <input type="file" name="<?=$v['id']?>">
                                                <input type="hidden" name="<?=$v['id']?>">
                                            </div>
                                        </div>


                                    <?php endif;?>
                                    <?php if($v['type'] == Config::TYPE_TEXTAREA):?>
                                        <textarea class="form-control" name="<?=$v['id']?>"><?=$v['value']?></textarea>

                                    <?php endif;?>
                                </div>
                                <div style="margin-top:10px;color: #ddd;" class="col-md-1 col-sm-2 col-xs-2 text-center">
                                    <span data-confirm-title="<?=Yii::t('app','Tip')?>" data-confirm-message="<?=Yii::t('app','Delete The Config ?')?>" role="modal-remote" data-url="?r=config/delete&id=<?=$v['id']?>" class="fa fa-trash"></span></div>
                            </div>
                        <?php endforeach;?>
                    <?php endif;?>

                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-2">
                            <button role="modal-remote" data-url="?r=config/create" class="btn btn-default"><span class="fa fa-plus"></span> <?=Yii::t('app','Add')?></button>
                            <button class="btn btn-default"><span class="fa fa-check"></span> <?=Yii::t('app','Save')?></button>
                        </div>

                    </div>



                </form>
            </div>
        </div>
    </div>
</div>






