-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2018 at 04:52 PM
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
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id_user` int(5) UNSIGNED ZEROFILL NOT NULL,
  `nm_user` varchar(255) NOT NULL,
  `pass_user` varchar(255) NOT NULL,
  `divisi` int(6) UNSIGNED ZEROFILL NOT NULL,
  `nav_color` varchar(255) NOT NULL DEFAULT 'chiller-theme',
  `nav_bg` varchar(255) DEFAULT 'bg1',
  `nav_status` varchar(255) DEFAULT 'sidebar-bg',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id_user`, `nm_user`, `pass_user`, `divisi`, `nav_color`, `nav_bg`, `nav_status`, `created_at`, `updated_at`) VALUES
(00001, 'esj', '604e1aaea3ffbfc063b9e7e44b25e757', 000000, 'chiller-theme', 'bg3', 'sidebar-bg', '2018-10-30 02:59:02', '2018-10-31 15:46:11'),
(00007, 'kimhu', '19343fe121f2df84139b4e1dc59f8be5', 000000, 'ice-theme', 'bg2', 'sidebar-bg', '2018-10-31 14:29:39', '2018-10-31 15:00:53'),
(00014, 'admin', '21232f297a57a5a743894a0e4a801fc3', 000000, 'chiller-theme', 'bg1', 'sidebar-bg', '2018-10-31 14:59:31', '2018-10-31 14:59:31'),
(00015, 'intel', '4e5bbaeafc82ab7aa1385bea8ef5d30a', 000000, 'chiller-theme', 'bg1', 'sidebar-bg', '2018-10-31 15:05:38', '2018-10-31 15:43:54'),
(00030, 'acer', 'e4721cdedd884feed88dc9079863c278', 000000, 'chiller-theme', 'bg1', 'sidebar-bg', '2018-10-31 15:44:06', '2018-10-31 15:44:06'),
(00031, 'gorder', '9bfa42e8bd52b998c2cc4eff2b127025', 000000, 'chiller-theme', 'bg1', 'sidebar-bg', '2018-10-31 15:44:14', '2018-10-31 15:44:14'),
(00032, 'helo world', '27eac27d138eaf911f054026e14f7500', 000000, 'cool-theme', 'bg1', 'sidebar-bg', '2018-10-31 15:49:27', '2018-10-31 15:50:00'),
(00033, 'helo worlda', '107b149e4681dff92c99ad79f4f56f09', 000000, 'chiller-theme', 'bg1', 'sidebar-bg', '2018-10-31 15:49:31', '2018-10-31 15:49:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id_user` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
