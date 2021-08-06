-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2021 at 09:29 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kagati`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_points_tbl`
--

CREATE TABLE `order_points_tbl` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `points_received` double DEFAULT NULL,
  `points_remaining` double DEFAULT NULL,
  `expiry_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_points_tbl`
--

INSERT INTO `order_points_tbl` (`id`, `order_id`, `points_received`, `points_remaining`, `expiry_date`) VALUES
(1, 1, 64, 0, '2022-08-06 00:00:00'),
(2, 2, 76, 76, '2022-08-06 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_tbl`
--

CREATE TABLE `order_tbl` (
  `id` int(11) NOT NULL,
  `order_amount` double NOT NULL,
  `order_date` datetime NOT NULL,
  `amount_by_points` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_tbl`
--

INSERT INTO `order_tbl` (`id`, `order_amount`, `order_date`, `amount_by_points`) VALUES
(1, 64.9, '2021-08-06 00:00:00', 0),
(2, 76.45, '2021-08-06 00:00:00', 0.64);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_points_tbl`
--
ALTER TABLE `order_points_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_tbl`
--
ALTER TABLE `order_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_points_tbl`
--
ALTER TABLE `order_points_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_tbl`
--
ALTER TABLE `order_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
