<?php

use yii\helpers\Html;
use common\libs\Yanphp;
use common\models\AdminMenu;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;


$this->title = Yii::t('app','CMS|Yanphp CMS');
$version = Yii::$app->params['assetVersion'];

$controller = $this->context->id;
$action = $this->context->action->id;
$r=$controller.'/'.$action;


$menus = [
    Yii::t('app','Home')=>[
        'icon'=>'glyphicon glyphicon-home',
        'url'=>'site/index',
        'params'=>'',
        'child'=>[]
    ],
    Yii::t('app','Content')=>[
        'icon'=>'fa fa-desktop',
        'url'=>'',
        'params'=>'',
        'child'=>[
            [ 'name'=>Yii::t('app','Content Manage'),'url'=>'content/index','params'=>'','sub'=>['content/create']],
            [ 'name'=>Yii::t('app','Position Manage'),'url'=>'position/index','params'=>'','sub'=>['position/create','position/lists']]
        ]
    ],
    Yii::t('app','Category')=>[
        'icon'=>'fa fa-sitemap',
        'url'=>'',
        'params'=>'',
        'child'=>[
            [ 'name'=>Yii::t('app','Category Manage'),'url'=>'category-content/index','params'=>'','sub'=>['category-content/create']],
            [ 'name'=>Yii::t('app','Model Manage'),'url'=>'model/index','params'=>'','sub'=>['model/create']]
        ]
    ],
    Yii::t('app','System')=>[
        'icon'=>'fa fa-cube',
        'url'=>'',
        'params'=>'',
        'child'=>[
            [ 'name'=>Yii::t('app','System Setting'),'url'=>'system/setting','params'=>''],
            [ 'name'=>Yii::t('app','Site Config'),'url'=>'config/index','params'=>'','sub'=>['config/create']],
            [ 'name'=>Yii::t('app','Password Manage'),'url'=>'system/password','params'=>'','sub'=>[]],
            [ 'name'=>Yii::t('app','Permission Manage'),'url'=>'permission/index','params'=>'','sub'=>[]],
        ]
    ],

    Yii::t('app','Module')=>[
        'icon'=>'glyphicon glyphicon-tasks',
        'url'=>'',
        'params'=>'',
        'child'=>[
            [ 'name'=>Yii::t('app','Banner'),'url'=>'banner/index','params'=>'','sub'=>['banner/create']],
            [ 'name'=>Yii::t('app','Friend Link'),'url'=>'friend/index','params'=>'','sub'=>['friend/create','friend/update']],
            [ 'name'=>Yii::t('app','Form Guide'),'url'=>'form/index','params'=>'','sub'=>[
                'form/add',
                'form/create',
                'form/update',
                'form/lists',
                'form/manage',
            ]],

        ]
    ],
];
foreach($menus as $k=>$v)
{
    if($v['child'])
    {
        foreach($v['child'] as $k2=>$v2)
        {
            if(!\common\models\AdminAction::canAction($v2['url']))
            {
                unset($menus[$k]['child'][$k2]);
            }
        }
    }

}

foreach($menus as $k=>$v)
{
    if($v['url'] == '' && !$v['child'])
    {
        unset($menus[$k]);
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

    <link href="<?= Yii::getAlias('@web/') ?>statics/common/css/bootstrap.css?v=<?= $version ?>" rel="stylesheet"/>
    <link href="<?= Yii::getAlias('@web/') ?>statics/common/font-awesome/css/font-awesome.min.css?v=<?= $version ?>" rel="stylesheet"/>
    <link href="<?= Yii::getAlias('@web/') ?>statics/common/css/animate.min.css?v=<?= $version ?>" rel="stylesheet"/>

    <link rel="icon" type="image/vnd.microsoft.icon" href="<?=Yii::getAlias('@web/statics/admin/images/fav.ico')?>"/>
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
    <script src="<?= Yii::getAlias('@web/') ?>statics/common/js/jquery.js?v=<?= $version ?>"></script>
    <script src="<?= Yii::getAlias('@web/statics/common/js/bootstrap.js?v=<?=$version?>') ?>"></script>

    <script src="<?= Url::to('@web/statics/common/js/require.js')?>"></script>
    <script>
        requirejs.config({
            enforceDefine: true,
            baseUrl:"<?=Yii::getAlias('@web/')?>statics/",
            map: {
                '*': {
                    'css': 'common/js/require-css'
                }
            }

        });
        require(['common/js/modalRemote'],function(ModalRemote){
            $(function(){
                if($('#ajaxModal').length>0)
                {
                    modal= new ModalRemote('#ajaxModal');
                    $(document).on('click','[role=modal-remote]',function(e){
                        e.preventDefault();
                        modal.remote(this,null);
                    });
                }
            });
        });

    </script>



    <?php $this->head() ?>
</head>
<body class="nav_md">
<?php $this->beginBody() ?>
<div class="left_col">
    <div class="logo_area">
        <img class="logo_icon" src="<?=Yii::getAlias('@web/statics/admin/images/logo_icon.png')?>">
        <img class="logo" src="<?=Yii::getAlias('@web/statics/admin/images/logo.png')?>">
    </div>
    <ul id="menus" class="site_menu clearfix">

        <?php foreach($menus as $k=>$v):?>
            <li <?php if($r==$v['url']){echo 'class="active"';}?>>
                <a href="<?php if($v['url']){echo '?r='.$v['url'];}else{echo 'javascript:;';}?>"><i class="<?=$v['icon']?>"></i> <?=$k?><span class="fa fa-chevron-down pull-right"></span></a>
                <?php if($v['child']):?>
                    <ul class="child_menu" style="display: none;">
                        <?php foreach($v['child'] as $v2):?>
                            <li <?php if($r==$v2['url'] || (isset($v2['sub']) && in_array($r,$v2['sub']))){echo 'class="current_page"';}?>><a href="?r=<?=$v2['url']?>"><?=$v2['name']?></a></li>
                        <?php endforeach;?>
                    </ul>
                <?php endif;?>
            </li>
        <?php endforeach;?>

    </ul>

    <div class="sidebar-footer hidden-small" title="黑板报设置">
        <a data-url="" role="modal-remote">
            <span class="glyphicon glyphicon-cog" ></span>
        </a>
        <a href="<?=Yii::getAlias('@web/index.php/content')?>" target="_blank" title="<?=Yii::t('app','Go To Home')?>">
            <span class="glyphicon glyphicon-send" ></span>
        </a>
        <a href="" title="<?=Yii::t('app','Clean Up')?>">
            <span class="glyphicon glyphicon-leaf" ></span>
        </a>
        <a href="?r=site/logout" title="<?=Yii::t('app','Logout')?>">
            <span class="glyphicon glyphicon-off" ></span>
        </a>
    </div>

</div>
<div class="top_nav clearfix">
    <div class="top_nav_menu">
        <div class="top_nav_toggle">
            <a id="menu_toggle">
                <i style="font-size:26px;" class="glyphicon glyphicon-menu-hamburger"></i>
            </a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                    <img src="<?=Yii::getAlias('@web/statics/admin/images/admin.png')?>" alt=""><?=Yii::$app->user->identity->username?>
                    <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">


                    <li><a target="_blank" href="<?=\common\libs\Bridge::frontUrl()?>"><?=Yii::t('app','Frontend')?></a></li>
                    <li><a href="?r=site/logout"><i class="glyphicon glyphicon-envelope pull-right"></i> <?=Yii::t('app','Logout')?></a></li>
                </ul>
            </li>


        </ul>
    </div>


</div>

<div class="right_col">
    <?= $content ?>
</div>
<footer>
    <div class="pull-right">
        <?=Yii::t('app','Content Manage System')?> - Construct by <a target="_blank" href="http://www.yanphp.com">YANPHP</a>
    </div>
    <div class="clearfix"></div>
</footer>



<?php Modal::begin([
    "id" => "ajaxModal",
    "footer" => "", // always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>


<?php $this->endBody() ?>
<link href="<?= Yii::getAlias('@web/') ?>statics/admin/css/admin_layout.css?v=<?= $version ?>" rel="stylesheet"/>
<link href="<?= Yii::getAlias('@web/') ?>statics/common/iconfont/iconfont.css?v=<?= $version ?>" rel="stylesheet">


<script src="<?= Yii::getAlias('@web/') ?>statics/common/js/yan.js?v=<?= $version ?>"></script>
<script src="<?= Yii::getAlias('@web/') ?>statics/admin/js/common.js?v=<?= $version ?>"></script>

<script>

    $(function () {



        var $menus = $('#menus'),
            $body = $('body'),
            $sitebar_menu = $('#sidebar_menu'),
            $top_nav_menu = $('.top_nav_menu'),
            $left_col = $('.left_col'),
            $right_col = $('.right_col'),
            $sitebar_footer = $('.sidebar-footer'),
            $menu_toggle = $('#menu_toggle'),
            $current_page = $('.current_page');
        $footer = $('footer');

        var setContentHeight = function () {
            // reset height
            $right_col.css('min-height', $(window).height());

            var bodyHeight = $body.outerHeight(),
                footerHeight = $body.hasClass('footer_fixed') ? 0 : $footer.height(),
                leftColHeight = $left_col.eq(1).height() + $sitebar_footer.height(),

                contentHeight = bodyHeight < leftColHeight ? leftColHeight : bodyHeight;

            // normalize content

            contentHeight -= $top_nav_menu.height() + footerHeight;

            $right_col.css('min-height', contentHeight);
        };


        $current_page.parent('ul').show(0,function(){
            setContentHeight();
        }).parent('li').addClass('active');;


        setContentHeight();

        $(window).resize(function(){
            setContentHeight();
        });

        $menus.find('a').on('click',function(){
            var $li = $(this).parent();
            if($li.is('.active'))
            {
                $li.removeClass('active');
                $('ul:first',$li).slideUp(function(){
                    setContentHeight();
                });
            }
            else
            {

                if (!$li.parent().is('.child_menu')) {
                    $menus.find('li').removeClass('active');
                    $menus.find('li ul').slideUp();
                }
                $li.addClass('active');
                $('ul:first', $li).slideDown(function() {
                    setContentHeight();
                });
            }
        });
        $menu_toggle.on('click',function(){
            if ($body.hasClass('nav_md')) {
                $menus.find('li.active ul').hide();
                $menus.find('li.active').addClass('active_sm').removeClass('active');
            } else {
                $menus.find('li.active_sm ul').show();
                $menus.find('li.active_sm').addClass('active').removeClass('active_sm');
            }

            $body.toggleClass('nav_md nav_sm');
            setContentHeight();


        });



    })







</script>

</body>
</html>
<?php $this->endPage() ?>
