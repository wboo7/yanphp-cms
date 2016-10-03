<?php
namespace frontend\helpers;

class File{

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
            if (($entry != ".") && ($entry != "..")) {
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
                    $zip->addFile($path . "/" . $filename);
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

}
?>