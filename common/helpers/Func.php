<?php
namespace common\helpers;
use common\libs\qrcode\QRcode;
use Yii;
/*
 * 文件目录操作类
 * */
class Func{
    public static function qrcode($data)
    {

        $data = Yii::$app->request->getHostInfo().$data;
        $filename = md5($data).'.png';
        $outfile = Yii::getAlias('@webroot/data/ewm/').$filename;

        QRcode::png($data,$outfile);
        return Yii::getAlias('@web/data/ewm/').$filename;

    }
    public static function pastTime($point)
    {
        $past = time()-$point;
        $posive = $past>0 ? true : false;
        $past = abs($past);

        if($past>24*3600)
        {
            $str = ceil($past/(24*3600)).'天';
        }
        elseif($past>3600)
        {
            $str = ceil($past/3600).'小时';
        }
        elseif($past>60)
        {
            $str = ceil($past/60).'分钟';
        }
        else
        {
            $str = $past.'秒';
        }
        if($posive)
        {
            return $str.'前';
        }
        else
        {
            return $str;
        }

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

    //创建唯一订单号
    public static function createOrderNo()
    {
        return 'HD'.date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }

    public static function getExtension($string)
    {
        $arr = explode('.',$string);
        return end($arr);

    }
}
?>