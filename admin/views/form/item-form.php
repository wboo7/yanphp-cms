<?php
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
?>

<ul class="breadcrumb">
    <li><a href="?r=form/index"><?=Yii::t('app','Form List')?></a></li>
    <li><a href="?r=form/create"><?=Yii::t('app','Form Create')?></a></li>
    <li><a href="?r=form/lists&table=<?=Yii::$app->request->get('table')?>"><?=Yii::t('app','Data List')?></a></li>

</ul>
<div class="row">
    <div class="col-md-12">
        <div class="y_panel">
            <div class="y_content">
                <form action="" method="post" role="form">

                    <?php foreach($data as $k=>$v):?>
                          <?php if($k !== 'id'):?>
                            <?php if($columns[$k]->dbType === 'text'):?>
                                <div class="form-group">
                                    <label><?=$columns[$k]->comment?></label>
                                    <textarea class="form-control" rows="3" name="<?=$k?>"><?=$v?></textarea>
                                </div>
                            <?php else:?>
                                <?php if(in_array($k,['created_at','updated_at'])):?>
                                    <div class="form-group">
                                        <label><?=$columns[$k]->comment?></label>
                                        <input name="<?=$k?>" type="text" readonly="readonly" class="form-control" value="<?=$v?>">
                                    </div>
                                <?php else:?>
                                    <div class="form-group">
                                        <label><?=$columns[$k]->comment?></label>
                                        <input name="<?=$k?>" type="text" class="form-control" value="<?=$v?>">
                                    </div>
                                <?php endif;?>

                            <?php endif;?>
                          <?php endif;?>

                    <?php endforeach;?>
                    <div class="form-group">

                            <button type="submit" class="btn btn-primary"><?=Yii::t('app','Update')?></button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
