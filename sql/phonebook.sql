-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2016 at 04:18 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS phonebook;
USE phonebook;

--
-- Database: `phonebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `user_id`, `first_name`, `last_name`, `phone_number`, `image_path`) VALUES
(1, 1, 'Sasho', 'shdbaksd', '07862344', '573085c47b1ed.jpg'),
(2, 1, 'Ivan', 'Ivanov', '0887566434', 'default.jpg'),
(4, 2, 'Ivan', 'Peshev', '9827349827', 'default.jpg'),
(5, 1, 'holy', 'shit', '21545454', 'default.jpg'),
(37, 1, 'Anton', 'Cholakov', '0877122331', '57307104d3557.jpg'),
(39, 17, '', '', '', 'default.jpg'),
(40, 17, 'ahhaha', 'ahahah', '12312312', '573088b2572e7.gif');

-- --------------------------------------------------------

--
-- Table structure for table `contacts_groups`
--

CREATE TABLE `contacts_groups` (
  `groupId` int(11) NOT NULL,
  `contactId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contacts_groups`
--

INSERT INTO `contacts_groups` (`groupId`, `contactId`) VALUES
(2, 18),
(2, 18),
(1, 19),
(3, 19),
(1, 21),
(2, 21),
(3, 21),
(3, 22),
(1, 23),
(2, 23),
(3, 23),
(1, 24),
(2, 24),
(1, 25),
(1, 27),
(2, 27),
(2, 29),
(1, 31),
(2, 31),
(2, 31),
(3, 31),
(2, 15),
(3, 15),
(4, 15),
(2, 32),
(3, 32),
(1, 33),
(2, 33),
(3, 33),
(1, 34),
(3, 34),
(1, 35),
(1, 36),
(3, 5),
(4, 5),
(2, 2),
(1, 37),
(2, 37),
(1, 38),
(3, 38),
(1, 4),
(2, 1),
(1, 40),
(3, 40);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `userId`, `name`) VALUES
(1, 1, 'Friends'),
(2, 2, 'People'),
(3, 2, 'Enemies');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `is_admin`, `username`, `password`) VALUES
(1, 1, 'admin', 'adminpass'),
(2, 0, 'user', 'userpass'),
(7, 0, 'pepi', 'pepipass'),
(8, 0, 'ani', 'anipass'),
(16, 0, 'anita', 'anitapass'),
(17, 0, 'nemo', 'nemo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
