<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

define('DS',DIRECTORY_SEPARATOR);
define('ROOT_PATH',dirname(__DIR__).DS);

require(ROOT_PATH . 'vendor/yiisoft/yii2/Yii.php');
require(ROOT_PATH . 'common/config/bootstrap.php');
require(ROOT_PATH . 'frontend/config/bootstrap.php');

require_once(ROOT_PATH.'common/helpers/File.php');
use common\helpers\File;

header('Content-type:text/html;charset=UTF-8');
if(file_exists('lock.txt'))
{
    exit('初始化文件已被锁定，如需初始化，请删除initdata中的lock.txt');
}
File::xCopy('install',ROOT_PATH.'frontend'.DS.'modules'.DS.'install',true);
File::xCopy('views',ROOT_PATH.'frontend'.DS.'modules'.DS.'content'.DS.'views',true);
File::xCopy('uploads',ROOT_PATH.'uploads',true);
File::xCopy('statics',ROOT_PATH.'statics',true);
touch('lock.txt');
echo "初始化成功O(∩_∩)O哈哈~";