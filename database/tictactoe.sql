-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2021 at 06:19 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tictactoe`
--

-- --------------------------------------------------------

--
-- Table structure for table `gamesessions`
--

CREATE TABLE `gamesessions` (
  `sessionid` int(11) NOT NULL,
  `pl1id` int(11) DEFAULT NULL,
  `pl2id` int(11) DEFAULT NULL,
  `box1` int(11) DEFAULT NULL,
  `box2` int(11) DEFAULT NULL,
  `box3` int(11) DEFAULT NULL,
  `box4` int(11) DEFAULT NULL,
  `box5` int(11) DEFAULT NULL,
  `box6` int(11) DEFAULT NULL,
  `box7` int(11) DEFAULT NULL,
  `box8` int(11) DEFAULT NULL,
  `box9` int(11) DEFAULT NULL,
  `pl1scr` int(11) DEFAULT NULL,
  `pl2scr` int(11) DEFAULT NULL,
  `turn` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gamesessions`
--

INSERT INTO `gamesessions` (`sessionid`, `pl1id`, `pl2id`, `box1`, `box2`, `box3`, `box4`, `box5`, `box6`, `box7`, `box8`, `box9`, `pl1scr`, `pl2scr`, `turn`, `count`) VALUES
(14, 1, 2, 1, 1, 1, 0, 2, 2, 2, 0, 1, 0, 0, 0, 7),
(16, 2, 1, 1, 0, 1, 2, 2, 1, 2, 0, 1, 0, 0, 0, 7);

-- --------------------------------------------------------

--
-- Table structure for table `online`
--

CREATE TABLE `online` (
  `plrid` int(11) DEFAULT NULL,
  `plrname` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `senderid` int(11) DEFAULT NULL,
  `sendername` text DEFAULT NULL,
  `recieverid` int(11) DEFAULT NULL,
  `recievername` text DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `requestid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `username` text DEFAULT NULL,
  `password` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `gamesessions`
--
ALTER TABLE `gamesessions`
  ADD PRIMARY KEY (`sessionid`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`requestid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gamesessions`
--
ALTER TABLE `gamesessions`
  MODIFY `sessionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `requestid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
