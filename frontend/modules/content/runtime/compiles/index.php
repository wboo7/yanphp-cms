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




<div class="container-fluid">


    <section class="slide1469750650 row">
        <ul class="rslides" id="slider2">
            <li>
                <a href="#">
                    <img src="/statics/content/images/1.jpg" alt="">

                </a>
            </li>
            <li><a href="#"><img src="/statics/content/images/2.jpg" alt=""></a></li>
            <li><a href="#"><img src="/statics/content/images/3.jpg" alt=""></a></li>
        </ul>
    </section>


</div>

<div class="title1470483236">
    <div class="container" style="max-width: 1200px;">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">最新动态</h3>
                <h5 class="text-center">为你提供最及时的公司资讯，你的满意是我们最大的快乐</h5>
            </div>
        </div>
    </div>
</div>

<div class="container show1470286236" style="max-width: 1200px;margin-top: 20px;">
	<div class="row">
		<div class="col-md-4 col-xs-12">
             <div class="box">
                 <h3>媒体报道<a href="">more</a></h3>
                 <ul>
                     <li><a href="article_2310.html">为什么企业要建营销型企业网站</a><span>2016-06-14</span></li>
                     <li><a href="article_2309.html">互联网思维到底是什么？</a><span>2016-06-14</span></li>
                     <li><a href="article_2283.html">互联网时代，网络营销为企业竞争力</a><span>2016-06-14</span></li>
                     <li><a href="article_2278.html">新浪报道司慧网络PEM精准化营销</a><span>2016-06-14</span></li>
                     <li><a href="article_2277.html">网易新闻专访：对话司慧网络创始人</a><span>2016-06-14</span></li>
                     <li><a href="article_2277.html">网易新闻专访：对话司慧网络创始人</a><span>2016-06-14</span></li>
                 </ul>
             </div>
        </div>
        <div class="col-md-4 col-xs-12">
            <div class="box simple-slide">
                <h3>最新案例</h3>
                <div class="box2 slide-item">
                    <img src="/statics/content/images/1.jpg" class="img-responsive">
                    <h4>东方照明</h4>
                    <div class="box2-txt">
                        “司慧网络坐落于东方魔都---上海。专注于网站建设，工于营销，以建营销型网站见长，并以网站托管为特色，司慧网络，智慧的选择。”
                    </div>
                </div>

                <div class="box2 slide-item" style="display: none;">
                    <img src="/statics/content/images/1.jpg" class="img-responsive">
                    <h4>东方照明3</h4>
                    <div class="box2-txt">
                        “司慧网络坐落于东方魔都---上海。专注于网站建设，工于营销，以建营销型网站见长，并以网站托管为特色，司慧网络，智慧的选择。”
                    </div>
                </div>

                <div class="box2 slide-item" style="display: none;">
                    <img src="/statics/content/images/1.jpg" class="img-responsive">
                    <h4>东方照明4</h4>
                    <div class="box2-txt">
                        “司慧网络坐落于东方魔都---上海。专注于网站建设，工于营销，以建营销型网站见长，并以网站托管为特色，司慧网络，智慧的选择。”
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-4 col-xs-12">
            <div class="box">
                <h3>品牌故事</h3>
                <div class="box2">
                    <img src="/statics/content/images/1.jpg" class="img-responsive">
                    <div class="box2-txt">
                        “司慧网络坐落于东方魔都---上海。专注于网站建设，工于营销，以建营销型网站见长，并以网站托管为特色，司慧网络，智慧的选择。”
                    </div>
                    <div class="box2-footer">立足上海，辐射全国<a href="">more</a></div>
                </div>

            </div>
        </div>


	</div>
</div>

<div class="container show1468722362" style="margin-top: 20px;">
   <div class="row">
       <div class="col-md-12 text-center">
           <h4>最新动态</h4>
           <h6>为了能实现“提供百分之百满意的客户服务”的诺言，我们配备了专业的管理人员，在全国更有</h6>
           <h6>队伍庞大的技术人员和维修人员，为用户提供完善的售后服务</h6>
           <h6 style="margin-bottom: 20px;"><i></i> <span></span> <i></i></h6>
       </div>
   </div>

   <div class="row ">
       <div class="col-md-3 col-xs-6">
          <a href=""><img class="img-responsive lazy" data-original="/statics/content/images/1.png"></a>
          <h5>高血压病的危险因素有哪些</h5>
          <h6>2016/03/03</h6>
           <p>1.高钠盐饮食 盐与高血压有关的主要证据，来自人群间的比较研究。限制高血压病人摄钠（食盐与含钠食......</p>
       </div>

       <div class="col-md-3 col-xs-6">
           <a href=""><img class="img-responsive lazy" data-original="/statics/content/images/2.png"></a>
           <h5>高血压病的危险因素有哪些</h5>
           <h6>2016/03/03</h6>
           <p>1.高钠盐饮食 盐与高血压有关的主要证据，来自人群间的比较研究。限制高血压病人摄钠（食盐与含钠食......</p>
       </div>

       <div class="col-md-3 col-xs-6">
           <a href=""><img class="img-responsive lazy" data-original="/statics/content/images/3.png"></a>
           <h5>高血压病的危险因素有哪些</h5>
           <h6>2016/03/03</h6>
           <p>1.高钠盐饮食 盐与高血压有关的主要证据，来自人群间的比较研究。限制高血压病人摄钠（食盐与含钠食......</p>
       </div>

       <div class="col-md-3 col-xs-6">
           <a href=""><img class="img-responsive lazy" data-original="/statics/content/images/4.png"></a>
           <h5>高血压病的危险因素有哪些</h5>
           <h6>2016/03/03</h6>
           <p>1.高钠盐饮食 盐与高血压有关的主要证据，来自人群间的比较研究。限制高血压病人摄钠（食盐与含钠食......</p>
       </div>


   </div>
    <div class="row">
        <div class="col-md-12 text-center">
           <a href="" class="btnMore">查看更多</a>
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


