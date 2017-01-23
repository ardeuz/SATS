-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2017 at 10:34 AM
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
('CLN0025A', 'ARISTEO', 'A', 'VILLAFUERTE', 'IT', 'CLN0025A', 1),
('CLN0291A', 'EDWARD DAVE', 'F.', 'MIRAVETE', 'BUILDING ADMIN', 'CLN0291A', 1);

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
-- Table structure for table `borrow_request`
--

CREATE TABLE IF NOT EXISTS `borrow_request` (
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
  `date_borrow` datetime NOT NULL,
  `emp_approval` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `borrow_request_history`
--

CREATE TABLE IF NOT EXISTS `borrow_request_history` (
  `ctrl_no` varchar(30) NOT NULL,
  `sy` varchar(4) NOT NULL,
  `no` int(11) NOT NULL,
  `request_code` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `condition_id` int(11) NOT NULL,
  `old_loc_id` int(11) NOT NULL,
  `new_loc_Id` int(11) NOT NULL,
  `borrowed_to` varchar(30) NOT NULL,
  `released_from` varchar(30) NOT NULL,
  `remarks` varchar(300) NOT NULL,
  `date_approved` datetime NOT NULL,
  `date_returned` datetime NOT NULL,
  PRIMARY KEY (`ctrl_no`,`id`,`condition_id`,`old_loc_id`,`released_from`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrow_request_history`
--

INSERT INTO `borrow_request_history` (`ctrl_no`, `sy`, `no`, `request_code`, `id`, `qty`, `condition_id`, `old_loc_id`, `new_loc_Id`, `borrowed_to`, `released_from`, `remarks`, `date_approved`, `date_returned`) VALUES
('1', '1', 1, 1, 1, 1, 1, 1, 1, 'CLN0025A', 'CLN0291A', '1', '2017-01-26 00:00:00', '2017-01-26 00:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `location`) VALUES
(11, '2ND FLOOR- 201'),
(12, '2ND FLOOR- 202'),
(13, '2NDFLOOR- 203'),
(14, '2ND FLOOR- 204'),
(15, '2ND FLOOR- 207'),
(16, '2ND FLOOR- 208'),
(17, '2ND FLOOR- 209'),
(18, '2ND FLOOR- 211'),
(19, '2ND FLOOR- 212');

-- --------------------------------------------------------

--
-- Table structure for table `major_category`
--

CREATE TABLE IF NOT EXISTS `major_category` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `description` varchar(999) NOT NULL,
  `depreciate_yr` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `major_category`
--

INSERT INTO `major_category` (`id`, `description`, `depreciate_yr`) VALUES
(11, 'SCHOOL & OFFICE EQUIPMENT', 5),
(12, 'aa', 3);

-- --------------------------------------------------------

--
-- Table structure for table `minor_category`
--

CREATE TABLE IF NOT EXISTS `minor_category` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `major_id` int(2) NOT NULL,
  `description` varchar(999) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `minor_category`
--

INSERT INTO `minor_category` (`id`, `major_id`, `description`) VALUES
(14, 11, 'PROJECTOR'),
(15, 11, 'AIRCON');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`id`, `pcode`, `sno`, `description`, `brand`, `model`, `minor_category`, `uom`, `cost`, `date_acquired`, `or_number`) VALUES
(5, 'CLNOSE342014-013', 'BO42CJAF08-05', 'LED PROJECTOR CASIO XJ-A240', '', '', 14, 'PC/S', 40000.00, '2017-01-19 13:59:41', '4010000000493'),
(6, 'CLNOSE342014-001', 'B042CJAF08-057241', 'LED Projector CASIO XJ-A240', '', '', 14, 'PC/S', 40000.00, '2017-01-19 14:23:27', '4010000000493'),
(7, 'CLNOSE14-2014-003', '8275930000018', 'FCU - Ceiling Cassette (3.0TR)Gree Model#FP-180XD/B-T', '', '', 15, 'PC/S', 566.40, '2017-01-19 14:26:26', '4010000000283'),
(8, 'CLNOSE342014-014', 'B042CJAF08-063596', 'LED Projector CASIO XJ-A240', '', '', 14, 'PC/S', 40000.00, '2017-01-19 14:29:14', '4010000000493'),
(9, 'CLNOSE342014-023', 'B042CJAF08-063732', 'LED Projector CASIO XJ-A240', '', '', 14, 'PC/S', 40000.00, '2017-01-19 14:34:06', '4010000000493'),
(10, 'CLNOSE342014-040', 'B042CJAF08-064058', 'LED Projector CASIO XJ-A240', '', '', 14, 'PC/S', 40000.00, '2017-01-19 14:37:38', '4010000000493'),
(11, 'CLNOSE342014-006', 'B042CJAF08-057432', 'LED Projector CASIO XJ-A240', '', '', 14, 'PC/S', 40000.00, '2017-01-19 14:41:13', '4010000000493'),
(12, 'CLNOSE342014-021', 'B042CJAF08-063710', 'LED Projector CASIO XJ-A240', '', '', 14, 'PC/S', 40000.00, '2017-01-19 14:47:29', '4010000000493'),
(13, 'CLNOSE342014-028', 'B042CJAF08-063844', 'LED Projector CASIO XJ-A240', '', '', 14, 'PC/S', 40000.00, '2017-01-19 14:49:47', '4010000000493'),
(14, 'CLNOSE342014-002', 'B042CJAF08-057308', 'LED Projector CASIO XJ-A240', '', '', 14, 'PC/S', 40000.00, '2017-01-19 14:51:23', '4010000000493');

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
('CLN0025A', 5, 1, 11, 1, NULL),
('CLN0025A', 6, 1, 12, 1, NULL),
('CLN0025A', 7, 1, 11, 1, NULL),
('CLN0025A', 8, 1, 13, 1, NULL),
('CLN0025A', 9, 1, 14, 1, NULL),
('CLN0025A', 10, 1, 15, 1, NULL),
('CLN0025A', 11, 1, 16, 1, NULL),
('CLN0025A', 12, 1, 17, 1, NULL),
('CLN0025A', 13, 1, 18, 1, NULL),
('CLN0291A', 14, 1, 11, 1, NULL);

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

--
-- Dumping data for table `temp_property_accountability`
--

INSERT INTO `temp_property_accountability` (`pcode`) VALUES
('CLNOSE14-2014-003'),
('CLNOSE342014-001'),
('CLNOSE342014-013');

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
