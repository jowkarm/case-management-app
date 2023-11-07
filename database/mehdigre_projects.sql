-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 20, 2023 at 11:49 PM
-- Server version: 10.2.44-MariaDB
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gutierre_projects`
--
CREATE DATABASE IF NOT EXISTS `gutierre_projects` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gutierre_projects`;

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

DROP TABLE IF EXISTS `Student`;
CREATE TABLE IF NOT EXISTS `Student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `ctclink_id` int(11) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Student`
--

INSERT INTO `Student` (`student_id`, `first_name`, `middle_name`, `last_name`, `ctclink_id`) VALUES
(1, 'John', 'Michael', 'Smith', 624788754),
(2, 'Jane', 'Marie', 'Doe', 125297801),
(3, 'Robert', 'William', 'Johnson', 752122771),
(4, 'Alice', 'Elizabeth', 'Brown', 384720487),
(5, 'David', 'Thomas', 'Wilson', 667234150),
(6, 'Emily', 'Grace', 'Anderson', 182009322),
(7, 'Daniel', 'Richard', 'Martin', 908344188),
(8, 'Sophia', 'Olivia', 'Clark', 995693008),
(9, 'Matthew', 'Alexander', 'White', 253432507),
(10, 'Ella', 'Abigail', 'Thompson', 280083540),
(11, 'William', 'Joseph', 'Harris', 640120211),
(12, 'Ava', 'Natalie', 'Robinson', 360350464),
(13, 'James', 'Christopher', 'Lewis', 881391718),
(14, 'Liam', 'Ethan', 'Turner', 325907229),
(15, 'Olivia', 'Samantha', 'Parker', 985361021),
(16, 'Benjamin', 'Daniel', 'Baker', 949083449),
(17, 'Charlotte', 'Grace', 'Mitchell', 789334214),
(18, 'Elijah', 'Carter', 'Green', 99420754),
(19, 'Mia', 'Victoria', 'Hall', 129101156),
(20, 'Michael', 'William', 'Carter', 347243548);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
CREATE TABLE IF NOT EXISTS `User` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `uuid` varchar(50) DEFAULT NULL,
  `password_timestamp` datetime DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`user_id`, `first_name`, `last_name`, `email`, `role`, `password`, `uuid`, `password_timestamp`, `is_active`) VALUES
(5, 'Mehdi', 'Jokar', 'jokar.mehdi2@gmail.com', 'restricted', '$2y$10$2PQ8gbZMs2hBiri9Z.3pUutuSkRuKjb8tuzHAem5Y2MzclDmMGJJK', '44271323-6fb9-11ee-968a-f23c91a78bbf', NULL, 1),
(6, 'Anthony', 'Gutierrez', 'gutierrez.anthony@student.greenriver.edu', 'restricted', '$2y$10$CO1CIzXHa.GeK6dqVJwKX.HdzqfoaYeWV8.e3gQ/B3cn/7Z6rIqTu', '0dc6d1d2-73d2-11ee-968a-f23c91a78bb', NULL, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
