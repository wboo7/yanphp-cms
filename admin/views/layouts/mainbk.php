<?php

use yii\helpers\Html;
use common\libs\Yanphp;
use common\models\AdminMenu;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;


$this->title = '管理后台';
$version = Yii::$app->params['assetVersion'];

$controller = $this->context->id;
$action = $this->context->action->id;

$topMenus = AdminMenu::find()
    ->where(['parentid'=>0])
    ->asArray()
    ->all();

$parentid = AdminMenu::find()
    ->select('parentid')
    ->where(['c' => $controller, 'a' => $action])
    ->andWhere(['>','parentid',0])
    ->scalar();
$menus = AdminMenu::find()
    ->where(['parentid' => $parentid,'ismenu'=>1])
    ->andWhere(['<>','group',''])
    ->asArray()
    ->all();

$formatMenus = [];
if($menus)
{
    foreach($menus as $v)
    {
        $formatMenus[$v['group']][] = [
            'id'=>$v['id'],
            'name'=>$v['name'],
            'url'=>'?r='.$v['c'].'/'.$v['a'].$v['params']
        ];
    }
}



?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <link href="<?= Yii::getAlias('@web/') ?>statics/common/css/bootstrap.css?v=<?=$version?>" rel="stylesheet"/>


    <!--[if lt IE 9]>
    <script src="<?=Yii::getAlias('@web/')?>statics/common/js/html5shiv.min.js"></script>
    <script src="<?=Yii::getAlias('@web/')?>statics/common/js/respond.min.js"></script>
    <![endif]-->

    <script>

        var GV = {
            JS_VERSION: '',
            JS_ROOT: ''
        };

    </script>
    <script src="<?= Yii::getAlias('@web/') ?>statics/common/js/jquery.js?v=<?=$version?>"></script>
    <script src="<?= Yii::getAlias('@web/statics/common/js/bootstrap.js?v=<?=$version?>') ?>"></script>



    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


<div class="navbar navbar-inverse navbar-static-top" role="navigation" style="position:static;">
    <div class="container-fluid">

        <ul class="nav navbar-nav">
            <li><a href="?=site/index"><i class="fa fa-reply-all"></i>返回系统</a></li>
            <?php if($topMenus):?>
                <?php foreach($topMenus as $v):?>
                    <li <?=$parentid == $v['id']?'class="active"':''?>><a class="topMenu" href="<?='?r='.$v['c'].'/'.$v['a'].$v['params']?>"><?=$v['name']?></a></li>
                <?php endforeach;?>
            <?php endif;?>


        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown topbar-notice">
                <a type="button" data-toggle="dropdown">
                    <i class="fa fa-bell"></i>
                    <span class="badge" id="notice-total">0</span>
                </a>

                <div class="dropdown-menu" aria-labelledby="dLabel">
                    <div class="topbar-notice-panel">
                        <div class="topbar-notice-arrow"></div>
                        <div class="topbar-notice-head">
                            <span>系统公告</span>
                            <a href="" class="pull-right">更多公告&gt;&gt;</a>
                        </div>
                        <div class="topbar-notice-body">
                            <ul id="notice-container"></ul>
                        </div>
                    </div>
                </div>
            </li>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"
                   style="display:block; max-width:200px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; "><i
                        class="fa fa-group"></i>No1商城 <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="" target="_blank"><i class="fa fa-weixin fa-fw"></i> 编辑当前账号资料</a></li>
                    <li><a href="" target="_blank"><i class="fa fa-cogs fa-fw"></i> 管理其它公众号</a></li>
                    <li><a href="" target="_blank"><i class="fa fa-mobile fa-fw"></i> 模拟测试</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"
                   style="display:block; max-width:185px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; "><i
                        class="fa fa-user"></i>editer (公众号管理员) <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="" target="_blank"><i class="fa fa-weixin fa-fw"></i> 我的账号</a></li>
                    <li><a href=""><i class="fa fa-sign-out fa-fw"></i> 退出系统</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>

<div class="container-fluid">

    <div class="row">
        <div class="col-lg-2">
            <div id="searchMenu">
                <input class="form-control input-lg" style="border-radius:0; font-size:14px; height:43px;"
                       placeholder="输入菜单名称可快速查找" type="text">
            </div>


            <?php if($formatMenus):?>
                <div class="panel panel-default panel-leftbar">
                <?php foreach($formatMenus as $groupname=>$group):?>
                    <div class="panel-heading">
                        <h4 class="panel-title"><?=$groupname?></h4>
                        <a class="panel-collapse collapsed pjax-link" data-toggle="collapse" href="#group_<?=$groupname?>">
                            <i class="iconfont icon-jiantou-copy"></i>
                        </a>
                    </div>

                    <ul class="list-group collapse in" id="group_<?=$groupname?>">
                        <?php foreach($group as $k=>$v):?>
                            <li class="list-group-item">
                                <a class="pjax-link" href="<?=$v['url']?>">
                                    <?=$v['name']?>
                                    <i class="glyphicon glyphicon-plus pull-right"></i>
                                </a>
                            </li>
                        <?php endforeach;?>

                    </ul>
                <?php endforeach;?>
                </div>
            <?php endif;?>

        </div>
        <div class="col-lg-10">

            <?= $content; ?>
            <div class="loading"></div>


        </div>
    </div>


</div>



<?php Modal::begin([
    "id" => "ajaxModal",
    "footer" => "", // always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>


<?php $this->endBody() ?>
<link href="<?= Yii::getAlias('@web/') ?>statics/admin/css/admin_layout.css?v=<?=$version?>" rel="stylesheet"/>
<link href="<?= Yii::getAlias('@web/') ?>statics/common/iconfont/iconfont.css?v=<?=$version?>" rel="stylesheet">


<script src="<?= Yii::getAlias('@web/') ?>statics/common/js/yan.js?v=<?=$version?>"></script>
<script src="<?= Yii::getAlias('@web/') ?>statics/admin/js/common.js?v=<?=$version?>"></script>
<script src="<?= Yii::getAlias('@web/statics/common/js/modalRemote.js?v=<?=$version?>') ?>"></script>

<script>


    $(function () {

        if ($('#ajaxModal').length > 0) {
            modal = new ModalRemote('#ajaxModal');
            $(document).on('click', '[role=modal-remote]', function (e) {
                e.preventDefault();
                modal.remote(this, null);
            });
        }
    })


</script>

</body>
</html>
<?php $this->endPage() ?>
