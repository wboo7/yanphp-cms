<?php
namespace common\libs;

use Yii;

class Bridge
{
    public static function getRootPath()
    {

        return Yii::getAlias('@webroot/');
    }
    public static function getViewPath()
    {
       return Yii::getAlias('@webroot/').'frontend/modules/content/views/';
    }

    public static function getRootUrl()
    {

        return Yii::getAlias('@web/');

    }

    public static function frontUrl()
    {
        return Yii::getAlias('@web/index.php');
    }

    public static function setCatchPath()
    {

    }

    public static function getConfigFile()
    {

        return Yii::getAlias('@webroot/admin/config/main.php');
    }
    public static function createTpl($file)
    {

        touch($file);
        $str = <<<EOF
{template 'header.html'}
{template 'footer.html'}

EOF;
        file_put_contents($file,$str);

    }

}

?>