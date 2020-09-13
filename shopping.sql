-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2020 at 07:24 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `U_ID` int(11) NOT NULL,
  `Items` varchar(300) NOT NULL,
  `Count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`U_ID`, `Items`, `Count`) VALUES
(8, '5f55093f40ecf', 1),
(16, '5f55098c0556c', 10),
(19, '5f55093f40ecf', 6),
(19, '5f55098c0556c', 13),
(21, '5f55093f40ecf', 6),
(21, '5f55098c0556c', 9);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `P_ID` varchar(300) NOT NULL,
  `Name` varchar(300) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `Category` varchar(300) NOT NULL,
  `Sold_By` int(11) NOT NULL,
  `Product_pic` varchar(300) NOT NULL,
  `Offers` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`P_ID`, `Name`, `Description`, `Quantity`, `Price`, `Category`, `Sold_By`, `Product_pic`, `Offers`) VALUES
('5f55093f40ecf', 'watcha', 'lalal', 10000, 9898, 'Electronics', 3, 'uploads/productpics/5f55093f37bbb.jpeg,uploads/productpics/5f55093f38b9d.jpeg,uploads/productpics/5f55093f3e373.jpeg,uploads/productpics/5f55093f3f6ac.jpeg', ''),
('5f55098c0556c', 'juiis', 'akakak', 576, 15661, 'Fashion', 3, 'uploads/productpics/5f55098bd62c0.jpeg,uploads/productpics/5f55098bd8145.jpeg,uploads/productpics/5f55098bef5fb.jpeg,uploads/productpics/5f55098bf0a46.jpeg', '-188,cregdd,'),
('5f5c77d03d6ab', 'phone', 'daaa', 966, 20000, 'Accessories', 18, 'uploads/productpics/5f5c77d03c047.jpeg,uploads/productpics/5f5c77d03ca2e.jpeg,uploads/productpics/5f5c77d03ceab.jpeg', '-9999,-777,'),
('5f5cd69127eda', 'cleaner', '', 200000, 54342, 'Furniture', 3, 'uploads/productpics/5f5cd6912734c.jpeg,uploads/productpics/5f5cd691275a0.jpeg,uploads/productpics/5f5cd69127752.jpeg,uploads/productpics/5f5cd691278c8.jpeg,uploads/productpics/5f5cd69127a43.jpg,uploads/productpics/5f5cd69127bc2.jpeg', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `O_ID` varchar(255) NOT NULL,
  `P_ID` varchar(255) NOT NULL,
  `Quantities` varchar(255) NOT NULL,
  `U_ID` int(11) NOT NULL,
  `Amount` int(100) NOT NULL,
  `Time` varchar(50) NOT NULL,
  `Recieved` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`O_ID`, `P_ID`, `Quantities`, `U_ID`, `Amount`, `Time`, `Recieved`) VALUES
('5f5a538b5865e', '5f55093f40ecf', '7', 20, 69286, '09-10', 1),
('5f5a538b5865e', '5f55098c0556c', '6', 20, 93966, '09-10', 1),
('5f5a53acbf041', '5f55093f40ecf', '11', 19, 108878, '09-10', 1),
('5f5a53acbf041', '5f55098c0556c', '16', 19, 250576, '09-10', 1),
('5f5a54c6e3dad', '5f55093f40ecf', '9', 19, 89082, '09-10', 1),
('5f5a54c70aa48', '5f55098c0556c', '13', 19, 203593, '09-10', 1),
('5f5a56d280f1c', '5f55093f40ecf', '4', 14, 39592, '09-10-2020', 1),
('5f5a56d29cc32', '5f55098c0556c', '13', 14, 203593, '09-10-2020', 1),
('5f5a59576f44e', '5f55093f40ecf', '6', 19, 59388, '09-10-2020', 1),
('5f5a59579163d', '5f55098c0556c', '13', 19, 203593, '09-10-2020', 1),
('5f5a59a6a97b3', '5f55093f40ecf', '6', 21, 59388, '09-10-2020', 1),
('5f5a59a6c6373', '5f55098c0556c', '9', 21, 140949, '09-10-2020', 1),
('5f5bb0abd5547', '5f55093f40ecf', '9', 15, 89082, '09-11-2020', 1),
('5f5bb0ac121e1', '5f55098c0556c', '14', 15, 219254, '09-11-2020', 1),
('5f5bb1f231fb9', '5f55093f40ecf', '9', 15, 89082, '09-11-2020', 1),
('5f5bb1f24b192', '5f55098c0556c', '14', 15, 219254, '09-11-2020', 1),
('5f5bb2c2a2f6c', '5f55093f40ecf', '13', 15, 128674, '09-11-2020', 1),
('5f5bb2c2bb9e7', '5f55098c0556c', '14', 15, 219254, '09-11-2020', 1),
('5f5cd81590bef', '5f5cd69127eda', '6', 20, 326052, '09-12-2020', 1),
('5f5cd99f1682a', '5f55098c0556c', '10', 16, 156610, '09-12-2020', 1),
('5f5e41bd5ff30', '5f5c77d03d6ab', '6', 15, 120000, '09-13-2020', 0),
('5f5e41f6e2b07', '5f5c77d03d6ab', '6', 15, 120000, '09-13-2020', 0),
('5f5e422ba19cb', '5f5c77d03d6ab', '6', 15, 120000, '09-13-2020', 0),
('5f5e42514192d', '5f5c77d03d6ab', '6', 15, 120000, '09-13-2020', 0),
('5f5e4309d158e', '5f5c77d03d6ab', '6', 15, 120000, '09-13-2020', 0),
('5f5e44fd6ea10', '5f5c77d03d6ab', '4', 14, 80000, '09-13-2020', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `U_ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(300) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `profilepic` varchar(255) NOT NULL DEFAULT 'images/img_avatar.png',
  `Address` mediumtext,
  `Type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`U_ID`, `Name`, `Email`, `PASSWORD`, `profilepic`, `Address`, `Type`) VALUES
(3, 'marta', '108119021@nitt.edu ', '12345678', 'images/img_avatar.png', '', 1),
(14, 'hannah', '108119021@nitt.edu ', '12345678', 'images/img_avatar.png', 'new address', 0),
(15, 'regi', '108119021@nitt.edu ', '12345678', 'images/img_avatar.png', 'erlal', 0),
(16, 'adam', '108119021@nitt.edu ', '12345678', 'images/img_avatar.png', 'wienden', 0),
(17, 'radh', '108119021@nitt.edu ', '12345678', 'images/img_avatar.png', NULL, 1),
(18, 'fransika', '108119021@nitt.edu ', '12345678', 'images/img_avatar.png', NULL, 1),
(19, 'magnus', '108119021@nitt.edu ', '12345678', 'images/img_avatar.png', 'wienden', 0),
(20, 'jonas', '108119021@nitt.edu ', '12345678', 'images/img_avatar.png', 'jonas house', 0),
(21, 'alex', '108119021@nitt.edu ', '12345678', 'images/img_avatar.png', 'alex', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`U_ID`,`Items`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`P_ID`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`U_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `U_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
