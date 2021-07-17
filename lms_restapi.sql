-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2021 at 07:18 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms_restapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignedtasks`
--

CREATE TABLE `assignedtasks` (
  `srno` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignedtasks`
--

INSERT INTO `assignedtasks` (`srno`, `uid`, `tid`, `status`) VALUES
(1, 2, 1, 'In Progress'),
(2, 2, 2, 'Not Started'),
(3, 2, 3, 'Not Started'),
(4, 2, 4, 'Not Started'),
(5, 2, 5, 'Not Started'),
(7, 2, 6, 'Not Started');

-- --------------------------------------------------------

--
-- Table structure for table `taskslist`
--

CREATE TABLE `taskslist` (
  `tid` int(11) NOT NULL,
  `task` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taskslist`
--

INSERT INTO `taskslist` (`tid`, `task`) VALUES
(1, 'Create Login Page.'),
(2, 'Create Registration Page.'),
(3, 'Create Book Insert Page.'),
(4, 'Create Books Listing Page.'),
(5, 'Create About Us Page.'),
(6, 'Create Contact Us Page.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `role`) VALUES
(1, 'tanmay', '123456', 'admin'),
(2, 'manoj', '123456', 'developer'),
(3, 'rohit', '123456', 'developer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignedtasks`
--
ALTER TABLE `assignedtasks`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `taskslist`
--
ALTER TABLE `taskslist`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignedtasks`
--
ALTER TABLE `assignedtasks`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `taskslist`
--
ALTER TABLE `taskslist`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
