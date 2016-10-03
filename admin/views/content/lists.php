<?php
use common\libs\Yanphp;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use common\models\Content;
use common\widgets\CategoryContent\Category;
?>

<style>
    .add a,.file a{
        color:#555;
    }
</style>
    <div class="row">
        <div class="col-md-2"">
            <div class="row">
                <div class="col-md-12">
                    <div class="y_panel">
                        <div class="y_content">
                            <?= Category::widget(['container'=>'#browser']);?>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="col-md-10">

            <?php if(isset($category->id)):?>
                <ul class="breadcrumb">
                    <li><a href="?r=content/index&catid=<?=$category->id?>"><?= $category->catname;?></a></li>
                    <li><a href="?r=content/create&catid=<?=$category->id?>"><?=Yii::t('app','Create Content')?></a></li>
                </ul>

                <div class="row">
                    <div class="col-md-12">
                        <div class="y_panel">
                            <div class="y_content">
                                <form method="get" action="">
                                    <input type="hidden" name="r" value="content/index">
                                    <input type="hidden" name="catid" value="<?=$category->id?>">

                                    <div class="row">
                                        <div class="col-md-2">
                                            <input class="form-control Y_date" name="keyword" value="" placeholder="<?=Yii::t('app','Start At')?>" type="text">
                                        </div>
                                        <div class="col-md-2">
                                            <input class="form-control Y_date" name="keyword" value="" placeholder="<?=Yii::t('app','End At')?>" type="text">
                                        </div>

                                        <div class="col-md-2">
                                            <select name="search_type" class="form-control">
                                                <option value="1"><?=Yii::t('app','Search Title')?></option>
                                                <option value="2"><?=Yii::t('app','Search Id')?></option>

                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input class="form-control" name="q" value="" placeholder="<?=Yii::t('app','Keyword Input')?>" type="text">
                                        </div>

                                        <div class="col-md-2">
                                            <select name="status" class="form-control">
                                                <option value="" selected=""><?=Yii::t('app','All')?></option>
                                                <option value="0"><?=Yii::t('app','Outline')?></option>
                                                <option value="1"><?=Yii::t('app','Online')?></option>

                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="submit" value="<?=Yii::t('app','Search')?>" class="btn btn-default">
                                            <a  href="?r=content/index&catid=<?=$category->id?>" class="btn btn-default"><?=Yii::t('app','Reset')?></a>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-12">
                        <div class="y_panel">
                            <div class="y_title"><?=Yii::t('app','Content Lists')?><strong class="pull-right"><?=Yii::t('app','Total {num} Record',['num'=>$count])?></strong></div>
                            <div class="y_content">

                                <form id="batchForm" class="table-responsive">
                                    <table class="table table-striped table-hover table-bordered">
                                        <thead>
                                        <tr>

                                            <th><input type="checkbox" class="check-all" data-item-class="check-item"></th>
                                            <th><?=Yii::t('app','Thumb')?></th>
                                            <th>id</th>
                                            <th><?=Yii::t('app','Title')?></th>
                                            <th><?=Yii::t('app','Click')?></th>


                                            <th><?=Yii::t('app','Updated_at')?></th>
                                            <th><?=Yii::t('app','Status')?></th>
                                            <th><?=Yii::t('app','Action')?></th>
                                        </tr>
                                        </thead>


                                        <?php foreach($listData as $vo){?>
                                            <tr>

                                                <td><input name="id[]" value="<?=$vo['id']?>" type="checkbox" class="check-item"></td>
                                                <td><img width="50px" src="<?= Content::getThumbUrl($vo['thumb']); ?>"></td>
                                                <td><?= $vo['id']?></td>
                                                <td><?= Yanphp::strcut($vo['title'],20)?></td>
                                                <td><?= $vo['click']?></td>


                                                <td><?= date('Y-m-d H:i',$vo['updated_at']);?></td>
                                                <td>
                                                    <?php if($vo['status']):?>
                                                        <label class="label label-info"><?=Yii::t('app','Online')?></label>
                                                        <?php else:?>
                                                        <label class="label label-info"><?=Yii::t('app','Outline')?></label>
                                                    <?php endif;?>

                                                    <?php if($vo['position']):?>
                                                        <label class="label label-success"><?=Yii::t('app','Recommend')?></label>
                                                    <?php endif;?>


                                                </td>
                                                <td>
                                                    <a class="fa fa-pencil" href="<?=Url::to(['content/create','id'=>$vo['id'],'catid'=>$category->id])?>"></a>
                                                    <a class="fa fa-trash" role="modal-remote" data-confirm-title="<?=Yii::t('app','tip')?>" data-confirm-message="<?=Yii::t('app','Are you sure delete ?')?>" data-url="<?=Url::to(['content/delete','id'=>$vo['id']])?>"></a>
                                                </td>


                                            </tr>
                                        <?php }?>
                                    </table>
                                </form>

                                <div class="y_footer">
                                    <div class="btn-group">
                                        <button class="btn btn-info batchDelete" type="button" style="margin-right: 10px;"><i class="fa fa-trash"> <?=Yii::t('app','Batch Delete')?></i></button>
                                        <button role="modal-remote" data-url="?r=content/import-data&catid=<?=$category->id?>" class="btn btn-success" type="button"><i class="fa fa-sign-in"> <?=Yii::t('app','Import Data')?></i></button>

                                    </div>
                                    <?php if(!empty($pages)):?>
                                        <?php

                                        echo LinkPager::widget([
                                            'pagination' => $pages,
                                        ]);
                                        ?>
                                    <?php endif; ?>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>

                <script>
                    $(function(){
                       $('.batchDelete').click(function(){
                            var data = $('#batchForm').serializeArray();
                           if(data.length == 0)
                           {
                               alert('<?=Yii::t('app','Have not selected ?')?>');
                               return;
                           }
                           if(confirm('<?=Yii::t('app','Are you sure delete the selected ?')?>'))
                           {
                               $.ajax({
                                   url:'?r=content/batch-delete',
                                   data:data,
                                   dataType:'json',
                                   type:'post',
                                   success:function(c){
                                       location.reload();
                                   }
                               });
                           }
                       });
                    });
                </script>



            <?php else:?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="y_panel">
                            <div class="y_title"><?=Yii::t('app','Quickly Search')?></div>
                            <div class="y_contenet">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group quick_search">
                                            <input type="text" placeholder="<?=Yii::t('app','Keyword Input')?>" class="form-control" aria-label="Text input with dropdown button">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="cname"><?=Yii::t('app','Category')?></span><span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                    <li><a href="#" data-id="1"><?=Yii::t('app','Category')?></a></li>
                                                    <li><a href="#" data-id="2"><?=Yii::t('app','Content')?></a></li>
                                                    <li><a href="#" data-id="3"><?=Yii::t('app','Page')?></a></li>
                                                </ul>
                                            </div>
                                            <!-- /btn-group -->
                                        </div>
                                        <ul class="search_result" style="display: none;">


                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $(function(){


                        var ctype = 1;//栏目
                        var $quick_search = $('.quick_search');
                        $('a',$quick_search).click(function(){
                            ctype  = $(this).data('id');
                            $('.cname',$quick_search).text($(this).text());

                        });
                        $('input',$quick_search).keyup(function(){
                            var keyword = $.trim($(this).val());
                            if(keyword == '')
                                return;
                            $.ajax({
                                url:'?r=content/quick-search',
                                dataType:'json',
                                data:{keyword:keyword,ctype:ctype},
                                type:'get',
                                success:function(resp){
                                   if(resp.state == 0)
                                   {
                                       var data = resp.data;
                                       var str = '';
                                       for(var i = 0;i<data.length;i++)
                                       {
                                           str += '<li><a href="'+data[i].url+'">'+data[i].name+'</a></li>';
                                       }
                                       $('.search_result').html(str).show();
                                   }
                                }
                            });
                        });
                    })
                </script>
            <?php endif;?>


        </div>
    </div>








