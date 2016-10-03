<?php
use common\libs\Yanphp;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\libs\KingEditor;


?>


<form action="<?=\yii\helpers\Url::to(['category-content/add-contents','id'=>$id])?>" class="form-inline J_ajaxForm" method="post">

    <div class="form-group">
        <label>条数</label>
       <select name="num" class="form-control">
           <option value="10">10条</option>
           <option value="20">20条</option>
           <option value="30">30条</option>
           <option value="40">40条</option>
           <option value="50">50条</option>
           <option value="60">60条</option>
           <option value="70">70条</option>
           <option value="80">80条</option>
           <option value="90">90条</option>
           <option value="100">100条</option>
       </select>
    </div>

    <div class="form-group" style="position: fixed;bottom: 0;">
       <button class="btn btn-default J_ajax_submit_btn">添加</button>
    </div>
</form>


