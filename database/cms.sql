-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2021 at 02:33 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `t_id` int(11) NOT NULL,
  `t_name` varchar(255) NOT NULL,
  `t_email` varchar(255) NOT NULL,
  `t_phone` varchar(255) NOT NULL,
  `t_address` text NOT NULL,
  `t_message` text NOT NULL,
  `t_img_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`t_id`, `t_name`, `t_email`, `t_phone`, `t_address`, `t_message`, `t_img_name`) VALUES
(59, 'Muhammad Nadeem', 'nadeem77599@gmail.com', '03157478956', 'lahore academy', '1567', '517idAIwPvL._AC_AC_SR98,95_.jpg'),
(61, 'cms', 'cms@gmail.com', '03157478956', 'lahore academy', '159', '51XlkxEgvIL._AC_AC_SR98,95_.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_email` varchar(255) NOT NULL,
  `p_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`p_id`, `p_name`, `p_email`, `p_password`) VALUES
(1, 'Muhammad Nadeem', 'nadeem77599@gmail.com', '$2y$10$2eJO987a8xXC4Ol3aYPNQ.NarpjhJ26..ABKq0eqG4m6DHC2oMdE.'),
(2, 'cms', 'cms@gmail.com', '$2y$10$/dN3ntYlIf6KdbMToFmj4OtNB3x.v3n8VoW.w.yXAX9VJoVtEFUMa'),
(3, 'wp', 'wp@gmail.com', '$2y$10$SgJxe13nw1MYWI7uWMI28OyX4Yd6AKwf4kuqe3Aw6S4sLYJS2n.ZG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
