<?php use common\helpers\Dispatch;use common\models\Config; $dp = new Dispatch();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="keywords" content="<?php echo $keywords;?>">
    <meta name="description" content="<?php echo $description;?>">
    <meta name="author" content="YANPHP">

    <title><?php echo $title;?></title>


    <link href="/yancms/statics/common/css/bootstrap.css" rel="stylesheet">
    <link href="/yancms/statics/common/css/content.css" rel="stylesheet">
    <link href="/yancms/statics/common/css/animate.css" rel="stylesheet">
    <link href="/yancms/statics/common/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <script src="/yancms/statics/common/js/jquery.js"></script>
    <script src="/yancms/statics/common/js/bootstrap.js"></script>
    <script src="/yancms/statics/common/js/require.js"></script>
    <script src="/yancms/statics/common/js/yan.js"></script>
    <script src="/yancms/statics/common/js/common.js"></script>
    <script>requirejs.config({
        baseUrl:'/yancms/statics/',
        paths:{
            "jquery":"common/js/jquery"
        },
        map: {
            '*': {
                'css': 'common/js/require-css'
            }
        }

    });</script>

    <!--[if lt IE 9]>
    <script src="/yancms/statics/common/js/html5shiv.min.js"></script>
    <script src="/yancms/statics/common/js/respond.min.js"></script>
    <![endif]-->


    
    
    <!-- manager start --><!-- manager end -->



</head>
<body>
<nav class="navbar navbar-inverse navbar-1470106320">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a href=""><img style="height: 50px;" src="<?= Config::getValue('logo',true)?>"></a>
        </div>
        <div class="collapse navbar-collapse">
            <?php $data = $dp->run('content','action="category" pid="0" ismenu="1"'); ?>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/yancms/index.php/content/default/index">首页</a></li>
                <?php if(is_array($data['lists'])) foreach($data['lists'] AS $sub) { ?>
                    <?php if($sub['children']) { ?>

                            <li class="dropdown">
                                <a data-toggle="dropdown" data-hover="dropdown" data-submenu="">
                                    <?php echo $sub['catname'];?><span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <?php if(is_array($sub['children'])) foreach($sub['children'] AS $sub2) { ?>
                                        <?php if($sub2['children']) { ?>

                                                <li class="dropdown-submenu">
                                                    <a data-hover="dropdown"><?php echo $sub2['catname'];?></a>
                                                    <ul class="dropdown-menu">
                                                        <?php if(is_array($sub2['children'])) foreach($sub2['children'] AS $sub3) { ?>
                                                        <li><a href="<?php echo $sub3['url'];?>"><?php echo $sub3['catname'];?></a></li>
                                                        <?php }?>

                                                    </ul>
                                                </li>

                                        <?php } else { ?>
                                            <li><a href="<?php echo $sub2['url'];?>"><?php echo $sub2['catname'];?></a></li>
                                        <?php } ?>

                                    <?php }?>

                                </ul>
                            </li>

                    <?php } else { ?>
                         <li><a href="<?php echo $sub['url'];?>"><?php echo $sub['catname'];?></a></li>
                    <?php } ?>

                <?php }?>

            </ul>
            <?php unset($data);?>

        </div>
    </div>

</nav>


<section class="banner1469619971">
     <div class="container" style="max-width: 1200px;">
         <h4>关于我们</h4>
         <h5>我们是一群有梦想，有激情的团队！</h5>

     </div>

</section>



<div class="container map1469260589" style="margin-top: 20px;">


    <div class="row ">
        <div class="col-md-4">
            <h3>联系我们 <span>ContactUs</span></h3>
            <p>您能给我们多少信任，我们就能给你多大惊喜！为了便于我们更好的服务于您，请留下您宝贵的建议！</p>
        </div>
        <div class="col-md-8">
           <div><?php echo $category['content'];?></div>
            <div id="allmap"></div>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=4SvbXrNBgt1bj0SdWvsTxlVUYtfT0kB0"></script>
<script type="text/javascript" src="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.js"></script>
<link rel="stylesheet" href="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.css" />



<div class="container">
   <hr>
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright © Your Website 2014</p>
            </div>
        </div>
    </footer>


</div>







<script src="/yancms/statics/content/js/site.js"></script>
<link href="/yancms/statics/content/css/style.css" rel="stylesheet">
</body>
</html>


