<?php
use common\libs\Yanphp;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
?>
<style>
    .table-data{

    }
    caption{

    }
    .collect-result li{
        height: 20px;
        line-height: 20px;
        margin-bottom: 2px;
    }
    .collect-result li span{
        color: #fff;
        font-size: 12px;
        background: #ff9802;
        padding:2px 10px;
    }

</style>
<ul class="breadcrumb">
    <li><a href="">网页采集</a></li>
    <li><a href=""><?=$category->catname?></a></li>
</ul>


<div class="y_panel">

    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>注意!</strong> 地址，标题为必填，都为正则表达式。
            </div>
        </div>
    </div>
    <div class="y_content">

        <div class="row">
            <div class="col-md-12">
                <?php $form = ActiveForm::begin([
                    'options'=>[
                        'class'=>'form-horizontal',
                    ],
                    'fieldConfig'=>[
                        'template'=>'<div class="col-md-1 text-right">{label}</div><div class="col-md-11">{input}</div><div class="col-md-11 col-md-push-1">{error}</div>'
                    ]
                ])?>
                <?=$form->field($model,'c_url')?>
                <?=$form->field($model,'c_block')?>
                <?=$form->field($model,'c_title')?>
                <?=$form->field($model,'c_thumb')?>
                <?=$form->field($model,'c_description')?>
                <?=$form->field($model,'c_click')?>
                <?=$form->field($model,'c_content')?>
                <?=$form->field($model,'c_time')?>
                <?=$form->field($model,'c_ext1')?>
                <?=$form->field($model,'c_ext2')?>
                <?=$form->field($model,'c_ext3')?>
                <?=$form->field($model,'c_ext4')?>
                <?=$form->field($model,'c_ext5')?>

                <?php if(isset($data)):?>
                    <div class="row">
                        <div class="col-md-11 col-md-offset-1">

                            <table class="table  table-bordered table-data">
                                <caption>点击入库按钮可以选择性入库，采集结果如下所示</caption>
                                <tr>
                                    <th>标题</th>
                                    <th>封面</th>
                                    <th><input type="checkbox"  class="check-all" data-item-class="check-item"></th>
                                </tr>
                                <?php if($data):?>
                                    <?php foreach($data as $v):?>
                                        <tr>
                                            <td><?=$v['title']?></td>
                                            <td><img style="width:30px;" src="<?=$v['thumb']?>"></td>
                                            <td><input type="checkbox" name="titles[]" value="<?=$v['title']?>" class="check-item"></td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </table>
                        </div>
                    </div>

                <?php endif;?>

                <?php if(isset($result)):?>
                    <div class="row">
                        <div class="col-md-11 col-md-offset-1">
                            <ul class="collect-result">
                                <?php if($result):?>
                                    <?php foreach($result as $v):?>
                                        <li><span><?=$v['title']?> <i>入库成功！</i></span></li>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </ul>
                        </div>
                    </div>

                <?php endif;?>

                <div class="row">
                    <div class="col-md-9 col-md-offset-1">

                        <?=Html::submitButton('预览',['name'=>'preview','class'=>'btn btn-info'])?>
                        <?php if(isset($data)):?>
                            <?=Html::submitButton('入库',['name'=>"collect",'class'=>'btn btn-default'])?>
                        <?php endif;?>
                    </div>
                </div>


                <?php $form->end()?>
            </div>
        </div>



    </div>
</div>










