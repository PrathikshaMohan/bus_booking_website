-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 07, 2025 at 03:32 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bus_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(2, 'admin', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `bus_id` int DEFAULT NULL,
  `seat_number` varchar(10) DEFAULT NULL,
  `total_fare` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bus_id` (`bus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `bus_id`, `seat_number`, `total_fare`) VALUES
(13, 4, 1, 'A4', 950.00),
(14, 4, 1, 'B3', 950.00),
(12, 4, 1, 'B1', 950.00);

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

DROP TABLE IF EXISTS `buses`;
CREATE TABLE IF NOT EXISTS `buses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `departure` varchar(50) NOT NULL,
  `departure_time` time NOT NULL,
  `arrival` varchar(50) NOT NULL,
  `arrival_time` time NOT NULL,
  `seats_available` int NOT NULL,
  `fare` decimal(10,2) NOT NULL,
  `total_seats` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`id`, `date`, `departure`, `departure_time`, `arrival`, `arrival_time`, `seats_available`, `fare`, `total_seats`) VALUES
(1, '2025-02-03', 'Matale', '07:30:00', 'Colombo', '11:45:00', 14, 950.00, 0),
(2, '2024-05-28', 'Matale', '21:30:00', 'Colombo', '01:25:00', 28, 950.00, 0),
(3, '2025-02-04', 'Kandy', '08:00:00', 'Matale', '21:30:00', 23, 170.00, 28),
(4, '2025-02-05', 'Colombo', '12:30:29', 'Matale', '15:00:29', 19, 950.00, 28),
(5, '2025-02-08', 'Matale', '08:30:00', 'Kandy', '10:00:00', 19, 120.00, 28);

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

DROP TABLE IF EXISTS `seats`;
CREATE TABLE IF NOT EXISTS `seats` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bus_id` int DEFAULT NULL,
  `seat_number` varchar(10) DEFAULT NULL,
  `status` enum('available','booked') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bus_id` (`bus_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pnumber` varchar(15) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uname` (`uname`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `uname`, `email`, `pnumber`, `pw`, `created_at`) VALUES
(1, 'Tharindu Malsha', 'malsha', 'malsha@gmail.com', '0760751775', 'Tharu123', '2025-02-01 13:51:31'),
(2, 'Prathiksha mohan', 'prathiksha', 'prathiksha@gmail.com', '0751234567', 'cat123', '2025-02-03 07:41:48'),
(3, 'Hasindu Ekanayaka', 'hasindu', 'hasindu@gmail.com', '0781234567', 'hasi123', '2025-02-04 06:58:06'),
(4, 'Divya yogeswaran', 'Divya', 'div@gmail.com', '0712345678', 'divya123', '2025-02-07 13:58:06');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
