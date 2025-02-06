-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2024 at 02:55 AM
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
-- Database: `dbact`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`, `created_at`) VALUES
(7, 'josh1951', 'johnjoshuatiu69@gmail.com', '$2y$10$XvDR551JjKqG05QVHQTWHexTwETq2pQNxfkhJBPh7bg.MiMB.mBXC', '2024-11-12 07:35:35');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(10) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `contact` varchar(25) NOT NULL,
  `address` varchar(50) NOT NULL,
  `profile_picture` longblob NOT NULL,
  `email` varchar(225) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `signup_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `full_name`, `contact`, `address`, `profile_picture`, `email`, `username`, `password`, `signup_date`) VALUES
(29, 'Josh Tiu', '123221312312', 'Barangay-13 Dapa, Surigao Del Norte', 0x706963747572652f426c61636b2073696c686f756574746573206f66206d616e20776f6d616e2073696e67696e6720746f67657468657220766563746f7220696d616765206f6e20566563746f7253746f636b2e6a666966, 'johnjoshua24@gmail.com', 'johnjoshuatiu', '$2y$10$o41U0pQMJ2E/k1jfumJsLO4jZq4iWEJ4Qd2igZGkFFq.AfZfoOtpu', '2024-11-12 15:31:19'),
(30, 'claire', '1245', 'aw f', 0x75706c6f6164732f3335343234373931335f363733343435363733333235313239395f323337363732323735313137323038303632315f6e2e6a7067, 'claire@gmail.com', 'claire', '$2y$10$Zw9zLBbWd0mR1T7c4nBGJua9KX5VuRfb25rNUY1Z8ee1M7OyNGJVi', '2024-11-19 08:45:13');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` longblob NOT NULL,
  `caption` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `price`, `quantity`, `image`, `caption`) VALUES
(25, 'HeadPhonesBluetooth', 3000.00, 56, 0x75706c6f6164732f4d4f5653534f5520453720416374697665204e6f6973652043616e63656c6c696e67204865616470686f6e657320426c7565746f6f7468204865616470686f6e657320576972656c657373204865616470686f6e6573204f766572204561722077697468204d6963726f70686f6e65204465657020426173732c20436f6d666f727461626c652050726f7465696e20456172706164732c20333020486f75727320506c617974696d6520666f722054726176656c5f576f726b2c20426c61636b2e6a666966, 'MOVSSOU E7 Active Noise Cancelling Headphones Blue'),
(34, 'SmartWatch', 200.00, 50, 0x75706c6f6164732f363733626437633664663631655f486967682d7370656564204e6574776f726b20344720536d617274776174636820573520546f7563682053637265656e20576974682043616d657261204750532057696669204c6f636174696f6e204b69647320536d61727420576174636820696e2053746f636b202d20426c61636b2d70696e6b202834472053494d2043617264292e6a666966, 'High-speed Network 4G Smartwatch W5 Touch Screen W'),
(35, 'Drone', 500.00, 19, 0x75706c6f6164732f363733626438326533326137645f44726f6e6520444a49204d696e6920342050726f20466c79204d6f726520436f6d626f20444a4920524320322028436f6d2074656c6129202d20444a493034332e6a666966, 'DJI Mini 4 Pro'),
(36, 'WirelessCharger', 100.00, 35, 0x75706c6f6164732f363733626438346435633666325f32303233204e657720496e74656c6c6967656e74204c4544204c616d7020426c7565746f6f746820537065616b6520576972656c65737320436861726765722041746d6f737068657265204c616d702041707020436f6e74726f6c20466f7220426564726f6f6d20486f6d65204465636f72202d204c696768742047726579205f205553422e6a666966, '2023 New Intelligent LED Lamp Bluetooth Speake Wir'),
(37, 'HONOR Magic 6 Pro 5G', 250.00, 40, 0x75706c6f6164732f363733626438366139366339665f484f4e4f52204d6167696320362050726f2035472077697468203138304d50205065726973636f70652054656c6570686f746f2043616d657261206c61756e6368656420696e20496e6469615f2050726963652c2073706563732e6a666966, 'HONOR Magic 6 Pro 5G with 180MP Periscope Telephot'),
(38, 'Apple Vision Pro', 500.00, 20, 0x75706c6f6164732f363733626438656638306237655f4170706c6520566973696f6e2050726f204d6f636b75702e6a666966, 'Apple Vr Pro\r\n'),
(39, 'Fidget Spinner Pro ', 132.00, 12, 0x75706c6f6164732f363733626439313332623933615f466964676574205370696e6e65722050726f204d6574616c205365726965732e6a666966, 'Fidget Spinner Pro Metal Series'),
(40, '4k WebCam', 50.00, 45, 0x75706c6f6164732f363733626439376236356636355f4f66666572206f662074686520646179202d2047726162207468697320344b2077656263616d20666f72206d74677320616e64206578636974696e6721202d20546865204761646765746565722e6a666966, 'Offer of the day - Grab this 4K webcam and excitin'),
(41, 'VersionTECH_G2000 Gaming Headset', 12000.00, 55, 0x75706c6f6164732f363733626530633133393862385f56657273696f6e544543485f2047323030302047616d696e6720486561647365742c204261737320537572726f756e642047616d696e67204865616470686f6e65732077697468204e6f6973652043616e63656c6c696e67204d69632c204c4544204c69676874732c20536f6674204d656d6f7279204561726d7566667320666f72205053355f205053345f2058626f78204f6e6520436f6e74726f6c6c65725f4c6170746f705f50435f4d61635f4e696e74656e646f204e45532047616d65732d426c75652e6a666966, 'Bass Surround Gaming Headphones with Noise Cancell');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchase_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `payment_mode` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchase_id`, `client_id`, `product_id`, `quantity`, `date`, `payment_mode`) VALUES
(39, 27, 24, 1, '2024-11-12 12:57:42', NULL),
(40, 27, 24, 1, '2024-11-12 13:06:10', NULL),
(41, 29, 24, 1, '2024-11-12 15:31:42', NULL),
(42, 30, 35, 1, '2024-11-19 08:45:52', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
