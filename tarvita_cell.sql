-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2022 at 03:11 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tarvita_cell`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `date_released` date NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL,
  `color` varchar(20) NOT NULL,
  `internal` int(11) NOT NULL,
  `ram` int(11) NOT NULL,
  `battery` int(11) NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `date_released`, `name`, `price`, `brand`, `stock`, `color`, `internal`, `ram`, `battery`, `photo`) VALUES
(1, '2022-11-04', 'Samsung A53', 5799000, 'samsung', 125, 'black', 128, 6, 5000, '1.webp'),
(2, '2022-11-04', 'Samsung A53', 5799000, 'samsung', 125, 'blue', 128, 6, 5000, '2.webp'),
(3, '2022-11-04', 'Redmi Note 11', 4999000, 'xiaomi', 231, 'black', 128, 8, 6000, '3.png'),
(4, '2022-11-05', 'Xiaomi 11T Pro', 6299000, 'xiaomi', 198, 'blue', 128, 8, 6000, '4.png'),
(5, '2022-11-07', 'IPhone 13 Pro Max', 13799000, 'iphone', 76, 'black', 128, 6, 5000, '5.png'),
(6, '2022-11-08', 'Vivo Z1 Pro', 3499000, 'vivo', 124, 'blue', 64, 4, 6000, '6.png'),
(7, '2022-11-08', 'Samsung M33', 3999000, 'samsung', 117, 'black', 128, 4, 6000, '7.png'),
(8, '2022-11-08', 'Samsung S22 Ultra', 18999000, 'samsung', 117, 'black', 128, 8, 7000, '8.webp');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(10) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `pw`, `address`) VALUES
('aziizah', '$2y$10$CuHK8xtXhdHb5D5e7xLeeeb9bRIidLID5ofRG3fuDKaTjZCNT8AxK', 'Jl. Anang Hasyim');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
