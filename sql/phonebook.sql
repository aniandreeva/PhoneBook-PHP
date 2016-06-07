-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time:  7 юни 2016 в 22:19
-- Версия на сървъра: 10.1.9-MariaDB
-- PHP Version: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phonebook`
--

-- --------------------------------------------------------

--
-- Структура на таблица `contacts`
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
-- Схема на данните от таблица `contacts`
--

INSERT INTO `contacts` (`id`, `user_id`, `first_name`, `last_name`, `phone_number`, `image_path`) VALUES
(1, 1, 'Sasho', 'Petrov', '0786234412', '573085c47b1ed.jpg'),
(2, 1, 'Ivan', 'Ivanov', '0887566434', 'default.jpg'),
(4, 2, 'Ivan', 'Peshev', '9827349827', 'default.jpg'),
(5, 1, 'holy', 'shit', '2154545456', 'default.jpg'),
(37, 1, 'Anton', 'Cholakov', '0877122331', '57307104d3557.jpg');

-- --------------------------------------------------------

--
-- Структура на таблица `contacts_groups`
--

CREATE TABLE `contacts_groups` (
  `groupId` int(11) NOT NULL,
  `contactId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `contacts_groups`
--

INSERT INTO `contacts_groups` (`groupId`, `contactId`) VALUES
(1, 4),
(1, 19),
(1, 21),
(1, 23),
(1, 24),
(1, 25),
(1, 27),
(1, 31),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 40),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(2, 2),
(2, 15),
(2, 18),
(2, 18),
(2, 21),
(2, 23),
(2, 24),
(2, 27),
(2, 29),
(2, 31),
(2, 31),
(2, 32),
(2, 33),
(2, 37),
(3, 15),
(3, 19),
(3, 21),
(3, 22),
(3, 23),
(3, 31),
(3, 32),
(3, 33),
(3, 34),
(3, 38),
(3, 40),
(4, 15),
(4, 41),
(5, 42),
(8, 43);

-- --------------------------------------------------------

--
-- Структура на таблица `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `groups`
--

INSERT INTO `groups` (`id`, `userId`, `name`) VALUES
(1, 1, 'Friends'),
(2, 2, 'People'),
(3, 2, 'Enemies'),
(10, 1, 'MyGroup');

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`id`, `is_admin`, `username`, `password`) VALUES
(1, 1, 'admin', 'adminpass'),
(2, 0, 'user', 'userpass'),
(7, 0, 'pepi', 'pepipass'),
(8, 0, 'ani', 'anipass'),
(16, 0, 'anita', 'anitapass'),
(19, 0, 'jorojo', 'jorojopass');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contacts_groups`
--
ALTER TABLE `contacts_groups`
  ADD KEY `groupId` (`groupId`,`contactId`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `user_contacts_cascade_del` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения за таблица `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `user_groups_cascade_del` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
