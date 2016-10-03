<?php
namespace common\helpers;
/*
 * 数据库操作
 * */
class Db
{
    public static $err = [];

    public static function addErr($msg)
    {
        self::$err[] = $msg;
    }
    public static function db_dump($host, $user, $pwd, $db,$saveFile)
    {
        $mysqlconlink = @mysql_connect($host, $user, $pwd, true);
        if (!$mysqlconlink)
            self::addErr('No MySQL connection:'.mysql_error());
        mysql_set_charset('utf8', $mysqlconlink);
        $mysqldblink = mysql_select_db($db, $mysqlconlink);
        if (!$mysqldblink)
            self::addErr('No MySQL connection to database:'.mysql_error());
        $tabelstobackup = array();
        $result = mysql_query("SHOW TABLES FROM `$db`");
        if (!$result)
            self::addErr(printf('Database error %1$s for query %2$s', mysql_error(), "SHOW TABLE STATUS FROM `$db`;"));
        while ($data = mysql_fetch_row($result)) {
            $tabelstobackup[] = $data[0];
        }
        if (count($tabelstobackup) > 0) {
            $result = mysql_query("SHOW TABLE STATUS FROM `$db`");
            if (!$result)
                self::addErr(sprintf('Database error %1$s for query %2$s', mysql_error(), "SHOW TABLE STATUS FROM `$db`;"));
            while ($data = mysql_fetch_assoc($result)) {
                $status[$data['Name']] = $data;
            }
            if ($file = fopen($saveFile, 'wb')) {
                fwrite($file, "-- ---------------------------------------------------------\n");
                fwrite($file, "-- Database Name: $db\n");
                fwrite($file, "-- ---------------------------------------------------------\n\n");
                fwrite($file, "/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\n");
                fwrite($file, "/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\n");
                fwrite($file, "/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\n");
                fwrite($file, "/*!40101 SET NAMES '" . mysql_client_encoding() . "' */;\n");
                fwrite($file, "/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;\n");
                fwrite($file, "/*!40103 SET TIME_ZONE='" . mysql_result(mysql_query("SELECT @@time_zone"), 0) . "' */;\n");
                fwrite($file, "/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;\n");
                fwrite($file, "/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;\n");
                fwrite($file, "/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;\n");
                fwrite($file, "/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;\n\n");
                foreach ($tabelstobackup as $table) {
                    self::need_free_memory(($status[$table]['Data_length'] + $status[$table]['Index_length']) * 3);
                    self::_db_dump_table($table, $status[$table], $file);
                }
                fwrite($file, "\n");
                fwrite($file, "/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;\n");
                fwrite($file, "/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;\n");
                fwrite($file, "/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;\n");
                fwrite($file, "/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;\n");
                fwrite($file, "/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\n");
                fwrite($file, "/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\n");
                fwrite($file, "/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;\n");
                fwrite($file, "/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;\n");
                fclose($file);

            } else {
                self::addErr('Can not create database dump!');
            }
        } else {
            self::addErr('No tables to dump');
        }
    }

    public static function _db_dump_table($table, $status, $file)
    {
        fwrite($file, "\n");
        fwrite($file, "--\n");
        fwrite($file, "-- Table structure for table $table\n");
        fwrite($file, "--\n\n");
        fwrite($file, "DROP TABLE IF EXISTS `" . $table . "`;\n");
        fwrite($file, "/*!40101 SET @saved_cs_client     = @@character_set_client */;\n");
        fwrite($file, "/*!40101 SET character_set_client = '" . mysql_client_encoding() . "' */;\n");
        $result = mysql_query("SHOW CREATE TABLE `" . $table . "`");
        if (!$result) {
            self::addErr(sprintf('Database error %1$s for query %2$s', mysql_error(), "SHOW CREATE TABLE `" . $table . "`"));
            return false;
        }
        $tablestruc = mysql_fetch_assoc($result);
        fwrite($file, $tablestruc['Create Table'] . ";\n");
        fwrite($file, "/*!40101 SET character_set_client = @saved_cs_client */;\n");
        $result = mysql_query("SELECT * FROM `" . $table . "`");
        if (!$result) {
            self::addErr(sprintf('Database error %1$s for query %2$s', mysql_error(), "SELECT * FROM `" . $table . "`"));
            return false;
        }
        fwrite($file, "--\n");
        fwrite($file, "-- Dumping data for table $table\n");
        fwrite($file, "--\n\n");
        if ($status['Engine'] == 'MyISAM')
            fwrite($file, "/*!40000 ALTER TABLE `" . $table . "` DISABLE KEYS */;\n");
        while ($data = mysql_fetch_assoc($result)) {
            $keys = array();
            $values = array();
            foreach ($data as $key => $value) {
                if ($value === NULL)
                    $value = "NULL";
                elseif ($value === "" or $value === false)
                    $value = "''";
                elseif (!is_numeric($value))
                    $value = "'" . mysql_real_escape_string($value) . "'";
                $values[] = $value;
            }
            fwrite($file, "INSERT INTO `" . $table . "` VALUES ( " . implode(", ", $values) . " );\n");
        }
        if ($status['Engine'] == 'MyISAM')
            fwrite($file, "/*!40000 ALTER TABLE " . $table . " ENABLE KEYS */;\n");
    }

    public static function need_free_memory($memneed)
    {
        if (!function_exists('memory_get_usage'))
            return;
        $needmemory = @memory_get_usage(true) + self::inbytes($memneed);
        if ($needmemory > self::inbytes(ini_get('memory_limit'))) {
            $newmemory = round($needmemory / 1024 / 1024) + 1 . 'M';
            if ($needmemory >= 1073741824)
                $newmemory = round($needmemory / 1024 / 1024 / 1024) . 'G';
            if ($oldmem = @ini_set('memory_limit', $newmemory))
            {
                //echo sprintf(__('Memory increased from %1$s to %2$s', 'backwpup'), $oldmem, @ini_get('memory_limit')) . "<br/>";

            }
            else
            {
                self::addErr(sprintf(__('Can not increase memory limit is %1$s', 'backwpup'), @ini_get('memory_limit')));

            }
        }
    }

    public static function inbytes($value)
    {
        $multi = strtoupper(substr(trim($value), -1));
        $bytes = abs(intval(trim($value)));
        if ($multi == 'G')
            $bytes = $bytes * 1024 * 1024 * 1024;
        if ($multi == 'M')
            $bytes = $bytes * 1024 * 1024;
        if ($multi == 'K')
            $bytes = $bytes * 1024;
        return $bytes;
    }
}

?>