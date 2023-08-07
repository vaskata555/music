-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Време на генериране:  7 авг 2023 в 22:21
-- Версия на сървъра: 10.4.20-MariaDB
-- Версия на PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данни: `music`
--

-- --------------------------------------------------------

--
-- Структура на таблица `album`
--

CREATE TABLE `album` (
  `id` int(255) NOT NULL,
  `artist_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `album`
--

INSERT INTO `album` (`id`, `artist_id`, `name`, `image`) VALUES
(5, 22, 'Open to work!', 'PHP.jpg'),
(6, 23, 'Talk that Talk', 'wefoundlove.jpg');

-- --------------------------------------------------------

--
-- Структура на таблица `artist`
--

CREATE TABLE `artist` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `artist`
--

INSERT INTO `artist` (`id`, `name`, `description`, `image`) VALUES
(22, 'Vasil Stoqnov', 'PHP DEVELOPER WANNABE', 'vasil.jpg'),
(23, 'Rihanna', 'Robyn Rihanna Fenty is a Barbadian singer, businesswoman, and actress. ', 'rihanna.jpg');

-- --------------------------------------------------------

--
-- Структура на таблица `song`
--

CREATE TABLE `song` (
  `id` int(255) NOT NULL,
  `artist_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `albumid` int(255) NOT NULL,
  `song` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `song`
--

INSERT INTO `song` (`id`, `artist_id`, `name`, `image`, `albumid`, `song`) VALUES
(42, 22, 'Work as a PHP DEV', 'Work.jpg', 5, 'Rihanna - Work (Explicit) ft. Drake.mp3'),
(43, 23, 'WeFoundLove', 'wefoundlove.jpg', 6, 'Rihanna - We Found Love ft. Calvin Harris.mp3');

--
-- Indexes for dumped tables
--

--
-- Индекси за таблица `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artist_id` (`artist_id`);

--
-- Индекси за таблица `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`id`);

--
-- Индекси за таблица `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artist_id` (`artist_id`),
  ADD KEY `albumid` (`albumid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `song`
--
ALTER TABLE `song`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения за таблица `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `song_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `song_ibfk_2` FOREIGN KEY (`albumid`) REFERENCES `album` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
