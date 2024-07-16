-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2024 at 03:58 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sas`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `course_selection` enum('enable','disable') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fullname`, `username`, `password`, `course_selection`) VALUES
(1, 'admin', 'admin', '1234', 'enable');

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `assignment_title` varchar(255) DEFAULT NULL,
  `total_score` decimal(10,0) NOT NULL,
  `due_date` date NOT NULL,
  `teacher_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`id`, `class_id`, `book_id`, `question`, `assignment_title`, `total_score`, `due_date`, `teacher_id`) VALUES
(1, 1, 1, '<p><strong>Instructions:</strong></p><ol><li>Write your answers in <strong>Times New Roman</strong> font, size 12.</li><li>Read each question carefully and provide clear and concise answers.</li><li>Make sure to write your name and roll number at the top of the page.</li><li>Submit your assignment by the due date.</li></ol><p><strong>Questions:</strong></p><ol><li><strong>Vocabulary:</strong><ul><li>Write down five new words you learned from your English book this week. Use each word in a sentence.</li></ul></li><li><strong>Reading Comprehension:</strong><ul><li>Read the short story provided by your teacher. Answer the following questions:<ol><li>What is the main idea of the story?</li><li>Who are the main characters?</li><li>Describe the setting of the story.</li><li>What lesson did you learn from the story?</li></ol></li></ul></li><li><strong>Grammar:</strong><ul><li>Complete the sentences with the correct form of the verb:<ol><li>She (to go) ______ to school every day.</li><li>They (to play) ______ in the park yesterday.</li><li>He (to eat) ______ his lunch now.</li><li>We (to be) ______ happy to see you.</li></ol></li></ul></li></ol>', 'assignment no 1', 10, '2024-07-12', 1),
(2, 4, 20, '<p>question</p>', 'assignment no 1', 10, '2024-07-12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `attempt_quiz`
--

CREATE TABLE `attempt_quiz` (
  `id` int(10) NOT NULL,
  `quiz_id` int(10) NOT NULL,
  `book_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `score` decimal(10,0) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attempt_quiz`
--

INSERT INTO `attempt_quiz` (`id`, `quiz_id`, `book_id`, `student_id`, `score`, `dateTime`) VALUES
(1, 1, 1, 1, 9, '2024-07-07 15:58:31');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `book_id` int(10) NOT NULL,
  `attendance_date` date NOT NULL,
  `attendance_status` enum('present','absent') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_id`, `class_id`, `teacher_id`, `book_id`, `attendance_date`, `attendance_status`) VALUES
(1, 1, 1, 2, 1, '2024-05-20', 'present'),
(2, 2, 1, 2, 1, '2024-05-20', 'present'),
(3, 1, 1, 2, 2, '2024-05-20', 'present'),
(4, 2, 1, 2, 2, '2024-05-20', 'present'),
(5, 1, 1, 2, 3, '2024-05-20', 'present'),
(6, 2, 1, 2, 3, '2024-05-20', 'present'),
(7, 1, 1, 2, 4, '2024-05-20', 'present'),
(8, 2, 1, 2, 4, '2024-05-20', 'present'),
(9, 1, 1, 2, 5, '2024-05-20', 'present'),
(10, 2, 1, 2, 5, '2024-05-20', 'present'),
(11, 1, 1, 2, 6, '2024-05-20', 'present'),
(12, 2, 1, 2, 6, '2024-05-20', 'present'),
(13, 3, 2, 2, 7, '2024-05-20', 'present'),
(14, 4, 2, 2, 7, '2024-05-20', 'present'),
(15, 3, 2, 2, 8, '2024-05-20', 'present'),
(16, 4, 2, 2, 8, '2024-05-20', 'present'),
(17, 3, 2, 2, 9, '2024-05-20', 'present'),
(18, 4, 2, 2, 9, '2024-05-20', 'present'),
(19, 3, 2, 2, 10, '2024-05-20', 'present'),
(20, 4, 2, 2, 10, '2024-05-20', 'present'),
(21, 3, 2, 2, 11, '2024-05-20', 'present'),
(22, 4, 2, 2, 11, '2024-05-20', 'present'),
(23, 3, 2, 2, 12, '2024-05-20', 'present'),
(24, 4, 2, 2, 12, '2024-05-20', 'present');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `name`, `class_id`) VALUES
(1, 'English', 1),
(2, 'Urdu', 1),
(3, 'Mathematics', 1),
(5, 'Islamic Studies', 1),
(6, 'General Knowledge', 1),
(7, 'English', 2),
(8, 'Urdu', 2),
(9, 'Mathematics', 2),
(10, 'Science', 2),
(11, 'Islamic Studies', 2),
(12, 'General Knowledge', 2),
(13, 'English', 3),
(14, 'Urdu', 3),
(15, 'Mathematics', 3),
(16, 'Science', 3),
(17, 'Islamic Studies', 3),
(18, 'General Knowledge', 3),
(19, 'Urdu', 4),
(20, 'English', 4),
(21, 'Mathematics', 4);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `name`) VALUES
(1, 'I'),
(2, 'II'),
(3, 'III'),
(4, 'IV'),
(5, 'V'),
(6, 'VI');

-- --------------------------------------------------------

--
-- Table structure for table `course_selection`
--

CREATE TABLE `course_selection` (
  `id` int(10) NOT NULL,
  `student_id` int(11) NOT NULL,
  `book_id` int(10) NOT NULL,
  `class_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_selection`
--

INSERT INTO `course_selection` (`id`, `student_id`, `book_id`, `class_id`) VALUES
(7, 1, 1, 1),
(8, 1, 2, 1),
(9, 1, 3, 1),
(10, 1, 5, 1),
(11, 1, 6, 1),
(12, 12, 19, 4),
(13, 12, 20, 4),
(14, 12, 21, 4),
(15, 2, 1, 1),
(16, 2, 2, 1),
(17, 2, 3, 1),
(18, 2, 5, 1),
(19, 2, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fee`
--

CREATE TABLE `fee` (
  `id` int(10) NOT NULL,
  `class_id` int(10) NOT NULL,
  `monthly_fee` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fee`
--

INSERT INTO `fee` (`id`, `class_id`, `monthly_fee`) VALUES
(1, 1, 1500),
(2, 2, 1600),
(3, 3, 1700),
(4, 4, 1800),
(5, 5, 1900),
(6, 6, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `parent_id` int(10) NOT NULL,
  `date` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `title`, `description`, `parent_id`, `date`) VALUES
(1, 'Teacher, Child and School peerforms', 'The teacher demonstrates commendable engagement by creating interactive and interesting lessons, ensuring clarity in instructions, and providing strong support and encouragement to students. The school provides a safe and conducive environment for learnin', 1, '2024-05-13 17:12:48.856175');

-- --------------------------------------------------------

--
-- Table structure for table `lectures`
--

CREATE TABLE `lectures` (
  `id` int(10) NOT NULL,
  `class_id` int(10) NOT NULL,
  `book_id` int(10) NOT NULL,
  `lecture_no` varchar(255) NOT NULL,
  `lecture` varchar(255) NOT NULL,
  `teacher_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lectures`
--

INSERT INTO `lectures` (`id`, `class_id`, `book_id`, `lecture_no`, `lecture`, `teacher_id`) VALUES
(1, 1, 1, '1', 'zILqbzPIX34?si=uzEdzAVG5438-xeX', 1),
(2, 1, 1, '2', '0Qfrqf0Y42E?si=LUT1BMyVLXSODDgq', 1),
(3, 1, 1, '3', 'g8m2bneJFC8?si=ocSGqCldjIhId8WP', 1),
(4, 1, 1, '4', 'tUA6oIJMPMw?si=Mk8V8a9ByCC6wLth', 1),
(5, 1, 1, '5', 'ly0FVzYPNiE?si=-Fa3fxk3DPZKuObD', 1),
(6, 1, 1, '6', 'YYePWjcAS0E?si=l3evD9O4YK_KtxS5', 1),
(7, 1, 2, '1', 'yCVWMjLjz8M?si=MkHgIjrJHN0JiS9p', 2),
(8, 1, 2, '2', '_XGaBfc34-k?si=s4K8xnNP8KVdHtXE', 2),
(9, 1, 2, '3', 'VxmFLl74Moc?si=j_bIN4w2UaQ8y9FP', 2),
(10, 1, 2, '4', 'nrIH-66eGY4?si=B-J4SrdUPsNisDEz', 2),
(11, 1, 2, '5', 'fLsvg9Jsnqs?si=K30rDk5BjZRV76gF', 2),
(12, 1, 2, '6', 'fLsvg9Jsnqs?si=ZxEvkaP8Sy9GX2W8', 2),
(13, 1, 3, '1', 'xjVJrm3lnnA?si=gCdUe5Kt3UPJ9a19', 3),
(14, 1, 3, '2', 'zEWGx-N9_PA?si=ScV2_5nIOOLCipzs', 3),
(15, 1, 3, '3', '2Jad_cF81-M?si=ZL9r5pC-RU-87DCy', 3),
(16, 1, 3, '4', 'JoOYJHtGfAk?si=vt5C3qbgCCKw1m0u', 3),
(17, 1, 3, '5', 'axtN7GusnaQ?si=VORn78SgjIDFc49_', 3),
(18, 1, 3, '6', '9DbvoziKxE4?si=xcFZKQK5TBnYQ788', 3),
(19, 1, 5, '1', 'RB2-IVcz5d0?si=ZzHiJv81f8FVAC5F', 4),
(20, 1, 5, '2', 'cNWA-iXn8Y8?si=K7IneguQ6_7Au_hF', 4),
(21, 1, 5, '3', 'Vq6C6YJnBHk?si=3rD9xh9UgXR1LFyd', 4),
(22, 1, 5, '4', 'kEygp1IAews?si=W5JNLnbLQZ4N521r', 4),
(23, 1, 5, '5', 'Mah9uzTjo9k?si=7kKFneNFMw4omup9', 4),
(24, 1, 5, '6', 'bXj6oMrCYOU?si=7VFP2ZXMOHGzPrQh', 4),
(25, 1, 6, '1', 'LCT5-MiiFJU?si=3sPTcWpBmP8JG4Pk', 5),
(26, 1, 6, '2', 'm6jypfsqO1Y?si=mmBVXSTin23TlScD', 5),
(27, 1, 6, '3', 'O3nWtgFLsxQ?si=lIynLMVa5mEJR-ZQ', 5),
(28, 1, 6, '4', 'O3nWtgFLsxQ?si=lIynLMVa5mEJR-ZQ', 5),
(29, 1, 6, '5', 'rjPpjUtQw84?si=pYkkIIezIuSO3Fed', 5),
(30, 1, 6, '6', 'C6NglF8Q4ps?si=bpI27f1fptY-HZzX', 5),
(31, 2, 7, '1', 'zILqbzPIX34?si=uzEdzAVG5438-xeX', 1),
(32, 2, 7, '2', 'zILqbzPIX34?si=uzEdzAVG5438-xeX', 1),
(33, 2, 7, '3', '0Qfrqf0Y42E?si=LUT1BMyVLXSODDgq', 1),
(34, 2, 7, '4', 'g8m2bneJFC8?si=ocSGqCldjIhId8WP', 1),
(35, 2, 7, '5', 'tUA6oIJMPMw?si=Mk8V8a9ByCC6wLth', 1),
(36, 2, 7, '6', 'ly0FVzYPNiE?si=-Fa3fxk3DPZKuObD', 1),
(37, 2, 2, '6', 'YYePWjcAS0E?si=l3evD9O4YK_KtxS5', 1),
(38, 2, 8, '1', 'yCVWMjLjz8M?si=MkHgIjrJHN0JiS9p', 2),
(39, 2, 8, '2', '_XGaBfc34-k?si=s4K8xnNP8KVdHtXE', 2),
(40, 2, 8, '3', 'VxmFLl74Moc?si=j_bIN4w2UaQ8y9FP', 2),
(41, 2, 8, '4', 'nrIH-66eGY4?si=B-J4SrdUPsNisDEz', 2),
(42, 2, 8, '5', 'fLsvg9Jsnqs?si=K30rDk5BjZRV76gF', 2),
(43, 2, 8, '6', 'fLsvg9Jsnqs?si=ZxEvkaP8Sy9GX2W8', 2),
(44, 2, 9, '1', 'xjVJrm3lnnA?si=gCdUe5Kt3UPJ9a19', 3),
(45, 2, 9, '2', 'zEWGx-N9_PA?si=ScV2_5nIOOLCipzs', 3),
(46, 2, 9, '3', '2Jad_cF81-M?si=ZL9r5pC-RU-87DCy', 3),
(47, 2, 9, '4', 'JoOYJHtGfAk?si=vt5C3qbgCCKw1m0u', 3),
(48, 2, 9, '5', 'axtN7GusnaQ?si=VORn78SgjIDFc49_', 3),
(49, 2, 9, '6', '9DbvoziKxE4?si=xcFZKQK5TBnYQ788', 3),
(50, 2, 10, '1', 'RB2-IVcz5d0?si=ZzHiJv81f8FVAC5F', 4),
(51, 2, 10, '2', 'cNWA-iXn8Y8?si=K7IneguQ6_7Au_hF', 4),
(52, 2, 10, '3', 'Vq6C6YJnBHk?si=3rD9xh9UgXR1LFyd', 4),
(53, 2, 10, '4', 'kEygp1IAews?si=W5JNLnbLQZ4N521r', 4),
(54, 2, 10, '5', 'Mah9uzTjo9k?si=7kKFneNFMw4omup9', 4),
(55, 2, 10, '6', 'bXj6oMrCYOU?si=7VFP2ZXMOHGzPrQh', 4),
(56, 2, 11, '1', 'LCT5-MiiFJU?si=3sPTcWpBmP8JG4Pk', 5),
(57, 2, 11, '2', 'm6jypfsqO1Y?si=mmBVXSTin23TlScD', 5),
(58, 2, 11, '3', 'O3nWtgFLsxQ?si=lIynLMVa5mEJR-ZQ', 5),
(59, 2, 11, '4', 'O3nWtgFLsxQ?si=lIynLMVa5mEJR-ZQ', 5),
(60, 2, 11, '5', 'rjPpjUtQw84?si=pYkkIIezIuSO3Fed', 5),
(61, 2, 11, '6', 'C6NglF8Q4ps?si=bpI27f1fptY-HZzX', 5),
(62, 2, 12, '1', 'LCT5-MiiFJU?si=3sPTcWpBmP8JG4Pk', 5),
(63, 2, 12, '2', 'm6jypfsqO1Y?si=mmBVXSTin23TlScD', 5),
(64, 2, 12, '3', 'O3nWtgFLsxQ?si=lIynLMVa5mEJR-ZQ', 5),
(65, 2, 12, '4', 'O3nWtgFLsxQ?si=lIynLMVa5mEJR-ZQ', 5),
(66, 2, 12, '5', 'rjPpjUtQw84?si=pYkkIIezIuSO3Fed', 5),
(67, 2, 12, '6', 'C6NglF8Q4ps?si=bpI27f1fptY-HZzX', 5);

-- --------------------------------------------------------

--
-- Table structure for table `lecture_schedule`
--

CREATE TABLE `lecture_schedule` (
  `id` int(10) NOT NULL,
  `class_id` int(10) NOT NULL,
  `book_id` int(10) NOT NULL,
  `teacher_id` int(10) NOT NULL,
  `lecture_id` int(11) NOT NULL,
  `start_time` time(6) NOT NULL,
  `end_time` time(6) NOT NULL,
  `lecture_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecture_schedule`
--

INSERT INTO `lecture_schedule` (`id`, `class_id`, `book_id`, `teacher_id`, `lecture_id`, `start_time`, `end_time`, `lecture_date`) VALUES
(1, 1, 1, 1, 1, '07:45:00.000000', '08:30:00.000000', '2024-07-08'),
(2, 1, 1, 1, 2, '07:45:00.000000', '08:30:00.000000', '2024-07-09'),
(3, 1, 1, 1, 3, '07:45:00.000000', '08:30:00.000000', '2024-07-10'),
(4, 1, 1, 1, 4, '07:45:00.000000', '08:30:00.000000', '2024-07-11'),
(5, 1, 1, 1, 5, '07:45:00.000000', '08:30:00.000000', '2024-07-12'),
(6, 1, 1, 1, 6, '07:45:00.000000', '08:30:00.000000', '2024-07-13'),
(7, 1, 2, 2, 7, '08:30:00.000000', '09:15:00.000000', '2024-07-08'),
(8, 1, 2, 2, 8, '08:30:00.000000', '09:15:00.000000', '2024-07-09'),
(9, 1, 2, 2, 9, '08:30:00.000000', '09:15:00.000000', '2024-07-10'),
(10, 1, 2, 2, 10, '08:30:00.000000', '09:15:00.000000', '2024-07-11'),
(11, 1, 2, 2, 11, '08:30:00.000000', '09:15:00.000000', '2024-07-12'),
(12, 1, 2, 2, 12, '08:30:00.000000', '09:15:00.000000', '2024-07-13'),
(13, 1, 3, 3, 13, '09:15:00.000000', '10:00:00.000000', '2024-07-08'),
(14, 1, 3, 3, 14, '09:15:00.000000', '10:00:00.000000', '2024-07-09'),
(15, 1, 3, 3, 15, '09:15:00.000000', '10:00:00.000000', '2024-07-10'),
(16, 1, 3, 3, 16, '09:15:00.000000', '10:00:00.000000', '2024-07-11'),
(17, 1, 3, 3, 17, '09:15:00.000000', '10:00:00.000000', '2024-07-12'),
(18, 1, 3, 3, 18, '09:15:00.000000', '10:00:00.000000', '2024-07-13'),
(19, 1, 5, 4, 19, '10:00:00.000000', '10:45:00.000000', '2024-07-08'),
(20, 1, 5, 4, 20, '10:00:00.000000', '10:45:00.000000', '2024-07-09'),
(21, 1, 5, 4, 21, '10:00:00.000000', '10:45:00.000000', '2024-07-10'),
(22, 1, 5, 4, 22, '10:00:00.000000', '10:45:00.000000', '2024-07-11'),
(23, 1, 5, 4, 23, '10:00:00.000000', '10:45:00.000000', '2024-07-12'),
(24, 1, 5, 4, 24, '10:00:00.000000', '10:45:00.000000', '2024-07-13'),
(25, 1, 6, 5, 25, '10:45:00.000000', '11:30:00.000000', '2024-07-08'),
(26, 1, 6, 5, 26, '10:45:00.000000', '11:30:00.000000', '2024-07-09'),
(27, 1, 6, 5, 27, '10:45:00.000000', '11:30:00.000000', '2024-07-10'),
(28, 1, 6, 5, 28, '10:45:00.000000', '11:30:00.000000', '2024-07-11'),
(29, 1, 6, 5, 29, '10:45:00.000000', '11:30:00.000000', '2024-07-12'),
(30, 1, 6, 5, 30, '10:45:00.000000', '11:30:00.000000', '2024-07-13'),
(31, 2, 12, 6, 62, '07:45:00.000000', '08:30:00.000000', '2024-07-08'),
(32, 2, 12, 6, 63, '07:45:00.000000', '08:30:00.000000', '2024-07-09'),
(33, 2, 12, 6, 64, '07:45:00.000000', '08:30:00.000000', '2024-07-10'),
(34, 2, 12, 6, 65, '07:45:00.000000', '08:30:00.000000', '2024-07-11'),
(35, 2, 12, 6, 66, '07:45:00.000000', '08:30:00.000000', '2024-07-12'),
(36, 2, 12, 6, 67, '07:45:00.000000', '08:30:00.000000', '2024-07-13'),
(37, 2, 11, 5, 56, '08:30:00.000000', '09:15:00.000000', '2024-07-08'),
(38, 2, 11, 5, 57, '08:30:00.000000', '09:15:00.000000', '2024-07-09'),
(39, 2, 11, 5, 58, '08:30:00.000000', '09:15:00.000000', '2024-07-10'),
(40, 2, 11, 5, 59, '08:30:00.000000', '09:15:00.000000', '2024-07-11'),
(41, 2, 11, 5, 59, '08:30:00.000000', '09:15:00.000000', '2024-07-12'),
(42, 2, 11, 5, 61, '08:30:00.000000', '09:15:00.000000', '2024-07-13'),
(43, 2, 10, 4, 50, '09:15:00.000000', '10:00:00.000000', '2024-07-08'),
(44, 2, 10, 4, 51, '09:15:00.000000', '10:00:00.000000', '2024-07-09'),
(45, 2, 10, 4, 52, '09:15:00.000000', '10:00:00.000000', '2024-07-10'),
(46, 2, 10, 4, 53, '09:15:00.000000', '10:00:00.000000', '2024-07-11'),
(47, 2, 10, 4, 54, '09:15:00.000000', '10:00:00.000000', '2024-07-12'),
(48, 2, 10, 4, 55, '09:15:00.000000', '10:00:00.000000', '2024-07-13'),
(49, 2, 9, 3, 44, '10:00:00.000000', '10:45:00.000000', '2024-07-08'),
(50, 2, 9, 3, 45, '10:00:00.000000', '10:45:00.000000', '2024-07-09'),
(51, 2, 9, 3, 46, '10:00:00.000000', '10:45:00.000000', '2024-07-10'),
(52, 2, 9, 3, 47, '10:00:00.000000', '10:45:00.000000', '2024-07-11'),
(53, 2, 9, 3, 48, '10:00:00.000000', '10:45:00.000000', '2024-07-12'),
(54, 2, 9, 3, 49, '10:00:00.000000', '10:45:00.000000', '2024-07-13'),
(55, 2, 8, 2, 38, '10:45:00.000000', '11:30:00.000000', '2024-07-08'),
(56, 2, 8, 2, 39, '10:45:00.000000', '11:30:00.000000', '2024-07-09'),
(57, 2, 8, 2, 40, '10:45:00.000000', '11:30:00.000000', '2024-07-10'),
(58, 2, 8, 2, 41, '10:45:00.000000', '11:30:00.000000', '2024-07-11'),
(59, 2, 8, 2, 42, '10:45:00.000000', '11:30:00.000000', '2024-07-12'),
(60, 2, 8, 2, 43, '10:45:00.000000', '11:30:00.000000', '2024-07-13'),
(61, 2, 7, 1, 31, '12:00:00.000000', '12:45:00.000000', '2024-07-08'),
(62, 2, 7, 1, 32, '12:00:00.000000', '12:45:00.000000', '2024-07-09'),
(63, 2, 7, 1, 33, '12:00:00.000000', '12:45:00.000000', '2024-07-10'),
(64, 2, 7, 1, 34, '12:00:00.000000', '12:45:00.000000', '2024-07-11'),
(65, 2, 7, 1, 35, '12:00:00.000000', '12:45:00.000000', '2024-07-12'),
(66, 2, 7, 1, 36, '12:00:00.000000', '12:45:00.000000', '2024-07-13');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(10) NOT NULL,
  `question_id` int(10) NOT NULL,
  `option` varchar(255) DEFAULT NULL,
  `is_correct` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `question_id`, `option`, `is_correct`) VALUES
(1, 1, 'Warm', '0'),
(2, 1, 'Cold', '1'),
(3, 1, 'Cool', '0'),
(4, 1, 'Hot', '0'),
(5, 2, 'Run', '0'),
(6, 2, 'Quickly', '0'),
(7, 2, 'Apple', '1'),
(8, 2, 'Happy', '0'),
(9, 3, 'On', '1'),
(10, 3, 'Under', '0'),
(11, 3, 'Next', '0'),
(12, 3, 'Over', '0'),
(13, 4, 'Kite', '1'),
(14, 4, 'Kitte', '0'),
(15, 4, 'Kyte', '0'),
(16, 4, 'Kytte', '0'),
(17, 5, 'Doges', '0'),
(18, 5, 'Dogs', '1'),
(19, 5, 'Dog\'s', '0'),
(20, 5, 'Dogs\'', '0'),
(21, 6, 'Slowly', '0'),
(22, 6, 'Beautiful', '1'),
(23, 6, 'Jump', '0'),
(24, 6, 'House', '0'),
(25, 7, 'She are my friend.', '0'),
(26, 7, 'She is my friend.', '1'),
(27, 7, 'She am my friend.', '0'),
(28, 7, 'She be my friend.', '0'),
(29, 8, 'Eat', '0'),
(30, 8, 'Run', '0'),
(31, 8, 'Read', '1'),
(32, 8, 'Sleep', '0'),
(33, 9, 'Buh', '1'),
(34, 9, 'Kuh', '0'),
(35, 9, 'Luh', '0'),
(36, 9, 'Muh', '0'),
(37, 10, 'Jump', '1'),
(38, 10, 'Happy', '0'),
(39, 10, 'Sun', '0'),
(40, 10, 'Quickly', '0');

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`id`, `fullname`, `username`, `password`, `phone_no`) VALUES
(1, 'Rizwan', 'pt001', '$2y$10$oG3Uh.GRZvj92iKVy6Lk1.KgFGDwUhxUL2KWIDQ1CRpjQlbXPRgTi', '03991234567'),
(2, 'Waqar', 'pt002', '$2y$10$Cl9w0dgo4EmzjU0oB.2Z2O56ybVWrrh9c1/8cz1mexp.M0V2CHYT2', '03881234567'),
(3, 'Tariq', 'pt003', '$2y$10$q5TqrEPbAN5r9iAskwza3.CYCroqHmvRVxb8JV3lY0PFVMLKLkA6K', '03771234567'),
(4, 'Qasim', 'pt004', '$2y$10$2fnIEtuV0R7.PKDdFmy27Osksdwx1eiD./3Jyhc4cG0E/J/iwZ90S', '03771234567'),
(5, 'Nadeem', 'pt005', '$2y$10$8igfpt/8xoILv7Zlo5bNe.5bEVW0VzQGyi98re1VvGpoVftNCk8D.', '03661234567'),
(6, 'Kamran', 'pt006', '$2y$10$iFqBh0JJiGi/iv0sd2zyIeMzJqJ56.kFV1UhwJKnfZpDZBYxLzjR2', '03551234567'),
(7, 'Junaid', 'pt007', '$2y$10$M82O0lJLreBAEaa4b0zuEOv5bQJqGOSzpTWuLPWyW2X9EVEtGpQIK', '03441234567'),
(8, 'Arslan', 'pt008', '$2y$10$yuTHKj/uR9kXiuK4mUgR6uLYjyV2y9PjC27FMJ7xVBDAVvUjhRgGy', '03001234567'),
(9, 'Shahzaib', 'pt009', '$2y$10$EzxuHCrhltLh1SkEqQAdrOhtYn8RhyMd3Rtj/T0I6REnXcCt7KJcK', '03111234567'),
(10, 'Saad', 'pt010', '$2y$10$O1x105GCVjxPYSIVqeAfVOouGuHBvD0c4jlYH3blvOx0WjHhqOCym', '03221234567'),
(11, 'Ramzan', 'pt011', '$2y$10$pUPShWxw9AZV3e1SWNQp9uiPnvrbFpXWWXeiKXGu2z9Kd6hmVocQ6', '03441234567');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) NOT NULL,
  `quiz_id` int(10) NOT NULL,
  `question` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `question`) VALUES
(1, 1, 'What is the opposite of \"hot\"?'),
(2, 1, 'Which word is a noun?'),
(3, 1, 'Choose the correct word to complete the sentence: \"The cat is ___ the mat.\"'),
(4, 1, 'Which word is spelled correctly?'),
(5, 1, 'What is the plural form of \"dog\"?'),
(6, 1, 'Which word is an adjective?'),
(7, 1, 'Which sentence is correct?'),
(8, 1, 'Choose the correct word to complete the sentence: \"I like to ___ books.\"'),
(9, 1, 'What sound does the letter \"B\" make?'),
(10, 1, 'Which word is a verb?');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` int(10) NOT NULL,
  `class_id` int(10) NOT NULL,
  `book_id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `total_score` decimal(10,0) NOT NULL,
  `due_date` date NOT NULL,
  `teacher_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `class_id`, `book_id`, `title`, `total_score`, `due_date`, `teacher_id`) VALUES
(1, 1, 1, 'Quiz No 1', 10, '2024-07-12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `class_id` int(10) NOT NULL,
  `book_id` int(10) NOT NULL,
  `obtained_marks` decimal(10,0) NOT NULL,
  `total_marks` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `student_id`, `class_id`, `book_id`, `obtained_marks`, `total_marks`) VALUES
(1, 1, 1, 1, 78, 100),
(2, 1, 1, 2, 80, 100),
(3, 1, 1, 3, 90, 100),
(4, 1, 1, 4, 85, 100),
(5, 1, 1, 5, 90, 100),
(6, 1, 1, 6, 90, 100),
(7, 2, 1, 1, 78, 100),
(8, 2, 1, 2, 87, 100),
(9, 2, 1, 3, 90, 100),
(10, 2, 1, 5, 90, 100),
(11, 2, 1, 6, 83, 100);

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `id` int(10) NOT NULL,
  `teacher_id` int(10) NOT NULL,
  `basic_salary` decimal(10,0) NOT NULL,
  `allowances` decimal(10,0) NOT NULL,
  `salary_month` varchar(10) NOT NULL,
  `salary_year` year(4) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`id`, `teacher_id`, `basic_salary`, `allowances`, `salary_month`, `salary_year`) VALUES
(2, 1, 10000, 1200, '6', '2024'),
(4, 2, 10000, 2000, '6', '2024'),
(5, 3, 10000, 2000, '6', '2024'),
(6, 4, 10000, 2000, '6', '2024'),
(7, 5, 10000, 2000, '6', '2024'),
(8, 6, 12000, 2000, '6', '2024'),
(9, 7, 11000, 2000, '6', '2024'),
(10, 9, 10000, 2000, '6', '2024'),
(11, 10, 10000, 2000, '6', '2024'),
(12, 8, 12000, 1500, '6', '2024'),
(13, 1, 10000, 1500, '7', '2024'),
(14, 2, 10000, 1500, '7', '2024');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(10) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `class_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `fullname`, `father_name`, `username`, `password`, `address`, `phone_no`, `class_id`) VALUES
(1, 'Ahmad Ali', 'Rizwan', 'st001', '$2y$10$8wt79EpKj5EiwlkoAbl4Le9SZ0hwXdZEbOeP3DsJKqemXTxtN19l6', 'House No. 5, Street No. 10, Lahore', '03111234567', 1),
(2, 'Muhammad', 'Waqar', 'st002', '$2y$10$8wt79EpKj5EiwlkoAbl4Le9SZ0hwXdZEbOeP3DsJKqemXTxtN19l6', 'House No. 1, Street No. 2, Lahore', '03001234567', 1),
(3, 'Ahmed', 'Tariq', 'st003', '$2y$10$dz65n1X2Rw0Hf8q.1gyXWeBXRwzVfKGyARBG7LRUOeqSzZdHTQAU6', 'House No. 3, Street No. 7, Lahore', '03221234567', 2),
(4, 'Hassan', 'Qasim', 'st004', '$2y$10$/A4PFxmSRHPD1N/TqEVu7.jBLr67eXK8tYHSmB1hZH8rNRhy/ri7m', 'House No. 15, Street No. 20, Lahore', '03331234567', 2),
(5, 'Bilal', 'Nadeem', 'st005', '$2y$10$Z1hldrVyRWR6Netdt1yKuuAiRAwVV6yQyyIxlMXX0XyDHliJzmRUC', 'House No. 7, Street No. 12, Lahore', '03441234567', 3),
(6, 'Farhan', 'Kamran', 'st006', '$2y$10$N3XjsGZNediqKJEzmizlH.3swSkPzbIrm/sBG4.rRBLNCM1VRUIUy', 'House No. 4, Street No. 8, Lahore', '03441234567', 3),
(7, 'Sohail', 'Junaid', 'st007', '$2y$10$bTuv7XRa/8T59WUggC38qeEt3f81eF3EVg/sroGbKBtTsR9q3oX7e', 'House No. 4, Street No. 8', '03551234567', 4),
(8, 'Asim', 'Arslan', 'st008', '$2y$10$n1LoF2./1ISIoYiWSJhQWOoVK0WUCkS1QxdKSPUtSCZEd7PM5Unru', 'House No. 2, Street No. 5, Lahore', '03661234567', 4),
(9, 'Abdul Hadi', 'Shahzaib', 'st009', '$2y$10$19/oP0g8UoiBbNO1S9C7q.1ppGOWVwJFdFoe/SZbU0NCcTQNotci2', 'House No. 10, Street No. 15, Lahore', '03771234567', 5),
(10, 'Mahmood', 'Saad', 'st010', '$2y$10$2LvCZiamkhgKBtYc1umldOhpBxmg3Bhey8ujCa6b3tgdDmd6DF/Tm', 'House No. 6, Street No. 11, Lahore', '03881234567', 5),
(12, 'xyz', 'xyz', 'st011', '$2y$10$DTQDiyXoOsz5iGSpfuBm4OdfN0NbMIGHuclgb4KnjEtfCuIv1jl0q', 'xyz', '2323', 4);

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE `submission` (
  `id` int(10) NOT NULL,
  `assignment_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `answer` text DEFAULT NULL,
  `score` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submission`
--

INSERT INTO `submission` (`id`, `assignment_id`, `student_id`, `answer`, `score`) VALUES
(1, 1, 1, '<h3><strong>Vocabulary:</strong></h3><ol><li><strong>New Words and Sentences:</strong><ul><li><strong>Brave</strong>: The fireman was very brave.</li><li><strong>Gigantic</strong>: The elephant is a gigantic animal.</li><li><strong>Whisper</strong>: She spoke in a whisper during the movie.</li><li><strong>Excited</strong>: I am excited about my birthday party.</li><li><strong>Journey</strong>: We went on a journey to the mountains.</li></ul></li></ol><h3><strong>Reading Comprehension:</strong></h3><ol><li><strong>Short Story Answers:</strong><ul><li><strong>Main Idea:</strong> The main idea of the story is about a little girl who learns the importance of sharing.</li><li><strong>Main Characters:</strong> The main characters are Lily, her brother Sam, and their dog Max.</li><li><strong>Setting:</strong> The story is set in a small house with a big backyard.</li><li><strong>Lesson Learned:</strong> The lesson learned from the story is that sharing with others makes everyone happy.</li></ul></li></ol><h3><strong>Grammar:</strong></h3><ol><li><strong>Complete the Sentences:</strong><ul><li>She (to go) <strong>goes</strong> to school every day.</li><li>They (to play) <strong>played</strong> in the park yesterday.</li><li>He (to eat) <strong>is eating</strong> his lunch now.</li><li>We (to be) <strong>are</strong> happy to see you.</li></ul></li></ol>', 10),
(2, 2, 12, '<p>answer</p>', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(10) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_no` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `fullname`, `username`, `password`, `address`, `phone_no`) VALUES
(1, 'Ahmed Malik', 'tc001', '$2y$10$oG3Uh.GRZvj92iKVy6Lk1.KgFGDwUhxUL2KWIDQ1CRpjQlbXPRgTi', '345 Boulevard, City', '0333-8765432'),
(2, 'Usman Ali', 'tc002', '$2y$10$sUKdhoJ/hTPu..xuEQjhOuKUYEepCRqSj/27fnRULVzGTzH2Yta0a', '901 Road, City', '0333-6543217'),
(3, 'Imran Khan', 'tc003', '$2y$10$uqP6/lvk1pk/e6gyqaWGSejxpLm2Ib6CP5j2xrVnUJYCdIIEyyWDO', '890 Street, City', '0333-8761234'),
(4, 'Sarfarz Ahmed', 'tc004', '$2y$10$MQBcdsI.vyu8ZRguhxsfL.gStBjbpDw4G4143PpEvW9huelw5tpVC', '012 Lane, City', '0333-2345678'),
(5, 'Zain Khan', 'tc005', '$2y$10$q2YImpoo8Sv9t337CYIBXe84NTvoidARanmHHFoJzvreynBdCaGbS', '567 Avenue, City', '0333-3216789'),
(6, 'Muhammad Ahmed', 'tc006', '$2y$10$DSvE.bKGqe2SaNPsy9Z.Eu.ej2l1uCVhL7tdRbhICaHsrGV7wK.T.', '678 Lane, City', '0333-5432167'),
(7, 'Hassan Ali', 'tc007', '$2y$10$PwWLfM6sW8DzUkCwwQ/wuOgzErWg7v2a2.3k9HmpqYoSJpL5IGtCK', '234 Street, City', '0333-2345678'),
(8, 'Saeed Malik', 'tc008', '$2y$10$YDxGaOCmnlJI.oGsxmILie/EjoJ9ZAzg2Q50PBX2TetIfyi2PZvJK', '456 Avenue, City', '0333-6543210');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_attendance`
--

CREATE TABLE `teacher_attendance` (
  `id` int(10) NOT NULL,
  `teacher_id` int(10) NOT NULL,
  `attendance_status` enum('1','2') NOT NULL,
  `attendance_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_attendance`
--

INSERT INTO `teacher_attendance` (`id`, `teacher_id`, `attendance_status`, `attendance_date`) VALUES
(1, 1, '1', '2024-07-08'),
(2, 2, '1', '2024-07-08'),
(3, 3, '1', '2024-07-08'),
(4, 4, '1', '2024-07-08'),
(5, 5, '1', '2024-07-08'),
(6, 6, '1', '2024-07-08'),
(7, 7, '1', '2024-07-08'),
(8, 8, '1', '2024-07-08');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `fee_id` int(10) NOT NULL,
  `class_id` int(10) NOT NULL,
  `fee_month` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `fee_status` enum('paid','unpaid') NOT NULL DEFAULT 'unpaid',
  `paid_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`id`, `student_id`, `fee_id`, `class_id`, `fee_month`, `due_date`, `fee_status`, `paid_date`) VALUES
(1, 1, 1, 1, 6, '2024-06-10', 'unpaid', NULL),
(2, 2, 1, 1, 6, '2024-06-10', 'unpaid', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attempt_quiz`
--
ALTER TABLE `attempt_quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_selection`
--
ALTER TABLE `course_selection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee`
--
ALTER TABLE `fee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_class_fee` (`class_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecture_schedule`
--
ALTER TABLE `lecture_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_attendance`
--
ALTER TABLE `teacher_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attempt_quiz`
--
ALTER TABLE `attempt_quiz`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `course_selection`
--
ALTER TABLE `course_selection`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `fee`
--
ALTER TABLE `fee`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lectures`
--
ALTER TABLE `lectures`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `lecture_schedule`
--
ALTER TABLE `lecture_schedule`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `submission`
--
ALTER TABLE `submission`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `teacher_attendance`
--
ALTER TABLE `teacher_attendance`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
