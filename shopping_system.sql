-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-12-23 15:54:16
-- 伺服器版本： 10.4.21-MariaDB
-- PHP 版本： 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `shopping_system`
--
CREATE DATABASE IF NOT EXISTS `shopping_system` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `shopping_system`;

-- --------------------------------------------------------

--
-- 資料表結構 `cart`
--

CREATE TABLE `cart` (
  `cartno` int(10) NOT NULL,
  `cno` int(10) NOT NULL,
  `pno` int(5) NOT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `cart`
--

INSERT INTO `cart` (`cartno`, `cno`, `pno`, `qty`) VALUES
(1, 100, 1, 1),
(2, 100, 1, 5),
(3, 100, 1, 2),
(4, 100, 2, 3),
(5, 100, 1, 3),
(6, 100, 2, 12),
(10, 104, 1, 1),
(11, 100, 1, 4);

-- --------------------------------------------------------

--
-- 資料表結構 `customers`
--

CREATE TABLE `customers` (
  `cno` int(10) NOT NULL,
  `cname` varchar(30) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `zip` int(5) DEFAULT NULL,
  `phone` char(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `customers`
--

INSERT INTO `customers` (`cno`, `cname`, `street`, `city`, `state`, `zip`, `phone`, `email`, `PASSWORD`) VALUES
(100, '使用者000', '123', 'Taipei', '10', 12, '0123456789', '123@1', '123'),
(101, '1', '1', '1', '1', 1, '1', '1@1', 's'),
(102, '陳二', '1', '1', '1', 1, '1', '1@1', 'sss'),
(103, '陳二', '1', '1', '1', 1, '1', '1@1', 's'),
(104, '1', '1', '1', '1', 1, '1', '1@1', '123');

-- --------------------------------------------------------

--
-- 資料表結構 `odetails`
--

CREATE TABLE `odetails` (
  `ono` int(5) NOT NULL,
  `pno` int(5) NOT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `ono` int(5) NOT NULL,
  `cno` int(10) DEFAULT NULL,
  `received` date DEFAULT NULL,
  `shipped` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `parts`
--

CREATE TABLE `parts` (
  `pno` int(5) NOT NULL,
  `pname` varchar(30) DEFAULT NULL,
  `qoh` int(11) DEFAULT NULL,
  `price` decimal(6,2) DEFAULT NULL,
  `olevel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `parts`
--

INSERT INTO `parts` (`pno`, `pname`, `qoh`, `price`, `olevel`) VALUES
(1, 'note', 5, '5.00', NULL),
(2, 'note_abc', 2, '7.00', NULL);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartno`,`pno`),
  ADD KEY `cno` (`cno`),
  ADD KEY `pno` (`pno`);

--
-- 資料表索引 `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cno`);

--
-- 資料表索引 `odetails`
--
ALTER TABLE `odetails`
  ADD PRIMARY KEY (`ono`,`pno`),
  ADD KEY `pno` (`pno`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ono`),
  ADD KEY `cno` (`cno`);

--
-- 資料表索引 `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`pno`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `cart`
--
ALTER TABLE `cart`
  MODIFY `cartno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `customers`
--
ALTER TABLE `customers`
  MODIFY `cno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `ono` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`cno`) REFERENCES `customers` (`cno`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`pno`) REFERENCES `parts` (`pno`);

--
-- 資料表的限制式 `odetails`
--
ALTER TABLE `odetails`
  ADD CONSTRAINT `odetails_ibfk_1` FOREIGN KEY (`ono`) REFERENCES `orders` (`ono`),
  ADD CONSTRAINT `odetails_ibfk_2` FOREIGN KEY (`pno`) REFERENCES `parts` (`pno`);

--
-- 資料表的限制式 `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`cno`) REFERENCES `customers` (`cno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
