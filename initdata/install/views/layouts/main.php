<!doctype html>
<html>
<head>
    <meta charset="UTF-8" />
    <title><?php echo 'YANPHP内容管理系统'; ?> - <?php echo 'Powered by www.yanphp.com'; ?></title>
    <link rel="stylesheet" href="<?= Yii::getAlias('@web/')?>frontend/modules/install/css/install.css?v=9.0" />
</head>
<body>
<div class="wrap">
    <div class="header">
        <h1 class="logo">YANPHP-安装</h1>
        <div class="icon_install">安装向导</div>
        <div class="version"><?php echo VERSION;?></div>
    </div>

<?= $content;?>

    <div class="footer"> &copy; 2010-2015 <a href="http://www.yanphp.com" target="_blank">www.yanphp.com</a> @_wb </div>
</body>
</html>