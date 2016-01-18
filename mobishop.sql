-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2016 at 11:22 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mobishop`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertise`
--

CREATE TABLE IF NOT EXISTS `advertise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `view_count` int(11) NOT NULL DEFAULT '0',
  `click_count` int(11) NOT NULL DEFAULT '0',
  `show` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `advertise`
--

INSERT INTO `advertise` (`id`, `location`, `image`, `link`, `date_start`, `date_end`, `view_count`, `click_count`, `show`) VALUES
(3, 'top', 'images_5631d79d27a14.png', 'http://nhatkhang.admin:81/advertise/create', '2015-10-29', '2015-10-30', 0, 0, 1),
(4, 'left', 'lion-photo_5631d7a76de8f.jpg', 'http://nhatkhang.admin:81/advertise', '2015-10-29', '2015-11-01', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `manufacture`
--

CREATE TABLE IF NOT EXISTS `manufacture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `manufacture`
--

INSERT INTO `manufacture` (`id`, `name`, `address`, `tel`) VALUES
(3, 'Asus', 'eweqe', '234234324'),
(4, 'Apple', 'ghdghgdf', '344543543'),
(5, 'LG', 'dasda', '32132'),
(6, 'Blackberry', 'dfdf', '45345'),
(7, 'HTC', 'hgfhf', '5345'),
(8, 'Samsung', 'rewr453', '5435'),
(9, 'Nokia', 'dsad', 'dsada');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `manufacture` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `images` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `more` text COLLATE utf8_unicode_ci NOT NULL,
  `inventory_number` int(11) NOT NULL DEFAULT '0',
  `sale_number` int(11) NOT NULL DEFAULT '0',
  `show` int(11) NOT NULL DEFAULT '1',
  `date` date NOT NULL,
  `display` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `os` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cpu` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `camera` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `internal_memory` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ram` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `battery` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `manufacture`, `images`, `more`, `inventory_number`, `sale_number`, `show`, `date`, `display`, `os`, `cpu`, `camera`, `internal_memory`, `ram`, `battery`) VALUES
(4, 'Nokia 1080', '300000', '9', 'Nokia 1080-3-1448005329_660x0_569ca57c12560.jpg;Nokia 1080-8-1448011133_660x0_569ca57c12ea5.jpg;Nokia 1080-9-1448012865_660x0_569ca57c14311.jpg;Nokia 1080-10-1448014235_660x0_569ca57c1584b.jpg;Nokia 1080-images_569ca57c17236.png;Nokia 1080-IMGP0189-1447994185_660x0_569ca57c192ac.jpg;Nokia 1080-lion-', '{"Thẻ nhớ":"có"}', 100, 0, 1, '0000-00-00', 'Full HD', 'ios', '8 core, 3.5 Ghz', '24 Mp', '128 Gb', '4 Gb', '5000mA/h');

-- --------------------------------------------------------

--
-- Table structure for table `shopinfo`
--

CREATE TABLE IF NOT EXISTS `shopinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `introduce` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `shopinfo`
--

INSERT INTO `shopinfo` (`id`, `name`, `logo`, `address`, `tel`, `introduce`, `image`) VALUES
(1, 'name', '/upload/page/images_56838ef6c5928.png', 'address', 'tel', '<p>introducesaffaf</p>\r\n', '');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `tel` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `admin` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `pass`, `name`, `address`, `tel`, `status`, `admin`) VALUES
(1, 'nathkagnh@gmail.com', '1234', 'Lê Đỗ Nhật Khang', 'Cách Mạng Tháng 8', 238943294, 1, 1),
(5, 'nathkagnh@gmail.com.vn', 'fasf', 'Nhật Khang', 'asfafa', 2142342, 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
