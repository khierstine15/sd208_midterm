-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2023 at 05:56 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_users`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `activity_id` int(11) NOT NULL,
  `activityName` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `dateOfActivity` date NOT NULL,
  `timeOfActivity` time NOT NULL,
  `image` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `remarks` varchar(300) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`activity_id`, `activityName`, `location`, `dateOfActivity`, `timeOfActivity`, `image`, `Status`, `remarks`, `userId`) VALUES
(2, 'kaon', 'new era', '2023-01-24', '05:19:00', 'nega bg.jpg', '', '', 0),
(3, 'gutom na', 'haha', '2023-10-26', '02:29:00', 'Overcoming fear1.jpg', '', '', 2),
(4, 'yati ra', 'new era', '2023-10-25', '21:58:00', 'darkforest.jpg', 'Done', '  kapiuy', 3),
(5, 'dsfs', 'dfgdf', '2023-10-26', '14:32:00', 'istock girl.jpg', 'Cancelled', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `activity_user`
--

CREATE TABLE `activity_user` (
  `id` int(11) NOT NULL,
  `activityName` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `dateOfActivity` date DEFAULT NULL,
  `timeOfActivity` time DEFAULT NULL,
  `image` blob DEFAULT NULL,
  `userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `announcement_title` varchar(255) NOT NULL,
  `announcement` varchar(500) NOT NULL,
  `announcement_created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announcement_title`, `announcement`, `announcement_created_at`) VALUES
('kapoy ', 'kapy\r\n', '2023-10-23 13:27:24'),
('fsdf', 'ddfgsf', '2023-10-23 13:45:14'),
('fsdf', 'ddfgsf', '2023-10-23 13:50:04'),
('fsdf', 'ddfgsf', '2023-10-23 13:50:12');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `Firstname` varchar(100) NOT NULL,
  `Lastname` varchar(100) NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Role` varchar(50) NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Firstname`, `Lastname`, `Gender`, `Address`, `Email`, `Password`, `Role`, `Status`) VALUES
(1, 'Clark', 'Anore', 'Male', 'Male', 'clark@gmail.com', 'cl@rk', 'user', 'Active'),
(2, 'Paul', 'Elizalde ', 'Female', 'Male', 'paul@gmail.com', 'paul', 'admin', 'Active'),
(3, 'paul', 'henry', 'Male', 'bantayan', 'henry@gmail.com', '123', 'user', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `activity_user`
--
ALTER TABLE `activity_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `activity_user`
--
ALTER TABLE `activity_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
