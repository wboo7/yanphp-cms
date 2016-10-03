-- ---------------------------------------------------------
-- Database Name: programe140
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
  `regdate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `regip` char(15) NOT NULL COMMENT '注册IP',
  `avatar` varchar(30) NOT NULL,
  `proid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '当前应用id',
  `sign` varchar(255) NOT NULL COMMENT '个性签名',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid_2` (`id`),
  KEY `uid` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='用户基础表';
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_admin
--

/*!40000 ALTER TABLE `yan_admin` DISABLE KEYS */;
/*!40000 ALTER TABLE yan_admin ENABLE KEYS */;

--
-- Table structure for table yan_admin_custom
--

DROP TABLE IF EXISTS `yan_admin_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = 'utf8' */;
CREATE TABLE `yan_admin_custom` (
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `custom` text COMMENT '常用菜单项',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='后台常用菜单表';
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_admin_custom
--

/*!40000 ALTER TABLE `yan_admin_custom` DISABLE KEYS */;
INSERT INTO `yan_admin_custom` VALUES ( 1, '34,43,40,47,49' );
/*!40000 ALTER TABLE yan_admin_custom ENABLE KEYS */;

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
  `group` varchar(20) NOT NULL COMMENT '组名',
  `c` char(20) NOT NULL DEFAULT '' COMMENT '控制器名称',
  `a` char(20) NOT NULL DEFAULT '' COMMENT '操作名称',
  `params` char(100) NOT NULL COMMENT '参数',
  `vieworder` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `ismenu` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否菜单',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `listorder` (`vieworder`),
  KEY `parentid` (`parentid`),
  KEY `module` (`c`,`a`)
) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=utf8 COMMENT='后台菜单表';
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_admin_menu
--

/*!40000 ALTER TABLE `yan_admin_menu` DISABLE KEYS */;
INSERT INTO `yan_admin_menu` VALUES ( 1, '常用', 0, '', 'custom', 'init', '', 0, 1 );
INSERT INTO `yan_admin_menu` VALUES ( 3, '全局', 0, '', 'config', 'init', '', 0, 1 );
INSERT INTO `yan_admin_menu` VALUES ( 6, '工具', 0, '', 'tool', 'init', '', 0, 1 );
INSERT INTO `yan_admin_menu` VALUES ( 8, '常用菜单', 1, '', 'custom', 'init', '', 0, 1 );
INSERT INTO `yan_admin_menu` VALUES ( 9, '站点设置', 3, '', 'config', 'site', '', 0, 1 );
INSERT INTO `yan_admin_menu` VALUES ( 53, '内容', 0, '', 'content', 'index', '', 0, 1 );
INSERT INTO `yan_admin_menu` VALUES ( 54, '管理内容', 53, '内容发布管理', 'content', 'index', '', 0, 1 );
INSERT INTO `yan_admin_menu` VALUES ( 55, '栏目管理', 53, '内容相关设置', 'category-content', 'index', '', 0, 1 );
INSERT INTO `yan_admin_menu` VALUES ( 56, '模型管理', 53, '内容相关设置', 'model', 'index', '', 0, 1 );
INSERT INTO `yan_admin_menu` VALUES ( 93, '缓存管理', 6, '', 'cache', 'index', '', 0, 1 );
INSERT INTO `yan_admin_menu` VALUES ( 94, '模块', 0, '', '', '', '', 0, 1 );
INSERT INTO `yan_admin_menu` VALUES ( 95, '留言板', 94, '', 'msg', 'index', '', 0, 1 );
INSERT INTO `yan_admin_menu` VALUES ( 97, '推荐位管理', 53, '内容发布管理', 'position', 'index', '', 0, 1 );
INSERT INTO `yan_admin_menu` VALUES ( 98, '创建更新内容', 53, '', 'content', 'create', '', 0, 0 );
INSERT INTO `yan_admin_menu` VALUES ( 99, '添加更新推荐位', 53, '', 'position', 'create', '', 0, 0 );
INSERT INTO `yan_admin_menu` VALUES ( 100, '推荐位列表', 53, '', 'position', 'lists', '', 0, 0 );
INSERT INTO `yan_admin_menu` VALUES ( 101, '添加更新栏目', 53, '', 'category-content', 'create', '', 0, 0 );
INSERT INTO `yan_admin_menu` VALUES ( 102, '创建模型', 53, '', 'model', 'create', '', 0, 0 );
/*!40000 ALTER TABLE yan_admin_menu ENABLE KEYS */;

--
-- Table structure for table yan_admin_money
--

DROP TABLE IF EXISTS `yan_admin_money`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = 'utf8' */;
CREATE TABLE `yan_admin_money` (
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `balance_money` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '账户余额',
  `freeze_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '冻结资金',
  `pick_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '提取金额',
  `draw_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '中奖金额',
  `recharge_money` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '充值金额',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid_2` (`uid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户资产表';
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_admin_money
--

/*!40000 ALTER TABLE `yan_admin_money` DISABLE KEYS */;
INSERT INTO `yan_admin_money` VALUES ( 1, 10058386.00, 3835.00, 60900.00, 768966.00, 1510.00 );
INSERT INTO `yan_admin_money` VALUES ( 2, 0.00, 0.00, 0.00, 0.00, 0.00 );
INSERT INTO `yan_admin_money` VALUES ( 3, 0.39, 0.00, 0.00, 0.00, 0.00 );
INSERT INTO `yan_admin_money` VALUES ( 4, 100.00, 500.00, 0.00, 500.00, 1000.00 );
INSERT INTO `yan_admin_money` VALUES ( 5, 49.56, 0.00, 0.00, 0.00, 0.00 );
INSERT INTO `yan_admin_money` VALUES ( 6, 0.00, 0.00, 0.00, 0.00, 0.00 );
INSERT INTO `yan_admin_money` VALUES ( 7, 0.00, 0.00, 0.00, 0.00, 0.00 );
/*!40000 ALTER TABLE yan_admin_money ENABLE KEYS */;

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
-- Table structure for table yan_attachment
--

DROP TABLE IF EXISTS `yan_attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = 'utf8' */;
CREATE TABLE `yan_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module` char(15) NOT NULL,
  `filename` char(50) NOT NULL,
  `filepath` char(200) NOT NULL,
  `filesize` int(10) unsigned NOT NULL DEFAULT '0',
  `fileext` char(10) NOT NULL,
  `isimage` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isthumb` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `downloads` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uploadtime` int(10) unsigned NOT NULL DEFAULT '0',
  `uploadip` char(15) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_attachment
--

/*!40000 ALTER TABLE `yan_attachment` DISABLE KEYS */;
INSERT INTO `yan_attachment` VALUES ( 33, 'content', '1449563932.jpg', 'uploads/content/2015/1208/1449563932.jpg', 41101, 'jpg', 1, 1, 0, 1449563932, '127.0.0.1', 1 );
INSERT INTO `yan_attachment` VALUES ( 20, 'content', '1449554057.jpg', 'uploads/content/2015/1208/1449554057.jpg', 35141, 'jpg', 1, 1, 0, 1449554057, '127.0.0.1', 1 );
INSERT INTO `yan_attachment` VALUES ( 5, 'content', 'W020130227229569384832.jpg', 'uploads/content/2015/1207/15095037917.jpg', 100784, 'jpg', 1, 0, 0, 1445675843, '127.0.0.1', 1 );
INSERT INTO `yan_attachment` VALUES ( 27, 'content', '1449558010.jpg', 'uploads/content/2015/1208/1449558010.jpg', 41101, 'jpg', 1, 1, 0, 1449558010, '127.0.0.1', 1 );
INSERT INTO `yan_attachment` VALUES ( 32, 'content', '1449563898.jpg', 'uploads/content/2015/1208/1449563898.jpg', 35141, 'jpg', 1, 1, 0, 1449563898, '127.0.0.1', 1 );
INSERT INTO `yan_attachment` VALUES ( 31, 'content', '1449563862.jpg', 'uploads/content/2015/1208/1449563862.jpg', 38515, 'jpg', 1, 1, 0, 1449563862, '127.0.0.1', 1 );
INSERT INTO `yan_attachment` VALUES ( 30, 'content', '1449562132.jpg', 'uploads/content/2015/1208/1449562132.jpg', 17196, 'jpg', 1, 1, 0, 1449562132, '127.0.0.1', 1 );
INSERT INTO `yan_attachment` VALUES ( 29, 'content', '1449562060.jpg', 'uploads/content/2015/1208/1449562060.jpg', 42734, 'jpg', 1, 1, 0, 1449562060, '127.0.0.1', 1 );
INSERT INTO `yan_attachment` VALUES ( 22, 'content', '1449557292.jpg', 'uploads/content/2015/1208/1449557292.jpg', 38515, 'jpg', 1, 1, 0, 1449557292, '127.0.0.1', 1 );
INSERT INTO `yan_attachment` VALUES ( 19, 'content', '1449549539.jpg', 'uploads/content/2015/1208/1449549539.jpg', 17196, 'jpg', 1, 1, 0, 1449549539, '127.0.0.1', 1 );
INSERT INTO `yan_attachment` VALUES ( 16, 'content', '1449547358.jpg', 'uploads/content/2015/1208/1449547358.jpg', 41101, 'jpg', 1, 1, 0, 1449547358, '127.0.0.1', 1 );
INSERT INTO `yan_attachment` VALUES ( 17, 'content', '1449547386.jpg', 'uploads/content/2015/1208/1449547386.jpg', 42734, 'jpg', 1, 1, 0, 1449547386, '127.0.0.1', 1 );
INSERT INTO `yan_attachment` VALUES ( 28, 'content', '1449561976.jpg', 'uploads/content/2015/1208/1449561976.jpg', 35141, 'jpg', 1, 1, 0, 1449561976, '127.0.0.1', 1 );
INSERT INTO `yan_attachment` VALUES ( 35, 'content', '1449577520.jpg', 'uploads/content/2015/1208/1449577520.jpg', 35141, 'jpg', 1, 1, 0, 1449577520, '127.0.0.1', 1 );
INSERT INTO `yan_attachment` VALUES ( 36, 'content', '1449577639.jpg', 'uploads/content/2015/1208/1449577639.jpg', 35141, 'jpg', 1, 1, 0, 1449577640, '127.0.0.1', 1 );
INSERT INTO `yan_attachment` VALUES ( 38, 'content', '1449628687.jpg', 'frontend/dev/programe1/runtime/uploads/content/2015/1209/1449628687.jpg', 41101, 'jpg', 1, 1, 0, 1449628687, '127.0.0.1', 1 );
INSERT INTO `yan_attachment` VALUES ( 40, 'content', '1449800166.jpg', 'frontend/dev/programe89/runtime/uploads/content/2015/1211/1449800166.jpg', 40845, 'jpg', 1, 1, 0, 1449800166, '127.0.0.1', 1 );
/*!40000 ALTER TABLE yan_attachment ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='幻灯片表';
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_banner
--

INSERT INTO `yan_banner` VALUES ( 2, 1, '579c63cbeaab0.png', 3, 1, '' );
INSERT INTO `yan_banner` VALUES ( 3, 2, '579c63d6e1640.png', 2, 1, '' );
INSERT INTO `yan_banner` VALUES ( 4, 3, '579c63e04ac18.png', 1, 1, '' );

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
INSERT INTO `yan_cache` VALUES ( 'flink.cache.php', 'caches_flink/caches_data/', '<?php\nreturn array (\n);\n?>' );
INSERT INTO `yan_cache` VALUES ( 'login.cache.php', 'caches_config/caches_data/', '<?php\nreturn array (\n  \'trypwd\' => \'5\',\n  \'resetPwdMailTitle\' => \'{username}您好，这是{sitename}发送给您的密码重置邮件\',\n  \'resetPwdMailContent\' => \'尊敬的{username}，这是来自{sitename}的密码重置邮件。点击下面的链接重置您的密码：<br/>{url}<br/>如果链接无法点击，请将链接粘贴到浏览器的地址栏中访问。<br/>{sitename} <br/>{time}\',\n);\n?>' );
INSERT INTO `yan_cache` VALUES ( 'site.cache.php', 'caches_config/caches_data/', '<?php\nreturn array (\n  \'web_name\' => \'二手书商城\',\n  \'web_url\' => \'http://ball\',\n  \'adminEmail\' => \'admin@admin.com\',\n  \'icp\' => \'皖ICP备888888号\',\n  \'statisticsCode\' => \'\',\n  \'visitState\' => \'0\',\n  \'visitMessage\' => \'站点升级中。。。\',\n  \'kf_tel\' => \'\',\n  \'qq\' => \'\',\n);\n?>' );
INSERT INTO `yan_cache` VALUES ( 'register.cache.php', 'caches_config/caches_data/', '<?php\nreturn array (\n  \'type\' => \'1\',\n  \'protocol\' => \'当您申请用户时，表示您已经同意遵守本规章。 欢迎您加入本站点参加交流和讨论，本站点为公共论坛，为维护网上公共秩序和社会稳定，请您自觉遵守以下条款： <br>\n一、不得利用本站危害国家安全、泄露国家秘密，不得侵犯国家社会集体的和公民的合法权益，不得利用本站制作、复制和传播下列信息： <br>\n（一）煽动抗拒、破坏宪法和法律、行政法规实施的；\n（二）煽动颠覆国家政权，推翻社会主义制度的；<br>\n（三）煽动分裂国家、破坏国家统一的；<br>\n（四）煽动民族仇恨、民族歧视，破坏民族团结的；<br>\n（五）捏造或者歪曲事实，散布谣言，扰乱社会秩序的；<br>\n（六）宣扬封建迷信、淫秽、色情、赌博、暴力、凶杀、恐怖、教唆犯罪的；<br>\n（七）公然侮辱他人或者捏造事实诽谤他人的，或者进行其他恶意攻击的；<br>\n（八）损害国家机关信誉的；<br>\n（九）其他违反宪法和法律行政法规的；<br>\n（十）进行商业广告行为的。<br>\n二、互相尊重，对自己的言论和行为负责。<br>\n三、禁止在申请用户时使用相关本站的词汇，或是带有侮辱、毁谤、造谣类的或是有其含义的各种语言进行注册用户，否则我们会将其删除。<br>\n四、禁止以任何方式对本站进行各种破坏行为。<br>\n五、如果您有违反国家相关法律法规的行为，本站概不负责，您的登录论坛信息均被记录无疑，必要时，我们会向相关的国家管理部门提供此类信息。\',\n  \'activeCheck\' => \'0\',\n  \'welcomeType\' => \'1\',\n  \'welcomeTitle\' => \'欢迎你注册成为{sitename}的会员\',\n  \'welcomeContent\' => \'尊敬的{username}，<br/>欢迎你注册成为{sitename}的会员！<br/><br/>本站全体管理人员向您问好！<br/>{sitename}\',\n  \'securityBanUsername\' => \'创始人,管理员,官网,admin\',\n  \'closeMsg\' => \'<h1>暂时关闭注册</h1>\',\n);\n?>' );
INSERT INTO `yan_cache` VALUES ( 'email.cache.php', 'caches_config/caches_data/', '<?php\nreturn array (\n  \'mailOpen\' => \'1\',\n  \'mailHost\' => \'smtp.163.com\',\n  \'mailPort\' => \'25\',\n  \'mailFrom\' => \'leh5com@163.com\',\n  \'mailAuth\' => \'0\',\n  \'mailUser\' => \'leh5com@163.com\',\n  \'mailPassword\' => \'rzmvrzmvsuwxkyqe\',\n);\n?>' );
INSERT INTO `yan_cache` VALUES ( 'kefu.cache.php', 'caches_kefu/caches_data/', '<?php\nreturn array (\n  0 => \n  array (\n    \'id\' => \'1\',\n    \'kefu_name\' => \'客服小可\',\n    \'kefu_qq\' => \'415845404\',\n    \'vieworder\' => \'0\',\n    \'isdisplay\' => \'1\',\n  ),\n);\n?>' );
INSERT INTO `yan_cache` VALUES ( 'credit.cache.php', 'caches_credit/caches_data/', '<?php\nreturn array (\n  0 => \n  array (\n    \'creditid\' => \'1\',\n    \'name\' => \'VIP1\',\n    \'icon\' => \'credit001.png\',\n    \'credit_start\' => \'20\',\n    \'credit_end\' => \'299\',\n    \'monthrate\' => \'0.88\',\n    \'serverate\' => \'5\',\n  ),\n  1 => \n  array (\n    \'creditid\' => \'2\',\n    \'name\' => \'VIP2\',\n    \'icon\' => \'credit002.png\',\n    \'credit_start\' => \'300\',\n    \'credit_end\' => \'999\',\n    \'monthrate\' => \'0.80\',\n    \'serverate\' => \'4\',\n  ),\n  2 => \n  array (\n    \'creditid\' => \'3\',\n    \'name\' => \'VIP3\',\n    \'icon\' => \'credit003.png\',\n    \'credit_start\' => \'1000\',\n    \'credit_end\' => \'2999\',\n    \'monthrate\' => \'0.75\',\n    \'serverate\' => \'3\',\n  ),\n  3 => \n  array (\n    \'creditid\' => \'4\',\n    \'name\' => \'VIP4\',\n    \'icon\' => \'credit004.png\',\n    \'credit_start\' => \'3000\',\n    \'credit_end\' => \'6999\',\n    \'monthrate\' => \'0.70\',\n    \'serverate\' => \'2.5\',\n  ),\n  4 => \n  array (\n    \'creditid\' => \'5\',\n    \'name\' => \'VIP5\',\n    \'icon\' => \'credit005.png\',\n    \'credit_start\' => \'7000\',\n    \'credit_end\' => \'14999\',\n    \'monthrate\' => \'0.65\',\n    \'serverate\' => \'2\',\n  ),\n  5 => \n  array (\n    \'creditid\' => \'6\',\n    \'name\' => \'VIP6\',\n    \'icon\' => \'credit006.png\',\n    \'credit_start\' => \'15000\',\n    \'credit_end\' => \'29999\',\n    \'monthrate\' => \'0.60\',\n    \'serverate\' => \'1\',\n  ),\n  6 => \n  array (\n    \'creditid\' => \'7\',\n    \'name\' => \'VIP7\',\n    \'icon\' => \'credit007.png\',\n    \'credit_start\' => \'30000\',\n    \'credit_end\' => \'69999\',\n    \'monthrate\' => \'0.55\',\n    \'serverate\' => \'0\',\n  ),\n  7 => \n  array (\n    \'creditid\' => \'8\',\n    \'name\' => \'VIP8\',\n    \'icon\' => \'\',\n    \'credit_start\' => \'70000\',\n    \'credit_end\' => \'149999\',\n    \'monthrate\' => \'\',\n    \'serverate\' => \'\',\n  ),\n  8 => \n  array (\n    \'creditid\' => \'9\',\n    \'name\' => \'VIP9\',\n    \'icon\' => \'\',\n    \'credit_start\' => \'150000\',\n    \'credit_end\' => \'299999\',\n    \'monthrate\' => \'\',\n    \'serverate\' => \'\',\n  ),\n  9 => \n  array (\n    \'creditid\' => \'10\',\n    \'name\' => \'10\',\n    \'icon\' => \'\',\n    \'credit_start\' => \'300000\',\n    \'credit_end\' => \'599999\',\n    \'monthrate\' => \'\',\n    \'serverate\' => \'\',\n  ),\n  10 => \n  array (\n    \'creditid\' => \'11\',\n    \'name\' => \'11\',\n    \'icon\' => \'\',\n    \'credit_start\' => \'600000\',\n    \'credit_end\' => \'999999\',\n    \'monthrate\' => \'\',\n    \'serverate\' => \'\',\n  ),\n  11 => \n  array (\n    \'creditid\' => \'12\',\n    \'name\' => \'12\',\n    \'icon\' => \'\',\n    \'credit_start\' => \'1000000\',\n    \'credit_end\' => \'1799999\',\n    \'monthrate\' => \'\',\n    \'serverate\' => \'\',\n  ),\n  12 => \n  array (\n    \'creditid\' => \'13\',\n    \'name\' => \'13\',\n    \'icon\' => \'\',\n    \'credit_start\' => \'1800000\',\n    \'credit_end\' => \'2999999\',\n    \'monthrate\' => \'\',\n    \'serverate\' => \'\',\n  ),\n  13 => \n  array (\n    \'creditid\' => \'14\',\n    \'name\' => \'14\',\n    \'icon\' => \'\',\n    \'credit_start\' => \'3000000\',\n    \'credit_end\' => \'4999999\',\n    \'monthrate\' => \'\',\n    \'serverate\' => \'\',\n  ),\n  14 => \n  array (\n    \'creditid\' => \'15\',\n    \'name\' => \'15\',\n    \'icon\' => \'\',\n    \'credit_start\' => \'5000000\',\n    \'credit_end\' => \'0\',\n    \'monthrate\' => \'\',\n    \'serverate\' => \'\',\n  ),\n);\n?>' );
INSERT INTO `yan_cache` VALUES ( 'loadType.cache.php', 'caches_bizparam/caches_data/', '<?php\nreturn array (\n  0 => \n  array (\n    \'bid\' => \'1\',\n    \'type\' => \'loadType\',\n    \'vieworder\' => \'2\',\n    \'name\' => \'购房借款\',\n    \'value\' => \'购房借款\',\n  ),\n  1 => \n  array (\n    \'bid\' => \'2\',\n    \'type\' => \'loadType\',\n    \'vieworder\' => \'3\',\n    \'name\' => \'购车借款\',\n    \'value\' => \'购车借款\',\n  ),\n  2 => \n  array (\n    \'bid\' => \'3\',\n    \'type\' => \'loadType\',\n    \'vieworder\' => \'4\',\n    \'name\' => \'装修借款\',\n    \'value\' => \'装修借款\',\n  ),\n  3 => \n  array (\n    \'bid\' => \'4\',\n    \'type\' => \'loadType\',\n    \'vieworder\' => \'5\',\n    \'name\' => \'婚礼筹备\',\n    \'value\' => \'婚礼筹备\',\n  ),\n  4 => \n  array (\n    \'bid\' => \'5\',\n    \'type\' => \'loadType\',\n    \'vieworder\' => \'6\',\n    \'name\' => \'教育培训\',\n    \'value\' => \'教育培训\',\n  ),\n  5 => \n  array (\n    \'bid\' => \'6\',\n    \'type\' => \'loadType\',\n    \'vieworder\' => \'7\',\n    \'name\' => \'投资创业\',\n    \'value\' => \'投资创业\',\n  ),\n  6 => \n  array (\n    \'bid\' => \'7\',\n    \'type\' => \'loadType\',\n    \'vieworder\' => \'8\',\n    \'name\' => \'医疗支出\',\n    \'value\' => \'医疗支出\',\n  ),\n  7 => \n  array (\n    \'bid\' => \'8\',\n    \'type\' => \'loadType\',\n    \'vieworder\' => \'9\',\n    \'name\' => \'其他借款\',\n    \'value\' => \'其他借款\',\n  ),\n  8 => \n  array (\n    \'bid\' => \'9\',\n    \'type\' => \'loadType\',\n    \'vieworder\' => \'10\',\n    \'name\' => \'个人消费\',\n    \'value\' => \'个人消费\',\n  ),\n);\n?>' );
INSERT INTO `yan_cache` VALUES ( 'repayTime.cache.php', 'caches_bizparam/caches_data/', '<?php\nreturn array (\n  0 => \n  array (\n    \'bid\' => \'10\',\n    \'type\' => \'repayTime\',\n    \'vieworder\' => \'1\',\n    \'name\' => \'3\',\n    \'value\' => \'3个月\',\n  ),\n  1 => \n  array (\n    \'bid\' => \'11\',\n    \'type\' => \'repayTime\',\n    \'vieworder\' => \'2\',\n    \'name\' => \'6\',\n    \'value\' => \'6个月\',\n  ),\n  2 => \n  array (\n    \'bid\' => \'12\',\n    \'type\' => \'repayTime\',\n    \'vieworder\' => \'3\',\n    \'name\' => \'9\',\n    \'value\' => \'9个月\',\n  ),\n  3 => \n  array (\n    \'bid\' => \'13\',\n    \'type\' => \'repayTime\',\n    \'vieworder\' => \'4\',\n    \'name\' => \'12\',\n    \'value\' => \'12个月\',\n  ),\n  4 => \n  array (\n    \'bid\' => \'14\',\n    \'type\' => \'repayTime\',\n    \'vieworder\' => \'5\',\n    \'name\' => \'15\',\n    \'value\' => \'15个月\',\n  ),\n  5 => \n  array (\n    \'bid\' => \'15\',\n    \'type\' => \'repayTime\',\n    \'vieworder\' => \'6\',\n    \'name\' => \'18\',\n    \'value\' => \'18个月\',\n  ),\n  6 => \n  array (\n    \'bid\' => \'16\',\n    \'type\' => \'repayTime\',\n    \'vieworder\' => \'7\',\n    \'name\' => \'24\',\n    \'value\' => \'24个月\',\n  ),\n  7 => \n  array (\n    \'bid\' => \'56\',\n    \'type\' => \'repayTime\',\n    \'vieworder\' => \'0\',\n    \'name\' => \'0.5\',\n    \'value\' => \'15天\',\n  ),\n  8 => \n  array (\n    \'bid\' => \'57\',\n    \'type\' => \'repayTime\',\n    \'vieworder\' => \'1\',\n    \'name\' => \'2\',\n    \'value\' => \'2个月\',\n  ),\n  9 => \n  array (\n    \'bid\' => \'58\',\n    \'type\' => \'repayTime\',\n    \'vieworder\' => \'0\',\n    \'name\' => \'1\',\n    \'value\' => \'1个月\',\n  ),\n  10 => \n  array (\n    \'bid\' => \'59\',\n    \'type\' => \'repayTime\',\n    \'vieworder\' => \'1\',\n    \'name\' => \'4\',\n    \'value\' => \'4个月\',\n  ),\n);\n?>' );
INSERT INTO `yan_cache` VALUES ( '.cache.php', 'caches_bizparam/caches_data/', '<?php\nreturn array (\n  0 => \n  array (\n    \'bid\' => \'17\',\n    \'type\' => \'\',\n    \'vieworder\' => \'1\',\n    \'name\' => \'1\',\n    \'value\' => \'1天\',\n  ),\n  1 => \n  array (\n    \'bid\' => \'18\',\n    \'type\' => \'\',\n    \'vieworder\' => \'2\',\n    \'name\' => \'2\',\n    \'value\' => \'2天\',\n  ),\n  2 => \n  array (\n    \'bid\' => \'19\',\n    \'type\' => \'\',\n    \'vieworder\' => \'3\',\n    \'name\' => \'3\',\n    \'value\' => \'3天\',\n  ),\n  3 => \n  array (\n    \'bid\' => \'20\',\n    \'type\' => \'\',\n    \'vieworder\' => \'4\',\n    \'name\' => \'4\',\n    \'value\' => \'4天\',\n  ),\n  4 => \n  array (\n    \'bid\' => \'21\',\n    \'type\' => \'\',\n    \'vieworder\' => \'5\',\n    \'name\' => \'5\',\n    \'value\' => \'5天\',\n  ),\n  5 => \n  array (\n    \'bid\' => \'22\',\n    \'type\' => \'\',\n    \'vieworder\' => \'6\',\n    \'name\' => \'6\',\n    \'value\' => \'6天\',\n  ),\n  6 => \n  array (\n    \'bid\' => \'23\',\n    \'type\' => \'\',\n    \'vieworder\' => \'7\',\n    \'name\' => \'7\',\n    \'value\' => \'7天\',\n  ),\n);\n?>' );
INSERT INTO `yan_cache` VALUES ( 'maxAmount.cache.php', 'caches_bizparam/caches_data/', '<?php\nreturn array (\n  0 => \n  array (\n    \'bid\' => \'24\',\n    \'type\' => \'maxAmount\',\n    \'vieworder\' => \'1\',\n    \'name\' => \'0\',\n    \'value\' => \'没有限制\',\n  ),\n  1 => \n  array (\n    \'bid\' => \'25\',\n    \'type\' => \'maxAmount\',\n    \'vieworder\' => \'2\',\n    \'name\' => \'1500\',\n    \'value\' => \'1500元\',\n  ),\n  2 => \n  array (\n    \'bid\' => \'26\',\n    \'type\' => \'maxAmount\',\n    \'vieworder\' => \'3\',\n    \'name\' => \'2000\',\n    \'value\' => \'2000元\',\n  ),\n  3 => \n  array (\n    \'bid\' => \'27\',\n    \'type\' => \'maxAmount\',\n    \'vieworder\' => \'4\',\n    \'name\' => \'3000\',\n    \'value\' => \'3000元\',\n  ),\n  4 => \n  array (\n    \'bid\' => \'28\',\n    \'type\' => \'maxAmount\',\n    \'vieworder\' => \'5\',\n    \'name\' => \'4000\',\n    \'value\' => \'4000元\',\n  ),\n  5 => \n  array (\n    \'bid\' => \'29\',\n    \'type\' => \'maxAmount\',\n    \'vieworder\' => \'6\',\n    \'name\' => \'5000\',\n    \'value\' => \'5000元\',\n  ),\n  6 => \n  array (\n    \'bid\' => \'30\',\n    \'type\' => \'maxAmount\',\n    \'vieworder\' => \'7\',\n    \'name\' => \'6000\',\n    \'value\' => \'6000元\',\n  ),\n  7 => \n  array (\n    \'bid\' => \'31\',\n    \'type\' => \'maxAmount\',\n    \'vieworder\' => \'8\',\n    \'name\' => \'10000\',\n    \'value\' => \'10000元\',\n  ),\n);\n?>' );
INSERT INTO `yan_cache` VALUES ( 'minAmount.cache.php', 'caches_bizparam/caches_data/', '<?php\nreturn array (\n  0 => \n  array (\n    \'bid\' => \'32\',\n    \'type\' => \'minAmount\',\n    \'vieworder\' => \'1\',\n    \'name\' => \'50\',\n    \'value\' => \'50元\',\n  ),\n  1 => \n  array (\n    \'bid\' => \'33\',\n    \'type\' => \'minAmount\',\n    \'vieworder\' => \'2\',\n    \'name\' => \'100\',\n    \'value\' => \'100元\',\n  ),\n  2 => \n  array (\n    \'bid\' => \'34\',\n    \'type\' => \'minAmount\',\n    \'vieworder\' => \'3\',\n    \'name\' => \'200\',\n    \'value\' => \'200元\',\n  ),\n  3 => \n  array (\n    \'bid\' => \'35\',\n    \'type\' => \'minAmount\',\n    \'vieworder\' => \'4\',\n    \'name\' => \'300\',\n    \'value\' => \'300元\',\n  ),\n  4 => \n  array (\n    \'bid\' => \'36\',\n    \'type\' => \'minAmount\',\n    \'vieworder\' => \'5\',\n    \'name\' => \'500\',\n    \'value\' => \'500元\',\n  ),\n  5 => \n  array (\n    \'bid\' => \'37\',\n    \'type\' => \'minAmount\',\n    \'vieworder\' => \'6\',\n    \'name\' => \'1000\',\n    \'value\' => \'1000元\',\n  ),\n  6 => \n  array (\n    \'bid\' => \'38\',\n    \'type\' => \'minAmount\',\n    \'vieworder\' => \'7\',\n    \'name\' => \'2000\',\n    \'value\' => \'2000元\',\n  ),\n  7 => \n  array (\n    \'bid\' => \'39\',\n    \'type\' => \'minAmount\',\n    \'vieworder\' => \'8\',\n    \'name\' => \'3000\',\n    \'value\' => \'3000元\',\n  ),\n  8 => \n  array (\n    \'bid\' => \'40\',\n    \'type\' => \'minAmount\',\n    \'vieworder\' => \'9\',\n    \'name\' => \'4000\',\n    \'value\' => \'4000元\',\n  ),\n  9 => \n  array (\n    \'bid\' => \'41\',\n    \'type\' => \'minAmount\',\n    \'vieworder\' => \'10\',\n    \'name\' => \'5000\',\n    \'value\' => \'5000元\',\n  ),\n);\n?>' );
INSERT INTO `yan_cache` VALUES ( 'credit.cache.php', 'caches_bizparam/caches_data/', '<?php\nreturn array (\n  0 => \n  array (\n    \'bid\' => \'42\',\n    \'type\' => \'credit\',\n    \'vieworder\' => \'1\',\n    \'name\' => \'居住证(暂住证)\',\n    \'value\' => \'10\',\n  ),\n  1 => \n  array (\n    \'bid\' => \'43\',\n    \'type\' => \'credit\',\n    \'vieworder\' => \'2\',\n    \'name\' => \'户口本\',\n    \'value\' => \'10\',\n  ),\n  2 => \n  array (\n    \'bid\' => \'44\',\n    \'type\' => \'credit\',\n    \'vieworder\' => \'3\',\n    \'name\' => \'结婚证\',\n    \'value\' => \'10\',\n  ),\n  3 => \n  array (\n    \'bid\' => \'45\',\n    \'type\' => \'credit\',\n    \'vieworder\' => \'4\',\n    \'name\' => \'行驶证\',\n    \'value\' => \'10\',\n  ),\n  4 => \n  array (\n    \'bid\' => \'46\',\n    \'type\' => \'credit\',\n    \'vieworder\' => \'5\',\n    \'name\' => \'驾驶证\',\n    \'value\' => \'10\',\n  ),\n  5 => \n  array (\n    \'bid\' => \'47\',\n    \'type\' => \'credit\',\n    \'vieworder\' => \'6\',\n    \'name\' => \'营业执照副本(需要彩色)\',\n    \'value\' => \'10\',\n  ),\n  6 => \n  array (\n    \'bid\' => \'48\',\n    \'type\' => \'credit\',\n    \'vieworder\' => \'7\',\n    \'name\' => \'机构代码证\',\n    \'value\' => \'10\',\n  ),\n  7 => \n  array (\n    \'bid\' => \'49\',\n    \'type\' => \'credit\',\n    \'vieworder\' => \'8\',\n    \'name\' => \'公司银行流水(近3个月)\',\n    \'value\' => \'10\',\n  ),\n  8 => \n  array (\n    \'bid\' => \'50\',\n    \'type\' => \'credit\',\n    \'vieworder\' => \'9\',\n    \'name\' => \'劳务合同\',\n    \'value\' => \'10\',\n  ),\n  9 => \n  array (\n    \'bid\' => \'51\',\n    \'type\' => \'credit\',\n    \'vieworder\' => \'10\',\n    \'name\' => \'单位证明\',\n    \'value\' => \'10\',\n  ),\n  10 => \n  array (\n    \'bid\' => \'52\',\n    \'type\' => \'credit\',\n    \'vieworder\' => \'11\',\n    \'name\' => \'工作证\',\n    \'value\' => \'10\',\n  ),\n  11 => \n  array (\n    \'bid\' => \'53\',\n    \'type\' => \'credit\',\n    \'vieworder\' => \'12\',\n    \'name\' => \'借款承诺书\',\n    \'value\' => \'10\',\n  ),\n  12 => \n  array (\n    \'bid\' => \'54\',\n    \'type\' => \'credit\',\n    \'vieworder\' => \'13\',\n    \'name\' => \'信用报告\',\n    \'value\' => \'10\',\n  ),\n  13 => \n  array (\n    \'bid\' => \'55\',\n    \'type\' => \'credit\',\n    \'vieworder\' => \'14\',\n    \'name\' => \'信用卡对账单\',\n    \'value\' => \'10\',\n  ),\n);\n?>' );
INSERT INTO `yan_cache` VALUES ( 'validTime.cache.php', 'caches_bizparam/caches_data/', '<?php\nreturn array (\n  0 => \n  array (\n    \'bid\' => \'17\',\n    \'type\' => \'validTime\',\n    \'vieworder\' => \'1\',\n    \'name\' => \'1\',\n    \'value\' => \'1天\',\n  ),\n  1 => \n  array (\n    \'bid\' => \'18\',\n    \'type\' => \'validTime\',\n    \'vieworder\' => \'2\',\n    \'name\' => \'2\',\n    \'value\' => \'2天\',\n  ),\n  2 => \n  array (\n    \'bid\' => \'19\',\n    \'type\' => \'validTime\',\n    \'vieworder\' => \'3\',\n    \'name\' => \'3\',\n    \'value\' => \'3天\',\n  ),\n  3 => \n  array (\n    \'bid\' => \'20\',\n    \'type\' => \'validTime\',\n    \'vieworder\' => \'4\',\n    \'name\' => \'4\',\n    \'value\' => \'4天\',\n  ),\n  4 => \n  array (\n    \'bid\' => \'21\',\n    \'type\' => \'validTime\',\n    \'vieworder\' => \'5\',\n    \'name\' => \'5\',\n    \'value\' => \'5天\',\n  ),\n  5 => \n  array (\n    \'bid\' => \'22\',\n    \'type\' => \'validTime\',\n    \'vieworder\' => \'6\',\n    \'name\' => \'6\',\n    \'value\' => \'6天\',\n  ),\n  6 => \n  array (\n    \'bid\' => \'23\',\n    \'type\' => \'validTime\',\n    \'vieworder\' => \'7\',\n    \'name\' => \'7\',\n    \'value\' => \'7天\',\n  ),\n);\n?>' );
INSERT INTO `yan_cache` VALUES ( 'notify.cache.php', 'caches_notify/caches_data/', '<?php\nreturn array (\n  \'notify\' => \n  array (\n    \'requestNo\' => \'CZ284832460330150412535647\',\n    \'platformNo\' => \'10012433231\',\n    \'bizType\' => \'RECHARGE\',\n    \'code\' => \'1\',\n    \'message\' => \'充值成功\',\n    \'platformUserNo\' => \'4110301504041245\',\n    \'amount\' => \'1.00\',\n    \'fee\' => \'0.00\',\n    \'feeMode\' => \'PLATFORM\',\n  ),\n);\n?>' );
INSERT INTO `yan_cache` VALUES ( 'resp.cache.php', 'caches_resp/caches_data/', '<?php\nreturn NULL;\n?>' );
INSERT INTO `yan_cache` VALUES ( 'tixian.cache.php', 'caches_tixian/caches_data/', '<?php\nreturn array (\n  \'notify\' => \n  array (\n    \'requestNo\' => \'TX737651581030150414863899\',\n    \'platformNo\' => \'10012433231\',\n    \'bizType\' => \'WITHDRAW\',\n    \'code\' => \'1\',\n    \'platformUserNo\' => \'5610301504042192\',\n    \'amount\' => \'10.00\',\n    \'bankCardNo\' => \'622200*********3670\',\n    \'bank\' => \'ICBC\',\n    \'fee\' => \'2.00\',\n    \'feeMode\' => \'PLATFORM\',\n    \'withdrawType\' => \'NORMAL\',\n  ),\n);\n?>' );
INSERT INTO `yan_cache` VALUES ( 'tixian1.cache.php', 'caches_tixian1/caches_data/', '<?php\nreturn \'TX737651581030150414863899\';\n?>' );
INSERT INTO `yan_cache` VALUES ( 'tongji.cache.php', 'caches_config/caches_data/', '<?php\nreturn array (\n  \'money\' => \n  array (\n    \'money_jrcj\' => \'0.00\',\n    \'money_zrcj\' => \'7.00万\',\n    \'money_bycj\' => \'7.00万\',\n    \'money_sycj\' => \'92.00万\',\n    \'money_bncj\' => \'121.00万\',\n    \'money_lscj\' => \'121.00万\',\n  ),\n  \'bi\' => \n  array (\n    \'bi_jrcj\' => \'0\',\n    \'bi_zrcj\' => \'1\',\n    \'bi_bycj\' => \'1\',\n    \'bi_sycj\' => \'13\',\n    \'bi_bncj\' => \'19\',\n    \'bi_lscj\' => \'19\',\n  ),\n  \'fengxian\' => \'1509.2万\',\n);\n?>' );
INSERT INTO `yan_cache` VALUES ( 'huankuan4.cache.php', 'caches_huankuan/caches_data/', '<?php\nreturn \'4\';\n?>' );
INSERT INTO `yan_cache` VALUES ( 'huankuan5.cache.php', 'caches_huankuan/caches_data/', '<?php\nreturn \'5\';\n?>' );
INSERT INTO `yan_cache` VALUES ( 'huankuan6.cache.php', 'caches_huankuan/caches_data/', '<?php\nreturn \'6\';\n?>' );
INSERT INTO `yan_cache` VALUES ( 'huankuan7.cache.php', 'caches_huankuan/caches_data/', '<?php\nreturn \'7\';\n?>' );
INSERT INTO `yan_cache` VALUES ( 'new_trade.cache.php', 'caches_config/caches_data/', '<?php\nreturn array (\n  0 => \n  array (\n    \'tid\' => \'1\',\n    \'title\' => \'曾经**喜中 时时彩 五星直选\',\n    \'money\' => \'10000元\',\n  ),\n  1 => \n  array (\n    \'tid\' => \'2\',\n    \'title\' => \'曾经**喜中 时时彩 五星直选\',\n    \'money\' => \'10000元\',\n  ),\n  2 => \n  array (\n    \'tid\' => \'3\',\n    \'title\' => \'曾经**喜中 时时彩 五星直选\',\n    \'money\' => \'10000元\',\n  ),\n  3 => \n  array (\n    \'tid\' => \'4\',\n    \'title\' => \'曾经**喜中 时时彩 五星直选\',\n    \'money\' => \'10000元\',\n  ),\n  4 => \n  array (\n    \'tid\' => \'5\',\n    \'title\' => \'曾经**喜中 时时彩 五星直选\',\n    \'money\' => \'10000元\',\n  ),\n  5 => \n  array (\n    \'tid\' => \'6\',\n    \'title\' => \'色色**喜中 时时彩 五星直选\',\n    \'money\' => \'250\',\n  ),\n  6 => \n  array (\n    \'tid\' => \'7\',\n    \'title\' => \'255**喜中 时时彩 三星直选\',\n    \'money\' => \'688\',\n  ),\n);\n?>' );
INSERT INTO `yan_cache` VALUES ( 'draw_rank.cache.php', 'caches_config/caches_data/', '<?php\nreturn array (\n  0 => \n  array (\n    \'tid\' => \'1\',\n    \'title\' => \'88***\',\n    \'money\' => \'3,232,456.00元\',\n  ),\n  1 => \n  array (\n    \'tid\' => \'2\',\n    \'title\' => \'88***\',\n    \'money\' => \'3,232,456.00元\',\n  ),\n  2 => \n  array (\n    \'tid\' => \'3\',\n    \'title\' => \'88***\',\n    \'money\' => \'3,232,456.00元\',\n  ),\n  3 => \n  array (\n    \'tid\' => \'4\',\n    \'title\' => \'88***\',\n    \'money\' => \'3,232,456.00元\',\n  ),\n  4 => \n  array (\n    \'tid\' => \'5\',\n    \'title\' => \'88***\',\n    \'money\' => \'3,232,456.00元\',\n  ),\n  5 => \n  array (\n    \'tid\' => \'6\',\n    \'title\' => \'88***\',\n    \'money\' => \'1,232,456.00元\',\n  ),\n  6 => \n  array (\n    \'tid\' => \'7\',\n    \'title\' => \'88***\',\n    \'money\' => \'332,456.00元\',\n  ),\n  7 => \n  array (\n    \'tid\' => \'8\',\n    \'title\' => \'88***\',\n    \'money\' => \'32,456.00元\',\n  ),\n);\n?>' );
INSERT INTO `yan_cache` VALUES ( 'ssc_omit_stats.cache.php', 'caches_home/caches_data/', '<?php\nreturn array (\n  \'b1\' => \n  array (\n    0 => \n    array (\n      \'appear_total\' => 3,\n      \'appear_percent\' => 0.10000000000000001,\n      \'omit_max\' => \'43\',\n      \'omit_current\' => 10,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 3,\n      \'appear_prob\' => 0,\n    ),\n    1 => \n    array (\n      \'appear_total\' => 6,\n      \'appear_percent\' => 0.20000000000000001,\n      \'omit_max\' => \'57\',\n      \'omit_current\' => 1,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 6,\n      \'appear_prob\' => 0,\n    ),\n    2 => \n    array (\n      \'appear_total\' => 2,\n      \'appear_percent\' => 0.066666666666666666,\n      \'omit_max\' => \'59\',\n      \'omit_current\' => 0,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 2,\n      \'appear_prob\' => 0,\n    ),\n    3 => \n    array (\n      \'appear_total\' => 3,\n      \'appear_percent\' => 0.10000000000000001,\n      \'omit_max\' => \'51\',\n      \'omit_current\' => 20,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 3,\n      \'appear_prob\' => 0,\n    ),\n    4 => \n    array (\n      \'appear_total\' => 4,\n      \'appear_percent\' => 0.13333333333333333,\n      \'omit_max\' => \'50\',\n      \'omit_current\' => 2,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 4,\n      \'appear_prob\' => 0,\n    ),\n    5 => \n    array (\n      \'appear_total\' => 3,\n      \'appear_percent\' => 0.10000000000000001,\n      \'omit_max\' => \'48\',\n      \'omit_current\' => 3,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 3,\n      \'appear_prob\' => 0,\n    ),\n    6 => \n    array (\n      \'appear_total\' => 2,\n      \'appear_percent\' => 0.066666666666666666,\n      \'omit_max\' => \'42\',\n      \'omit_current\' => 17,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 2,\n      \'appear_prob\' => 0,\n    ),\n    7 => \n    array (\n      \'appear_total\' => 2,\n      \'appear_percent\' => 0.066666666666666666,\n      \'omit_max\' => \'42\',\n      \'omit_current\' => 25,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 2,\n      \'appear_prob\' => 0,\n    ),\n    8 => \n    array (\n      \'appear_total\' => 3,\n      \'appear_percent\' => 0.10000000000000001,\n      \'omit_max\' => \'51\',\n      \'omit_current\' => 5,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 3,\n      \'appear_prob\' => 0,\n    ),\n    9 => \n    array (\n      \'appear_total\' => 2,\n      \'appear_percent\' => 0.066666666666666666,\n      \'omit_max\' => \'53\',\n      \'omit_current\' => 8,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 2,\n      \'appear_prob\' => 0,\n    ),\n  ),\n  \'b2\' => \n  array (\n    0 => \n    array (\n      \'appear_total\' => 3,\n      \'appear_percent\' => 0.10000000000000001,\n      \'omit_max\' => \'43\',\n      \'omit_current\' => 10,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 3,\n      \'appear_prob\' => 0,\n    ),\n    1 => \n    array (\n      \'appear_total\' => 3,\n      \'appear_percent\' => 0.10000000000000001,\n      \'omit_max\' => \'40\',\n      \'omit_current\' => 6,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 3,\n      \'appear_prob\' => 0,\n    ),\n    2 => \n    array (\n      \'appear_total\' => 5,\n      \'appear_percent\' => 0.16666666666666666,\n      \'omit_max\' => \'52\',\n      \'omit_current\' => 3,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 5,\n      \'appear_prob\' => 0,\n    ),\n    3 => \n    array (\n      \'appear_total\' => 3,\n      \'appear_percent\' => 0.10000000000000001,\n      \'omit_max\' => \'53\',\n      \'omit_current\' => 0,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 3,\n      \'appear_prob\' => 0,\n    ),\n    4 => \n    array (\n      \'appear_total\' => 2,\n      \'appear_percent\' => 0.066666666666666666,\n      \'omit_max\' => \'53\',\n      \'omit_current\' => 5,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 2,\n      \'appear_prob\' => 0,\n    ),\n    5 => \n    array (\n      \'appear_total\' => 5,\n      \'appear_percent\' => 0.16666666666666666,\n      \'omit_max\' => \'46\',\n      \'omit_current\' => 1,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 5,\n      \'appear_prob\' => 0,\n    ),\n    6 => \n    array (\n      \'appear_total\' => 1,\n      \'appear_percent\' => 0.033333333333333333,\n      \'omit_max\' => \'65\',\n      \'omit_current\' => 4,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 1,\n      \'appear_prob\' => 0,\n    ),\n    7 => \n    array (\n      \'appear_total\' => 1,\n      \'appear_percent\' => 0.033333333333333333,\n      \'omit_max\' => \'46\',\n      \'omit_current\' => 19,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 1,\n      \'appear_prob\' => 0,\n    ),\n    8 => \n    array (\n      \'appear_total\' => 3,\n      \'appear_percent\' => 0.10000000000000001,\n      \'omit_max\' => \'71\',\n      \'omit_current\' => 14,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 3,\n      \'appear_prob\' => 0,\n    ),\n    9 => \n    array (\n      \'appear_total\' => 4,\n      \'appear_percent\' => 0.13333333333333333,\n      \'omit_max\' => \'75\',\n      \'omit_current\' => 21,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 4,\n      \'appear_prob\' => 0,\n    ),\n  ),\n  \'b3\' => \n  array (\n    0 => \n    array (\n      \'appear_total\' => 2,\n      \'appear_percent\' => 0.066666666666666666,\n      \'omit_max\' => \'49\',\n      \'omit_current\' => 16,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 2,\n      \'appear_prob\' => 0,\n    ),\n    1 => \n    array (\n      \'appear_total\' => 2,\n      \'appear_percent\' => 0.066666666666666666,\n      \'omit_max\' => \'47\',\n      \'omit_current\' => 8,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 2,\n      \'appear_prob\' => 0,\n    ),\n    2 => \n    array (\n      \'appear_total\' => 3,\n      \'appear_percent\' => 0.10000000000000001,\n      \'omit_max\' => \'50\',\n      \'omit_current\' => 6,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 3,\n      \'appear_prob\' => 0,\n    ),\n    3 => \n    array (\n      \'appear_total\' => 0,\n      \'appear_percent\' => 0,\n      \'omit_max\' => \'52\',\n      \'omit_current\' => 0,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 0,\n      \'appear_prob\' => 0,\n    ),\n    4 => \n    array (\n      \'appear_total\' => 5,\n      \'appear_percent\' => 0.16666666666666666,\n      \'omit_max\' => \'45\',\n      \'omit_current\' => 11,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 5,\n      \'appear_prob\' => 0,\n    ),\n    5 => \n    array (\n      \'appear_total\' => 2,\n      \'appear_percent\' => 0.066666666666666666,\n      \'omit_max\' => \'42\',\n      \'omit_current\' => 12,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 2,\n      \'appear_prob\' => 0,\n    ),\n    6 => \n    array (\n      \'appear_total\' => 6,\n      \'appear_percent\' => 0.20000000000000001,\n      \'omit_max\' => \'33\',\n      \'omit_current\' => 4,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 6,\n      \'appear_prob\' => 0,\n    ),\n    7 => \n    array (\n      \'appear_total\' => 3,\n      \'appear_percent\' => 0.10000000000000001,\n      \'omit_max\' => \'37\',\n      \'omit_current\' => 3,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 3,\n      \'appear_prob\' => 0,\n    ),\n    8 => \n    array (\n      \'appear_total\' => 6,\n      \'appear_percent\' => 0.20000000000000001,\n      \'omit_max\' => \'53\',\n      \'omit_current\' => 0,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 6,\n      \'appear_prob\' => 0,\n    ),\n    9 => \n    array (\n      \'appear_total\' => 1,\n      \'appear_percent\' => 0.033333333333333333,\n      \'omit_max\' => \'51\',\n      \'omit_current\' => 14,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 1,\n      \'appear_prob\' => 0,\n    ),\n  ),\n  \'b4\' => \n  array (\n    0 => \n    array (\n      \'appear_total\' => 4,\n      \'appear_percent\' => 0.13333333333333333,\n      \'omit_max\' => \'46\',\n      \'omit_current\' => 0,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 4,\n      \'appear_prob\' => 0,\n    ),\n    1 => \n    array (\n      \'appear_total\' => 2,\n      \'appear_percent\' => 0.066666666666666666,\n      \'omit_max\' => \'39\',\n      \'omit_current\' => 4,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 2,\n      \'appear_prob\' => 0,\n    ),\n    2 => \n    array (\n      \'appear_total\' => 2,\n      \'appear_percent\' => 0.066666666666666666,\n      \'omit_max\' => \'65\',\n      \'omit_current\' => 17,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 2,\n      \'appear_prob\' => 0,\n    ),\n    3 => \n    array (\n      \'appear_total\' => 3,\n      \'appear_percent\' => 0.10000000000000001,\n      \'omit_max\' => \'44\',\n      \'omit_current\' => 14,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 3,\n      \'appear_prob\' => 0,\n    ),\n    4 => \n    array (\n      \'appear_total\' => 9,\n      \'appear_percent\' => 0.29999999999999999,\n      \'omit_max\' => \'74\',\n      \'omit_current\' => 3,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 9,\n      \'appear_prob\' => 0,\n    ),\n    5 => \n    array (\n      \'appear_total\' => 3,\n      \'appear_percent\' => 0.10000000000000001,\n      \'omit_max\' => \'49\',\n      \'omit_current\' => 10,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 3,\n      \'appear_prob\' => 0,\n    ),\n    6 => \n    array (\n      \'appear_total\' => 1,\n      \'appear_percent\' => 0.033333333333333333,\n      \'omit_max\' => \'38\',\n      \'omit_current\' => 11,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 1,\n      \'appear_prob\' => 0,\n    ),\n    7 => \n    array (\n      \'appear_total\' => 3,\n      \'appear_percent\' => 0.10000000000000001,\n      \'omit_max\' => \'63\',\n      \'omit_current\' => 2,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 3,\n      \'appear_prob\' => 0,\n    ),\n    8 => \n    array (\n      \'appear_total\' => 1,\n      \'appear_percent\' => 0.033333333333333333,\n      \'omit_max\' => \'47\',\n      \'omit_current\' => 12,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 1,\n      \'appear_prob\' => 0,\n    ),\n    9 => \n    array (\n      \'appear_total\' => 2,\n      \'appear_percent\' => 0.066666666666666666,\n      \'omit_max\' => \'59\',\n      \'omit_current\' => 1,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 2,\n      \'appear_prob\' => 0,\n    ),\n  ),\n  \'b5\' => \n  array (\n    0 => \n    array (\n      \'appear_total\' => 1,\n      \'appear_percent\' => 0.033333333333333333,\n      \'omit_max\' => \'41\',\n      \'omit_current\' => 25,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 1,\n      \'appear_prob\' => 0,\n    ),\n    1 => \n    array (\n      \'appear_total\' => 4,\n      \'appear_percent\' => 0.13333333333333333,\n      \'omit_max\' => \'55\',\n      \'omit_current\' => 5,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 4,\n      \'appear_prob\' => 0,\n    ),\n    2 => \n    array (\n      \'appear_total\' => 2,\n      \'appear_percent\' => 0.066666666666666666,\n      \'omit_max\' => \'36\',\n      \'omit_current\' => 11,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 2,\n      \'appear_prob\' => 0,\n    ),\n    3 => \n    array (\n      \'appear_total\' => 4,\n      \'appear_percent\' => 0.13333333333333333,\n      \'omit_max\' => \'40\',\n      \'omit_current\' => 0,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 4,\n      \'appear_prob\' => 0,\n    ),\n    4 => \n    array (\n      \'appear_total\' => 1,\n      \'appear_percent\' => 0.033333333333333333,\n      \'omit_max\' => \'54\',\n      \'omit_current\' => 15,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 1,\n      \'appear_prob\' => 0,\n    ),\n    5 => \n    array (\n      \'appear_total\' => 4,\n      \'appear_percent\' => 0.13333333333333333,\n      \'omit_max\' => \'77\',\n      \'omit_current\' => 16,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 4,\n      \'appear_prob\' => 0,\n    ),\n    6 => \n    array (\n      \'appear_total\' => 4,\n      \'appear_percent\' => 0.13333333333333333,\n      \'omit_max\' => \'41\',\n      \'omit_current\' => 2,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 4,\n      \'appear_prob\' => 0,\n    ),\n    7 => \n    array (\n      \'appear_total\' => 2,\n      \'appear_percent\' => 0.066666666666666666,\n      \'omit_max\' => \'64\',\n      \'omit_current\' => 3,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 2,\n      \'appear_prob\' => 0,\n    ),\n    8 => \n    array (\n      \'appear_total\' => 3,\n      \'appear_percent\' => 0.10000000000000001,\n      \'omit_max\' => \'41\',\n      \'omit_current\' => 4,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 3,\n      \'appear_prob\' => 0,\n    ),\n    9 => \n    array (\n      \'appear_total\' => 5,\n      \'appear_percent\' => 0.16666666666666666,\n      \'omit_max\' => \'54\',\n      \'omit_current\' => 1,\n      \'omit_average\' => 0,\n      \'appear_recently\' => 5,\n      \'appear_prob\' => 0,\n    ),\n  ),\n);\n?>' );
INSERT INTO `yan_cache` VALUES ( 'ssc_time_cache.cache.php', 'caches_home/caches_data/', '<?php\nreturn array (\n  0 => \n  array (\n    \'time\' => 1437149160,\n    \'no\' => 1,\n  ),\n  1 => \n  array (\n    \'time\' => 1437149460,\n    \'no\' => 2,\n  ),\n  2 => \n  array (\n    \'time\' => 1437149760,\n    \'no\' => 3,\n  ),\n  3 => \n  array (\n    \'time\' => 1437150060,\n    \'no\' => 4,\n  ),\n  4 => \n  array (\n    \'time\' => 1437150360,\n    \'no\' => 5,\n  ),\n  5 => \n  array (\n    \'time\' => 1437150660,\n    \'no\' => 6,\n  ),\n  6 => \n  array (\n    \'time\' => 1437150960,\n    \'no\' => 7,\n  ),\n  7 => \n  array (\n    \'time\' => 1437151260,\n    \'no\' => 8,\n  ),\n  8 => \n  array (\n    \'time\' => 1437151560,\n    \'no\' => 9,\n  ),\n  9 => \n  array (\n    \'time\' => 1437151860,\n    \'no\' => 10,\n  ),\n  10 => \n  array (\n    \'time\' => 1437152160,\n    \'no\' => 11,\n  ),\n  11 => \n  array (\n    \'time\' => 1437152460,\n    \'no\' => 12,\n  ),\n  12 => \n  array (\n    \'time\' => 1437152760,\n    \'no\' => 13,\n  ),\n  13 => \n  array (\n    \'time\' => 1437153060,\n    \'no\' => 14,\n  ),\n  14 => \n  array (\n    \'time\' => 1437153360,\n    \'no\' => 15,\n  ),\n  15 => \n  array (\n    \'time\' => 1437153660,\n    \'no\' => 16,\n  ),\n  16 => \n  array (\n    \'time\' => 1437153960,\n    \'no\' => 17,\n  ),\n  17 => \n  array (\n    \'time\' => 1437154260,\n    \'no\' => 18,\n  ),\n  18 => \n  array (\n    \'time\' => 1437154560,\n    \'no\' => 19,\n  ),\n  19 => \n  array (\n    \'time\' => 1437154860,\n    \'no\' => 20,\n  ),\n  20 => \n  array (\n    \'time\' => 1437155160,\n    \'no\' => 21,\n  ),\n  21 => \n  array (\n    \'time\' => 1437155460,\n    \'no\' => 22,\n  ),\n  22 => \n  array (\n    \'time\' => 1437155760,\n    \'no\' => 23,\n  ),\n  23 => \n  array (\n    \'time\' => 1437184860,\n    \'no\' => 24,\n  ),\n  24 => \n  array (\n    \'time\' => 1437185460,\n    \'no\' => 25,\n  ),\n  25 => \n  array (\n    \'time\' => 1437186060,\n    \'no\' => 26,\n  ),\n  26 => \n  array (\n    \'time\' => 1437186660,\n    \'no\' => 27,\n  ),\n  27 => \n  array (\n    \'time\' => 1437187260,\n    \'no\' => 28,\n  ),\n  28 => \n  array (\n    \'time\' => 1437187860,\n    \'no\' => 29,\n  ),\n  29 => \n  array (\n    \'time\' => 1437188460,\n    \'no\' => 30,\n  ),\n  30 => \n  array (\n    \'time\' => 1437189060,\n    \'no\' => 31,\n  ),\n  31 => \n  array (\n    \'time\' => 1437189660,\n    \'no\' => 32,\n  ),\n  32 => \n  array (\n    \'time\' => 1437190260,\n    \'no\' => 33,\n  ),\n  33 => \n  array (\n    \'time\' => 1437190860,\n    \'no\' => 34,\n  ),\n  34 => \n  array (\n    \'time\' => 1437191460,\n    \'no\' => 35,\n  ),\n  35 => \n  array (\n    \'time\' => 1437192060,\n    \'no\' => 36,\n  ),\n  36 => \n  array (\n    \'time\' => 1437192660,\n    \'no\' => 37,\n  ),\n  37 => \n  array (\n    \'time\' => 1437193260,\n    \'no\' => 38,\n  ),\n  38 => \n  array (\n    \'time\' => 1437193860,\n    \'no\' => 39,\n  ),\n  39 => \n  array (\n    \'time\' => 1437194460,\n    \'no\' => 40,\n  ),\n  40 => \n  array (\n    \'time\' => 1437195060,\n    \'no\' => 41,\n  ),\n  41 => \n  array (\n    \'time\' => 1437195660,\n    \'no\' => 42,\n  ),\n  42 => \n  array (\n    \'time\' => 1437196260,\n    \'no\' => 43,\n  ),\n  43 => \n  array (\n    \'time\' => 1437196860,\n    \'no\' => 44,\n  ),\n  44 => \n  array (\n    \'time\' => 1437197460,\n    \'no\' => 45,\n  ),\n  45 => \n  array (\n    \'time\' => 1437198060,\n    \'no\' => 46,\n  ),\n  46 => \n  array (\n    \'time\' => 1437198660,\n    \'no\' => 47,\n  ),\n  47 => \n  array (\n    \'time\' => 1437199260,\n    \'no\' => 48,\n  ),\n  48 => \n  array (\n    \'time\' => 1437199860,\n    \'no\' => 49,\n  ),\n  49 => \n  array (\n    \'time\' => 1437200460,\n    \'no\' => 50,\n  ),\n  50 => \n  array (\n    \'time\' => 1437201060,\n    \'no\' => 51,\n  ),\n  51 => \n  array (\n    \'time\' => 1437201660,\n    \'no\' => 52,\n  ),\n  52 => \n  array (\n    \'time\' => 1437202260,\n    \'no\' => 53,\n  ),\n  53 => \n  array (\n    \'time\' => 1437202860,\n    \'no\' => 54,\n  ),\n  54 => \n  array (\n    \'time\' => 1437203460,\n    \'no\' => 55,\n  ),\n  55 => \n  array (\n    \'time\' => 1437204060,\n    \'no\' => 56,\n  ),\n  56 => \n  array (\n    \'time\' => 1437204660,\n    \'no\' => 57,\n  ),\n  57 => \n  array (\n    \'time\' => 1437205260,\n    \'no\' => 58,\n  ),\n  58 => \n  array (\n    \'time\' => 1437205860,\n    \'no\' => 59,\n  ),\n  59 => \n  array (\n    \'time\' => 1437206460,\n    \'no\' => 60,\n  ),\n  60 => \n  array (\n    \'time\' => 1437207060,\n    \'no\' => 61,\n  ),\n  61 => \n  array (\n    \'time\' => 1437207660,\n    \'no\' => 62,\n  ),\n  62 => \n  array (\n    \'time\' => 1437208260,\n    \'no\' => 63,\n  ),\n  63 => \n  array (\n    \'time\' => 1437208860,\n    \'no\' => 64,\n  ),\n  64 => \n  array (\n    \'time\' => 1437209460,\n    \'no\' => 65,\n  ),\n  65 => \n  array (\n    \'time\' => 1437210060,\n    \'no\' => 66,\n  ),\n  66 => \n  array (\n    \'time\' => 1437210660,\n    \'no\' => 67,\n  ),\n  67 => \n  array (\n    \'time\' => 1437211260,\n    \'no\' => 68,\n  ),\n  68 => \n  array (\n    \'time\' => 1437211860,\n    \'no\' => 69,\n  ),\n  69 => \n  array (\n    \'time\' => 1437212460,\n    \'no\' => 70,\n  ),\n  70 => \n  array (\n    \'time\' => 1437213060,\n    \'no\' => 71,\n  ),\n  71 => \n  array (\n    \'time\' => 1437213660,\n    \'no\' => 72,\n  ),\n  72 => \n  array (\n    \'time\' => 1437214260,\n    \'no\' => 73,\n  ),\n  73 => \n  array (\n    \'time\' => 1437214860,\n    \'no\' => 74,\n  ),\n  74 => \n  array (\n    \'time\' => 1437215460,\n    \'no\' => 75,\n  ),\n  75 => \n  array (\n    \'time\' => 1437216060,\n    \'no\' => 76,\n  ),\n  76 => \n  array (\n    \'time\' => 1437216660,\n    \'no\' => 77,\n  ),\n  77 => \n  array (\n    \'time\' => 1437217260,\n    \'no\' => 78,\n  ),\n  78 => \n  array (\n    \'time\' => 1437217860,\n    \'no\' => 79,\n  ),\n  79 => \n  array (\n    \'time\' => 1437218460,\n    \'no\' => 80,\n  ),\n  80 => \n  array (\n    \'time\' => 1437219060,\n    \'no\' => 81,\n  ),\n  81 => \n  array (\n    \'time\' => 1437219660,\n    \'no\' => 82,\n  ),\n  82 => \n  array (\n    \'time\' => 1437220260,\n    \'no\' => 83,\n  ),\n  83 => \n  array (\n    \'time\' => 1437220860,\n    \'no\' => 84,\n  ),\n  84 => \n  array (\n    \'time\' => 1437221460,\n    \'no\' => 85,\n  ),\n  85 => \n  array (\n    \'time\' => 1437222060,\n    \'no\' => 86,\n  ),\n  86 => \n  array (\n    \'time\' => 1437222660,\n    \'no\' => 87,\n  ),\n  87 => \n  array (\n    \'time\' => 1437223260,\n    \'no\' => 88,\n  ),\n  88 => \n  array (\n    \'time\' => 1437223860,\n    \'no\' => 89,\n  ),\n  89 => \n  array (\n    \'time\' => 1437224460,\n    \'no\' => 90,\n  ),\n  90 => \n  array (\n    \'time\' => 1437225060,\n    \'no\' => 91,\n  ),\n  91 => \n  array (\n    \'time\' => 1437225660,\n    \'no\' => 92,\n  ),\n  92 => \n  array (\n    \'time\' => 1437226260,\n    \'no\' => 93,\n  ),\n  93 => \n  array (\n    \'time\' => 1437226860,\n    \'no\' => 94,\n  ),\n  94 => \n  array (\n    \'time\' => 1437227460,\n    \'no\' => 95,\n  ),\n  95 => \n  array (\n    \'time\' => 1437228060,\n    \'no\' => 96,\n  ),\n  96 => \n  array (\n    \'time\' => 1437228360,\n    \'no\' => 97,\n  ),\n  97 => \n  array (\n    \'time\' => 1437228660,\n    \'no\' => 98,\n  ),\n  98 => \n  array (\n    \'time\' => 1437228960,\n    \'no\' => 99,\n  ),\n  99 => \n  array (\n    \'time\' => 1437229260,\n    \'no\' => 100,\n  ),\n  100 => \n  array (\n    \'time\' => 1437229560,\n    \'no\' => 101,\n  ),\n  101 => \n  array (\n    \'time\' => 1437229860,\n    \'no\' => 102,\n  ),\n  102 => \n  array (\n    \'time\' => 1437230160,\n    \'no\' => 103,\n  ),\n  103 => \n  array (\n    \'time\' => 1437230460,\n    \'no\' => 104,\n  ),\n  104 => \n  array (\n    \'time\' => 1437230760,\n    \'no\' => 105,\n  ),\n  105 => \n  array (\n    \'time\' => 1437231060,\n    \'no\' => 106,\n  ),\n  106 => \n  array (\n    \'time\' => 1437231360,\n    \'no\' => 107,\n  ),\n  107 => \n  array (\n    \'time\' => 1437231660,\n    \'no\' => 108,\n  ),\n  108 => \n  array (\n    \'time\' => 1437231960,\n    \'no\' => 109,\n  ),\n  109 => \n  array (\n    \'time\' => 1437232260,\n    \'no\' => 110,\n  ),\n  110 => \n  array (\n    \'time\' => 1437232560,\n    \'no\' => 111,\n  ),\n  111 => \n  array (\n    \'time\' => 1437232860,\n    \'no\' => 112,\n  ),\n  112 => \n  array (\n    \'time\' => 1437233160,\n    \'no\' => 113,\n  ),\n  113 => \n  array (\n    \'time\' => 1437233460,\n    \'no\' => 114,\n  ),\n  114 => \n  array (\n    \'time\' => 1437233760,\n    \'no\' => 115,\n  ),\n  115 => \n  array (\n    \'time\' => 1437234060,\n    \'no\' => 116,\n  ),\n  116 => \n  array (\n    \'time\' => 1437234360,\n    \'no\' => 117,\n  ),\n  117 => \n  array (\n    \'time\' => 1437234660,\n    \'no\' => 118,\n  ),\n  118 => \n  array (\n    \'time\' => 1437234960,\n    \'no\' => 119,\n  ),\n  119 => \n  array (\n    \'time\' => 1437235260,\n    \'no\' => 120,\n  ),\n  120 => \n  array (\n    \'time\' => 1437235560,\n    \'no\' => 1,\n  ),\n  121 => \n  array (\n    \'time\' => 1437235860,\n    \'no\' => 2,\n  ),\n  122 => \n  array (\n    \'time\' => 1437236160,\n    \'no\' => 3,\n  ),\n  123 => \n  array (\n    \'time\' => 1437236460,\n    \'no\' => 4,\n  ),\n  124 => \n  array (\n    \'time\' => 1437236760,\n    \'no\' => 5,\n  ),\n  125 => \n  array (\n    \'time\' => 1437237060,\n    \'no\' => 6,\n  ),\n  126 => \n  array (\n    \'time\' => 1437237360,\n    \'no\' => 7,\n  ),\n  127 => \n  array (\n    \'time\' => 1437237660,\n    \'no\' => 8,\n  ),\n  128 => \n  array (\n    \'time\' => 1437237960,\n    \'no\' => 9,\n  ),\n  129 => \n  array (\n    \'time\' => 1437238260,\n    \'no\' => 10,\n  ),\n  130 => \n  array (\n    \'time\' => 1437238560,\n    \'no\' => 11,\n  ),\n  131 => \n  array (\n    \'time\' => 1437238860,\n    \'no\' => 12,\n  ),\n  132 => \n  array (\n    \'time\' => 1437239160,\n    \'no\' => 13,\n  ),\n  133 => \n  array (\n    \'time\' => 1437239460,\n    \'no\' => 14,\n  ),\n  134 => \n  array (\n    \'time\' => 1437239760,\n    \'no\' => 15,\n  ),\n  135 => \n  array (\n    \'time\' => 1437240060,\n    \'no\' => 16,\n  ),\n  136 => \n  array (\n    \'time\' => 1437240360,\n    \'no\' => 17,\n  ),\n  137 => \n  array (\n    \'time\' => 1437240660,\n    \'no\' => 18,\n  ),\n  138 => \n  array (\n    \'time\' => 1437240960,\n    \'no\' => 19,\n  ),\n  139 => \n  array (\n    \'time\' => 1437241260,\n    \'no\' => 20,\n  ),\n  140 => \n  array (\n    \'time\' => 1437241560,\n    \'no\' => 21,\n  ),\n  141 => \n  array (\n    \'time\' => 1437241860,\n    \'no\' => 22,\n  ),\n  142 => \n  array (\n    \'time\' => 1437242160,\n    \'no\' => 23,\n  ),\n  143 => \n  array (\n    \'time\' => 1437271260,\n    \'no\' => 24,\n  ),\n  144 => \n  array (\n    \'time\' => 1437271860,\n    \'no\' => 25,\n  ),\n  145 => \n  array (\n    \'time\' => 1437272460,\n    \'no\' => 26,\n  ),\n  146 => \n  array (\n    \'time\' => 1437273060,\n    \'no\' => 27,\n  ),\n  147 => \n  array (\n    \'time\' => 1437273660,\n    \'no\' => 28,\n  ),\n  148 => \n  array (\n    \'time\' => 1437274260,\n    \'no\' => 29,\n  ),\n  149 => \n  array (\n    \'time\' => 1437274860,\n    \'no\' => 30,\n  ),\n  150 => \n  array (\n    \'time\' => 1437275460,\n    \'no\' => 31,\n  ),\n  151 => \n  array (\n    \'time\' => 1437276060,\n    \'no\' => 32,\n  ),\n  152 => \n  array (\n    \'time\' => 1437276660,\n    \'no\' => 33,\n  ),\n  153 => \n  array (\n    \'time\' => 1437277260,\n    \'no\' => 34,\n  ),\n  154 => \n  array (\n    \'time\' => 1437277860,\n    \'no\' => 35,\n  ),\n  155 => \n  array (\n    \'time\' => 1437278460,\n    \'no\' => 36,\n  ),\n  156 => \n  array (\n    \'time\' => 1437279060,\n    \'no\' => 37,\n  ),\n  157 => \n  array (\n    \'time\' => 1437279660,\n    \'no\' => 38,\n  ),\n  158 => \n  array (\n    \'time\' => 1437280260,\n    \'no\' => 39,\n  ),\n  159 => \n  array (\n    \'time\' => 1437280860,\n    \'no\' => 40,\n  ),\n  160 => \n  array (\n    \'time\' => 1437281460,\n    \'no\' => 41,\n  ),\n  161 => \n  array (\n    \'time\' => 1437282060,\n    \'no\' => 42,\n  ),\n  162 => \n  array (\n    \'time\' => 1437282660,\n    \'no\' => 43,\n  ),\n  163 => \n  array (\n    \'time\' => 1437283260,\n    \'no\' => 44,\n  ),\n  164 => \n  array (\n    \'time\' => 1437283860,\n    \'no\' => 45,\n  ),\n  165 => \n  array (\n    \'time\' => 1437284460,\n    \'no\' => 46,\n  ),\n  166 => \n  array (\n    \'time\' => 1437285060,\n    \'no\' => 47,\n  ),\n  167 => \n  array (\n    \'time\' => 1437285660,\n    \'no\' => 48,\n  ),\n  168 => \n  array (\n    \'time\' => 1437286260,\n    \'no\' => 49,\n  ),\n  169 => \n  array (\n    \'time\' => 1437286860,\n    \'no\' => 50,\n  ),\n  170 => \n  array (\n    \'time\' => 1437287460,\n    \'no\' => 51,\n  ),\n  171 => \n  array (\n    \'time\' => 1437288060,\n    \'no\' => 52,\n  ),\n  172 => \n  array (\n    \'time\' => 1437288660,\n    \'no\' => 53,\n  ),\n  173 => \n  array (\n    \'time\' => 1437289260,\n    \'no\' => 54,\n  ),\n  174 => \n  array (\n    \'time\' => 1437289860,\n    \'no\' => 55,\n  ),\n  175 => \n  array (\n    \'time\' => 1437290460,\n    \'no\' => 56,\n  ),\n  176 => \n  array (\n    \'time\' => 1437291060,\n    \'no\' => 57,\n  ),\n  177 => \n  array (\n    \'time\' => 1437291660,\n    \'no\' => 58,\n  ),\n  178 => \n  array (\n    \'time\' => 1437292260,\n    \'no\' => 59,\n  ),\n  179 => \n  array (\n    \'time\' => 1437292860,\n    \'no\' => 60,\n  ),\n  180 => \n  array (\n    \'time\' => 1437293460,\n    \'no\' => 61,\n  ),\n  181 => \n  array (\n    \'time\' => 1437294060,\n    \'no\' => 62,\n  ),\n  182 => \n  array (\n    \'time\' => 1437294660,\n    \'no\' => 63,\n  ),\n  183 => \n  array (\n    \'time\' => 1437295260,\n    \'no\' => 64,\n  ),\n  184 => \n  array (\n    \'time\' => 1437295860,\n    \'no\' => 65,\n  ),\n  185 => \n  array (\n    \'time\' => 1437296460,\n    \'no\' => 66,\n  ),\n  186 => \n  array (\n    \'time\' => 1437297060,\n    \'no\' => 67,\n  ),\n  187 => \n  array (\n    \'time\' => 1437297660,\n    \'no\' => 68,\n  ),\n  188 => \n  array (\n    \'time\' => 1437298260,\n    \'no\' => 69,\n  ),\n  189 => \n  array (\n    \'time\' => 1437298860,\n    \'no\' => 70,\n  ),\n  190 => \n  array (\n    \'time\' => 1437299460,\n    \'no\' => 71,\n  ),\n  191 => \n  array (\n    \'time\' => 1437300060,\n    \'no\' => 72,\n  ),\n  192 => \n  array (\n    \'time\' => 1437300660,\n    \'no\' => 73,\n  ),\n  193 => \n  array (\n    \'time\' => 1437301260,\n    \'no\' => 74,\n  ),\n  194 => \n  array (\n    \'time\' => 1437301860,\n    \'no\' => 75,\n  ),\n  195 => \n  array (\n    \'time\' => 1437302460,\n    \'no\' => 76,\n  ),\n  196 => \n  array (\n    \'time\' => 1437303060,\n    \'no\' => 77,\n  ),\n  197 => \n  array (\n    \'time\' => 1437303660,\n    \'no\' => 78,\n  ),\n  198 => \n  array (\n    \'time\' => 1437304260,\n    \'no\' => 79,\n  ),\n  199 => \n  array (\n    \'time\' => 1437304860,\n    \'no\' => 80,\n  ),\n  200 => \n  array (\n    \'time\' => 1437305460,\n    \'no\' => 81,\n  ),\n  201 => \n  array (\n    \'time\' => 1437306060,\n    \'no\' => 82,\n  ),\n  202 => \n  array (\n    \'time\' => 1437306660,\n    \'no\' => 83,\n  ),\n  203 => \n  array (\n    \'time\' => 1437307260,\n    \'no\' => 84,\n  ),\n  204 => \n  array (\n    \'time\' => 1437307860,\n    \'no\' => 85,\n  ),\n  205 => \n  array (\n    \'time\' => 1437308460,\n    \'no\' => 86,\n  ),\n  206 => \n  array (\n    \'time\' => 1437309060,\n    \'no\' => 87,\n  ),\n  207 => \n  array (\n    \'time\' => 1437309660,\n    \'no\' => 88,\n  ),\n  208 => \n  array (\n    \'time\' => 1437310260,\n    \'no\' => 89,\n  ),\n  209 => \n  array (\n    \'time\' => 1437310860,\n    \'no\' => 90,\n  ),\n  210 => \n  array (\n    \'time\' => 1437311460,\n    \'no\' => 91,\n  ),\n  211 => \n  array (\n    \'time\' => 1437312060,\n    \'no\' => 92,\n  ),\n  212 => \n  array (\n    \'time\' => 1437312660,\n    \'no\' => 93,\n  ),\n  213 => \n  array (\n    \'time\' => 1437313260,\n    \'no\' => 94,\n  ),\n  214 => \n  array (\n    \'time\' => 1437313860,\n    \'no\' => 95,\n  ),\n  215 => \n  array (\n    \'time\' => 1437314460,\n    \'no\' => 96,\n  ),\n  216 => \n  array (\n    \'time\' => 1437314760,\n    \'no\' => 97,\n  ),\n  217 => \n  array (\n    \'time\' => 1437315060,\n    \'no\' => 98,\n  ),\n  218 => \n  array (\n    \'time\' => 1437315360,\n    \'no\' => 99,\n  ),\n  219 => \n  array (\n    \'time\' => 1437315660,\n    \'no\' => 100,\n  ),\n  220 => \n  array (\n    \'time\' => 1437315960,\n    \'no\' => 101,\n  ),\n  221 => \n  array (\n    \'time\' => 1437316260,\n    \'no\' => 102,\n  ),\n  222 => \n  array (\n    \'time\' => 1437316560,\n    \'no\' => 103,\n  ),\n  223 => \n  array (\n    \'time\' => 1437316860,\n    \'no\' => 104,\n  ),\n  224 => \n  array (\n    \'time\' => 1437317160,\n    \'no\' => 105,\n  ),\n  225 => \n  array (\n    \'time\' => 1437317460,\n    \'no\' => 106,\n  ),\n  226 => \n  array (\n    \'time\' => 1437317760,\n    \'no\' => 107,\n  ),\n  227 => \n  array (\n    \'time\' => 1437318060,\n    \'no\' => 108,\n  ),\n  228 => \n  array (\n    \'time\' => 1437318360,\n    \'no\' => 109,\n  ),\n  229 => \n  array (\n    \'time\' => 1437318660,\n    \'no\' => 110,\n  ),\n  230 => \n  array (\n    \'time\' => 1437318960,\n    \'no\' => 111,\n  ),\n  231 => \n  array (\n    \'time\' => 1437319260,\n    \'no\' => 112,\n  ),\n  232 => \n  array (\n    \'time\' => 1437319560,\n    \'no\' => 113,\n  ),\n  233 => \n  array (\n    \'time\' => 1437319860,\n    \'no\' => 114,\n  ),\n  234 => \n  array (\n    \'time\' => 1437320160,\n    \'no\' => 115,\n  ),\n  235 => \n  array (\n    \'time\' => 1437320460,\n    \'no\' => 116,\n  ),\n  236 => \n  array (\n    \'time\' => 1437320760,\n    \'no\' => 117,\n  ),\n  237 => \n  array (\n    \'time\' => 1437321060,\n    \'no\' => 118,\n  ),\n  238 => \n  array (\n    \'time\' => 1437321360,\n    \'no\' => 119,\n  ),\n);\n?>' );
INSERT INTO `yan_cache` VALUES ( 'category_items_1.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  6 => \'5\',\n  9 => \'0\',\n  11 => \'0\',\n  12 => \'0\',\n  13 => \'0\',\n  14 => \'0\',\n);\n?>' );
INSERT INTO `yan_cache` VALUES ( 'category_items_2.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  7 => \'2\',\n);\n?>' );
INSERT INTO `yan_cache` VALUES ( 'category_items_3.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  8 => \'3\',\n  10 => \'0\',\n);\n?>' );
INSERT INTO `yan_cache` VALUES ( 'category_items_11.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n);\n?>' );
INSERT INTO `yan_cache` VALUES ( 'category_content.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  9 => \n  array (\n    \'catid\' => \'9\',\n    \'type\' => \'0\',\n    \'modelid\' => \'1\',\n    \'parentid\' => \'6\',\n    \'arrparentid\' => \'\',\n    \'child\' => \'0\',\n    \'arrchildid\' => \'\',\n    \'catname\' => \'11\',\n    \'style\' => \'\',\n    \'image\' => \'\',\n    \'description\' => \'\',\n    \'parentdir\' => \'\',\n    \'catdir\' => \'22\',\n    \'url\' => \'\',\n    \'items\' => \'0\',\n    \'hits\' => \'0\',\n    \'setting\' => \'array (\n  \\\'workflowid\\\' => \\\'\\\',\n  \\\'ishtml\\\' => \\\'0\\\',\n  \\\'content_ishtml\\\' => \\\'0\\\',\n  \\\'create_to_html_root\\\' => \\\'0\\\',\n  \\\'template_list\\\' => \\\'\\\',\n  \\\'meta_title\\\' => \\\'\\\',\n  \\\'meta_keywords\\\' => \\\'\\\',\n  \\\'meta_description\\\' => \\\'\\\',\n)\',\n    \'listorder\' => \'0\',\n    \'ismenu\' => \'1\',\n    \'sethtml\' => \'0\',\n    \'letter\' => \'\',\n    \'usable_type\' => \'\',\n    \'isdomain\' => \'0\',\n  ),\n  10 => \n  array (\n    \'catid\' => \'10\',\n    \'type\' => \'0\',\n    \'modelid\' => \'3\',\n    \'parentid\' => \'0\',\n    \'arrparentid\' => \'\',\n    \'child\' => \'0\',\n    \'arrchildid\' => \'\',\n    \'catname\' => \'11\',\n    \'style\' => \'\',\n    \'image\' => \'\',\n    \'description\' => \'\',\n    \'parentdir\' => \'\',\n    \'catdir\' => \'222\',\n    \'url\' => \'\',\n    \'items\' => \'0\',\n    \'hits\' => \'0\',\n    \'setting\' => \'array (\n  \\\'workflowid\\\' => \\\'\\\',\n  \\\'ishtml\\\' => \\\'0\\\',\n  \\\'content_ishtml\\\' => \\\'0\\\',\n  \\\'create_to_html_root\\\' => \\\'0\\\',\n  \\\'template_list\\\' => \\\'\\\',\n  \\\'meta_title\\\' => \\\'\\\',\n  \\\'meta_keywords\\\' => \\\'\\\',\n  \\\'meta_description\\\' => \\\'\\\',\n)\',\n    \'listorder\' => \'0\',\n    \'ismenu\' => \'1\',\n    \'sethtml\' => \'0\',\n    \'letter\' => \'\',\n    \'usable_type\' => \'\',\n    \'isdomain\' => \'0\',\n  ),\n  11 => \n  array (\n    \'catid\' => \'11\',\n    \'type\' => \'0\',\n    \'modelid\' => \'1\',\n    \'parentid\' => \'10\',\n    \'arrparentid\' => \'\',\n    \'child\' => \'0\',\n    \'arrchildid\' => \'\',\n    \'catname\' => \'22\',\n    \'style\' => \'\',\n    \'image\' => \'\',\n    \'description\' => \'\',\n    \'parentdir\' => \'\',\n    \'catdir\' => \'222\',\n    \'url\' => \'\',\n    \'items\' => \'0\',\n    \'hits\' => \'0\',\n    \'setting\' => \'array (\n  \\\'workflowid\\\' => \\\'\\\',\n  \\\'ishtml\\\' => \\\'0\\\',\n  \\\'content_ishtml\\\' => \\\'0\\\',\n  \\\'create_to_html_root\\\' => \\\'0\\\',\n  \\\'template_list\\\' => \\\'\\\',\n  \\\'meta_title\\\' => \\\'\\\',\n  \\\'meta_keywords\\\' => \\\'\\\',\n  \\\'meta_description\\\' => \\\'\\\',\n)\',\n    \'listorder\' => \'0\',\n    \'ismenu\' => \'1\',\n    \'sethtml\' => \'0\',\n    \'letter\' => \'\',\n    \'usable_type\' => \'\',\n    \'isdomain\' => \'0\',\n  ),\n  12 => \n  array (\n    \'catid\' => \'12\',\n    \'type\' => \'0\',\n    \'modelid\' => \'1\',\n    \'parentid\' => \'10\',\n    \'arrparentid\' => \'\',\n    \'child\' => \'0\',\n    \'arrchildid\' => \'\',\n    \'catname\' => \'fdfs\',\n    \'style\' => \'\',\n    \'image\' => \'\',\n    \'description\' => \'\',\n    \'parentdir\' => \'\',\n    \'catdir\' => \'22\',\n    \'url\' => \'\',\n    \'items\' => \'0\',\n    \'hits\' => \'0\',\n    \'setting\' => \'array (\n  \\\'workflowid\\\' => \\\'\\\',\n  \\\'ishtml\\\' => \\\'0\\\',\n  \\\'content_ishtml\\\' => \\\'0\\\',\n  \\\'create_to_html_root\\\' => \\\'0\\\',\n  \\\'template_list\\\' => \\\'\\\',\n  \\\'meta_title\\\' => \\\'\\\',\n  \\\'meta_keywords\\\' => \\\'\\\',\n  \\\'meta_description\\\' => \\\'\\\',\n)\',\n    \'listorder\' => \'0\',\n    \'ismenu\' => \'1\',\n    \'sethtml\' => \'0\',\n    \'letter\' => \'\',\n    \'usable_type\' => \'\',\n    \'isdomain\' => \'0\',\n  ),\n  13 => \n  array (\n    \'catid\' => \'13\',\n    \'type\' => \'0\',\n    \'modelid\' => \'1\',\n    \'parentid\' => \'10\',\n    \'arrparentid\' => \'\',\n    \'child\' => \'0\',\n    \'arrchildid\' => \'\',\n    \'catname\' => \'qq\',\n    \'style\' => \'\',\n    \'image\' => \'\',\n    \'description\' => \'\',\n    \'parentdir\' => \'\',\n    \'catdir\' => \'22\',\n    \'url\' => \'\',\n    \'items\' => \'0\',\n    \'hits\' => \'0\',\n    \'setting\' => \'array (\n  \\\'workflowid\\\' => \\\'\\\',\n  \\\'ishtml\\\' => \\\'0\\\',\n  \\\'content_ishtml\\\' => \\\'0\\\',\n  \\\'create_to_html_root\\\' => \\\'0\\\',\n  \\\'template_list\\\' => \\\'\\\',\n  \\\'meta_title\\\' => \\\'\\\',\n  \\\'meta_keywords\\\' => \\\'\\\',\n  \\\'meta_description\\\' => \\\'\\\',\n)\',\n    \'listorder\' => \'0\',\n    \'ismenu\' => \'1\',\n    \'sethtml\' => \'0\',\n    \'letter\' => \'\',\n    \'usable_type\' => \'\',\n    \'isdomain\' => \'0\',\n  ),\n  14 => \n  array (\n    \'catid\' => \'14\',\n    \'type\' => \'0\',\n    \'modelid\' => \'1\',\n    \'parentid\' => \'10\',\n    \'arrparentid\' => \'\',\n    \'child\' => \'0\',\n    \'arrchildid\' => \'\',\n    \'catname\' => \'uu\',\n    \'style\' => \'\',\n    \'image\' => \'\',\n    \'description\' => \'\',\n    \'parentdir\' => \'\',\n    \'catdir\' => \'22\',\n    \'url\' => \'\',\n    \'items\' => \'0\',\n    \'hits\' => \'0\',\n    \'setting\' => \'array (\n  \\\'workflowid\\\' => \\\'\\\',\n  \\\'ishtml\\\' => \\\'0\\\',\n  \\\'content_ishtml\\\' => \\\'0\\\',\n  \\\'create_to_html_root\\\' => \\\'0\\\',\n  \\\'template_list\\\' => \\\'\\\',\n  \\\'meta_title\\\' => \\\'\\\',\n  \\\'meta_keywords\\\' => \\\'\\\',\n  \\\'meta_description\\\' => \\\'\\\',\n)\',\n    \'listorder\' => \'0\',\n    \'ismenu\' => \'1\',\n    \'sethtml\' => \'0\',\n    \'letter\' => \'\',\n    \'usable_type\' => \'\',\n    \'isdomain\' => \'0\',\n  ),\n  1 => \n  array (\n    \'catid\' => \'1\',\n    \'type\' => \'1\',\n    \'modelid\' => \'0\',\n    \'parentid\' => \'0\',\n    \'arrparentid\' => \'0\',\n    \'child\' => \'1\',\n    \'arrchildid\' => \'1,2,3,4,5\',\n    \'catname\' => \'网站介绍\',\n    \'style\' => \'\',\n    \'image\' => \'\',\n    \'description\' => \'\',\n    \'parentdir\' => \'\',\n    \'catdir\' => \'about\',\n    \'url\' => \'/html/about/\',\n    \'items\' => \'0\',\n    \'hits\' => \'0\',\n    \'setting\' => \'array (\n  \\\'ishtml\\\' => \\\'1\\\',\n  \\\'template_list\\\' => \\\'default\\\',\n  \\\'page_template\\\' => \\\'page\\\',\n  \\\'meta_title\\\' => \\\'\\\',\n  \\\'meta_keywords\\\' => \\\'\\\',\n  \\\'meta_description\\\' => \\\'\\\',\n  \\\'category_ruleid\\\' => \\\'1\\\',\n  \\\'show_ruleid\\\' => \\\'\\\',\n  \\\'repeatchargedays\\\' => \\\'1\\\',\n)\',\n    \'listorder\' => \'1\',\n    \'ismenu\' => \'0\',\n    \'sethtml\' => \'0\',\n    \'letter\' => \'wangzhanjieshao\',\n    \'usable_type\' => \'\',\n    \'isdomain\' => \'0\',\n  ),\n  2 => \n  array (\n    \'catid\' => \'2\',\n    \'type\' => \'1\',\n    \'modelid\' => \'0\',\n    \'parentid\' => \'1\',\n    \'arrparentid\' => \'0,1\',\n    \'child\' => \'0\',\n    \'arrchildid\' => \'2\',\n    \'catname\' => \'关于我们\',\n    \'style\' => \'\',\n    \'image\' => \'\',\n    \'description\' => \'\',\n    \'parentdir\' => \'about/\',\n    \'catdir\' => \'aboutus\',\n    \'url\' => \'/html/about/aboutus/\',\n    \'items\' => \'0\',\n    \'hits\' => \'0\',\n    \'setting\' => \'array (\n  \\\'ishtml\\\' => \\\'1\\\',\n  \\\'template_list\\\' => \\\'default\\\',\n  \\\'page_template\\\' => \\\'page\\\',\n  \\\'meta_title\\\' => \\\'关于我们\\\',\n  \\\'meta_keywords\\\' => \\\'关于我们\\\',\n  \\\'meta_description\\\' => \\\'关于我们\\\',\n  \\\'category_ruleid\\\' => \\\'1\\\',\n  \\\'show_ruleid\\\' => \\\'\\\',\n  \\\'repeatchargedays\\\' => \\\'1\\\',\n)\',\n    \'listorder\' => \'1\',\n    \'ismenu\' => \'1\',\n    \'sethtml\' => \'0\',\n    \'letter\' => \'guanyuwomen\',\n    \'usable_type\' => \'\',\n    \'isdomain\' => \'0\',\n  ),\n  6 => \n  array (\n    \'catid\' => \'6\',\n    \'type\' => \'0\',\n    \'modelid\' => \'1\',\n    \'parentid\' => \'0\',\n    \'arrparentid\' => \'0\',\n    \'child\' => \'0\',\n    \'arrchildid\' => \'6\',\n    \'catname\' => \'国内\',\n    \'style\' => \'\',\n    \'image\' => \'\',\n    \'description\' => \'\',\n    \'parentdir\' => \'\',\n    \'catdir\' => \'guonei\',\n    \'url\' => \'http://phpcms/index.php?m=content&c=index&a=lists&catid=6\',\n    \'items\' => \'5\',\n    \'hits\' => \'0\',\n    \'setting\' => \'array (\n  \\\'workflowid\\\' => \\\'\\\',\n  \\\'ishtml\\\' => \\\'0\\\',\n  \\\'content_ishtml\\\' => \\\'0\\\',\n  \\\'create_to_html_root\\\' => \\\'0\\\',\n  \\\'template_list\\\' => \\\'default\\\',\n  \\\'category_template\\\' => \\\'category\\\',\n  \\\'list_template\\\' => \\\'list\\\',\n  \\\'show_template\\\' => \\\'show\\\',\n  \\\'meta_title\\\' => \\\'\\\',\n  \\\'meta_keywords\\\' => \\\'\\\',\n  \\\'meta_description\\\' => \\\'\\\',\n  \\\'presentpoint\\\' => \\\'1\\\',\n  \\\'defaultchargepoint\\\' => \\\'0\\\',\n  \\\'paytype\\\' => \\\'0\\\',\n  \\\'repeatchargedays\\\' => \\\'1\\\',\n  \\\'category_ruleid\\\' => \\\'6\\\',\n  \\\'show_ruleid\\\' => \\\'16\\\',\n)\',\n    \'listorder\' => \'1\',\n    \'ismenu\' => \'1\',\n    \'sethtml\' => \'0\',\n    \'letter\' => \'guonei\',\n    \'usable_type\' => \'\',\n    \'isdomain\' => \'0\',\n  ),\n  3 => \n  array (\n    \'catid\' => \'3\',\n    \'type\' => \'1\',\n    \'modelid\' => \'0\',\n    \'parentid\' => \'1\',\n    \'arrparentid\' => \'0,1\',\n    \'child\' => \'0\',\n    \'arrchildid\' => \'3\',\n    \'catname\' => \'联系方式\',\n    \'style\' => \'\',\n    \'image\' => \'\',\n    \'description\' => \'\',\n    \'parentdir\' => \'about/\',\n    \'catdir\' => \'contactus\',\n    \'url\' => \'/html/about/contactus/\',\n    \'items\' => \'0\',\n    \'hits\' => \'0\',\n    \'setting\' => \'array (\n  \\\'ishtml\\\' => \\\'1\\\',\n  \\\'template_list\\\' => \\\'default\\\',\n  \\\'page_template\\\' => \\\'page\\\',\n  \\\'meta_title\\\' => \\\'联系方式\\\',\n  \\\'meta_keywords\\\' => \\\'联系方式\\\',\n  \\\'meta_description\\\' => \\\'联系方式\\\',\n  \\\'category_ruleid\\\' => \\\'1\\\',\n  \\\'show_ruleid\\\' => \\\'\\\',\n  \\\'repeatchargedays\\\' => \\\'1\\\',\n)\',\n    \'listorder\' => \'2\',\n    \'ismenu\' => \'1\',\n    \'sethtml\' => \'0\',\n    \'letter\' => \'lianxifangshi\',\n    \'usable_type\' => \'\',\n    \'isdomain\' => \'0\',\n  ),\n  7 => \n  array (\n    \'catid\' => \'7\',\n    \'type\' => \'0\',\n    \'modelid\' => \'2\',\n    \'parentid\' => \'0\',\n    \'arrparentid\' => \'0\',\n    \'child\' => \'0\',\n    \'arrchildid\' => \'7\',\n    \'catname\' => \'下载\',\n    \'style\' => \'\',\n    \'image\' => \'\',\n    \'description\' => \'\',\n    \'parentdir\' => \'\',\n    \'catdir\' => \'down\',\n    \'url\' => \'http://phpcms/index.php?m=content&c=index&a=lists&catid=7\',\n    \'items\' => \'2\',\n    \'hits\' => \'0\',\n    \'setting\' => \'array (\n  \\\'workflowid\\\' => \\\'\\\',\n  \\\'ishtml\\\' => \\\'0\\\',\n  \\\'content_ishtml\\\' => \\\'0\\\',\n  \\\'create_to_html_root\\\' => \\\'0\\\',\n  \\\'template_list\\\' => \\\'default\\\',\n  \\\'category_template\\\' => \\\'category_download\\\',\n  \\\'list_template\\\' => \\\'list_download\\\',\n  \\\'show_template\\\' => \\\'show_download\\\',\n  \\\'meta_title\\\' => \\\'\\\',\n  \\\'meta_keywords\\\' => \\\'\\\',\n  \\\'meta_description\\\' => \\\'\\\',\n  \\\'presentpoint\\\' => \\\'1\\\',\n  \\\'defaultchargepoint\\\' => \\\'0\\\',\n  \\\'paytype\\\' => \\\'0\\\',\n  \\\'repeatchargedays\\\' => \\\'1\\\',\n  \\\'category_ruleid\\\' => \\\'6\\\',\n  \\\'show_ruleid\\\' => \\\'16\\\',\n)\',\n    \'listorder\' => \'2\',\n    \'ismenu\' => \'1\',\n    \'sethtml\' => \'0\',\n    \'letter\' => \'xiazai\',\n    \'usable_type\' => \'\',\n    \'isdomain\' => \'0\',\n  ),\n  4 => \n  array (\n    \'catid\' => \'4\',\n    \'type\' => \'1\',\n    \'modelid\' => \'0\',\n    \'parentid\' => \'1\',\n    \'arrparentid\' => \'0,1\',\n    \'child\' => \'0\',\n    \'arrchildid\' => \'4\',\n    \'catname\' => \'版权声明\',\n    \'style\' => \'\',\n    \'image\' => \'\',\n    \'description\' => \'\',\n    \'parentdir\' => \'about/\',\n    \'catdir\' => \'copyright\',\n    \'url\' => \'http://phpcms/index.php?m=content&c=index&a=lists&catid=4\',\n    \'items\' => \'0\',\n    \'hits\' => \'0\',\n    \'setting\' => \'array (\n  \\\'ishtml\\\' => \\\'0\\\',\n  \\\'template_list\\\' => \\\'default\\\',\n  \\\'page_template\\\' => \\\'page\\\',\n  \\\'meta_title\\\' => \\\'版权声明\\\',\n  \\\'meta_keywords\\\' => \\\'版权声明\\\',\n  \\\'meta_description\\\' => \\\'版权声明\\\',\n  \\\'category_ruleid\\\' => \\\'6\\\',\n  \\\'show_ruleid\\\' => \\\'\\\',\n  \\\'repeatchargedays\\\' => \\\'1\\\',\n)\',\n    \'listorder\' => \'3\',\n    \'ismenu\' => \'1\',\n    \'sethtml\' => \'0\',\n    \'letter\' => \'banquanshengming\',\n    \'usable_type\' => \'\',\n    \'isdomain\' => \'0\',\n  ),\n  8 => \n  array (\n    \'catid\' => \'8\',\n    \'type\' => \'0\',\n    \'modelid\' => \'3\',\n    \'parentid\' => \'0\',\n    \'arrparentid\' => \'0\',\n    \'child\' => \'0\',\n    \'arrchildid\' => \'8\',\n    \'catname\' => \'图片\',\n    \'style\' => \'\',\n    \'image\' => \'\',\n    \'description\' => \'\',\n    \'parentdir\' => \'\',\n    \'catdir\' => \'pps\',\n    \'url\' => \'http://phpcms/index.php?m=content&c=index&a=lists&catid=8\',\n    \'items\' => \'3\',\n    \'hits\' => \'0\',\n    \'setting\' => \'array (\n  \\\'workflowid\\\' => \\\'\\\',\n  \\\'ishtml\\\' => \\\'0\\\',\n  \\\'content_ishtml\\\' => \\\'0\\\',\n  \\\'create_to_html_root\\\' => \\\'0\\\',\n  \\\'template_list\\\' => \\\'default\\\',\n  \\\'category_template\\\' => \\\'category_picture\\\',\n  \\\'list_template\\\' => \\\'list_picture\\\',\n  \\\'show_template\\\' => \\\'show_picture\\\',\n  \\\'meta_title\\\' => \\\'\\\',\n  \\\'meta_keywords\\\' => \\\'\\\',\n  \\\'meta_description\\\' => \\\'\\\',\n  \\\'presentpoint\\\' => \\\'1\\\',\n  \\\'defaultchargepoint\\\' => \\\'0\\\',\n  \\\'paytype\\\' => \\\'0\\\',\n  \\\'repeatchargedays\\\' => \\\'1\\\',\n  \\\'category_ruleid\\\' => \\\'6\\\',\n  \\\'show_ruleid\\\' => \\\'16\\\',\n)\',\n    \'listorder\' => \'3\',\n    \'ismenu\' => \'1\',\n    \'sethtml\' => \'0\',\n    \'letter\' => \'tupian\',\n    \'usable_type\' => \'\',\n    \'isdomain\' => \'0\',\n  ),\n  5 => \n  array (\n    \'catid\' => \'5\',\n    \'type\' => \'1\',\n    \'modelid\' => \'0\',\n    \'parentid\' => \'1\',\n    \'arrparentid\' => \'0,1\',\n    \'child\' => \'0\',\n    \'arrchildid\' => \'5\',\n    \'catname\' => \'招聘信息\',\n    \'style\' => \'\',\n    \'image\' => \'\',\n    \'description\' => \'\',\n    \'parentdir\' => \'about/\',\n    \'catdir\' => \'hr\',\n    \'url\' => \'/html/about/hr/\',\n    \'items\' => \'0\',\n    \'hits\' => \'0\',\n    \'setting\' => \'array (\n  \\\'ishtml\\\' => \\\'1\\\',\n  \\\'template_list\\\' => \\\'default\\\',\n  \\\'page_template\\\' => \\\'page\\\',\n  \\\'meta_title\\\' => \\\'\\\',\n  \\\'meta_keywords\\\' => \\\'\\\',\n  \\\'meta_description\\\' => \\\'\\\',\n  \\\'category_ruleid\\\' => \\\'1\\\',\n  \\\'show_ruleid\\\' => \\\'\\\',\n  \\\'repeatchargedays\\\' => \\\'1\\\',\n)\',\n    \'listorder\' => \'4\',\n    \'ismenu\' => \'1\',\n    \'sethtml\' => \'0\',\n    \'letter\' => \'zhaopinxinxi\',\n    \'usable_type\' => \'\',\n    \'isdomain\' => \'0\',\n  ),\n);\n?>' );
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
INSERT INTO `yan_category` VALUES ( 1, 'content', 1, 0, 0, 0, 1, '1,2,3,4,5', '网站介绍', '', '', '', '', 'about', '/html/about/', 0, 0, 'array (\n  \'ishtml\' => \'1\',\n  \'template_list\' => \'default\',\n  \'page_template\' => \'page\',\n  \'meta_title\' => \'\',\n  \'meta_keywords\' => \'\',\n  \'meta_description\' => \'\',\n  \'category_ruleid\' => \'1\',\n  \'show_ruleid\' => \'\',\n  \'repeatchargedays\' => \'1\',\n)', 1, 0, 0, 'wangzhanjieshao', '' );
INSERT INTO `yan_category` VALUES ( 2, 'content', 1, 0, 1, '0,1', 0, 2, '关于我们', '', '', '', 'about/', 'aboutus', '/html/about/aboutus/', 0, 0, 'array (\n  \'ishtml\' => \'1\',\n  \'template_list\' => \'default\',\n  \'page_template\' => \'page\',\n  \'meta_title\' => \'关于我们\',\n  \'meta_keywords\' => \'关于我们\',\n  \'meta_description\' => \'关于我们\',\n  \'category_ruleid\' => \'1\',\n  \'show_ruleid\' => \'\',\n  \'repeatchargedays\' => \'1\',\n)', 1, 1, 0, 'guanyuwomen', '' );
INSERT INTO `yan_category` VALUES ( 3, 'content', 1, 0, 1, '0,1', 0, 3, '联系方式', '', '', '', 'about/', 'contactus', '/html/about/contactus/', 0, 0, 'array (\n  \'ishtml\' => \'1\',\n  \'template_list\' => \'default\',\n  \'page_template\' => \'page\',\n  \'meta_title\' => \'联系方式\',\n  \'meta_keywords\' => \'联系方式\',\n  \'meta_description\' => \'联系方式\',\n  \'category_ruleid\' => \'1\',\n  \'show_ruleid\' => \'\',\n  \'repeatchargedays\' => \'1\',\n)', 2, 1, 0, 'lianxifangshi', '' );
INSERT INTO `yan_category` VALUES ( 4, 'content', 1, 0, 1, '0,1', 0, 4, '版权声明', '', '', '', 'about/', 'copyright', 'http://phpcms/index.php?m=content&c=index&a=lists&catid=4', 0, 0, 'array (\n  \'ishtml\' => \'0\',\n  \'template_list\' => \'default\',\n  \'page_template\' => \'page\',\n  \'meta_title\' => \'版权声明\',\n  \'meta_keywords\' => \'版权声明\',\n  \'meta_description\' => \'版权声明\',\n  \'category_ruleid\' => \'6\',\n  \'show_ruleid\' => \'\',\n  \'repeatchargedays\' => \'1\',\n)', 3, 1, 0, 'banquanshengming', '' );
INSERT INTO `yan_category` VALUES ( 5, 'content', 1, 0, 1, '0,1', 0, 5, '招聘信息', '', '', '', 'about/', 'hr', '/html/about/hr/', 0, 0, 'array (\n  \'ishtml\' => \'1\',\n  \'template_list\' => \'default\',\n  \'page_template\' => \'page\',\n  \'meta_title\' => \'\',\n  \'meta_keywords\' => \'\',\n  \'meta_description\' => \'\',\n  \'category_ruleid\' => \'1\',\n  \'show_ruleid\' => \'\',\n  \'repeatchargedays\' => \'1\',\n)', 4, 1, 0, 'zhaopinxinxi', '' );
INSERT INTO `yan_category` VALUES ( 6, 'content', 0, 1, 0, 0, 0, 6, '国内', '', '', '', '', 'guonei', 'http://phpcms/index.php?m=content&c=index&a=lists&catid=6', 5, 0, 'array (\n    \'meta_title\' => \'\',\n    \'meta_keywords\' => \'\',\n    \'meta_description\' => \'\',\n    \'category_template\'=>\'\',\n    \'show_template\' => \'\',\n    \'list_template\' => \'news_list\'\n)', 1, 1, 0, 'guonei', '' );
INSERT INTO `yan_category` VALUES ( 7, 'content', 0, 2, 0, 0, 0, 7, '下载', '', '', '', '', 'down', 'http://phpcms/index.php?m=content&c=index&a=lists&catid=7', 2, 0, 'array (\n  \'workflowid\' => \'\',\n  \'ishtml\' => \'0\',\n  \'content_ishtml\' => \'0\',\n  \'create_to_html_root\' => \'0\',\n  \'template_list\' => \'default\',\n  \'category_template\' => \'category_download\',\n  \'list_template\' => \'list_download\',\n  \'show_template\' => \'show_download\',\n  \'meta_title\' => \'\',\n  \'meta_keywords\' => \'\',\n  \'meta_description\' => \'\',\n  \'presentpoint\' => \'1\',\n  \'defaultchargepoint\' => \'0\',\n  \'paytype\' => \'0\',\n  \'repeatchargedays\' => \'1\',\n  \'category_ruleid\' => \'6\',\n  \'show_ruleid\' => \'16\',\n)', 2, 1, 0, 'xiazai', '' );
INSERT INTO `yan_category` VALUES ( 8, 'content', 0, 3, 0, 0, 0, 8, '图片', '', '', '', '', 'pps', 'http://phpcms/index.php?m=content&c=index&a=lists&catid=8', 3, 0, 'array (\n \n  \'admin_form_template\'=>\'form-picture\'\n)', 3, 1, 0, 'tupian', '' );
INSERT INTO `yan_category` VALUES ( 9, 'content', 0, 1, 6, '', 0, '', '安徽新闻', '', '', '', '', 22, '', 0, 0, 'array (\n  \'workflowid\' => \'\',\n  \'ishtml\' => \'0\',\n  \'content_ishtml\' => \'0\',\n  \'create_to_html_root\' => \'0\',\n  \'template_list\' => \'\',\n  \'meta_title\' => \'\',\n  \'meta_keywords\' => \'\',\n  \'meta_description\' => \'\',\n  \'admin_form_template\'=>\'form-news\'\n)', 0, 1, 0, '', '' );
INSERT INTO `yan_category` VALUES ( 10, 'content', 0, 3, 0, '', 0, '', 11, '', '', '', '', 222, '', 0, 0, 'array (\n  \'workflowid\' => \'\',\n  \'ishtml\' => \'0\',\n  \'content_ishtml\' => \'0\',\n  \'create_to_html_root\' => \'0\',\n  \'template_list\' => \'\',\n  \'meta_title\' => \'\',\n  \'meta_keywords\' => \'\',\n  \'meta_description\' => \'\',\n)', 0, 1, 0, '', '' );
INSERT INTO `yan_category` VALUES ( 11, 'content', 0, 1, 10, '', 0, '', 22, '', '', '', '', 222, '', 0, 0, 'array (\n  \'workflowid\' => \'\',\n  \'ishtml\' => \'0\',\n  \'content_ishtml\' => \'0\',\n  \'create_to_html_root\' => \'0\',\n  \'template_list\' => \'\',\n  \'meta_title\' => \'\',\n  \'meta_keywords\' => \'\',\n  \'meta_description\' => \'\',\n)', 0, 1, 0, '', '' );
INSERT INTO `yan_category` VALUES ( 12, 'content', 0, 1, 10, '', 0, '', 'fdfs', '', '', '', '', 22, '', 0, 0, 'array (\n  \'workflowid\' => \'\',\n  \'ishtml\' => \'0\',\n  \'content_ishtml\' => \'0\',\n  \'create_to_html_root\' => \'0\',\n  \'template_list\' => \'\',\n  \'meta_title\' => \'\',\n  \'meta_keywords\' => \'\',\n  \'meta_description\' => \'\',\n)', 0, 1, 0, '', '' );
INSERT INTO `yan_category` VALUES ( 13, 'content', 0, 1, 10, '', 0, '', 'qq', '', '', '', '', 22, '', 0, 0, 'array (\n  \'workflowid\' => \'\',\n  \'ishtml\' => \'0\',\n  \'content_ishtml\' => \'0\',\n  \'create_to_html_root\' => \'0\',\n  \'template_list\' => \'\',\n  \'meta_title\' => \'\',\n  \'meta_keywords\' => \'\',\n  \'meta_description\' => \'\',\n)', 0, 1, 0, '', '' );
INSERT INTO `yan_category` VALUES ( 14, 'content', 0, 1, 10, '', 0, '', 'uu', '', '', '', '', 22, '', 0, 0, 'array (\n  \'workflowid\' => \'\',\n  \'ishtml\' => \'0\',\n  \'content_ishtml\' => \'0\',\n  \'create_to_html_root\' => \'0\',\n  \'template_list\' => \'\',\n  \'meta_title\' => \'\',\n  \'meta_keywords\' => \'\',\n  \'meta_description\' => \'\',\n)', 0, 1, 0, '', '' );
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
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_category_content
--

/*!40000 ALTER TABLE `yan_category_content` DISABLE KEYS */;
INSERT INTO `yan_category_content` VALUES ( 73, 1, 0, '新闻动态', '', 1, '', 73, NULL );
INSERT INTO `yan_category_content` VALUES ( 74, 1, 73, '公司新闻', '', 1, '', 74, NULL );
INSERT INTO `yan_category_content` VALUES ( 75, 1, 73, '行业资讯', '', 1, '', 75, NULL );
INSERT INTO `yan_category_content` VALUES ( 76, 1, 0, '产品展示', '', 1, '', 76, NULL );
INSERT INTO `yan_category_content` VALUES ( 77, 3, 76, '小米手机', '', 1, '', 77, NULL );
INSERT INTO `yan_category_content` VALUES ( 78, 3, 76, '小米路由器', '', 1, '', 78, NULL );
INSERT INTO `yan_category_content` VALUES ( 79, 5, 0, '关于小米', '', 1, '', 80, NULL );
INSERT INTO `yan_category_content` VALUES ( 80, 5, 0, '联系小米', '', 1, '', 79, NULL );
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
INSERT INTO `yan_config` VALUES ( 'logo', '标识', '57a93ec4a314f.png', 1 );
INSERT INTO `yan_config` VALUES ( 'site_title', '网站标题', '小米网', 0 );
INSERT INTO `yan_config` VALUES ( 'site_keywords', '网站关键词', '小米手机 米UI', 0 );
INSERT INTO `yan_config` VALUES ( 'site_description', '网站描述', '小米手机，中国最专业的手机制造商。', 2 );
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
) ENGINE=MyISAM AUTO_INCREMENT=415 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_content
--

/*!40000 ALTER TABLE `yan_content` DISABLE KEYS */;
INSERT INTO `yan_content` VALUES ( 325, 0, 74, 'Java学习之LinkedHashMap', '', '', '', '    前言： 在学习LRU算法的时候，看到LruCache源码实现是基于LinkedHashMap，今天学习一下LinkedHashMap的好处以及如何实现lru缓存机制的。 需求背景： LRU这个算法就是把最近一次使用时间离现在时间最远的数据删除掉，而实现LruCache将会频繁的执行插入、删除等操作， ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 326, 0, 74, '&lt;读书笔记&gt; 代码整洁之道', '', '', '', '    概述 概述 1、本文档的内容主要来源于书籍《代码整洁之道》作者Robert C.Martin，属于读书笔记。 2、软件质量，不仅依赖于架构和项目管理，而且与代码质量紧密相关，本书提出一种，代码质量与整洁成正比的观点，并给出了一系列行之有效的整洁代码操作实践，只要遵循这些规则，就可以编写出整洁的代码， ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 327, 0, 74, '从零开始，DIY一个jQuery（一）', '', '', '', '    从本篇开始会陪大家一起从零开始走一遍 jQuery 的奇妙旅途，在整个系列的实践中，我们会把 jQuery 的主要功能模块都了解和实现一遍。 这会是一段很长的历程，但也会很有意思 —— 作为前端领域的经典之作，jQuery 里有着太多奇思妙想，如果能够深入理解它，对于我们稳固js基础、提升前端大法技 ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 328, 0, 74, '&lt;实训|第八天&gt;超级管理员管理linux用户行为权限附监控主机状态', '', '', '', '    作为运维工程师，系统管理员，你最大的权力就是给别人分配权力，而且你还能时时控制着他们，今天就给大家介绍一下关于管理用户这一方面的前前后后。 开班第八天： 主要课程大纲：（下面我将把自己的身份定位成一个公司的超级管理员） 详细讲解： 补充昨天关于自动挂载软件仓库的操作 昨天我们介绍了软件仓库的制作，不 ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 329, 0, 74, '使用C#WebClient类访问（上传/下载/删除/列出文件目录）由IIS搭建的http文件服务器', '', '', '', '    本文介绍的是如何使用C#访问由IIS搭建的http文件服务器，访问包括：下载、上传、删除及列出文件（或目录） ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 330, 0, 74, 'netty5 HTTP协议栈浅析与实践', '', '', '', '    本文并非纯理论或纯技术类文章，而是结合理论进而实践（虽然没有特别深入的实践），浅析 netty HTTP 协议栈，并着重聊聊实践中遇到的问题及解决方案。耐心看完本文，相信你会对 HTTP 协议有更深层次的理解。 ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 331, 0, 74, 'Rabbitmq 性能测试', '', '', '', '背景： 线上环境，出了一起事故，初步定位是rabbitmq server。 通过抓包发现，是有多个应用使用同一台rabbitmq server。并且多个应用使用rabbitmq的方式也不一样。发现有以下两种方式： 1. 每次produce 一条消息，开闭channel一次 2. 每次produce ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 332, 0, 74, 'OpenCV 之 支持向量机 (一)', '', '', '', '    统计学习方法是由 模型 + 策略 + 算法 构成的，构建一种统计学习方法 (例如，支持向量机)，实际上就是具体去确定这三个要素。 1 支持向量机 支持向量机，简称 SVM (Support Vector Machine)，是一种二分分类模型。 1) 基本模型 (model) 定义在特征空间上的，一种 ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 333, 0, 74, '信号', '', '', '', '    一、信号的产生： 1.用户在终端按下某些键时,终端驱动程序会发送信号给前台进程 例如： Ctrl-C产生SIGINT信号 Ctrl-\\产生SIGQUIT信号 Ctrl-Z产生SIGTSTP信号 2.硬件异常产生信号,这些条件由硬件检测到并通知内核,然后内核向当前进程发送适当的信号。 例如：当前进程执 ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 334, 0, 74, 'Machine Learning In Action 第二章学习笔记: kNN算法', '', '', '', '    本文主要记录《Machine Learning In Action》中第二章的内容。书中以两个具体实例来介绍kNN（k nearest neighbors)，分别是： 通过“约会对象”功能，基本能够了解到kNN算法的工作原理。“手写数字识别”与“约会对象预测”使用完全一样的算法代码，仅仅是数据集有变 ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 335, 0, 74, '使用Idea编写javaweb以及maven的综合（一）', '', '', '', '    今天总结的第一点是在windows下使用idea编写jsp并且使用tomcat部署；第二点是新建maven项目，之前一直是听说也没有自己实践过，今天就大概说一下。 0x01 IDEA 全称 IntelliJ IDEA，是java语言开发的集成环境，我下载的是社区14版本 然后一步步下去，形成的目录结 ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 336, 0, 74, '一张图理解prototype、proto和constructor的三角关系', '', '', '', '    × 目录 [1]图示 [2]概念 [3]说明[4]总结 前面的话 javascript里的关系又多又乱。作用域链是一种单向的链式关系，还算简单清晰；this机制的调用关系，稍微有些复杂；而关于原型，则是prototype、proto和constructor的三角关系。本文先用一张图开宗明义，然后详细 ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 337, 0, 74, '一个三年工作经验的软件工程师的经验之谈', '', '', '', '    时间过得很快，我做软件工程师已经三年整了。我没有做过一个项目，一直在做框架相关的工作，有时维护Web框架代码，有时写移动Hybrid的前端UI框架，也有时做开发工具或自动编译平台等。 我想分享下这段时间在工作上的个人经验，分为几点： 做框架的态度 我工作中做得最多就是框架，框架的本质是提高重用性。对 ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 338, 0, 74, '『.NET Core CLI工具文档』（九）dotnet-run', '', '', '', '    说明：本文是个人翻译文章，由于个人水平有限，有不对的地方请大家帮忙更正。 原文： \"dotnet run\" 翻译： \"dotnet run\" 名称 dotnet run 没有任何明确的编译或启动命令运行“就地”（即运行命令的目录）源代码。 概要 `dotnet run [ framework] [  ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 339, 0, 74, 'Nlog、elasticsearch、Kibana以及logstash在项目中的应用（二）', '', '', '', '上一篇说如何搭建elk的环境（不清楚的可以看我的上一篇博客http://www.cnblogs.com/never-give-up-1015/p/5715904.html），现在来说一下如何用Nlog将日志通过logstash写入elasticsearch。 新建一个项目，用nuget引入Nlog， ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 340, 0, 74, 'STL学习笔记', '', '', '', '    简介 STL（Standard Template Library），即标准模版库，涵盖了常用的数据结构和算法，并具有跨平台的特点。STL是C++标准函数库的一部分，如下图所示： STL含有容器、算法和迭代器组件，其之间的合作如下图所示： STL的底层机制都是以RB-tree（红黑树）完成的。一个红黑 ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 341, 0, 74, 'GROUP BY vs ORDER BY', '', '', '', '    在MySQL中，有下面一种需求场景： 先以字段A分组，再以字段B分组，显示分组后的数据。 举个具体的例子，对 （员工）表来说，先以 分组，再以 分组，显示分组后staff表的全部数据。 表中的初始数据如下： GROUP BY GROUP BY语句用于对被选中输出的列进行分组，MySQL对GROUP  ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 342, 0, 74, 'JAVA不可变类(immutable)机制与String的不可变性', '', '', '', '不可变类是实例创建后就不可以改变成员遍历的值。这种特性使得不可变类提供了线程安全的特性但同时也带来了对象创建的开销，每更改一个属性都是重新创建一个新的对象。JDK内部也提供了很多不可变类如Integer、Double、String等。String的不可变特性主要为了满足常量池、线程安全、类加载的需求... ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 343, 0, 74, '提升大数据数据分析性能的方法及技术（一）', '', '', '', '    关于此文 最近在忙着准备校招的相关复习，所以也整理了一下上学期上课时候的学到的一些知识。刚好发现当时还写了一篇类似于文献综述性质的文章，就在这里贴出来。题材是关于大数据的，也是比较火热的一个话题，虽然现在接触的项目与大数据不太有关联，可能以后也不一定从事这方面的工作吧。就IT行业的研究成果来讲国外期 ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 344, 0, 74, 'Java学习之LinkedHashMap', '', '', '', '    前言： 在学习LRU算法的时候，看到LruCache源码实现是基于LinkedHashMap，今天学习一下LinkedHashMap的好处以及如何实现lru缓存机制的。 需求背景： LRU这个算法就是把最近一次使用时间离现在时间最远的数据删除掉，而实现LruCache将会频繁的执行插入、删除等操作， ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 345, 0, 74, '&lt;读书笔记&gt; 代码整洁之道', '', '', '', '    概述 概述 1、本文档的内容主要来源于书籍《代码整洁之道》作者Robert C.Martin，属于读书笔记。 2、软件质量，不仅依赖于架构和项目管理，而且与代码质量紧密相关，本书提出一种，代码质量与整洁成正比的观点，并给出了一系列行之有效的整洁代码操作实践，只要遵循这些规则，就可以编写出整洁的代码， ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 346, 0, 74, '从零开始，DIY一个jQuery（一）', '', '', '', '    从本篇开始会陪大家一起从零开始走一遍 jQuery 的奇妙旅途，在整个系列的实践中，我们会把 jQuery 的主要功能模块都了解和实现一遍。 这会是一段很长的历程，但也会很有意思 —— 作为前端领域的经典之作，jQuery 里有着太多奇思妙想，如果能够深入理解它，对于我们稳固js基础、提升前端大法技 ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 347, 0, 74, '&lt;实训|第八天&gt;超级管理员管理linux用户行为权限附监控主机状态', '', '', '', '    作为运维工程师，系统管理员，你最大的权力就是给别人分配权力，而且你还能时时控制着他们，今天就给大家介绍一下关于管理用户这一方面的前前后后。 开班第八天： 主要课程大纲：（下面我将把自己的身份定位成一个公司的超级管理员） 详细讲解： 补充昨天关于自动挂载软件仓库的操作 昨天我们介绍了软件仓库的制作，不 ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 348, 0, 74, '使用C#WebClient类访问（上传/下载/删除/列出文件目录）由IIS搭建的http文件服务器', '', '', '', '    本文介绍的是如何使用C#访问由IIS搭建的http文件服务器，访问包括：下载、上传、删除及列出文件（或目录） ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 349, 0, 74, 'netty5 HTTP协议栈浅析与实践', '', '', '', '    本文并非纯理论或纯技术类文章，而是结合理论进而实践（虽然没有特别深入的实践），浅析 netty HTTP 协议栈，并着重聊聊实践中遇到的问题及解决方案。耐心看完本文，相信你会对 HTTP 协议有更深层次的理解。 ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 350, 0, 74, 'Rabbitmq 性能测试', '', '', '', '背景： 线上环境，出了一起事故，初步定位是rabbitmq server。 通过抓包发现，是有多个应用使用同一台rabbitmq server。并且多个应用使用rabbitmq的方式也不一样。发现有以下两种方式： 1. 每次produce 一条消息，开闭channel一次 2. 每次produce ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 351, 0, 74, 'OpenCV 之 支持向量机 (一)', '', '', '', '    统计学习方法是由 模型 + 策略 + 算法 构成的，构建一种统计学习方法 (例如，支持向量机)，实际上就是具体去确定这三个要素。 1 支持向量机 支持向量机，简称 SVM (Support Vector Machine)，是一种二分分类模型。 1) 基本模型 (model) 定义在特征空间上的，一种 ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 352, 0, 74, '信号', '', '', '', '    一、信号的产生： 1.用户在终端按下某些键时,终端驱动程序会发送信号给前台进程 例如： Ctrl-C产生SIGINT信号 Ctrl-\\产生SIGQUIT信号 Ctrl-Z产生SIGTSTP信号 2.硬件异常产生信号,这些条件由硬件检测到并通知内核,然后内核向当前进程发送适当的信号。 例如：当前进程执 ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 353, 0, 74, 'Machine Learning In Action 第二章学习笔记: kNN算法', '', '', '', '    本文主要记录《Machine Learning In Action》中第二章的内容。书中以两个具体实例来介绍kNN（k nearest neighbors)，分别是： 通过“约会对象”功能，基本能够了解到kNN算法的工作原理。“手写数字识别”与“约会对象预测”使用完全一样的算法代码，仅仅是数据集有变 ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 354, 0, 74, '使用Idea编写javaweb以及maven的综合（一）', '', '', '', '    今天总结的第一点是在windows下使用idea编写jsp并且使用tomcat部署；第二点是新建maven项目，之前一直是听说也没有自己实践过，今天就大概说一下。 0x01 IDEA 全称 IntelliJ IDEA，是java语言开发的集成环境，我下载的是社区14版本 然后一步步下去，形成的目录结 ...', 0, 1, 1470709572, 1470709572, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 355, 0, 75, '协作翻译 | 应用敏捷开发的 5 个好理由', '', '', '', '每周都有刚入门的人问我关于“敏捷”的问题；作为一个敏捷的布道师有很多的优势，其中之一就是被认为是一个活着行走的敏捷的百科全书。最近一个问题，是我 在我的一个“敏捷研讨会”碰到的第一个问题：“也就是说...', 0, 1, 1470709597, 1470709597, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 356, 0, 75, 'Git 项目推荐 | x86 汇编脚本虚拟机', '', '', '', '这是一个可以直接解释执行从ida pro里面提取出来的x86汇编代码的虚拟机。', 0, 1, 1470709597, 1470709597, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 357, 0, 75, 'Swig —— NodeJS 模板引擎', '', '', '', 'swig 是node端的一个优秀简洁的模板引擎，类似Python模板引擎Jinja，目前不仅在node端较为通用，相对于jade、ejs优秀，而且在浏览器端也可以很好地运行。', 0, 1, 1470709597, 1470709597, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 358, 0, 75, '每日一博 | 跨站点请求伪造解决方案', '', '', '', '近期通过APPScan扫描程序，发现了不少安全问题，通过大量查阅和尝试最终还是解决掉了，于是整理了一下方便查阅。 1.跨站点请求伪造 首先，什么是跨站点请求伪造？', 0, 1, 1470709597, 1470709597, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 359, 0, 75, '苹果将发布 Swift 3.0 公布第四版开发内容', '', '', '', '尽管正式版的 Swift 3.0 将随着 iOS 10 和 macOS Sierra 正式版在今年秋季推出，但由于 Swift 开源的特性，使得我们能够看到 Swift 的开发进展。Swift 项目由著名程序员 Chris Lattner 担任主管及架构师，今天他在...', 0, 1, 1470709597, 1470709597, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 360, 0, 75, 'Google 域名支持 HSTS，强制访问定向到安全协议', '', '', '', 'Google 官方博客宣布其域名 Google.com 支持 HSTS 。HSTS代表 HTTP Strict Transport Security ，是一种帮助网站将用户从不安全的HTTP版本重定向到安全的HTTPS版本的机制。如果你访问的网站启用了HSTS，那么浏览器...', 0, 1, 1470709597, 1470709597, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 361, 0, 75, 'C++17 功能列表现在完成，进入复查阶段', '', '', '', '在芬兰奥卢的最后一场会议中，ISO C++委员会完成了C++17功能列表的定义。在会议中，通过了许多新的语言和库的功能，包括constexpr if、template &lt;auto&gt;、结构化绑定和一些其他的功能。 正如委员会成员Jens Weller...', 0, 1, 1470709597, 1470709597, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 362, 0, 75, '企业上云如何 Hold 住 OpenStack？', '', '', '', ' 从诞生至今，OpenStack这个开源世界的今日之星，虽然发展速度令人咋舌，但同时也备受争议。企业如何跨过一个个技术缺陷，Hold住 OpenStack，使其在自身数字化转型中最大限度发挥正面作用？近日，红帽全球管理业...', 0, 1, 1470709597, 1470709597, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 363, 0, 75, '非 RESTful 的微软 REST API 指南', '', '', '', '微软发布了创建“RESTful” API的指南。Roy Fielding将这些与REST没有多大关系的API称为HTTP API。 许多组织都发布了创建面向Web的HTTP API的建议，甚至是白宫都发布了一份标准——“白宫Web API标准”。近日，微...', 0, 1, 1470709597, 1470709597, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 364, 0, 75, '协作翻译 | 使用 Gitlab CI 构建 web 应用', '', '', '', '铁路领域是一个快速变化的环境。为了更快地为你提供最新的改进和修复，Captain Train这个web-app要经常进行更新，有时每天要更新多次。 你是不是很想知道我们是如何平滑地构建和部署这个app的呢？那就接着往下读：...', 0, 1, 1470709597, 1470709597, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 365, 0, 75, 'Git 项目推荐 | SPA 后台管理框架', '', '', '', '项目是基于metronic（目录位于assets/下）样式开发的一套SPA（单页面应用）后台管理框架 阅读代码需了解一个MVVM的库-- Vue.js，请参考文档：Vue.js demo 让我们开始快速开发吧：...', 0, 1, 1470709597, 1470709597, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 366, 0, 75, 'orgalorg——并行 SSH 工具', '', '', '', 'orgalorg 是一个 Go 语言开发的并行的 SSH 命令执行和文件同步工具，可同时向多个主机执行命令以及传输文件。', 0, 1, 1470709597, 1470709597, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 367, 0, 75, 'OSChina 周六乱弹 ——胸会压到键盘', '', '', '', ' 比较讨厌现在那些纯拿时间来说事的广告，什么“一个封面画了1万次”，“蛰居两年只为一本书”，“耗费一生只为打造一把椅子”，“几十个后台工程师费劲心血，耗时N年开发的程序”，“研发三年，千锤百炼才下地的...', 0, 1, 1470709597, 1470709597, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 368, 0, 75, '每日一博 | gulp 构建前端工程', '', '', '', 'Gulp 是一个自动化工具，前端开发者可以使用它来处理常见任务： 搭建web服务器 文件保存时自动重载浏览器 使用预处理器如Sass、LESS 优化资源，比如压缩CSS、JavaScript、压缩图片 当然Gulp能做的远不止这些。如果...', 0, 1, 1470709597, 1470709597, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 369, 0, 75, '甲骨文 93 亿美元现金收购云计算商 NetSuite', '', '', '', '据《路透社》报道，商业软件制造商甲骨文将以93亿美元现金购买NetSuite，旨在帮助甲骨文在正快速增长的云计算业务中提升市场份额。 NetSuite股价在早盘交易中涨幅达18%，上涨至108.05美元，略低于甲骨文每股109美...', 0, 1, 1470709597, 1470709597, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 370, 0, 75, 'LinkedIn 文本分析平台：主题挖掘的四大技术步骤', '', '', '', 'LinkedIn前不久发布两篇文章分享了自主研发的文本分析平台Voices的概览和技术细节。LinkedIn认为倾听用户意见回馈很重要，发现反馈的主要话题、用户的热点话题和痛点，能够做出改善产品、提高用户体验等重要的商业...', 0, 1, 1470709597, 1470709597, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 371, 0, 75, '如何在 Github 上发现优秀的开源项目？', '', '', '', '之前发过一系列有关 GitHub 的文章，有同学问了，GitHub 我大概了解了，Git 也差不多会使用了，但是还是搞不清 GitHub 如何帮助我的工作，怎么提升我的工作效率？ 问到点子上了，GitHub 其中一个最重要的作用就是...', 0, 1, 1470709597, 1470709597, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 372, 0, 75, '微软和 SAP 扩展了云环境中的合作关系', '', '', '', '近期在SAP的SAPPHIRE NOW大会上，微软和SAP宣布了两家公司间扩展的合作关系，涵盖了在Azure上对包括SAP HANA企业版负载在内的SAP平台的更深层支持。除了对HANA产品更多的支持外，两家公司将提供横跨它们广受欢迎的...', 0, 1, 1470709597, 1470709597, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 373, 0, 75, '邮件列表存档服务 Gmane 考虑关闭', '', '', '', '邮件列表存档服务 Gmane 的创始人和维护者 Lars Magne Ingebrigtsen 透露他考虑关闭该服务。Gmane 过去几周遭到了DDoS攻击，网站入口已经下线。 Ingebrigtsen 说，2002年他因为难以找到晦涩的技术信息而发起了邮...', 0, 1, 1470709597, 1470709597, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 374, 0, 75, '8 月 OSC 杭州源创会火热报名中 ......', '', '', '', '都说上有天堂，下有杭州，OSC源创会也不能抵挡的美丽，这已经是我们第五次来到杭州，与各位OSCer共约线下，本次八月杭州站我们依旧和去年一样在之江饭店，等你来赴约', 0, 1, 1470709597, 1470709597, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 375, 0, 77, '稀缺新品，现货速发。指纹识别，4100mAh 待机长/金属机身，性能再提升', '579d415fce6bc.jpg', '', '', '稀缺新品，现货速发。指纹识别，4100mAh 待机长/金属机身，性能再提升', 0, 1, 1470709622, 1470709622, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 376, 0, 77, '【超5万好评】下单即送价值99元手机壳和29元小米活塞耳机，数量有限，送完即止。3G+64G超大内存，骁龙808处理器', '579d41601f9dc.jpg', '', '', '【超5万好评】下单即送价值99元手机壳和29元小米活塞耳机，数量有限，送完即止。3G+64G超大内存，骁龙808处理器', 0, 1, 1470709622, 1470709622, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 377, 0, 77, '直降100！ 高通骁龙650处理器，指纹解锁快至0.3秒，轻薄 4000mAh 电池', '579d416043fe4.jpg', '', '', '直降100！ 高通骁龙650处理器，指纹解锁快至0.3秒，轻薄 4000mAh 电池', 0, 1, 1470709622, 1470709622, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 378, 0, 77, '高通骁龙820处理器，4轴防抖相机，十余项黑科技，很轻很快。', '579d4160879ec.jpg', '', '', '高通骁龙820处理器，4轴防抖相机，十余项黑科技，很轻很快。', 0, 1, 1470709622, 1470709622, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 379, 0, 77, '6.44英寸大屏，4850mAh 长续航，大屏有大电量！', '579d4160a5a64.jpg', '', '', '6.44英寸大屏，4850mAh 长续航，大屏有大电量！', 0, 1, 1470709622, 1470709622, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 380, 0, 77, '稀缺新品，现货速发。指纹识别，4100mAh 待机长/金属机身，性能再提升！', '579d4160ba66c.jpg', '', '', '稀缺新品，现货速发。指纹识别，4100mAh 待机长/金属机身，性能再提升！', 0, 1, 1470709622, 1470709622, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 381, 0, 77, '高通骁龙820处理器，4轴防抖相机，十余项黑科技，很轻很快。', '579d4160cf65c.jpg', '', '', '高通骁龙820处理器，4轴防抖相机，十余项黑科技，很轻很快。', 0, 1, 1470709622, 1470709622, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 382, 0, 77, '骁龙808旗舰手机，5英寸阳光屏，3080毫安大电池，全网通大屏手机', '579d4160e9084.jpg', '', '', '骁龙808旗舰手机，5英寸阳光屏，3080毫安大电池，全网通大屏手机', 0, 1, 1470709622, 1470709622, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 383, 0, 77, '骁龙801处理器 5.7英寸 阳光屏 双曲面玻璃', '579d41610927c.jpg', '', '', '骁龙801处理器 5.7英寸 阳光屏 双曲面玻璃', 0, 1, 1470709622, 1470709622, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 384, 0, 77, '六期任性付免息，骁龙808旗舰手机，5英寸阳光屏，3080毫安大电池，全网通大屏手机', '579d41612a9a4.jpg', '', '', '六期任性付免息，骁龙808旗舰手机，5英寸阳光屏，3080毫安大电池，全网通大屏手机', 0, 1, 1470709622, 1470709622, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 385, 0, 77, '红米3手机高配版，不可思议的蜕变', '579d416143fe4.jpg', '', '', '红米3手机高配版，不可思议的蜕变', 0, 1, 1470709622, 1470709622, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 386, 0, 77, '六期任性付免息，骁龙801处理器 5.7英寸 阳光屏 双曲面玻璃', '579d41615e5c4.jpg', '', '', '六期任性付免息，骁龙801处理器 5.7英寸 阳光屏 双曲面玻璃', 0, 1, 1470709622, 1470709622, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 387, 0, 77, '高通64位 四核处理器 5.5英寸高清IPS全贴合大屏', '579d416177c04.jpg', '', '', '高通64位 四核处理器 5.5英寸高清IPS全贴合大屏', 0, 1, 1470709622, 1470709622, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 388, 0, 77, '高通骁龙820处理器，4轴防抖相机，十余项黑科技，很轻很快。', '579d416193954.jpg', '', '', '高通骁龙820处理器，4轴防抖相机，十余项黑科技，很轻很快。', 0, 1, 1470709622, 1470709622, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 389, 0, 77, '我所有的向往，金属机身，指纹识别，4000mAh大电池，从梦寐以求到别无所求！', '579d4161adb4c.jpg', '', '', '我所有的向往，金属机身，指纹识别，4000mAh大电池，从梦寐以求到别无所求！', 0, 1, 1470709622, 1470709622, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 390, 0, 77, '【现货免邮 送店铺延保1年 每人限购1台】八核高性能处理器，金属机身，指纹识别，相位对焦相机，5英寸屏双卡双待。', '579d4161c7d44.jpg', '', '', '【现货免邮 送店铺延保1年 每人限购1台】八核高性能处理器，金属机身，指纹识别，相位对焦相机，5英寸屏双卡双待。', 0, 1, 1470709622, 1470709622, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 391, 0, 77, '新款现货 官方正品 购机送礼 1.送优质手机套+防刮保护膜+好评延保一年 2.买套餐即送钢化膜 顺丰包邮 京津冀次日达！', '579d4161e2af4.jpg', '', '', '新款现货 官方正品 购机送礼 1.送优质手机套+防刮保护膜+好评延保一年 2.买套餐即送钢化膜 顺丰包邮 京津冀次日达！', 0, 1, 1470709622, 1470709622, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 392, 0, 77, '稀缺新品，现货速发。指纹识别，4100mAh 待机长/金属机身，性能再提升！', '579d41620639c.jpg', '', '', '稀缺新品，现货速发。指纹识别，4100mAh 待机长/金属机身，性能再提升！', 0, 1, 1470709622, 1470709622, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 393, 0, 77, '【送店铺延保1年 每人限购1台】0.3秒指纹解锁，4000mAh 电池，5.5英寸高清大屏。↓推荐购买碎屏险↓↓', '579d416223474.jpg', '', '', '【送店铺延保1年 每人限购1台】0.3秒指纹解锁，4000mAh 电池，5.5英寸高清大屏。↓推荐购买碎屏险↓↓', 0, 1, 1470709623, 1470709623, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 394, 0, 77, '新款现货 官方正品 购机送礼 1.送优质手机套+防刮保护膜+好评延保一年 2.买套餐即送钢化膜 顺丰包邮 京津冀次日达！', '579d41623a3a4.jpg', '', '', '新款现货 官方正品 购机送礼 1.送优质手机套+防刮保护膜+好评延保一年 2.买套餐即送钢化膜 顺丰包邮 京津冀次日达！', 0, 1, 1470709623, 1470709623, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 395, 0, 78, '【818狂欢购付定金再降100元】小新Air姊妹款，轻达1.1kg，薄至13.3mm，7秒快速开机。', '579d450eae3e5.jpg', '', '', '【818狂欢购付定金再降100元】小新Air姊妹款，轻达1.1kg，薄至13.3mm，7秒快速开机。', 0, 1, 1470709778, 1470709778, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 396, 0, 78, '全新窄边框设计、内带价值748元免费Office软件；256G纯固态，高性价比', '579d450f37b05.jpg', '', '', '全新窄边框设计、内带价值748元免费Office软件；256G纯固态，高性价比', 0, 1, 1470709778, 1470709778, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 397, 0, 78, '【818狂欢购付定金再降100元】小新Air姊妹款，轻达1.1kg，薄至13.3mm，7秒快速开机。', '579d450f5a745.jpg', '', '', '【818狂欢购付定金再降100元】小新Air姊妹款，轻达1.1kg，薄至13.3mm，7秒快速开机。', 0, 1, 1470709778, 1470709778, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 398, 0, 78, '增之1克则嫌重，超乎寻常的1.1kg+13mm，静音办公11小时', '579d450f6e795.jpg', '', '', '增之1克则嫌重，超乎寻常的1.1kg+13mm，静音办公11小时', 0, 1, 1470709778, 1470709778, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 399, 0, 78, '炫彩轻薄，180度翻转，超强影音体验，彰显女神气质~', '579d450f9162d.jpg', '', '', '炫彩轻薄，180度翻转，超强影音体验，彰显女神气质~', 0, 1, 1470709778, 1470709778, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 400, 0, 78, '新一代13mm超薄全金属机身，搭载第六代处理器', '579d450fa7d8d.jpg', '', '', '新一代13mm超薄全金属机身，搭载第六代处理器', 0, 1, 1470709778, 1470709778, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 401, 0, 78, '炫彩轻薄，180度翻转，超强影音体验，彰显女神气质~', '579d450fbf875.jpg', '', '', '炫彩轻薄，180度翻转，超强影音体验，彰显女神气质~', 0, 1, 1470709778, 1470709778, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 402, 0, 78, '全新设计、轻薄、倾心之作、完美翻转、低耗节能。跌破6000限量抢购', '579d450fd8acd.jpg', '', '', '全新设计、轻薄、倾心之作、完美翻转、低耗节能。跌破6000限量抢购', 0, 1, 1470709778, 1470709778, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 403, 0, 78, '炫彩轻薄，180度翻转，超强影音体验，彰显女神气质~', '579d450ff30ad.jpg', '', '', '炫彩轻薄，180度翻转，超强影音体验，彰显女神气质~', 0, 1, 1470709778, 1470709778, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 404, 0, 78, '超薄机身，180度翻转，低功耗超高性价比~', '579d45101cafd.jpg', '', '', '超薄机身，180度翻转，低功耗超高性价比~', 0, 1, 1470709778, 1470709778, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 405, 0, 78, '超薄机身，180度翻转，低功耗超高性价比~', '579d45102d0b5.jpg', '', '', '超薄机身，180度翻转，低功耗超高性价比~', 0, 1, 1470709778, 1470709778, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 406, 0, 78, '增之1克则嫌重，超乎寻常的1.1kg+13mm，静音办公11小时', '579d45104630d.jpg', '', '', '增之1克则嫌重，超乎寻常的1.1kg+13mm，静音办公11小时', 0, 1, 1470709778, 1470709778, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 407, 0, 78, '轻薄便携，低功耗，强性能，纯固态带来极速体验！', '579d45106282d.jpg', '', '', '轻薄便携，低功耗，强性能，纯固态带来极速体验！', 0, 1, 1470709778, 1470709778, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 408, 0, 78, '轻薄便携，低功耗，强性能，纯固态带来极速体验！', '579d45108433d.jpg', '', '', '轻薄便携，低功耗，强性能，纯固态带来极速体验！', 0, 1, 1470709778, 1470709778, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 409, 0, 78, '【移动端更享优惠】新一代13mm超薄全金属机身，搭载第六代处理器', '579d45109d595.jpg', '', '', '【移动端更享优惠】新一代13mm超薄全金属机身，搭载第六代处理器', 0, 1, 1470709778, 1470709778, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 410, 0, 78, '可以360度自由翻转！和联想Yoga一起翻转地球，翻转自由！买就送包鼠套装', '579d4510bd935.jpg', '', '', '可以360度自由翻转！和联想Yoga一起翻转地球，翻转自由！买就送包鼠套装', 0, 1, 1470709778, 1470709778, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 411, 0, 78, '【品质∞返场购】 正品底价嗨翻全场，更有超值满减优惠返劵。晒图好评返现20元！更有神秘大礼联系客服米女，就是这么萌萌哒！', '579d4510d8acd.jpg', '', '', '【品质∞返场购】 正品底价嗨翻全场，更有超值满减优惠返劵。晒图好评返现20元！更有神秘大礼联系客服米女，就是这么萌萌哒！', 0, 1, 1470709778, 1470709778, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 412, 0, 78, '360°表链设计翻转，超高清IPS屏幕，第六代CPU', '579d45118e42d.jpg', '', '', '360°表链设计翻转，超高清IPS屏幕，第六代CPU', 0, 1, 1470709778, 1470709778, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 413, 0, 78, '【现在，仅5999元】超高清（3200*1800）IPS广视角炫彩触摸屏4GB 256G SSD极速固态硬盘！两色可选', '579d4511c04f5.jpg', '', '', '【现在，仅5999元】超高清（3200*1800）IPS广视角炫彩触摸屏4GB 256G SSD极速固态硬盘！两色可选', 0, 1, 1470709778, 1470709778, 'YANPHP模块化建站', 0, '', '', '', '', '' );
INSERT INTO `yan_content` VALUES ( 414, 0, 78, '糖果粉轻盈粉嫩、玲珑有人、至薄至轻，一见倾心', '579d4511d974d.jpg', '', '', '糖果粉轻盈粉嫩、玲珑有人、至薄至轻，一见倾心', 0, 1, 1470709778, 1470709778, 'YANPHP模块化建站', 0, '', '', '', '', '' );
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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
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
/*!40000 ALTER TABLE yan_model ENABLE KEYS */;

--
-- Table structure for table yan_msg
--

DROP TABLE IF EXISTS `yan_msg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = 'utf8' */;
CREATE TABLE `yan_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `gender` tinyint(2) NOT NULL DEFAULT '0' COMMENT '性别',
  `qq` char(20) NOT NULL COMMENT 'QQ',
  `email` varchar(100) NOT NULL COMMENT '邮箱',
  `mobile` varchar(14) NOT NULL COMMENT '手机',
  `create_time` int(11) NOT NULL COMMENT '留言时间',
  `create_ip` char(20) NOT NULL COMMENT '留言ip',
  `content` text NOT NULL COMMENT '留言内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='留言板';
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_msg
--

/*!40000 ALTER TABLE `yan_msg` DISABLE KEYS */;
INSERT INTO `yan_msg` VALUES ( 11, '王斌', 0, 326251409, '326251409@qq.com', 13965073606, 1469346890, '127.0.0.1', '留言板内容测试' );
/*!40000 ALTER TABLE yan_msg ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='图集';
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table yan_photos
--

INSERT INTO `yan_photos` VALUES ( 10, '', 147, 'd702c73bb07f3d960ff93d441a6763a0.png' );

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
