-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2013 年 07 月 22 日 03:53
-- 服务器版本: 5.5.27
-- PHP 版本: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `tdk`
--

-- --------------------------------------------------------

--
-- 表的结构 `incomingspec`
--

CREATE TABLE IF NOT EXISTS `incomingspec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partno` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `supplier` varchar(20) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `type` varchar(20) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `testvoltage` varchar(20) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `testfrequency` varchar(20) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `nominalvalue` varchar(20) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `unit` int(10) DEFAULT NULL,
  `tolerance` varchar(20) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `tolerancenum` varchar(20) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `residualinductance` varchar(10) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `col1` varchar(10) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `col2` varchar(10) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `col3` varchar(10) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `col4` varchar(10) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `col5` varchar(10) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `incomingspec`
--

INSERT INTO `incomingspec` (`id`, `partno`, `supplier`, `description`, `type`, `testvoltage`, `testfrequency`, `nominalvalue`, `unit`, `tolerance`, `tolerancenum`, `residualinductance`, `col1`, `col2`, `col3`, `col4`, `col5`) VALUES
(1, 'Z23350H2099D  1', '1212', NULL, '1', NULL, '', '23', 5, '1', '0.23', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `inspector`
--

CREATE TABLE IF NOT EXISTS `inspector` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `username` varchar(20) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `password` varchar(20) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `inspector`
--

INSERT INTO `inspector` (`id`, `name`, `username`, `password`) VALUES
(1, '1213', 'inspector2', '123456');

-- --------------------------------------------------------

--
-- 表的结构 `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- 表的结构 `testresultinfo`
--

CREATE TABLE IF NOT EXISTS `testresultinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `testTime` datetime NOT NULL COMMENT '测试时间',
  `partno` int(11) NOT NULL COMMENT 'partno',
  `measvlaue` varchar(255) NOT NULL COMMENT '测试值',
  `result` tinyint(1) NOT NULL COMMENT '测试结果',
  `betchno` varchar(255) NOT NULL COMMENT '批次号',
  `imgurl` varchar(255) NOT NULL COMMENT '图片路径',
  `testStation` varchar(255) NOT NULL COMMENT '测试站',
  `equipmentsn` varchar(255) NOT NULL COMMENT '测试设备序列号',
  `inspector` int(11) NOT NULL COMMENT '测试员',
  `column1` varchar(255) DEFAULT NULL COMMENT '自定义项1',
  `column2` varchar(255) DEFAULT NULL COMMENT '自定义项2',
  `column3` varchar(255) DEFAULT NULL COMMENT '自定义项3',
  `column4` varchar(255) DEFAULT NULL COMMENT '自定义项4',
  `column5` varchar(255) DEFAULT NULL COMMENT '自定义项5',
  `column6` varchar(255) DEFAULT NULL COMMENT '自定义项6',
  `column7` varchar(255) DEFAULT NULL COMMENT '自定义项7',
  `column8` varchar(255) DEFAULT NULL COMMENT '自定义项8',
  `column9` varchar(255) DEFAULT NULL COMMENT '自定义项9',
  `column10` varchar(255) DEFAULT NULL COMMENT '自定义项10',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='产品测试信息' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `testresultinfo`
--

INSERT INTO `testresultinfo` (`id`, `testTime`, `partno`, `measvlaue`, `result`, `betchno`, `imgurl`, `testStation`, `equipmentsn`, `inspector`, `column1`, `column2`, `column3`, `column4`, `column5`, `column6`, `column7`, `column8`, `column9`, `column10`) VALUES
(1, '2013-07-11 22:17:09', 1, '123.4kH', 1, '1111', '2013_07_11/20130711221709_Z23350H2022D  2/TestResult-img.png', 'NA', 'Hello', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '2013-07-11 22:17:09', 1, '123.4kH', 1, '1111', '2013_07_11/20130711221709_Z23350H2022D  2/TestResult-img.png', 'NA', 'Hello', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '2013-07-11 22:17:09', 1, '123.4kH', 1, '1111', '2013_07_11/20130711221709_Z23350H2022D  2/TestResult-img.png', 'NA', 'Hello', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '2013-07-11 22:17:09', 1, '123.4kH', 1, '1111', '2013_07_11/20130711221709_Z23350H2022D  2/TestResult-img.png', 'NA', 'Hello', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '2013-07-11 23:29:33', 1, '11nF', 0, 'ttt', '2013_07_12/20130711232933_Z23350H2099D  1/TestResult-img.png', 'NA', 'Hello', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'Ind'),
(2, 'Cap'),
(3, 'Res');

-- --------------------------------------------------------

--
-- 表的结构 `unit`
--

CREATE TABLE IF NOT EXISTS `unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT NULL,
  `name` varchar(20) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `unit`
--

INSERT INTO `unit` (`id`, `type`, `name`) VALUES
(1, 3, 'Ω'),
(2, 3, 'kΩ'),
(3, 3, 'MΩ'),
(4, 3, 'GΩ'),
(5, 1, 'H'),
(6, 1, 'mH'),
(7, 1, 'uH'),
(8, 1, 'nH'),
(9, 2, 'F'),
(10, 2, 'pF'),
(11, 2, 'uF'),
(12, 2, 'nF');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `username` varchar(20) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `password` varchar(20) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `role`) VALUES
(1, 'test01', 'user01', '123456', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
