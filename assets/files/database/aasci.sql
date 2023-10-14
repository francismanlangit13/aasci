-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2023 at 06:03 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aasci`
--

-- --------------------------------------------------------

--
-- Table structure for table `system_setting`
--

CREATE TABLE `system_setting` (
  `id` int(11) NOT NULL,
  `meta` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_setting`
--

INSERT INTO `system_setting` (`id`, `meta`, `meta_value`) VALUES
(1, 'name', 'Aloran Association of Senior Citizens\' Incorporated'),
(2, 'shortname', 'AASCI System'),
(3, 'description', 'AASCI System'),
(4, 'keywords', 'AASCI System'),
(5, 'author', 'AASCI System'),
(6, 'icon', 'system_logo.jpg'),
(7, 'logo', 'system_logo.jpg'),
(8, 'facebook', 'AASCI System'),
(9, 'instagram', 'AASCI System'),
(10, 'twitter', 'AASCI System'),
(11, 'tumblr', 'AASCI System'),
(12, 'email', 'AASCI System'),
(13, 'number', 'AASCI System');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `fname` text NOT NULL,
  `mname` text NOT NULL,
  `lname` text NOT NULL,
  `suffix` text NOT NULL,
  `gender` text NOT NULL,
  `birthday` date NOT NULL,
  `civil_status` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `password` text NOT NULL,
  `profile` text NOT NULL,
  `date_issued` date NOT NULL,
  `soc_pen` set('No','Yes') NOT NULL,
  `gsis` set('No','Yes') NOT NULL,
  `sss` set('No','Yes') NOT NULL,
  `pvao` set('No','Yes') NOT NULL,
  `sup_with` set('No','Yes') NOT NULL,
  `4ps` set('No','Yes') NOT NULL,
  `nhts` set('No','Yes') NOT NULL,
  `id_file` set('No','Yes') NOT NULL,
  `barangay` text NOT NULL,
  `rrn` text NOT NULL,
  `account_privacy` set('0','1') NOT NULL,
  `data_sharing` set('0','1') NOT NULL,
  `second_auth` set('0','1') NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `user_status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fname`, `mname`, `lname`, `suffix`, `gender`, `birthday`, `civil_status`, `email`, `phone`, `password`, `profile`, `date_issued`, `soc_pen`, `gsis`, `sss`, `pvao`, `sup_with`, `4ps`, `nhts`, `id_file`, `barangay`, `rrn`, `account_privacy`, `data_sharing`, `second_auth`, `user_type_id`, `user_status_id`) VALUES
(1, 'user', '', 'admin', '', 'Male', '2023-10-11', 'Single', 'admin@gmail.com', '09457664949', 'c93ccd78b2076528346216b3b2f701e6', 'user_20231011_202137.jpeg', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '0', '0', '1', 1, 1),
(3, '', '', '', '', '', '0000-00-00', '', '', '', '6510023de7eb2d51d6d6fcdb39bb4162', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 3),
(4, 'Francis Carlo', 'Abcede', 'Manlangit', '', 'Male', '2000-11-13', 'Single', 'franzcarl13@yahoo.com', '09457664940', 'e0ccc22d8f28274aaee6258dee5a2783', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 3, 1),
(18, '', '', '', '', '', '0000-00-00', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 3, 3),
(19, '', '', '', '', '', '0000-00-00', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 3, 3),
(20, '', '', '', '', '', '0000-00-00', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 3, 3),
(21, 'Juan', '', 'Dela Cruz', ' ', 'Male', '2000-11-20', '', '', '', '', '', '2023-10-14', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Mohon', '1255467', '', '', '', 3, 1),
(22, 'sdsd', '', 'sdsd', '', 'Male', '2023-10-05', 'Widowed', 'franzcarl113@yahoo.com', '09457664942', 'b0b0cacbc210bfa3a8fe74202f1e7fb2', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 1),
(23, 'asdas', 'asdasd', 'asdasd', '', 'Male', '2023-12-31', '', '', '', '', '', '2023-12-31', 'No', 'Yes', 'No', 'Yes', 'No', 'Yes', 'Yes', 'No', 'Balintonga', '1', '', '', '', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` text NOT NULL,
  `datetime` datetime NOT NULL,
  `ip` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_status`
--

CREATE TABLE `user_status` (
  `user_status_id` int(11) NOT NULL,
  `user_status_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_status`
--

INSERT INTO `user_status` (`user_status_id`, `user_status_name`) VALUES
(1, 'Active'),
(2, 'Inactive'),
(3, 'Archive');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int(11) NOT NULL,
  `user_type_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `user_type_name`) VALUES
(1, 'Admin'),
(2, 'Staff'),
(3, 'Client');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `system_setting`
--
ALTER TABLE `system_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_status_id` (`user_status_id`) USING BTREE,
  ADD KEY `user_type_id` (`user_type_id`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_status`
--
ALTER TABLE `user_status`
  ADD PRIMARY KEY (`user_status_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `system_setting`
--
ALTER TABLE `system_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_status`
--
ALTER TABLE `user_status`
  MODIFY `user_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_status_id`) REFERENCES `user_status` (`user_status_id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`user_type_id`);

--
-- Constraints for table `user_log`
--
ALTER TABLE `user_log`
  ADD CONSTRAINT `user_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
