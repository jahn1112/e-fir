SET FOREIGN_KEY_CHECKS=0;  
-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2023 at 07:48 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS ;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_info`
--

-- --------------------------------------------------------

--
-- Table structure for table `area_master`
--

CREATE TABLE `area_master` (
  `area_id` int(5) NOT NULL,
  `a_name` varchar(100) NOT NULL,
  `city_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `area_master`
--

INSERT INTO `area_master` (`area_id`, `a_name`, `city_id`) VALUES
(1, 'xyz,vastrapur', 0);

-- --------------------------------------------------------

--
-- Table structure for table `city_table`
--

CREATE TABLE `city_table` (
  `city_id` int(5) NOT NULL,
  `c_name` varchar(20) DEFAULT NULL,
  `state_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city_table`
--

INSERT INTO `city_table` (`city_id`, `c_name`, `state_id`) VALUES
(2, 'Ahmedabad City', 1),
(3, 'Ahmedabad Rural', 1),
(4, 'Amreli', 1),
(5, 'Bhavanagar', 1),
(6, 'Junagadh', 1),
(7, 'Rajkot', 1),
(8, 'Surat', 1),
(9, 'Vadodara', 1),
(10, 'vapi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `country_table`
--

CREATE TABLE `country_table` (
  `cntry_id` int(5) NOT NULL,
  `cntry_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `country_table`
--

INSERT INTO `country_table` (`cntry_id`, `cntry_name`) VALUES
(1, 'India');

-- --------------------------------------------------------

--
-- Table structure for table `document_table`
--

CREATE TABLE `document_table` (
  `document_id` int(5) NOT NULL,
  `doc_type` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document_table`
--

INSERT INTO `document_table` (`document_id`, `doc_type`) VALUES
(1, 'Aadhar Card'),
(2, 'Pan Card'),
(3, 'Voter ID');

-- --------------------------------------------------------

--
-- Table structure for table `e_application_table`
--

CREATE TABLE `e_application_table` (
  `e_application_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `occurance_address` varchar(70) NOT NULL,
  `pincode` int(6) NOT NULL,
  `police_station_id` int(5) NOT NULL,
  `application_type` varchar(20) NOT NULL,
  `occurance_date` date NOT NULL,
  `occurance_time` time NOT NULL,
  `brief_desc` varchar(300) NOT NULL,
  `action_taken` varchar(30) DEFAULT 'Pending',
  `document_id` int(5) NOT NULL,
  `Remarks_act` varchar(50) DEFAULT NULL,
  `sbmt_date` date NOT NULL DEFAULT current_timestamp(),
  `action_takenBY` varchar(50) DEFAULT '---'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `e_application_table`
--

INSERT INTO `e_application_table` (`e_application_id`, `user_id`, `occurance_address`, `pincode`, `police_station_id`, `application_type`, `occurance_date`, `occurance_time`, `brief_desc`, `action_taken`, `document_id`, `Remarks_act`, `sbmt_date`, `action_takenBY`) VALUES
(1, 1, 'Vastrapurlake,Ahmedabad,360078', 360078, 10, 'Cyber crime', '2023-02-01', '06:59:39', 'WHEN I\'M tranfered Money from my bank account to my cilent bank account than someone trying fishing and it was thef my money', 'Under Scrutiny', 1, 'Not yet verified', '2023-02-22', 'Arpit Patel'),
(2, 2, 'Maninagar,Ahmedabad - 380007', 380007, 5, 'Application', '2023-01-05', '05:16:11', 'we want to out of india purpose of Studing in master Degree, So approved appointmnet  passport verification..', 'Approved', 2, 'done', '2023-02-22', 'PARIMAL'),
(3, 1, 'Ambawadi,Nehrunagar Circle,Ahmedadbad - 360015', 360015, 5, 'Information', '2023-01-26', '12:37:32', 'we are organized music event so we are playing sound late night according rules and guidlines', 'Approved', 1, 'test', '2023-02-22', 'Arpit');

-- --------------------------------------------------------

--
-- Table structure for table `e_fir_master`
--

CREATE TABLE `e_fir_master` (
  `e_fir_id` int(8) NOT NULL,
  `user_id` int(5) NOT NULL,
  `occurrance_area` varchar(100) NOT NULL,
  `police_station_occurance_place` varchar(55) NOT NULL,
  `types_of_fir_id` int(5) NOT NULL,
  `file_name` longtext DEFAULT NULL,
  `occurance_pincode` int(6) NOT NULL,
  `distance_from_ps` int(3) DEFAULT NULL,
  `outside_the_limit_of_this_ps_then_name_of_ps` varchar(40) DEFAULT NULL,
  `occurence_of_offence_date_from` date DEFAULT NULL,
  `occurence_of_offence_date_to` date DEFAULT NULL,
  `occurenece_of_offence_time_from` time DEFAULT NULL,
  `occurenece_of_offence_time_to` time DEFAULT NULL,
  `occupation` varchar(50) DEFAULT NULL,
  `first_info_contents` varchar(3000) DEFAULT NULL,
  `delayed_reason` varchar(200) DEFAULT NULL,
  `action_taken` varchar(30) DEFAULT 'Pending',
  `Remarks_act` varchar(50) DEFAULT NULL,
  `sbmt_date` date NOT NULL DEFAULT current_timestamp(),
  `action_takenBY` varchar(50) DEFAULT '---'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `e_fir_master`
--

INSERT INTO `e_fir_master` (`e_fir_id`, `user_id`, `occurrance_area`, `police_station_occurance_place`, `types_of_fir_id`, `file_name`, `occurance_pincode`, `distance_from_ps`, `outside_the_limit_of_this_ps_then_name_of_ps`, `occurence_of_offence_date_from`, `occurence_of_offence_date_to`, `occurenece_of_offence_time_from`, `occurenece_of_offence_time_to`, `occupation`, `first_info_contents`, `delayed_reason`, `action_taken`, `Remarks_act`, `sbmt_date`, `action_takenBY`) VALUES
(1, 1, 'SP HOSTEL', 'GUJARAT UNIVERSITY POLICE STATION', 2, NULL, 360008, 2, NULL, '2023-03-09', '2023-03-09', '00:37:00', '00:38:00', 'student', 'dfgd', '', 'Pending', NULL, '2023-03-09', '---'),
(2, 1, 'SP HOSTEL', 'GUJARAT UNIVERSITY POLICE STATION', 2, NULL, 360008, 2, NULL, '2023-03-09', '2023-03-09', '00:37:00', '00:38:00', 'student', 'dfgd', '', 'Pending', NULL, '2023-03-09', '---'),
(3, 1, 'POST-OFFICE ROAD,DEVLA ROAD,DEVALKI-365480', 'GUJARAT UNIVERSITY POLICE STATION', 2, NULL, 365480, 2, NULL, '2023-03-09', '2023-03-09', '01:42:00', '00:43:00', 'student', 'w3ertgthy', '', 'Pending', NULL, '2023-03-09', '---'),
(4, 4, 'POST-OFFICE ROAD,DEVLA ROAD,DEVALKI-365480', 'GUJARAT UNIVERSITY POLICE STATION', 2, NULL, 365480, 2, NULL, '2023-03-09', '2023-03-09', '01:42:00', '00:43:00', 'student', 'w3ertgthy', '', 'Pending', NULL, '2023-03-09', '---'),
(5, 2, 'SP HOSTEL', 'GUJARAT UNIVERSITY POLICE STATION', 1, NULL, 360008, 2, NULL, '2023-03-10', '2023-03-10', '23:48:00', '22:48:00', 'student', 'Jupiter Stolen', '', 'Pending', NULL, '2023-03-10', '---'),
(6, 1, 'Law GARDEN', 'ELLISBRIDGE POLICE STATION', 1, 'BCA Sem. V Practical Programme November 2022 (2).pdf', 360008, 1, NULL, '2023-03-10', '2023-03-10', '21:54:00', '21:54:00', 'student', 'PLATINA BIKE STOLEN', '', 'Pending', NULL, '2023-03-10', '---'),
(7, 4, 'sp hostel', 'GUJARAT UNIVERSITY POLICE STATION', 1, 'E-FIR.drawio.pdf', 360008, 12, NULL, '2023-03-12', '2023-03-19', '22:53:00', '22:54:00', 'student', 'DEDF', 'DFERGFD', 'Pending', NULL, '2023-03-12', '---'),
(8, 2, 'sp hostel', 'GUJARAT UNIVERSITY POLICE STATION', 1, 'E-FIR.drawio.pdf', 360008, 12, NULL, '2023-03-12', '2023-03-19', '22:53:00', '22:54:00', 'student', 'DEDF', 'DFERGFD', 'Pending', NULL, '2023-03-12', '---'),
(9, 4, 'sp hostel', 'GUJARAT UNIVERSITY POLICE STATION', 1, 'E-FIR.drawio.pdf', 360008, 12, NULL, '2023-03-12', '2023-03-19', '22:53:00', '22:54:00', 'student', 'DEDF', 'DFERGFD', 'Pending', NULL, '2023-03-12', '---'),
(10, 1, 'LD COLLEGE', 'GUJARAT UNIVERSITY POLICE STATION', 2, 'GSRTC_.pdf', 360008, 12, NULL, '2023-03-12', '2023-03-19', '22:56:00', '22:57:00', 'student', 'wdacdvfb', 'vd', 'Pending', NULL, '2023-03-12', '---'),
(11, 5, 'ahmedabad', 'GUJARAT UNIVERSITY POLICE STATION', 2, 'images.jpg', 395005, 5, NULL, '2022-03-01', '2022-03-05', '02:00:00', '03:00:00', 'student', 'precius object stolen', 'personal', 'Assign to IO', 'Assign to IO', '2023-03-21', 'Arpit PAtel PSO'),
(12, 6, 'gujarat university', 'GUJARAT UNIVERSITY POLICE STATION', 2, 'FIRCopy.pdf', 395005, 5, NULL, '2022-03-01', '2022-03-02', '14:00:00', '22:00:00', 'student', 'mobile stolen', 'personal', 'Approved', 'fdf', '2023-03-23', 'fd'),
(13, 5, 'Near LD COLLEGE', 'GUJARAT UNIVERSITY POLICE STATION', 1, 'FIR - Dashboard.pdf', 360010, 2, NULL, '2023-03-01', '2023-03-02', '23:45:00', '12:46:00', 'Student', 'Stolen Vehicle from LD College,Ahmedabad', '', 'Approved', 'Approve and next process', '2023-03-23', 'Parimal PAtel  IO');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_table`
--

CREATE TABLE `feedback_table` (
  `feedback_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `feedback_sub` varchar(20) NOT NULL,
  `feedback_desc` varchar(2000) DEFAULT NULL,
  `feedback_date` date DEFAULT current_timestamp(),
  `action_taken` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nationality_table`
--

CREATE TABLE `nationality_table` (
  `nationality_id` int(5) NOT NULL,
  `cntry_id` int(5) NOT NULL,
  `nationally_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nationality_table`
--

INSERT INTO `nationality_table` (`nationality_id`, `cntry_id`, `nationally_name`) VALUES
(1, 1, 'Indian');

-- --------------------------------------------------------

--
-- Table structure for table `police_master`
--

CREATE TABLE `police_master` (
  `p_id` int(5) NOT NULL,
  `p_name` varchar(50) NOT NULL,
  `p_dob` date NOT NULL,
  `p_contact` bigint(10) NOT NULL,
  `p_email` varchar(40) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `designation` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `police_master`
--

INSERT INTO `police_master` (`p_id`, `p_name`, `p_dob`, `p_contact`, `p_email`, `username`, `password`, `designation`) VALUES
(1, 'Parimal Rokad', '2002-11-02', 6353378846, 'prokad12345@gmail.com', 'parimal123', 'parimal@123', 'Investigation Officer'),
(2, 'Arpit Patel', '2003-01-05', 7874736806, 'arpitpatel123@gmail.com', 'arpit123', 'arpit@123', 'Police Station Officer');

-- --------------------------------------------------------

--
-- Table structure for table `police_station_table`
--

CREATE TABLE `police_station_table` (
  `police_station_id` int(5) NOT NULL,
  `ps_address` varchar(30) NOT NULL,
  `ps_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `police_station_table`
--

INSERT INTO `police_station_table` (`police_station_id`, `ps_address`, `ps_name`) VALUES
(1, 'Kalupur,Ahmedabad', 'Ahmedabad Railway'),
(2, 'Bapunagar,Ahmedabad', 'Bapunagar'),
(3, 'Bodakdev,Ahmedabad', 'Bodakdev'),
(4, 'Ellisbridge,Ahmedabad', 'Ellisbridge'),
(5, 'Gujarat University,Ahmedabad', 'Gujarat University'),
(6, 'Nikol,Ahmedabad', 'Nikol'),
(7, 'Ranip,Ahmedabad', 'Ranip'),
(8, 'Sabarmati River Front,Ahmedaba', 'Sabarmati River front'),
(9, 'Sattelite,Ahmedabad', 'Satellite'),
(10, 'Vastrapur,Ahmedabad', 'Vastrapur'),
(11, 'Sarkhej,Ahmedabad', 'Sarkhej');

-- --------------------------------------------------------

--
-- Table structure for table `question_table`
--

CREATE TABLE `question_table` (
  `que_id` int(5) NOT NULL,
  `questions` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question_table`
--

INSERT INTO `question_table` (`que_id`, `questions`) VALUES
(1, 'What is your nickname?'),
(2, 'What is your favourite food?'),
(3, 'What is your favourite place?'),
(4, 'Who is your favourite cricketer?'),
(5, 'Which is your birth place?'),
(6, 'Who is your ideal person?');

-- --------------------------------------------------------

--
-- Table structure for table `religion_table`
--

CREATE TABLE `religion_table` (
  `religion_id` int(5) NOT NULL,
  `religion_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `religion_table`
--

INSERT INTO `religion_table` (`religion_id`, `religion_name`) VALUES
(1, 'Buddhist'),
(2, 'Christian'),
(3, 'Donyipolo'),
(4, 'Hindu'),
(5, 'Islam'),
(6, 'Jain'),
(7, 'Jews/Yehudi'),
(8, 'Muslim'),
(9, 'Other'),
(10, 'Parsi'),
(11, 'Sikh');

-- --------------------------------------------------------

--
-- Table structure for table `report_missing_person_table`
--

CREATE TABLE `report_missing_person_table` (
  `Report_Missing_Person_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `surname` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(7) NOT NULL,
  `missing_date` date NOT NULL,
  `missing_time` time NOT NULL,
  `religion_id` int(5) NOT NULL,
  `caste` varchar(30) NOT NULL,
  `category` varchar(25) NOT NULL,
  `occupation` varchar(30) NOT NULL,
  `height(cm)` int(5) NOT NULL,
  `weight(kgs)` int(5) NOT NULL,
  `missing_person_description` varchar(2000) NOT NULL,
  `area` varchar(70) NOT NULL,
  `pincode` int(6) NOT NULL,
  `police_station_id` int(5) NOT NULL,
  `brief_description` varchar(3000) NOT NULL,
  `action_taken` varchar(30) DEFAULT 'Pending',
  `document_id` int(5) NOT NULL,
  `Remarks_act` varchar(50) DEFAULT NULL,
  `sbmt_date` date NOT NULL DEFAULT current_timestamp(),
  `action_takenBY` varchar(50) NOT NULL DEFAULT '---',
  `doc_name` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report_missing_person_table`
--

INSERT INTO `report_missing_person_table` (`Report_Missing_Person_id`, `user_id`, `first_name`, `middle_name`, `surname`, `dob`, `gender`, `missing_date`, `missing_time`, `religion_id`, `caste`, `category`, `occupation`, `height(cm)`, `weight(kgs)`, `missing_person_description`, `area`, `pincode`, `police_station_id`, `brief_description`, `action_taken`, `document_id`, `Remarks_act`, `sbmt_date`, `action_takenBY`, `doc_name`) VALUES
(4, 2, 'Parimal', 'Jaysukhbhai', 'Savaj', '2001-03-17', 'Male', '2008-03-08', '10:00:00', 4, 'Hindu', 'General', 'Student', 165, 65, 'Wheatish', 'Sp boys hostel', 365002, 5, 'savaj is studied in college second year and he was missing in 2 days and yet not come.', 'Pending', 1, NULL, '2023-03-23', '---', ''),
(5, 5, 'sumit', 'pareshbhai', 'savaliya', '2002-11-02', 'Male', '2023-03-23', '22:46:00', 4, 'Patel', 'General', 'Student', 165, 85, 'COLOR:Black and Stylish', 'IIM institute', 360009, 5, 'When we are going near college at same time some person fight with him and kidnaped.. yet not about him', 'Pending', 1, NULL, '2023-03-23', '---', '');

-- --------------------------------------------------------

--
-- Table structure for table `senior_citizen_reg_table`
--

CREATE TABLE `senior_citizen_reg_table` (
  `sc_reg_id` int(17) NOT NULL,
  `user_id` int(5) NOT NULL,
  `city_id` int(5) NOT NULL,
  `sc_fname` varchar(30) NOT NULL,
  `sc_mname` varchar(35) NOT NULL,
  `sc_lname` varchar(35) NOT NULL,
  `police_station_id` int(5) NOT NULL,
  `year_retirement` int(5) NOT NULL,
  `retired_institute` varchar(100) NOT NULL,
  `health` varchar(50) NOT NULL,
  `family` varchar(50) NOT NULL,
  `residing_with` varchar(20) NOT NULL,
  `no_of_child` int(5) NOT NULL,
  `spouse_name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `wedding_date` date NOT NULL,
  `lst_plc_visit_date` date NOT NULL,
  `relative_details` varchar(100) NOT NULL,
  `action_taken` varchar(30) DEFAULT 'Pending',
  `action_takenBY` varchar(50) NOT NULL DEFAULT '---',
  `document_id` int(5) NOT NULL,
  `Remarks_act` varchar(50) DEFAULT NULL,
  `reg_date_time` date NOT NULL DEFAULT current_timestamp(),
  `doc_name` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `senior_citizen_reg_table`
--

INSERT INTO `senior_citizen_reg_table` (`sc_reg_id`, `user_id`, `city_id`, `sc_fname`, `sc_mname`, `sc_lname`, `police_station_id`, `year_retirement`, `retired_institute`, `health`, `family`, `residing_with`, `no_of_child`, `spouse_name`, `dob`, `wedding_date`, `lst_plc_visit_date`, `relative_details`, `action_taken`, `action_takenBY`, `document_id`, `Remarks_act`, `reg_date_time`, `doc_name`) VALUES
(1, 5, 2, 'Kenish', 'Vinodbhai', 'Sorathiya', 5, 1964, '', 'Good', 'Joint', 'Children', 2, 'Mansiben', '1901-03-02', '1922-03-05', '2015-03-08', 'Relative', 'Pending', '---', 1, NULL, '2023-03-23', '');

-- --------------------------------------------------------

--
-- Table structure for table `state_table`
--

CREATE TABLE `state_table` (
  `state_id` int(5) NOT NULL,
  `state_name` varchar(20) DEFAULT NULL,
  `cntry_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `state_table`
--

INSERT INTO `state_table` (`state_id`, `state_name`, `cntry_id`) VALUES
(1, 'Gujarat', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stolen_mobile_table`
--

CREATE TABLE `stolen_mobile_table` (
  `stolen_mobile_id` int(7) NOT NULL,
  `e_fir_id` int(8) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `model` varchar(20) NOT NULL,
  `imei_number` varchar(15) NOT NULL,
  `approx_price` int(7) NOT NULL,
  `manufacturing_year` varchar(15) NOT NULL,
  `service_provider` varchar(6) NOT NULL,
  `color` varchar(10) NOT NULL,
  `description_of_mobile` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stolen_mobile_table`
--

INSERT INTO `stolen_mobile_table` (`stolen_mobile_id`, `e_fir_id`, `mobile_number`, `model`, `imei_number`, `approx_price`, `manufacturing_year`, `service_provider`, `color`, `description_of_mobile`) VALUES
(1, 1, '6353378846', 'Iphone 13', '345678999876543', 65222, '2023-03', 'jio', 'white', 'Apple'),
(2, 2, '6353378846', 'Iphone 13', '345678999876543', 65222, '2023-03', 'jio', 'white', 'Apple'),
(3, 3, '6353378846', 'ewrgfth', '345678999876543', 569835, '2023-03', 'JIo', 'efrghj', 'iuheds'),
(4, 4, '6353378846', 'ewrgfth', '345678999876543', 569835, '2023-03', 'JIo', 'efrghj', 'iuheds'),
(5, 10, '6353378846', 'redmi', '345678999876543', 65000, '2022-07', 'jio', 'black', 'fedg'),
(6, 11, '7874736806', '2018', '787456823333511', 15000, '2018-02', 'jio', 'black', 'slim and black flip cover'),
(7, 12, '9510926080', 'vivo v9', '78523645988', 15000, '2018-02', 'jio', 'black', 'mobile flip cover');

-- --------------------------------------------------------

--
-- Table structure for table `types_of_fir_table`
--

CREATE TABLE `types_of_fir_table` (
  `types_of_FIR_id` int(5) NOT NULL,
  `fir_type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `types_of_fir_table`
--

INSERT INTO `types_of_fir_table` (`types_of_FIR_id`, `fir_type`) VALUES
(1, 'Vehicle'),
(2, 'Mobile');

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `user_id` int(5) NOT NULL,
  `address` varchar(60) NOT NULL,
  `que_id` int(5) NOT NULL,
  `nationality_id` int(5) NOT NULL,
  `user_fname` varchar(25) NOT NULL,
  `user_mname` varchar(25) DEFAULT NULL,
  `user_lname` varchar(25) NOT NULL,
  `contact_no` bigint(10) NOT NULL,
  `user_dob` date NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `q_ans` varchar(200) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `religion_id` int(5) NOT NULL,
  `occupation` varchar(30) NOT NULL,
  `pincode` bigint(6) NOT NULL,
  `document_id` int(5) NOT NULL,
  `doc_no` varchar(30) NOT NULL,
  `reg_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_master`
--

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_table`
--

CREATE TABLE `vehicle_table` (
  `vehicle_id` int(7) NOT NULL,
  `e_fir_id` int(8) NOT NULL,
  `vehicle_type` varchar(15) DEFAULT NULL,
  `name_of_manufacture` varchar(20) DEFAULT NULL,
  `model` varchar(15) DEFAULT NULL,
  `engine_number` varchar(10) DEFAULT NULL,
  `chassis_number` varchar(20) DEFAULT NULL,
  `vehicle_reg_number` varchar(10) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `manufacturing_year` varchar(15) DEFAULT NULL,
  `approx_price` int(8) DEFAULT NULL,
  `description_of_vehicle` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_table`
--

INSERT INTO `vehicle_table` (`vehicle_id`, `e_fir_id`, `vehicle_type`, `name_of_manufacture`, `model`, `engine_number`, `chassis_number`, `vehicle_reg_number`, `color`, `manufacturing_year`, `approx_price`, `description_of_vehicle`) VALUES
(1, 5, 'Two Wheeler', 'TVS', 'Jupiter', '85626262', 'FDMLV561545DV', 'gj04jh2345', 'red', '2023-03', 65000, 'activa'),
(2, 6, 'Two Wheeler', 'TVS', 'Platina', '5454rfvc56', 'g33r44343tr', 'gj04jh2348', 'white', '2022-07', 75000, 'BIKE PETROL'),
(3, 9, 'Two Wheeler', 'Honda', 'Splender', '5454rfvc56', 'g33r44343tr', 'gj04jh2348', 'white', '2023-02', 60000, 'DFGRTHYJ'),
(4, 13, 'Two Wheeler', 'Bajaj', 'Discover', '656324554', 'DNNC656GHX6', 'GJ04xy5678', 'White', '2020-06', 75000, 'Discover 100cc With mirrors');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area_master`
--
ALTER TABLE `area_master`
  ADD PRIMARY KEY (`area_id`),
  ADD KEY `Fk City` (`city_id`);

--
-- Indexes for table `city_table`
--
ALTER TABLE `city_table`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `city FK` (`state_id`);

--
-- Indexes for table `country_table`
--
ALTER TABLE `country_table`
  ADD PRIMARY KEY (`cntry_id`);

--
-- Indexes for table `document_table`
--
ALTER TABLE `document_table`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `e_application_table`
--
ALTER TABLE `e_application_table`
  ADD PRIMARY KEY (`e_application_id`),
  ADD KEY `E-Application FK` (`user_id`),
  ADD KEY `Area FK` (`occurance_address`),
  ADD KEY `Police_station FK` (`police_station_id`),
  ADD KEY `Document_Master FK` (`document_id`),
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `e_fir_master`
--
ALTER TABLE `e_fir_master`
  ADD PRIMARY KEY (`e_fir_id`),
  ADD KEY `area FK` (`occurrance_area`),
  ADD KEY `Police_station FK` (`police_station_occurance_place`),
  ADD KEY `types_of_fir_id FK` (`types_of_fir_id`),
  ADD KEY `doc_id FK` (`file_name`(768)),
  ADD KEY `usr_id` (`user_id`);

--
-- Indexes for table `feedback_table`
--
ALTER TABLE `feedback_table`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `User_table FK` (`user_id`);

--
-- Indexes for table `nationality_table`
--
ALTER TABLE `nationality_table`
  ADD PRIMARY KEY (`nationality_id`),
  ADD KEY `Country_Master FK` (`cntry_id`);

--
-- Indexes for table `police_master`
--
ALTER TABLE `police_master`
  ADD PRIMARY KEY (`p_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `police_station_table`
--
ALTER TABLE `police_station_table`
  ADD PRIMARY KEY (`police_station_id`);

--
-- Indexes for table `question_table`
--
ALTER TABLE `question_table`
  ADD PRIMARY KEY (`que_id`);

--
-- Indexes for table `religion_table`
--
ALTER TABLE `religion_table`
  ADD PRIMARY KEY (`religion_id`);

--
-- Indexes for table `report_missing_person_table`
--
ALTER TABLE `report_missing_person_table`
  ADD PRIMARY KEY (`Report_Missing_Person_id`),
  ADD KEY `user_table FK` (`user_id`),
  ADD KEY `religion_table FK` (`religion_id`),
  ADD KEY `Area FK` (`area`),
  ADD KEY `Police_station FK` (`police_station_id`),
  ADD KEY `Document FK` (`document_id`);

--
-- Indexes for table `senior_citizen_reg_table`
--
ALTER TABLE `senior_citizen_reg_table`
  ADD PRIMARY KEY (`sc_reg_id`),
  ADD KEY `User_Table FK` (`user_id`),
  ADD KEY `City table FK` (`city_id`),
  ADD KEY `Police_station FK` (`police_station_id`),
  ADD KEY `Document_table FK` (`document_id`);

--
-- Indexes for table `state_table`
--
ALTER TABLE `state_table`
  ADD PRIMARY KEY (`state_id`),
  ADD KEY `cntry FK` (`cntry_id`);

--
-- Indexes for table `stolen_mobile_table`
--
ALTER TABLE `stolen_mobile_table`
  ADD PRIMARY KEY (`stolen_mobile_id`),
  ADD KEY `E-FIR Id FK` (`e_fir_id`);

--
-- Indexes for table `types_of_fir_table`
--
ALTER TABLE `types_of_fir_table`
  ADD PRIMARY KEY (`types_of_FIR_id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user FK` (`address`),
  ADD KEY `Question_table FK` (`que_id`),
  ADD KEY `Nationality FK` (`nationality_id`),
  ADD KEY `religion_table FK` (`religion_id`),
  ADD KEY `Document_master FK` (`document_id`);

--
-- Indexes for table `vehicle_table`
--
ALTER TABLE `vehicle_table`
  ADD PRIMARY KEY (`vehicle_id`),
  ADD KEY `e-firid FK` (`e_fir_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area_master`
--
ALTER TABLE `area_master`
  MODIFY `area_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `city_table`
--
ALTER TABLE `city_table`
  MODIFY `city_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `country_table`
--
ALTER TABLE `country_table`
  MODIFY `cntry_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `document_table`
--
ALTER TABLE `document_table`
  MODIFY `document_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `e_application_table`
--
ALTER TABLE `e_application_table`
  MODIFY `e_application_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `e_fir_master`
--
ALTER TABLE `e_fir_master`
  MODIFY `e_fir_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `feedback_table`
--
ALTER TABLE `feedback_table`
  MODIFY `feedback_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nationality_table`
--
ALTER TABLE `nationality_table`
  MODIFY `nationality_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `police_master`
--
ALTER TABLE `police_master`
  MODIFY `p_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `police_station_table`
--
ALTER TABLE `police_station_table`
  MODIFY `police_station_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `question_table`
--
ALTER TABLE `question_table`
  MODIFY `que_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `religion_table`
--
ALTER TABLE `religion_table`
  MODIFY `religion_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `report_missing_person_table`
--
ALTER TABLE `report_missing_person_table`
  MODIFY `Report_Missing_Person_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `senior_citizen_reg_table`
--
ALTER TABLE `senior_citizen_reg_table`
  MODIFY `sc_reg_id` int(17) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `state_table`
--
ALTER TABLE `state_table`
  MODIFY `state_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stolen_mobile_table`
--
ALTER TABLE `stolen_mobile_table`
  MODIFY `stolen_mobile_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `types_of_fir_table`
--
ALTER TABLE `types_of_fir_table`
  MODIFY `types_of_FIR_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vehicle_table`
--
ALTER TABLE `vehicle_table`
  MODIFY `vehicle_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `city_table`
--
ALTER TABLE `city_table`
  ADD CONSTRAINT `state` FOREIGN KEY (`state_id`) REFERENCES `state_table` (`state_id`);

--
-- Constraints for table `e_application_table`
--
ALTER TABLE `e_application_table`
  ADD CONSTRAINT `FK` FOREIGN KEY (`user_id`) REFERENCES `user_master` (`user_id`),
  ADD CONSTRAINT `fk2` FOREIGN KEY (`police_station_id`) REFERENCES `police_station_table` (`police_station_id`),
  ADD CONSTRAINT `fkk` FOREIGN KEY (`document_id`) REFERENCES `document_table` (`document_id`);

--
-- Constraints for table `e_fir_master`
--
ALTER TABLE `e_fir_master`
  ADD CONSTRAINT `FK1` FOREIGN KEY (`types_of_fir_id`) REFERENCES `types_of_fir_table` (`types_of_FIR_id`),
  ADD CONSTRAINT `usr_id` FOREIGN KEY (`user_id`) REFERENCES `user_master` (`user_id`);

--
-- Constraints for table `feedback_table`
--
ALTER TABLE `feedback_table`
  ADD CONSTRAINT `user id fk` FOREIGN KEY (`user_id`) REFERENCES `user_master` (`user_id`);

--
-- Constraints for table `nationality_table`
--
ALTER TABLE `nationality_table`
  ADD CONSTRAINT `country fkkk` FOREIGN KEY (`cntry_id`) REFERENCES `country_table` (`cntry_id`);

--
-- Constraints for table `report_missing_person_table`
--
ALTER TABLE `report_missing_person_table`
  ADD CONSTRAINT `document fkk` FOREIGN KEY (`document_id`) REFERENCES `document_table` (`document_id`),
  ADD CONSTRAINT `police station fk` FOREIGN KEY (`police_station_id`) REFERENCES `police_station_table` (`police_station_id`),
  ADD CONSTRAINT `religion fk` FOREIGN KEY (`religion_id`) REFERENCES `religion_table` (`religion_id`),
  ADD CONSTRAINT `user fk` FOREIGN KEY (`user_id`) REFERENCES `user_master` (`user_id`);

--
-- Constraints for table `senior_citizen_reg_table`
--
ALTER TABLE `senior_citizen_reg_table`
  ADD CONSTRAINT `city foreignkey` FOREIGN KEY (`city_id`) REFERENCES `city_table` (`city_id`),
  ADD CONSTRAINT `document fk` FOREIGN KEY (`document_id`) REFERENCES `document_table` (`document_id`),
  ADD CONSTRAINT `policestation fk` FOREIGN KEY (`police_station_id`) REFERENCES `police_station_table` (`police_station_id`),
  ADD CONSTRAINT `user fkk` FOREIGN KEY (`user_id`) REFERENCES `user_master` (`user_id`);

--
-- Constraints for table `state_table`
--
ALTER TABLE `state_table`
  ADD CONSTRAINT `country` FOREIGN KEY (`cntry_id`) REFERENCES `country_table` (`cntry_id`);

--
-- Constraints for table `stolen_mobile_table`
--
ALTER TABLE `stolen_mobile_table`
  ADD CONSTRAINT `efir fkk` FOREIGN KEY (`e_fir_id`) REFERENCES `e_fir_master` (`e_fir_id`);

--
-- Constraints for table `user_master`
--
ALTER TABLE `user_master`
  ADD CONSTRAINT `FK5` FOREIGN KEY (`nationality_id`) REFERENCES `nationality_table` (`nationality_id`),
  ADD CONSTRAINT `QUESTION` FOREIGN KEY (`que_id`) REFERENCES `question_table` (`que_id`),
  ADD CONSTRAINT `document` FOREIGN KEY (`document_id`) REFERENCES `document_table` (`document_id`),
  ADD CONSTRAINT `religion` FOREIGN KEY (`religion_id`) REFERENCES `religion_table` (`religion_id`);

--
-- Constraints for table `vehicle_table`
--
ALTER TABLE `vehicle_table`
  ADD CONSTRAINT `efir_id fkk` FOREIGN KEY (`e_fir_id`) REFERENCES `e_fir_master` (`e_fir_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
SET FOREIGN_KEY_CHECKS=1;  
