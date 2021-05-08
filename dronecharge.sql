-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2021 at 10:57 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dronecharge`
--
CREATE DATABASE IF NOT EXISTS `dronecharge` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dronecharge`;

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE `action` (
  `Drone_id` int(10) NOT NULL,
  `Station_id` int(10) NOT NULL,
  `Transaction_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`Drone_id`, `Station_id`, `Transaction_id`) VALUES
(1, 1, 1),
(3, 4, 2),
(1, 2, 3),
(1, 7, 4),
(8, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `charging_rates`
--

CREATE TABLE `charging_rates` (
  `charge_type` varchar(32) NOT NULL,
  `charge_rate` double NOT NULL,
  `charge_speed` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `charging_rates`
--

INSERT INTO `charging_rates` (`charge_type`, `charge_rate`, `charge_speed`) VALUES
('Normal', 0.5, 500),
('Super', 0.75, 600);

-- --------------------------------------------------------

--
-- Table structure for table `drone`
--

CREATE TABLE `drone` (
  `drone_id` int(32) NOT NULL,
  `drone_length` double NOT NULL,
  `drone_width` double NOT NULL,
  `drone_height` double NOT NULL,
  `drone_battery_life` int(10) NOT NULL,
  `drone_model` varchar(32) NOT NULL,
  `drone_wattage` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drone`
--

INSERT INTO `drone` (`drone_id`, `drone_length`, `drone_width`, `drone_height`, `drone_battery_life`, `drone_model`, `drone_wattage`) VALUES
(1, 12, 12, 12, 15000, 'Mavic Mini 2', 60),
(2, 16, 18, 18, 20000, 'Mavic Pro 2', 75),
(3, 14, 16, 16, 17500, 'Mavic Air 2', 60),
(4, 6, 6, 6, 12500, 'Parrot Anafi', 50),
(5, 10, 20, 20, 15000, 'Mavic 2 Zoom', 60),
(6, 12, 12, 12, 13000, 'Ryze Tello', 60),
(7, 18, 36, 36, 22000, 'Phantom 4 Pro V2.0', 75),
(8, 6, 6, 6, 12000, 'Inspire 2', 60);

-- --------------------------------------------------------

--
-- Table structure for table `station`
--

CREATE TABLE `station` (
  `Station_id` int(10) NOT NULL,
  `Station_height` double NOT NULL,
  `Station_width` double NOT NULL,
  `Station_length` double NOT NULL,
  `Station_available` varchar(1) NOT NULL DEFAULT 'Y',
  `Transaction_ID` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `station`
--

INSERT INTO `station` (`Station_id`, `Station_height`, `Station_width`, `Station_length`, `Station_available`, `Transaction_ID`) VALUES
(1, 18, 36, 36, 'Y', 0),
(2, 12, 12, 12, 'Y', 0),
(3, 6, 6, 6, 'Y', 0),
(4, 20, 20, 20, 'Y', 0),
(5, 12, 12, 12, 'Y', 0),
(6, 18, 36, 36, 'Y', 0),
(7, 14, 30, 30, 'Y', 0),
(8, 6, 6, 6, 'Y', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `Transaction_ID` int(32) NOT NULL,
  `Transaction_rate` double NOT NULL,
  `Transaction_time_start` timestamp NOT NULL DEFAULT current_timestamp(),
  `Transaction_pin` int(4) NOT NULL,
  `Transaction_finished` varchar(1) NOT NULL DEFAULT 'N',
  `charge_speed` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`Transaction_ID`, `Transaction_rate`, `Transaction_time_start`, `Transaction_pin`, `Transaction_finished`, `charge_speed`) VALUES
(1, 0.5, '2021-04-27 02:09:58', 1234, 'Y', 500),
(2, 0.5, '2021-05-03 17:39:32', 9999, 'Y', 500),
(3, 0.5, '2021-05-03 17:54:15', 6666, 'Y', 500),
(4, 0.5, '2021-05-04 04:21:16', 5634, 'Y', 500),
(5, 0.75, '2021-05-05 19:31:44', 2345, 'Y', 600);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_finish`
--

CREATE TABLE `transaction_finish` (
  `Transaction_ID` int(32) NOT NULL,
  `Transaction_time_start` timestamp NULL DEFAULT NULL,
  `Transaction_end` timestamp NOT NULL DEFAULT current_timestamp(),
  `Transaction_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_finish`
--

INSERT INTO `transaction_finish` (`Transaction_ID`, `Transaction_time_start`, `Transaction_end`, `Transaction_total`) VALUES
(1, '2021-04-27 02:09:58', '2021-04-30 20:40:09', 15),
(2, '2021-05-03 17:39:32', '2021-05-03 20:58:12', 17.5),
(3, '2021-05-03 17:54:15', '2021-05-03 21:05:12', 15),
(4, '2021-05-04 04:21:16', '2021-05-04 04:22:24', 0.5),
(5, '2021-05-05 19:31:44', '2021-05-05 19:33:20', 0.75);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drone`
--
ALTER TABLE `drone`
  ADD PRIMARY KEY (`drone_id`);

--
-- Indexes for table `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`Station_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`Transaction_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drone`
--
ALTER TABLE `drone`
  MODIFY `drone_id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `station`
--
ALTER TABLE `station`
  MODIFY `Station_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `Transaction_ID` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
