-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 28, 2019 at 03:24 PM
-- Server version: 5.1.53
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spare_part`
--
CREATE DATABASE `spare_part` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci; 
USE `spare_part`;

-- --------------------------------------------------------

--
-- Stand-in structure for view `available_stock`
--
CREATE TABLE IF NOT EXISTS `available_stock` (
`product_id` int(11)
,`received_quantity` double(17,0)
,`SalesQty` double(17,0)
,`stock_balance` double(17,0)
);
-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `Brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `Brand_name` varchar(50) NOT NULL,
  `Date_added` datetime DEFAULT NULL,
  `Added_by` varchar(50) DEFAULT NULL,
  `Date_updated` datetime DEFAULT NULL,
  `Updated_by` varchar(50) DEFAULT NULL,
  `Brand_active` int(11) NOT NULL,
  `Brand_status` int(11) NOT NULL,
  PRIMARY KEY (`Brand_id`),
  UNIQUE KEY `Brand_name` (`Brand_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`Brand_id`, `Brand_name`, `Date_added`, `Added_by`, `Date_updated`, `Updated_by`, `Brand_active`, `Brand_status`) VALUES
(1, 'IVECO', '2018-05-24 14:08:06', 'Abebe.tefera', '2018-06-27 21:05:04', 'Abebe.Tefera', 2, 1),
(13, 'SUZUKI', '2018-06-20 14:05:14', 'Abebe.Tefera', NULL, NULL, 1, 1),
(5, 'ISUZU', '0000-00-00 00:00:00', 'Abebe.tefera', '2018-06-01 22:05:17', 'Abebe.Tefera', 1, 1),
(8, 'TOYOTA', '0000-00-00 00:00:00', 'Abebe.tefera', '2018-06-22 13:00:53', 'Abebe.Tefera', 1, 1),
(9, 'NISSAN', '2018-05-23 21:04:47', 'Abebe.tefera', '2018-06-01 22:11:40', 'Abebe.Tefera', 1, 1),
(15, 'Toyoya', '2018-07-07 09:45:34', 'Kedir.Abdela', NULL, NULL, 1, 1),
(14, 'Mazda', '2018-06-23 01:18:51', 'Kedir.Abdela', NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `Category_id` int(11) NOT NULL AUTO_INCREMENT,
  `Category_name` varchar(50) NOT NULL,
  `Date_added` datetime DEFAULT NULL,
  `Added_by` varchar(50) DEFAULT NULL,
  `Date_updated` datetime DEFAULT NULL,
  `Updated_by` varchar(50) DEFAULT NULL,
  `Category_active` int(11) NOT NULL,
  `Category_status` int(11) NOT NULL,
  PRIMARY KEY (`Category_id`),
  UNIQUE KEY `Category_name` (`Category_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_id`, `Category_name`, `Date_added`, `Added_by`, `Date_updated`, `Updated_by`, `Category_active`, `Category_status`) VALUES
(1, 'Front', '2018-05-24 10:14:33', 'Abebe.tefera', '2018-05-28 12:56:53', 'Abebe.tefera', 2, 1),
(2, 'Back', '2018-05-24 10:14:48', 'Abebe.tefera', NULL, NULL, 1, 1),
(4, 'Filter', '2018-07-07 09:49:38', 'Kedir.Abdela', NULL, NULL, 1, 1),
(5, 'Cable', '2018-07-07 09:49:54', 'Kedir.Abdela', NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `Customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `Customer_name` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Contact_name` varchar(50) NOT NULL,
  `Phone` varchar(50) NOT NULL,
  `Fax` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `TIN` varchar(50) DEFAULT NULL,
  `Date_added` datetime DEFAULT NULL,
  `Added_by` varchar(50) DEFAULT NULL,
  `Date_updated` datetime DEFAULT NULL,
  `Updated_by` varchar(50) DEFAULT NULL,
  `Customer_status` int(11) NOT NULL,
  PRIMARY KEY (`Customer_id`),
  UNIQUE KEY `Customer_name` (`Customer_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_id`, `Customer_name`, `City`, `Contact_name`, `Phone`, `Fax`, `Email`, `TIN`, `Date_added`, `Added_by`, `Date_updated`, `Updated_by`, `Customer_status`) VALUES
(1, 'Abebe PLC', 'AA', 'Ab ebe', '091346456', '12244656', 'Abebe@gmainl.com', '12134456', '2018-05-28 11:43:02', 'Abebe.tefera', NULL, NULL, 1),
(2, 'KedirPLC', 'DD', 'Kedir', '0913456478', '01158564', 'Kedir@gmail.com', '011454579', '2018-05-28 11:45:56', 'Abebe.tefera', '2018-05-28 14:28:41', 'Abebe.tefera', 1);

-- --------------------------------------------------------

--
-- Table structure for table `goods_receiving_note`
--

CREATE TABLE IF NOT EXISTS `goods_receiving_note` (
  `GRN_id` int(11) NOT NULL AUTO_INCREMENT,
  `Purchase_item_id` int(11) NOT NULL,
  `GRN_acceptance` varchar(255) NOT NULL,
  `Note` text,
  `Date_Acceptance` datetime DEFAULT NULL,
  `Acceptance_by` varchar(255) DEFAULT NULL,
  `Date_Requested` datetime DEFAULT NULL,
  `Requested_by` varchar(50) DEFAULT NULL,
  `Date_updated` datetime DEFAULT NULL,
  `Updated_by` varchar(50) DEFAULT NULL,
  `GRN_status` int(11) NOT NULL,
  PRIMARY KEY (`GRN_id`),
  KEY `Purchase_item_id` (`Purchase_item_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `goods_receiving_note`
--

INSERT INTO `goods_receiving_note` (`GRN_id`, `Purchase_item_id`, `GRN_acceptance`, `Note`, `Date_Acceptance`, `Acceptance_by`, `Date_Requested`, `Requested_by`, `Date_updated`, `Updated_by`, `GRN_status`) VALUES
(44, 87, '2', '', '2019-08-13 11:55:12', 'Master', '2018-07-07 10:08:55', 'Tigist.Berihun', NULL, NULL, 1),
(45, 88, '4', 'Quantity is not correct', '2018-07-19 23:06:36', 'Master', '2018-07-07 11:57:19', 'Tigist.Berihun', NULL, NULL, 1),
(43, 86, '2', 'Quantity is not correct', '2019-12-24 06:10:59', 'Master', '2018-07-06 19:43:50', 'Tigist.Berihun', NULL, NULL, 1),
(40, 83, '2', NULL, '2018-07-06 06:41:59', 'Master', '2018-06-29 05:42:34', 'Abebe.Tefera', NULL, NULL, 1),
(41, 84, '2', NULL, '2018-07-06 06:43:08', 'Master', '2018-07-04 21:59:21', 'Master', NULL, NULL, 1),
(42, 85, '2', NULL, '2018-07-05 19:17:17', 'Master', '2018-07-05 19:15:48', 'Master', NULL, NULL, 1),
(39, 82, '2', NULL, '2018-06-29 05:43:25', 'Abebe.Tefera', '2018-06-29 05:34:17', 'Abebe.Tefera', NULL, NULL, 1),
(46, 89, '2', '', '2018-07-21 15:50:14', 'Master', '2018-07-19 23:08:52', 'Master', NULL, NULL, 1),
(47, 90, '4', 'Say something!', '2019-12-28 09:40:40', 'Master', '2018-07-21 16:11:43', 'Master', NULL, NULL, 1),
(48, 91, '2', NULL, '2019-10-17 13:07:28', 'Master', '2019-10-17 13:06:45', 'Master', NULL, NULL, 1),
(49, 92, '2', NULL, '2019-12-21 17:49:33', 'Master', '2019-12-21 17:48:39', 'Master', NULL, NULL, 1),
(50, 93, '2', '', '2019-12-28 09:57:09', 'Master', '2019-12-25 20:27:54', 'Master', NULL, NULL, 1),
(51, 94, '3', 'say', '2019-12-28 10:06:15', 'Master', '2019-12-25 20:43:27', 'Master', NULL, NULL, 1),
(52, 95, '2', '', '2019-12-28 12:04:00', 'Master', '2019-12-28 11:15:37', 'Master', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `grn_quantity`
--
CREATE TABLE IF NOT EXISTS `grn_quantity` (
`product_id` int(11)
,`Received_quantity` double(17,0)
);
-- --------------------------------------------------------

--
-- Table structure for table `price_scheme`
--

CREATE TABLE IF NOT EXISTS `price_scheme` (
  `Price_id` int(11) NOT NULL AUTO_INCREMENT,
  `Price_scheme` varchar(50) NOT NULL,
  `Discount_percentage` double NOT NULL,
  `Date_added` datetime DEFAULT NULL,
  `Added_by` varchar(50) DEFAULT NULL,
  `Date_updated` datetime DEFAULT NULL,
  `Updated_by` varchar(50) DEFAULT NULL,
  `Price_active` int(11) NOT NULL,
  `Price_status` int(11) NOT NULL,
  PRIMARY KEY (`Price_id`),
  UNIQUE KEY `price_scheme` (`Price_scheme`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `price_scheme`
--

INSERT INTO `price_scheme` (`Price_id`, `Price_scheme`, `Discount_percentage`, `Date_added`, `Added_by`, `Date_updated`, `Updated_by`, `Price_active`, `Price_status`) VALUES
(1, 'Retailer', 0.03, '2018-05-27 20:37:42', 'Abebe.tefera', '2019-10-17 13:14:42', 'Master', 1, 1),
(2, 'Big Sell', 0.09, '2018-05-27 20:41:41', 'Abebe.tefera', '2018-05-28 13:44:00', 'Abebe.tefera', 1, 1),
(3, 'Whole Saler', 0.06, '2018-06-16 15:39:53', 'Abebe.Tefera', '2018-07-01 08:18:51', 'Master', 1, 1),
(4, 'Normal Price', 0, '2018-06-16 15:40:36', 'Abebe.Tefera', NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `Product_id` int(11) NOT NULL AUTO_INCREMENT,
  `Category_id` int(11) NOT NULL,
  `Brand_id` int(11) NOT NULL,
  `Part_no` varchar(50) NOT NULL,
  `Description` varchar(100) DEFAULT NULL,
  `Model` varchar(50) NOT NULL,
  `Critical_limit` int(11) NOT NULL,
  `Stock_unit_id` int(11) NOT NULL,
  `Shelf_id` int(11) NOT NULL,
  `Selling_price` double(20,0) DEFAULT NULL,
  `Part_image` text NOT NULL,
  `Date_added` datetime DEFAULT NULL,
  `Added_by` varchar(50) DEFAULT NULL,
  `Date_updated` datetime DEFAULT NULL,
  `Updated_by` varchar(50) DEFAULT NULL,
  `Product_active` int(11) NOT NULL,
  `Product_status` int(11) NOT NULL,
  PRIMARY KEY (`Product_id`),
  UNIQUE KEY `Part_no` (`Part_no`),
  KEY `Brand_id` (`Brand_id`),
  KEY `Category_id` (`Category_id`),
  KEY `Stock_unit_id` (`Stock_unit_id`),
  KEY `Shelf_id` (`Shelf_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_id`, `Category_id`, `Brand_id`, `Part_no`, `Description`, `Model`, `Critical_limit`, `Stock_unit_id`, `Shelf_id`, `Selling_price`, `Part_image`, `Date_added`, `Added_by`, `Date_updated`, `Updated_by`, `Product_active`, `Product_status`) VALUES
(11, 4, 8, 'P1002', 'filter', '002', 10, 3, 1, 2000, '../assests/images/stock/211755e019416c6b5b.jpg', '2018-07-07 11:53:32', 'Kedir.Abdela', '2019-12-24 07:29:03', 'Master', 1, 1),
(10, 4, 8, 'P1003', 'oil filter', '002', 10, 3, 4, 1300, '../assests/images/stock/40515e01945673cd0.jpg', '2018-07-07 09:52:48', 'Kedir.Abdela', '2019-12-24 07:31:05', 'Master', 1, 1),
(9, 2, 8, 'P4444547', 'Front Tyre', '124558', 20, 3, 3, 1800, '../assests/images/stock/166695b3b28f2e85e3.jpg', '2018-06-29 05:36:41', 'Abebe.Tefera', '2018-07-07 09:24:09', 'Master', 1, 1),
(8, 2, 5, 'P2121545', 'Spokio', '123345', 20, 3, 1, 1500, '../assests/images/stock/70135e0193d037148.jpg', '2018-06-27 21:10:16', 'Abebe.Tefera', '2018-07-05 19:25:38', 'Master', 1, 1),
(7, 2, 13, 'P1123356', 'Tyre', '12457', 15, 2, 1, 1500, '../assests/images/stock/179325b3cff2db1e4d.jpg', '2018-06-27 21:08:05', 'Abebe.Tefera', '2018-07-05 19:11:24', 'Master', 2, 2),
(12, 2, 8, 'P0006', 'gsdgd', '123', 45, 2, 1, 1222, '../assests/images/stock/108515da83e8e5c798.png', '2018-07-21 16:06:33', 'Master', '2018-07-21 16:08:21', 'Master', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE IF NOT EXISTS `purchase` (
  `Purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `Purchase_date` date NOT NULL,
  `Vendor_id` int(11) NOT NULL,
  `Total_amount` double(20,2) NOT NULL,
  `Total_payment` double(20,2) NOT NULL,
  `Balance` double(20,2) NOT NULL,
  `Payment_type` int(11) NOT NULL,
  `Payment_status` int(11) NOT NULL,
  `Date_added` datetime DEFAULT NULL,
  `Added_by` varchar(50) DEFAULT NULL,
  `Date_updated` datetime DEFAULT NULL,
  `Updated_by` varchar(50) DEFAULT NULL,
  `Purchase_status` int(11) NOT NULL,
  PRIMARY KEY (`Purchase_id`),
  KEY `Vendor_id` (`Vendor_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`Purchase_id`, `Purchase_date`, `Vendor_id`, `Total_amount`, `Total_payment`, `Balance`, `Payment_type`, `Payment_status`, `Date_added`, `Added_by`, `Date_updated`, `Updated_by`, `Purchase_status`) VALUES
(31, '2018-07-06', 3, 2500.00, 2500.00, 0.00, 2, 1, '2018-07-06 19:43:50', 'Tigist.Berihun', NULL, NULL, 1),
(34, '2018-07-21', 1, 100000.00, 100000.00, 0.00, 2, 1, '2018-07-21 16:11:43', 'Master', NULL, NULL, 1),
(35, '2019-10-17', 1, 130000.00, 120000.00, 10000.00, 2, 2, '2019-10-17 13:06:45', 'Master', NULL, NULL, 1),
(36, '2019-12-21', 3, 21000.00, 15000.00, 6000.00, 2, 2, '2019-12-21 17:48:39', 'Master', NULL, NULL, 1),
(33, '2018-07-07', 1, 40000.00, 50000.00, -10000.00, 2, 1, '2018-07-07 11:57:19', 'Tigist.Berihun', '2018-07-19 23:08:52', 'Master', 1),
(32, '2018-07-07', 1, 10000.00, 10000.00, 0.00, 2, 1, '2018-07-07 10:08:55', 'Tigist.Berihun', NULL, NULL, 1),
(30, '2018-07-05', 1, 133500.00, 133500.00, 0.00, 2, 1, '2018-07-05 19:15:48', 'Master', NULL, NULL, 1),
(29, '2018-07-04', 1, 150000.00, 150000.00, 0.00, 2, 1, '2018-07-04 21:59:21', 'Master', NULL, NULL, 1),
(28, '2018-06-29', 3, 19500.00, 19500.00, 0.00, 2, 1, '2018-06-29 05:42:34', 'Abebe.Tefera', NULL, NULL, 1),
(27, '2018-06-29', 1, 72000.00, 50000.00, 22000.00, 2, 2, '2018-06-29 05:34:17', 'Abebe.Tefera', NULL, NULL, 1),
(37, '2019-12-25', 1, 5000.00, 5000.00, 0.00, 2, 1, '2019-12-25 20:27:54', 'Master', NULL, NULL, 1),
(38, '2019-12-25', 1, 6110.00, 6110.00, 0.00, 2, 1, '2019-12-25 20:43:27', 'Master', '2019-12-28 11:15:37', 'Master', 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_detail`
--

CREATE TABLE IF NOT EXISTS `purchase_detail` (
  `Purchase_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `Purchase_id` int(11) NOT NULL,
  `PR_id` int(11) DEFAULT NULL,
  `Product_id` int(11) NOT NULL,
  `Purchasing_quantity` double(20,0) NOT NULL,
  `Purchasing_price` double(20,2) NOT NULL,
  `Purchasing_total_amount` double(20,2) NOT NULL,
  `Date_added` datetime DEFAULT NULL,
  `Added_by` varchar(50) DEFAULT NULL,
  `Date_updated` datetime DEFAULT NULL,
  `Updated_by` varchar(50) DEFAULT NULL,
  `Purchase_item_status` int(11) NOT NULL,
  PRIMARY KEY (`Purchase_item_id`),
  UNIQUE KEY `Purchase_id` (`Purchase_id`,`Product_id`),
  KEY `Product_id` (`Product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=96 ;

--
-- Dumping data for table `purchase_detail`
--

INSERT INTO `purchase_detail` (`Purchase_item_id`, `Purchase_id`, `PR_id`, `Product_id`, `Purchasing_quantity`, `Purchasing_price`, `Purchasing_total_amount`, `Date_added`, `Added_by`, `Date_updated`, `Updated_by`, `Purchase_item_status`) VALUES
(91, 35, 32, 8, 100, 1300.00, 130000.00, '2019-10-17 13:06:45', 'Master', NULL, NULL, 1),
(90, 34, 35, 12, 100, 1000.00, 100000.00, '2018-07-21 16:11:43', 'Master', NULL, NULL, 1),
(89, 33, 33, 10, 40, 1000.00, 40000.00, '2018-07-19 23:08:52', 'Master', '2018-07-19 23:08:52', 'Master', 1),
(87, 32, 32, 10, 10, 1000.00, 10000.00, '2018-07-07 10:08:55', 'Tigist.Berihun', NULL, NULL, 1),
(84, 29, 31, 9, 100, 1500.00, 150000.00, '2018-07-04 21:59:21', 'Master', NULL, NULL, 1),
(85, 30, 25, 8, 100, 1335.00, 133500.00, '2018-07-05 19:15:48', 'Master', NULL, NULL, 1),
(86, 31, 31, 9, 50, 50.00, 2500.00, '2018-07-06 19:43:50', 'Tigist.Berihun', NULL, NULL, 1),
(83, 28, 27, 9, 15, 1300.00, 19500.00, '2018-06-29 05:42:34', 'Abebe.Tefera', NULL, NULL, 1),
(82, 27, 26, 7, 80, 900.00, 72000.00, '2018-06-29 05:34:17', 'Abebe.Tefera', NULL, NULL, 1),
(92, 36, 42, 12, 42, 500.00, 21000.00, '2019-12-21 17:48:39', 'Master', NULL, NULL, 1),
(93, 37, 32, 11, 10, 500.00, 5000.00, '2019-12-25 20:27:54', 'Master', NULL, NULL, 1),
(95, 38, 26, 10, 26, 235.00, 6110.00, '2019-12-28 11:15:37', 'Master', '2019-12-28 11:15:37', 'Master', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `purchase_quantity`
--
CREATE TABLE IF NOT EXISTS `purchase_quantity` (
`product_id` int(11)
,`purQty` double(17,0)
);
-- --------------------------------------------------------

--
-- Table structure for table `purchase_requisition`
--

CREATE TABLE IF NOT EXISTS `purchase_requisition` (
  `PR_id` int(11) NOT NULL AUTO_INCREMENT,
  `Product_id` int(11) NOT NULL,
  `PR_Quantity` double(20,0) NOT NULL,
  `Date_Requested` datetime NOT NULL,
  `Requested_by` varchar(50) NOT NULL,
  `PR_acceptance` varchar(50) DEFAULT NULL,
  `Note` longtext,
  `Date_acceptance` datetime DEFAULT NULL,
  `Acceptance_by` varchar(50) DEFAULT NULL,
  `Date_updated` datetime DEFAULT NULL,
  `Updated_by` varchar(50) DEFAULT NULL,
  `PR_status` int(11) NOT NULL,
  PRIMARY KEY (`PR_id`),
  KEY `Product_id` (`Product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `purchase_requisition`
--

INSERT INTO `purchase_requisition` (`PR_id`, `Product_id`, `PR_Quantity`, `Date_Requested`, `Requested_by`, `PR_acceptance`, `Note`, `Date_acceptance`, `Acceptance_by`, `Date_updated`, `Updated_by`, `PR_status`) VALUES
(31, 12, 100, '2018-06-29 07:21:05', 'Abebe.Tefera', '2', 'Temporarily we havent cash', '2018-07-19 21:40:22', 'Master', '2019-07-25 11:03:22', 'Master', 1),
(30, 9, 120, '2018-06-29 07:19:58', 'Abebe.Tefera', '1', '', NULL, NULL, '2018-06-29 07:20:36', 'Abebe.Tefera', 2),
(32, 10, 30, '2018-07-07 09:55:17', 'Kedir.Abdela', '2', 'NULL', '2018-07-07 10:05:54', 'Tigist.Berihun', NULL, NULL, 1),
(27, 9, 15, '2018-06-29 05:38:05', 'Abebe.Tefera', '3', 'We will purchase after a month', '2018-07-19 21:49:30', 'Master', NULL, NULL, 1),
(26, 7, 80, '2018-06-29 05:28:53', 'Abebe.Tefera', '2', '', '2018-06-29 05:30:34', 'Abebe.Tefera', '2018-06-29 05:30:07', 'Abebe.Tefera', 1),
(25, 8, 100, '2018-06-29 05:28:24', 'Abebe.Tefera', '2', '', '2018-06-29 05:32:15', 'Abebe.Tefera', NULL, NULL, 1),
(33, 10, 50, '2018-07-07 11:48:08', 'Kedir.Abdela', '4', 'We cant purchase this product for the time being\r\nSorry!', '2018-07-19 21:51:10', 'Master', NULL, NULL, 1),
(34, 8, 20, '2018-07-21 15:48:08', 'Kedir.Abdela', '3', 'We have no cash for the time being', '2018-07-21 15:49:24', 'Master', NULL, NULL, 1),
(35, 12, 100, '2018-07-21 16:10:05', 'Master', '2', 'no comeent', '2018-07-21 16:10:31', 'Master', '2019-01-11 16:06:27', 'Master', 1),
(36, 9, 56, '2019-02-16 17:47:18', 'Master', '2', NULL, '2019-11-23 04:48:17', 'Master', NULL, NULL, 1),
(37, 10, 5, '2019-07-25 11:03:07', 'Master', '1', NULL, NULL, NULL, NULL, NULL, 1),
(38, 8, 50, '2019-10-17 13:03:47', 'Master', '1', NULL, NULL, NULL, '2019-12-28 11:47:32', 'Master', 1),
(40, 8, 60, '2019-11-23 17:48:40', 'Master', '2', 'Accepted', '2019-12-28 11:46:22', 'Master', NULL, NULL, 1),
(41, 11, 40, '2019-11-23 17:59:56', 'Master', '2', 'as', '2019-12-28 11:45:21', 'Master', NULL, NULL, 1),
(42, 12, 42, '2019-12-21 17:40:02', 'Master', '2', '', '2019-12-28 11:46:00', 'Master', '2019-12-21 17:40:36', 'Master', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales_detail`
--

CREATE TABLE IF NOT EXISTS `sales_detail` (
  `Sales_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `Sales_id` int(11) NOT NULL,
  `Product_id` int(11) NOT NULL,
  `Selling_quantity` double(20,0) NOT NULL,
  `Selling_price` double(20,2) NOT NULL,
  `Selling_total_amount` double(20,2) NOT NULL,
  `Date_added` datetime DEFAULT NULL,
  `Added_by` varchar(50) DEFAULT NULL,
  `Date_updated` datetime DEFAULT NULL,
  `Updated_by` varchar(50) DEFAULT NULL,
  `Sales_item_status` int(11) NOT NULL,
  PRIMARY KEY (`Sales_item_id`),
  UNIQUE KEY `Sales_id` (`Sales_id`,`Product_id`),
  KEY `Product_id` (`Product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `sales_detail`
--

INSERT INTO `sales_detail` (`Sales_item_id`, `Sales_id`, `Product_id`, `Selling_quantity`, `Selling_price`, `Selling_total_amount`, `Date_added`, `Added_by`, `Date_updated`, `Updated_by`, `Sales_item_status`) VALUES
(102, 37, 12, 30, 1222.00, 36660.00, '2019-12-21 18:16:10', 'Master', NULL, NULL, 1),
(101, 36, 12, 60, 1222.00, 73320.00, '2019-10-17 13:16:12', 'Master', NULL, NULL, 1),
(99, 34, 12, 10, 1222.00, 12220.00, '2019-08-13 11:53:34', 'Master', NULL, NULL, 1),
(100, 35, 8, 1, 1500.00, 1500.00, '2019-10-07 18:52:20', 'Master', NULL, NULL, 2),
(98, 33, 9, 89, 1800.00, 360000.00, '2019-08-09 16:03:08', 'Master', NULL, NULL, 1),
(97, 32, 8, 1, 1500.00, 0.00, '2019-07-25 11:19:07', 'Master', NULL, NULL, 1),
(96, 31, 12, 1, 1222.00, 1222.00, '2019-07-25 11:13:55', 'Zufan.Abate', NULL, NULL, 1),
(95, 31, 8, 1, 1500.00, 1500.00, '2019-07-25 11:13:55', 'Zufan.Abate', NULL, NULL, 1),
(94, 30, 8, 1, 1500.00, 15000.00, '2019-01-12 19:13:38', 'Master', NULL, NULL, 1),
(93, 30, 9, 6, 1800.00, 10800.00, '2019-01-12 19:13:38', 'Master', NULL, NULL, 1),
(92, 29, 8, 4, 1500.00, 6000.00, '2018-07-19 21:06:24', 'Master', '2018-07-19 21:06:24', 'Master', 1),
(89, 28, 8, 5, 1500.00, 7500.00, '2018-07-07 09:56:57', 'Zufan.Abate', NULL, NULL, 1),
(88, 27, 8, 90, 1500.00, 135000.00, '2018-07-05 19:33:11', 'Master', '2018-07-05 19:33:11', 'Master', 1),
(86, 26, 9, 5, 1600.00, 8000.00, '2018-07-04 22:05:45', 'Master', NULL, NULL, 1),
(85, 25, 7, 70, 1500.00, 150000.00, '2018-07-01 05:46:50', 'Master', NULL, NULL, 1),
(84, 25, 9, 15, 1600.00, 32000.00, '2018-07-01 05:46:50', 'Master', NULL, NULL, 1),
(83, 24, 9, 20, 1600.00, 32000.00, '2018-07-01 03:44:56', 'Master', NULL, NULL, 2),
(82, 22, 7, 10, 1500.00, 15000.00, '2018-06-29 06:09:59', 'Abebe.Tefera', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE IF NOT EXISTS `sales_order` (
  `Sales_id` int(11) NOT NULL AUTO_INCREMENT,
  `Sales_date` date NOT NULL,
  `Customer_id` int(11) NOT NULL,
  `Sub_total` double(20,2) NOT NULL,
  `Vat_percentage` int(11) NOT NULL DEFAULT '15',
  `Vat` double(20,2) NOT NULL,
  `Total_amount` double(20,2) NOT NULL,
  `Price_id` int(11) NOT NULL,
  `Discount` double(20,2) NOT NULL,
  `Grand_total` double(20,2) NOT NULL,
  `Total_payment` double(20,2) NOT NULL,
  `Due` double(20,2) NOT NULL,
  `Payment_type` int(11) NOT NULL,
  `Payment_status` int(11) NOT NULL,
  `Date_added` datetime DEFAULT NULL,
  `Added_by` varchar(50) DEFAULT NULL,
  `Date_updated` datetime DEFAULT NULL,
  `Updated_by` varchar(50) DEFAULT NULL,
  `Sales_status` int(11) NOT NULL,
  PRIMARY KEY (`Sales_id`),
  KEY `Price_id` (`Price_id`),
  KEY `Customer_id` (`Customer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `sales_order`
--

INSERT INTO `sales_order` (`Sales_id`, `Sales_date`, `Customer_id`, `Sub_total`, `Vat_percentage`, `Vat`, `Total_amount`, `Price_id`, `Discount`, `Grand_total`, `Total_payment`, `Due`, `Payment_type`, `Payment_status`, `Date_added`, `Added_by`, `Date_updated`, `Updated_by`, `Sales_status`) VALUES
(36, '2019-10-17', 2, 73320.00, 15, 10998.00, 84318.00, 1, 2529.54, 81788.46, 81788.46, 0.00, 2, 1, '2019-10-17 13:16:12', 'Master', NULL, NULL, 1),
(35, '2019-10-07', 1, 1500.00, 15, 225.00, 1725.00, 1, 86.25, 1638.75, 1500.00, 138.75, 2, 2, '2019-10-07 18:52:20', 'Master', NULL, NULL, 2),
(34, '2019-08-13', 2, 12220.00, 15, 1833.00, 14053.00, 4, 0.00, 14053.00, 14053.00, 0.00, 2, 1, '2019-08-13 11:53:34', 'Master', NULL, NULL, 1),
(32, '2019-07-25', 2, 0.00, 15, 0.00, 0.00, 2, 0.00, 0.00, 0.00, 0.00, 2, 1, '2019-07-25 11:19:07', 'Master', NULL, NULL, 1),
(33, '2019-08-09', 1, 360000.00, 15, 54000.00, 414000.00, 2, 37260.00, 376740.00, 376740.00, 0.00, 2, 1, '2019-08-09 16:03:07', 'Master', NULL, NULL, 1),
(31, '2019-07-25', 1, 2722.00, 15, 408.30, 3130.30, 2, 281.73, 2848.57, 2848.57, 0.00, 2, 1, '2019-07-25 11:13:55', 'Zufan.Abate', NULL, NULL, 1),
(30, '2019-01-12', 1, 34800.00, 15, 5220.00, 40020.00, 1, 2001.00, 38019.00, 38019.00, 0.00, 2, 1, '2019-01-12 19:13:38', 'Master', NULL, NULL, 1),
(29, '2018-07-07', 1, 7500.00, 15, 1125.00, 8625.00, 3, 517.50, 8107.50, 5486.00, 2621.50, 2, 1, '2018-07-07 12:19:08', 'Zufan.Abate', '2018-07-19 21:06:24', 'Master', 1),
(28, '2018-07-07', 1, 7500.00, 15, 1125.00, 8625.00, 4, 0.00, 8625.00, 8625.00, 0.00, 2, 1, '2018-07-07 09:56:57', 'Zufan.Abate', NULL, NULL, 1),
(27, '2018-07-05', 1, 135000.00, 15, 20250.00, 155250.00, 1, 7762.50, 147487.50, 147487.50, 0.00, 2, 1, '2018-07-05 19:31:01', 'Master', '2018-07-05 19:33:11', 'Master', 1),
(26, '2018-07-04', 1, 8000.00, 15, 1200.00, 9200.00, 4, 0.00, 9200.00, 9200.00, 0.00, 2, 1, '2018-07-04 22:05:45', 'Master', NULL, NULL, 1),
(24, '2018-07-01', 2, 32000.00, 15, 4800.00, 36800.00, 1, 1840.00, 34960.00, 34960.00, 0.00, 2, 1, '2018-07-01 03:44:56', 'Master', NULL, NULL, 2),
(22, '2018-06-29', 1, 15000.00, 15, 2250.00, 17250.00, 1, 862.50, 16387.50, 8000.00, 8387.50, 2, 2, '2018-06-29 06:09:59', 'Abebe.Tefera', NULL, NULL, 1),
(25, '2018-07-01', 2, 182000.00, 15, 27300.00, 209300.00, 4, 0.00, 209300.00, 209300.00, 0.00, 2, 1, '2018-07-01 05:46:50', 'Master', NULL, NULL, 1),
(37, '2019-12-21', 2, 36660.00, 15, 5499.00, 42159.00, 1, 1264.77, 40894.23, 40894.00, 0.23, 2, 2, '2019-12-21 18:16:10', 'Master', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `sales_quantity`
--
CREATE TABLE IF NOT EXISTS `sales_quantity` (
`product_id` int(11)
,`SalesQty` double(17,0)
);
-- --------------------------------------------------------

--
-- Table structure for table `shelf`
--

CREATE TABLE IF NOT EXISTS `shelf` (
  `Shelf_id` int(11) NOT NULL AUTO_INCREMENT,
  `Shelf_description` varchar(50) NOT NULL,
  `Date_added` datetime DEFAULT NULL,
  `Added_by` varchar(50) DEFAULT NULL,
  `Date_updated` datetime DEFAULT NULL,
  `Updated_by` varchar(50) DEFAULT NULL,
  `Shelf_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`Shelf_id`),
  UNIQUE KEY `Shelf_description` (`Shelf_description`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `shelf`
--

INSERT INTO `shelf` (`Shelf_id`, `Shelf_description`, `Date_added`, `Added_by`, `Date_updated`, `Updated_by`, `Shelf_status`) VALUES
(1, '1002', '2018-05-25 00:43:28', 'Abebe.tefera', '2018-05-25 01:06:39', 'Abebe.tefera', 1),
(2, '213', '2018-05-25 01:07:43', 'Abebe.tefera', NULL, NULL, 2),
(3, '246', '2018-05-25 01:07:50', 'Abebe.tefera', NULL, NULL, 2),
(4, 'A/122/B01', '2018-05-25 01:08:04', 'Abebe.tefera', NULL, NULL, 1),
(5, 'SH001A', '2018-07-07 09:50:31', 'Kedir.Abdela', NULL, NULL, 1),
(6, 'SH001B', '2018-07-07 09:50:41', 'Kedir.Abdela', NULL, NULL, 1),
(7, 'SH001C', '2018-07-07 09:51:00', 'Kedir.Abdela', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `siv_quantity`
--
CREATE TABLE IF NOT EXISTS `siv_quantity` (
`product_id` int(11)
,`Issued_quantity` double(17,0)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `stock_balance`
--
CREATE TABLE IF NOT EXISTS `stock_balance` (
`product_id` int(11)
,`received_quantity` double(17,0)
,`issued_quantity` double(17,0)
,`Stock_balance` double(17,0)
);
-- --------------------------------------------------------

--
-- Table structure for table `stock_unit`
--

CREATE TABLE IF NOT EXISTS `stock_unit` (
  `Stock_unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `Stock_unit_description` varchar(50) NOT NULL,
  `Date_added` datetime DEFAULT NULL,
  `Added_by` varchar(50) DEFAULT NULL,
  `Date_updated` datetime DEFAULT NULL,
  `Updated_by` varchar(50) DEFAULT NULL,
  `Stock_unit_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`Stock_unit_id`),
  UNIQUE KEY `Stock_unit_description` (`Stock_unit_description`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `stock_unit`
--

INSERT INTO `stock_unit` (`Stock_unit_id`, `Stock_unit_description`, `Date_added`, `Added_by`, `Date_updated`, `Updated_by`, `Stock_unit_status`) VALUES
(2, 'Pack', '2018-05-25 21:47:49', 'Abebe.tefera', NULL, NULL, 1),
(3, 'PC', '2018-05-25 21:49:05', 'Abebe.tefera', '2018-07-07 09:51:23', 'Kedir.Abdela', 1);

-- --------------------------------------------------------

--
-- Table structure for table `store_issuance_voucher`
--

CREATE TABLE IF NOT EXISTS `store_issuance_voucher` (
  `SIV_id` int(11) NOT NULL AUTO_INCREMENT,
  `SR_id` int(11) NOT NULL,
  `Date_Issued` datetime NOT NULL,
  `Date_added` datetime DEFAULT NULL,
  `Added_by` varchar(50) DEFAULT NULL,
  `Date_updated` datetime DEFAULT NULL,
  `Updated_by` varchar(50) DEFAULT NULL,
  `SIV_status` int(11) NOT NULL,
  PRIMARY KEY (`SIV_id`),
  UNIQUE KEY `SR_id` (`SR_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `store_issuance_voucher`
--

INSERT INTO `store_issuance_voucher` (`SIV_id`, `SR_id`, `Date_Issued`, `Date_added`, `Added_by`, `Date_updated`, `Updated_by`, `SIV_status`) VALUES
(4, 14, '2018-07-01 06:26:25', '2018-07-01 06:26:25', 'Master', NULL, NULL, 1),
(3, 11, '2018-06-29 13:43:29', '2018-06-29 13:43:29', 'Abebe.Tefera', NULL, NULL, 1),
(5, 15, '2018-07-04 23:01:41', '2018-07-04 23:01:41', 'Master', NULL, NULL, 1),
(6, 17, '2018-07-05 19:40:23', '2018-07-05 19:40:23', 'Master', NULL, NULL, 1),
(7, 18, '2018-07-07 11:49:50', '2018-07-07 11:49:50', 'Kedir.Abdela', NULL, NULL, 1),
(8, 21, '2019-02-16 17:48:24', '2019-02-16 17:48:24', 'Master', NULL, NULL, 1),
(9, 22, '2019-02-16 17:50:38', '2019-02-16 17:50:38', 'Master', NULL, NULL, 1),
(10, 28, '2019-10-17 13:18:50', '2019-10-17 13:18:50', 'Master', NULL, NULL, 1),
(11, 27, '2019-12-21 17:35:47', '2019-12-21 17:35:47', 'Master', NULL, NULL, 1),
(12, 29, '2019-12-21 18:20:22', '2019-12-21 18:20:22', 'Master', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `store_requisition`
--

CREATE TABLE IF NOT EXISTS `store_requisition` (
  `SR_id` int(11) NOT NULL AUTO_INCREMENT,
  `Sales_id` int(11) NOT NULL,
  `Date_Requested` datetime NOT NULL,
  `Requested_by` varchar(50) NOT NULL,
  `SR_acceptance` varchar(50) NOT NULL,
  `Note` varchar(255) DEFAULT NULL,
  `Date_acceptance` datetime DEFAULT NULL,
  `Acceptance_by` varchar(50) DEFAULT NULL,
  `Date_updated` datetime DEFAULT NULL,
  `Updated_by` varchar(50) DEFAULT NULL,
  `SR_status` int(11) NOT NULL,
  PRIMARY KEY (`SR_id`),
  KEY `Sales_id` (`Sales_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `store_requisition`
--

INSERT INTO `store_requisition` (`SR_id`, `Sales_id`, `Date_Requested`, `Requested_by`, `SR_acceptance`, `Note`, `Date_acceptance`, `Acceptance_by`, `Date_updated`, `Updated_by`, `SR_status`) VALUES
(21, 29, '2018-07-07 12:19:08', 'Zufan.Abate', '2', 'A', '2019-12-28 10:15:58', 'Master', '2018-07-19 21:06:24', 'Master', 1),
(17, 27, '2018-07-05 19:31:01', 'Master', '2', 'No Item', '2018-07-21 15:54:38', 'Master', '2018-07-05 19:33:11', 'Master', 1),
(18, 28, '2018-07-07 09:56:57', 'Zufan.Abate', '3', 'This Item is not available', '2018-07-21 15:48:26', 'Master', NULL, NULL, 1),
(14, 25, '2018-07-01 05:46:50', 'Master', '2', '', '2018-07-01 06:02:35', 'Master', NULL, NULL, 1),
(15, 26, '2018-07-04 22:05:45', 'Master', '2', '', '2018-07-06 06:40:08', 'Master', NULL, NULL, 1),
(13, 24, '2018-07-01 03:44:56', 'Master', '2', '', '2018-07-01 06:02:26', 'Master', NULL, NULL, 2),
(11, 22, '2018-06-29 06:09:59', 'Abebe.Tefera', '2', '', '2018-06-29 06:12:43', 'Abebe.Tefera', NULL, NULL, 1),
(22, 30, '2019-01-12 19:13:38', 'Master', '2', NULL, '2019-02-16 17:50:33', 'Master', NULL, NULL, 1),
(23, 31, '2019-07-25 11:13:55', 'Zufan.Abate', '1', NULL, NULL, NULL, NULL, NULL, 1),
(24, 32, '2019-07-25 11:19:07', 'Master', '1', NULL, NULL, NULL, NULL, NULL, 1),
(25, 33, '2019-08-09 16:03:08', 'Master', '1', NULL, NULL, NULL, NULL, NULL, 1),
(26, 34, '2019-08-13 11:53:34', 'Master', '1', NULL, NULL, NULL, NULL, NULL, 1),
(27, 35, '2019-10-07 18:52:20', 'Master', '2', NULL, '2019-12-21 17:35:32', 'Master', NULL, NULL, 1),
(28, 36, '2019-10-17 13:16:12', 'Master', '2', NULL, '2019-10-17 13:18:44', 'Master', NULL, NULL, 1),
(29, 37, '2019-12-21 18:16:10', 'Master', '2', '', '2019-12-28 12:01:05', 'Master', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `User_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_name` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `First_name` varchar(50) NOT NULL,
  `Last_name` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `User_role_id` int(11) NOT NULL,
  `Last_Login` datetime DEFAULT NULL,
  `Date_added` datetime DEFAULT NULL,
  `Added_by` varchar(50) DEFAULT NULL,
  `Date_updated` datetime DEFAULT NULL,
  `Updated_by` varchar(50) DEFAULT NULL,
  `User_active` int(11) NOT NULL,
  `User_status` int(11) NOT NULL,
  PRIMARY KEY (`User_id`),
  UNIQUE KEY `User_name` (`User_name`),
  KEY `User_role_id` (`User_role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_id`, `User_name`, `Password`, `First_name`, `Last_name`, `Email`, `User_role_id`, `Last_Login`, `Date_added`, `Added_by`, `Date_updated`, `Updated_by`, `User_active`, `User_status`) VALUES
(4, 'Abebe.Tefera', 'cfd5d08890236e3ac11042df3a5b066f79f4e81735111f7e0c5146957d182b48', 'Abebe', 'Tefera', 'Abe2000ec@gmail.com', 1, '2019-12-19 20:33:01', '2018-05-29 18:54:01', 'Kedir.Abdela', '2018-06-20 13:48:29', 'Abebe.Tefera', 1, 2),
(3, 'Kedir.Abdela', '0b113c74ae6c2af627ef0fcf6c4d33a95d878ce455a83e34eb4d23d146103d05', 'Kedir', 'Abdela', 'Kedir@gmail.com', 3, '2018-07-21 15:47:23', '2018-05-29 18:35:16', 'Abebe.tefera', '2018-07-21 15:47:10', 'Master', 1, 1),
(8, 'Tigist.Tamiru', '0b113c74ae6c2af627ef0fcf6c4d33a95d878ce455a83e34eb4d23d146103d05', 'Tigist', 'Tamiru', 'Tigist@gmail.com', 1, NULL, '2018-06-16 14:51:23', 'Kedir.Abdela', NULL, NULL, 1, 2),
(7, 'Zufan.Abate', '0b113c74ae6c2af627ef0fcf6c4d33a95d878ce455a83e34eb4d23d146103d05', 'Zufan', 'Abate', 'Zufan@gmail.com', 2, '2019-07-25 11:10:13', '2018-06-16 14:48:38', 'Kedir.Abdela', '2018-06-30 12:23:38', 'Abebe.Tefera', 1, 1),
(9, 'Woubit_Birhanu', '0b113c74ae6c2af627ef0fcf6c4d33a95d878ce455a83e34eb4d23d146103d05', 'Woubit', 'Birhanu', 'woubit@gmail.com', 4, '2018-06-30 14:11:25', '2018-06-17 21:06:45', 'Abebe.Tefera', '2019-12-26 19:08:52', 'Master', 1, 1),
(10, 'Besu.Yitbarek', '0b113c74ae6c2af627ef0fcf6c4d33a95d878ce455a83e34eb4d23d146103d05', 'Besu', 'Yitbarek', 'Besu@gmail.com', 6, '2019-12-21 12:00:50', '2018-06-17 21:09:14', 'Abebe.Tefera', '2018-06-30 12:23:55', 'Abebe.Tefera', 1, 1),
(11, 'Tigist.Berihun', '0b113c74ae6c2af627ef0fcf6c4d33a95d878ce455a83e34eb4d23d146103d05', 'Tigist', 'Berihun', 'Tigist@yahoo.com', 5, '2018-07-07 11:59:41', '2018-06-30 12:26:00', 'Abebe.Tefera', '2019-10-07 18:43:53', 'Master', 2, 2),
(12, 'Master', '404b8c5a0a3856eb7431cde448f89e42b1bfa03f5343db083d42a54d9dc5c5ae', 'Master', 'Master', 'master@yahoo.com', 7, '2019-12-28 09:58:27', '2018-06-30 12:49:07', 'Abebe.Tefera', NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `User_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_role` varchar(50) NOT NULL,
  `Date_added` datetime DEFAULT NULL,
  `Added_by` varchar(50) DEFAULT NULL,
  `Date_updated` datetime DEFAULT NULL,
  `Updated_by` varchar(50) DEFAULT NULL,
  `User_role_active` int(11) NOT NULL,
  `User_role_status` int(11) NOT NULL,
  PRIMARY KEY (`User_role_id`),
  UNIQUE KEY `User_Role` (`User_role`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`User_role_id`, `User_role`, `Date_added`, `Added_by`, `Date_updated`, `Updated_by`, `User_role_active`, `User_role_status`) VALUES
(1, 'Admin', NULL, NULL, '2018-06-30 12:18:08', 'Abebe.Tefera', 1, 1),
(2, 'Sales Officer', '2018-05-28 21:29:03', 'Abebe.tefera', '2018-05-28 21:31:02', 'Abebe.tefera', 1, 1),
(3, 'Store Keeper', '2018-05-28 21:31:40', 'Abebe.tefera', NULL, NULL, 1, 1),
(4, 'Casher', '2018-06-22 13:06:04', 'Abebe.Tefera', NULL, NULL, 1, 1),
(5, 'Purchaser', '2018-06-30 12:17:59', 'Abebe.Tefera', NULL, NULL, 1, 1),
(6, 'Sales Manager', '2018-06-30 12:18:41', 'Abebe.Tefera', NULL, NULL, 1, 1),
(7, 'Master', '2018-06-30 12:22:20', 'Abebe.Tefera', NULL, NULL, 1, 1),
(8, 'Examiner', '2018-07-03 16:00:37', 'Master', '2019-02-23 15:10:11', 'Abebe.Tefera', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE IF NOT EXISTS `vendor` (
  `Vendor_id` int(11) NOT NULL AUTO_INCREMENT,
  `Vendor_name` varchar(50) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Contact_name` varchar(50) NOT NULL,
  `Phone` varchar(50) NOT NULL,
  `Fax` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Website` varchar(100) DEFAULT NULL,
  `Date_added` datetime DEFAULT NULL,
  `Added_by` varchar(50) DEFAULT NULL,
  `Date_updated` datetime DEFAULT NULL,
  `Updated_by` varchar(50) DEFAULT NULL,
  `Vendor_status` int(11) NOT NULL,
  PRIMARY KEY (`Vendor_id`),
  UNIQUE KEY `Vendor_name` (`Vendor_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`Vendor_id`, `Vendor_name`, `Country`, `City`, `Contact_name`, `Phone`, `Fax`, `Email`, `Website`, `Date_added`, `Added_by`, `Date_updated`, `Updated_by`, `Vendor_status`) VALUES
(1, 'Richard Ford Co.', 'England', 'London', 'Mr. Richard', '+24 25786932', '+24 11254668', 'Richard@gmail.com', 'WWW.richardford.com', '2018-05-28 14:15:46', 'Abebe.tefera', '2018-06-01 22:52:00', 'Abebe.Tefera', 1),
(3, 'Hujintao co.', 'Japan', 'Tokyo', 'Hun JIn Tao', '136546546', '3565655656', 'Hujintao@gmail.com', 'www.Hujintao.com', '2018-05-29 14:10:40', 'Abebe.tefera', '2018-06-01 22:50:53', 'Abebe.Tefera', 1);

-- --------------------------------------------------------

--
-- Structure for view `available_stock`
--
DROP TABLE IF EXISTS `available_stock`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `available_stock` AS select `g`.`product_id` AS `product_id`,`g`.`Received_quantity` AS `received_quantity`,`s`.`SalesQty` AS `SalesQty`,(`g`.`Received_quantity` - `s`.`SalesQty`) AS `stock_balance` from (`grn_quantity` `g` left join `sales_quantity` `s` on((`g`.`product_id` = `s`.`product_id`)));

-- --------------------------------------------------------

--
-- Structure for view `grn_quantity`
--
DROP TABLE IF EXISTS `grn_quantity`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `grn_quantity` AS select `p`.`Product_id` AS `product_id`,sum(`p`.`Purchasing_quantity`) AS `Received_quantity` from (`goods_receiving_note` `g` join `purchase_detail` `p` on((`g`.`Purchase_item_id` = `p`.`Purchase_item_id`))) where (`g`.`GRN_acceptance` = 2) group by `p`.`Product_id`;

-- --------------------------------------------------------

--
-- Structure for view `purchase_quantity`
--
DROP TABLE IF EXISTS `purchase_quantity`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `purchase_quantity` AS select `purchase_detail`.`Product_id` AS `product_id`,sum(`purchase_detail`.`Purchasing_quantity`) AS `purQty` from `purchase_detail` where (`purchase_detail`.`Purchase_item_status` = 1) group by `purchase_detail`.`Product_id`;

-- --------------------------------------------------------

--
-- Structure for view `sales_quantity`
--
DROP TABLE IF EXISTS `sales_quantity`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sales_quantity` AS select `sales_detail`.`Product_id` AS `product_id`,sum(`sales_detail`.`Selling_quantity`) AS `SalesQty` from `sales_detail` where (`sales_detail`.`Sales_item_status` = 1) group by `sales_detail`.`Product_id`;

-- --------------------------------------------------------

--
-- Structure for view `siv_quantity`
--
DROP TABLE IF EXISTS `siv_quantity`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `siv_quantity` AS select `s`.`Product_id` AS `product_id`,sum(`s`.`Selling_quantity`) AS `Issued_quantity` from ((`store_issuance_voucher` `siv` join `store_requisition` `sr` on((`siv`.`SR_id` = `sr`.`SR_id`))) join `sales_detail` `s` on((`sr`.`Sales_id` = `s`.`Sales_id`))) where ((`sr`.`SR_status` = 1) and (`siv`.`SIV_status` = 1) and (`s`.`Sales_item_status` = 1)) group by `s`.`Product_id`;

-- --------------------------------------------------------

--
-- Structure for view `stock_balance`
--
DROP TABLE IF EXISTS `stock_balance`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `stock_balance` AS select `g`.`product_id` AS `product_id`,`g`.`Received_quantity` AS `received_quantity`,`s`.`Issued_quantity` AS `issued_quantity`,(`g`.`Received_quantity` - `s`.`Issued_quantity`) AS `Stock_balance` from (`grn_quantity` `g` left join `siv_quantity` `s` on((`g`.`product_id` = `s`.`product_id`)));
