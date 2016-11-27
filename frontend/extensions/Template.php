<?php
namespace frontend\extensions;
use Yii;
use common\libs\Yanphp;
use common\models\Content;
use common\models\CategoryContent;
use common\models\Node;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Url;

use yii\web\View;
use yii\base\ViewRenderer;

use yii\base\InvalidConfigException;
use yii\base\ErrorException;
use common\helpers\ManagerHelper;

class Template extends ViewRenderer
{

    public $app;
    public $config_vars;
    public $compile_dir;
    public $compile_url;
    public $tVars;
    public $nodes;

    public $viewPath;
    public $parser;

    public function init()
    {
        parent::init();
        $this->parser = Yii::createObject([
            'class'=>'frontend\extensions\Parser'
        ]);
        $compilesPath = Yii::getAlias('@webroot/frontend/runtime/compiles/');
        if(!is_dir($compilesPath))
        {
            File::createDirectory($compilesPath);
        }
        $this->compile_dir = $compilesPath;

    }
    public function render($view, $file, $params)
    {

        $this->tVars = $params;

        if(isset($this->tVars['data']))
            extract($this->tVars['data']);

            $compiled_file = $this->fetch($file);
            ob_start();
            error_reporting( E_ALL & ~E_NOTICE );
            include($compiled_file);
            $str = ob_get_contents();
            ob_end_clean();
            echo $str;
            exit;


    }

    /*
     *   解析模板并编译
     *   $file 必须是一个完整的路劲
     *   return 编译后的文件路劲
     * */
    public function fetch($file)
    {

        if (strncmp($file, '@', 1) === 0)
            $file = substr($file, 1);
        $basename = basename($file);
        $item = explode('.', $basename);
        $compiled_file = $this->compile_dir . $item[0] . '.php';

        if (file_exists($file)) {
            //if (!file_exists($compiled_file) || time() > @filemtime($compiled_file))
            $this->template_compile($file);
        } else {
            exit('template is not exits..');
        }

        return $compiled_file;


    }

    public function fetch_str($file)
    {
        if (file_exists($file)) {
            $str = @file_get_contents($file);
            $compiled_str = $this->template_parse($str, true);
        } else {
            exit('template is not exits.');
        }
        return $compiled_str;
    }

    public function template_compile($file)
    {
        $str = @file_get_contents($file);
        $basename = basename($file);
        $compiled_str = $this->template_parse($str);
        $item = explode('.', $basename);
        $strlen = file_put_contents($this->compile_dir . $item[0] . '.php', $compiled_str);
        return $strlen;
    }

    public function template_parse($str, $node = false)
    {
        $str = preg_replace_callback("/\{template\s+'(.+)'\}/i", function ($m) {
            return $this->template_include($m[1]);
        }, $str);

        if(isset($this->tVars['template']))
        {
            $str = preg_replace("/\{__TEMPLATE__}/", '<?php echo "<script>var page_template=\"'.$this->tVars['template'].'\";</script>"?>', $str);
        }
        $str = $this->parser->parse($str);
        if (!$node)
            $str = '<?php use common\helpers\Dispatch;use common\models\Config; $dp = new Dispatch();?>' . $str;

        return $str;

    }



    /**
     * 替换包含模板文件
     */
    public function template_include($filename)
    {
        if(!$filename) return;
        $file = $this->viewPath .ltrim($filename, '/');
        return file_get_contents($file);

    }


    function _eval($content)
    {
        ob_start();
        if(isset($this->tVars['data']))
            extract($this->tVars['data']);
        eval('?' . '>' . trim($content));

        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public static  function formatTable($str)
    {

        return preg_replace('~(.*?)#(.*?)#(.*)~','$1{{%$2}}$3',$str);

    }


}

?>