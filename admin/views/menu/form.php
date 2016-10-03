<?php
use common\libs\Yanphp;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<style>
    .backend-body{padding:0 10px;}
</style>
<!--添加系统菜单-->
<?php $form = ActiveForm::begin([ 'options' => ['class' => 'J_ajaxForm']]); ?>


        <table class="table">

            <tr>
                <th>菜单名称</th>
                <td><?php echo Html::activeTextInput($model, 'name',['class'=>'input length_3','value'=>isset($info) ? $info['name'] : ''])?></td>
            </tr>

            <tr>
                <th>归组名称</th>
                <td><?php echo Html::activeTextInput($model, 'group',['class'=>'input length_3','value'=>isset($info) ? $info['group'] : ''])?></td>
            </tr>
            <tr>
                <th>菜单别名</th>
                <td><?php echo Html::activeTextInput($model, 'alias',['class'=>'input length_3','value'=>isset($info) ? $info['alias'] : ''])?></td>
            </tr>

            <tr>
                <th>控制器名称</th>
                <td><?php echo Html::activeTextInput($model, 'c',['class'=>'input length_3 mr10','value'=>isset($info) ? $info['c'] : ''])?></td>
            </tr>
            <tr>
                <th>操作名称</th>
                <td><?php echo Html::activeTextInput($model, 'a',['class'=>'input length_3 mr10','value'=>isset($info) ? $info['a'] : ''])?></td>
            </tr>
            <tr>
                <th>参数</th>
                <td><?php echo Html::activeTextInput($model, 'data',['class'=>'input length_3 mr10','value'=>isset($info) ? $info['data'] : ''])?></td>
            </tr>
            <tr>
                <th>参数</th>
                <td>
                    <?php echo Html::activeRadio($model, 'display', ['value' => 1,'label'=>'显示','uncheck'=>null])?>
                    <?php echo Html::activeRadio($model, 'display',['value'=>0,'label'=>'隐藏','uncheck'=>null])?>
                </td>
            </tr>
            <tfoot>
            <tr>
                <th>上级菜单</th>
                <td>
                    <select name="AdminMenu[parentid]" class="select_3" id="adminmenu-parentid">
                        <option value="0">顶级菜单</option>
                        <?php echo $menu_options?>
                    </select>

                </td>
            </tr>
            </tfoot>
        </table>

    <div class="pop_bottom">

        <button type="submit" class="btn btn-default mr10 fr J_ajax_submit_btn">提交</button>
        <button type="button" class="btn fr" id="J_dialog_close">取消</button>
    </div>
<?php ActiveForm::end(); ?>
