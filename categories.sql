-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 07, 2018 at 03:52 PM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(5) NOT NULL,
  `name` varchar(40) NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `name`, `reg_date`) VALUES
(189, 'romance', '2018-04-07 15:25:01'),
(190, 'fiction', '2018-04-07 15:25:08'),
(191, 'fantasy', '2018-04-07 15:25:15'),
(192, 'science-fiction', '2018-04-07 15:25:23'),
(194, 'covers', '2018-04-07 15:25:31'),
(195, 'history', '2018-04-07 15:25:36'),
(196, 'mystery', '2018-04-07 15:25:41'),
(197, 'historical', '2018-04-07 15:25:46'),
(198, 'horror', '2018-04-07 15:25:49'),
(199, 'paranormal', '2018-04-07 15:25:53'),
(200, 'literature', '2018-04-07 15:26:05'),
(201, 'thriller', '2018-04-07 15:26:19'),
(202, 'graphic-novels', '2018-04-07 15:26:27'),
(203, 'novels', '2018-04-07 15:26:29'),
(204, 'children', '2018-04-07 15:27:00'),
(205, 'biography', '2018-04-07 15:27:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
