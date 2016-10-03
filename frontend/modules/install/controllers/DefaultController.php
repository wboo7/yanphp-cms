<?php

namespace frontend\modules\install\controllers;
use yii;
use yii\web\Controller;
use common\models\Admin;

class DefaultController extends Controller
{
    public $layout = 'main';
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        @set_time_limit(1000);
        if ('5.4.0' > phpversion())
            exit('您的php版本过低，不能安装本软件，请升级到5.4.0或更高版本再安装，谢谢！');
        date_default_timezone_set('PRC');
        error_reporting(E_ALL & ~E_NOTICE);
        header('Content-Type: text/html; charset=UTF-8');
        define('SITEDIR', Yii::getAlias('@webroot/'));

        define("VERSION", 'Yanphp1.0');
        $sqlFile = 'database.sql';
        $configFile = 'config.php';
        if (!file_exists(SITEDIR . 'frontend/modules/install/' . $sqlFile)) {
            echo '缺少数据库文件!';
            exit;
        }
        if(file_exists(SITEDIR.'frontend/modules/install/install.lock'))
        {
            echo "安装已锁定，请删除install中的install.lock后重试";
            exit;
        }

        $steps = array(
            '1' => '安装许可协议',
            '2' => '运行环境检测',
            '3' => '安装参数设置',
            '4' => '安装详细过程',
            '5' => '安装完成',
        );
        $step = isset($_GET['step']) ? $_GET['step'] : 1;
        switch ($step) {

            case '1':
                return $this->render("s1",[]);

            case '2':


                $phpv = @ phpversion();
                $os = PHP_OS;
                $os = php_uname();
                $tmp = function_exists('gd_info') ? gd_info() : array();
                $server = $_SERVER["SERVER_SOFTWARE"];
                $host = (empty($_SERVER["SERVER_ADDR"]) ? $_SERVER["SERVER_HOST"] : $_SERVER["SERVER_ADDR"]);
                $name = $_SERVER["SERVER_NAME"];
                $max_execution_time = ini_get('max_execution_time');
                $allow_reference = (ini_get('allow_call_time_pass_reference') ? '<font color=green>[√]On</font>' : '<font color=red>[×]Off</font>');
                $allow_url_fopen = (ini_get('allow_url_fopen') ? '<font color=green>[√]On</font>' : '<font color=red>[×]Off</font>');
                $safe_mode = (ini_get('safe_mode') ? '<font color=red>[×]On</font>' : '<font color=green>[√]Off</font>');

                $err = 0;
                if (empty($tmp['GD Version'])) {
                    $gd = '<font color=red>[×]Off</font>';
                    $err++;
                } else {
                    $gd = '<font color=green>[√]On</font> ' . $tmp['GD Version'];
                }
                if (function_exists('mysql_connect')) {
                    $mysql = '<span class="correct_span">&radic;</span> 已安装';
                } else {
                    $mysql = '<span class="correct_span error_span">&radic;</span> 出现错误';
                    $err++;
                }
                if (ini_get('file_uploads')) {
                    $uploadSize = '<span class="correct_span">&radic;</span> ' . ini_get('upload_max_filesize');
                } else {
                    $uploadSize = '<span class="correct_span error_span">&radic;</span>禁止上传';
                }
                if (function_exists('session_start')) {
                    $session = '<span class="correct_span">&radic;</span> 支持';
                } else {
                    $session = '<span class="correct_span error_span">&radic;</span> 不支持';
                    $err++;
                }
                $folder = array('assets','uploads','data','frontend/runtime','admin/runtime');
                return $this->render('s2',[
                    'phpv'=>$phpv,
                    'os'=>$os,
                    'mysql'=>$mysql,
                    'uploadSize'=>$uploadSize,
                    'session'=>$session,
                    'folder'=>$folder
                ]);

            case '3':

                if ($_GET['testdbpwd']) {
                    $dbHost = $_POST['dbHost'] . ':' . $_POST['dbPort'];
                    $conn = @mysql_connect($dbHost, $_POST['dbUser'], $_POST['dbPwd']);
                    die($conn ? "1" : "");
                }
                return $this->render('s3',[

                ]);

            case '4':

                if (intval($_GET['install'])) {
                    $n = intval($_GET['n']);
                    $arr = array();

                    $dbHost = trim($_POST['dbhost']);
                    $dbPort = trim($_POST['dbport']);
                    $dbName = trim($_POST['dbname']);
                    $dbHost = empty($dbPort) || $dbPort == 3306 ? $dbHost : $dbHost . ':' . $dbPort;
                    $dbUser = trim($_POST['dbuser']);
                    $dbPwd = trim($_POST['dbpw']);
                    $dbPrefix = empty($_POST['dbprefix']) ? 'yan_' : trim($_POST['dbprefix']);
                    $username = trim($_POST['manager_email']);
                    $password = trim($_POST['manager_pwd']);

                    $config = [
                        'components'=>[
                            'db'=>[
                                'class' => 'yii\db\Connection',
                                'dsn' => 'mysql:host='.$dbHost.';dbname='.$dbName, // MySQL, MariaDB
                                'tablePrefix' =>$dbPrefix,
                                'username' => $dbUser, //数据库用户名
                                'password' => $dbPwd, //数据库密码
                                'charset' => 'utf8',
                            ]
                        ]
                    ];


                    $conn = @ mysql_connect($dbHost, $dbUser, $dbPwd);
                    if (!$conn) {
                        $arr['msg'] = "连接数据库失败!";
                        die(json_encode($arr));
                    }
                    mysql_query("SET NAMES 'utf8'");
                    $version = mysql_get_server_info($conn);
                    if ($version < 4.1) {
                        $arr['msg'] = '数据库版本太低!';
                        die(json_encode($arr));
                    }

                    if (!mysql_select_db($dbName, $conn)) {
                        //创建数据时同时设置编码
                        if (!mysql_query("CREATE DATABASE IF NOT EXISTS `" . $dbName . "` DEFAULT CHARACTER SET utf8;", $conn)) {
                            $arr['msg'] = '数据库 ' . $dbName . ' 不存在，也没权限创建新的数据库！';
                            die(json_encode($arr));
                        }
                        if (empty($n)) {
                            $arr['n'] = 1;
                            $arr['msg'] = "成功创建数据库:{$dbName}<br>";
                            die(json_encode($arr));
                        }
                        mysql_select_db($dbName, $conn);
                    }

                    //读取数据文件
                    $sqldata = file_get_contents(SITEDIR . 'frontend/modules/install/' . $sqlFile);
                    $sqlFormat = $this->sql_split($sqldata, $dbPrefix);


                    /**
                    执行SQL语句
                     */
                    $counts = count($sqlFormat);

                    for ($i = $n; $i < $counts; $i++) {
                        $sql = trim($sqlFormat[$i]);

                        if (strstr($sql, 'CREATE TABLE')) {
                            preg_match('/CREATE TABLE `([^ ]*)`/', $sql, $matches);
                            mysql_query("DROP TABLE IF EXISTS `$matches[1]");
                            $ret = mysql_query($sql);
                            if ($ret) {
                                $message = '<li><span class="correct_span">&radic;</span>创建数据表' . $matches[1] . '，完成</li> ';
                            } else {
                                $message = '<li><span class="correct_span error_span">&radic;</span>创建数据表' . $matches[1] . '，失败</li>';
                            }
                            $i++;
                            $arr = array('n' => $i, 'msg' => $message);
                            die(json_encode($arr));
                        } else {

                            $ret = mysql_query($sql);
                            // pre(mysql_error($conn));
                            $message = '';
                            $arr = array('n' => $i, 'msg' => $message);
                            //  die(json_encode($arr));
                        }
                    }

                    if ($i == 999999)
                    {
                        //纠正attachment表的路劲
                        $sql = "SELECT id,filepath FROM ".$dbPrefix.'attachment WHERE filepath LIKE %frontend%';
                        $res = mysql_query($sql);
                        if($res)
                        {
                            while($row = mysql_fetch_assoc($res))
                            {
                                $filepath = preg_replace('~frontend.*?/uploads~','uploads',$row['filepath']);
                                mysql_query("UPDATE ".$dbPrefix."attachment SET filepath='".$filepath."' WHERE id=".$row['id']);
                            }
                        }
                        exit;
                    }


                    //插入管理员
                    $password = Admin::getPasswordHash($password);

                    $query = "INSERT INTO `{$dbPrefix}admin` (username,password_hash,roleid,status) VALUES ('{$username}','{$password}',1,1)";
                    mysql_query($query);
                    $message = '成功添加管理员<br />成功写入配置文件<br>安装完成．';


                    file_put_contents(SITEDIR . "common/config/database.php", ("<?php\treturn " . var_export($config, true) . ";?>"));
                    $arr = array('n' => 999999, 'msg' => $message);
                    die(json_encode($arr));
                }

                return $this->render('s4',['post'=>$_POST]);

            case '5':
                //清理站点缓存
                Yii::$app->cache->flush();

                return $this->render('s5');
                @touch(SITEDIR.'frontend/modules/install/install.lock');
                exit;
        }

    }
    public function sql_split($sql, $tablepre) {

        if ($tablepre != "pa_")
            $sql = str_replace("pa_", $tablepre, $sql);
        $sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=utf8", $sql);

//        if ($r_tablepre != $s_tablepre)
//            $sql = str_replace($s_tablepre, $r_tablepre, $sql);
        $sql = str_replace("\r", "\n", $sql);
        $ret = array();
        $num = 0;
        $queriesarray = explode(";\n", trim($sql));
        unset($sql);
        foreach ($queriesarray as $query) {
            $ret[$num] = '';
            $queries = explode("\n", trim($query));
            $queries = array_filter($queries);
            foreach ($queries as $query) {
                $str1 = substr($query, 0, 1);
                if ($str1 != '#' && $str1 != '-')
                    $ret[$num] .= $query;
            }
            $num++;
        }
        return $ret;
    }
}
