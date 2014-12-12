-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2014 at 10:16 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sreg`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `AdminID` int(9) unsigned NOT NULL,
  `AccessCode` int(9) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`AdminID`, `AccessCode`) VALUES
(1, 0),
(19, 0),
(44, 0);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
`CourseID` int(9) NOT NULL,
  `CourseNum` varchar(3) NOT NULL,
  `DepartmentCode` varchar(4) NOT NULL,
  `CourseTitle` varchar(255) NOT NULL,
  `NumCredits` int(1) NOT NULL,
  `Prereq1` int(9) DEFAULT NULL,
  `Prereq2` int(9) DEFAULT NULL,
  `Prereq3` int(9) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`CourseID`, `CourseNum`, `DepartmentCode`, `CourseTitle`, `NumCredits`, `Prereq1`, `Prereq2`, `Prereq3`) VALUES
(0, '0', 'UND', 'None', 0, NULL, NULL, NULL),
(3, '100', 'MAT', 'PowerTrack Math', 3, 0, 0, 0),
(4, '101', 'MAT', 'College Algebra', 3, 3, 0, 0),
(5, '200', 'MAT', 'Applied Statistics', 3, 4, 0, 0),
(6, '201', 'CIS', 'Programming I', 3, 0, 0, 0),
(7, '101', 'ENG', 'Writing', 3, 0, 0, 0),
(8, '202', 'CIS', 'Programming II', 3, 6, 0, 0),
(9, '203', 'CIS', 'Programming in C++', 3, 8, 0, 0),
(10, '204', 'CIS', 'Intro to Visual Basic', 3, 0, 0, 0),
(11, '205', 'CIS', 'Software Engineering', 3, 8, 0, 0),
(12, '206', 'CIS', 'Advanced Java Programming', 3, 8, 11, 0),
(13, '102', 'MAT', 'Calculus I', 3, 0, 0, 0),
(14, '103', 'MAT', 'Calculus II', 3, 13, 0, 0),
(15, '104', 'MAT', 'Discrete Mathematics', 3, 13, 14, 0),
(16, '105', 'MAT', 'Linear Algebra', 3, 14, 0, 0),
(17, '106', 'MAT', 'Probability And Statistics', 3, 14, 15, 0),
(18, '301', 'ENG', 'English I', 3, 0, 0, 0),
(19, '302', 'ENG', 'English II', 3, 18, 0, 0),
(20, '303', 'ENG', 'Intro to Poetry', 3, 0, 0, 0),
(21, '304', 'ENG', 'Autobiography', 3, 19, 0, 0),
(22, '401', 'ECO', 'Intro to Microeconomics', 3, 0, 0, 0),
(23, '402', 'ECO', 'Intro to Macroeconomics', 3, 0, 0, 0),
(24, '403', 'ECO', 'Business Economics', 3, 23, 22, 0),
(25, '501', 'SOC', 'Sociology', 3, 0, 0, 0),
(26, '502', 'SOC', 'Psychology', 3, 0, 0, 0),
(27, '601', 'HIS', 'Western History', 3, 0, 0, 0),
(28, '602', 'HIS', 'Eastern History', 3, 0, 0, 0),
(30, '603', 'HIS', 'Comparative Cultures', 3, 0, 0, 0),
(31, '604', 'HIS', 'US History', 3, 27, 0, 0),
(32, '701', 'BUS', 'Accounting I', 3, 0, 0, 0),
(33, '702', 'BUS', 'Accounting II', 3, 32, 0, 0),
(34, '703', 'BUS', 'Business Finance', 3, 32, 33, 0),
(35, '704', 'BUS', 'Tax Accounting', 3, 34, 0, 0),
(36, '801', 'SCI', 'Biology', 3, 0, 0, 0),
(37, '802', 'SCI', 'Physics', 3, 0, 0, 0),
(38, '803', 'SCI', 'Chemistry', 3, 0, 0, 0),
(39, '804', 'SCI', 'Organic Chemistry', 3, 38, 36, 0),
(40, '503', 'SOC', 'Human Behaviour', 3, 25, 26, 0);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
`DepartmentID` int(9) NOT NULL,
  `DepartmentCode` varchar(4) NOT NULL,
  `DepartmentName` varchar(254) NOT NULL,
  `Location` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`DepartmentID`, `DepartmentCode`, `DepartmentName`, `Location`) VALUES
(1, 'CIS', 'Computer Science', 'Computer Science and Mathematics Bldg. '),
(2, 'MAT', 'Mathematics', 'Computer Science and Mathematics Bldg. '),
(3, 'ENG', 'English', 'English Bldg.'),
(4, 'ECO', 'Economics', 'Economics Bldg.'),
(5, 'SOC', 'Sociology', 'Sociology Bldg.'),
(6, 'HIS', 'History', 'History Bldg.'),
(7, 'SCI', 'Science', 'Science Bldg.'),
(8, 'BUS', 'Business ', 'Business Bldg.'),
(9, 'UND', 'UNDECIDED', 'UNDECIDED');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `facultyID` int(11) unsigned NOT NULL,
  `DepartmentCode` varchar(4) NOT NULL,
  `CurrentRank` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`facultyID`, `DepartmentCode`, `CurrentRank`) VALUES
(22, 'CIS', NULL),
(23, 'CIS', NULL),
(43, 'ENG', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

CREATE TABLE IF NOT EXISTS `lists` (
`id` int(11) NOT NULL,
  `list_name` varchar(255) NOT NULL,
  `list_body` text NOT NULL,
  `list_user_id` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
`LocationID` int(9) NOT NULL,
  `Building` varchar(255) NOT NULL,
  `Room` varchar(7) NOT NULL,
  `MaxCapacity` int(4) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`LocationID`, `Building`, `Room`, `MaxCapacity`) VALUES
(0, 'TBA', '0', 100),
(1, 'Computer Sciences and Mathematics Bldg. ', '1000', 50),
(2, 'Computer Sciences and Mathematics Bldg. ', '1001', 30),
(3, 'Computer Sciences and Mathematics Bldg. ', '2000', 50),
(4, 'Computer Sciences and Mathematics Bldg. ', '2001', 30),
(5, 'Computer Sciences and Mathematics Bldg. ', '3000', 50),
(6, 'Computer Sciences and Mathematics Bldg.', '3001', 30),
(7, 'English Bldg', '1000', 50),
(8, 'English Bdlg', '1001', 30);

-- --------------------------------------------------------

--
-- Table structure for table `major`
--

CREATE TABLE IF NOT EXISTS `major` (
`majorID` int(3) NOT NULL,
  `majorTitle` varchar(255) NOT NULL,
  `DepartmentCode` varchar(4) NOT NULL,
  `type` varchar(5) NOT NULL,
  `totalCredit` int(3) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=202 ;

--
-- Dumping data for table `major`
--

INSERT INTO `major` (`majorID`, `majorTitle`, `DepartmentCode`, `type`, `totalCredit`) VALUES
(1, 'UND', 'UND', 'major', 120),
(100, 'B.S in Computer Science', 'CIS', 'major', 120),
(101, 'Minor in Computer Science', 'CIS', 'minor', 60),
(200, 'B.S in Business Management', 'BUS', 'major', 120),
(201, 'Minor in Business Management', 'BUS', 'minor', 60);

-- --------------------------------------------------------

--
-- Table structure for table `preq`
--

CREATE TABLE IF NOT EXISTS `preq` (
  `courseID` int(9) NOT NULL,
  `prereqID` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `preq`
--

INSERT INTO `preq` (`courseID`, `prereqID`) VALUES
(11, 8),
(12, 8),
(12, 11),
(8, 6);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
`regID` int(5) NOT NULL,
  `studentID` int(11) NOT NULL,
  `CRN` int(9) NOT NULL,
  `SemesterCode` int(9) NOT NULL,
  `courseGrade` varchar(3) NOT NULL DEFAULT 'TBA'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`regID`, `studentID`, `CRN`, `SemesterCode`, `courseGrade`) VALUES
(11, 42, 7, 1, 'TBA'),
(12, 42, 8, 1, 'TBA'),
(13, 42, 14, 1, 'TBA'),
(14, 42, 15, 1, 'TBA'),
(16, 42, 16, 1, 'TBA');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE IF NOT EXISTS `sections` (
`CRN` int(9) NOT NULL,
  `SemesterCode` int(9) NOT NULL,
  `CourseID` int(9) NOT NULL,
  `TimeSlotID` int(5) NOT NULL,
  `LocationID` int(9) NOT NULL,
  `FacultyID` int(11) NOT NULL,
  `CurrentEnroll` int(4) NOT NULL DEFAULT '0',
  `MaxEnroll` int(4) NOT NULL,
  `RemainingEnroll` int(4) NOT NULL,
  `Section` int(3) NOT NULL DEFAULT '1',
  `Level` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`CRN`, `SemesterCode`, `CourseID`, `TimeSlotID`, `LocationID`, `FacultyID`, `CurrentEnroll`, `MaxEnroll`, `RemainingEnroll`, `Section`, `Level`) VALUES
(7, 1, 6, 1020, 1, 23, 1, 30, 29, 2, 'undergraduate'),
(8, 1, 7, 4020, 8, 43, 1, 27, 26, 1, 'undergraduate'),
(9, 1, 3, 3010, 1, 0, 0, 0, 0, 1, 'undergraduate'),
(10, 1, 11, 5010, 3, 23, 0, 25, 25, 1, 'undergraduate'),
(11, 1, 12, 6010, 1, 22, 0, 26, 26, 1, 'undergraduate'),
(12, 1, 8, 2010, 1, 23, 0, 25, 25, 1, 'undergraduate'),
(13, 2, 8, 7020, 4, 22, 0, 12, 12, 1, 'undergraduate'),
(14, 1, 36, 1010, 6, 0, 1, 30, 29, 1, 'undergraduate'),
(15, 1, 10, 4010, 2, 23, 1, 20, 19, 1, 'undergraduate'),
(16, 1, 13, 5020, 4, 0, 2, 20, 18, 1, 'undergraduate'),
(17, 1, 18, 3020, 8, 43, 0, 12, 12, 1, 'undergraduate'),
(18, 1, 10, 5010, 4, 23, 0, 10, 10, 2, 'undergraduate');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE IF NOT EXISTS `semester` (
`SemesterCode` int(9) NOT NULL,
  `Term` varchar(7) NOT NULL,
  `Year` year(4) NOT NULL,
  `WithdrawalDate` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`SemesterCode`, `Term`, `Year`, `WithdrawalDate`) VALUES
(1, 'Fall', 2014, '0000-00-00'),
(2, 'Spring', 2014, '0000-00-00'),
(3, 'Summer', 2014, '0000-00-00'),
(4, 'Winter', 2014, '0000-00-00'),
(5, 'Fall', 2015, '0000-00-00'),
(6, 'Spring', 2015, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `StudentID` int(11) unsigned NOT NULL,
  `CreditsTaken` int(4) DEFAULT '0',
  `CreditsEarned` int(4) DEFAULT '0',
  `GPA` float DEFAULT '0',
  `ClassStanding` varchar(10) DEFAULT 'Good',
  `TotalPoints` int(4) DEFAULT '0',
  `Hold` varchar(255) DEFAULT 'None',
  `balances` int(5) DEFAULT '0',
  `DepartmentCode` varchar(4) NOT NULL,
  `major1` int(3) DEFAULT NULL,
  `major2` int(3) DEFAULT NULL,
  `minor` int(3) DEFAULT NULL,
  `Advisor1` int(11) DEFAULT NULL,
  `Advisor2` int(11) DEFAULT NULL,
  `Advisor3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`StudentID`, `CreditsTaken`, `CreditsEarned`, `GPA`, `ClassStanding`, `TotalPoints`, `Hold`, `balances`, `DepartmentCode`, `major1`, `major2`, `minor`, `Advisor1`, `Advisor2`, `Advisor3`) VALUES
(42, 0, 0, 0, 'Good', 0, 'None', 0, 'CIS', 100, NULL, NULL, NULL, NULL, NULL),
(45, 0, 0, 0, 'Good', 0, 'None', 0, 'UND', 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
`id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `task_body` text NOT NULL,
  `list_id` int(11) NOT NULL,
  `due_date` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

CREATE TABLE IF NOT EXISTS `timeslot` (
  `TimeSlotID` int(5) NOT NULL,
  `Time` varchar(255) NOT NULL,
  `Days` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`TimeSlotID`, `Time`, `Days`) VALUES
(1010, '8:40 AM - 10:10 AM', 'Monday and Wednesday'),
(1020, '8:40 AM - 10:10 AM', 'Tuesday and Thursday'),
(2010, '10:20 AM - 11:50 AM', 'Monday and Wednesday'),
(2020, '10:20 AM - 11:50 AM', 'Tuesday and Thursday'),
(3010, '1:10 PM - 2:40 PM', 'Monday and Wednesday'),
(3020, '1:10 PM - 2:40 PM', 'Tuesday and Thursday'),
(4010, '2:50 PM - 4:20 PM', 'Monday and Wednesday'),
(4020, '2:50 PM - 4:20 PM', 'Tuesday and Thursday'),
(5010, '4:30 PM - 6:00 PM', 'Monday and Wednesday'),
(5020, '4:30 PM - 6:00 PM', 'Tuesday and Thursday'),
(6010, '6:10 PM - 7:40 PM', 'Monday and Wednesday'),
(6020, '6:10 PM - 7:40 PM', 'Tuesday and Thursday'),
(7010, '7:50 PM - 9:20 PM', 'Monday and Wednesday'),
(7020, '7:50 PM - 9:20 PM', 'Tuesday and Thursday');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`ID` int(11) unsigned NOT NULL,
  `username` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(128) NOT NULL,
  `First_Name` varchar(100) NOT NULL,
  `Last_Name` varchar(100) NOT NULL,
  `DOB` date NOT NULL,
  `SSN` varchar(128) NOT NULL,
  `Street` varchar(200) NOT NULL,
  `City` varchar(100) NOT NULL,
  `State` varchar(2) NOT NULL,
  `Zipcode` int(5) NOT NULL,
  `Tel` int(10) NOT NULL,
  `Role` varchar(10) NOT NULL DEFAULT 'Guest',
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `loginAttempts` int(1) NOT NULL DEFAULT '0',
  `accountStatus` varchar(11) NOT NULL DEFAULT 'activated'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `Email`, `Password`, `First_Name`, `Last_Name`, `DOB`, `SSN`, `Street`, `City`, `State`, `Zipcode`, `Tel`, `Role`, `register_date`, `loginAttempts`, `accountStatus`) VALUES
(0, 'TBA', 'TBA@TBA.COM', '815e9f40f79f685fb07735a8905f689f', 'TBA', 'TBA', '2014-11-01', '000000000', 'TBA', 'TBA', 'TB', 0, 0, 'Faculty', '2014-11-24 00:11:46', 0, 'activated'),
(1, 'admin', 'cyrilt@cyril.com', '815e9f40f79f685fb07735a8905f689f', 'Cyril', 'Thomas', '2014-01-01', '123456789', '2154 Enter St', 'East Meadow', 'NY', 11554, 1234567890, 'Admin', '2014-11-04 19:55:46', 0, 'activated'),
(2, 'test1', 'test1@test1.com', '815e9f40f79f685fb07735a8905f689f', 'test1', 'test1', '2014-11-04', '777777777', 'xyz', 'xyz', 'NY', 11111, 1111111111, 'Guest', '2014-11-05 00:31:56', 0, 'activated'),
(19, 'fward', 'fward@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Faraz', 'Ward', '2014-11-08', '111111111', '43 park ave', 'Old Westbury', 'NY', 11770, 222222222, 'Admin', '2014-11-08 20:03:17', 0, 'activated'),
(22, 'ngupta', 'ngupta@gupta.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Naresh', 'Gupta', '2014-11-06', '888888888', 'akjsdakjd akdalkj', 'asasaas', 'NY', 11111, 2147483647, 'Faculty', '2014-11-20 23:30:23', 0, 'activated'),
(23, 'lilihai', 'lilihai@lili.com', '815e9f40f79f685fb07735a8905f689f', 'Lili', 'Hai', '2014-11-03', '999999999', '456 asjasdjalks', 'asdkjaslk', 'ny', 11550, 2147483647, 'Faculty', '2014-11-20 23:36:47', 0, 'activated'),
(24, 'jmathew', 'john@mathew.com', '815e9f40f79f685fb07735a8905f689f', 'John', 'Mathew', '2010-01-27', '893408567', '124 justin st.', 'kingkong', 'WA', 67890, 2147483647, 'Guest', '2014-12-02 20:18:28', 0, 'activated'),
(25, 'jkong', 'kong@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Justin', 'Kong', '1978-12-23', '444444444', '34 faljskas', 'dlkjfslkjd', 'MA', 89012, 2147483647, 'Faculty', '2014-12-02 20:20:39', 0, 'activated'),
(26, 'bbinary', 'bin@binary.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Bin', 'Binary', '1191-11-11', '101010101', '11 101010101', '1101001', 'MD', 11111, 1111111111, 'Guest', '2014-12-02 20:43:45', 0, 'activated'),
(42, 'nwoods', 'nwoods@woods.com', '815e9f40f79f685fb07735a8905f689f', 'Nancy', 'Woods', '1995-12-02', '123451234', '123 hello dr', 'kingston', 'NY', 11554, 1111111111, 'Student', '2014-12-07 21:44:42', 3, 'locked'),
(43, 'mrodriguez', 'mrodriguez@gmail.com', '815e9f40f79f685fb07735a8905f689f', 'Mark', 'Rodriguez', '2014-02-04', '234567891', '56 asile Ave.', 'Anacoda', 'CA', 90991, 2147483647, 'Faculty', '2014-12-07 22:16:55', 0, 'activated'),
(44, 'cdavis', 'cdavis@hotmail.com', '815e9f40f79f685fb07735a8905f689f', 'Cynthia', 'Davis', '1995-12-13', '567891234', '456 Jack Ave', 'Hampton', 'NY', 11112, 2147483647, 'Admin', '2014-12-07 22:19:22', 0, 'activated'),
(45, 'wharris', 'wharris@aol.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Walter', 'Harris', '1991-01-01', '678901234', '678 Karol Rd', 'Jamaica', 'NY', 11418, 2147483647, 'Student', '2014-12-08 00:54:38', 0, 'activated');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
 ADD UNIQUE KEY `AdminID` (`AdminID`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
 ADD PRIMARY KEY (`CourseID`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
 ADD PRIMARY KEY (`DepartmentID`), ADD UNIQUE KEY `DepartmentID` (`DepartmentID`), ADD UNIQUE KEY `DepartmentCode` (`DepartmentCode`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
 ADD PRIMARY KEY (`facultyID`);

--
-- Indexes for table `lists`
--
ALTER TABLE `lists`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
 ADD PRIMARY KEY (`LocationID`);

--
-- Indexes for table `major`
--
ALTER TABLE `major`
 ADD PRIMARY KEY (`majorID`);

--
-- Indexes for table `preq`
--
ALTER TABLE `preq`
 ADD KEY `prereqID` (`prereqID`), ADD KEY `courseID` (`courseID`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
 ADD PRIMARY KEY (`regID`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
 ADD PRIMARY KEY (`CRN`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
 ADD PRIMARY KEY (`SemesterCode`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
 ADD PRIMARY KEY (`StudentID`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timeslot`
--
ALTER TABLE `timeslot`
 ADD PRIMARY KEY (`TimeSlotID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `Email` (`Email`,`SSN`), ADD UNIQUE KEY `username` (`username`), ADD UNIQUE KEY `ID` (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
MODIFY `CourseID` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
MODIFY `DepartmentID` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `lists`
--
ALTER TABLE `lists`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
MODIFY `LocationID` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `major`
--
ALTER TABLE `major`
MODIFY `majorID` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=202;
--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
MODIFY `regID` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
MODIFY `CRN` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
MODIFY `SemesterCode` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
ADD CONSTRAINT `AdminSeparation` FOREIGN KEY (`AdminID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `faculty`
--
ALTER TABLE `faculty`
ADD CONSTRAINT `FacultyCheck` FOREIGN KEY (`facultyID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `preq`
--
ALTER TABLE `preq`
ADD CONSTRAINT `coureID` FOREIGN KEY (`courseID`) REFERENCES `course` (`CourseID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `prereqID` FOREIGN KEY (`prereqID`) REFERENCES `course` (`CourseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
ADD CONSTRAINT `StudentUserID` FOREIGN KEY (`StudentID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
