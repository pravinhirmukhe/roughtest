-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2016 at 01:14 PM
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
  `twelth_percentage` float NOT NULL,
  `tenth_percentage` float NOT NULL,
  `cost_to_company` int(11) NOT NULL,
  `bond` tinyint(4) NOT NULL,
  `bond_lengh` text NOT NULL,
  `bond_value` int(11) NOT NULL,
  `expected_doj` date NOT NULL,
  `no_recruitment_round` varchar(1000) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `rs_job`
--

INSERT INTO `rs_job` (`id`, `title`, `location`, `work_description`, `graduation_year`, `graduation_branch`, `college_CGPA`, `twelth_percentage`, `tenth_percentage`, `cost_to_company`, `bond`, `bond_lengh`, `bond_value`, `expected_doj`, `no_recruitment_round`, `active`, `created_by`, `create_date`) VALUES
(4, 'Software Developer', 'pune', '<p>Software Development in PHP</p>', 2011, 'cs, entc, mech', '5', 70, 60, 5000, 1, '6Month', 1000, '2016-10-20', '<p>Round 1:</p>\r\n<p>Written Test</p>\r\n<p>Round 2:&nbsp;</p>\r\n<p>Technical + HR</p>', 1, 8, '2016-10-14 11:58:00'),
(5, 'Software Tester', 'pune', '<p>software testing for .net ,php projects</p>', 2010, 'cs', '4', 70, 70, 4000, 1, '6Month', 1000, '2016-10-25', '<p>Round 1 :</p>\r\n<p>Technocal Test</p>\r\n<p>Round 2:</p>\r\n<p>Machine Test</p>\r\n<p>Round 3:</p>\r\n<p>Technical + HR Interview</p>', 1, 8, '2016-10-15 07:39:14'),
(7, 'Application Manager', 'pune', '<p>Application Manager</p>', 2010, 'entc', '4', 65, 75, 2000, 0, '', 0, '2016-10-25', '<p>Round 1:</p>\r\n<p>Technical + HR Interview</p>', 1, 9, '2016-10-15 07:46:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rs_job`
--
ALTER TABLE `rs_job`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rs_job`
--
ALTER TABLE `rs_job`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
