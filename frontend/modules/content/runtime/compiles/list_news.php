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


    <link href="/statics/common/css/bootstrap.css" rel="stylesheet">
    <link href="/statics/common/css/animate.css" rel="stylesheet">
    <link href="/statics/common/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <script src="/statics/common/js/jquery.js"></script>
    <script src="/statics/common/js/bootstrap.js"></script>
    <script src="/statics/common/js/require.js"></script>

    <script>requirejs.config({
        baseUrl:'/statics/',
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
    <script src="/statics/common/js/html5shiv.min.js"></script>
    <script src="/statics/common/js/respond.min.js"></script>
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
                <li><a href="/index.php/content">首页</a></li>
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


<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col-md-3">
            <?php $data = $dp->run('content','action="category" pid="'.$parentid.'"'); ?>
            <ul class="list1457596329">
                <?php if(is_array($data['lists'])) foreach($data['lists'] AS $r) { ?>
                <li>
                    <?php if($r['children']) { ?>
                    <a data-toggle="collapse" href="#collapse<?php echo $r['id'];?>"><?php echo $r['catname'];?></a>
                    <ul class="collapse in" id="collapse<?php echo $r['id'];?>">
                        <?php if(is_array($r['children'])) foreach($r['children'] AS $sub) { ?>
                        <li>
                            <?php if($sub['children']) { ?>
                            <a data-toggle="collapse" href="#collapse<?php echo $sub['id'];?>"><?php echo $sub['catname'];?></a>
                            <ul class="collapse in" id="collapse<?php echo $sub['id'];?>">
                                <?php if(is_array($sub['children'])) foreach($sub['children'] AS $ssub) { ?>
                                    <li><a href="<?php echo $ssub['url'];?>"><?php echo $ssub['catname'];?></a></li>
                                <?php }?>
                            </ul>
                            <?php } else { ?>
                            <a href="<?php echo $sub['url'];?>"><?php echo $sub['catname'];?></a>
                            <?php } ?>
                        </li>
                        <?php }?>

                    </ul>
                    <?php } else { ?>
                    <a href="<?php echo $r['url'];?>"><?php echo $r['catname'];?></a>
                    <?php } ?>
                </li>
                <?php }?>

            </ul>
            <?php unset($data);?>

        </div>

        <div class="col-md-9">
            <div class="row">
                <ul class="breadcrumb list1457596329_2">
                    <li><span class="glyphicon glyphicon-home"></span> <a href="/index.php/content/default/index">首页</a></li>
                    <?php if($category['parents']) { ?>
                    <?php if(is_array($category['parents'])) foreach($category['parents'] AS $r) { ?>
                    <li><a href="<?php echo $r['url'];?>"><?php echo $r['catname'];?></a></li>
                    <?php }?>
                    <?php } ?>

                    <li><a href="<?php echo $category['url'];?>"><?php echo $category['catname'];?></a></li>

                </ul>
            </div>

            <?php $data = $dp->run('content','action="lists" catid="'.$catid.'" num="15" pageStyle="pagination_simple" nextPageLabel="下页" prevPageLabel="上页"'); ?>
            <ul class="list1457596329_3">
                <?php if(is_array($data['lists'])) foreach($data['lists'] AS $r) { ?>
                <li>
                    <h5><a href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a><span class="pull-right"><?php echo $dp->date('Y/m/d',$r['created_at']);?></span></h5>

                </li>
                <?php }?>

            </ul>
            <?php echo $data['pages'];?>
            <?php unset($data);?>
        </div>


    </div>


</div>

</div>
</div>



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







<script src="/statics/content/js/site.js"></script>
<link href="/statics/content/css/style.css" rel="stylesheet">
</body>
</html>


