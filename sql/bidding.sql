-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 08:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bidding`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(10) NOT NULL,
  `admin_code` varchar(20) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `admin_password` text DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `admin_status` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_code`, `email`, `admin_password`, `firstname`, `lastname`, `admin_status`, `is_deleted`) VALUES
(1, 'A000001', 'admin@gmail.com', '$2y$10$NP7owMsd/msd4LLgeAyCaeOgQQ094SPOh8/xM78trlTfYjIN2WKti', 'admin', 'admin', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `bid_id` int(10) NOT NULL,
  `bid_code` varchar(20) NOT NULL,
  `user_code` varchar(20) DEFAULT NULL,
  `product_code` varchar(20) DEFAULT NULL,
  `bid_amount` varchar(100) DEFAULT NULL,
  `bid_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(10) NOT NULL,
  `category_code` varchar(20) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_code`, `category_name`, `is_deleted`) VALUES
(1, 'CA000001', 'กระเป๋า', 0),
(2, 'CA000002', 'หมวก', 0),
(5, 'CA000003', 'รองเท้า', 0),
(6, 'CA000004', 'dsfหฟกฟหกฟหกฟห', 1),
(7, 'CA000005', 'dfgds', 1),
(8, 'CA000006', 'werwr', 1),
(9, 'CA000007', 'หฟกฟหฟหฟหฟหหฟ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) NOT NULL,
  `product_code` varchar(20) NOT NULL,
  `category_code` varchar(20) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `starting_price` varchar(100) DEFAULT NULL,
  `current_price` varchar(100) DEFAULT NULL,
  `start_datetime` datetime DEFAULT NULL,
  `end_datetime` datetime DEFAULT NULL,
  `bid_status` tinyint(1) DEFAULT 1 COMMENT '1=active, 2=closed, 3=sold, 4=expired',
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_code`, `category_code`, `product_name`, `description`, `starting_price`, `current_price`, `start_datetime`, `end_datetime`, `bid_status`, `is_deleted`) VALUES
(3, 'PD000001', 'CA000001', 'กระเป๋าผ้า', 'กระเป๋าผ้า', '100', '', '2024-04-27 07:00:00', '2024-04-27 17:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transections`
--

CREATE TABLE `transections` (
  `transection_id` int(10) NOT NULL,
  `transection_code` varchar(20) NOT NULL,
  `user_code` varchar(20) DEFAULT NULL,
  `product_code` varchar(20) DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL,
  `transection_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `user_code` varchar(20) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_password` text DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `user_address` text DEFAULT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_code`, `email`, `user_password`, `firstname`, `lastname`, `phone_number`, `user_address`, `user_status`, `is_deleted`) VALUES
(3, 'U000001', 'user@gmail.com', '$2y$10$NP7owMsd/msd4LLgeAyCaeOgQQ094SPOh8/xM78trlTfYjIN2WKti', 'user', 'user', '0999999999', 'chiang mai', 1, 0),
(4, 'U000002', 'user2@gmail.com', '$2y$10$5Ga0IXDnDgPOQtfUxth.nem7tnSUIrxTKf0YbaEBkwBaRkK8tAmpq', 'user2', 'user2', '0999999999', 'chiang mai', 1, 0),
(5, 'U000003', 'user3@gmail.com', '$2y$10$HUoET6xvSClKeUXMHJ2O3eIYuRGJJfsv0O.2IAoNNSruIzA7DAJb2', 'user3', 'user3', '0888888888', 'bankok', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`,`admin_code`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`bid_id`,`bid_code`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`,`category_code`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`,`product_code`);

--
-- Indexes for table `transections`
--
ALTER TABLE `transections`
  ADD PRIMARY KEY (`transection_id`,`transection_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`,`user_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `bid_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transections`
--
ALTER TABLE `transections`
  MODIFY `transection_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
