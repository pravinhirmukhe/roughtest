-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2016 at 02:28 PM
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
-- Table structure for table `group_alloc`
--

DROP TABLE IF EXISTS `group_alloc`;
CREATE TABLE IF NOT EXISTS `group_alloc` (
`id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `menu_ids` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `modify_by` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Active','Deactive') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `group_alloc`
--

INSERT INTO `group_alloc` (`id`, `group_id`, `menu_ids`, `created_by`, `modify_by`, `create_date`, `modify_date`, `status`) VALUES
(1, 2, '{"0":"Company:16","2":"Job:17"}', 1, 1, '2016-10-14 01:22:12', '2016-10-13 19:52:12', 'Active'),
(2, 1, '["Track Users:14",null,"Settings:2",null,"Company:16",null,"Job:17",null]', 0, 0, '0000-00-00 00:00:00', '2016-10-14 11:20:16', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `rs_job`
--

DROP TABLE IF EXISTS `rs_job`;
CREATE TABLE IF NOT EXISTS `rs_job` (
`id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `location` text NOT NULL,
  `work_description` varchar(1000) NOT NULL,
  `graduation_year` int(11) NOT NULL,
  `graduation_branch` text NOT NULL,
  `college_CGPA` varchar(50) NOT NULL,
  `12th` float NOT NULL,
  `10th` float NOT NULL,
  `cost_to_company` int(11) NOT NULL,
  `bond` tinyint(4) NOT NULL,
  `bond_lengh` text NOT NULL,
  `bond_value` int(11) NOT NULL,
  `expected_doj` date NOT NULL,
  `no_recruitment_round` varchar(1000) NOT NULL,
  `active` enum('Active','Deactive') NOT NULL,
  `created_by` int(11) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `rs_job`
--

INSERT INTO `rs_job` (`id`, `title`, `location`, `work_description`, `graduation_year`, `graduation_branch`, `college_CGPA`, `12th`, `10th`, `cost_to_company`, `bond`, `bond_lengh`, `bond_value`, `expected_doj`, `no_recruitment_round`, `active`, `created_by`, `create_date`) VALUES
(1, 'dfsdfdsf', 'pune', '<p>sdfdsf dfsdfdsf</p>', 2010, 'mech', 'sdcdcdsc', 88, 77, 444, 1, '6Month', 5555, '2016-10-22', '<p>hgjjyuy</p>', 'Active', 8, '2016-10-14 11:37:19'),
(2, 'fghfhfg', 'mumbai', '<p>ghfgh fghfghf</p>', 2010, 'cs, entc, mech', '5', 67, 77, 5000, 1, '1year', 10000, '2016-10-28', '', 'Active', 8, '2016-10-14 11:52:27'),
(3, 'dgdfgdf', 'pune', '<p>ghfdghfhf</p>', 2010, 'entc, mech', '3', 70, 60, 50000, 1, '1year', 10000, '2016-10-20', '', 'Active', 8, '2016-10-14 11:55:55'),
(4, 'Software Developer', 'pune', '<p>Software Development in PHP</p>', 2011, 'cs, entc', '5', 70, 60, 5000, 0, '', 0, '2016-10-20', '<p>Round 1:</p><p>Written Test</p><p>Round 2:&nbsp;</p><p>Technical + HR</p>', 'Active', 8, '2016-10-14 11:58:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `group_alloc`
--
ALTER TABLE `group_alloc`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rs_job`
--
ALTER TABLE `rs_job`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `group_alloc`
--
ALTER TABLE `group_alloc`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rs_job`
--
ALTER TABLE `rs_job`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
