-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 12 月 09 日 02:03
-- 服务器版本: 5.5.20
-- PHP 版本: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `myrbac`
--

-- --------------------------------------------------------

--
-- 表的结构 `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_title` varchar(255) NOT NULL,
  `menu_level` tinyint(1) NOT NULL,
  `menu_url` varchar(50) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_title`, `menu_level`, `menu_url`, `parent_id`) VALUES
(1, '用户管理', 1, '', 0),
(2, '文章管理', 1, '', 0),
(3, '用户查询', 2, '/usermanage/search', 1),
(4, '用户编辑', 2, '/usermanage/edit', 1),
(5, '用户删除', 2, '/usermanage/delete', 1),
(6, '用户添加', 2, '/usermanage/add', 1),
(7, '文章查询', 2, '/postmanage/search', 2),
(8, '文章编辑', 2, '/postmanage/edit', 2),
(9, '文章删除', 2, '/postmanage/delete', 2),
(10, '文章添加', 2, '/postmanage/add', 2);

-- --------------------------------------------------------

--
-- 表的结构 `privilege`
--

DROP TABLE IF EXISTS `privilege`;
CREATE TABLE IF NOT EXISTS `privilege` (
  `privilege_id` int(11) NOT NULL AUTO_INCREMENT,
  `privilege_title` varchar(25) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  PRIMARY KEY (`privilege_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `privilege`
--

INSERT INTO `privilege` (`privilege_id`, `privilege_title`, `menu_id`, `action`) VALUES
(1, '用户查询', 3, 'user_search'),
(2, '用户编辑', 4, 'user_edit'),
(3, '用户删除', 5, 'user_delete'),
(4, '用户添加', 6, 'user_add'),
(5, '文章查询', 7, 'post_search'),
(6, '文章编辑', 8, 'post_edit'),
(7, '文章删除', 9, 'post_delete'),
(8, '文章添加', 10, 'post_add');

-- --------------------------------------------------------

--
-- 表的结构 `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(25) NOT NULL,
  `role_shortname` varchar(25) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `role_shortname`) VALUES
(1, '管理员', 'admin'),
(2, '编辑', 'editor'),
(5, '普通用户', 'user');

-- --------------------------------------------------------

--
-- 表的结构 `role_privilege`
--

DROP TABLE IF EXISTS `role_privilege`;
CREATE TABLE IF NOT EXISTS `role_privilege` (
  `role_id` int(11) NOT NULL,
  `privilege_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`privilege_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `role_privilege`
--

INSERT INTO `role_privilege` (`role_id`, `privilege_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(2, 5),
(2, 6),
(2, 7),
(2, 8);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(25) NOT NULL,
  `user_pass` varchar(32) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_pass`, `role_id`) VALUES
(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 1),
(2, 'editor', '5f4dcc3b5aa765d61d8327deb882cf99', 2),
(3, 'user', '5f4dcc3b5aa765d61d8327deb882cf99', 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
