<?php
  /**
 * @link http://www.yanphp.com/
 * @copyright Copyright (c) 2016 YANPHP Software LLC
 * @license http://www.yanphp.com/license/
 */
namespace frontend\extensions;
use yii\base\Component;
use yii\helpers\Url;
class Parser extends Component{

    function init()
    {

    }
    public function parse($str)
    {

        $root = \Yii::getAlias('@web/');
        $str = preg_replace_callback("/\{url:(\w+)([^}]+)?\}/i", function ($match) {
            return $this->createUrl($match);
        }, $str);

        //路劲
        $str = preg_replace("/{config:(.*?)}/", "<?= Config::getValue('\\1',true)?>", $str);
        $str = preg_replace("/\{__ROOT__}/", $root, $str);
        $str = preg_replace("/\{__COMMON__}/", $root.'statics/common/', $str);
        $str = preg_replace("/\{__IMG__}/", $root.'statics/content/images/', $str);
        $str = preg_replace("/\{__CSS__}/", $root.'statics/content/css/', $str);
        $str = preg_replace("/\{__JS__}/", $root.'statics/content/js/', $str);

        $str = preg_replace("/\{pre\s+(.+?)\}/", "<?php pre(\\1);?>", $str);
        $str = preg_replace("/\{if\s+(.+?)\}/", "<?php if(\\1) { ?>", $str);
        $str = preg_replace("/\{else\}/", "<?php } else { ?>", $str);
        $str = preg_replace("/\{elseif\s+(.+?)\}/", "<?php } elseif (\\1) { ?>", $str);
        $str = preg_replace("/\{\/if\}/", "<?php } ?>", $str);

        //for 循环
        $str = preg_replace("/\{for\s+(.+?)\}/", "<?php for(\\1) { ?>", $str);
        $str = preg_replace("/\{\/for\}/", "<?php } ?>", $str);

        //++ --
        $str = preg_replace("/\{\+\+(.+?)\}/", "<?php ++\\1; ?>", $str);
        $str = preg_replace("/\{\-\-(.+?)\}/", "<?php ++\\1; ?>", $str);
        $str = preg_replace("/\{(.+?)\+\+\}/", "<?php \\1++; ?>", $str);
        $str = preg_replace("/\{(.+?)\-\-\}/", "<?php \\1--; ?>", $str);
        $str = preg_replace("/\{loop\s+(\S+)\s+(\S+)\}/", "<?php if(is_array(\\1)) foreach(\\1 AS \\2) { ?>", $str);
        $str = preg_replace("/\{loop\s+(\S+)\s+(\S+)\s+(\S+)\}/", "<?php  if(is_array(\\1)) foreach(\\1 AS \\2 => \\3) { ?>", $str);
        $str = preg_replace("/\{\/loop\}/", "<?php }?>", $str);
        $str = preg_replace("/\{([a-zA-Z_][a-zA-Z0-9_:]*\(([^{}]*)\))\}/", "<?php echo \\1;?>", $str);
        /*   $str = preg_replace("/\{\\$([a-zA-Z_][a-zA-Z0-9_:]*\(([^{}]*)\))\}/", "<?php echo \\1;?>", $str);*/
        $str = preg_replace("/\{(\\$[a-zA-Z_][a-zA-Z0-9_+\-\*\/]*)\}/", "<?php echo \\1;?>", $str);
        $str = preg_replace("/\{(\\$[a-zA-Z0-9_\[\]\'\"\$]+)\}/s", "<?php echo \\1;?>", $str);
        $str = preg_replace("/\{([A-Z_][A-Z0-9]*)\}/s", "<?php echo \\1;?>", $str);
        $str = preg_replace('~{(\$dp->.*?)}~', "<?php echo \\1;?>", $str);

        $str = preg_replace_callback("/\{yan:(\w+)\s+([^}]+)\}/i", function ($match) {
            return $this->yan_tag($match[1], $match[2], $match[0]);

        }, $str);


        $str = preg_replace_callback("/\{\/yan\}/i", function ($match) {
            return $this->end_yan_tag();
        }, $str);
        return $str;

    }

    public  function yan_tag($op, $data, $html)
    {
        $arr = ['$catid','$page','$parentid','$title'];

        foreach($arr as $v)
        {
            $data = preg_replace('~\\'.$v.'~',"'.".$v.".'",$data);
        }

        $str = '$data = $dp->run('."'".$op."'".','."'".$data."'".');';
        return "<?php ".$str." ?>";
    }

    /**
     * PC标签结束
     */
    public function end_yan_tag()
    {
        return '<?php unset($data);?>';
    }
    public function  createUrl($m)
    {
        $url = $m[1];
        $param = [];
        $param[] = $url;
        if(isset($m[2]))
        {
            preg_match_all("/([a-z]+)\=[\"\']?([^\"\']+)[\"\']?/i", stripslashes($m[2]), $matches, PREG_SET_ORDER);
            foreach($matches as $v)
            {
                $param[$v[1]] = $v[2];
            }
        }

        return Url::to($param);

    }
}