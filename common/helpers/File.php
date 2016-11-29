<?php
namespace common\helpers;
use yii\helpers\FileHelper;
/*
 * 文件目录操作类
 * */
class File extends FileHelper{

    /* 删除文件里的文件和文件夹 */
    public static function deleteAll($dirName)
    {
        if(!is_dir($dirName))
            return false;
        if ( $handle = opendir($dirName))
        {
            while ( false !== ( $item = readdir( $handle )))
            {
                if ( $item != "." && $item != ".." )
                {
                    if ( is_dir($dirName.'/'.$item))
                    {
                        self::deleteAll($dirName.'/'.$item);
                    } else {
                        unlink($dirName.'/'.$item);
                    }
                }
            }
            closedir( $handle );
            rmdir($dirName);
        }
        return true;
    }

    /* 复制文件和文件夹 */
    public static  function xCopy($source, $destination, $child)
    {
        if (!is_dir($source)) {
            echo("Error:the $source is not a direction!");
            return false;
        }
        if (!is_dir($destination)) {
            self::mkDirs($destination);
        }
        $handle = dir($source);
        while ($entry = $handle->read()) {
            if (($entry != ".") && ($entry != "..") && ($entry != '.svn')) {
                if (is_dir($source . "/" . $entry)) {
                    if ($child)
                        self::xCopy($source . "/" . $entry, $destination . "/" . $entry, $child);
                } else {
                    copy($source . "/" . $entry, $destination . "/" . $entry);
                }
            }
        }
        return true;
    }

    /* 复制图片 */
    public static  function copyImg($source, $destination, $child)
    {
        if (!is_dir($source)) {
            echo("Error:the $source is not a direction!");
            return false;
        }
        if (!is_dir($destination)) {
            mkdir($destination, 0777);
        }
        $handle = dir($source);
        while ($entry = $handle->read()) {
            if (($entry != ".") && ($entry != "..")) {
                if (is_dir($source . "/" . $entry)) {
                    if ($child)
                        self::copyImg($source . "/" . $entry, $destination . "/" . $entry, $child);
                } else {
                    $item = explode('.',$entry);
                    $ext = strtoupper(end($item));
                    if(in_array($ext,array('JPEG','JPG','PNG','GIF')))
                    {
                        copy($source . "/" . $entry, $destination . "/" . $entry);
                    }

                }
            }
        }
        return true;
    }

    /* 打包zip */
    public static function addFileToZip($path, $zip) {
        $handler = opendir($path);

        while (($filename = readdir($handler)) !== false) {
            if ($filename != "." && $filename != "..")
            {
                if (is_dir($path . "/" . $filename))
                {
                   self::addFileToZip($path . "/" . $filename, $zip);
                }
                else
                {
                    $relative = preg_replace('~.*?initdata~','./initdata',$path);
                    $zip->addFile($path . "/" . $filename,$relative."/".$filename);
                }
            }
}
        @closedir($path);
    }
    /* 压缩文件 */
    public static function myZip($path,$name)
    {
        $zip = new \ZipArchive();
        if ($zip->open($name, \ZipArchive::OVERWRITE) === TRUE) {
            self::addFileToZip($path, $zip);
            $zip->close();
        }
    }
    /* 解压文件 */
    public static  function unzip($file,$des)
    {


        $zip = new \ZipArchive;
        if ($zip->open($file) === true) {

            for($i = 0; $i < $zip->numFiles; $i++) {

                $zip->extractTo($des, array($zip->getNameIndex($i)));

                // here you can run a custom function for the particular extracted file

            }

            $zip->close();

        }
    }

    public static function downfile($fileurl,$name)
    {
        $filename=$fileurl;
        $file  =  fopen($filename, "rb");
        Header( "Content-type:  application/octet-stream ");
        Header( "Accept-Ranges:  bytes ");
        Header( "Content-Disposition:  attachment;  filename= ".$name);
        $contents = "";
        while (!feof($file)) {
            $contents .= fread($file, 8192);
        }
        echo $contents;
        fclose($file);
    }

    /* 递归创建目录 */
    public  static  function  mkDirs($dir){
        if(!is_dir($dir)){
            if(!self::mkDirs(dirname($dir))){
                return false;
            }
            if(!mkdir($dir,0777)){
                return false;
            }
        }
        return true;
    }


    /**
     * 转化 \ 为 /
     *
     * @param	string	$path	路径
     * @return	string	路径
     */
    public static function dir_path($path)
    {
        $path = str_replace('\\', '/', $path);
        if(substr($path, -1) != '/') $path = $path.'/';
        return $path;
    }

    /**
     * 创建目录
     *
     * @param	string	$path	路径
     * @param	string	$mode	属性
     * @return	string	如果已经存在则返回true，否则为flase
     */
    public static function dir_create($path, $mode = 0777)
    {
        if(is_dir($path)) return TRUE;
        $ftp_enable = 0;
        $path = self::dir_path($path);
        $temp = explode('/', $path);
        $cur_dir = '';
        $max = count($temp) - 1;
        for($i=0; $i<$max; $i++)
        {
            $cur_dir .= $temp[$i].'/';
            if (@is_dir($cur_dir)) continue;
            @mkdir($cur_dir, 0777,true);
            @chmod($cur_dir, 0777);
        }
        return is_dir($path);
    }

    /**
     * 取得文件扩展
     *
     * @param $filename 文件名
     * @return 扩展名
     */
    public static function fileext($filename)
    {
        return strtolower(trim(substr(strrchr($filename, '.'), 1, 10)));
    }

    /**
     * 返回经addslashes处理过的字符串或数组
     * @param $string 需要处理的字符串或数组
     * @return mixed
     */
   public static  function new_addslashes($string)
    {
        if (!is_array($string)) return addslashes($string);
        foreach ($string as $key => $val) $string[$key] = self::new_addslashes($val);
        return $string;
    }

    /**
     * 安全过滤函数
     *
     * @param $string
     * @return string
     */
    public static function safe_replace($string)
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

    public static function getDirImages($dir,$url_path)
    {
        $images = [];
        if(!is_dir($dir))
            return false;
        $hd = opendir($dir);
        while(($file = readdir($hd)) !== false)
        {
            if($file != '.' && $file != '..' && $file != '.svn')
            {
                $item = explode('.',$file);
                $ext = strtoupper(end($item));
                if(in_array($ext,['JPEG','JPG','PNG','GIF']))
                    $images[] = $url_path.$file;

            }

        }
        return $images;
    }

    public static function sql_split($sql)
    {
        $sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=utf8", $sql);

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

    public static function getExt($str)
    {
        $str = strtolower(trim($str));
        $item = explode('.',$str);
        return end($item);
    }



}
?>