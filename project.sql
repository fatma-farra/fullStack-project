-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 29, 2021 at 05:47 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '123'),
('reemaAsk', '010'),
('RMN', 'E100');

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `empID` int(10) UNSIGNED NOT NULL,
  `token` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`empID`, `token`) VALUES
(1, 'eba12269782b08c0'),
(4, 'c923cbc277bd9f46'),
(5, '9eeb46ee82116502'),
(6, 'b5a39138e705780f');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `fName` varchar(10) NOT NULL,
  `lName` varchar(10) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(30) NOT NULL,
  `bod` date NOT NULL,
  `dep` varchar(25) NOT NULL,
  `status` varchar(21) NOT NULL,
  `rgDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `phone` int(10) UNSIGNED NOT NULL,
  `country` varchar(10) NOT NULL,
  `city` varchar(10) NOT NULL,
  `address` varchar(20) NOT NULL,
  `id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`username`, `password`, `fName`, `lName`, `gender`, `email`, `bod`, `dep`, `status`, `rgDate`, `phone`, `country`, `city`, `address`, `id`) VALUES
('Mohammed', '125', 'Mohammed', 'Hazem', 'Male', 'MohammedHaz@hotmail.com', '2021-05-26', 'Human Resources', 'Active', '2021-05-22 14:59:27', 123569, 'Egypt', 'LOQSOR', 'loqser street', 2),
('fatma18', '123456', 'fatma', 'mossa', 'Female', 'fatma@gmail.com', '2021-05-05', 'Human Resources', 'Active', '2021-05-29 16:06:54', 599986892, 'gaza', 'gaza', 'gaza', 6);

-- --------------------------------------------------------

--
-- Table structure for table `leavetab`
--

CREATE TABLE `leavetab` (
  `id` int(10) NOT NULL,
  `type` varchar(24) NOT NULL,
  `toDate` date NOT NULL,
  `fromDate` date NOT NULL,
  `description` text NOT NULL,
  `status` varchar(21) NOT NULL,
  `empID` int(10) UNSIGNED NOT NULL,
  `postDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leavetab`
--

INSERT INTO `leavetab` (`id`, `type`, `toDate`, `fromDate`, `description`, `status`, `empID`, `postDate`) VALUES
(4, 'medical leave', '2021-05-27', '2021-05-20', 'nothimg', 'Not_Approved', 2, '2021-05-22 15:00:13'),
(5, 'restricted holiday', '2021-05-11', '2021-05-04', 'nothing ,only i want leave', 'Approved', 2, '2021-05-22 15:03:33'),
(6, 'Casual Leave', '2021-05-18', '2021-05-06', 'no', 'Approved', 2, '2021-05-22 15:00:33'),
(7, 'restricted holiday', '2021-05-31', '2021-05-11', 'ok', 'Not_Approved', 2, '2021-05-22 15:03:23'),
(12, 'medical leave', '2021-05-13', '2021-05-05', 'ill', 'Not_Approved', 2, '2021-05-28 20:39:19'),
(13, 'medical leave', '2021-05-13', '2021-05-05', 'ill', 'Approved', 2, '2021-05-28 20:40:27'),
(14, 'medical leave', '2021-04-29', '2021-04-25', 'ill', 'Approved', 2, '2021-05-29 08:21:38'),
(15, 'restricted holiday', '2021-05-31', '2021-05-26', 'need leave', 'Not_Approved', 2, '2021-05-29 08:24:29'),
(17, 'restricted holiday', '2021-05-30', '2021-05-28', 'need leave', 'Not_Approved', 6, '2021-05-29 16:27:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`empID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `leavetab`
--
ALTER TABLE `leavetab`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Foreign key` (`empID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `leavetab`
--
ALTER TABLE `leavetab`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leavetab`
--
ALTER TABLE `leavetab`
  ADD CONSTRAINT `Foreign key` FOREIGN KEY (`empID`) REFERENCES `employee` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
