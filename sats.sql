-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2017 at 07:21 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sats`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_table`
--

CREATE TABLE IF NOT EXISTS `account_table` (
  `emp_id` varchar(30) NOT NULL,
  `first_name` varchar(99) NOT NULL,
  `middle_name` varchar(99) DEFAULT NULL,
  `last_name` varchar(99) NOT NULL,
  `department` varchar(99) NOT NULL,
  `password` varchar(300) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_table`
--

INSERT INTO `account_table` (`emp_id`, `first_name`, `middle_name`, `last_name`, `department`, `password`, `status`) VALUES
('CLN00001', 'Carlo', 'Lucas', 'Cuevas', 'Canteen', 'CLN00001', 1),
('CLN00002', 'Redalyn', 'Grampon', 'Crispino', 'Canteen', 'CLN00002', 1),
('CLN00003', 'd', 'b', 'a', 'Canteen', 'CLN00003', 1),
('CLN00004', 'e', 'i', 'x', 'Canteen', 'CLN00004', 1),
('CLN00005', 'f', 'Lucas', 'w', 'Canteen', 'CLN00005', 1),
('CLN00006', 'g', 'k', 'y', 'Canteen', 'CLN00006', 1),
('CLN00007', 'h', 'p', 't', 'Canteen', 'CLN00007', 1),
('CLN00008', 'j', 'o', 's', 'Canteen', 'CLN00008', 1),
('CLN00009', 'k', 'q', 'r', 'Canteen', 'CLN00009', 1),
('CLN00010', '1', '1', '1', 'Canteen', 'CLN00010', 1),
('CLN00011', '2', '2', '2', 'Canteen', 'CLN00011', 1),
('CLN00012', '3', '3', '3', 'Canteen', 'CLN00012', 1),
('CLN00013', '4', '4', '4', 'Canteen', 'CLN00013', 1),
('CLN00014', '5', '5', '5', 'Canteen', 'CLN00014', 1),
('CLN00015', '5', '5', '5', 'Canteen', 'CLN00015', 1),
('CLN00016', '5', '5', '5', 'Canteen', 'CLN00016', 1),
('CLN00017', '5', '5', '5', 'Canteen', 'CLN00017', 1),
('CLN00018', '5', '5', '5', 'Canteen', 'CLN00018', 1),
('CLN00019', '5', '5', '5', 'Canteen', 'CLN00019', 1),
('CLN00020', '5', '5', '5', 'Canteen', 'CLN00020', 1),
('CLN00021', '5', '5', '5', 'Canteen', 'CLN00021', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `emp_id` varchar(30) NOT NULL,
  `first_name` varchar(99) NOT NULL,
  `middle_name` varchar(99) NOT NULL,
  `last_name` varchar(99) NOT NULL,
  `password` varchar(99) NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`emp_id`, `first_name`, `middle_name`, `last_name`, `password`) VALUES
('admin', 'Marife', 'Capalad', 'Ibarra', 'admin'),
('head', 'Marivic', 'Mawanay', 'Baello', 'head');

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

CREATE TABLE IF NOT EXISTS `audit_trail` (
  `action` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `condition_info`
--

CREATE TABLE IF NOT EXISTS `condition_info` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `condition_info` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `condition_info`
--

INSERT INTO `condition_info` (`id`, `condition_info`) VALUES
(1, 'Good'),
(2, 'Poor'),
(3, 'Fair'),
(4, 'Defective'),
(5, 'Scrap');

-- --------------------------------------------------------

--
-- Table structure for table `ctrl_sy`
--

CREATE TABLE IF NOT EXISTS `ctrl_sy` (
  `sy` varchar(4) NOT NULL,
  PRIMARY KEY (`sy`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctrl_sy`
--

INSERT INTO `ctrl_sy` (`sy`) VALUES
('1617');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `location` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `location`) VALUES
(8, 'e'),
(9, 'bbb'),
(10, 'Canteen - Kitchen');

-- --------------------------------------------------------

--
-- Table structure for table `major_category`
--

CREATE TABLE IF NOT EXISTS `major_category` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `description` varchar(999) NOT NULL,
  `depreciate_yr` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `major_category`
--

INSERT INTO `major_category` (`id`, `description`, `depreciate_yr`) VALUES
(7, 'Leasehold Improvements', 5),
(8, 'Office and School Equipment', 5),
(9, 'Office Furnitures & Fixtures', 5),
(10, 'School Furnitures & Fixtures', 5);

-- --------------------------------------------------------

--
-- Table structure for table `minor_category`
--

CREATE TABLE IF NOT EXISTS `minor_category` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `major_id` int(2) NOT NULL,
  `description` varchar(999) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `minor_category`
--

INSERT INTO `minor_category` (`id`, `major_id`, `description`) VALUES
(3, 10, 'Chairs'),
(4, 8, 'Drinking Fountain'),
(5, 8, 'Emergency Light'),
(6, 8, 'Fire Extinguisher'),
(7, 8, 'Gas Stove'),
(8, 10, 'Shelf'),
(9, 10, 'Sink'),
(10, 10, 'Tables'),
(11, 8, 'Trash Bin'),
(12, 9, 'Tables'),
(13, 7, 'Tables');

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE IF NOT EXISTS `property` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pcode` varchar(50) DEFAULT NULL,
  `sno` varchar(50) DEFAULT NULL,
  `description` varchar(999) NOT NULL,
  `brand` varchar(99) DEFAULT NULL,
  `model` varchar(99) DEFAULT NULL,
  `minor_category` int(2) NOT NULL,
  `uom` varchar(20) DEFAULT NULL,
  `cost` double(13,2) NOT NULL,
  `date_acquired` datetime NOT NULL,
  `or_number` varchar(999) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`id`, `pcode`, `sno`, `description`, `brand`, `model`, `minor_category`, `uom`, `cost`, `date_acquired`, `or_number`) VALUES
(1, '008-2013-0812', '123456789', 'Epson Printer', 'Epson', 'Epson', 3, '', 150.00, '2017-01-04 09:25:25', '370124'),
(2, 'Pcode123', '12345789', 'Describing the Item', 'branded item', 'modelling of item', 3, '', 200.00, '1996-10-10 00:00:00', '370123'),
(3, 'Pcode456', '12345789', 'Describing the Item', 'branded item', 'modelling of item', 3, '', 150.00, '1996-10-11 00:00:00', '370124');

-- --------------------------------------------------------

--
-- Table structure for table `property_accountability`
--

CREATE TABLE IF NOT EXISTS `property_accountability` (
  `emp_id` varchar(30) NOT NULL,
  `property_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `condition_id` int(2) NOT NULL,
  `remarks` varchar(999) DEFAULT NULL,
  PRIMARY KEY (`emp_id`,`condition_id`,`property_id`,`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property_accountability`
--

INSERT INTO `property_accountability` (`emp_id`, `property_id`, `qty`, `location_id`, `condition_id`, `remarks`) VALUES
('CLN00005', 1, 1, 10, 1, NULL),
('CLN00005', 2, 1, 10, 2, NULL),
('CLN00005', 3, 1, 10, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_property`
--

CREATE TABLE IF NOT EXISTS `sub_property` (
  `property_id` int(11) NOT NULL,
  `sub_property_id` int(11) NOT NULL,
  PRIMARY KEY (`property_id`,`sub_property_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sub_property_history`
--

CREATE TABLE IF NOT EXISTS `sub_property_history` (
  `property_id` int(11) NOT NULL,
  `sub_property_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_property_accountability`
--

CREATE TABLE IF NOT EXISTS `temp_property_accountability` (
  `pcode` varchar(50) NOT NULL,
  PRIMARY KEY (`pcode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_request`
--

CREATE TABLE IF NOT EXISTS `transfer_request` (
  `request_code` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `condition_id` int(2) NOT NULL,
  `old_loc_id` int(11) NOT NULL,
  `new_loc_id` int(11) NOT NULL,
  `transfer_to` varchar(30) NOT NULL,
  `released_from` varchar(30) NOT NULL,
  `remarks` varchar(300) DEFAULT NULL,
  `date_request` datetime NOT NULL,
  `emp_approval` int(1) NOT NULL,
  PRIMARY KEY (`id`,`condition_id`,`old_loc_id`,`released_from`,`request_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_request_history`
--

CREATE TABLE IF NOT EXISTS `transfer_request_history` (
  `ctrl_no` varchar(30) NOT NULL,
  `sy` varchar(4) NOT NULL,
  `no` int(11) NOT NULL,
  `request_code` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `condition_id` int(2) NOT NULL,
  `old_loc_id` int(11) NOT NULL,
  `new_loc_id` int(11) NOT NULL,
  `transfer_to` varchar(30) NOT NULL,
  `released_from` varchar(30) NOT NULL,
  `remarks` varchar(300) DEFAULT NULL,
  `date_approved` datetime NOT NULL,
  PRIMARY KEY (`id`,`condition_id`,`old_loc_id`,`released_from`,`ctrl_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transfer_request_history`
--

INSERT INTO `transfer_request_history` (`ctrl_no`, `sy`, `no`, `request_code`, `id`, `qty`, `condition_id`, `old_loc_id`, `new_loc_id`, `transfer_to`, `released_from`, `remarks`, `date_approved`) VALUES
('CLN-1617-00001O', '1617', 1, 1, 2, 1, 1, 1, 1, 'CLN00002', 'CLN00001', NULL, '2016-11-25 09:57:30'),
('CLN-1617-00002O', '1617', 2, 1, 2, 1, 1, 1, 1, 'CLN00002', 'CLN00001', NULL, '2016-11-25 10:01:25'),
('CLN-1617-00003O', '1617', 3, 1, 2, 1, 1, 1, 2, 'CLN00002', 'CLN00001', NULL, '2016-11-25 10:46:25'),
('CLN-1617-00004O', '1617', 4, 1, 2, 2, 1, 1, 5, 'CLN00002', 'CLN00001', NULL, '2016-11-25 12:02:18'),
('CLN-1617-00005O', '1617', 5, 1, 2, 2, 1, 1, 5, 'CLN00002', 'CLN00001', NULL, '2016-11-25 12:03:32'),
('CLN-1617-00006O', '1617', 6, 1, 2, 2, 1, 1, 5, 'CLN00002', 'CLN00001', NULL, '2016-11-25 12:06:26'),
('CLN-1617-00007O', '1617', 7, 1, 2, 1, 1, 1, 5, 'CLN00002', 'CLN00001', NULL, '2016-11-25 12:08:13'),
('CLN-1617-00008O', '1617', 8, 1, 2, 2, 1, 1, 2, 'CLN00002', 'CLN00001', NULL, '2016-11-25 12:08:49'),
('CLN-1617-00010O', '1617', 10, 1, 2, 8, 1, 1, 4, 'CLN00002', 'CLN00001', NULL, '2016-11-25 12:12:26'),
('CLN-1617-00009O', '1617', 9, 1, 2, 8, 1, 1, 4, 'CLN00001', 'CLN00002', NULL, '2016-11-25 12:10:25'),
('CLN-1617-00010O', '1617', 10, 1, 2, 3, 1, 2, 4, 'CLN00002', 'CLN00001', NULL, '2016-11-25 12:12:26'),
('CLN-1617-00009O', '1617', 9, 1, 2, 3, 1, 2, 4, 'CLN00001', 'CLN00002', NULL, '2016-11-25 12:10:25'),
('CLN-1617-00011O', '1617', 11, 1, 2, 1, 1, 2, 3, 'CLN00003', 'CLN00002', '', '2016-12-02 11:50:16'),
('CLN-1617-00010O', '1617', 10, 1, 2, 2, 1, 5, 4, 'CLN00002', 'CLN00001', NULL, '2016-11-25 12:12:26'),
('CLN-1617-00009O', '1617', 9, 1, 2, 2, 1, 5, 4, 'CLN00001', 'CLN00002', NULL, '2016-11-25 12:10:25'),
('CLN-1617-00012O', '1617', 12, 2, 2, 1, 3, 2, 1, 'CLN00001', 'CLN00002', '', '2016-12-02 11:50:18');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
