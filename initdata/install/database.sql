-- ---------------------------------------------------------
-- Database Name: programe163
-- ---------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES 'utf8' */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='SYSTEM' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


--
-- Table structure for table yan_admin
--

DROP TABLE IF EXISTS `yan_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = 'utf8' */;
CREATE TABLE `yan_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned DEFAULT '0' COMMENT '角色',
  `username` varchar(15) NOT NULL COMMENT '用户名',
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL COMMENT '用户密码',
  `email` varchar(40) NOT NULL COMMENT 'Email地址',
  `mobile` char(14) NOT NULL,
  `realname` varchar(10) NOT NULL,
  `gender` tinyint(2) NOT NULL DEFAULT '0',
  `status` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '用户状态',
  `roleid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '角色',
  `logincount` int(10) NOT NULL DEFAULT '0' COMMENT '登录次数',
  `logindate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录时间',
  `loginip` char(15) NOT NULL COMMENT '登录IP',
  `avatar` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid_2` (`id`),
  KEY `uid` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='用户基础表';
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_admin
--

/*!40000 ALTER TABLE `yan_admin` DISABLE KEYS */;
/*!40000 ALTER TABLE yan_admin ENABLE KEYS */;

--
-- Table structure for table yan_admin_action
--

DROP TABLE IF EXISTS `yan_admin_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = 'utf8' */;
CREATE TABLE `yan_admin_action` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(30) NOT NULL COMMENT '权限名称',
  `route` char(100) NOT NULL COMMENT '路由',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COMMENT='管理员权限表';
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_admin_action
--

INSERT INTO `yan_admin_action` VALUES ( 1, '内容管理', 'content/index' );
INSERT INTO `yan_admin_action` VALUES ( 2, '内容编辑', 'content/create' );
INSERT INTO `yan_admin_action` VALUES ( 3, '内容删除', 'content/delete' );
INSERT INTO `yan_admin_action` VALUES ( 4, '推荐位数据', 'position/index' );
INSERT INTO `yan_admin_action` VALUES ( 5, '推荐位列表', 'position/lists' );
INSERT INTO `yan_admin_action` VALUES ( 6, '推荐位添加', 'position/create' );
INSERT INTO `yan_admin_action` VALUES ( 7, '栏目管理', 'category-content/index' );
INSERT INTO `yan_admin_action` VALUES ( 8, '栏目创建更新', 'category-content/create' );
INSERT INTO `yan_admin_action` VALUES ( 9, '栏目删除', 'category-content/delete' );
INSERT INTO `yan_admin_action` VALUES ( 10, '模型管理', 'model/index' );
INSERT INTO `yan_admin_action` VALUES ( 11, '模型创建修改', 'model/create' );
INSERT INTO `yan_admin_action` VALUES ( 12, '密码修改', 'system/password' );
INSERT INTO `yan_admin_action` VALUES ( 13, '配置', 'config/index' );
INSERT INTO `yan_admin_action` VALUES ( 15, '幻灯', 'banner/index' );
INSERT INTO `yan_admin_action` VALUES ( 16, '角色列表', 'permission/index' );
INSERT INTO `yan_admin_action` VALUES ( 17, '角色创建更新', 'permission/update' );
INSERT INTO `yan_admin_action` VALUES ( 18, '角色删除', 'permission/delete' );
INSERT INTO `yan_admin_action` VALUES ( 19, '管理员列表', 'permission/admin' );
INSERT INTO `yan_admin_action` VALUES ( 20, '管理员添加更新', 'permission/admin-create' );
INSERT INTO `yan_admin_action` VALUES ( 21, '管理员删除', 'permission/delete-admin' );
INSERT INTO `yan_admin_action` VALUES ( 22, '权限列表', 'permission/action' );
INSERT INTO `yan_admin_action` VALUES ( 23, '权限添加更新', 'permission/create-action' );
INSERT INTO `yan_admin_action` VALUES ( 24, '权限删除', 'permission/delete-action' );
INSERT INTO `yan_admin_action` VALUES ( 25, '友情链接', 'friend/index' );
INSERT INTO `yan_admin_action` VALUES ( 26, '友情链接创建', 'friend/create' );
INSERT INTO `yan_admin_action` VALUES ( 27, '友情链接更新', 'friend/update' );
INSERT INTO `yan_admin_action` VALUES ( 28, '友情链接删除', 'friend/delete' );
INSERT INTO `yan_admin_action` VALUES ( 29, '表单向导', 'form/index' );
INSERT INTO `yan_admin_action` VALUES ( 30, '表单向导数据列表', 'form/lists' );
INSERT INTO `yan_admin_action` VALUES ( 31, '表单向导添加字段', 'form/add' );
INSERT INTO `yan_admin_action` VALUES ( 32, '表单向导管理字段', 'form/manage' );
INSERT INTO `yan_admin_action` VALUES ( 33, '表单向导创建表单', 'form/create' );
INSERT INTO `yan_admin_action` VALUES ( 34, '表单向导更新表单', 'form/update' );
INSERT INTO `yan_admin_action` VALUES ( 35, '表单向导删除表单', 'form/delete' );
INSERT INTO `yan_admin_action` VALUES ( 36, '模型删除', 'model/delete' );

--
-- Table structure for table yan_admin_assignment
--

DROP TABLE IF EXISTS `yan_admin_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = 'utf8' */;
CREATE TABLE `yan_admin_assignment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `role_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '角色',
  `action_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '权限',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COMMENT='权限分配表';
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_admin_assignment
--

INSERT INTO `yan_admin_assignment` VALUES ( 14, 1, 13 );
INSERT INTO `yan_admin_assignment` VALUES ( 15, 1, 18 );
INSERT INTO `yan_admin_assignment` VALUES ( 16, 1, 17 );
INSERT INTO `yan_admin_assignment` VALUES ( 17, 1, 16 );
INSERT INTO `yan_admin_assignment` VALUES ( 18, 1, 32 );
INSERT INTO `yan_admin_assignment` VALUES ( 19, 1, 31 );
INSERT INTO `yan_admin_assignment` VALUES ( 20, 1, 34 );
INSERT INTO `yan_admin_assignment` VALUES ( 21, 1, 30 );
INSERT INTO `yan_admin_assignment` VALUES ( 22, 1, 35 );
INSERT INTO `yan_admin_assignment` VALUES ( 23, 1, 33 );
INSERT INTO `yan_admin_assignment` VALUES ( 24, 1, 29 );
INSERT INTO `yan_admin_assignment` VALUES ( 25, 1, 20 );
INSERT INTO `yan_admin_assignment` VALUES ( 26, 1, 21 );
INSERT INTO `yan_admin_assignment` VALUES ( 27, 1, 19 );
INSERT INTO `yan_admin_assignment` VALUES ( 28, 1, 10 );
INSERT INTO `yan_admin_assignment` VALUES ( 29, 1, 36 );
INSERT INTO `yan_admin_assignment` VALUES ( 30, 1, 11 );
INSERT INTO `yan_admin_assignment` VALUES ( 31, 1, 7 );
INSERT INTO `yan_admin_assignment` VALUES ( 32, 1, 9 );
INSERT INTO `yan_admin_assignment` VALUES ( 33, 1, 8 );
INSERT INTO `yan_admin_assignment` VALUES ( 34, 1, 23 );
INSERT INTO `yan_admin_assignment` VALUES ( 35, 1, 24 );
INSERT INTO `yan_admin_assignment` VALUES ( 36, 1, 22 );
INSERT INTO `yan_admin_assignment` VALUES ( 37, 1, 6 );
INSERT INTO `yan_admin_assignment` VALUES ( 38, 1, 4 );
INSERT INTO `yan_admin_assignment` VALUES ( 39, 1, 5 );
INSERT INTO `yan_admin_assignment` VALUES ( 40, 1, 15 );
INSERT INTO `yan_admin_assignment` VALUES ( 41, 1, 12 );
INSERT INTO `yan_admin_assignment` VALUES ( 42, 1, 27 );
INSERT INTO `yan_admin_assignment` VALUES ( 43, 1, 28 );
INSERT INTO `yan_admin_assignment` VALUES ( 44, 1, 26 );
INSERT INTO `yan_admin_assignment` VALUES ( 45, 1, 25 );
INSERT INTO `yan_admin_assignment` VALUES ( 46, 1, 2 );
INSERT INTO `yan_admin_assignment` VALUES ( 47, 1, 1 );
INSERT INTO `yan_admin_assignment` VALUES ( 48, 1, 3 );
INSERT INTO `yan_admin_assignment` VALUES ( 49, 2, 6 );
INSERT INTO `yan_admin_assignment` VALUES ( 50, 2, 4 );
INSERT INTO `yan_admin_assignment` VALUES ( 51, 2, 5 );
INSERT INTO `yan_admin_assignment` VALUES ( 52, 2, 15 );
INSERT INTO `yan_admin_assignment` VALUES ( 53, 2, 12 );
INSERT INTO `yan_admin_assignment` VALUES ( 54, 2, 27 );
INSERT INTO `yan_admin_assignment` VALUES ( 55, 2, 28 );
INSERT INTO `yan_admin_assignment` VALUES ( 56, 2, 26 );
INSERT INTO `yan_admin_assignment` VALUES ( 57, 2, 25 );
INSERT INTO `yan_admin_assignment` VALUES ( 58, 2, 2 );
INSERT INTO `yan_admin_assignment` VALUES ( 59, 2, 1 );
INSERT INTO `yan_admin_assignment` VALUES ( 60, 2, 3 );

--
-- Table structure for table yan_admin_menu
--

DROP TABLE IF EXISTS `yan_admin_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = 'utf8' */;
CREATE TABLE `yan_admin_menu` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `parentid` smallint(6) NOT NULL DEFAULT '0' COMMENT '父菜单ID',
  `route` char(50) NOT NULL COMMENT '路由',
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '1' COMMENT '排序',
  `ismenu` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否菜单',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `listorder` (`listorder`),
  KEY `parentid` (`parentid`)
) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=utf8 COMMENT='后台菜单表';
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_admin_menu
--

/*!40000 ALTER TABLE `yan_admin_menu` DISABLE KEYS */;
INSERT INTO `yan_admin_menu` VALUES ( 1, '常用', 0, '', 0, 1 );
INSERT INTO `yan_admin_menu` VALUES ( 3, '全局', 0, '', 0, 1 );
INSERT INTO `yan_admin_menu` VALUES ( 6, '工具', 0, '', 0, 1 );
INSERT INTO `yan_admin_menu` VALUES ( 8, '常用菜单', 1, '', 0, 1 );
INSERT INTO `yan_admin_menu` VALUES ( 9, '站点设置', 3, '', 0, 1 );
INSERT INTO `yan_admin_menu` VALUES ( 53, '内容', 0, '', 0, 1 );
INSERT INTO `yan_admin_menu` VALUES ( 54, '管理内容', 53, '', 0, 1 );
INSERT INTO `yan_admin_menu` VALUES ( 55, '栏目管理', 53, '', 0, 1 );
INSERT INTO `yan_admin_menu` VALUES ( 56, '模型管理', 53, '', 0, 1 );
INSERT INTO `yan_admin_menu` VALUES ( 93, '缓存管理', 6, '', 0, 1 );
INSERT INTO `yan_admin_menu` VALUES ( 94, '模块', 0, '', 0, 1 );
INSERT INTO `yan_admin_menu` VALUES ( 95, '留言板', 94, '', 0, 1 );
INSERT INTO `yan_admin_menu` VALUES ( 97, '推荐位管理', 53, '', 0, 1 );
INSERT INTO `yan_admin_menu` VALUES ( 98, '创建更新内容', 53, '', 0, 0 );
INSERT INTO `yan_admin_menu` VALUES ( 99, '添加更新推荐位', 53, '', 0, 0 );
INSERT INTO `yan_admin_menu` VALUES ( 100, '推荐位列表', 53, '', 0, 0 );
INSERT INTO `yan_admin_menu` VALUES ( 101, '添加更新栏目', 53, '', 0, 0 );
INSERT INTO `yan_admin_menu` VALUES ( 102, '创建模型', 53, '', 0, 0 );
/*!40000 ALTER TABLE yan_admin_menu ENABLE KEYS */;

--
-- Table structure for table yan_admin_role
--

DROP TABLE IF EXISTS `yan_admin_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = 'utf8' */;
CREATE TABLE `yan_admin_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(20) NOT NULL COMMENT '角色名称',
  `description` varchar(100) NOT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='管理员角色表';
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_admin_role
--

INSERT INTO `yan_admin_role` VALUES ( 1, '超级管理员', '权限最大的管理员' );
INSERT INTO `yan_admin_role` VALUES ( 2, '编辑', '内容编辑' );

--
-- Table structure for table yan_analysis
--

DROP TABLE IF EXISTS `yan_analysis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = 'utf8' */;
CREATE TABLE `yan_analysis` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `url` varchar(255) NOT NULL COMMENT '访问路劲',
  `ua` varchar(255) NOT NULL COMMENT '访问设备',
  `ip` char(15) NOT NULL COMMENT 'ip地址',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '访问时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='统计分析表';
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_analysis
--

INSERT INTO `yan_analysis` VALUES ( 1, 'http://yanphp/index.php/lists/21', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0', '127.0.0.1', 1465479703 );
INSERT INTO `yan_analysis` VALUES ( 2, 'http://yanphp/index.php/lists/22', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0', '127.0.0.1', 1465489703 );
INSERT INTO `yan_analysis` VALUES ( 3, 'http://yanphp/index.php', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0', '127.0.0.1', 1465490903 );

--
-- Table structure for table yan_banner
--

DROP TABLE IF EXISTS `yan_banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = 'utf8' */;
CREATE TABLE `yan_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `filepath` char(100) NOT NULL COMMENT '路劲',
  `listorder` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '开启',
  `link` char(100) NOT NULL COMMENT '链接',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='幻灯片表';
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_banner
--


--
-- Table structure for table yan_cache
--

DROP TABLE IF EXISTS `yan_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = 'utf8' */;
CREATE TABLE `yan_cache` (
  `filename` char(50) NOT NULL,
  `path` char(50) NOT NULL,
  `data` mediumtext NOT NULL,
  PRIMARY KEY (`filename`,`path`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_cache
--

/*!40000 ALTER TABLE `yan_cache` DISABLE KEYS */;
/*!40000 ALTER TABLE yan_cache ENABLE KEYS */;

--
-- Table structure for table yan_category
--

DROP TABLE IF EXISTS `yan_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = 'utf8' */;
CREATE TABLE `yan_category` (
  `catid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(15) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `modelid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `parentid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `arrparentid` varchar(255) NOT NULL,
  `child` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `arrchildid` mediumtext NOT NULL,
  `catname` varchar(30) NOT NULL,
  `style` varchar(5) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` mediumtext NOT NULL,
  `parentdir` varchar(100) NOT NULL,
  `catdir` varchar(30) NOT NULL,
  `url` varchar(100) NOT NULL,
  `items` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `setting` mediumtext NOT NULL,
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `ismenu` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `sethtml` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `letter` varchar(30) NOT NULL,
  `usable_type` varchar(255) NOT NULL,
  PRIMARY KEY (`catid`),
  KEY `module` (`module`,`parentid`,`listorder`,`catid`),
  KEY `siteid` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_category
--

/*!40000 ALTER TABLE `yan_category` DISABLE KEYS */;
/*!40000 ALTER TABLE yan_category ENABLE KEYS */;

--
-- Table structure for table yan_category_content
--

DROP TABLE IF EXISTS `yan_category_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = 'utf8' */;
CREATE TABLE `yan_category_content` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `modelid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `parentid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `catname` varchar(30) NOT NULL,
  `description` mediumtext NOT NULL,
  `ismenu` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `keywords` varchar(255) NOT NULL,
  `listorder` int(11) NOT NULL COMMENT '排序',
  `content` text COMMENT '内容',
  PRIMARY KEY (`id`),
  KEY `module` (`parentid`,`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_category_content
--

/*!40000 ALTER TABLE `yan_category_content` DISABLE KEYS */;
INSERT INTO `yan_category_content` VALUES ( 1, 1, 0, 'News Center', '', 1, '', 1, NULL );
INSERT INTO `yan_category_content` VALUES ( 2, 3, 0, '产品展示', '', 1, '', 2, NULL );
/*!40000 ALTER TABLE yan_category_content ENABLE KEYS */;

--
-- Table structure for table yan_config
--

DROP TABLE IF EXISTS `yan_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = 'utf8' */;
CREATE TABLE `yan_config` (
  `id` varchar(60) NOT NULL DEFAULT '',
  `name` varchar(20) NOT NULL COMMENT '名称',
  `value` text,
  `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '类型',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='网站配置表';
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_config
--

/*!40000 ALTER TABLE `yan_config` DISABLE KEYS */;
INSERT INTO `yan_config` VALUES ( 'logo', '标识', '579c646d5d8e0.png', 1 );
INSERT INTO `yan_config` VALUES ( 'site_title', '网站标题', '中国太极拳', 0 );
INSERT INTO `yan_config` VALUES ( 'site_keywords', '网站关键词', '中国太极拳 太极拳', 0 );
INSERT INTO `yan_config` VALUES ( 'site_description', '网站描述', '中国太极拳博大精深，太极拳文化正走向世界。', 2 );
/*!40000 ALTER TABLE yan_config ENABLE KEYS */;

--
-- Table structure for table yan_content
--

DROP TABLE IF EXISTS `yan_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = 'utf8' */;
CREATE TABLE `yan_content` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '会员',
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '栏目',
  `title` varchar(80) NOT NULL DEFAULT '' COMMENT '文章标题',
  `thumb` varchar(100) NOT NULL DEFAULT '' COMMENT '缩略图',
  `videourl` varchar(150) NOT NULL COMMENT '视频地址',
  `keywords` varchar(100) NOT NULL DEFAULT '' COMMENT '关键词',
  `description` varchar(255) NOT NULL COMMENT '描述',
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建日期',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0',
  `content` mediumtext NOT NULL,
  `click` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击',
  `ext1` varchar(150) NOT NULL COMMENT '扩展1',
  `ext2` varchar(150) NOT NULL COMMENT '扩展2',
  `ext3` varchar(150) NOT NULL COMMENT '扩展3',
  `ext4` varchar(150) NOT NULL COMMENT '扩展4',
  `ext5` varchar(150) NOT NULL COMMENT '扩展5',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`status`,`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_content
--

/*!40000 ALTER TABLE `yan_content` DISABLE KEYS */;
INSERT INTO `yan_content` VALUES ( 1, 0, 1, 'Java学习之LinkedHashMap', '', '', '', '    前言： 在学习LRU算法的时候，看到LruCache源码实现是基于LinkedHashMap，今天学习一下LinkedHashMap的好处以及如何实现lru缓存机制的。 需求背景： LRU这个算法就是把最近一次使用时间离现在时间最远的数据删除掉，而实现LruCache将会频繁的执行插入、删除等操作， ...', 0, 1, 1474867931, 1474867931, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 2, 0, 1, '&lt;读书笔记&gt; 代码整洁之道', '', '', '', '    概述 概述 1、本文档的内容主要来源于书籍《代码整洁之道》作者Robert C.Martin，属于读书笔记。 2、软件质量，不仅依赖于架构和项目管理，而且与代码质量紧密相关，本书提出一种，代码质量与整洁成正比的观点，并给出了一系列行之有效的整洁代码操作实践，只要遵循这些规则，就可以编写出整洁的代码， ...', 0, 1, 1474867931, 1474867931, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 3, 0, 1, '从零开始，DIY一个jQuery（一）', '', '', '', '    从本篇开始会陪大家一起从零开始走一遍 jQuery 的奇妙旅途，在整个系列的实践中，我们会把 jQuery 的主要功能模块都了解和实现一遍。 这会是一段很长的历程，但也会很有意思 —— 作为前端领域的经典之作，jQuery 里有着太多奇思妙想，如果能够深入理解它，对于我们稳固js基础、提升前端大法技 ...', 0, 1, 1474867931, 1474867931, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 4, 0, 1, '&lt;实训|第八天&gt;超级管理员管理linux用户行为权限附监控主机状态', '', '', '', '    作为运维工程师，系统管理员，你最大的权力就是给别人分配权力，而且你还能时时控制着他们，今天就给大家介绍一下关于管理用户这一方面的前前后后。 开班第八天： 主要课程大纲：（下面我将把自己的身份定位成一个公司的超级管理员） 详细讲解： 补充昨天关于自动挂载软件仓库的操作 昨天我们介绍了软件仓库的制作，不 ...', 0, 1, 1474867931, 1474867931, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 5, 0, 1, '使用C#WebClient类访问（上传/下载/删除/列出文件目录）由IIS搭建的http文件服务器', '', '', '', '    本文介绍的是如何使用C#访问由IIS搭建的http文件服务器，访问包括：下载、上传、删除及列出文件（或目录） ...', 0, 1, 1474867931, 1474867931, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 6, 0, 1, 'netty5 HTTP协议栈浅析与实践', '', '', '', '    本文并非纯理论或纯技术类文章，而是结合理论进而实践（虽然没有特别深入的实践），浅析 netty HTTP 协议栈，并着重聊聊实践中遇到的问题及解决方案。耐心看完本文，相信你会对 HTTP 协议有更深层次的理解。 ...', 0, 1, 1474867931, 1474867931, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 7, 0, 1, 'Rabbitmq 性能测试', '', '', '', '背景： 线上环境，出了一起事故，初步定位是rabbitmq server。 通过抓包发现，是有多个应用使用同一台rabbitmq server。并且多个应用使用rabbitmq的方式也不一样。发现有以下两种方式： 1. 每次produce 一条消息，开闭channel一次 2. 每次produce ...', 0, 1, 1474867931, 1474867931, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 8, 0, 1, 'OpenCV 之 支持向量机 (一)', '', '', '', '    统计学习方法是由 模型 + 策略 + 算法 构成的，构建一种统计学习方法 (例如，支持向量机)，实际上就是具体去确定这三个要素。 1 支持向量机 支持向量机，简称 SVM (Support Vector Machine)，是一种二分分类模型。 1) 基本模型 (model) 定义在特征空间上的，一种 ...', 0, 1, 1474867931, 1474867931, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 9, 0, 1, '信号', '', '', '', '    一、信号的产生： 1.用户在终端按下某些键时,终端驱动程序会发送信号给前台进程 例如： Ctrl-C产生SIGINT信号 Ctrl-\\产生SIGQUIT信号 Ctrl-Z产生SIGTSTP信号 2.硬件异常产生信号,这些条件由硬件检测到并通知内核,然后内核向当前进程发送适当的信号。 例如：当前进程执 ...', 0, 1, 1474867931, 1474867931, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 10, 0, 1, 'Machine Learning In Action 第二章学习笔记: kNN算法', '', '', '', '    本文主要记录《Machine Learning In Action》中第二章的内容。书中以两个具体实例来介绍kNN（k nearest neighbors)，分别是： 通过“约会对象”功能，基本能够了解到kNN算法的工作原理。“手写数字识别”与“约会对象预测”使用完全一样的算法代码，仅仅是数据集有变 ...', 0, 1, 1474867931, 1474867931, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 11, 0, 1, '使用Idea编写javaweb以及maven的综合（一）', '', '', '', '    今天总结的第一点是在windows下使用idea编写jsp并且使用tomcat部署；第二点是新建maven项目，之前一直是听说也没有自己实践过，今天就大概说一下。 0x01 IDEA 全称 IntelliJ IDEA，是java语言开发的集成环境，我下载的是社区14版本 然后一步步下去，形成的目录结 ...', 0, 1, 1474867931, 1474867931, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 12, 0, 1, '一张图理解prototype、proto和constructor的三角关系', '', '', '', '    × 目录 [1]图示 [2]概念 [3]说明[4]总结 前面的话 javascript里的关系又多又乱。作用域链是一种单向的链式关系，还算简单清晰；this机制的调用关系，稍微有些复杂；而关于原型，则是prototype、proto和constructor的三角关系。本文先用一张图开宗明义，然后详细 ...', 0, 1, 1474867931, 1474867931, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 13, 0, 1, '一个三年工作经验的软件工程师的经验之谈', '', '', '', '    时间过得很快，我做软件工程师已经三年整了。我没有做过一个项目，一直在做框架相关的工作，有时维护Web框架代码，有时写移动Hybrid的前端UI框架，也有时做开发工具或自动编译平台等。 我想分享下这段时间在工作上的个人经验，分为几点： 做框架的态度 我工作中做得最多就是框架，框架的本质是提高重用性。对 ...', 0, 1, 1474867931, 1474867931, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 14, 0, 1, '『.NET Core CLI工具文档』（九）dotnet-run', '', '', '', '    说明：本文是个人翻译文章，由于个人水平有限，有不对的地方请大家帮忙更正。 原文： \"dotnet run\" 翻译： \"dotnet run\" 名称 dotnet run 没有任何明确的编译或启动命令运行“就地”（即运行命令的目录）源代码。 概要 `dotnet run [ framework] [  ...', 0, 1, 1474867932, 1474867932, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 15, 0, 1, 'Nlog、elasticsearch、Kibana以及logstash在项目中的应用（二）', '', '', '', '上一篇说如何搭建elk的环境（不清楚的可以看我的上一篇博客http://www.cnblogs.com/never-give-up-1015/p/5715904.html），现在来说一下如何用Nlog将日志通过logstash写入elasticsearch。 新建一个项目，用nuget引入Nlog， ...', 0, 1, 1474867932, 1474867932, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 16, 0, 1, 'STL学习笔记', '', '', '', '    简介 STL（Standard Template Library），即标准模版库，涵盖了常用的数据结构和算法，并具有跨平台的特点。STL是C++标准函数库的一部分，如下图所示： STL含有容器、算法和迭代器组件，其之间的合作如下图所示： STL的底层机制都是以RB-tree（红黑树）完成的。一个红黑 ...', 0, 1, 1474867932, 1474867932, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 17, 0, 1, 'GROUP BY vs ORDER BY', '', '', '', '    在MySQL中，有下面一种需求场景： 先以字段A分组，再以字段B分组，显示分组后的数据。 举个具体的例子，对 （员工）表来说，先以 分组，再以 分组，显示分组后staff表的全部数据。 表中的初始数据如下： GROUP BY GROUP BY语句用于对被选中输出的列进行分组，MySQL对GROUP  ...', 0, 1, 1474867932, 1474867932, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 18, 0, 1, 'JAVA不可变类(immutable)机制与String的不可变性', '', '', '', '不可变类是实例创建后就不可以改变成员遍历的值。这种特性使得不可变类提供了线程安全的特性但同时也带来了对象创建的开销，每更改一个属性都是重新创建一个新的对象。JDK内部也提供了很多不可变类如Integer、Double、String等。String的不可变特性主要为了满足常量池、线程安全、类加载的需求... ...', 0, 1, 1474867932, 1474867932, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 19, 0, 1, '提升大数据数据分析性能的方法及技术（一）', '', '', '', '    关于此文 最近在忙着准备校招的相关复习，所以也整理了一下上学期上课时候的学到的一些知识。刚好发现当时还写了一篇类似于文献综述性质的文章，就在这里贴出来。题材是关于大数据的，也是比较火热的一个话题，虽然现在接触的项目与大数据不太有关联，可能以后也不一定从事这方面的工作吧。就IT行业的研究成果来讲国外期 ...', 0, 1, 1474867932, 1474867932, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 20, 0, 1, 'Java学习之LinkedHashMap', '', '', '', '    前言： 在学习LRU算法的时候，看到LruCache源码实现是基于LinkedHashMap，今天学习一下LinkedHashMap的好处以及如何实现lru缓存机制的。 需求背景： LRU这个算法就是把最近一次使用时间离现在时间最远的数据删除掉，而实现LruCache将会频繁的执行插入、删除等操作， ...', 0, 1, 1474867932, 1474867932, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 21, 0, 2, '【818狂欢购付定金再降100元】小新Air姊妹款，轻达1.1kg，薄至13.3mm，7秒快速开机。', '579d450eae3e5.jpg', '', '', '【818狂欢购付定金再降100元】小新Air姊妹款，轻达1.1kg，薄至13.3mm，7秒快速开机。', 0, 1, 1475197235, 1475197235, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 22, 0, 2, '全新窄边框设计、内带价值748元免费Office软件；256G纯固态，高性价比', '579d450f37b05.jpg', '', '', '全新窄边框设计、内带价值748元免费Office软件；256G纯固态，高性价比', 0, 1, 1475197235, 1475197235, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 23, 0, 2, '【818狂欢购付定金再降100元】小新Air姊妹款，轻达1.1kg，薄至13.3mm，7秒快速开机。', '579d450f5a745.jpg', '', '', '【818狂欢购付定金再降100元】小新Air姊妹款，轻达1.1kg，薄至13.3mm，7秒快速开机。', 0, 1, 1475197235, 1475197235, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 24, 0, 2, '增之1克则嫌重，超乎寻常的1.1kg+13mm，静音办公11小时', '579d450f6e795.jpg', '', '', '增之1克则嫌重，超乎寻常的1.1kg+13mm，静音办公11小时', 0, 1, 1475197235, 1475197235, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 25, 0, 2, '炫彩轻薄，180度翻转，超强影音体验，彰显女神气质~', '579d450f9162d.jpg', '', '', '炫彩轻薄，180度翻转，超强影音体验，彰显女神气质~', 0, 1, 1475197235, 1475197235, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 26, 0, 2, '新一代13mm超薄全金属机身，搭载第六代处理器', '579d450fa7d8d.jpg', '', '', '新一代13mm超薄全金属机身，搭载第六代处理器', 0, 1, 1475197235, 1475197235, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 27, 0, 2, '炫彩轻薄，180度翻转，超强影音体验，彰显女神气质~', '579d450fbf875.jpg', '', '', '炫彩轻薄，180度翻转，超强影音体验，彰显女神气质~', 0, 1, 1475197235, 1475197235, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 28, 0, 2, '全新设计、轻薄、倾心之作、完美翻转、低耗节能。跌破6000限量抢购', '579d450fd8acd.jpg', '', '', '全新设计、轻薄、倾心之作、完美翻转、低耗节能。跌破6000限量抢购', 0, 1, 1475197235, 1475197235, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 29, 0, 2, '炫彩轻薄，180度翻转，超强影音体验，彰显女神气质~', '579d450ff30ad.jpg', '', '', '炫彩轻薄，180度翻转，超强影音体验，彰显女神气质~', 0, 1, 1475197235, 1475197235, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 30, 0, 2, '超薄机身，180度翻转，低功耗超高性价比~', '579d45101cafd.jpg', '', '', '超薄机身，180度翻转，低功耗超高性价比~', 0, 1, 1475197235, 1475197235, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 31, 0, 2, '超薄机身，180度翻转，低功耗超高性价比~', '579d45102d0b5.jpg', '', '', '超薄机身，180度翻转，低功耗超高性价比~', 0, 1, 1475197235, 1475197235, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 32, 0, 2, '增之1克则嫌重，超乎寻常的1.1kg+13mm，静音办公11小时', '579d45104630d.jpg', '', '', '增之1克则嫌重，超乎寻常的1.1kg+13mm，静音办公11小时', 0, 1, 1475197235, 1475197235, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 33, 0, 2, '轻薄便携，低功耗，强性能，纯固态带来极速体验！', '579d45106282d.jpg', '', '', '轻薄便携，低功耗，强性能，纯固态带来极速体验！', 0, 1, 1475197235, 1475197235, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 34, 0, 2, '轻薄便携，低功耗，强性能，纯固态带来极速体验！', '579d45108433d.jpg', '', '', '轻薄便携，低功耗，强性能，纯固态带来极速体验！', 0, 1, 1475197235, 1475197235, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 35, 0, 2, '【移动端更享优惠】新一代13mm超薄全金属机身，搭载第六代处理器', '579d45109d595.jpg', '', '', '【移动端更享优惠】新一代13mm超薄全金属机身，搭载第六代处理器', 0, 1, 1475197235, 1475197235, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 36, 0, 2, '可以360度自由翻转！和联想Yoga一起翻转地球，翻转自由！买就送包鼠套装', '579d4510bd935.jpg', '', '', '可以360度自由翻转！和联想Yoga一起翻转地球，翻转自由！买就送包鼠套装', 0, 1, 1475197235, 1475197235, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 37, 0, 2, '【品质∞返场购】 正品底价嗨翻全场，更有超值满减优惠返劵。晒图好评返现20元！更有神秘大礼联系客服米女，就是这么萌萌哒！', '579d4510d8acd.jpg', '', '', '【品质∞返场购】 正品底价嗨翻全场，更有超值满减优惠返劵。晒图好评返现20元！更有神秘大礼联系客服米女，就是这么萌萌哒！', 0, 1, 1475197235, 1475197235, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 38, 0, 2, '360°表链设计翻转，超高清IPS屏幕，第六代CPU', '579d45118e42d.jpg', '', '', '360°表链设计翻转，超高清IPS屏幕，第六代CPU', 0, 1, 1475197235, 1475197235, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 39, 0, 2, '【现在，仅5999元】超高清（3200*1800）IPS广视角炫彩触摸屏4GB 256G SSD极速固态硬盘！两色可选', '579d4511c04f5.jpg', '', '', '【现在，仅5999元】超高清（3200*1800）IPS广视角炫彩触摸屏4GB 256G SSD极速固态硬盘！两色可选', 0, 1, 1475197236, 1475197236, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 40, 0, 2, '糖果粉轻盈粉嫩、玲珑有人、至薄至轻，一见倾心', '3f417702cb450b86ab4bf705f83dbb42.png', '', '', '糖果粉轻盈粉嫩、玲珑有人、至薄至轻，一见倾心', 0, 1, 1475197236, 1475197267, '<p>YANPHP模块化建站</p>', 0, '', '', '', '', '' );
/*!40000 ALTER TABLE yan_content ENABLE KEYS */;

--
-- Table structure for table yan_download
--

DROP TABLE IF EXISTS `yan_download`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = 'utf8' */;
CREATE TABLE `yan_download` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` char(80) NOT NULL DEFAULT '',
  `style` char(24) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` char(255) NOT NULL DEFAULT '',
  `posids` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `systems` varchar(100) NOT NULL DEFAULT 'Win2000/WinXP/Win2003',
  `copytype` varchar(15) NOT NULL DEFAULT '',
  `language` varchar(10) NOT NULL DEFAULT '',
  `classtype` varchar(20) NOT NULL DEFAULT '',
  `version` varchar(20) NOT NULL DEFAULT '',
  `filesize` varchar(10) NOT NULL DEFAULT 'Unkown',
  `stars` varchar(20) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`status`,`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_download
--

/*!40000 ALTER TABLE `yan_download` DISABLE KEYS */;
INSERT INTO `yan_download` VALUES ( 1, 7, 0, 'dsgsa', '', '', 'gsg', 'gssf', 0, 'http://phpcms/index.php?m=content&c=index&a=show&catid=7&id=1', 0, 99, 1, 0, 'admin', 1443949864, 1443949864, 'Win2000/WinXP/Win2003', '免费版', '英文', '', '', '未知', '', 'gsg' );
INSERT INTO `yan_download` VALUES ( 2, 7, 0, 'dsgsa', '', '', 'gsg', 'gssf', 0, '', 0, 99, 0, 0, '', 1443949864, 1443949864, 'Win2000/WinXP/Win2003', '', '', '', '', 'Unkown', '', 'gsg' );
/*!40000 ALTER TABLE yan_download ENABLE KEYS */;

--
-- Table structure for table yan_form
--

DROP TABLE IF EXISTS `yan_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = 'utf8' */;
CREATE TABLE `yan_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `table_name` char(30) NOT NULL COMMENT '表名',
  `name` varchar(30) NOT NULL COMMENT '表单名称',
  `description` varchar(150) NOT NULL COMMENT '表单描述',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='表单管理';
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_form
--

INSERT INTO `yan_form` VALUES ( 3, 'yan_form_msg', '留言报', '留言报', 1470994714, 1470994714, 1 );

--
-- Table structure for table yan_form_msg
--

DROP TABLE IF EXISTS `yan_form_msg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = 'utf8' */;
CREATE TABLE `yan_form_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `created_ip` char(20) NOT NULL COMMENT '提交ip',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '姓名',
  `sexy` varchar(10) NOT NULL DEFAULT '男士' COMMENT '称呼',
  `qq` varchar(20) NOT NULL DEFAULT '' COMMENT 'QQ',
  `email` varchar(30) NOT NULL DEFAULT '' COMMENT '邮箱',
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '留言内容',
  `tel` varchar(20) NOT NULL DEFAULT '' COMMENT '电话',
  `status` tinyint(2) DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='留言报';
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_form_msg
--


--
-- Table structure for table yan_friend
--

DROP TABLE IF EXISTS `yan_friend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = 'utf8' */;
CREATE TABLE `yan_friend` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `filepath` char(100) NOT NULL COMMENT '路劲',
  `listorder` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '开启',
  `link` char(100) NOT NULL COMMENT '链接',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='友情链接表';
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_friend
--

INSERT INTO `yan_friend` VALUES ( 2, '百度', '579bed0584080.png', 0, 1, 'http://www.baidu.com' );
INSERT INTO `yan_friend` VALUES ( 3, '谷歌', '579bed1a4ecf0.png', 0, 1, 'http://www.google.com' );
INSERT INTO `yan_friend` VALUES ( 4, '新浪', '579bed35e4cf0.png', 0, 1, 'http://weibo.com' );
INSERT INTO `yan_friend` VALUES ( 5, '腾讯', '579bed4a08340.png', 0, 1, 'http://www.qq.com' );
INSERT INTO `yan_friend` VALUES ( 6, 360, '579bed5d1a6a8.png', 0, 1, 'http://www.haoso.com' );
INSERT INTO `yan_friend` VALUES ( 7, '淘宝网', '579bf1b8b71b1.png', 0, 1, 'http://www.taobao.com' );

--
-- Table structure for table yan_migration
--

DROP TABLE IF EXISTS `yan_migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = 'utf8' */;
CREATE TABLE `yan_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_migration
--

/*!40000 ALTER TABLE `yan_migration` DISABLE KEYS */;
INSERT INTO `yan_migration` VALUES ( 'm000000_000000_base', 1455088848 );
INSERT INTO `yan_migration` VALUES ( 'm140506_102106_rbac_init', 1455089217 );
/*!40000 ALTER TABLE yan_migration ENABLE KEYS */;

--
-- Table structure for table yan_model
--

DROP TABLE IF EXISTS `yan_model`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = 'utf8' */;
CREATE TABLE `yan_model` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` char(30) NOT NULL COMMENT '模型名称',
  `tablename` char(20) NOT NULL COMMENT '表名',
  `description` char(100) NOT NULL COMMENT '模型描述',
  `category_template` char(30) NOT NULL COMMENT '栏目模板',
  `list_template` char(30) NOT NULL COMMENT '栏目列表模板',
  `show_template` char(30) NOT NULL COMMENT '栏目展示模板',
  `system` tinyint(2) NOT NULL DEFAULT '0',
  `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_model
--

/*!40000 ALTER TABLE `yan_model` DISABLE KEYS */;
INSERT INTO `yan_model` VALUES ( 1, '文章模型', 'news', '文章模型，适合新闻，文章等', 'category_news', 'list_news', 'show_news', 1, 0 );
INSERT INTO `yan_model` VALUES ( 3, '图片模型', 'picture', '图片模型，适合产品，案列等', 'category_picture', 'list_picture', 'show_picture', 1, 0 );
INSERT INTO `yan_model` VALUES ( 4, '视频模型', 'video', '适合视频发布', 'category_video', 'list_video', 'show_video', 1, 0 );
INSERT INTO `yan_model` VALUES ( 5, '单页模型', 'page', '适合发布单页', '', '', 'show_page', 1, 1 );
INSERT INTO `yan_model` VALUES ( 6, '留言模型', 'page', '适合做留言板等', '', 'msg', 'show_msg', 1, 0 );
INSERT INTO `yan_model` VALUES ( 7, '人才招聘单页模型', 'page', '人才招聘单页模型', '', '', 'show_page_job', 0, 1 );
INSERT INTO `yan_model` VALUES ( 10, '关于我们单页模型', 'page', '关于我们单页模型', '', '', 'show_page_cultrue', 0, 1 );
INSERT INTO `yan_model` VALUES ( 11, '合作伙伴单页模式', 'page', '合作伙伴', '', '', 'show_page_hz', 0, 1 );
/*!40000 ALTER TABLE yan_model ENABLE KEYS */;

--
-- Table structure for table yan_photos
--

DROP TABLE IF EXISTS `yan_photos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = 'utf8' */;
CREATE TABLE `yan_photos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(100) NOT NULL COMMENT '图片描述',
  `contentid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '内容',
  `filepath` char(150) NOT NULL COMMENT '保存路劲',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='图集';
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_photos
--

INSERT INTO `yan_photos` VALUES ( 1, '', 40, '048947ba4bfd764b3c3e9fe2c32be55b.png' );

--
-- Table structure for table yan_position
--

DROP TABLE IF EXISTS `yan_position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = 'utf8' */;
CREATE TABLE `yan_position` (
  `id` mediumint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `pid` mediumint(5) NOT NULL DEFAULT '0' COMMENT '推荐位分类',
  `contentid` int(10) unsigned NOT NULL COMMENT '内容ID',
  `catid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属分类',
  `listorder` mediumint(5) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '开启状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='推荐位';
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_position
--


--
-- Table structure for table yan_position_category
--

DROP TABLE IF EXISTS `yan_position_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = 'utf8' */;
CREATE TABLE `yan_position_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(150) NOT NULL COMMENT '名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='推荐位分类';
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_position_category
--

INSERT INTO `yan_position_category` VALUES ( 1, '首页图片左右滚动' );
INSERT INTO `yan_position_category` VALUES ( 3, '最新产品推荐位' );

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
