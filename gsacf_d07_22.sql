-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 05, 2021 at 03:51 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gsacf_d07_22`
--

-- --------------------------------------------------------

--
-- Table structure for table `joblist_table`
--

CREATE TABLE `joblist_table` (
  `id` int(12) NOT NULL,
  `joblist` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `skill` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resistDate` date NOT NULL,
  `delete_flag` int(2) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `joblist_table`
--

INSERT INTO `joblist_table` (`id`, `joblist`, `skill`, `region`, `resistDate`, `delete_flag`, `created_at`, `updated_at`) VALUES
(2, 'SE', 'PHP88', 'hokkaido', '2020-12-14', 0, '2020-12-28 06:27:06', '2021-01-03 11:12:16'),
(3, 'エンジニア2', 'PHP10', 'Japan', '2020-12-08', 0, '2020-12-28 06:27:08', '2021-01-03 11:12:34'),
(5, 'エンジニア', 'PHP0', 'hokkaido', '2020-12-27', 0, '2020-12-28 06:27:12', '2021-01-03 11:11:50'),
(6, 'SE', 'PHP2', 'Japan', '2020-12-29', 0, '2020-12-28 06:27:13', '2021-01-03 11:12:21'),
(7, 'エンジニア', 'PHP3', 'Japan', '2020-12-14', 0, '2020-12-28 06:27:15', '2020-12-28 06:27:15'),
(8, 'エンジニア', 'PHP3', 'Japan', '2021-01-06', 0, '2020-12-28 06:27:57', '2020-12-28 06:27:57'),
(9, 'エンジニア', 'PHP5', 'kyushu', '2020-12-15', 0, '2020-12-28 06:27:58', '2021-01-03 11:11:59'),
(10, 'SE', 'PHP0', 'Japan', '2021-01-02', 0, '2020-12-28 06:28:00', '2021-01-03 11:12:25'),
(11, 'エンジニア', 'PHP10000', 'Japan', '2020-12-29', 0, '2021-01-01 11:19:17', '2021-01-02 06:26:04'),
(12, 'エンジニア', 'PHP3333', 'kyushu', '2021-01-25', 0, '2021-01-01 11:19:30', '2021-01-03 11:12:05'),
(13, 'エンジニア2', 'PHP6111', 'Japan', '2020-12-31', 0, '2021-01-01 11:20:06', '2021-01-03 11:12:30'),
(14, 'エンジニア', 'PHP9', 'Japan', '2021-01-10', 0, '2021-01-01 11:20:09', '2021-01-01 11:20:09');

-- --------------------------------------------------------

--
-- Table structure for table `todo_table`
--

CREATE TABLE `todo_table` (
  `id` int(12) NOT NULL,
  `todo` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `todo_table`
--

INSERT INTO `todo_table` (`id`, `todo`, `deadline`, `created_at`, `updated_at`) VALUES
(19, 'PHP課題', '2020-12-15', '2020-12-26 16:44:54', '2020-12-26 23:04:05'),
(20, 'PHP課題333', '2021-01-07', '2020-12-26 16:44:59', '2021-01-02 06:22:14'),
(21, 'test', '2021-01-13', '2021-01-02 06:22:10', '2021-01-02 06:22:10');

-- --------------------------------------------------------

--
-- Table structure for table `users_table`
--

CREATE TABLE `users_table` (
  `id` int(12) NOT NULL,
  `username` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_table`
--

INSERT INTO `users_table` (`id`, `username`, `password`, `is_admin`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'ジーズ太郎10', '100000', 0, 0, '2021-01-05 23:14:06', '2021-01-05 23:27:58'),
(2, 'ジーズ太郎3', '3', 0, 0, '2021-01-05 23:16:09', '2021-01-05 23:16:09'),
(3, 'ジーズ太郎4', '4', 0, 0, '2021-01-05 23:16:10', '2021-01-05 23:16:10'),
(4, 'ジーズ太郎0', '0', 0, 0, '2021-01-05 23:16:11', '2021-01-05 23:16:11'),
(5, 'ジーズ太郎4', '4', 0, 1, '2021-01-05 23:16:13', '2021-01-05 23:27:53'),
(6, 'ジーズ太郎8', '8', 0, 0, '2021-01-05 23:16:14', '2021-01-05 23:16:14'),
(7, 'ジーズ太郎10', '10111', 0, 1, '2021-01-05 23:29:34', '2021-01-05 23:41:05'),
(8, 'ジーズ太郎3', '3ee', 0, 0, '2021-01-05 23:29:36', '2021-01-05 23:42:43'),
(9, 'ジーズ太郎16', '16', 0, 0, '2021-01-05 23:40:10', '2021-01-05 23:40:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `joblist_table`
--
ALTER TABLE `joblist_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `todo_table`
--
ALTER TABLE `todo_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `joblist_table`
--
ALTER TABLE `joblist_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `todo_table`
--
ALTER TABLE `todo_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
