-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2023 at 06:09 AM
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
-- Database: `libertyposts`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `catID` int(11) NOT NULL,
  `categories` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catID`, `categories`) VALUES
(1, 'Politics'),
(2, 'Education'),
(3, 'Technology'),
(4, 'World'),
(5, 'Lifestyle'),
(6, 'Sport'),
(7, 'Entertainment'),
(8, 'History');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comID` int(11) NOT NULL,
  `postID` int(50) NOT NULL,
  `cname` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `com_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comID`, `postID`, `cname`, `comment`, `com_date`) VALUES
(5, 1, 'Soji kola ', 'nice writeup', 'Jun 19, 2023'),
(6, 1, 'Abdul-Jelil', 'how can we upgrade health sector', 'Jun 19, 2023'),
(7, 1, 'ola', 'we good hospital in our nation', 'Jun 19, 2023'),
(8, 2, 'Abdulwasi', 'www', 'Jun 19, 2023');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `link` text NOT NULL,
  `postTitle` varchar(150) NOT NULL,
  `headline` text NOT NULL,
  `img` varchar(50) NOT NULL,
  `post_txt` text NOT NULL,
  `date_post` varchar(50) NOT NULL,
  `cat` int(5) NOT NULL,
  `tre` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postID`, `userID`, `link`, `postTitle`, `headline`, `img`, `post_txt`, `date_post`, `cat`, `tre`) VALUES
(1, 1, 'A-Hospital-Management-System', 'A Hospital Management System', 'A Hospital Management System is an integrated information system for managing all aspects of a hospital’s operations such as medical, financial, admin', 'img168703840514.jpeg', '<p>A Hospital Management System is an integrated information system for managing all aspects of a hospital&rsquo;s operations such as medical, financial, administrative, legal, and compliance. It includes electronic health records, business intelligence, and revenue cycle management. Hospitals and healthcare facilities improve the quality of healthcare services, reduce operating costs, and improve the revenue cycle by using such hospital management systems.</p>\r\n\r\n<p>Hospital Management System Systems is a customizable, comprehensive, and integrated Hospital Management System designed to manage all hospital operations. The ideal client base for Hospital Management System is Healthcare facilities, multi-specialty clinics, and medical practitioners.</p>\r\n\r\n<p>Multi-Location functionality allows your hospitals, satellite clinics, and medical stores to be interconnected. Traditional approaches encompass paper-based information processing as well as resident work position and mobile data acquisition and presentation. The customizable alert software sends the text, IM, and email reminders and improves the quality of patient care. This hospital management software helps you to be aware of revenue streams, patient records, and other critical metrics in real-time at your fingertips.</p>\r\n\r\n<p><strong>The Project Plan defines the following:</strong></p>\r\n\r\n<ul>\r\n	<li>\r\n	<ul style=\"list-style-type:disc\">\r\n		<li>Project purpose</li>\r\n		<li>Business and project goals and objectives</li>\r\n		<li>Scope And Expectations</li>\r\n		<li>Roles and responsibilities</li>\r\n		<li>Assumptions and constraints</li>\r\n		<li>Project management approach ground rules for the project</li>\r\n		<li>Project budget project timeline</li>\r\n	</ul>\r\n	</li>\r\n</ul>\r\n', 'Jun 17, 2023', 2, '1'),
(2, 1, 'WEB-DESIGN', 'WEB DESIGN', 'Web design is the process of planning, conceptualizing, and arranging content online. Today, designing a website goes beyond aesthetics to include the', 'img168703868177.jpeg', '<p><strong>WEB DESIGN</strong></p>\r\n\r\n<p>Web design is the process of planning, conceptualizing, and arranging content online. Today, designing a website goes beyond aesthetics to include the website&rsquo;s overall functionality. Web design also includes web apps, mobile apps, and user interface design.</p>\r\n\r\n<p>Web design is a similar process of creation, with the intention of presenting the content on electronic web pages, which the end-users can access through the internet with the help of a web browser.</p>\r\n\r\n<p>Web design encompasses many different skills and disciplines in the production and maintenance of websites. The different areas of web design include web graphic design; user interface design (UI design); authoring, including standardized code and proprietary software; user experience design (UX design); and search engine optimization. Often many individuals will work in teams covering different aspects of the design process, although some designers will cover them all.</p>\r\n\r\n<p>The term &quot;web design&quot; is normally used to describe the design process relating to the front-end (client side) design of a website including writing markup. Web design partially overlaps web engineering in the broader scope of web development. Web designers are expected to have an awareness of usability and if their role involves creating markup then they are also expected to be up to date with web accessibility guidelines.</p>\r\n', 'Jun 17, 2023', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `fullname`, `email`, `phone`, `username`, `pass`) VALUES
(1, 'Abdulwasi Biodun Popoola ', 'adihzah2013@gmail.com', '08093577533', 'abdulwasi', '5e8edd851d2fdfbd7415232c67367cc3'),
(2, 'AbdulKabir Ajibola Olasunmade', 'jayboy@gmail.com', '07065929048', 'jayboy', '5e8edd851d2fdfbd7415232c67367cc3');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `ipID` int(11) NOT NULL,
  `visitor_ip` varchar(50) NOT NULL,
  `firstVisit` varchar(50) NOT NULL,
  `lastVisit` varchar(50) NOT NULL,
  `mob` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`ipID`, `visitor_ip`, `firstVisit`, `lastVisit`, `mob`) VALUES
(1, '::1', '23-06-23', '24-06-23', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`catID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`ipID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `catID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `ipID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
