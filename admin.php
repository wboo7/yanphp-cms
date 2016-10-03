<?php

function pre($arr)
{
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
define('ROOT_PATH', __DIR__);

require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/common/config/bootstrap.php');
require(__DIR__ . '/admin/config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/common/config/main.php'),
    require(__DIR__ . '/common/config/main-local.php'),
    require(__DIR__ . '/common/config/database.php'),
    require(__DIR__ . '/admin/config/main.php'),
    require(__DIR__ . '/admin/config/main-local.php')
);

$application = new yii\web\Application($config);

$application->run();
