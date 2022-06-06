-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 06, 2022 at 09:27 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecards_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
                         `id` int(11) NOT NULL,
                         `code` varchar(255) NOT NULL,
                         `image` varchar(280) NOT NULL,
                         `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reset_password_codes`
--

CREATE TABLE `reset_password_codes` (
                                        `id` int(11) NOT NULL,
                                        `code` varchar(255) NOT NULL,
                                        `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reset_password_codes`
--

INSERT INTO `reset_password_codes` (`id`, `code`, `email`) VALUES
    (1, '1629da570e76f6', 'aleksandarrusakov@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
                         `id` int(255) NOT NULL,
                         `username` varchar(255) NOT NULL,
                         `email` varchar(255) NOT NULL,
                         `password` varchar(255) NOT NULL,
                         `status` int(11) DEFAULT '0',
                         `email_verification_link` varchar(255) DEFAULT NULL,
                         `email_verified_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `status`, `email_verification_link`, `email_verified_at`) VALUES
                                                                                                                          (12, 'Ivan', 'ivan@gmail.com', '$2y$10$LTyh3J/zwz7bwiLraZKzx.spIVoNaxdFP.c5geCyRVt3g6njrCNpe', 0, 'd99c9093443e7bfc295ac857adcfa11f8591', NULL),
                                                                                                                          (31, 'Aleksandar', 'aleksandar@rusakov.com', '$2y$12$WBLWwIbAWtYwFyWgegKS5ulTn5MqgIWO5/POMmcT6U0QtqTcZ4q9W', 0, '0ed5f0ab11a31b9566cad4f8a156df967270', NULL),
                                                                                                                          (32, 'Aleksandar1', 'aleksandarrusakov@gmail.com', '$2y$12$Aj552Ht4u.qLO.56iDUHW.rfSujFjC1lLYtg793cr5y8EtswwYS8q', 0, '9445e1c987c3d657eb69e31418f4d9b86064', '2022-06-06 05:54:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reset_password_codes`
--
ALTER TABLE `reset_password_codes`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reset_password_codes`
--
ALTER TABLE `reset_password_codes`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
