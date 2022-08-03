-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 10, 2022 at 02:16 PM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grader`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_ex`
--

CREATE TABLE `tb_ex` (
  `ex_no` int(11) NOT NULL COMMENT 'ลำดับโจทย์',
  `ex_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ชื่อโจทย์',
  `pdf` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ชื่อไฟล์เอกสาร',
  `sub_name` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ชื่อห้องเรียน',
  `score` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'คะแนนเต็ม',
  `deadline` date NOT NULL COMMENT 'กำหนดส่ง',
  `in1` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ไฟล์ข้อมูลทดสอบที่1',
  `in2` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ไฟล์ข้อมูลทดสอบที่2',
  `in3` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ไฟล์ข้อมูลทดสอบที่3',
  `in4` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ไฟล์ข้อมูลทดสอบที่4',
  `in5` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ไฟล์ข้อมูลทดสอบที่5',
  `in6` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ไฟล์ข้อมูลทดสอบที่6',
  `in7` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ไฟล์ข้อมูลทดสอบที่7',
  `in8` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ไฟล์ข้อมูลทดสอบที่8',
  `in9` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ไฟล์ข้อมูลทดสอบที่9',
  `in10` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ไฟล์ข้อมูลทดสอบที่10',
  `out1` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ไฟล์ข้อมูลผลลัพธ์ที่1',
  `out2` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ไฟล์ข้อมูลผลลัพธ์ที่2',
  `out3` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ไฟล์ข้อมูลผลลัพธ์ที่3',
  `out4` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ไฟล์ข้อมูลผลลัพธ์ที่4',
  `out5` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ไฟล์ข้อมูลผลลัพธ์ที่5',
  `out6` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ไฟล์ข้อมูลผลลัพธ์ที่6',
  `out7` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ไฟล์ข้อมูลผลลัพธ์ที่7',
  `out8` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ไฟล์ข้อมูลผลลัพธ์ที่8',
  `out9` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ไฟล์ข้อมูลผลลัพธ์ที่9',
  `out10` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ไฟล์ข้อมูลผลลัพธ์ที่10',
  `status_ex` enum('เปิด','ปิด') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'เปิด' COMMENT 'สถานะการมองเห็น'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_sub`
--

CREATE TABLE `tb_sub` (
  `sub_no` int(11) NOT NULL COMMENT 'ลำดับห้องเรียน',
  `sub_name` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ชื่อห้องเรียน',
  `sub_id` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'รหัสห้องเรียน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_submission`
--

CREATE TABLE `tb_submission` (
  `submission_id` int(11) NOT NULL COMMENT 'ลำดับการส่งงาน',
  `user_id` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ลำดับผู้ใช้',
  `user_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ชื่อ',
  `user_surname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'นามสกุล',
  `user_stdcode` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'รหัสนิสิต',
  `ex_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ชื่อโจทย์',
  `cpp` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ไฟล์งานที่ส่ง',
  `test_score` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'คะแนนที่ได้',
  `datetime` date NOT NULL COMMENT 'วัน-เวลาที่ส่งงาน',
  `status` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'สถานะการส่งงาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(10) NOT NULL COMMENT 'ลำดับผู้ใช้',
  `user_username` varchar(30) NOT NULL COMMENT 'ชื่อผู้ใช้',
  `user_password` varchar(50) NOT NULL COMMENT 'รหัสผ่าน',
  `user_name` varchar(60) NOT NULL COMMENT 'ชื่อ',
  `user_surname` varchar(60) NOT NULL COMMENT 'นามสกุล',
  `user_sec` enum('700','800') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'หมู่เรียน',
  `user_stdcode` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'รหัสนิสิต',
  `user_level` enum('student','teacher') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'student' COMMENT 'ระดับผู้ใช้'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `user_username`, `user_password`, `user_name`, `user_surname`, `user_sec`, `user_stdcode`, `user_level`) VALUES
(1, 'admin', '123', 'admin', 'admin', '700', '', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_ex`
--
ALTER TABLE `tb_ex`
  ADD PRIMARY KEY (`ex_no`);

--
-- Indexes for table `tb_sub`
--
ALTER TABLE `tb_sub`
  ADD PRIMARY KEY (`sub_no`);

--
-- Indexes for table `tb_submission`
--
ALTER TABLE `tb_submission`
  ADD PRIMARY KEY (`submission_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_ex`
--
ALTER TABLE `tb_ex`
  MODIFY `ex_no` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ลำดับโจทย์';

--
-- AUTO_INCREMENT for table `tb_sub`
--
ALTER TABLE `tb_sub`
  MODIFY `sub_no` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ลำดับห้องเรียน';

--
-- AUTO_INCREMENT for table `tb_submission`
--
ALTER TABLE `tb_submission`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ลำดับการส่งงาน';

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ลำดับผู้ใช้', AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
