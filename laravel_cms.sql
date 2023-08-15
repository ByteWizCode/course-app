-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2023 at 12:44 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `CourseName` varchar(255) NOT NULL,
  `Price` float NOT NULL,
  `Days` varchar(255) NOT NULL,
  `IsCertificate` char(2) NOT NULL,
  `IsActive` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`ID`, `CourseName`, `Price`, `Days`, `IsCertificate`, `IsActive`) VALUES
(1, '15 days Mastering React Native', 150000, '15', '1', '1'),
(2, '30 days Mastering Flutter', 150000, '30', '1', '1'),
(3, 'Learn How to Customize CS-Cart & Magento', 300000, '60', '1', '1'),
(4, 'Java Springboot for Bank Company Study Case', 125000, '15', '1', '1'),
(5, 'Python for Beginner', 150000, '30', '1', '1'),
(6, 'Mastering SEO only 15 days', 100000, '15', '1', '0'),
(7, 'Design Graphics for Beginner', 100000, '15', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `detailtransactions`
--

CREATE TABLE `detailtransactions` (
  `ID` int(11) NOT NULL,
  `TransID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `InstructorID` int(11) NOT NULL,
  `StartDate` date NOT NULL,
  `Price` float NOT NULL,
  `Discount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detailtransactions`
--

INSERT INTO `detailtransactions` (`ID`, `TransID`, `CourseID`, `InstructorID`, `StartDate`, `Price`, `Discount`) VALUES
(1, 1, 1, 1, '2023-07-12', 150000, 22500),
(2, 1, 2, 2, '2023-07-12', 150000, 22500),
(3, 2, 3, 3, '2023-07-12', 300000, 30000),
(4, 3, 4, 4, '2023-08-12', 125000, 6250),
(5, 3, 5, 4, '2023-08-12', 150000, 7500),
(6, 4, 3, 4, '2023-08-12', 300000, 45000),
(7, 5, 1, 1, '2023-08-12', 150000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `InstructorName` varchar(255) NOT NULL,
  `Age` char(10) NOT NULL,
  `Gender` varchar(20) NOT NULL,
  `ExpYear` char(10) NOT NULL,
  `ExpDesc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`ID`, `InstructorName`, `Age`, `Gender`, `ExpYear`, `ExpDesc`) VALUES
(1, 'Maximilian Schwarzmuller', '30', 'Male', '10', 'React Native & Flutter Experts'),
(2, 'Jose Portilla', '33', 'Male', '7', 'Flutter Expers'),
(3, 'Yudhistira Salmanan', '25', 'Male', '3', 'CS-Cart & Magento Tutor'),
(4, 'Mohammed Singh', '38', 'Male', '11', 'CS-Cart, Magent, Java & Python Specialist'),
(5, 'Rina Indrawati', '23', 'Female', '5', 'SEO & Online Marketing Tutor');

-- --------------------------------------------------------

--
-- Table structure for table `qualifications`
--

CREATE TABLE `qualifications` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `TopicID` int(11) NOT NULL,
  `InstructorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `qualifications`
--

INSERT INTO `qualifications` (`ID`, `TopicID`, `InstructorID`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 4),
(6, 6, 5),
(7, 7, 5),
(8, 2, 1),
(9, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `ID` int(11) NOT NULL,
  `TransCode` varchar(255) NOT NULL,
  `TransDate` date NOT NULL,
  `CustName` varchar(255) NOT NULL,
  `Member` varchar(255) NOT NULL,
  `Subtotal` float NOT NULL,
  `Discount` float NOT NULL,
  `Total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`ID`, `TransCode`, `TransDate`, `CustName`, `Member`, `Subtotal`, `Discount`, `Total`) VALUES
(1, 'dKcUyozH', '2023-07-12', 'Anggita', 'platinum', 300000, 45000, 255000),
(2, '6exRT8Mf', '2023-07-12', 'Rini', 'gold', 300000, 30000, 270000),
(3, 'd17XgkSe', '2023-08-12', 'Yudi', 'silver', 275000, 13750, 261250),
(4, 'VbmB6I1Y', '2023-08-12', 'Anggita', 'platinum', 300000, 45000, 255000),
(5, 'UGTZDpEQ', '2023-08-12', 'Bili', 'non member', 150000, 0, 150000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `gender` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pria',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `member` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `gender`, `password`, `remember_token`, `role`, `member`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, 'Pria', '$2y$10$bIXFknbJf189Ilie7p57dOXZctC5mg6dBX970O5c.vBSPluB0GlX2', NULL, 'admin', 'default', NULL, NULL),
(5, 'Anggita', 'anggita@gmail.com', '2023-08-12 06:32:11', 'Wanita', '$2y$10$bIXFknbJf189Ilie7p57dOXZctC5mg6dBX970O5c.vBSPluB0GlX2', 'bHTVHGfqCoOdMgUzBNhW29qy4SNGttvTt702xJTp14qij4hyqZAMIDFRKRad', 'user', 'platinum', '2023-08-12 06:32:11', '2023-08-13 01:37:13'),
(6, 'Rini', 'rini@gmail.com', '2023-08-12 06:32:11', 'Wanita', '$2y$10$bIXFknbJf189Ilie7p57dOXZctC5mg6dBX970O5c.vBSPluB0GlX2', 'yrzB9ZyrfSLogDXZLXhVdcSo8SZ9MX1rVXq7UfjcQCuLUfMp27Jy1YAeXx1h', 'user', 'gold', '2023-08-12 06:32:11', '2023-08-12 06:32:11'),
(7, 'Yudi', 'yudi@gmail.com', '2023-08-12 06:32:11', 'Pria', '$2y$10$bIXFknbJf189Ilie7p57dOXZctC5mg6dBX970O5c.vBSPluB0GlX2', 'VcQFAI9w2o0QH1j9KcpbNEsWJMr9X7DmD51hJnMeRtyS94pt5ApnAmRl2kDw', 'user', 'silver', '2023-08-12 06:32:11', '2023-08-12 06:32:11'),
(8, 'Bili', 'bili@gmail.com', '2023-08-12 06:32:11', 'Pria', '$2y$10$bIXFknbJf189Ilie7p57dOXZctC5mg6dBX970O5c.vBSPluB0GlX2', 'gdcn2FrYJKaBgd6PI4MLo2caV1dIDTafCiwteoeHONNDkOkGhUnpJCKaiGie', 'user', 'non member', '2023-08-12 06:32:11', '2023-08-12 06:32:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `detailtransactions`
--
ALTER TABLE `detailtransactions`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `qualifications`
--
ALTER TABLE `qualifications`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `detailtransactions`
--
ALTER TABLE `detailtransactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `qualifications`
--
ALTER TABLE `qualifications`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
