/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50626
Source Host           : localhost:3306
Source Database       : sats

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2016-11-15 06:59:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `account_table`
-- ----------------------------
DROP TABLE IF EXISTS `account_table`;
CREATE TABLE `account_table` (
  `emp_id` varchar(200) NOT NULL,
  `first_name` varchar(99) NOT NULL,
  `middle_name` varchar(99) NOT NULL,
  `last_name` varchar(99) NOT NULL,
  `account_hold` varchar(99) NOT NULL,
  `username` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of account_table
-- ----------------------------
INSERT INTO `account_table` VALUES ('CLN00010', 'Carlo', 'Lucas', 'Cuevas', 'Faculty', 'Admin', 'Admin');

-- ----------------------------
-- Table structure for `major_category`
-- ----------------------------
DROP TABLE IF EXISTS `major_category`;
CREATE TABLE `major_category` (
  `major_category` int(2) NOT NULL AUTO_INCREMENT,
  `description` varchar(999) NOT NULL,
  `depreciate_yr` date NOT NULL,
  PRIMARY KEY (`major_category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of major_category
-- ----------------------------

-- ----------------------------
-- Table structure for `minor_category`
-- ----------------------------
DROP TABLE IF EXISTS `minor_category`;
CREATE TABLE `minor_category` (
  `id` int(2) NOT NULL,
  `major_id` int(2) NOT NULL,
  `description` varchar(999) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of minor_category
-- ----------------------------

-- ----------------------------
-- Table structure for `property_table`
-- ----------------------------
DROP TABLE IF EXISTS `property_table`;
CREATE TABLE `property_table` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `pcode` varchar(50) NOT NULL,
  `sno` varchar(50) NOT NULL,
  `description` varchar(999) NOT NULL,
  `brand` varchar(99) NOT NULL,
  `model` varchar(99) NOT NULL,
  `minor_category` int(2) NOT NULL,
  `quantity` int(10) NOT NULL,
  `uom` varchar(10) NOT NULL,
  `cost` double(13,2) NOT NULL,
  `location` int(2) NOT NULL,
  `note` varchar(999) NOT NULL,
  `account_holder` int(2) NOT NULL,
  `condition` int(2) NOT NULL,
  `date_acquiared` datetime NOT NULL,
  `or_number` varchar(999) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of property_table
-- ----------------------------
