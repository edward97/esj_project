-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2018 at 06:41 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_divisi`
--

CREATE TABLE `tbl_divisi` (
  `id_divisi` int(5) UNSIGNED ZEROFILL NOT NULL,
  `nm_divisi` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_divisi`
--

INSERT INTO `tbl_divisi` (`id_divisi`, `nm_divisi`, `created_at`, `updated_at`) VALUES
(00001, 'IT - CEMARA', '2018-11-01 04:19:50', '2018-11-01 17:35:19'),
(00032, 'CS - CEMARA', '2018-11-01 17:19:48', '2018-11-01 17:27:52'),
(00034, 'CS - BINJAI', '2018-11-01 17:34:23', '2018-11-01 17:35:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id_user` int(5) UNSIGNED ZEROFILL NOT NULL,
  `nm_user` varchar(255) NOT NULL,
  `pass_user` varchar(255) NOT NULL,
  `id_divisi` int(6) UNSIGNED ZEROFILL NOT NULL,
  `nav_color` varchar(255) NOT NULL DEFAULT 'chiller-theme',
  `nav_bg` varchar(255) DEFAULT 'bg1',
  `nav_status` varchar(255) DEFAULT 'sidebar-bg',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id_user`, `nm_user`, `pass_user`, `id_divisi`, `nav_color`, `nav_bg`, `nav_status`, `created_at`, `updated_at`) VALUES
(00001, 'esj', '604e1aaea3ffbfc063b9e7e44b25e757', 000001, 'cool-theme', 'bg3', 'sidebar-bg', '2018-10-30 02:59:02', '2018-11-01 17:29:41'),
(00037, 'edward', 'a53f3929621dba1306f8a61588f52f55', 000032, 'chiller-theme', 'bg1', 'sidebar-bg', '2018-11-01 07:25:01', '2018-11-01 17:29:52'),
(00038, 'admin', '21232f297a57a5a743894a0e4a801fc3', 000034, 'chiller-theme', 'bg1', 'sidebar-bg', '2018-11-01 17:34:37', '2018-11-01 17:34:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_divisi`
--
ALTER TABLE `tbl_divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `divisi` (`id_divisi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_divisi`
--
ALTER TABLE `tbl_divisi`
  MODIFY `id_divisi` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id_user` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD CONSTRAINT `fk_user_divisi` FOREIGN KEY (`id_divisi`) REFERENCES `tbl_divisi` (`id_divisi`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
