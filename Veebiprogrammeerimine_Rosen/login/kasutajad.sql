-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 29, 2025 at 02:24 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autoleht`
--

-- --------------------------------------------------------

--
-- Table structure for table `kasutajad`
--

DROP TABLE IF EXISTS `kasutajad`;
CREATE TABLE IF NOT EXISTS `kasutajad` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `isadmin` int DEFAULT '0',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `uid` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kasutajad`
--

INSERT INTO `kasutajad` (`Id`, `firstname`, `lastname`, `email`, `username`, `password`, `isadmin`) VALUES
(7, 'Kalle', 'Kaalikas', 'kaalikas@hot.ee', 'Kallek', 'Parool2025', 0),
(8, 'marge', 'rosen', 'rosen@hot.ee', 'marger', 'Tere2025', 1),
(11, 'Marje', 'Marjuline', 'marju@marju.ee', 'MarjuMarju', 'Tere2000', 0),
(12, 'Simon', 'Rosen', 'simon@hot.ee', 'Simon', 'Tere2012', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
