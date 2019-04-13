-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 10, 2019 at 03:29 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookacook`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_book_menu`
--

DROP TABLE IF EXISTS `tbl_book_menu`;
CREATE TABLE IF NOT EXISTS `tbl_book_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `booking_date` date DEFAULT NULL,
  `booking_time` time DEFAULT NULL,
  `number_of_person` int(11) DEFAULT '0',
  `updated_on` datetime DEFAULT NULL,
  `state_id` int(11) DEFAULT '1',
  `type_id` int(11) DEFAULT '0',
  `create_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_book_menu_create_user_id` (`create_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_book_menu`
--

INSERT INTO `tbl_book_menu` (`id`, `menu_id`, `booking_date`, `booking_time`, `number_of_person`, `updated_on`, `state_id`, `type_id`, `create_user_id`) VALUES
(6, 1, '2019-04-08', '11:00:00', 12, NULL, 1, 0, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(127) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file` varchar(511) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `state_id` int(11) DEFAULT '1',
  `type_id` int(11) DEFAULT '0',
  `create_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_category_create_user_id` (`create_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `content`, `file`, `created_on`, `updated_on`, `state_id`, `type_id`, `create_user_id`) VALUES
(1, 'North Indian', 'From north Indian', 'WIN_20160623_13_12_03_Pro-1554842180.jpg', NULL, NULL, 1, 0, 1),
(2, 'South Indian', 'From South India', 'WIN_20160711_15_00_59_Pro-1554842209.jpg', NULL, NULL, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

DROP TABLE IF EXISTS `tbl_menu`;
CREATE TABLE IF NOT EXISTS `tbl_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(127) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT '0',
  `time_to_prepare` int(11) DEFAULT '0',
  `file` varchar(511) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `state_id` int(11) DEFAULT '1',
  `type_id` int(11) DEFAULT '0',
  `create_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_menu_category` (`category_id`),
  KEY `fk_menu_create_user_id` (`create_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id`, `title`, `category_id`, `content`, `price`, `time_to_prepare`, `file`, `created_on`, `updated_on`, `state_id`, `type_id`, `create_user_id`) VALUES
(1, 'Idli sambar', 2, 'idli smabar from south', 30, 4, '', NULL, NULL, 1, 0, 9),
(2, 'parantha', 1, 'skdjsd', 20, 1, 'WIN_20160625_19_35_41_Pro.jpg', NULL, NULL, 1, 0, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `full_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `contact_no` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_image` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `access_token` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_client` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `oauth_client_user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `about_me` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `logged_at` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT '0',
  `role_id` int(11) NOT NULL DEFAULT '0',
  `type_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `full_name`, `contact_no`, `profile_image`, `address`, `latitude`, `longitude`, `auth_key`, `access_token`, `password`, `oauth_client`, `oauth_client_user_id`, `email`, `about_me`, `status`, `created_on`, `updated_on`, `last_login`, `logged_at`, `state_id`, `role_id`, `type_id`) VALUES
(1, 'admin', 'super admin', NULL, NULL, NULL, NULL, NULL, '0', NULL, '$2y$13$vEKIvrIsKWcOiUEcXNdt3.cckI.liBp7/6cAfS4gWOKaGe02a275i', NULL, NULL, 'admin@gmail.com', NULL, 1, '2019-04-09 21:49:31', '2019-04-09 22:12:02', '2019-04-09 10:12:02', NULL, 0, 0, 0),
(7, 'cook', 'cook', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$13$Hb9BzuN5gmOCEPVRep2zm.OBQfDZ/9Z/H3G0DKsOVNmBX0oE0a6HG', NULL, NULL, 'cook@gmail.com', NULL, 1, NULL, NULL, NULL, NULL, 1, 3, 0),
(8, NULL, 'customer', '1234567890', NULL, NULL, NULL, NULL, '0', NULL, '$2y$13$P3C3S1Jfk4945oPn0LP6DuuVmmoUsm8ZSMc2BNLws9JiveIg2y122', NULL, NULL, 'customer@gmail.com', NULL, 1, '2019-04-10 02:37:12', '2019-04-10 02:37:13', '2019-04-10 02:37:12', NULL, 1, 4, 0),
(9, NULL, 'cook2', '123131232', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$13$WteIKrXC5kGuEpcgcy2RguzoU/0v2VJwic4/n2TlDw5rKRMa2XQg.', NULL, NULL, 'cook2@gmail.com', NULL, 1, NULL, NULL, NULL, NULL, 1, 3, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_book_menu`
--
ALTER TABLE `tbl_book_menu`
  ADD CONSTRAINT `fk_book_menu_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`),
  ADD CONSTRAINT `tbl_book_menu_ibfk_1` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`);

--
-- Constraints for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD CONSTRAINT `fk_category_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`),
  ADD CONSTRAINT `tbl_category_ibfk_1` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`);

--
-- Constraints for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD CONSTRAINT `fk_menu_category` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`id`),
  ADD CONSTRAINT `fk_menu_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`),
  ADD CONSTRAINT `tbl_menu_ibfk_1` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`),
  ADD CONSTRAINT `tbl_menu_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
