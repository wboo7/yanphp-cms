<?php
use common\libs\Yanphp;
?>

        <ul class="breadcrumb">
            <li class="current"><a href="?r=category-content/index"><?=Yii::t('app','Category Manage')?></a></li>
            <li><a href="?r=category-content/create"><?=Yii::t('app','Category Create')?></a></li>


        </ul>

<div class="panel panel-default">
    <div class="panel-body">
        <form class="J_ajaxForm" data-role="list" action="?r=category-content/order" method="post">

            <div class="table-responsive">
            <table class="table table-hover table-bordered">

               <thead>
               <tr>
                   <th align="center"><?=Yii::t('app','Sort')?></th>
                   <th align="center"><?=Yii::t('app','Category Id')?></th>
                   <th><?=Yii::t('app','Category Name')?></th>
                   <th align="center"><?=Yii::t('app','Model Belong')?></th>
                   <th align="center"><?=Yii::t('app','Category List Template')?></th>
                   <th align="center"><?=Yii::t('app','Category Show Template')?></th>
                   <th align="center"><?=Yii::t('app','Nav Show')?></th>
                   <th align="center"><?=Yii::t('app','Action')?></th>
               </tr>
               </thead>


                <?php echo $categorys;?>


            </table>
                </div>



        </form>
    </div>

</div>



<script>
//    $('.add-contents').click(function(e){
//        e.preventDefault();
//        var url = $(this).attr('href');
////        $.ajax({
////            url:url,
////
////        });
//    });
</script>

