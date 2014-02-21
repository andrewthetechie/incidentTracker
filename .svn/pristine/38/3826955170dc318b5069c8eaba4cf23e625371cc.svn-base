-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 14, 2013 at 03:01 PM
-- Server version: 5.1.66-cll
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `incident_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_guests`
--

CREATE TABLE IF NOT EXISTS `active_guests` (
  `ip` varchar(15) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `active_users`
--

CREATE TABLE IF NOT EXISTS `active_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `active_users`
--

INSERT INTO `active_users` (`username`, `timestamp`) VALUES
('andrew', 1335304236);

-- --------------------------------------------------------

--
-- Table structure for table `banned_users`
--

CREATE TABLE IF NOT EXISTS `banned_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyName` varchar(256) NOT NULL,
  `clientName` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `reportsID` int(11) NOT NULL,
  `plan` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `companyName`, `clientName`, `email`, `reportsID`, `plan`) VALUES
(7, 'Spahn Law Firm', 'Lori Spahn', 'lori@spahnlawfirm.com', 1773, 2),
(8, 'Finsanto', 'Jenna Haden', 'jenna@finsanto.com', 998, 2),
(9, 'Rey Diaz Law', 'Rey Diaz', 'Rey@reydiazlaw.com', 348, 2);

-- --------------------------------------------------------

--
-- Table structure for table `computers`
--

CREATE TABLE IF NOT EXISTS `computers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clientID` int(11) NOT NULL,
  `computerName` text NOT NULL,
  `os` text NOT NULL,
  `osArch` text NOT NULL,
  `installDate` date NOT NULL,
  `mfg` text NOT NULL,
  `serial` text NOT NULL,
  `systemDrive` text NOT NULL,
  `osDirectory` text NOT NULL,
  `numOfUsers` text NOT NULL,
  `moboMfg` text,
  `moboModel` text,
  `biosMFG` text,
  `biosVer` text,
  `memory` int(11) NOT NULL,
  `cpu` text NOT NULL,
  `cpuSpeed` int(11) NOT NULL,
  `totalDisk` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `computerStats`
--

CREATE TABLE IF NOT EXISTS `computerStats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `computerID` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `diskUse` int(11) NOT NULL,
  `memoryUse` int(11) NOT NULL,
  `numberOfProcesses` int(11) NOT NULL,
  `lastReboot` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=128 ;

-- --------------------------------------------------------

--
-- Table structure for table `incidents`
--

CREATE TABLE IF NOT EXISTS `incidents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` int(11) NOT NULL,
  `requestor` varchar(256) NOT NULL,
  `reportsProject` int(11) NOT NULL,
  `reportsID` int(11) NOT NULL,
  `timeSpent` double NOT NULL,
  `description` text NOT NULL,
  `tech` int(11) NOT NULL,
  `clientID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=531 ;

--
-- Dumping data for table `incidents`
--

INSERT INTO `incidents` (`id`, `timestamp`, `requestor`, `reportsProject`, `reportsID`, `timeSpent`, `description`, `tech`, `clientID`) VALUES
(511, 1347480300, 'Lori', 0, 0, 0.25, 'Website issues - pages in trash', 1, 7),
(512, 1347437100, 'Lori', 0, 0, 0.25, 'Website issues - pages in trash - 2 incidents', 1, 7),
(513, 1347548400, 'Lori', 0, 0, 0.15, 'Setting up User account on Domain', 6, 7),
(514, 1347549900, 'Lori', 0, 0, 0.15, 'Configuring User to PC (RedDell)', 6, 7),
(516, 1348064280, 'Lori Spahn', 0, 0, 0.08, 'Changed widget code of wordpress page for dave ramsey sponsorship widget to show new link to logo in the library', 1, 7),
(517, 1348247700, 'Lori Spahn', 0, 0, 0.08, 'Changed the contact form on Spahn Law Firm''s site to remove the ability to upload documents and to include a directive NOT to email SSNs.', 1, 7),
(518, 1349119800, 'Jenna', 0, 0, 0.15, 'Restarted fax service, verified via Fax, all is well', 6, 8),
(519, 1349703000, 'Jenna', 0, 0, 0.25, 'Removing malware from PC in-shop. Agreed upon with client.', 7, 8),
(520, 1349708400, 'Jenna', 0, 0, 0.25, 'Removing malware from PC in-shop. Agreed upon with customer', 7, 8),
(521, 1349708400, 'Jenna', 0, 0, 0.25, 'Removing malware from PC in-shop. Agreed upon with client.', 7, 8),
(522, 1349799600, 'Julie', 0, 0, 0.25, 'Changed Julie Martinez to Julie Johnson on their server', 1, 9),
(523, 1349877540, 'Naomi', 0, 0, 0.25, 'Remotely adjusted IP Reservation in 2wire gateway. this didn''t work, set back inside dhcp pool and manually assigned IP on XRX printer directly. all is well.', 6, 9),
(524, 1350311400, 'Naomi', 0, 0, 0.1, 'Created New Profile as per client request: Dennis', 6, 9),
(525, 1350311400, 'Naomi', 0, 0, 0.1, 'Created New Profile as per client request: prelitigation', 6, 9),
(526, 1350311400, 'Naomi', 0, 0, 0.25, 'Created New Profile as per client request: receptionist', 6, 9),
(527, 1350312300, 'Naomi', 0, 0, 0.1, 'Configure new profile on pc as per client request: receptionist', 6, 9),
(528, 1350355500, 'Naomi', 0, 0, 0.25, 'Configure new profile on pc as per client request: dennis', 6, 9),
(529, 1350312300, 'Rey', 0, 0, 0.25, 'Configured profile on New-pc as per client request: litigation on Diaz-5', 6, 9),
(530, 1350918000, 'Rey Diaz', 0, 0, 0.5, 'Created a whole new profile and configured for use with email for Yvette to use on DIAZ-4 computer', 6, 9);

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE IF NOT EXISTS `plans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `numberOfIncidents` int(11) NOT NULL,
  `monthlyCharge` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `numberOfIncidents`, `monthlyCharge`) VALUES
(1, 'Small Business', 5, 275),
(2, 'Medium Business', 10, 475),
(3, 'Large Business', 20, 775);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `userid` varchar(32) DEFAULT NULL,
  `userlevel` tinyint(1) unsigned NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  `rate` float NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `userid` (`userid`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `userid`, `userlevel`, `email`, `timestamp`, `rate`) VALUES
(1, 'andrew', '2e63826d138a9efd80733ef9de484259', 'c2b999f246c4c36903d7ad457cd03161', 9, 'andrew@vndx.com', 1358196600, 18),
(6, 'rae', 'c39eae623facd513e85e729f28384717', '6f7a6edf7c112148d6ad6db90e97d7cf', 9, 'rae@vndx.com', 1355244972, 18),
(7, 'steven', 'c39eae623facd513e85e729f28384717', 'bb9583f5674f164b86489c0c268fd12a', 1, 'steven@vndx.com', 1347556879, 12);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
