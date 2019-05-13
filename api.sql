-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2019 at 02:17 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lib_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `api`
--

CREATE TABLE `api` (
  `id` int(11) NOT NULL,
  `api_key` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `place_of_birth` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `first_name`, `last_name`, `place_of_birth`) VALUES
(1, 'J.R.R', 'Tolkien', 'Bloemfontein, Sydafrika'),
(3, 'J.K', 'Rowling', 'Yate, Storbritannien');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `ISBN` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `publishing_data` year(4) NOT NULL,
  `author_id` int(11) NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pages` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `ISBN`, `publishing_data`, `author_id`, `publisher_id`, `category`, `pages`) VALUES
(2, 'The Hobbit', '9785080000980', 1937, 1, 1, 'Adventure', 120),
(5, 'The Fellowship of the Ring', '9780786251780', 1954, 1, 1, 'Adventure', 240),
(7, 'The Two Towers', '9780458907601', 1954, 1, 1, 'Adventure', 302),
(9, 'The Return of the King', '9788381161756', 1955, 1, 1, 'Adventure', 150),
(10, 'Tree and Leaf', '9789636980153', 1988, 1, 1, 'Adventure', 256),
(13, 'Lethal White', '0751572853', 2018, 3, 2, 'Criminal', 320);

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `id` int(11) NOT NULL,
  `publisher` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`id`, `publisher`, `location`) VALUES
(1, 'George Allen and Unwin', 'London'),
(2, 'Sphere Books‎', 'Cicily, Italy');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `lastName` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(300) COLLATE utf8mb4_bin NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`, `created`) VALUES
(1, 'Amro', 'Dalisay', 'mike@codeoinja.com', '$2y$10$3nGSJUlDGSmo4xHUuFiPKuizl1ZVApRzJvqLVrIh19aM8R37kaNcW', '2019-05-13 10:11:05'),
(2, 'mro', 'Dalisay', 'mike@coja.com', '$2y$10$3BrisEIzSpOo2XkJ3R3rMOsoc6WJUN/DXb6y7XjjuLXKXpTJsv6fC', '2019-05-13 10:11:56'),
(3, 'mro', 'alisay', 'mike@coja.com', '$2y$10$./x0K6/fJWUJyKG36qGXlu.lNDXuN8wxBRz028dIMhsOo2MB/7/h2', '2019-05-13 10:12:07'),
(4, 'mro', 'alisay', 'mike@coja.com', '$2y$10$ztfIjopT1EYw2s.AtK727uNY8tSLjhboYpg8B.n3c6gHw0vTUiyE6', '2019-05-13 10:12:16'),
(5, 'mro', 'alisay', 'mike@coja.com', '$2y$10$esPdQfXRIVBx6h98KHwDcOlzCHDqpbkBqiMnGx.qEpgBuhhnXsoqy', '2019-05-13 10:12:31'),
(6, '', '', '', '$2y$10$go2T1yB03dn6z9LLGBB6nuXZhXpUWbpgB6EEcRm0yodF3PiaUbBzK', '2019-05-13 10:12:50'),
(7, 'mro', 'alisay', 'mike@coja.com', '$2y$10$5tk8/X3kVRlfZChukSmwluyqvbRCEC5vrECFcJ7yoYcNJgl8JCtQm', '2019-05-13 10:13:47'),
(8, 'mro', 'alisay', 'mike@coja.com', '$2y$10$0DTngoouYuJqolNiaaGvruCrcH42j7uyDNXaiRdTcGieZKbM/whIC', '2019-05-13 10:14:18'),
(9, 'mro', 'alisay', 'mike@coja.com', '$2y$10$81z7Et9Kszj.S7/YAKEKNe5Reep0zwOdMmqdgJw5yLHW88Sg/rZf.', '2019-05-13 10:14:35'),
(10, '', '', 'mike@codeofaninja.com', '$2y$10$8lUaRASPKXhnVggwTCaQf.twzoB2v9ICK5tKhibxLL7VBSIE.xWY.', '2019-05-13 10:17:08'),
(11, 'Amro', 'Soliman', 'amro@mail.com', '$2y$10$ukp7Ma5AFSSCYgwCGaZMVuRm7nA2JbD9JWlmqFS.sUYLHV0PLoWqm', '2019-05-13 12:33:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api`
--
ALTER TABLE `api`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_author_id` (`author_id`),
  ADD KEY `fk_publisher_id` (`publisher_id`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
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
-- AUTO_INCREMENT for table `api`
--
ALTER TABLE `api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `api`
--
ALTER TABLE `api`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `fk_author_id` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_publisher_id` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
