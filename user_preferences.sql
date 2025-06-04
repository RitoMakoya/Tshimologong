-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2025 at 01:08 PM
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
-- Database: `user_preferences`
--

-- --------------------------------------------------------

--
-- Table structure for table `survey_summary`
--

CREATE TABLE `survey_summary` (
  `total_surveys` int(11) NOT NULL,
  `average_age` decimal(5,2) NOT NULL,
  `oldest_age` int(11) NOT NULL,
  `youngest_age` int(11) NOT NULL,
  `pizza_pct` decimal(5,2) NOT NULL,
  `pasta_pct` decimal(5,2) NOT NULL,
  `pap_wors_pct` decimal(5,2) NOT NULL,
  `movies_like` int(11) NOT NULL,
  `radio_like` int(11) NOT NULL,
  `eat_out_like` int(11) NOT NULL,
  `tv_like` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey_summary`
--

INSERT INTO `survey_summary` (`total_surveys`, `average_age`, `oldest_age`, `youngest_age`, `pizza_pct`, `pasta_pct`, `pap_wors_pct`, `movies_like`, `radio_like`, `eat_out_like`, `tv_like`) VALUES
(3, 23.00, 26, 21, 33.30, 33.30, 33.30, 0, 0, 0, 0),
(3, 23.00, 26, 21, 33.30, 33.30, 33.30, 0, 0, 0, 0),
(0, 23.00, 26, 21, 33.30, 33.30, 33.30, 0, 0, 0, 0),
(0, 23.00, 26, 21, 33.30, 33.30, 33.30, 0, 0, 0, 0),
(0, 23.00, 26, 21, 33.30, 33.30, 33.30, 0, 0, 0, 0),
(0, 23.00, 26, 21, 33.30, 33.30, 33.30, 0, 0, 0, 0),
(0, 23.00, 26, 21, 33.30, 33.30, 33.30, 0, 0, 0, 0),
(0, 23.00, 26, 21, 33.30, 33.30, 33.30, 0, 0, 0, 0),
(0, 23.00, 26, 21, 33.30, 33.30, 33.30, 0, 0, 0, 0),
(0, 23.00, 26, 21, 33.30, 33.30, 33.30, 0, 0, 0, 0),
(0, 23.00, 26, 21, 33.30, 33.30, 33.30, 0, 0, 0, 0),
(0, 23.00, 26, 21, 33.30, 33.30, 33.30, 0, 0, 0, 0),
(0, 28.50, 45, 21, 50.00, 25.00, 25.00, 0, 0, 0, 0),
(0, 28.50, 45, 21, 50.00, 25.00, 25.00, 0, 0, 0, 0),
(0, 28.50, 45, 21, 50.00, 25.00, 25.00, 0, 0, 0, 0),
(0, 28.50, 45, 21, 50.00, 25.00, 25.00, 0, 0, 0, 0),
(0, 28.50, 45, 21, 50.00, 25.00, 25.00, 0, 0, 0, 0),
(0, 28.50, 45, 21, 50.00, 25.00, 25.00, 0, 0, 0, 0),
(0, 28.50, 45, 21, 50.00, 25.00, 25.00, 0, 0, 0, 0),
(0, 28.50, 45, 21, 50.00, 25.00, 25.00, 0, 0, 0, 0),
(10, 27.60, 48, 18, 30.00, 20.00, 40.00, 100, 100, 100, 100),
(10, 27.60, 48, 18, 30.00, 20.00, 40.00, 100, 100, 100, 100),
(10, 27.60, 48, 18, 30.00, 20.00, 40.00, 100, 100, 100, 100),
(10, 27.60, 48, 18, 30.00, 20.00, 40.00, 100, 100, 100, 100),
(10, 27.60, 48, 18, 30.00, 20.00, 40.00, 100, 100, 100, 100),
(10, 27.60, 48, 18, 30.00, 20.00, 40.00, 100, 100, 100, 100),
(10, 27.60, 48, 18, 30.00, 20.00, 40.00, 100, 100, 100, 100),
(10, 27.60, 48, 18, 30.00, 20.00, 40.00, 100, 100, 100, 100),
(10, 27.60, 48, 18, 30.00, 20.00, 40.00, 100, 100, 100, 100),
(10, 27.60, 48, 18, 30.00, 20.00, 40.00, 100, 100, 100, 100),
(11, 27.60, 48, 18, 27.30, 18.20, 36.40, 100, 100, 100, 100),
(11, 27.60, 48, 18, 27.30, 18.20, 36.40, 100, 100, 100, 100);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `full_names` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `favorite_food` text NOT NULL,
  `watch_movies` decimal(5,2) NOT NULL,
  `listen_radio` decimal(5,2) NOT NULL,
  `eat_out` decimal(5,2) NOT NULL,
  `watch_tv` decimal(5,2) NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_names`, `email`, `dob`, `contact_number`, `favorite_food`, `watch_movies`, `listen_radio`, `eat_out`, `watch_tv`, `submitted_at`) VALUES
(1, 'RITO', 'ritondobe@gmail.com', '1998-08-22', '0785829649', 'pizza', 0.00, 0.00, 0.00, 0.00, '2025-06-04 07:34:16'),
(2, 'Nkateko Manganyi', 'nkatekomanganyi@gmail.com', '2002-07-09', '0731192250', 'pap-wors', 0.00, 0.00, 0.00, 0.00, '2025-06-04 07:47:59'),
(3, 'Millicent', 'millicent02@gmail.com', '2004-03-25', '0602591730', 'pasta', 0.00, 0.00, 0.00, 0.00, '2025-06-04 07:52:36'),
(4, 'Makoya', 'Makoya@ntidgroup.co.za', '1979-12-12', '0633326064', 'pizza', 0.00, 0.00, 0.00, 0.00, '2025-06-04 10:03:28'),
(5, 'Lerato', 'leratomoahi198@gmail.com', '1988-05-22', '0782541234', 'pasta', 0.00, 0.00, 0.00, 0.00, '2025-06-04 10:35:18'),
(6, 'John Maputla', 'maputlajohn@skeemsaam.co.za', '1977-02-18', '0112786090', 'pizza', 0.00, 0.00, 0.00, 0.00, '2025-06-04 10:37:37'),
(7, 'Mbuso Mahlangu', 'mahlangumbuso@gmail.com', '2001-11-23', '0603641575', 'pap-wors', 0.00, 0.00, 0.00, 0.00, '2025-06-04 10:45:22'),
(8, 'Lerato', 'leratomoahi198@gmail.com', '2006-10-10', '0782541234', '', 0.00, 0.00, 0.00, 0.00, '2025-06-04 10:46:38'),
(9, 'Lerato', 'leratomoahi198@gmail.com', '2006-12-13', '0782541234', 'pap-wors', 0.00, 0.00, 0.00, 0.00, '2025-06-04 10:52:26'),
(10, 'Lerato', 'leratomoahi198@gmail.com', '2006-12-13', '0782541234', 'pap-wors', 0.00, 0.00, 0.00, 0.00, '2025-06-04 10:54:36'),
(11, 'Tshepo Luthuli', 'luthulitshepo@gmail.com', '1997-02-28', '0785417894', '', 0.00, 0.00, 0.00, 0.00, '2025-06-04 11:05:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
