<?php
use common\libs\Yanphp;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

?>
<style>
    .backend-body {
        padding: 0 10px;
    }
</style>
<!--添加系统菜单-->

<?php $form = ActiveForm::begin(['options' => ['class' => 'J_ajaxForm']]); ?>

<table class="table">

    <tr>
        <th>注释</th>
        <td><input type="text" name="comment" class="form-control"></td>
    </tr>
    <tr>
        <th>标识</th>
        <td><input type="text" name="field" class="form-control"></td>
    </tr>
    <tr>
        <th>类型</th>
        <td>
            <select name="type">
                <option value="0">文本</option>
                <option value="1">整数</option>
            </select>
        </td>
    </tr>
    <tr>
        <th>长度</th>
        <td><input type="text" name="length" class="form-control"></td>
    </tr>


</table>


<?php ActiveForm::end(); ?>

