-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2016 at 11:53 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `roughsheet`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_menu`
--

CREATE TABLE IF NOT EXISTS `admin_menu` (
`id` int(11) NOT NULL COMMENT 'Admin menus',
  `name` varchar(255) DEFAULT NULL COMMENT 'menuname',
  `url` text COMMENT 'menu url',
  `icon` varchar(100) DEFAULT NULL COMMENT 'menu icon',
  `parent_id` int(11) DEFAULT NULL COMMENT 'menu parent id',
  `create_date` datetime DEFAULT NULL COMMENT 'create date',
  `created_by` int(11) DEFAULT NULL COMMENT 'created by',
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'time stamp',
  `status` enum('Active','Deactive') DEFAULT NULL COMMENT 'status'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `admin_menu`
--

INSERT INTO `admin_menu` (`id`, `name`, `url`, `icon`, `parent_id`, `create_date`, `created_by`, `modify_date`, `status`) VALUES
(2, 'Settings', 'admin/', 'fa fa-cog', 0, '2016-09-05 04:59:16', 1, '2016-10-06 06:46:48', 'Active'),
(10, 'Users', 'admin/Users', 'fa fa-users', 2, '2016-09-05 05:17:26', 1, '2016-10-06 06:47:56', 'Active'),
(11, 'User Group', 'admin/Groups', 'fa fa-users', 2, '2016-10-07 02:21:57', 1, '2016-10-07 12:34:33', 'Active'),
(12, 'Key Concepts', 'admin/KeyConcepts', 'fa fa-key', 2, '2016-10-08 07:49:53', 1, '2016-10-10 05:02:03', 'Active'),
(13, 'Exercise', 'admin/Exercise', 'fa fa-question-circle', 2, '2016-10-10 07:01:35', 1, '2016-10-10 05:11:39', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_menu`
--
ALTER TABLE `admin_menu`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_menu`
--
ALTER TABLE `admin_menu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Admin menus',AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
