-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 15, 2023 at 02:40 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `Notes`
--

DROP TABLE IF EXISTS `Notes`;
CREATE TABLE `Notes` (
                         `case_id` int(11) NOT NULL AUTO_INCREMENT,
                         `student_id` int(11) NOT NULL,
                         `is_closed` tinyint(1) NOT NULL DEFAULT 0,
                         `date_opened` date DEFAULT CURDATE(),
                         `due_date` date DEFAULT NULL,
                         `subject` varchar(30) NOT NULL,
                         `note` varchar(1000) DEFAULT NULL,
                         `emotional_indicator` varchar(15) not NULL DEFAULT 'no comment',
                         PRIMARY KEY (`case_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Notes`
--

INSERT INTO `Notes` (`case_id`, `student_id`, `is_closed`, `date_opened`, `due_date`, `subject`, `note`) VALUES
     (1, 1, 1, '2023-11-14 17:01:31', '2023-10-20', 'Finance', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin venenatis elit sem, sit amet elementum est aliquam ac. Curabitur nibh augue, condimentum et viverra posuere, facilisis a augue. Suspendisse potenti. Sed facilisis leo sed felis lacinia finibus. Mauris dignissim ligula id massa semper, a facilisis metus interdum.'),
     (2, 2, 1, '2023-11-14 17:01:31', '2023-10-20', 'Finance', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin venenatis elit sem, sit amet elementum est aliquam ac. Curabitur nibh augue, condimentum et viverra posuere, facilisis a augue. Suspendisse potenti. Sed facilisis leo sed felis lacinia finibus. Mauris dignissim ligula id massa semper, a facilisis metus interdum.'),
     (3, 3, 1, '2023-11-14 17:01:31', '2023-10-20', 'Finance', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin venenatis elit sem, sit amet elementum est aliquam ac. Curabitur nibh augue, condimentum et viverra posuere, facilisis a augue. Suspendisse potenti. Sed facilisis leo sed felis lacinia finibus. Mauris dignissim ligula id massa semper, a facilisis metus interdum.'),
     (4, 4, 1, '2023-11-14 17:01:31', '2023-10-20', 'Finance', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin venenatis elit sem, sit amet elementum est aliquam ac. Curabitur nibh augue, condimentum et viverra posuere, facilisis a augue. Suspendisse potenti. Sed facilisis leo sed felis lacinia finibus. Mauris dignissim ligula id massa semper, a facilisis metus interdum.');

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

DROP TABLE IF EXISTS `Student`;
CREATE TABLE `Student` (
                           `student_id` int(11) NOT NULL,
                           `first_name` varchar(50) NOT NULL,
                           `middle_name` varchar(50) DEFAULT NULL,
                           `last_name` varchar(50) NOT NULL,
                           `ctclink_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

CREATE TABLE `User` (
                        `user_id` int(11) NOT NULL,
                        `first_name` varchar(50) NOT NULL,
                        `last_name` varchar(50) NOT NULL,
                        `email` varchar(100) NOT NULL,
                        `role` varchar(10) NOT NULL,
                        `password` varchar(255) NOT NULL,
                        `uuid` varchar(50) DEFAULT NULL,
                        `password_timestamp` datetime DEFAULT NULL,
                        `is_active` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`user_id`, `first_name`, `last_name`, `email`, `role`, `password`, `uuid`, `password_timestamp`, `is_active`) VALUES
                                                                                                                                      (5, 'Mehdi', 'Jokar', 'jokar.mehdi2@gmail.com', 'restricted', '$2y$10$2PQ8gbZMs2hBiri9Z.3pUutuSkRuKjb8tuzHAem5Y2MzclDmMGJJK', '44271323-6fb9-11ee-968a-f23c91a78bbf', NULL, 1),
                                                                                                                                      (6, 'Anthony', 'Gutierrez', 'gutierrez.anthony@student.greenriver.edu', 'restricted', '$2y$10$CO1CIzXHa.GeK6dqVJwKX.HdzqfoaYeWV8.e3gQ/B3cn/7Z6rIqTu', '0dc6d1d2-73d2-11ee-968a-f23c91a78bbf', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Notes`
--
ALTER TABLE `Notes`
    ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `Student`
--
ALTER TABLE `Student`
    ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
    ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Student`
--
ALTER TABLE `Student`
    MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
    MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
