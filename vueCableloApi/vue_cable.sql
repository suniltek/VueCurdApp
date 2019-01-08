-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2019 at 04:52 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vue_cable`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_cred`
--

CREATE TABLE `admin_cred` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `api_token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_cred`
--

INSERT INTO `admin_cred` (`admin_id`, `username`, `password`, `u_email`, `api_token`) VALUES
(1, 'admin', 'password', 'admin@admin.com', 'abdc#0000');

-- --------------------------------------------------------

--
-- Table structure for table `user_registration`
--

CREATE TABLE `user_registration` (
  `user_id` int(11) NOT NULL,
  `user_full_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` bigint(20) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_locality` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_pincode` int(11) NOT NULL,
  `setupbox_no` varchar(255) NOT NULL,
  `status_code` enum('Active','Inactive') NOT NULL,
  `user_status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_registration`
--

INSERT INTO `user_registration` (`user_id`, `user_full_name`, `user_email`, `user_phone`, `user_city`, `user_locality`, `user_address`, `user_pincode`, `setupbox_no`, `status_code`, `user_status`, `created`, `modified`) VALUES
(1, 'Sunil Pawar', 'sunil@gmail.com', 9762207858, 'PCMC', 'Thergoan', 'Thergaon, Pune - 33', 411034, 'AWE123KJL2', 'Active', 'active', '2019-01-04 12:58:31', '2019-01-08 15:36:08'),
(2, 'Shailesh Dhokare', 'shailesh@gmail.com', 9878565632, 'Pune', 'Chandannagar', 'Chandannagar, Pune', 422605, 'DSF568WEM12', 'Inactive', 'active', '2019-01-07 10:09:57', '2019-01-08 15:28:02'),
(3, 'Ravi Mane', 'ravi@gmail.com', 7858969856, 'Pune', 'Vimannagar', 'Viman nagar, Pune - 14', 411014, 'RAV765MAN8', 'Active', 'active', '2019-01-08 09:20:56', '2019-01-08 15:28:05'),
(4, 'Prashant Bhise', 'prashant@gmail.com', 4589696856, 'PCMC', 'Moshi', 'Moshi, Pune - 33', 411033, 'PRA567BHI3', 'Active', 'active', '2019-01-08 14:37:39', '2019-01-08 15:28:07'),
(5, 'Ashish Choughule', 'ashish@gmail.com', 7896589657, 'Pune', 'Kothrud', 'Kothrud, Pune - 29', 411029, 'ASH896CHO3', 'Inactive', 'active', '2019-01-08 15:31:23', '2019-01-08 15:32:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `user_registration`
--
ALTER TABLE `user_registration`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_cred`
--
ALTER TABLE `admin_cred`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_registration`
--
ALTER TABLE `user_registration`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
