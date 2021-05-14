-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2021 at 10:46 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dronecharge`
--

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE `action` (
  `Drone_id` int(10) NOT NULL,
  `Station_id` int(10) NOT NULL,
  `Transaction_id` int(10) NOT NULL,
  `payment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`Drone_id`, `Station_id`, `Transaction_id`, `payment_id`) VALUES
(1, 1, 1, 1),
(3, 4, 2, 2),
(1, 2, 3, 3),
(1, 7, 4, 4),
(8, 1, 5, 5),
(1, 2, 6, 6),
(6, 5, 7, 7),
(1, 1, 8, 8),
(3, 1, 9, 9),
(8, 2, 10, 10),
(7, 6, 11, 11),
(7, 1, 12, 12),
(4, 3, 13, 13),
(2, 4, 14, 14),
(3, 4, 15, 15),
(5, 4, 16, 16),
(1, 4, 17, 0),
(1, 5, 18, 0);

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
(7, 36, 36, 18, 22000, 'Phantom 4 Pro V2.0', 75),
(8, 6, 6, 6, 12000, 'Inspire 2', 60);

-- --------------------------------------------------------

--
-- Table structure for table `payment_info`
--

CREATE TABLE `payment_info` (
  `payment_id` int(11) NOT NULL,
  `card_number` varchar(16) DEFAULT NULL,
  `expiration_date` date NOT NULL,
  `cvv` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_info`
--

INSERT INTO `payment_info` (`payment_id`, `card_number`, `expiration_date`, `cvv`) VALUES
(1, '1234123412341234', '2021-12-01', '123'),
(2, '1023012301230123', '2022-06-01', '420'),
(3, '1111111111111111', '2025-05-01', '649'),
(4, '0000000000000000', '2028-07-01', '460'),
(5, '1111222233334444', '2023-12-01', '612'),
(6, '2222333344445555', '2028-09-01', '232'),
(7, '5678567856785678', '2030-03-01', '531'),
(8, '7690769076907690', '2025-07-01', '902'),
(9, '5824582458245824', '2027-09-01', '384'),
(10, '3920392039203920', '2026-06-01', '666'),
(11, '4321432143214321', '2023-01-01', '810'),
(12, '7489748974897489', '2026-01-01', '244'),
(13, '5457545754575457', '2028-03-01', '930'),
(14, '6882688268826882', '2022-10-01', '962'),
(15, '4356435643564356', '2026-05-01', '141'),
(16, '3507350735073507', '2026-06-01', '510');

-- --------------------------------------------------------

--
-- Table structure for table `station`
--

CREATE TABLE `station` (
  `Station_id` int(10) NOT NULL,
  `Station_height` double NOT NULL,
  `Station_width` double NOT NULL,
  `Station_length` double NOT NULL,
  `Station_available` varchar(1) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `station`
--

INSERT INTO `station` (`Station_id`, `Station_height`, `Station_width`, `Station_length`, `Station_available`) VALUES
(1, 18, 36, 36, 'Y'),
(2, 12, 12, 12, 'Y'),
(3, 6, 6, 6, 'Y'),
(4, 20, 20, 20, 'Y'),
(5, 12, 12, 12, 'N'),
(6, 18, 36, 36, 'Y'),
(7, 14, 30, 30, 'Y'),
(8, 6, 6, 6, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `Transaction_ID` int(32) NOT NULL,
  `Transaction_rate` double NOT NULL,
  `Transaction_time_start` timestamp NOT NULL DEFAULT current_timestamp(),
  `Transaction_pin` varchar(4) NOT NULL,
  `Transaction_finished` varchar(1) NOT NULL DEFAULT 'N',
  `charge_speed` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`Transaction_ID`, `Transaction_rate`, `Transaction_time_start`, `Transaction_pin`, `Transaction_finished`, `charge_speed`) VALUES
(1, 0.5, '2021-04-26 22:09:58', '1234', 'Y', 500),
(2, 0.5, '2021-05-03 13:39:32', '9999', 'Y', 500),
(3, 0.5, '2021-05-03 13:54:15', '6666', 'Y', 500),
(4, 0.5, '2021-05-04 00:21:16', '5634', 'Y', 500),
(5, 0.75, '2021-05-05 15:31:44', '2345', 'Y', 600),
(6, 0.5, '2021-05-08 17:10:00', '4444', 'Y', 500),
(7, 0.75, '2021-05-11 19:32:28', '0000', 'Y', 600),
(8, 0.75, '2021-05-11 20:00:35', '0000', 'Y', 600),
(9, 0.5, '2021-05-11 20:08:18', '5555', 'Y', 500),
(10, 0.5, '2021-05-11 20:08:39', '6666', 'Y', 500),
(11, 0.75, '2021-05-13 15:05:51', '4567', 'Y', 600),
(12, 0.75, '2021-05-13 15:05:59', '3456', 'Y', 600),
(13, 0.5, '2021-05-13 15:07:38', '9999', 'Y', 500),
(14, 0.75, '2021-05-13 15:15:52', '1111', 'Y', 600),
(15, 0.75, '2021-05-13 15:38:37', '2508', 'Y', 600),
(16, 0.5, '2021-05-13 20:07:06', '7890', 'Y', 500),
(17, 0.5, '2021-05-14 16:32:27', '0000', 'Y', 500),
(18, 0.5, '2021-05-14 16:33:49', '5555', 'N', 500);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_finish`
--

CREATE TABLE `transaction_finish` (
  `Transaction_ID` int(32) NOT NULL,
  `Transaction_end` timestamp NOT NULL DEFAULT current_timestamp(),
  `Transaction_total` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_finish`
--

INSERT INTO `transaction_finish` (`Transaction_ID`, `Transaction_end`, `Transaction_total`) VALUES
(1, '2021-04-30 16:40:09', 15),
(2, '2021-05-03 16:58:12', 17.5),
(3, '2021-05-03 17:05:12', 15),
(4, '2021-05-04 00:22:24', 0.5),
(5, '2021-05-05 15:33:20', 0.75),
(6, '2021-05-08 17:10:13', 0),
(7, '2021-05-11 19:34:47', 1.5),
(8, '2021-05-11 20:01:04', 0),
(9, '2021-05-11 20:24:45', 8),
(10, '2021-05-11 21:52:43', 12),
(12, '2021-05-13 15:13:49', 5.25),
(14, '2021-05-13 15:17:53', 1.5),
(13, '2021-05-13 15:19:33', 5.5),
(15, '2021-05-13 15:38:43', 0),
(11, '2021-05-13 20:51:13', 27.5),
(16, '2021-05-13 20:52:14', 15),
(17, '2021-05-14 16:32:32', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drone`
--
ALTER TABLE `drone`
  ADD PRIMARY KEY (`drone_id`);

--
-- Indexes for table `payment_info`
--
ALTER TABLE `payment_info`
  ADD PRIMARY KEY (`payment_id`);

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
-- AUTO_INCREMENT for table `payment_info`
--
ALTER TABLE `payment_info`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `station`
--
ALTER TABLE `station`
  MODIFY `Station_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `Transaction_ID` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
