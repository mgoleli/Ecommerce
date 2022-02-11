-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 28, 2022 at 08:09 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `market`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `product` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  `cat_user` int(11) NOT NULL,
  `description` text NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cat_id`),
  KEY `cat_user` (`cat_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_user`, `description`, `active`, `created_at`) VALUES
(2, 'Telefon', 5, 'Telefon                                    ', 0, '2022-01-25 07:53:16');

-- --------------------------------------------------------

--
-- Table structure for table `c_order`
--

DROP TABLE IF EXISTS `c_order`;
CREATE TABLE IF NOT EXISTS `c_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `order_total` varchar(255) NOT NULL,
  `order_status` tinyint(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`),
  KEY `o_shipping` (`shipping_id`),
  KEY `o_payment` (`payment_id`),
  KEY `o_user` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `c_order`
--

INSERT INTO `c_order` (`order_id`, `customer_id`, `shipping_id`, `payment_id`, `order_total`, `order_status`, `created_at`) VALUES
(27, 6, 28, 27, '0', 0, '2022-01-28 18:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `c_order_details`
--

DROP TABLE IF EXISTS `c_order_details`;
CREATE TABLE IF NOT EXISTS `c_order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `order_status_id` tinyint(4) DEFAULT NULL,
  `product_qty` varchar(255) NOT NULL,
  `user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `d_order` (`order_id`),
  KEY `d_product` (`product_id`),
  KEY `order_status_id` (`order_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf32;

--
-- Dumping data for table `c_order_details`
--

INSERT INTO `c_order_details` (`id`, `order_id`, `product_id`, `product_name`, `product_price`, `order_status_id`, `product_qty`, `user`, `created_at`) VALUES
(3, 27, 1, 'Fabriq10', '0', 2, '5', 6, '2022-01-28 18:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `manufactures`
--

DROP TABLE IF EXISTS `manufactures`;
CREATE TABLE IF NOT EXISTS `manufactures` (
  `man_id` int(11) NOT NULL AUTO_INCREMENT,
  `man_name` varchar(255) NOT NULL,
  `man_user` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`man_id`),
  KEY `man_user` (`man_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manufactures`
--

INSERT INTO `manufactures` (`man_id`, `man_name`, `man_user`, `active`, `description`, `created_at`) VALUES
(4, 'Samsung', 5, 1, 'Samsung                                    ', '2022-01-25 07:54:34');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

DROP TABLE IF EXISTS `order_status`;
CREATE TABLE IF NOT EXISTS `order_status` (
  `order_status_id` int(11) NOT NULL,
  `name` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`order_status_id`, `name`) VALUES
(1, 'Hazirlaniyor'),
(2, 'Kargoya Verildi');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `Payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_method` varchar(50) NOT NULL,
  `payment_status` tinyint(2) NOT NULL DEFAULT '0',
  `payment_shipping` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Payment_id`),
  KEY `pay_shipping` (`payment_shipping`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment_id`, `payment_method`, `payment_status`, `payment_shipping`, `created_at`) VALUES
(27, 'KapÄ±da Ã¶deme', 0, 28, '2022-01-28 18:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `cat` int(11) NOT NULL,
  `man` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `active` tinyint(2) NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`),
  KEY `p_user` (`user`),
  KEY `p_man` (`man`),
  KEY `p_cat` (`cat`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf32;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `cat`, `man`, `user`, `active`, `image`, `color`, `size`, `price`, `quantity`, `created_at`) VALUES
(1, 'Fabriq10', 'Fabriq10', 2, 4, 5, 1, 'open1643400488.jpg', 'siyah', '5.7', 500, 10, '2022-01-27 09:18:57'),
(13, 'test test2', 'test test2', 2, 4, 5, 1, 'resmobile1643394700.png', 'siyah', '5.7', 232, 22, '2022-01-28 18:31:40');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

DROP TABLE IF EXISTS `shipping`;
CREATE TABLE IF NOT EXISTS `shipping` (
  `shipping_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`shipping_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`shipping_id`, `full_name`, `email`, `mobile`, `address`, `city`, `created_at`) VALUES
(28, 'test test2', 'istanbulsoft@istanbulsoft.com.tr', '05351545454', 'MecidikÃ¶y', 'Ä°stanbul / ÅžiÅŸli', '2022-01-28 18:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `vkey` varchar(255) NOT NULL,
  `token_expire` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `verified` tinyint(4) NOT NULL DEFAULT '0',
  `admin` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`, `image`, `active`, `vkey`, `token_expire`, `verified`, `admin`, `created_at`) VALUES
(5, 'Muhammet', 'golelix.muhammet@gmail.com', '$2y$10$A0QGYkTHdPIwnTqUl2iDg.jdoZ1BHJNIgEhP8sgvNmXb9a09RmwWa', 'noimage.png', 1, '0d0795d7411a5e12af3b923c3ab306ff', '2022-01-25 07:50:42', 1, 1, '2022-01-25 07:50:19'),
(6, 'Muhammet', 'istanbulsoft@istanbulsoft.com.tr', '$2y$10$yYrvt6L1hqcpwh4bRypM1OWjkLM8SY9V7mlzE8M7NiTgpN8Eg/jKe', 'noimage.png', 1, '51547a08aabb82951005e289e440105b', '2022-01-28 18:01:36', 1, 0, '2022-01-28 17:57:21');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `cat_user` FOREIGN KEY (`cat_user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `c_order`
--
ALTER TABLE `c_order`
  ADD CONSTRAINT `o_payment` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`Payment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `o_shipping` FOREIGN KEY (`shipping_id`) REFERENCES `shipping` (`shipping_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `o_user` FOREIGN KEY (`customer_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `c_order_details`
--
ALTER TABLE `c_order_details`
  ADD CONSTRAINT `d_order` FOREIGN KEY (`order_id`) REFERENCES `c_order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `d_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manufactures`
--
ALTER TABLE `manufactures`
  ADD CONSTRAINT `man_user` FOREIGN KEY (`man_user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `pay_shipping` FOREIGN KEY (`payment_shipping`) REFERENCES `shipping` (`shipping_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `p_cat` FOREIGN KEY (`cat`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `p_man` FOREIGN KEY (`man`) REFERENCES `manufactures` (`man_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `p_user` FOREIGN KEY (`user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
