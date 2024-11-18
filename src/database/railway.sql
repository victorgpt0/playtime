-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 18, 2024 at 10:40 AM
-- Server version: 10.6.7-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `railway`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bookings`
--

CREATE TABLE `tbl_bookings` (
  `booking_id` bigint(10) NOT NULL,
  `facilityId` bigint(10) NOT NULL,
  `userId` bigint(10) NOT NULL,
  `booked_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dateBooked` date NOT NULL,
  `start_time` varchar(10) NOT NULL,
  `end_time` varchar(10) NOT NULL,
  `totalprice` varchar(10) NOT NULL,
  `to_borrow` text NOT NULL,
  `paystatus_id` tinyint(1) DEFAULT NULL,
  `statusId` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bookings`
--

INSERT INTO `tbl_bookings` (`booking_id`, `facilityId`, `userId`, `booked_at`, `updated_at`, `dateBooked`, `start_time`, `end_time`, `totalprice`, `to_borrow`, `paystatus_id`, `statusId`) VALUES
(1, 1, 40, '2024-11-18 07:07:46', '2024-11-18 07:07:46', '2024-11-01', '7:00 AM', '7:00 PM', '1000.00', 'Foot', NULL, NULL),
(2, 1, 39, '2024-11-18 08:51:21', '2024-11-18 08:51:21', '2024-11-18', '7:30 AM', '9:30 AM', '7000.00', 'football', 1, 1),
(3, 1, 39, '2024-11-18 08:52:00', '2024-11-18 08:52:00', '2024-11-18', '7:30 AM', '9:30 AM', '7000.00', 'football', 1, 1),
(4, 1, 39, '2024-11-18 08:55:31', '2024-11-18 08:55:31', '2024-11-18', '7:30 AM', '9:30 AM', '7000.00', 'football', 1, 1),
(5, 1, 39, '2024-11-18 08:59:26', '2024-11-18 08:59:26', '2024-11-18', '7:30 AM', '9:30 AM', '7000.00', 'football', 1, 1),
(6, 1, 39, '2024-11-18 08:59:31', '2024-11-18 08:59:31', '2024-11-18', '7:30 AM', '9:30 AM', '7000.00', 'football', 1, 1),
(7, 1, 39, '2024-11-18 08:59:47', '2024-11-18 08:59:47', '2024-11-18', '7:30 AM', '9:30 AM', '7000.00', 'football', 1, 1),
(8, 1, 39, '2024-11-18 09:00:09', '2024-11-18 09:00:09', '2024-11-18', '7:30 AM', '9:30 AM', '7000.00', 'football', 1, 1),
(9, 1, 39, '2024-11-18 09:01:36', '2024-11-18 09:01:36', '2024-11-18', '7:30 AM', '9:30 AM', '7000.00', 'football', 1, 1),
(10, 1, 39, '2024-11-18 09:01:43', '2024-11-18 09:01:43', '2024-11-18', '7:30 AM', '9:30 AM', '7000.00', 'football', 1, 1),
(11, 1, 39, '2024-11-18 09:02:23', '2024-11-18 09:02:23', '2024-11-18', '7:30 AM', '9:30 AM', '7000.00', 'football', 1, 1),
(12, 1, 39, '2024-11-18 09:04:07', '2024-11-18 09:04:07', '2024-11-18', '7:30 AM', '9:30 AM', '7000.00', 'football', 1, 1),
(13, 1, 39, '2024-11-18 09:05:34', '2024-11-18 09:05:34', '2024-11-18', '7:30 AM', '9:30 AM', '7000.00', 'football', 1, 1),
(14, 1, 39, '2024-11-18 09:05:38', '2024-11-18 09:05:38', '2024-11-18', '7:30 AM', '9:30 AM', '7000.00', 'football', 1, 1),
(15, 1, 39, '2024-11-18 09:06:19', '2024-11-18 09:06:19', '2024-11-18', '7:30 AM', '9:30 AM', '7000.00', 'football', 1, 1),
(16, 1, 39, '2024-11-18 09:08:45', '2024-11-18 09:08:45', '2024-11-18', '7:30 AM', '9:30 AM', '7000.00', 'football', 1, 1),
(17, 1, 39, '2024-11-18 09:10:10', '2024-11-18 09:10:10', '2024-11-18', '7:30 AM', '9:30 AM', '7000.00', 'football', 1, 1),
(18, 1, 39, '2024-11-18 09:10:36', '2024-11-18 09:10:36', '2024-11-18', '7:30 AM', '9:30 AM', '7000.00', 'football', 1, 1),
(19, 1, 39, '2024-11-18 09:11:02', '2024-11-18 09:11:02', '2024-11-18', '7:30 AM', '9:30 AM', '7000.00', 'football', 1, 1),
(20, 1, 39, '2024-11-18 09:13:10', '2024-11-18 09:13:10', '2024-11-18', '7:30 AM', '9:30 AM', '7000.00', 'football', 1, 1),
(21, 1, 39, '2024-11-18 09:13:48', '2024-11-18 09:13:48', '2024-11-18', '7:30 AM', '9:30 AM', '7000.00', 'football', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_facilities`
--

CREATE TABLE `tbl_facilities` (
  `facilityId` bigint(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `place_id` varchar(255) NOT NULL,
  `price_per_hour` decimal(10,2) NOT NULL,
  `max_capacity` int(11) NOT NULL,
  `open_time` varchar(10) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `close_time` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `userid` bigint(10) NOT NULL,
  `statusId` tinyint(1) NOT NULL,
  `typeId` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_facilities`
--

INSERT INTO `tbl_facilities` (`facilityId`, `name`, `description`, `latitude`, `longitude`, `place_id`, `price_per_hour`, `max_capacity`, `open_time`, `contact`, `close_time`, `created_at`, `updated_at`, `userid`, `statusId`, `typeId`) VALUES
(1, 'SU Sports Complex Pitch A', '7-a-side Football Astro Turf', -1.30905750, 36.81283260, 'Strathmore University, Ole Sangale Road, Langata, KEN', 3500.00, 20, '7:00 AM', '0745173835', '6:00 PM', '2024-11-06 19:19:41', '2024-11-16 21:06:25', 38, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_f_types`
--

CREATE TABLE `tbl_f_types` (
  `typeId` tinyint(4) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_f_types`
--

INSERT INTO `tbl_f_types` (`typeId`, `type`) VALUES
(1, 'Football Pitch'),
(2, 'Basketball Court'),
(3, 'Rugby Pitch'),
(4, 'Tennis Court'),
(5, 'Golf Course'),
(6, 'Hockey Field'),
(7, 'Athletics Track'),
(8, 'Swimming Pool'),
(9, 'Bowling Alley'),
(10, 'Badminton Court');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gender`
--

CREATE TABLE `tbl_gender` (
  `genderId` tinyint(1) NOT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_gender`
--

INSERT INTO `tbl_gender` (`genderId`, `gender`) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pay_status`
--

CREATE TABLE `tbl_pay_status` (
  `paystaus_id` tinyint(1) NOT NULL,
  `pay_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pay_status`
--

INSERT INTO `tbl_pay_status` (`paystaus_id`, `pay_status`) VALUES
(1, 'Pending'),
(2, 'Successful');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `roleId` tinyint(1) NOT NULL,
  `roles` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`roleId`, `roles`) VALUES
(1, 'Admin'),
(2, 'Owner'),
(3, 'Staff'),
(4, 'Captain');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `statusId` tinyint(1) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`statusId`, `status`) VALUES
(1, 'Available'),
(2, 'Unavailable'),
(3, 'Pending'),
(4, 'Confirmed'),
(5, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userid` bigint(10) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp(),
  `roleId` tinyint(1) DEFAULT NULL,
  `genderId` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userid`, `fullname`, `email`, `phone_number`, `username`, `password`, `created`, `updated`, `roleId`, `genderId`) VALUES
(10, 'The Cherry Archives', 'thecherryarchives@gmail.com', '', 'fierce_257', '', '2024-10-18 13:12:24', '2024-10-18 13:12:24', NULL, NULL),
(20, 'Victor Gichuru', 'victor.gichuru@strathmore.edu', '', 'zephyr_558', '', '2024-11-02 20:59:36', '2024-11-02 20:59:36', 2, NULL),
(34, 'Iano Mdnd', 'iano@gmail.com', '', ' iano', '$2y$10$wpoK3S/vzFkrftexHvO1UeMhhC4rfutDv1KvdM1v0VTNb4UYhDIWW', '2024-11-02 21:35:07', '2024-11-02 21:35:07', 2, 1),
(35, 'Pirched Jdjj', 'vgichuru129@gmail.com', '', 'pirched', '$2y$10$kiN9kFNfDvaH6FeRKyzXg.dFvPj.ziqj4SsFURrrFtvkIwRhA18uO', '2024-11-04 20:50:28', '2024-11-04 20:50:28', 4, 1),
(36, 'Ivan Musila', 'i@gmail.com', '', 'ivann', '$2y$10$Ak1.Yes26gKMyhd8bIyVouGrK3BrIlAJG07iw/jdNCINicqXoHAOa', '2024-11-05 10:31:27', '2024-11-05 10:31:27', 4, 1),
(37, 'Ian Omondi', 'ian@gmail.com', '', 'ian', '$2y$10$inIyXnyX7Tu7CM8ZDyd3YelNFp64BdOzgSmt6RPd573gutfkk7Aa6', '2024-11-05 11:02:10', '2024-11-05 11:02:10', 2, 1),
(38, 'Owner ', 'owner@gmail.com', '', 'owner', '$2y$10$auftHaBy9Hv0fDw5K./EOeCfVJ7E5MALs8ew3IvyRKoB4c1hJZovm', '2024-11-05 14:07:50', '2024-11-05 14:07:50', 2, 1),
(39, 'Captain ', 'captain@gmail.com', '', 'captain', '$2y$10$hp2funbvgVlhngu5L0P11umHnaaaNHFoWYc6hMkF.VaJXMB2OZ1Xm', '2024-11-10 14:31:26', '2024-11-10 14:31:26', 4, 1),
(40, 'Captain ', 'captain2@gmail.com', '', 'captain2', '$2y$10$sMQzpP.YPfi7ygzAdAAWA.j.dwDlbjSyY3He.dYTCM2a4aKURjrZu', '2024-11-15 11:13:58', '2024-11-15 11:13:58', 4, 1),
(41, 'Captain ', 'captain3@gmail.com', '', 'captain3', '$2y$10$.0DE4311H7KGH4bcta/LYua8LAowOx3l8ylLgVfTPliR2cUl4WFbO', '2024-11-18 11:26:38', '2024-11-18 11:26:38', 4, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bookings`
--
ALTER TABLE `tbl_bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `paystatus` (`paystatus_id`),
  ADD KEY `user` (`userId`),
  ADD KEY `facility` (`facilityId`),
  ADD KEY `statusid` (`statusId`);

--
-- Indexes for table `tbl_facilities`
--
ALTER TABLE `tbl_facilities`
  ADD PRIMARY KEY (`facilityId`),
  ADD KEY `owner` (`userid`),
  ADD KEY `status` (`statusId`),
  ADD KEY `type` (`typeId`);

--
-- Indexes for table `tbl_f_types`
--
ALTER TABLE `tbl_f_types`
  ADD PRIMARY KEY (`typeId`);

--
-- Indexes for table `tbl_gender`
--
ALTER TABLE `tbl_gender`
  ADD PRIMARY KEY (`genderId`);

--
-- Indexes for table `tbl_pay_status`
--
ALTER TABLE `tbl_pay_status`
  ADD PRIMARY KEY (`paystaus_id`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`statusId`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `genderId` (`genderId`),
  ADD KEY `roleId` (`roleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bookings`
--
ALTER TABLE `tbl_bookings`
  MODIFY `booking_id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_facilities`
--
ALTER TABLE `tbl_facilities`
  MODIFY `facilityId` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_f_types`
--
ALTER TABLE `tbl_f_types`
  MODIFY `typeId` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_gender`
--
ALTER TABLE `tbl_gender`
  MODIFY `genderId` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_pay_status`
--
ALTER TABLE `tbl_pay_status`
  MODIFY `paystaus_id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `roleId` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userid` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_bookings`
--
ALTER TABLE `tbl_bookings`
  ADD CONSTRAINT `facility` FOREIGN KEY (`facilityId`) REFERENCES `tbl_facilities` (`facilityId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `paystatus` FOREIGN KEY (`paystatus_id`) REFERENCES `tbl_pay_status` (`paystaus_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `statusid` FOREIGN KEY (`statusId`) REFERENCES `tbl_status` (`statusId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user` FOREIGN KEY (`userId`) REFERENCES `tbl_users` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_facilities`
--
ALTER TABLE `tbl_facilities`
  ADD CONSTRAINT `owner` FOREIGN KEY (`userid`) REFERENCES `tbl_users` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `status` FOREIGN KEY (`statusId`) REFERENCES `tbl_status` (`statusId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `type` FOREIGN KEY (`typeId`) REFERENCES `tbl_f_types` (`typeId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD CONSTRAINT `tbl_users_ibfk_1` FOREIGN KEY (`genderId`) REFERENCES `tbl_gender` (`genderId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_users_ibfk_2` FOREIGN KEY (`roleId`) REFERENCES `tbl_role` (`roleId`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
