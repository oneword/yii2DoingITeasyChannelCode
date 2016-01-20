-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 20, 2016 at 11:53 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branch_id`, `companies_company_id`, `branch_name`, `branch_address`, `branch_create_data`, `branch_status`) VALUES
(1, 1, 'some branch name', 'some branch address', '2016-01-21 00:00:00', 'active'),
(2, 1, 'another branch', 'another address', '2016-01-20 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `company_id` int(100) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) NOT NULL,
  `company_email` varchar(100) NOT NULL,
  `company_address` varchar(100) NOT NULL,
  `company_created_date` datetime NOT NULL,
  `company_status` enum('active','inactive') NOT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`company_id`, `company_name`, `company_email`, `company_address`, `company_created_date`, `company_status`) VALUES
(1, 'ABC', 'abc@aa.com', 'some address', '2016-01-20 00:00:00', 'active');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `first_name`, `last_name`) VALUES
(1, 'admin', 'iPS_8JKiKbKWTFpQBgVCqZnh_ntPsTmd', '$2y$13$ilRciYHjTZz3FX8PXlmzhOT8j0xbnfPiGOsQSrty/mCzVd31RNWyC', NULL, 'admin@admin.admin', 10, 1453175794, 1453175794, '', ''),
(2, 'username', 'RNZ5mL2HhL4fI0-wt5DWHf2Zosmc_8uv', '$2y$13$O/Ej6aC1hj21TxAJ6zhqw.6TG.6x31BWmg60fLtbDkjhRmfqWOqOu', NULL, 'admintest@admin.admin', 10, 1453182612, 1453182612, 'firstname', 'lastname');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `branches_ibfk_1` FOREIGN KEY (`companies_company_id`) REFERENCES `companies` (`company_id`);

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_2` FOREIGN KEY (`branches_branch_id`) REFERENCES `branches` (`branch_id`),
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`companies_company_id`) REFERENCES `companies` (`company_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
