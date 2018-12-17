-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2018 年 12 月 17 日 11:11
-- 伺服器版本: 10.1.31-MariaDB
-- PHP 版本： 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `manufactor`
--

-- --------------------------------------------------------

--
-- 資料表結構 `customer`
--

CREATE TABLE `customer` (
  `customer_name` varchar(50) DEFAULT NULL,
  `customer_id` char(8) NOT NULL,
  `phone_no` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` char(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `customer`
--

INSERT INTO `customer` (`customer_name`, `customer_id`, `phone_no`, `email`, `password`) VALUES
('Retailer1', 'C0000001', '+852 20000001', 'retailer1@example.com', '11111111'),
('Retailer2', 'C0000002', '+852 20000002', 'retailer2@example.com', '22222222');

-- --------------------------------------------------------

--
-- 資料表結構 `order_detail`
--

CREATE TABLE `order_detail` (
  `order_id` int(7) DEFAULT NULL,
  `customer_id` char(8) DEFAULT NULL,
  `product_id` char(8) DEFAULT NULL,
  `quantity` decimal(3,0) DEFAULT NULL,
  `total_price` decimal(8,2) DEFAULT NULL,
  `order_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `order_detail`
--

INSERT INTO `order_detail` (`order_id`, `customer_id`, `product_id`, `quantity`, `total_price`, `order_date`) VALUES
(1, 'C0000002', 'P0000001', '10', '65000.00', '2018-03-13'),
(1, 'C0000002', 'P0000002', '5', '35000.00', '2018-03-13'),
(1, 'C0000002', 'P0000003', '15', '90000.00', '2018-03-13'),
(1, 'C0000002', 'P0000004', '7', '43750.00', '2018-03-13'),
(1, 'C0000002', 'P0000005', '8', '40000.00', '2018-03-13'),
(1, 'C0000002', 'P0000006', '6', '31500.00', '2018-03-13'),
(2, 'C0000001', 'P0000001', '10', '65000.00', '2018-03-14'),
(2, 'C0000001', 'P0000002', '5', '35000.00', '2018-03-14'),
(2, 'C0000001', 'P0000003', '6', '36000.00', '2018-03-14'),
(2, 'C0000001', 'P0000004', '15', '93750.00', '2018-03-14'),
(2, 'C0000001', 'P0000005', '70', '350000.00', '2018-03-14'),
(2, 'C0000001', 'P0000006', '50', '262500.00', '2018-03-14'),
(3, 'C0000001', 'P0000001', '5', '32500.00', '2018-11-16'),
(3, 'C0000001', 'P0000002', '3', '21000.00', '2018-11-16'),
(3, 'C0000001', 'P0000003', '9', '54000.00', '2018-11-16'),
(3, 'C0000001', 'P0000004', '1', '6250.00', '2018-11-16'),
(3, 'C0000001', 'P0000005', '1', '5000.00', '2018-11-16'),
(3, 'C0000001', 'P0000006', '1', '5250.00', '2018-11-16'),
(4, 'C0000001', 'P0000002', '37', '259000.00', '2018-11-16'),
(5, '', 'P0000001', '3', '19500.00', '2018-12-14'),
(6, '', 'P0000001', '3', '19500.00', '2018-12-14'),
(7, '', 'P0000001', '6', '39000.00', '2018-12-14'),
(8, '', 'P0000001', '3', '19500.00', '2018-12-14'),
(9, '', 'P0000001', '6', '39000.00', '2018-12-16');

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `product_id` char(8) DEFAULT NULL,
  `product_description` varchar(255) DEFAULT NULL,
  `stock` decimal(3,0) DEFAULT NULL,
  `unit_price` decimal(7,2) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `product`
--

INSERT INTO `product` (`product_id`, `product_description`, `stock`, `unit_price`, `photo`) VALUES
('P0000001', 'Apple IPhone X 128GB', '182', '6500.00', 'img/iphoneX.jpg'),
('P0000002', 'Apple IPhone X 256GB', '156', '7000.00', 'img/iphoneX.jpg'),
('P0000003', 'Apple IPhone 8 128GB', '170', '6000.00', 'img/iphone8.jpg'),
('P0000004', 'Apple IPhone 8 256GB', '167', '6250.00', 'img/iphone8.jpg'),
('P0000005', 'Apple IPhone 7 128GB', '216', '5000.00', 'img/iphone7.jpg'),
('P0000006', 'Apple IPhone 7 256GB', '333', '5250.00', 'img/iphone7.jpg');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
