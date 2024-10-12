-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 25, 2024 at 04:05 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mrf`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `registration_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products1`
--

DROP TABLE IF EXISTS `products1`;
CREATE TABLE IF NOT EXISTS `products1` (
  `pid` int NOT NULL AUTO_INCREMENT,
  `batchNo` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `minimum_qty` int DEFAULT NULL,
  `available_qty` int DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products1`
--

INSERT INTO `products1` (`pid`, `batchNo`, `name`, `price`, `brand`, `image`, `minimum_qty`, `available_qty`) VALUES
(1, 'MU025', 'mouse', 1500.00, 'hevit', '../uploads/664f305ae5278.jpg', 5, 20),
(6, 'se034', 'mouse', 13565.00, 'ali', '../uploads/664f3083ee9f6.jpg', 8, 123),
(8, 'se034', 'qweh', 157.00, 'hevit', '../uploads/664f8aef46948.jpg', 5, 5),
(9, 'MU027', 'keyboard', 2000.00, 'Lenovo', '../uploads/66507dcfc70ad.jpg', 5, 3),
(10, 'MU027', 'poweh', 2520.00, 'hevit', '../uploads/6651e299ba3d8.jpg', 5, 15);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE IF NOT EXISTS `reports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `report_title` varchar(255) NOT NULL,
  `report_content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `sale_id` int NOT NULL AUTO_INCREMENT,
  `pid` int NOT NULL,
  `quantity_sold` int NOT NULL,
  `sale_price` decimal(10,2) NOT NULL,
  `sale_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `customer_id` int DEFAULT NULL,
  PRIMARY KEY (`sale_id`),
  KEY `pid` (`pid`),
  KEY `customer_id` (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sale_id`, `pid`, `quantity_sold`, `sale_price`, `sale_date`, `customer_id`) VALUES
(1, 1, 5, 7500.00, '2024-05-19 03:42:32', 1),
(2, 2, 2, 4000.00, '2024-05-19 03:42:32', 1),
(3, 2, 1, 2000.00, '2024-05-19 03:55:13', 1),
(4, 1, 1, 1500.00, '2024-05-19 03:55:13', 1),
(5, 1, 2, 3000.00, '2024-05-19 04:27:35', 1),
(6, 2, 3, 6000.00, '2024-05-19 04:27:35', 1),
(7, 1, 2, 3000.00, '2024-05-19 13:39:58', 1),
(8, 2, 2, 4000.00, '2024-05-19 13:39:58', 1),
(9, 1, 2, 3000.00, '2024-05-19 15:55:35', 1),
(10, 2, 2, 4000.00, '2024-05-19 15:55:35', 1),
(11, 5, 3, 639.00, '2024-05-20 15:07:46', 1),
(12, 1, 2, 3000.00, '2024-05-20 15:07:46', 1),
(13, 1, 10, 15000.00, '2024-05-25 18:03:07', 1),
(14, 9, 2, 4000.00, '2024-05-25 18:03:07', 1),
(15, 1, 50, 75000.00, '2024-05-25 18:03:46', 1),
(16, 9, 5, 10000.00, '2024-05-25 18:03:46', 1),
(17, 10, 10, 25200.00, '2024-05-25 18:38:53', 1),
(18, 1, 5, 7500.00, '2024-05-25 18:38:53', 1),
(19, 1, 1, 1500.00, '2024-05-25 18:51:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock_alerts`
--

DROP TABLE IF EXISTS `stock_alerts`;
CREATE TABLE IF NOT EXISTS `stock_alerts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `current_stock` int NOT NULL,
  `alert_threshold` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_images`
--

DROP TABLE IF EXISTS `tbl_images`;
CREATE TABLE IF NOT EXISTS `tbl_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_images`
--

INSERT INTO `tbl_images` (`id`, `img`) VALUES
(1, '1714741356.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$dN3HCZq8lwuluH1G5M8gHOfc7RQzYCr6Fcou4qFNlp/JRPv4FDjIC'),
(2, 'test', '123');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
