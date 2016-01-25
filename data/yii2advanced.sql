-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 25, 2016 at 04:23 PM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yii2advanced`
--
CREATE DATABASE IF NOT EXISTS `yii2advanced` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `yii2advanced`;

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', 1, NULL),
('create-branch', 2, NULL),
('create-branch', 7, NULL),
('create-company', 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'admin 可以创建branches和compaines', NULL, NULL, NULL, NULL),
('create-branch', 1, '允许用户添加branch', NULL, NULL, NULL, NULL),
('create-company', 1, '允许用户添加company', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'create-branch'),
('admin', 'create-company');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
CREATE TABLE IF NOT EXISTS `branches` (
  `branch_id` int(100) NOT NULL AUTO_INCREMENT,
  `companies_company_id` int(100) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `branch_address` varchar(100) NOT NULL,
  `branch_create_data` datetime NOT NULL,
  `branch_status` enum('active','inactive') NOT NULL,
  PRIMARY KEY (`branch_id`),
  KEY `companies_company_id` (`companies_company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branch_id`, `companies_company_id`, `branch_name`, `branch_address`, `branch_create_data`, `branch_status`) VALUES
(1, 1, 'some branch name', 'some branch address', '2016-01-21 00:00:00', 'active'),
(2, 1, 'another branch', 'another address', '2016-01-20 00:00:00', 'active'),
(3, 2, 'two branch', 'twobranch address', '2016-01-29 00:00:00', 'active'),
(4, 4, '汉字branches', '汉字branches address', '2016-01-20 00:00:00', 'active'),
(5, 2, 'aaa', 'aaadfsdf', '2016-01-20 00:00:00', 'inactive'),
(6, 1, '弹出窗口', '弹出窗口', '2016-01-20 00:00:00', 'inactive'),
(7, 2, 'aaaaaaaa', 'aaaaaaaaaaaaa', '2016-01-14 00:00:00', 'active'),
(8, 6, '联合表单branch name', '联合表单address', '2016-01-29 00:00:00', 'active'),
(9, 4, 'Branch Name', 'Branch Address', '2016-01-07 00:00:00', 'inactive'),
(10, 2, 'asfasd', 'asdfasdf', '2016-01-08 00:00:00', 'inactive'),
(11, 2, 'sdfasd', 'asdfsad', '2016-01-21 00:00:00', 'active'),
(12, 1, 'sdfsa', 'sadf', '2016-01-21 00:00:00', 'active'),
(13, 2, 'asdfsad', 'asdfasd', '2016-01-14 00:00:00', 'active'),
(14, 2, 'adfasdf', 'dfsadfasd', '2016-01-19 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `company_id` int(100) NOT NULL AUTO_INCREMENT,
  `company_start_date` date NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_email` varchar(100) NOT NULL,
  `company_address` varchar(100) NOT NULL,
  `company_created_date` datetime NOT NULL,
  `company_status` enum('active','inactive') NOT NULL,
  `logo` varchar(100) NOT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`company_id`, `company_start_date`, `company_name`, `company_email`, `company_address`, `company_created_date`, `company_status`, `logo`) VALUES
(1, '0000-00-00', 'ABC', 'abc@aa.com', 'some address', '2016-01-20 00:00:00', 'active', ''),
(2, '0000-00-00', 'company two', 'two@aa.aaa', 'two company address', '2016-01-23 00:00:00', 'active', ''),
(3, '2016-01-11', 'modules company', 'modules@adfa.fsdf', 'modules address', '2016-01-11 00:00:00', 'inactive', ''),
(4, '0000-00-00', '汉字公司试试行不行', 'ajfdlas@faldf.comfsadf', '汉字地址', '2016-01-06 00:00:00', 'active', ''),
(5, '0000-00-00', '上传logo', 'abc@aa.com', 'company address', '2016-01-06 00:00:00', 'active', 'uploads/上传logo.png'),
(6, '0000-00-00', '联合表单company', 'lianhebiaodan@biaodan.aaa', '联合表单comany Address', '2016-01-22 00:00:00', 'active', 'uploads/联合表单company.png');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `composer_id` int(11) NOT NULL AUTO_INCREMENT,
  `composer_name` varchar(100) NOT NULL,
  `zip_code` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  PRIMARY KEY (`composer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`composer_id`, `composer_name`, `zip_code`, `city`, `province`) VALUES
(1, '一个composer', '2', '一个城市', '一个省');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `department_id` int(100) NOT NULL AUTO_INCREMENT,
  `branches_branch_id` int(100) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `companies_company_id` int(100) NOT NULL,
  `department_create_data` datetime NOT NULL,
  `department_status` enum('active','inactive') NOT NULL,
  PRIMARY KEY (`department_id`),
  KEY `companies_company_id` (`companies_company_id`),
  KEY `branches_branch_id` (`branches_branch_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `branches_branch_id`, `department_name`, `companies_company_id`, `department_create_data`, `department_status`) VALUES
(1, 1, 'is department', 1, '2016-01-22 00:00:00', 'active'),
(2, 1, 'some department name haha', 1, '2016-01-13 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

DROP TABLE IF EXISTS `emails`;
CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `receiver_name` varchar(50) NOT NULL,
  `receiver_email` varchar(200) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `attachment` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `receiver_name`, `receiver_email`, `subject`, `content`, `attachment`) VALUES
(1, 'haha', 'kaifeng223@163.com', 'subject', 'fsdfsdaf', 'attachments/1453345675.png'),
(2, 'name', 'kaifeng223@163.com', 'subject', 'conetdsfsadfsdf', 'attachments/1453345908.png'),
(3, 'haha', 'kaifeng223@163.com', 'subject', 'sdfsdf', 'attachments/1453347327.png'),
(4, 'name', 'kaifeng223@163.com', 'subject', 'contentcontentcontentcontentcontentcontentcontentcontent', 'attachments/1453347534.png');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `title`, `description`, `created_date`) VALUES
(1, '开会', '开会啊', '2016-01-25'),
(2, 'afsdf', 'asfasdfafsadfsd', '2016-01-16'),
(3, 'aaaaaaaaaaaaa', 'bbbbbbbbbbbbbbbbbbbbbb', '2016-01-25'),
(4, '过年了', '快过年了，新年快乐', '2015-12-30'),
(5, '回家过年', '今天回家过年', '2016-02-03');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `zip_code` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `zip_code`, `city`, `province`) VALUES
(1, '111', '111', '111'),
(2, '222', '一个城市', '一个省'),
(3, '333', '又一个城市', '又一个省');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1453175655),
('m130524_201442_init', 1453175660);

-- --------------------------------------------------------

--
-- Table structure for table `po`
--

DROP TABLE IF EXISTS `po`;
CREATE TABLE IF NOT EXISTS `po` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `po_no` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `po`
--

INSERT INTO `po` (`id`, `po_no`, `description`) VALUES
(11, 'po-1', 'po-1 description'),
(12, 'po-2', 'po-2 description');

-- --------------------------------------------------------

--
-- Table structure for table `po_item`
--

DROP TABLE IF EXISTS `po_item`;
CREATE TABLE IF NOT EXISTS `po_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `po_item_no` varchar(10) NOT NULL,
  `quantity` double NOT NULL,
  `po_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `po_id` (`po_id`),
  KEY `po_id_2` (`po_id`),
  KEY `po_id_3` (`po_id`),
  KEY `po_id_4` (`po_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `po_item`
--

INSERT INTO `po_item` (`id`, `po_item_no`, `quantity`, `po_id`) VALUES
(1, 'po-item-1', 1111, 11),
(2, 'po-item-2', 1122, 11),
(3, 'po-item-2', 2211, 12),
(4, 'po-item-22', 2222, 12);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `first_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `first_name`, `last_name`) VALUES
(1, 'admin', 'iPS_8JKiKbKWTFpQBgVCqZnh_ntPsTmd', '$2y$13$ilRciYHjTZz3FX8PXlmzhOT8j0xbnfPiGOsQSrty/mCzVd31RNWyC', NULL, 'admin@admin.admin', 10, 1453175794, 1453175794, '', ''),
(2, 'username', 'RNZ5mL2HhL4fI0-wt5DWHf2Zosmc_8uv', '$2y$13$O/Ej6aC1hj21TxAJ6zhqw.6TG.6x31BWmg60fLtbDkjhRmfqWOqOu', NULL, 'admintest@admin.admin', 10, 1453182612, 1453182612, 'firstname', 'lastname'),
(7, 'onepersion', 'CMT3QAWztnWOqYr0O3DiyjDxPo9BQs5p', '$2y$13$ph5p4lSq4/GWFcG1l3Dlr.Rz/UH6tOC.2BlXNxPyAWtYhiUdCnPee', NULL, 'admiaaan@admin.admin', 10, 1453363674, 1453363674, '一个人', '一个人的lastname');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `branches_ibfk_1` FOREIGN KEY (`companies_company_id`) REFERENCES `companies` (`company_id`);

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`companies_company_id`) REFERENCES `companies` (`company_id`),
  ADD CONSTRAINT `departments_ibfk_2` FOREIGN KEY (`branches_branch_id`) REFERENCES `branches` (`branch_id`);

--
-- Constraints for table `po_item`
--
ALTER TABLE `po_item`
  ADD CONSTRAINT `po_item_ibfk_1` FOREIGN KEY (`po_id`) REFERENCES `po` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
