-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2015 at 11:49 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eps`
--

-- --------------------------------------------------------

--
-- Table structure for table `bonus`
--

CREATE TABLE IF NOT EXISTS `bonus` (
`bonusid` int(10) NOT NULL,
  `empid` int(10) NOT NULL,
  `datebonus` date NOT NULL DEFAULT '0000-00-00',
  `bonuspayment` varchar(200) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bonus`
--

INSERT INTO `bonus` (`bonusid`, `empid`, `datebonus`, `bonuspayment`, `note`) VALUES
(1, 9, '2015-04-11', '200', ''),
(2, 9, '2015-04-11', '200', ''),
(3, 9, '2015-04-11', '200', '');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`id` int(11) NOT NULL,
  `deptid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `categorydesc` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `deptid`, `name`, `categorydesc`) VALUES
(1, 2, 'Bugdets', 'Controls measures for spending.'),
(2, 0, 'Registration', 'Register employee');

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE IF NOT EXISTS `deductions` (
`deducid` int(10) NOT NULL,
  `empid` int(10) NOT NULL,
  `deductype` varchar(200) NOT NULL,
  `deductdate` date NOT NULL,
  `amount` varchar(200) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `deductions`
--

INSERT INTO `deductions` (`deducid`, `empid`, `deductype`, `deductdate`, `amount`, `note`) VALUES
(1, 9, 'Lateness', '2015-04-09', '100', ''),
(2, 9, 'Lateness', '2015-04-09', '100', ''),
(3, 3, '2015-10-15', '2015-04-09', '100', ''),
(4, 5, '0', '2015-04-09', '100', ''),
(5, 5, '0', '2015-04-09', '100', '');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
`deptid` int(10) NOT NULL,
  `managerid` int(10) NOT NULL,
  `deptparentid` int(10) NOT NULL,
  `deptname` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `deptdesc` text NOT NULL,
  `mandaworkdesc` varchar(255) NOT NULL,
  `messaging` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`deptid`, `managerid`, `deptparentid`, `deptname`, `location`, `deptdesc`, `mandaworkdesc`, `messaging`) VALUES
(1, 0, -1, 'Root Department', '', 'This is the head department', 'y', 'y'),
(2, 0, 1, 'Accounts', 'Head Office', '                                                                                                                                ', 'y', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `deptevents`
--

CREATE TABLE IF NOT EXISTS `deptevents` (
`eventid` int(10) NOT NULL,
  `deptid` int(10) NOT NULL,
  `eventdate` date NOT NULL DEFAULT '0000-00-00',
  `eventtime` varchar(50) NOT NULL,
  `eventbody` text NOT NULL,
  `postedby` varchar(255) NOT NULL,
  `dateposted` date NOT NULL DEFAULT '0000-00-00',
  `expirydate` date NOT NULL DEFAULT '0000-00-00',
  `active` varchar(10) NOT NULL DEFAULT 'y'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `deptevents`
--

INSERT INTO `deptevents` (`eventid`, `deptid`, `eventdate`, `eventtime`, `eventbody`, `postedby`, `dateposted`, `expirydate`, `active`) VALUES
(1, 1, '1999-05-07', '11:22', 'Party at admin bldg', '0', '2015-04-07', '1999-05-07', 'y'),
(2, 1, '1999-05-07', '11:22', 'Party at admin bldg', '0', '2015-04-07', '1999-05-07', 'y'),
(3, 1, '1999-05-07', '11:22', 'Party at admin bldg', '0', '2015-04-07', '1999-05-07', 'y'),
(4, 1, '1999-05-07', '11:22', 'Party at admin bldg', '0', '2015-04-07', '1999-05-07', 'y'),
(5, 1, '1999-05-07', '11:22', 'Party at admin bldg', '0', '2015-04-07', '1999-05-07', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `empcategory`
--

CREATE TABLE IF NOT EXISTS `empcategory` (
`catid` int(10) NOT NULL,
  `catname` varchar(255) NOT NULL,
  `catdesc` text NOT NULL,
  `miscnote` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `empcategory`
--

INSERT INTO `empcategory` (`catid`, `catname`, `catdesc`, `miscnote`) VALUES
(1, 'Full Time', 'Full Time Worker', ''),
(2, 'Intern', 'Intern', ''),
(3, 'Part Time', 'Part Time', '');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
`empid` int(10) NOT NULL,
  `deptid` int(10) NOT NULL,
  `jobid` int(10) NOT NULL,
  `parentid` int(10) NOT NULL,
  `typeid` varchar(50) NOT NULL,
  `catid` varchar(50) NOT NULL,
  `salutation` varchar(50) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `minit` varchar(15) NOT NULL,
  `ssn` varchar(50) NOT NULL,
  `dob` date NOT NULL DEFAULT '0000-00-00',
  `gender` varchar(15) NOT NULL,
  `race` varchar(50) NOT NULL,
  `marital` varchar(50) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(150) NOT NULL,
  `zipcode` varchar(100) NOT NULL,
  `country` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `webpage` varchar(255) NOT NULL,
  `homephone` varchar(100) NOT NULL,
  `officephone` varchar(100) NOT NULL,
  `cellphone` varchar(100) NOT NULL,
  `regularhours` varchar(50) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin` varchar(5) NOT NULL,
  `superadmin` varchar(5) NOT NULL,
  `numlogins` int(10) NOT NULL,
  `datesignup` date NOT NULL DEFAULT '0000-00-00',
  `ipsignup` varchar(100) NOT NULL,
  `lastlogindate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `loginip` varchar(100) NOT NULL,
  `dateupdated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ipupdated` varchar(100) NOT NULL,
  `lastproject` int(10) NOT NULL,
  `active` varchar(50) NOT NULL DEFAULT 'n'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`empid`, `deptid`, `jobid`, `parentid`, `typeid`, `catid`, `salutation`, `lastname`, `firstname`, `minit`, `ssn`, `dob`, `gender`, `race`, `marital`, `address1`, `address2`, `city`, `state`, `zipcode`, `country`, `email`, `webpage`, `homephone`, `officephone`, `cellphone`, `regularhours`, `login`, `password`, `admin`, `superadmin`, `numlogins`, `datesignup`, `ipsignup`, `lastlogindate`, `loginip`, `dateupdated`, `ipupdated`, `lastproject`, `active`) VALUES
(1, 1, 0, 0, '', '', '', 'Administrator', 'Administrator', '', '', '0000-00-00', '', 'other', 'single', '', '', '', '', '', '', 'admin@emailgpl.com', '', '', '', '', '', 'admin', 'eps', '1', '1', 11, '0000-00-00', '', '2015-02-22 16:41:56', '::1', '0000-00-00 00:00:00', '', 0, 'y'),
(2, 1, 1, 1, '1', '3', 'Mr', 'GPL', 'Man', '', '999999999', '2001-12-01', 'm', 'oh', 'Single', 'Open Source Road,', '', 'GPL City', 'MS', '', '99999', 'gplman@email.com', '', '999-999-9999', '', '', '40', 'test', 'test', '0', '0', 10, '0000-00-00', '130.74.170.100', '2015-02-22 16:36:59', '::1', '2001-12-03 22:48:32', '130.74.170.100', 1, 'y'),
(3, 1, 1, 0, '1', '1', 'Mr', 'Shade', 'Ortiz', 'Gingley', '100001', '1988-10-12', 'on', 'black', 'single', '13 Fakunle Oyebamiji', '', 'ijoko', 'Ogun', '23401', 'nigeria', 'ortiz.gingley@yahoo.com', '  ', '888-888-888', '0', '', '32', '', '', '', '', 0, '0000-00-00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0, 'n'),
(5, 1, 1, 0, '1', '1', 'Mr', 'Shade', 'Ortiz', 'Gingley', '1111112', '1988-10-12', 'on', 'black', 'single', '13 Fakunle Oyebamiji', '', 'ijoko', 'Ogun', '23401', 'nigeria', 'info@blaizmall.com', '   ', '888-888-888', '0', '', '32', '', '', '', '', 0, '0000-00-00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0, 'n'),
(6, 1, 1, 0, '1', '1', 'Mr', 'Shade', 'Ortiz', 'Gingley', '1111113', '1988-10-12', 'on', 'black', 'single', '13 Fakunle Oyebamiji', '', 'ijoko', 'Ogun', '23401', 'nigeria', 'info@blaizmall.com', '   ', '888-888-888', '0', '', '32', '', '', '', '', 0, '0000-00-00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0, 'n'),
(7, 1, 1, 0, '1', '1', 'Mr', 'Shade', 'Ortiz', 'Gingley', '1111114', '1988-10-12', 'on', 'black', 'single', '13 Fakunle Oyebamiji', '', 'ijoko', 'Ogun', '23401', 'nigeria', 'info@blaizmall.com', '   ', '888-888-888', '0', '', '32', '', '', '', '', 0, '0000-00-00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0, 'n'),
(8, 1, 1, 0, '1', '1', 'Mr', 'Shade', 'Ortiz', 'Gingley', '1111115', '1988-10-12', 'on', 'black', 'single', '13 Fakunle Oyebamiji', '', 'ijoko', 'Ogun', '23401', 'nigeria', 'info@blaizmall.com', '   ', '888-888-888', '0', '', '32', '', '', '', '', 0, '0000-00-00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0, 'n'),
(9, 1, 1, 0, '1', '1', 'Mr', 'Shade', 'Ortiz', 'Gingley', '1111117', '1988-10-12', 'on', 'black', 'single', '13 Fakunle Oyebamiji', '', 'ijoko', 'Ogun', '23401', 'nigeria', 'info@blaizmall.com', '   ', '888-888-888', '0', '', '32', '', '', '', '', 0, '0000-00-00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0, 'n'),
(10, 1, 1, 0, '1', '1', 'Mr', 'Shade', 'Ortiz', 'Gingley', '1111118', '1988-10-12', 'on', 'black', 'single', '13 Fakunle Oyebamiji', '', 'ijoko', 'Ogun', '23401', 'nigeria', 'info@blaizmall.com', '   ', '888-888-888', '0', '', '32', '', '', '', '', 0, '0000-00-00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0, 'n'),
(11, 1, 1, 0, '1', '1', 'Mr', 'Shade', 'Ortiz', 'Gingley', '1111119', '1988-10-12', 'on', 'black', 'single', '13 Fakunle Oyebamiji', '', 'ijoko', 'Ogun', '23401', 'nigeria', 'info@blaizmall.com', '   ', '888-888-888', '0', '', '32', '', '', '', '', 0, '0000-00-00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0, 'n');

-- --------------------------------------------------------

--
-- Table structure for table `employeetype`
--

CREATE TABLE IF NOT EXISTS `employeetype` (
`typeid` int(10) NOT NULL,
  `typename` varchar(255) NOT NULL,
  `typedesc` text NOT NULL,
  `miscnote` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `employeetype`
--

INSERT INTO `employeetype` (`typeid`, `typename`, `typedesc`, `miscnote`) VALUES
(1, 'Hourly', 'Hourly Worker, gets paid by the hour', ''),
(2, 'Salary', 'Salary Worker, gets paid on basis of yearly base salary\r\n', ''),
(3, 'Contract', 'Contract Worker, gets paid on contract to contract basis', '');

-- --------------------------------------------------------

--
-- Table structure for table `emppicture`
--

CREATE TABLE IF NOT EXISTS `emppicture` (
`picid` int(10) NOT NULL,
  `link` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `emppicture`
--

INSERT INTO `emppicture` (`picid`, `link`) VALUES
(2, '2.png'),
(3, '.jpg'),
(4, '.jpg'),
(5, '.jpg'),
(6, '.jpg'),
(7, '.jpg'),
(8, '.jpg'),
(9, '.jpg'),
(10, '10.jpg'),
(11, '11.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE IF NOT EXISTS `holidays` (
`holid` int(10) NOT NULL,
  `empid` int(10) NOT NULL,
  `datehols` date NOT NULL DEFAULT '0000-00-00',
  `payment` varchar(200) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`holid`, `empid`, `datehols`, `payment`, `note`) VALUES
(1, 5, '2015-10-11', '100', '');

-- --------------------------------------------------------

--
-- Table structure for table `hourly`
--

CREATE TABLE IF NOT EXISTS `hourly` (
`hourid` int(10) NOT NULL,
  `empid` int(10) NOT NULL,
  `hourlyrate` varchar(100) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `hourly`
--

INSERT INTO `hourly` (`hourid`, `empid`, `hourlyrate`, `note`) VALUES
(1, 0, '15000', ''),
(2, 0, '15000', ''),
(3, 0, '15000', ''),
(4, 0, '15000', ''),
(5, 0, '15000', ''),
(6, 0, '15000', ''),
(7, 0, '15000', ''),
(8, 10, '15000', ''),
(9, 11, '15000', '');

-- --------------------------------------------------------

--
-- Table structure for table `iptable`
--

CREATE TABLE IF NOT EXISTS `iptable` (
`ipid` int(10) NOT NULL,
  `type` varchar(50) NOT NULL,
  `linkid` int(10) NOT NULL,
  `ipaddress` varchar(255) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `iptable`
--

INSERT INTO `iptable` (`ipid`, `type`, `linkid`, `ipaddress`, `note`) VALUES
(1, '', 0, '140.121.036.100', '');

-- --------------------------------------------------------

--
-- Table structure for table `jobtitle`
--

CREATE TABLE IF NOT EXISTS `jobtitle` (
`jobid` int(10) NOT NULL,
  `jobtitle` varchar(255) NOT NULL,
  `jobdesc` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jobtitle`
--

INSERT INTO `jobtitle` (`jobid`, `jobtitle`, `jobdesc`) VALUES
(1, 'Default Job', 'This is the default job. Delete this job and add real jobs.');

-- --------------------------------------------------------

--
-- Table structure for table `locks`
--

CREATE TABLE IF NOT EXISTS `locks` (
`lockid` int(10) NOT NULL,
  `empid` int(10) NOT NULL,
  `datelock` date NOT NULL DEFAULT '0000-00-00',
  `reasonlock` varchar(255) NOT NULL,
  `lockedby` varchar(255) NOT NULL,
  `active` varchar(5) NOT NULL DEFAULT 'y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
`lmid` int(10) NOT NULL,
  `empid` int(10) NOT NULL,
  `message` text NOT NULL,
  `postedby` varchar(255) NOT NULL,
  `dateposted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `numviews` int(10) NOT NULL,
  `active` varchar(10) NOT NULL DEFAULT 'y'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`lmid`, `empid`, `message`, `postedby`, `dateposted`, `numviews`, `active`) VALUES
(1, 2, 'Welcome', 'Administrator', '2015-02-01 20:01:24', 4, 'y');

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE IF NOT EXISTS `payroll` (
`payrollid` int(10) NOT NULL,
  `empid` int(10) NOT NULL,
  `payrolldate` date NOT NULL DEFAULT '0000-00-00',
  `startdate` date NOT NULL DEFAULT '0000-00-00',
  `enddate` date NOT NULL DEFAULT '0000-00-00',
  `hoursworked` varchar(200) NOT NULL,
  `grosspay` varchar(200) NOT NULL,
  `deductions` varchar(200) NOT NULL,
  `additions` varchar(200) NOT NULL,
  `netpay` varchar(200) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`payrollid`, `empid`, `payrolldate`, `startdate`, `enddate`, `hoursworked`, `grosspay`, `deductions`, `additions`, `netpay`) VALUES
(26, 5, '2015-04-08', '2015-01-11', '2015-04-08', '0', '0', '0', '0', '0'),
(27, 6, '2015-04-08', '2015-01-11', '2015-04-08', '0', '0', '0', '0', '0'),
(28, 7, '2015-04-08', '2015-01-11', '2015-04-08', '0', '0', '0', '0', '0'),
(29, 8, '2015-04-08', '2015-01-11', '2015-04-08', '0', '0', '0', '0', '0'),
(30, 9, '2015-04-08', '2015-01-11', '2015-04-08', '0', '0', '0', '0', '0'),
(31, 10, '2015-04-08', '2015-01-11', '2015-04-08', '0', '0', '0', '0', '0'),
(32, 11, '2015-04-08', '2015-01-11', '2015-04-08', '0', '0', '0', '0', '0'),
(33, 2, '2015-04-08', '2015-01-11', '2015-04-08', '0', '0', '0', '0', '0'),
(34, 3, '2015-04-08', '2015-01-11', '2015-04-08', '0', '0', '0', '0', '0'),
(35, 5, '2015-04-08', '2015-01-11', '2015-04-08', '0', '0', '0', '0', '0'),
(36, 6, '2015-04-08', '2015-01-11', '2015-04-08', '0', '0', '0', '0', '0'),
(37, 7, '2015-04-08', '2015-01-11', '2015-04-08', '0', '0', '0', '0', '0'),
(38, 8, '2015-04-08', '2015-01-11', '2015-04-08', '0', '0', '0', '0', '0'),
(39, 9, '2015-04-08', '2015-01-11', '2015-04-08', '0', '0', '0', '0', '0'),
(40, 10, '2015-04-08', '2015-01-11', '2015-04-08', '0', '0', '0', '0', '0'),
(41, 11, '2015-04-08', '2015-01-11', '2015-04-08', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
`projectid` int(10) NOT NULL,
  `deptid` int(10) NOT NULL,
  `catid` int(10) NOT NULL,
  `projecttitle` varchar(255) NOT NULL,
  `projectdesc` text NOT NULL,
  `dateposted` datetime NOT NULL,
  `hoursworked` double(16,4) NOT NULL DEFAULT '0.0000',
  `active` varchar(5) NOT NULL DEFAULT 'y'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`projectid`, `deptid`, `catid`, `projecttitle`, `projectdesc`, `dateposted`, `hoursworked`, `active`) VALUES
(1, 1, 0, 'Default Project for Root Dept', 'This is a default project. Please delete this project and add real projects.', '0000-00-00 00:00:00', 0.0000, 'y'),
(2, 2, 0, 'Budget Analysis', 'Budget computation for January 2015', '2015-02-01 12:18:36', 0.0000, 'y'),
(3, 1, 0, 'Data rollback', 'data rollback', '2015-07-07 09:50:52', 0.0000, 'y');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE IF NOT EXISTS `salary` (
`salaryid` int(10) NOT NULL,
  `empid` int(10) NOT NULL,
  `salaryrate` int(11) NOT NULL COMMENT 'Yearly salary rate',
  `baseyear` varchar(100) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`salaryid`, `empid`, `salaryrate`, `baseyear`, `note`) VALUES
(1, 2, 91000, '2015', ''),
(2, 2, 91000, '2015', '');

-- --------------------------------------------------------

--
-- Table structure for table `sickday`
--

CREATE TABLE IF NOT EXISTS `sickday` (
`sickid` int(10) NOT NULL,
  `empid` int(10) NOT NULL,
  `datesick` date NOT NULL DEFAULT '0000-00-00',
  `payment` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sickday`
--

INSERT INTO `sickday` (`sickid`, `empid`, `datesick`, `payment`, `note`) VALUES
(1, 5, '2015-11-01', '100', 'Malaria treatment');

-- --------------------------------------------------------

--
-- Table structure for table `timesheet`
--

CREATE TABLE IF NOT EXISTS `timesheet` (
`timeid` int(10) NOT NULL,
  `empid` int(10) NOT NULL,
  `projectid` int(10) NOT NULL,
  `checkin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `checkout` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `rawtime` varchar(100) NOT NULL,
  `roundedtime` varchar(100) NOT NULL,
  `workdesc` text NOT NULL,
  `ipcheckin` varchar(100) NOT NULL,
  `ipcheckout` varchar(100) NOT NULL,
  `checked` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `timesheet`
--

INSERT INTO `timesheet` (`timeid`, `empid`, `projectid`, `checkin`, `checkout`, `rawtime`, `roundedtime`, `workdesc`, `ipcheckin`, `ipcheckout`, `checked`) VALUES
(13, 2, 1, '2015-02-22 22:57:26', '2015-02-24 07:16:01', '', '', '', '::1', '::1', 'y'),
(14, 2, 0, '2015-02-22 23:14:48', '0000-00-00 00:00:00', '', '', '', '::1', '', 'n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bonus`
--
ALTER TABLE `bonus`
 ADD PRIMARY KEY (`bonusid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
 ADD PRIMARY KEY (`deducid`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
 ADD PRIMARY KEY (`deptid`);

--
-- Indexes for table `deptevents`
--
ALTER TABLE `deptevents`
 ADD PRIMARY KEY (`eventid`);

--
-- Indexes for table `empcategory`
--
ALTER TABLE `empcategory`
 ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
 ADD PRIMARY KEY (`empid`);

--
-- Indexes for table `employeetype`
--
ALTER TABLE `employeetype`
 ADD PRIMARY KEY (`typeid`);

--
-- Indexes for table `emppicture`
--
ALTER TABLE `emppicture`
 ADD PRIMARY KEY (`picid`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
 ADD PRIMARY KEY (`holid`);

--
-- Indexes for table `hourly`
--
ALTER TABLE `hourly`
 ADD PRIMARY KEY (`hourid`);

--
-- Indexes for table `iptable`
--
ALTER TABLE `iptable`
 ADD PRIMARY KEY (`ipid`);

--
-- Indexes for table `jobtitle`
--
ALTER TABLE `jobtitle`
 ADD PRIMARY KEY (`jobid`);

--
-- Indexes for table `locks`
--
ALTER TABLE `locks`
 ADD PRIMARY KEY (`lockid`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`lmid`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
 ADD PRIMARY KEY (`payrollid`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
 ADD PRIMARY KEY (`projectid`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
 ADD PRIMARY KEY (`salaryid`);

--
-- Indexes for table `sickday`
--
ALTER TABLE `sickday`
 ADD PRIMARY KEY (`sickid`);

--
-- Indexes for table `timesheet`
--
ALTER TABLE `timesheet`
 ADD PRIMARY KEY (`timeid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bonus`
--
ALTER TABLE `bonus`
MODIFY `bonusid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
MODIFY `deducid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
MODIFY `deptid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `deptevents`
--
ALTER TABLE `deptevents`
MODIFY `eventid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `empcategory`
--
ALTER TABLE `empcategory`
MODIFY `catid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
MODIFY `empid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `employeetype`
--
ALTER TABLE `employeetype`
MODIFY `typeid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `emppicture`
--
ALTER TABLE `emppicture`
MODIFY `picid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
MODIFY `holid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hourly`
--
ALTER TABLE `hourly`
MODIFY `hourid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `iptable`
--
ALTER TABLE `iptable`
MODIFY `ipid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `jobtitle`
--
ALTER TABLE `jobtitle`
MODIFY `jobid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `locks`
--
ALTER TABLE `locks`
MODIFY `lockid` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
MODIFY `lmid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
MODIFY `payrollid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
MODIFY `projectid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
MODIFY `salaryid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sickday`
--
ALTER TABLE `sickday`
MODIFY `sickid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `timesheet`
--
ALTER TABLE `timesheet`
MODIFY `timeid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
