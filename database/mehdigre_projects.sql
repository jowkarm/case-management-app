-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 19, 2023 at 02:49 AM
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
-- Database: `mehdigre_projects`
--
CREATE DATABASE IF NOT EXISTS `mehdigre_projects` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mehdigre_projects`;

-- --------------------------------------------------------

--
-- Table structure for table `Notes`
--

DROP TABLE IF EXISTS `Notes`;
CREATE TABLE IF NOT EXISTS `Notes` (
  `case_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `is_closed` tinyint(1) NOT NULL DEFAULT 0,
  `date_opened` datetime DEFAULT current_timestamp(),
  `due_date` date DEFAULT NULL,
  `subject` varchar(30) NOT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `emotional_indicator` varchar(15) NOT NULL DEFAULT 'no comment',
  PRIMARY KEY (`case_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Notes`
--

INSERT INTO `Notes` (`case_id`, `student_id`, `is_closed`, `date_opened`, `due_date`, `subject`, `note`, `emotional_indicator`) VALUES(1, 1, 1, '2023-11-14 17:01:31', '2023-10-20', 'Finance', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin venenatis elit sem, sit amet elementum est aliquam ac. Curabitur nibh augue, condimentum et viverra posuere, facilisis a augue. Suspendisse potenti. Sed facilisis leo sed felis lacinia finibus. Mauris dignissim ligula id massa semper, a facilisis metus interdum.', 'no comment');
INSERT INTO `Notes` (`case_id`, `student_id`, `is_closed`, `date_opened`, `due_date`, `subject`, `note`, `emotional_indicator`) VALUES(2, 2, 1, '2023-11-14 17:01:31', '2023-10-20', 'Finance', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin venenatis elit sem, sit amet elementum est aliquam ac. Curabitur nibh augue, condimentum et viverra posuere, facilisis a augue. Suspendisse potenti. Sed facilisis leo sed felis lacinia finibus. Mauris dignissim ligula id massa semper, a facilisis metus interdum.', 'no comment');
INSERT INTO `Notes` (`case_id`, `student_id`, `is_closed`, `date_opened`, `due_date`, `subject`, `note`, `emotional_indicator`) VALUES(3, 3, 1, '2023-11-14 17:01:31', '2023-10-20', 'Finance', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin venenatis elit sem, sit amet elementum est aliquam ac. Curabitur nibh augue, condimentum et viverra posuere, facilisis a augue. Suspendisse potenti. Sed facilisis leo sed felis lacinia finibus. Mauris dignissim ligula id massa semper, a facilisis metus interdum.', 'no comment');
INSERT INTO `Notes` (`case_id`, `student_id`, `is_closed`, `date_opened`, `due_date`, `subject`, `note`, `emotional_indicator`) VALUES(4, 4, 1, '2023-11-14 17:01:31', '2023-10-20', 'Finance', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin venenatis elit sem, sit amet elementum est aliquam ac. Curabitur nibh augue, condimentum et viverra posuere, facilisis a augue. Suspendisse potenti. Sed facilisis leo sed felis lacinia finibus. Mauris dignissim ligula id massa semper, a facilisis metus interdum.', 'no comment');

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
  `pronouns` varchar(20) DEFAULT NULL,
  `tribe_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `cte_program` varchar(50) DEFAULT NULL,
  `clothing_size` varchar(10) DEFAULT NULL,
  `course_history` blob DEFAULT NULL,
  `academic_progress` blob DEFAULT NULL,
  `financial_needs` blob DEFAULT NULL,
  `cases` blob DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Student`
--

INSERT INTO `Student` (`student_id`, `first_name`, `middle_name`, `last_name`, `ctclink_id`, `pronouns`, `tribe_name`, `email`, `phone`, `cte_program`, `clothing_size`, `course_history`, `academic_progress`, `financial_needs`, `cases`) VALUES(1, 'John', 'Michael', 'Smith', 624788754, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `Student` (`student_id`, `first_name`, `middle_name`, `last_name`, `ctclink_id`, `pronouns`, `tribe_name`, `email`, `phone`, `cte_program`, `clothing_size`, `course_history`, `academic_progress`, `financial_needs`, `cases`) VALUES(2, 'Jane', 'Marie', 'Doe', 125297801, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `Student` (`student_id`, `first_name`, `middle_name`, `last_name`, `ctclink_id`, `pronouns`, `tribe_name`, `email`, `phone`, `cte_program`, `clothing_size`, `course_history`, `academic_progress`, `financial_needs`, `cases`) VALUES(3, 'Robert', 'William', 'Johnson', 752122771, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `Student` (`student_id`, `first_name`, `middle_name`, `last_name`, `ctclink_id`, `pronouns`, `tribe_name`, `email`, `phone`, `cte_program`, `clothing_size`, `course_history`, `academic_progress`, `financial_needs`, `cases`) VALUES(4, 'Alice', 'Elizabeth', 'Brown', 384720487, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `Student` (`student_id`, `first_name`, `middle_name`, `last_name`, `ctclink_id`, `pronouns`, `tribe_name`, `email`, `phone`, `cte_program`, `clothing_size`, `course_history`, `academic_progress`, `financial_needs`, `cases`) VALUES(5, 'David', 'Thomas', 'Wilson', 667234150, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `Student` (`student_id`, `first_name`, `middle_name`, `last_name`, `ctclink_id`, `pronouns`, `tribe_name`, `email`, `phone`, `cte_program`, `clothing_size`, `course_history`, `academic_progress`, `financial_needs`, `cases`) VALUES(6, 'Emily', 'Grace', 'Anderson', 182009322, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `Student` (`student_id`, `first_name`, `middle_name`, `last_name`, `ctclink_id`, `pronouns`, `tribe_name`, `email`, `phone`, `cte_program`, `clothing_size`, `course_history`, `academic_progress`, `financial_needs`, `cases`) VALUES(7, 'Daniel', 'Richard', 'Martin', 908344188, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `Student` (`student_id`, `first_name`, `middle_name`, `last_name`, `ctclink_id`, `pronouns`, `tribe_name`, `email`, `phone`, `cte_program`, `clothing_size`, `course_history`, `academic_progress`, `financial_needs`, `cases`) VALUES(8, 'Sophia', 'Olivia', 'Clark', 995693008, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `Student` (`student_id`, `first_name`, `middle_name`, `last_name`, `ctclink_id`, `pronouns`, `tribe_name`, `email`, `phone`, `cte_program`, `clothing_size`, `course_history`, `academic_progress`, `financial_needs`, `cases`) VALUES(9, 'Matthew', 'Alexander', 'White', 253432507, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `Student` (`student_id`, `first_name`, `middle_name`, `last_name`, `ctclink_id`, `pronouns`, `tribe_name`, `email`, `phone`, `cte_program`, `clothing_size`, `course_history`, `academic_progress`, `financial_needs`, `cases`) VALUES(10, 'Ella', 'Abigail', 'Thompson', 280083540, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `Student` (`student_id`, `first_name`, `middle_name`, `last_name`, `ctclink_id`, `pronouns`, `tribe_name`, `email`, `phone`, `cte_program`, `clothing_size`, `course_history`, `academic_progress`, `financial_needs`, `cases`) VALUES(11, 'William', 'Joseph', 'Harris', 640120211, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `Student` (`student_id`, `first_name`, `middle_name`, `last_name`, `ctclink_id`, `pronouns`, `tribe_name`, `email`, `phone`, `cte_program`, `clothing_size`, `course_history`, `academic_progress`, `financial_needs`, `cases`) VALUES(12, 'Ava', 'Natalie', 'Robinson', 360350464, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `Student` (`student_id`, `first_name`, `middle_name`, `last_name`, `ctclink_id`, `pronouns`, `tribe_name`, `email`, `phone`, `cte_program`, `clothing_size`, `course_history`, `academic_progress`, `financial_needs`, `cases`) VALUES(13, 'James', 'Christopher', 'Lewis', 881391718, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `Student` (`student_id`, `first_name`, `middle_name`, `last_name`, `ctclink_id`, `pronouns`, `tribe_name`, `email`, `phone`, `cte_program`, `clothing_size`, `course_history`, `academic_progress`, `financial_needs`, `cases`) VALUES(14, 'Liam', 'Ethan', 'Turner', 325907229, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `Student` (`student_id`, `first_name`, `middle_name`, `last_name`, `ctclink_id`, `pronouns`, `tribe_name`, `email`, `phone`, `cte_program`, `clothing_size`, `course_history`, `academic_progress`, `financial_needs`, `cases`) VALUES(15, 'Olivia', 'Samantha', 'Parker', 985361021, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `Student` (`student_id`, `first_name`, `middle_name`, `last_name`, `ctclink_id`, `pronouns`, `tribe_name`, `email`, `phone`, `cte_program`, `clothing_size`, `course_history`, `academic_progress`, `financial_needs`, `cases`) VALUES(16, 'Benjamin', 'Daniel', 'Baker', 949083449, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `Student` (`student_id`, `first_name`, `middle_name`, `last_name`, `ctclink_id`, `pronouns`, `tribe_name`, `email`, `phone`, `cte_program`, `clothing_size`, `course_history`, `academic_progress`, `financial_needs`, `cases`) VALUES(17, 'Charlotte', 'Grace', 'Mitchell', 789334214, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `Student` (`student_id`, `first_name`, `middle_name`, `last_name`, `ctclink_id`, `pronouns`, `tribe_name`, `email`, `phone`, `cte_program`, `clothing_size`, `course_history`, `academic_progress`, `financial_needs`, `cases`) VALUES(18, 'Elijah', 'Carter', 'Green', 99420754, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `Student` (`student_id`, `first_name`, `middle_name`, `last_name`, `ctclink_id`, `pronouns`, `tribe_name`, `email`, `phone`, `cte_program`, `clothing_size`, `course_history`, `academic_progress`, `financial_needs`, `cases`) VALUES(19, 'Mia', 'Victoria', 'Hall', 129101156, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `Student` (`student_id`, `first_name`, `middle_name`, `last_name`, `ctclink_id`, `pronouns`, `tribe_name`, `email`, `phone`, `cte_program`, `clothing_size`, `course_history`, `academic_progress`, `financial_needs`, `cases`) VALUES(20, 'Michael', 'William', 'Carter', 347243548, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`user_id`, `first_name`, `last_name`, `email`, `role`, `password`, `uuid`, `password_timestamp`, `is_active`) VALUES(6, 'Anthony', 'Gutierrez', 'gutierrez.anthony@student.greenriver.edu', 'restricted', '$2y$10$0md/7z3po4w.x.HAqpD8R.k1mPq13R5fyPXDBEU3up2e/dJTI14WO', '2f53f92b-729b-11ee-968a-f23c91a78bbf', NULL, 1);
INSERT INTO `User` (`user_id`, `first_name`, `last_name`, `email`, `role`, `password`, `uuid`, `password_timestamp`, `is_active`) VALUES(7, 'Jo', 'Cichon', 'cichon.jo@student.greenriver.edu', 'restricted', '$2y$10$4XM2hYqkwaTC1AxMPjxBgeo7kM9NcBWOunavBjbBwrhpNljnM0cvC', '32c8a690-72a1-11ee-968a-f23c91a78bbf', NULL, 1);
INSERT INTO `User` (`user_id`, `first_name`, `last_name`, `email`, `role`, `password`, `uuid`, `password_timestamp`, `is_active`) VALUES(9, 'Mehdi', 'Jokar', 'jokar.mehdi2@gmail.com', 'restricted', '$2y$10$nhkTul6wSCJPXXYLIAAZZ.klzPCfBrW7h/GuwFyrgp7ROPKR2DzuK', '2dab5636-8692-11ee-968a-f23c91a78bbf', '2023-11-19 04:29:21', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
