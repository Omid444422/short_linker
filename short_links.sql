-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2022 at 06:05 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `short_links`
--

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `ID` int(11) NOT NULL,
  `creator` varchar(255) NOT NULL,
  `link_address` varchar(255) NOT NULL,
  `link_url` text NOT NULL,
  `create_time` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`ID`, `creator`, `link_address`, `link_url`, `create_time`, `status`) VALUES
(20, 'admin', 'omid', 'https://digikala.com', 'Û±Û¸:Û³Û´:Û²Ûµ +Û°Û´Û³Û° ,Ø¬Ù…Ø¹Ù‡, Û´ Ø´Ù‡Ø±ÛŒÙˆØ± Û±Û´Û°Û±', 1),
(21, 'admin', 'akbar', 'https://codeyad.com/', 'Û²Û°:Û³Û°:Û²Û· +Û°Û´Û³Û° ,Ø¬Ù…Ø¹Ù‡, Û´ Ø´Ù‡Ø±ÛŒÙˆØ± Û±Û´Û°Û±', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `link_address` (`link_address`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
