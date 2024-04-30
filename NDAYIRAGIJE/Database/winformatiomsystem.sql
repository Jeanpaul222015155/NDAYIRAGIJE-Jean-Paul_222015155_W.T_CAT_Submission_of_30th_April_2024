-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 02:08 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `winformatiomsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `assignment_id` int(11) NOT NULL,
  `assignment_name` text NOT NULL,
  `worker_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`assignment_id`, `assignment_name`, `worker_id`, `project_id`, `start_date`, `end_date`) VALUES
(1, 'RAT', 1, 1, '2024-04-23', '2024-05-30'),
(2, 'RROOOOO', 2, 2, '2024-04-15', '2025-06-01'),
(5, 'RDBB', 56, 12, '0000-00-00', '0000-00-00'),
(12, 'PPO', 11, 6, '2024-02-05', '2025-02-02'),
(14, 'QRR', 69, 10, '2024-05-02', '2024-05-09');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`) VALUES
(2, 'DD'),
(3, 'AS'),
(5, 'QR'),
(6, 'accounting'),
(27, 'ASDRYRT'),
(28, 'TYU'),
(34, 'ACCS'),
(35, 'Web Programming'),
(39, 'GGOPP'),
(44, 'ASTU'),
(47, 'nnnnn'),
(48, 'GPR');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `project_name`) VALUES
(1, 'Project 1'),
(2, 'Project 2'),
(3, 'project8'),
(5, 'java'),
(6, 'TTUV'),
(10, 'ASD'),
(12, 'CONSTRUCTION'),
(23, 'JAY'),
(25, 'AWE'),
(30, 'HHh');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Gender` enum('Male','Female','Other') DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  `Telephone` varchar(20) DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  `Activation_code` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Firstname`, `Lastname`, `Username`, `Gender`, `Email`, `Telephone`, `Password`, `Activation_code`) VALUES
(1, 'habimana', 'cedric', 'ce', 'Male', 'habimana@gmail.com', '987654', '$2y$10$pnrsjaHMJRhEs2fKdMkv/etAUwN68Zl9.wINfuigEYsyTobbxuIRu', '76766'),
(3, 'mugisha', 'honore', 'mugisha', 'Male', 'mugisha@gmail.com', '456789012', '$2y$10$ypTEYJy55jGfwad5wMKiGOXVNS9AkXN59Ln71o.i7KCKzmc.Nf.bq', '67890'),
(4, 'KKA', 'cedric', 'kka', 'Male', 'kka@gmail.com', '3445678890', '$2y$10$SWe0UutDX3ZRd7Li1/evrOhfApNbFuAhu/RLuy1bGQ8vBYOVUuMTO', '2456'),
(5, 'iradukunda', 'divine', 'divine', 'Female', 'iradukunda@gmail.com', '4556778', '$2y$10$tyku5kcAzW/a6wx/H.zku.jsf4YjCR5.JoOZ9S6WgFr0jBFZKDqoS', '33333'),
(6, 'pp', 'aa', 'pp', 'Male', 'pp@gmail.com', '44657686', '$2y$10$.3ESuvIW2YuZYELzjJ10H.p6QokvfIqO4sSGZtEAh1VvN/bcptv0.', '22233'),
(7, 'Ange', 'Akaliza', 'akaliza', 'Female', 'akaliza@gmail.com', '0788823567', '$2y$10$XvzqYdEJvNptzaGgnzmpPeVDayuoHNjtb2VYQeLJXn6ACY/7j5Fmu', '77777'),
(8, 'valens', 'muvara', 'vava', 'Male', 'muvarav925@gmail.com', '0784568581', '$2y$10$L5OZCF5LONXxwEqWxYF/f.dO/rt/HlYpGXQat.vUOmSd2/LvNr.uC', '55'),
(9, 'keviny', 'keza', 'keza', 'Female', 'keza@gmail.com', '0789345789', '$2y$10$tbsM4rLR5cPGwKw/QxLAueHdTBN3fcAoo6BKUq5DyJVqdpB0E6r3S', '123456'),
(10, 'jeanne', 'uwayezu', 'jeane', 'Female', 'uwayezu@gmail.com', '0789023334', '$2y$10$WqUXKtFQCv0hK0D.jW/34.GPGt0vo25dW8H4LXMPNgaLiiQ.2.bVC', '34556'),
(11, 'Cloude', 'honore', 'cloude', 'Male', 'honore@gmail.com', '0789999909', '$2y$10$3fG8QTbY3uZgCbqTdHvy3.7QtoL8TiEmcLl0zxrGKb6uL49dWAsH6', '4444'),
(12, 'Keviny', 'Murara', 'murara', 'Male', 'murara@gmail.com', '078888888888', '$2y$10$LlcxVqnukSZxa9A4xaZ7re8qoSAX2071wFoNIy5h7HiloKNRCdmi.', '23344'),
(13, 'Omari', 'Kana', 'omari', 'Male', 'omari@gmail.com', '0782345666', '$2y$10$khiCQ4ikB5V2Yr3JubX68eUKaTNqzjuOj56yu6G89BSGSwewOsS1C', '4562'),
(14, 'gggg', 'hhjhjjh', 'bhhhjjh', 'Female', 'gggg@gmail.com', '0726677888', '$2y$10$ROhF.BtdlsYjkcBlj8aQY.gfADxB71NqJpQoEQhTx1oXf3abBgzgK', '55666'),
(15, 'jeanne', 'kaliza', 'kaliza', 'Female', 'jeanne@Gmail.come', '0789234567', '$2y$10$etifm.bIG9e6jJYZOeDB/uqHbyLoMSJQGcobrjSZkh/nYNAYcukV2', '23457');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin_password', 'admin'),
(3, 'user2', 'user2_password', 'regular'),
(6, 'cloude', '123', 'Manager'),
(8, 'Peter', '1122', 'Manager'),
(9, 'kamana', '123', 'Manager'),
(10, 'PAULL', '123', 'admin'),
(13, 'jeanpaul', 'JP12', 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `workersinfo`
--

CREATE TABLE `workersinfo` (
  `worker_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `skills` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workersinfo`
--

INSERT INTO `workersinfo` (`worker_id`, `first_name`, `last_name`, `date_of_birth`, `gender`, `contact_number`, `email`, `address`, `skills`) VALUES
(1, 'John', 'Doe', '1990-01-15', 'Male', '+123456789', 'john@example.com', '123 Main St', 'JAVA'),
(2, 'mugisha', 'anne', '0000-00-00', 'Male', '5465768787', 'mugisha@gmail.com', 'Kamonyi', 'Playing'),
(10, 'Dusengimana', 'Paul', '2000-03-07', 'Male', '078123456', 'paul@gmail.com', 'Kamonyi', 'management'),
(11, 'gaga', 'devotha', '2024-04-18', 'Female', '54446577', 'dev@gmail.com', 'rebero', 'marketing'),
(12, 'habiba', 'snderi', '2005-01-10', 'Male', '078994454', 'sender@gmail.com', 'Nyanza', 'accounting'),
(56, 'Danie', 'Akayezu', '2004-12-20', 'Male', '0733567892', 'akayezu@gmail.com', 'KAYONZA', 'Electrical engineering'),
(67, 'Ange', 'Akaliza', '2001-02-03', 'Female', '0788457321', 'kaliza@gmail.com', 'Kicukiro', 'marketing'),
(69, 'Ora', 'Akarabo', '2007-05-06', 'Female', '07890000078', 'ora@gmail.com', 'Musanze', 'Journalist'),
(123, 'Sibo', 'Jean', '1999-02-05', 'Male', '07867788778', 'jean@gmail.com', 'Rwamagana', 'Electrical engineering'),
(250, 'jay', 'ABAO', '2005-03-04', 'Male', '07894444445', 'abao@gmail.com', 'kigali', 'Teaching'),
(451, 'Jeanne', 'Akimanikunda', '2005-02-06', 'Female', '07876676786', 'jeanne@gmail.come', 'Rulindo', 'software engeneering');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `worker_id` (`worker_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `workersinfo`
--
ALTER TABLE `workersinfo`
  ADD PRIMARY KEY (`worker_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `workersinfo`
--
ALTER TABLE `workersinfo`
  MODIFY `worker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=452;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`worker_id`) REFERENCES `workersinfo` (`worker_id`),
  ADD CONSTRAINT `assignments_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
