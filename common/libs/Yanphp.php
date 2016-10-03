<?php
namespace common\libs;
use common\models\Config;
use Yii;
class Yanphp
{

    const  VERSION = 1;
    /*
     *  注册后台main中的资源
     * */
    public static function registerMainHeader()
    {
        $version = self::VERSION;
        $root = Yii::getAlias('@web');
        $str = <<<EOT


          <link href="{$root}statics/common/css/bootstrap.css?v{$version}" rel="stylesheet" />

    <script>
        var JS_ROOT= "{$root}",
            JS_VERSION ="20141218";

    </script>
    <script src="{$root}statics/common/js/yan.js?v{$version}"></script>
    <script src="{$root}statics/common/js/jquery.js?v{$version}"></script>
EOT;
        echo $str;

    }

    /*
 *  注册后台main中的资源
 * */
    public static function registerMainFooter()
    {
        $version = self::VERSION;
        $root = Yii::getAlias('@web/');
        $str = <<<EOT
<script src="{$root}statics/admin/js/common.js?v{$version}"></script>
<script src="{$root}statics/common/js/bootstrap.js?v{$version}"></script>
<link href="{$root}statics/admin/css/admin_style.css?v{$version}" rel="stylesheet" />
EOT;
        echo $str;

    }

    public static function getCommonUrl($url = null)
    {
        $ret = \Yii::getAlias('common');
        if ($url != null) {
            return $ret . $url;
        }
        return $ret;
    }

    static function string2array($data)
    {

        $array = [];
        if ($data == '') return array();

        @eval("\$array = $data;");

        return $array;
    }

    static function array2string($data, $isformdata = 1)
    {
        if ($data == '') return '';
        if ($isformdata) $data = self::new_stripslashes($data);
        return addslashes(var_export($data, TRUE));
    }

    /**
     * 返回经stripslashes处理过的字符串或数组
     * @param $string 需要处理的字符串或数组
     * @return mixed
     */
    static function new_stripslashes($string)
    {
        if (!is_array($string)) return stripslashes($string);
        foreach ($string as $key => $val) $string[$key] = self::new_stripslashes($val);
        return $string;
    }

    static function getRoot()
    {
        return \Yii::getAlias('@web/');
    }
    public static function getCache($key)
    {
        $cache = Yii::$app->cache;
        return $cache->get($key);
    }
    public static function setCache($key, $value, $duration = 0, $dependency = null)
    {
        $cache = Yii::$app->cache;
        return $cache->set($key, $value,$duration,$dependency);
    }
    public static function deleteCache($key)
    {
        $cache = Yii::$app->cache;
        $cache->delete($key);
    }
    public static function flushCache()
    {
        $cache = Yii::$app->cache;
        $cache->flush();
    }

    public static function  getConfigValue($id,$fromCache=false)
    {
        return Config::getValue($id,$fromCache);
    }

    public static function strcut($string, $length, $etc = '...')
    {
        $result = '';
        $string = html_entity_decode(trim(strip_tags($string)), ENT_QUOTES, 'UTF-8');
        $strlen = strlen($string);
        for ($i = 0; (($i < $strlen) && ($length > 0)); $i++)
        {
            if ($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))), 8, '0', STR_PAD_LEFT), '0'))
            {
                if ($length < 1.0)
                {
                    break;
                }
                $result .= substr($string, $i, $number);
                $length -= 1.0;
                $i += $number - 1;
            }
            else
            {
                $result .= substr($string, $i, 1);
                $length -= 0.5;
            }
        }
        $result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
        if ($i < $strlen)
        {
            $result .= $etc;
        }
        return $result;
    }



}

?>