<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8" />
    <title><?=Yii::t('app','Backend Manage')?></title>
    <meta name="robots" content="noindex,nofollow">

    <link href="statics/admin/css/admin_login.css?v20141128" rel="stylesheet" />
    <script src="<?=Yii::getAlias('@web/statics/common/js/jquery.js')?>"></script>

</head>
<body>
<div class="wrap">
    <h2><a href="javascript:void(0);">YANPHP</a></h2>

    <?php $form = ActiveForm::begin([ 'id' => 'loginForm']); ?>
    <input type="hidden" name="dosubmit" value="1">
    <div class="login">
        <ul>
            <li>
                <?= Html::activeTextInput($model, 'username',['id'=>'J_admin_name','required'=>'','class'=>'input','placeholder'=>'账号'])?>
            </li>
            <li>
                <?= Html::activePasswordInput($model, 'password',['id'=>'admin_pwd','required'=>'','class'=>'input','placeholder'=>'密码'])?>
            </li>
            <li style="position: relative;">
                <?= Html::activeTextInput($model, 'captcha',['class'=>'input','placeholder'=>'验证码'])?>
                <img id="captcha" style="position: absolute;right: 5px;top:10px;" data-origin="<?=Url::to(['captcha'])?>" src="<?=Url::to(['captcha'])?>">
            </li>
        </ul>
        <button type="submit" name="submit" class="btn">登录</button>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<script>
    ;(function(){
        document.getElementById('J_admin_name').focus();
        $('#captcha').click(function(){
            var $this = $(this);
            var random = (new Date().getTime());
            var origin = $(this).data('origin');
            $.get(origin+'&refresh=1',function(c){
                $this.attr('src', c.url);
            },'json');
        });
    })();
</script>
</body>
</html>