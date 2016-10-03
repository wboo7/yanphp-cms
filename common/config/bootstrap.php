<?php
Yii::setAlias('common', dirname(__DIR__));
Yii::setAlias('frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('admin', dirname(dirname(__DIR__)) . '/admin');
//Yii::setAlias('console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('statics', dirname(dirname(__DIR__)) . '/statics');
Yii::setAlias('data/cache', dirname(dirname(__DIR__)) . '/data/cache');
Yii::setAlias('views', '@frontend/views');
defined('YANPHP') or define('YANPHP', true);

/**
 * 分页函数
 *
 * @param $num 信息总数
 * @param $curr_page 当前分页
 * @param $perpage 每页显示数
 * @param $urlrule URL规则
 * @param $array 需要传递的数组，用于增加额外的方法
 * @return 分页
 */
function pages($num, $curr_page, $perpage = 20, $urlrule = '', $array = array())
{
    if ($urlrule == '') $urlrule = url_par('page={$page}');

    $multipage = '';
    if ($num > $perpage) {
        $page = 11;
        $offset = 4;
        $pages = ceil($num / $perpage);
        $from = $curr_page - $offset;
        $to = $curr_page + $offset;
        $more = 0;
        if ($page >= $pages) {
            $from = 2;
            $to = $pages - 1;
        } else {
            if ($from <= 1) {
                $to = $page - 1;
                $from = 2;
            } elseif ($to >= $pages) {
                $from = $pages - ($page - 2);
                $to = $pages - 1;
            }
            $more = 1;
        }
        $multipage .= '<a>总条数' . $num . '</a>';
        if ($curr_page > 0) {
            $multipage .= ' <a href="' . pageurl($urlrule, $curr_page - 1, $array) . '" class="a1">' . '<<' . '</a>';
            if ($curr_page == 1) {
                $multipage .= ' <span>1</span>';
            } elseif ($curr_page > 6 && $more) {
                $multipage .= ' <a href="' . pageurl($urlrule, 1, $array) . '">1</a>..';
            } else {
                $multipage .= ' <a href="' . pageurl($urlrule, 1, $array) . '">1</a>';
            }
        }
        for ($i = $from; $i <= $to; $i++) {
            if ($i != $curr_page) {
                $multipage .= ' <a href="' . pageurl($urlrule, $i, $array) . '">' . $i . '</a>';
            } else {
                $multipage .= ' <span>' . $i . '</span>';
            }
        }
        if ($curr_page < $pages) {
            if ($curr_page < $pages - 5 && $more) {
                $multipage .= ' ..<a href="' . pageurl($urlrule, $pages, $array) . '">' . $pages . '</a> <a href="' . pageurl($urlrule, $curr_page + 1, $array) . '" class="a1">' . '>>' . '</a>';
            } else {
                $multipage .= ' <a href="' . pageurl($urlrule, $pages, $array) . '">' . $pages . '</a> <a href="' . pageurl($urlrule, $curr_page + 1, $array) . '" class="a1">' . '>>' . '</a>';
            }
        } elseif ($curr_page == $pages) {
            $multipage .= ' <span>' . $pages . '</span> <a href="' . pageurl($urlrule, $curr_page, $array) . '" class="a1">' . '>>' . '</a>';
        } else {
            $multipage .= ' <a href="' . pageurl($urlrule, $pages, $array) . '">' . $pages . '</a> <a href="' . pageurl($urlrule, $curr_page + 1, $array) . '" class="a1">' . '>>' . '</a>';
        }

    }
    return $multipage;
}

/**
 * 返回分页路径
 *
 * @param $urlrule 分页规则
 * @param $page 当前页
 * @param $array 需要传递的数组，用于增加额外的方法
 * @return 完整的URL路径
 */
function pageurl($urlrule, $page, $array = array())
{
    if (strpos($urlrule, '#')) {
        $urlrules = explode('#', $urlrule);
        $urlrule = $page < 2 ? $urlrules[0] : $urlrules[1];
    }
    $findme = array('{$page}');
    $replaceme = array($page);
    if (is_array($array)) foreach ($array as $k => $v) {
        $findme[] = '{$' . $k . '}';
        $replaceme[] = $v;
    }
    $url = str_replace($findme, $replaceme, $urlrule);
    return $url;
}

/**
 * 获取当前页面完整URL地址
 */
function get_url()
{
    $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
    $php_self = $_SERVER['PHP_SELF'] ? safe_replace($_SERVER['PHP_SELF']) : safe_replace($_SERVER['SCRIPT_NAME']);
    $path_info = isset($_SERVER['PATH_INFO']) ? safe_replace($_SERVER['PATH_INFO']) : '';
    $relate_url = isset($_SERVER['REQUEST_URI']) ? safe_replace($_SERVER['REQUEST_URI']) : $php_self . (isset($_SERVER['QUERY_STRING']) ? '?' . safe_replace($_SERVER['QUERY_STRING']) : $path_info);
    return $sys_protocal . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '') . $relate_url;
}
/**
 * 安全过滤函数
 *
 * @param $string
 * @return string
 */
function safe_replace($string)
{
    $string = str_replace('%20', '', $string);
    $string = str_replace('%27', '', $string);
    $string = str_replace('%2527', '', $string);
    $string = str_replace('*', '', $string);
    $string = str_replace('"', '&quot;', $string);
    $string = str_replace("'", '', $string);
    $string = str_replace('"', '', $string);
    $string = str_replace(';', '', $string);
    $string = str_replace('<', '&lt;', $string);
    $string = str_replace('>', '&gt;', $string);
    $string = str_replace("{", '', $string);
    $string = str_replace('}', '', $string);
    $string = str_replace('\\', '', $string);
    return $string;
}
/**
 * URL路径解析，pages 函数的辅助函数
 *
 * @param $par 传入需要解析的变量 默认为，page={$page}
 * @param $url URL地址
 * @return URL
 */
function url_par($par, $url = '')
{
    if ($url == '') $url = get_url();

    $pos = strpos($url, '?');
    if ($pos === false) {
        $url .= '?' . $par;

    } else {
        $querystring = substr(strstr($url, '?'), 1);
        parse_str($querystring, $pars);

        $query_array = array();
        foreach ($pars as $k => $v) {
            if($k == 'page') continue;
            $query_array[$k] = $v;
        }
        $querystring = $query_array ?http_build_query($query_array) . '&' . $par:$par;
        $url = substr($url, 0, $pos) . '?' . $querystring;

    }
    return $url;
}


 function str_cut($string, $length, $etc = '...')
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




