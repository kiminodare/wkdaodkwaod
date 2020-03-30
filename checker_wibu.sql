-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 30, 2020 at 06:19 AM
-- Server version: 5.7.29
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `checker_wibu`
--

-- --------------------------------------------------------

--
-- Table structure for table `log_activity`
--

CREATE TABLE `log_activity` (
  `id` int(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `history` varchar(255) NOT NULL,
  `id_user` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_activity`
--

INSERT INTO `log_activity` (`id`, `ip`, `date`, `history`, `id_user`) VALUES
(1, '118.136.49.60', '2020-03-29 23:42:33', 'Login Sukses dari kiminodare', NULL),
(2, '118.136.49.60', '2020-03-29 23:53:47', 'Login Sukses dari kiminodare', NULL),
(3, '118.136.49.60', '2020-03-29 23:54:24', 'Login Sukses dari kiminodare', NULL),
(4, '118.136.49.60', '2020-03-29 23:55:20', 'Login Sukses dari kiminodare', NULL),
(5, '118.136.49.60', '2020-03-29 23:57:10', 'Login Sukses dari kiminodare', NULL),
(6, '118.136.49.60', '2020-03-30 00:00:04', 'Login Sukses dari trial', NULL),
(7, '118.136.49.60', '2020-03-30 00:00:40', 'Login Sukses dari trial', NULL),
(8, '118.136.49.60', '2020-03-30 00:01:02', 'Login Sukses dari trial', NULL),
(9, '125.162.10.73', '2020-03-30 00:05:45', 'Login Sukses dari demo', NULL),
(10, '110.138.148.17', '2020-03-30 00:06:25', 'Login Sukses dari Demo', NULL),
(11, '139.194.116.111', '2020-03-30 00:11:00', 'Login Sukses dari demo', NULL),
(12, '118.136.49.60', '2020-03-30 00:15:19', 'Login Sukses dari kiminodare', NULL),
(13, '114.124.176.250', '2020-03-30 00:18:58', 'Login Sukses dari Demo', NULL),
(14, '', '', '', NULL),
(15, '118.136.49.60', '2020-03-30 00:22:45', 'Cre Live digunakan kiminodare', NULL),
(16, '118.136.49.60', '2020-03-30 00:22:45', 'Cre Live digunakan kiminodare', NULL),
(17, '118.136.49.60', '2020-03-30 00:22:47', 'Cre Live digunakan kiminodare', NULL),
(18, '', '', '', NULL),
(19, '139.194.116.111', '2020-03-30 00:23:37', 'Cre Live digunakan demo', NULL),
(20, '', '', '', NULL),
(21, '139.194.116.111', '2020-03-30 00:24:58', 'Cre Live digunakan demo', NULL),
(22, '', '', '', NULL),
(23, '139.194.116.111', '2020-03-30 00:25:03', 'Cre Live digunakan demo', NULL),
(24, '180.244.232.58', '2020-03-30 00:25:05', 'Login Sukses dari Demo', NULL),
(25, '', '', '', NULL),
(26, '139.194.116.111', '2020-03-30 00:25:14', 'Cre Live digunakan demo', NULL),
(27, '', '', '', NULL),
(28, '139.194.116.111', '2020-03-30 00:25:51', 'Cre Live digunakan demo', NULL),
(29, '', '', '', NULL),
(30, '139.194.116.111', '2020-03-30 00:27:50', 'Cre Die digunakan demo', NULL),
(31, '', '', '', NULL),
(32, '139.194.116.111', '2020-03-30 00:27:56', 'Cre Die digunakan demo', NULL),
(33, '', '', '', NULL),
(34, '139.194.116.111', '2020-03-30 00:28:03', 'Cre Live digunakan demo', NULL),
(35, '36.79.97.71', '2020-03-30 00:30:53', 'Login Sukses dari Demo', NULL),
(36, '', '', '', NULL),
(37, '139.194.116.111', '2020-03-30 00:32:45', 'Cre Die digunakan demo', NULL),
(38, '', '', '', NULL),
(39, '139.194.116.111', '2020-03-30 00:32:56', 'Cre Die digunakan demo', NULL),
(40, '139.194.116.111', '2020-03-30 00:33:22', 'Login Sukses dari trial', NULL),
(41, '', '', '', NULL),
(42, '139.194.116.111', '2020-03-30 00:34:46', 'Cre Die digunakan trial', NULL),
(43, '139.194.116.111', '2020-03-30 00:34:46', 'Cre Die digunakan trial', NULL),
(44, '139.194.116.111', '2020-03-30 00:34:48', 'Cre Die digunakan trial', NULL),
(45, '', '', '', NULL),
(46, '118.136.49.60', '2020-03-30 00:35:21', 'Cre Die digunakan kiminodare', NULL),
(47, '118.136.49.60', '2020-03-30 00:35:21', 'Cre Die digunakan kiminodare', NULL),
(48, '118.136.49.60', '2020-03-30 00:35:23', 'Cre Live digunakan kiminodare', NULL),
(49, '', '', '', NULL),
(50, '118.136.49.60', '2020-03-30 00:35:39', 'Cre Die digunakan kiminodare', NULL),
(51, '118.136.49.60', '2020-03-30 00:35:39', 'Cre Die digunakan kiminodare', NULL),
(52, '118.136.49.60', '2020-03-30 00:35:40', 'Cre Live digunakan kiminodare', NULL),
(53, '', '', '', NULL),
(54, '139.194.116.111', '2020-03-30 00:36:06', 'Cre Die digunakan trial', NULL),
(55, '139.194.116.111', '2020-03-30 00:36:06', 'Cre Die digunakan trial', NULL),
(56, '139.194.116.111', '2020-03-30 00:36:08', 'Cre Die digunakan trial', NULL),
(57, '139.194.116.111', '2020-03-30 00:36:08', 'Cre Die digunakan trial', NULL),
(58, '139.194.116.111', '2020-03-30 00:36:09', 'Cre Die digunakan trial', NULL),
(59, '139.194.116.111', '2020-03-30 00:36:09', 'Cre Die digunakan trial', NULL),
(60, '139.194.116.111', '2020-03-30 00:36:10', 'Cre Die digunakan trial', NULL),
(61, '', '', '', NULL),
(62, '139.194.116.111', '2020-03-30 00:40:39', 'Cre Die digunakan trial', NULL),
(63, '139.194.116.111', '2020-03-30 00:40:39', 'Cre Die digunakan trial', NULL),
(64, '139.194.116.111', '2020-03-30 00:40:40', 'Cre Die digunakan trial', NULL),
(65, '139.194.116.111', '2020-03-30 00:40:40', 'Cre Die digunakan trial', NULL),
(66, '139.194.116.111', '2020-03-30 00:40:42', 'Cre Die digunakan trial', NULL),
(67, '139.194.116.111', '2020-03-30 00:40:42', 'Cre Die digunakan trial', NULL),
(68, '139.194.116.111', '2020-03-30 00:40:42', 'Cre Die digunakan trial', NULL),
(69, '', '', '', NULL),
(70, '139.194.116.111', '2020-03-30 00:40:43', 'Cre Die digunakan trial', NULL),
(71, '139.194.116.111', '2020-03-30 00:40:43', 'Cre Die digunakan trial', NULL),
(72, '139.194.116.111', '2020-03-30 00:40:45', 'Cre Die digunakan trial', NULL),
(73, '139.194.116.111', '2020-03-30 00:40:45', 'Cre Die digunakan trial', NULL),
(74, '139.194.116.111', '2020-03-30 00:40:45', 'Cre Die digunakan trial', NULL),
(75, '139.194.116.111', '2020-03-30 00:40:45', 'Cre Die digunakan trial', NULL),
(76, '139.194.116.111', '2020-03-30 00:40:46', 'Cre Die digunakan trial', NULL),
(77, '', '', '', NULL),
(78, '139.194.116.111', '2020-03-30 00:40:47', 'Cre Die digunakan trial', NULL),
(79, '139.194.116.111', '2020-03-30 00:40:47', 'Cre Die digunakan trial', NULL),
(80, '139.194.116.111', '2020-03-30 00:40:48', 'Cre Die digunakan trial', NULL),
(81, '139.194.116.111', '2020-03-30 00:40:48', 'Cre Die digunakan trial', NULL),
(82, '139.194.116.111', '2020-03-30 00:40:49', 'Cre Die digunakan trial', NULL),
(83, '139.194.116.111', '2020-03-30 00:40:49', 'Cre Die digunakan trial', NULL),
(84, '139.194.116.111', '2020-03-30 00:40:50', 'Cre Die digunakan trial', NULL),
(85, '', '', '', NULL),
(86, '139.194.116.111', '2020-03-30 00:40:51', 'Cre Die digunakan trial', NULL),
(87, '139.194.116.111', '2020-03-30 00:40:51', 'Cre Die digunakan trial', NULL),
(88, '139.194.116.111', '2020-03-30 00:40:53', 'Cre Die digunakan trial', NULL),
(89, '139.194.116.111', '2020-03-30 00:40:53', 'Cre Die digunakan trial', NULL),
(90, '139.194.116.111', '2020-03-30 00:40:55', 'Cre Die digunakan trial', NULL),
(91, '139.194.116.111', '2020-03-30 00:40:55', 'Cre Die digunakan trial', NULL),
(92, '139.194.116.111', '2020-03-30 00:40:55', 'Cre Die digunakan trial', NULL),
(93, '', '', '', NULL),
(94, '139.194.116.111', '2020-03-30 00:40:56', 'Cre Die digunakan trial', NULL),
(95, '139.194.116.111', '2020-03-30 00:40:56', 'Cre Die digunakan trial', NULL),
(96, '139.194.116.111', '2020-03-30 00:40:57', 'Cre Die digunakan trial', NULL),
(97, '139.194.116.111', '2020-03-30 00:40:57', 'Cre Die digunakan trial', NULL),
(98, '139.194.116.111', '2020-03-30 00:40:58', 'Cre Die digunakan trial', NULL),
(99, '139.194.116.111', '2020-03-30 00:40:58', 'Cre Die digunakan trial', NULL),
(100, '139.194.116.111', '2020-03-30 00:40:59', 'Cre Die digunakan trial', NULL),
(101, '', '', '', NULL),
(102, '139.194.116.111', '2020-03-30 00:41:00', 'Cre Die digunakan trial', NULL),
(103, '139.194.116.111', '2020-03-30 00:41:00', 'Cre Die digunakan trial', NULL),
(104, '139.194.116.111', '2020-03-30 00:41:00', 'Cre Die digunakan trial', NULL),
(105, '139.194.116.111', '2020-03-30 00:41:00', 'Cre Die digunakan trial', NULL),
(106, '139.194.116.111', '2020-03-30 00:41:02', 'Cre Die digunakan trial', NULL),
(107, '139.194.116.111', '2020-03-30 00:41:02', 'Cre Die digunakan trial', NULL),
(108, '139.194.116.111', '2020-03-30 00:41:02', 'Cre Die digunakan trial', NULL),
(109, '', '', '', NULL),
(110, '139.194.116.111', '2020-03-30 00:41:03', 'Cre Die digunakan trial', NULL),
(111, '139.194.116.111', '2020-03-30 00:41:03', 'Cre Die digunakan trial', NULL),
(112, '139.194.116.111', '2020-03-30 00:41:04', 'Cre Die digunakan trial', NULL),
(113, '139.194.116.111', '2020-03-30 00:41:04', 'Cre Die digunakan trial', NULL),
(114, '139.194.116.111', '2020-03-30 00:41:04', 'Cre Die digunakan trial', NULL),
(115, '139.194.116.111', '2020-03-30 00:41:04', 'Cre Die digunakan trial', NULL),
(116, '139.194.116.111', '2020-03-30 00:41:05', 'Cre Die digunakan trial', NULL),
(117, '118.136.49.60', '2020-03-30 00:41:25', 'Login Sukses dari demo', NULL),
(118, '118.136.49.60', '2020-03-30 00:44:11', 'Login Sukses dari trial', NULL),
(119, '', '', '', NULL),
(120, '118.136.49.60', '2020-03-30 00:44:17', 'Cre Die digunakan trial', NULL),
(121, '', '', '', NULL),
(122, '118.136.49.60', '2020-03-30 00:44:27', 'Cre Die digunakan trial', NULL),
(123, '', '', '', NULL),
(124, '118.136.49.60', '2020-03-30 00:44:33', 'Cre Die digunakan trial', NULL),
(125, '', '', '', NULL),
(126, '118.136.49.60', '2020-03-30 00:45:00', 'Cre Die digunakan trial', NULL),
(127, '114.124.133.176', '2020-03-30 00:49:38', 'Login Sukses dari demo', NULL),
(128, '110.138.150.82', '2020-03-30 01:24:36', 'Login Sukses dari demo', NULL),
(129, '114.79.54.236', '2020-03-30 01:55:52', 'Login Sukses dari demo', NULL),
(130, '114.79.54.236', '2020-03-30 01:56:29', 'Login Sukses dari demo', NULL),
(131, '125.166.15.26', '2020-03-30 02:06:07', 'Login Sukses dari demo', NULL),
(132, '125.166.15.26', '2020-03-30 02:06:37', 'Login Sukses dari demo', NULL),
(133, '125.166.15.26', '2020-03-30 02:09:11', 'Login Sukses dari demo', NULL),
(134, '103.120.168.12', '2020-03-30 02:57:02', 'Login Sukses dari Demo', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `phpcg_users`
--

CREATE TABLE `phpcg_users` (
  `ID` int(10) UNSIGNED NOT NULL,
  `profiles_ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile_phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT 'Boolean'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phpcg_users`
--

INSERT INTO `phpcg_users` (`ID`, `profiles_ID`, `name`, `firstname`, `address`, `city`, `zip_code`, `email`, `phone`, `mobile_phone`, `password`, `active`) VALUES
(1, 1, 'kimi', 'kimi', NULL, NULL, NULL, 'gigolo3nd@gmail.com', NULL, NULL, '$2y$10$Sc8XJIQvSM7Djnq2fVwLWezSjrZJLmsf.p4tw2iaEsmAHvZjMydSS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `phpcg_users_profiles`
--

CREATE TABLE `phpcg_users_profiles` (
  `ID` int(11) NOT NULL,
  `profile_name` varchar(100) NOT NULL,
  `read_log_activity` tinyint(1) NOT NULL DEFAULT '0',
  `update_log_activity` tinyint(1) NOT NULL DEFAULT '0',
  `create_delete_log_activity` tinyint(1) NOT NULL DEFAULT '0',
  `constraint_query_log_activity` varchar(255) DEFAULT NULL,
  `read_user` tinyint(1) NOT NULL DEFAULT '0',
  `update_user` tinyint(1) NOT NULL DEFAULT '0',
  `create_delete_user` tinyint(1) NOT NULL DEFAULT '0',
  `constraint_query_user` varchar(255) DEFAULT NULL,
  `read_phpcg_users` tinyint(1) NOT NULL DEFAULT '0',
  `update_phpcg_users` tinyint(1) NOT NULL DEFAULT '0',
  `create_delete_phpcg_users` tinyint(1) NOT NULL DEFAULT '0',
  `constraint_query_phpcg_users` varchar(255) DEFAULT NULL,
  `read_phpcg_users_profiles` tinyint(1) NOT NULL DEFAULT '0',
  `update_phpcg_users_profiles` tinyint(1) NOT NULL DEFAULT '0',
  `create_delete_phpcg_users_profiles` tinyint(1) NOT NULL DEFAULT '0',
  `constraint_query_phpcg_users_profiles` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phpcg_users_profiles`
--

INSERT INTO `phpcg_users_profiles` (`ID`, `profile_name`, `read_log_activity`, `update_log_activity`, `create_delete_log_activity`, `constraint_query_log_activity`, `read_user`, `update_user`, `create_delete_user`, `constraint_query_user`, `read_phpcg_users`, `update_phpcg_users`, `create_delete_phpcg_users`, `constraint_query_phpcg_users`, `read_phpcg_users_profiles`, `update_phpcg_users_profiles`, `create_delete_phpcg_users_profiles`, `constraint_query_phpcg_users_profiles`) VALUES
(1, 'SUPER DUPER ADMIN DAH', 2, 2, 2, NULL, 2, 2, 2, NULL, 2, 2, 2, NULL, 2, 2, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `credit` int(255) NOT NULL DEFAULT '999'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `credit`) VALUES
(1, 'kiminodare', 'jepang12332', 997),
(3, 'demo', 'demo', 0),
(4, 'eko0103', 'asdqwe123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `SETTING_ID` tinyint(1) NOT NULL,
  `ROOT_URL` varchar(250) NOT NULL,
  `CLIENT_EMAIL` varchar(250) NOT NULL,
  `LICENSE_CODE` varchar(250) NOT NULL,
  `LCD` varchar(250) NOT NULL,
  `LRD` varchar(250) NOT NULL,
  `INSTALLATION_KEY` varchar(250) NOT NULL,
  `INSTALLATION_HASH` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`SETTING_ID`, `ROOT_URL`, `CLIENT_EMAIL`, `LICENSE_CODE`, `LCD`, `LRD`, `INSTALLATION_KEY`, `INSTALLATION_HASH`) VALUES
(1, 'https://wibu-checker.com/admin/class/phpformbuilder', 'gigolo3nd@gmail.com', '0ed3a2cb-9bd7-4ad0-ad86-4f7354ffb8f5', 'Um43T2FldXhBZytpVWVibG1LQnVqUT09OjqUT6bVNOjm9z4IoiGOrv2j', 'YXdzc1R5WmtwRTI2QTJTWFZYSy9tUT09OjqDqu5bchB6N5Jq9lt6Kut5', 'Ym1JWmY3YzBLZFpHYnVJS2NTVXlYbG13L0N6UzFRS1VsSkhDQkQ3QjRRbSs4K01qMzh3VFhTelZ5LzZsa1BFWXMxdGZpSzkybEhQdnI3NlJBbUdUd0E9PTo6vSRmWCNxDa0cw5ZeqWCVnw==', 'e2c4fc77f5dbdd1e8ed6261bfaf8291460cfc3c84537babe5775c809d996c3ff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log_activity`
--
ALTER TABLE `log_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phpcg_users`
--
ALTER TABLE `phpcg_users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_phpcg_users_phpcg_users_profiles` (`profiles_ID`);

--
-- Indexes for table `phpcg_users_profiles`
--
ALTER TABLE `phpcg_users_profiles`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `profile_name_UNIQUE` (`profile_name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`SETTING_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `phpcg_users`
--
ALTER TABLE `phpcg_users`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `phpcg_users_profiles`
--
ALTER TABLE `phpcg_users_profiles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `SETTING_ID` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `phpcg_users`
--
ALTER TABLE `phpcg_users`
  ADD CONSTRAINT `fk_phpcg_users_phpcg_users_profiles` FOREIGN KEY (`profiles_ID`) REFERENCES `phpcg_users_profiles` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
