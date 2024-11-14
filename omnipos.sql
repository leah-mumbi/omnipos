-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 14, 2024 at 07:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `omnipos`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Screens'),
(2, 'Touch'),
(4, 'Charging plate'),
(5, 'Power switch');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `payment_method` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `amount`, `status`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, 200, 1, 'cash', '2024-11-10 12:07:17', '2024-11-10 12:07:17'),
(2, 200, 1, 'cash', '2024-11-10 12:28:35', '2024-11-10 12:28:35'),
(3, 6000, 1, 'cash', '2024-11-11 10:25:56', '2024-11-11 10:25:56'),
(4, 2300, 1, 'cash', '2024-11-11 10:40:32', '2024-11-11 10:40:32'),
(5, 5500, 1, 'cash', '2024-11-11 10:44:00', '2024-11-11 10:44:00'),
(6, 1100, 1, 'cash', '2024-11-13 20:24:24', '2024-11-13 20:24:24');

-- --------------------------------------------------------


-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `total_price`) VALUES
(1, 1, 5, 2, 100, 200),
(2, 3, 1, 5, 1200, 6000),
(3, 4, 3, 2, 1150, 2300),
(4, 5, 11, 4, 250, 1000),
(5, 5, 6, 1, 2500, 2500),
(6, 5, 2, 1, 2000, 2000),
(7, 6, 11, 2, 250, 500),
(8, 6, 9, 4, 150, 600);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `category` bigint(20) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `quantity`) VALUES
(1, 'Samsung A12 lcd', 1, 1200, 7),
(2, 'xiaomi note 13 lcd', 1, 2000, 12),
(3, 'Tecno Kf6 lcd', 1, 1150, 5),
(4, 'Itel A16+', 2, 250, 10),
(6, 'Iphone 12 pro max original', 1, 2500, 2),
(8, 'Tecno Kf6 charging plate', 4, 200, 4),
(9, 'Itel A16+ power switch', 5, 150, 3),
(11, 'Samsung A15 charging plate', 4, 250, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `is_admin`, `password`) VALUES
(1, 'leah', 'mumbi', 'admin@omnipos.com', '0707907223', 1, '1234567'),
(2, 'Annita', 'Njihia', 'annitanjihia80@gmail.com', '0702072982', 0, 'annita254');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
