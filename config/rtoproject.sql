-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2022 at 02:24 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rtoproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `dealerclientdata`
--

CREATE TABLE `dealerclientdata` (
  `id` int(11) NOT NULL,
  `dealer_id` varchar(100) NOT NULL,
  `certificateno` varchar(50) NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `mobno` varchar(11) NOT NULL,
  `vehicalregistrationno` varchar(55) NOT NULL,
  `vehicalmanufactureyear` text NOT NULL,
  `vehicalregistrationdate` varchar(50) NOT NULL,
  `chasisno` text NOT NULL,
  `engineno` text NOT NULL,
  `make` varchar(50) NOT NULL,
  `model` text NOT NULL,
  `white_tape` varchar(20) NOT NULL,
  `yellow_tape` varchar(20) NOT NULL,
  `red_tape` varchar(20) NOT NULL,
  `modelno` text NOT NULL,
  `modelyear` varchar(10) NOT NULL,
  `invoiceno` text NOT NULL,
  `invoicedate` text NOT NULL,
  `rtostate` text NOT NULL,
  `rto` text NOT NULL,
  `image1` varchar(100) NOT NULL,
  `image2` varchar(100) NOT NULL,
  `image3` varchar(100) NOT NULL,
  `image4` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `datetime` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealerdemographicdata`
--

CREATE TABLE `dealerdemographicdata` (
  `id` int(11) NOT NULL,
  `dealer_id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `img` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `address` text NOT NULL,
  `status` varchar(30) NOT NULL,
  `position` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dealerdemographicdata`
--

INSERT INTO `dealerdemographicdata` (`id`, `dealer_id`, `password`, `firstName`, `lastName`, `img`, `email`, `address`, `status`, `position`) VALUES
(2, 'admin', '12345', 'Administration', '', '', 'admin@auto.com', '', 'active', 'admin'),
(38, 'jhauto', '12345', 'Jharkhand', 'Auto', '', 'jharkhand.auto@gmail.com', 'Jharkhand Kalikat', 'activate', 'dealer');

-- --------------------------------------------------------

--
-- Table structure for table `dealerfinancialdata`
--

CREATE TABLE `dealerfinancialdata` (
  `id` int(11) NOT NULL,
  `dealer_id` varchar(60) NOT NULL,
  `certificateno` varchar(100) NOT NULL,
  `red_tape` varchar(100) NOT NULL,
  `white_tape` varchar(100) NOT NULL,
  `yellow_tape` varchar(100) NOT NULL,
  `method` varchar(20) NOT NULL,
  `datetime` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dealerfinancialdata`
--

INSERT INTO `dealerfinancialdata` (`id`, `dealer_id`, `certificateno`, `red_tape`, `white_tape`, `yellow_tape`, `method`, `datetime`) VALUES
(67, 'jhauto', '', '114', '150', '789', 'add', '10-05-2022 03:11:26'),
(80, 'jhauto', '', '0', '40', '0', 'add', '10-05-2022 05:45:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dealerclientdata`
--
ALTER TABLE `dealerclientdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealerdemographicdata`
--
ALTER TABLE `dealerdemographicdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealerfinancialdata`
--
ALTER TABLE `dealerfinancialdata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dealerclientdata`
--
ALTER TABLE `dealerclientdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1284;

--
-- AUTO_INCREMENT for table `dealerdemographicdata`
--
ALTER TABLE `dealerdemographicdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `dealerfinancialdata`
--
ALTER TABLE `dealerfinancialdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
