-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2019 at 10:12 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sharing-cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alt` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumb_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `original_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extension` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state_id` int(11) DEFAULT '0',
  `type_id` int(11) DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `create_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_id`, `model_type`, `alt`, `title`, `size`, `file_name`, `thumb_file`, `original_name`, `extension`, `state_id`, `type_id`, `created_on`, `updated_on`, `create_user_id`) VALUES
(19, 3, 'app\\models\\Deal', NULL, '', '7063', 'product07_1526136351.jpg', 'product07_1526136352-thumb.jpg', 'product07', 'jpg', 0, 0, NULL, NULL, 1),
(20, 4, 'app\\models\\Deal', NULL, '', '29591', 'banner07_1526152142.jpg', 'banner07_1526152142-thumb.jpg', 'banner07', 'jpg', 0, 0, NULL, NULL, 1),
(26, 5, 'app\\models\\Deal', NULL, '', '9258', 'product08_1526153867.jpg', 'product08_1526153867-thumb.jpg', 'product08', 'jpg', 0, 0, NULL, NULL, 1),
(37, 5, 'app\\models\\Brand', NULL, 'Adidas', '9440', 'adidas-1527329123jpg', 'adidas_1527329123-thumb_200x200.jpg', 'adidas', 'jpg', 0, 0, NULL, NULL, 1),
(47, 6, 'app\\models\\Deal', NULL, 'Hot Deal', '150406', 'banner03_1528545076.jpg', 'banner03_1528545076-thumb_200x200.jpg', 'banner03', 'jpg', 0, 0, NULL, NULL, 1),
(48, 11, 'app\\models\\Category', NULL, 'Footware', '146250', 'banner02-1528545360jpg', 'banner02_1528545360-thumb_200x200.jpg', 'banner02', 'jpg', 0, 0, NULL, NULL, 1),
(49, 12, 'app\\models\\Category', NULL, 'Printers', '93052', 'banner10-1528545406jpg', 'banner10_1528545406-thumb_200x200.jpg', 'banner10', 'jpg', 0, 0, NULL, NULL, 1),
(50, 13, 'app\\models\\Category', NULL, 'testing', '150406', 'banner03-1528545437jpg', 'banner03_1528545437-thumb_200x200.jpg', 'banner03', 'jpg', 0, 0, NULL, NULL, 1),
(51, 14, 'app\\models\\Category', NULL, 'cloths', '119791', 'banner01-1528545491jpg', 'banner01_1528545491-thumb_200x200.jpg', 'banner01', 'jpg', 0, 0, NULL, NULL, 1),
(52, 16, 'app\\models\\SubCategory', NULL, 'Loofers', '86056', 'main-product04-1528545581jpg', 'main-product04_1528545581-thumb_200x200.jpg', 'main-product04', 'jpg', 0, 0, NULL, NULL, 1),
(53, 17, 'app\\models\\SubCategory', NULL, 'sports', '87723', 'banner11-1528545611jpg', 'banner11_1528545611-thumb_200x200.jpg', 'banner11', 'jpg', 0, 0, NULL, NULL, 1),
(54, 18, 'app\\models\\SubCategory', NULL, 'snikers', '80643', 'main-product02-1528545671jpg', 'main-product02_1528545671-thumb_200x200.jpg', 'main-product02', 'jpg', 0, 0, NULL, NULL, 1),
(55, 19, 'app\\models\\SubCategory', NULL, 'toootal', '56313', 'banner12-1528545712jpg', 'banner12_1528545712-thumb_200x200.jpg', 'banner12', 'jpg', 0, 0, NULL, NULL, 1),
(56, 9, 'app\\models\\Product', NULL, 'product1', '80643', 'main-product02_1528546129.jpg', 'main-product02_1528546129-thumb_200x200.jpg', 'main-product02', 'jpg', 0, 0, NULL, NULL, 1),
(57, 10, 'app\\models\\Product', NULL, 'Extra shoes', '5435', 'product04_1528546210.jpg', 'product04_1528546210-thumb_200x200.jpg', 'product04', 'jpg', 0, 0, NULL, NULL, 1),
(58, 6, 'app\\models\\Brand', 'dsgnsdnfjdsnfjknsj', 'Reebok', '406800', 'sidhivinayak-ganpati-1529168711jpg', 'sidhivinayak-ganpati_1529168711-thumb_200x200.jpg', 'sidhivinayak-ganpati', 'jpg', 0, 0, NULL, NULL, 1),
(60, 21, 'app\\models\\SubCategory', NULL, 'total', '22745', 'Image_profile-1529184240png', 'Image_profile_1529184240-thumb_200x200.png', 'Image_profile', 'png', 0, 0, NULL, NULL, 1),
(61, 22, 'app\\models\\SubCategory', NULL, 'vddsfsdf', '47888', 'grid-computing-1-1529236610gif', 'grid-computing-1_1529236610-thumb_200x200.gif', 'grid-computing-1', 'gif', 0, 0, NULL, NULL, 1),
(62, 7, 'app\\models\\Deal', NULL, 'Get Set Go!', '921474', '100 Amazing Mixed Wallpapers 122 (42)_1530471670.jpg', '100 Amazing Mixed Wallpapers 122 (42)_1530471670-thumb_200x200.jpg', '100 Amazing Mixed Wallpapers 122 (42)', 'jpg', 0, 0, NULL, NULL, 1),
(63, 8, 'app\\models\\Deal', NULL, 'Amrit ', '556376', '100 Amazing Mixed Wallpapers 122 (60)_1530471902.jpg', '100 Amazing Mixed Wallpapers 122 (60)_1530471902-thumb_200x200.jpg', '100 Amazing Mixed Wallpapers 122 (60)', 'jpg', 0, 0, NULL, NULL, 1),
(64, 11, 'app\\models\\Product', NULL, 'Test', '1529604', '100 Amazing Mixed Wallpapers 122 (13)_1530562769.jpg', '100 Amazing Mixed Wallpapers 122 (13)_1530562769-thumb_200x200.jpg', '100 Amazing Mixed Wallpapers 122 (13)', 'jpg', 0, 0, NULL, NULL, 1),
(65, 12, 'app\\models\\Product', NULL, 'Test222', '651036', '100 Amazing Mixed Wallpapers 122 (55)_1530562872.jpg', '100 Amazing Mixed Wallpapers 122 (55)_1530562872-thumb_200x200.jpg', '100 Amazing Mixed Wallpapers 122 (55)', 'jpg', 0, 0, NULL, NULL, 1),
(66, 14, 'app\\models\\Product', NULL, 'Test3', '640556', '100 Amazing Mixed Wallpapers 122 (56)_1530562962.jpg', '100 Amazing Mixed Wallpapers 122 (56)_1530562962-thumb_200x200.jpg', '100 Amazing Mixed Wallpapers 122 (56)', 'jpg', 0, 0, NULL, NULL, 1),
(67, 2, 'app\\models\\Banner', NULL, 'Banner1', '646134', '100 Amazing Mixed Wallpapers 122 (2)-1540092138jpg', '100 Amazing Mixed Wallpapers 122 (2)_1540092138-thumb_200x200.jpg', '100 Amazing Mixed Wallpapers 122 (2)', 'jpg', 0, 0, NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_media_create_user_id` (`create_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `fk_media_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
