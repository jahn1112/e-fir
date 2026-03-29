-- MySQL dump 10.13  Distrib 9.6.0, for macos14.8 (x86_64)
--
-- Host: localhost    Database: project_info
-- ------------------------------------------------------
-- Server version	9.6.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- GTID state at the beginning of the backup 
--


--
-- Table structure for table `area_master`
--

DROP TABLE IF EXISTS `area_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `area_master` (
  `area_id` int NOT NULL AUTO_INCREMENT,
  `a_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `city_id` int NOT NULL,
  PRIMARY KEY (`area_id`),
  KEY `Fk City` (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area_master`
--

LOCK TABLES `area_master` WRITE;
/*!40000 ALTER TABLE `area_master` DISABLE KEYS */;
INSERT INTO `area_master` VALUES (1,'xyz,vastrapur',0);
/*!40000 ALTER TABLE `area_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city_table`
--

DROP TABLE IF EXISTS `city_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `city_table` (
  `city_id` int NOT NULL AUTO_INCREMENT,
  `c_name` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `state_id` int NOT NULL,
  PRIMARY KEY (`city_id`),
  KEY `city FK` (`state_id`),
  CONSTRAINT `state` FOREIGN KEY (`state_id`) REFERENCES `state_table` (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city_table`
--

LOCK TABLES `city_table` WRITE;
/*!40000 ALTER TABLE `city_table` DISABLE KEYS */;
INSERT INTO `city_table` VALUES (2,'Ahmedabad City',1),(3,'Ahmedabad Rural',1),(4,'Amreli',1),(5,'Bhavanagar',1),(6,'Junagadh',1),(7,'Rajkot',1),(8,'Surat',1),(9,'Vadodara',1),(10,'vapi',1);
/*!40000 ALTER TABLE `city_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country_table`
--

DROP TABLE IF EXISTS `country_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `country_table` (
  `cntry_id` int NOT NULL AUTO_INCREMENT,
  `cntry_name` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`cntry_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country_table`
--

LOCK TABLES `country_table` WRITE;
/*!40000 ALTER TABLE `country_table` DISABLE KEYS */;
INSERT INTO `country_table` VALUES (1,'India');
/*!40000 ALTER TABLE `country_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document_table`
--

DROP TABLE IF EXISTS `document_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `document_table` (
  `document_id` int NOT NULL AUTO_INCREMENT,
  `doc_type` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`document_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document_table`
--

LOCK TABLES `document_table` WRITE;
/*!40000 ALTER TABLE `document_table` DISABLE KEYS */;
INSERT INTO `document_table` VALUES (1,'Aadhar Card'),(2,'Pan Card'),(3,'Voter ID');
/*!40000 ALTER TABLE `document_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `e_application_table`
--

DROP TABLE IF EXISTS `e_application_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `e_application_table` (
  `e_application_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `occurance_address` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `pincode` int NOT NULL,
  `police_station_id` int NOT NULL,
  `application_type` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `occurance_date` date NOT NULL,
  `occurance_time` time NOT NULL,
  `brief_desc` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `action_taken` varchar(30) COLLATE utf8mb4_general_ci DEFAULT 'Pending',
  `document_id` int NOT NULL,
  `Remarks_act` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sbmt_date` date NOT NULL DEFAULT (curdate()),
  `action_takenBY` varchar(50) COLLATE utf8mb4_general_ci DEFAULT '---',
  PRIMARY KEY (`e_application_id`),
  KEY `E-Application FK` (`user_id`),
  KEY `Area FK` (`occurance_address`),
  KEY `Police_station FK` (`police_station_id`),
  KEY `Document_Master FK` (`document_id`),
  KEY `user_id` (`user_id`) USING BTREE,
  CONSTRAINT `FK` FOREIGN KEY (`user_id`) REFERENCES `user_master` (`user_id`),
  CONSTRAINT `fk2` FOREIGN KEY (`police_station_id`) REFERENCES `police_station_table` (`police_station_id`),
  CONSTRAINT `fkk` FOREIGN KEY (`document_id`) REFERENCES `document_table` (`document_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `e_application_table`
--

LOCK TABLES `e_application_table` WRITE;
/*!40000 ALTER TABLE `e_application_table` DISABLE KEYS */;
INSERT INTO `e_application_table` VALUES (1,1,'Vastrapurlake,Ahmedabad,360078',360078,10,'Cyber crime','2023-02-01','06:59:39','WHEN I\'M tranfered Money from my bank account to my cilent bank account than someone trying fishing and it was thef my money','Under Scrutiny',1,'Not yet verified','2023-02-22','Arpit Patel'),(2,2,'Maninagar,Ahmedabad - 380007',380007,5,'Application','2023-01-05','05:16:11','we want to out of india purpose of Studing in master Degree, So approved appointmnet  passport verification..','Approved',2,'done','2023-02-22','PARIMAL'),(3,1,'Ambawadi,Nehrunagar Circle,Ahmedadbad - 360015',360015,5,'Information','2023-01-26','12:37:32','we are organized music event so we are playing sound late night according rules and guidlines','Approved',1,'test','2023-02-22','Arpit');
/*!40000 ALTER TABLE `e_application_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `e_fir_master`
--

DROP TABLE IF EXISTS `e_fir_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `e_fir_master` (
  `e_fir_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `occurrance_area` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `police_station_occurance_place` varchar(55) COLLATE utf8mb4_general_ci NOT NULL,
  `types_of_fir_id` int NOT NULL,
  `file_name` longtext COLLATE utf8mb4_general_ci,
  `occurance_pincode` int NOT NULL,
  `distance_from_ps` int DEFAULT NULL,
  `outside_the_limit_of_this_ps_then_name_of_ps` varchar(40) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `occurence_of_offence_date_from` date DEFAULT NULL,
  `occurence_of_offence_date_to` date DEFAULT NULL,
  `occurenece_of_offence_time_from` time DEFAULT NULL,
  `occurenece_of_offence_time_to` time DEFAULT NULL,
  `occupation` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `first_info_contents` varchar(3000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `delayed_reason` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `action_taken` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Remarks_act` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sbmt_date` date NOT NULL DEFAULT (curdate()),
  `action_takenBY` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`e_fir_id`),
  KEY `area FK` (`occurrance_area`),
  KEY `Police_station FK` (`police_station_occurance_place`),
  KEY `types_of_fir_id FK` (`types_of_fir_id`),
  KEY `doc_id FK` (`file_name`(768)),
  KEY `usr_id` (`user_id`),
  CONSTRAINT `FK1` FOREIGN KEY (`types_of_fir_id`) REFERENCES `types_of_fir_table` (`types_of_FIR_id`),
  CONSTRAINT `usr_id` FOREIGN KEY (`user_id`) REFERENCES `user_master` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `e_fir_master`
--

LOCK TABLES `e_fir_master` WRITE;
/*!40000 ALTER TABLE `e_fir_master` DISABLE KEYS */;
INSERT INTO `e_fir_master` VALUES (14,10,'Test Location','VASTRAPUR POLICE STATION',1,'',123456,5,NULL,'2024-01-01','2024-01-02','10:00:00','11:00:00','Student','Test FIR from scratch script','','Approved','Investigation complete. Approved.','2026-03-29','Parimal Rokad (IO)');
/*!40000 ALTER TABLE `e_fir_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback_table`
--

DROP TABLE IF EXISTS `feedback_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedback_table` (
  `feedback_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `feedback_sub` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `feedback_desc` varchar(2000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `feedback_date` date DEFAULT (curdate()),
  `action_taken` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`feedback_id`),
  KEY `User_table FK` (`user_id`),
  CONSTRAINT `user id fk` FOREIGN KEY (`user_id`) REFERENCES `user_master` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback_table`
--

LOCK TABLES `feedback_table` WRITE;
/*!40000 ALTER TABLE `feedback_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `feedback_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nationality_table`
--

DROP TABLE IF EXISTS `nationality_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nationality_table` (
  `nationality_id` int NOT NULL AUTO_INCREMENT,
  `cntry_id` int NOT NULL,
  `nationally_name` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`nationality_id`),
  KEY `Country_Master FK` (`cntry_id`),
  CONSTRAINT `country fkkk` FOREIGN KEY (`cntry_id`) REFERENCES `country_table` (`cntry_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nationality_table`
--

LOCK TABLES `nationality_table` WRITE;
/*!40000 ALTER TABLE `nationality_table` DISABLE KEYS */;
INSERT INTO `nationality_table` VALUES (1,1,'Indian');
/*!40000 ALTER TABLE `nationality_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `police_master`
--

DROP TABLE IF EXISTS `police_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `police_master` (
  `p_id` int NOT NULL AUTO_INCREMENT,
  `p_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `p_dob` date NOT NULL,
  `p_contact` bigint NOT NULL,
  `p_email` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `designation` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`p_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `police_master`
--

LOCK TABLES `police_master` WRITE;
/*!40000 ALTER TABLE `police_master` DISABLE KEYS */;
INSERT INTO `police_master` VALUES (1,'Parimal Rokad','2002-11-02',6353378846,'prokad12345@gmail.com','parimal123','$2y$12$tx6ANkj5Z2K8wqyJxgScL.dhQ3xPP9zrTzCWPEt0EKw4O3q1EtBMG','Investigation Officer'),(2,'Arpit Patel','2003-01-05',7874736806,'arpitpatel123@gmail.com','arpit123','$2y$12$tfajy4bJxZRL74YL3fwB3e8En20eQGvJrE.ZmedmgkY6HoGENhxvS','Police Station Officer');
/*!40000 ALTER TABLE `police_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `police_station_table`
--

DROP TABLE IF EXISTS `police_station_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `police_station_table` (
  `police_station_id` int NOT NULL AUTO_INCREMENT,
  `ps_address` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `ps_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`police_station_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `police_station_table`
--

LOCK TABLES `police_station_table` WRITE;
/*!40000 ALTER TABLE `police_station_table` DISABLE KEYS */;
INSERT INTO `police_station_table` VALUES (1,'Kalupur,Ahmedabad','Ahmedabad Railway'),(2,'Bapunagar,Ahmedabad','Bapunagar'),(3,'Bodakdev,Ahmedabad','Bodakdev'),(4,'Ellisbridge,Ahmedabad','Ellisbridge'),(5,'Gujarat University,Ahmedabad','Gujarat University'),(6,'Nikol,Ahmedabad','Nikol'),(7,'Ranip,Ahmedabad','Ranip'),(8,'Sabarmati River Front,Ahmedaba','Sabarmati River front'),(9,'Sattelite,Ahmedabad','Satellite'),(10,'Vastrapur,Ahmedabad','Vastrapur'),(11,'Sarkhej,Ahmedabad','Sarkhej');
/*!40000 ALTER TABLE `police_station_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_table`
--

DROP TABLE IF EXISTS `question_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question_table` (
  `que_id` int NOT NULL AUTO_INCREMENT,
  `questions` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`que_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_table`
--

LOCK TABLES `question_table` WRITE;
/*!40000 ALTER TABLE `question_table` DISABLE KEYS */;
INSERT INTO `question_table` VALUES (1,'What is your nickname?'),(2,'What is your favourite food?'),(3,'What is your favourite place?'),(4,'Who is your favourite cricketer?'),(5,'Which is your birth place?'),(6,'Who is your ideal person?');
/*!40000 ALTER TABLE `question_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `religion_table`
--

DROP TABLE IF EXISTS `religion_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `religion_table` (
  `religion_id` int NOT NULL AUTO_INCREMENT,
  `religion_name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`religion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `religion_table`
--

LOCK TABLES `religion_table` WRITE;
/*!40000 ALTER TABLE `religion_table` DISABLE KEYS */;
INSERT INTO `religion_table` VALUES (1,'Buddhist'),(2,'Christian'),(3,'Donyipolo'),(4,'Hindu'),(5,'Islam'),(6,'Jain'),(7,'Jews/Yehudi'),(8,'Muslim'),(9,'Other'),(10,'Parsi'),(11,'Sikh');
/*!40000 ALTER TABLE `religion_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report_missing_person_table`
--

DROP TABLE IF EXISTS `report_missing_person_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `report_missing_person_table` (
  `Report_Missing_Person_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `first_name` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `middle_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `surname` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(7) COLLATE utf8mb4_general_ci NOT NULL,
  `missing_date` date NOT NULL,
  `missing_time` time NOT NULL,
  `religion_id` int NOT NULL,
  `caste` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `occupation` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `height(cm)` int NOT NULL,
  `weight(kgs)` int NOT NULL,
  `missing_person_description` varchar(2000) COLLATE utf8mb4_general_ci NOT NULL,
  `area` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `pincode` int NOT NULL,
  `police_station_id` int NOT NULL,
  `brief_description` varchar(3000) COLLATE utf8mb4_general_ci NOT NULL,
  `action_taken` varchar(30) COLLATE utf8mb4_general_ci DEFAULT 'Pending',
  `document_id` int NOT NULL,
  `Remarks_act` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sbmt_date` date NOT NULL DEFAULT (curdate()),
  `action_takenBY` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '---',
  `doc_name` longtext COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Report_Missing_Person_id`),
  KEY `user_table FK` (`user_id`),
  KEY `religion_table FK` (`religion_id`),
  KEY `Area FK` (`area`),
  KEY `Police_station FK` (`police_station_id`),
  KEY `Document FK` (`document_id`),
  CONSTRAINT `document fkk` FOREIGN KEY (`document_id`) REFERENCES `document_table` (`document_id`),
  CONSTRAINT `police station fk` FOREIGN KEY (`police_station_id`) REFERENCES `police_station_table` (`police_station_id`),
  CONSTRAINT `religion fk` FOREIGN KEY (`religion_id`) REFERENCES `religion_table` (`religion_id`),
  CONSTRAINT `user fk` FOREIGN KEY (`user_id`) REFERENCES `user_master` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_missing_person_table`
--

LOCK TABLES `report_missing_person_table` WRITE;
/*!40000 ALTER TABLE `report_missing_person_table` DISABLE KEYS */;
INSERT INTO `report_missing_person_table` VALUES (4,2,'Parimal','Jaysukhbhai','Savaj','2001-03-17','Male','2008-03-08','10:00:00',4,'Hindu','General','Student',165,65,'Wheatish','Sp boys hostel',365002,5,'savaj is studied in college second year and he was missing in 2 days and yet not come.','Pending',1,NULL,'2023-03-23','---',''),(5,5,'sumit','pareshbhai','savaliya','2002-11-02','Male','2023-03-23','22:46:00',4,'Patel','General','Student',165,85,'COLOR:Black and Stylish','IIM institute',360009,5,'When we are going near college at same time some person fight with him and kidnaped.. yet not about him','Pending',1,NULL,'2023-03-23','---','');
/*!40000 ALTER TABLE `report_missing_person_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `senior_citizen_reg_table`
--

DROP TABLE IF EXISTS `senior_citizen_reg_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `senior_citizen_reg_table` (
  `sc_reg_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `city_id` int NOT NULL,
  `sc_fname` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `sc_mname` varchar(35) COLLATE utf8mb4_general_ci NOT NULL,
  `sc_lname` varchar(35) COLLATE utf8mb4_general_ci NOT NULL,
  `police_station_id` int NOT NULL,
  `year_retirement` int NOT NULL,
  `retired_institute` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `health` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `family` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `residing_with` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `no_of_child` int NOT NULL,
  `spouse_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `dob` date NOT NULL,
  `wedding_date` date NOT NULL,
  `lst_plc_visit_date` date NOT NULL,
  `relative_details` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `action_taken` varchar(30) COLLATE utf8mb4_general_ci DEFAULT 'Pending',
  `action_takenBY` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '---',
  `document_id` int NOT NULL,
  `Remarks_act` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reg_date_time` date NOT NULL DEFAULT (curdate()),
  `doc_name` longtext COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`sc_reg_id`),
  KEY `User_Table FK` (`user_id`),
  KEY `City table FK` (`city_id`),
  KEY `Police_station FK` (`police_station_id`),
  KEY `Document_table FK` (`document_id`),
  CONSTRAINT `city foreignkey` FOREIGN KEY (`city_id`) REFERENCES `city_table` (`city_id`),
  CONSTRAINT `document fk` FOREIGN KEY (`document_id`) REFERENCES `document_table` (`document_id`),
  CONSTRAINT `policestation fk` FOREIGN KEY (`police_station_id`) REFERENCES `police_station_table` (`police_station_id`),
  CONSTRAINT `user fkk` FOREIGN KEY (`user_id`) REFERENCES `user_master` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `senior_citizen_reg_table`
--

LOCK TABLES `senior_citizen_reg_table` WRITE;
/*!40000 ALTER TABLE `senior_citizen_reg_table` DISABLE KEYS */;
INSERT INTO `senior_citizen_reg_table` VALUES (1,5,2,'Kenish','Vinodbhai','Sorathiya',5,1964,'','Good','Joint','Children',2,'Mansiben','1901-03-02','1922-03-05','2015-03-08','Relative','Pending','---',1,NULL,'2023-03-23','');
/*!40000 ALTER TABLE `senior_citizen_reg_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `state_table`
--

DROP TABLE IF EXISTS `state_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `state_table` (
  `state_id` int NOT NULL AUTO_INCREMENT,
  `state_name` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cntry_id` int NOT NULL,
  PRIMARY KEY (`state_id`),
  KEY `cntry FK` (`cntry_id`),
  CONSTRAINT `country` FOREIGN KEY (`cntry_id`) REFERENCES `country_table` (`cntry_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `state_table`
--

LOCK TABLES `state_table` WRITE;
/*!40000 ALTER TABLE `state_table` DISABLE KEYS */;
INSERT INTO `state_table` VALUES (1,'Gujarat',1);
/*!40000 ALTER TABLE `state_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stolen_mobile_table`
--

DROP TABLE IF EXISTS `stolen_mobile_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stolen_mobile_table` (
  `stolen_mobile_id` int NOT NULL AUTO_INCREMENT,
  `e_fir_id` int NOT NULL,
  `mobile_number` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `model` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `imei_number` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `approx_price` int NOT NULL,
  `manufacturing_year` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `service_provider` varchar(6) COLLATE utf8mb4_general_ci NOT NULL,
  `color` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `description_of_mobile` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`stolen_mobile_id`),
  KEY `E-FIR Id FK` (`e_fir_id`),
  CONSTRAINT `efir fkk` FOREIGN KEY (`e_fir_id`) REFERENCES `e_fir_master` (`e_fir_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stolen_mobile_table`
--

LOCK TABLES `stolen_mobile_table` WRITE;
/*!40000 ALTER TABLE `stolen_mobile_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `stolen_mobile_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `types_of_fir_table`
--

DROP TABLE IF EXISTS `types_of_fir_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `types_of_fir_table` (
  `types_of_FIR_id` int NOT NULL AUTO_INCREMENT,
  `fir_type` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`types_of_FIR_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `types_of_fir_table`
--

LOCK TABLES `types_of_fir_table` WRITE;
/*!40000 ALTER TABLE `types_of_fir_table` DISABLE KEYS */;
INSERT INTO `types_of_fir_table` VALUES (1,'Vehicle'),(2,'Mobile');
/*!40000 ALTER TABLE `types_of_fir_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_master`
--

DROP TABLE IF EXISTS `user_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_master` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `address` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `que_id` int NOT NULL,
  `nationality_id` int NOT NULL,
  `user_fname` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `user_mname` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_lname` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `contact_no` bigint NOT NULL,
  `user_dob` date NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `q_ans` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(6) COLLATE utf8mb4_general_ci NOT NULL,
  `religion_id` int NOT NULL,
  `occupation` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `pincode` bigint NOT NULL,
  `document_id` int NOT NULL,
  `doc_no` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `reg_date` date NOT NULL DEFAULT (curdate()),
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  KEY `user FK` (`address`),
  KEY `Question_table FK` (`que_id`),
  KEY `Nationality FK` (`nationality_id`),
  KEY `religion_table FK` (`religion_id`),
  KEY `Document_master FK` (`document_id`),
  CONSTRAINT `document` FOREIGN KEY (`document_id`) REFERENCES `document_table` (`document_id`),
  CONSTRAINT `FK5` FOREIGN KEY (`nationality_id`) REFERENCES `nationality_table` (`nationality_id`),
  CONSTRAINT `QUESTION` FOREIGN KEY (`que_id`) REFERENCES `question_table` (`que_id`),
  CONSTRAINT `religion` FOREIGN KEY (`religion_id`) REFERENCES `religion_table` (`religion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_master`
--

LOCK TABLES `user_master` WRITE;
/*!40000 ALTER TABLE `user_master` DISABLE KEYS */;
INSERT INTO `user_master` VALUES (9,'zsdfxghjtyhghb',1,1,'hikumar','ghjk','hbnm,',9876543211,'2000-05-12','123456','$2y$12$.R5xdTfJ4N8AqKxjmK0hoeCIjZjBOD3EesgmSFZtgsEfJh/Qn50zy','','kohli','Male',2,'dfghjk',123456,1,'123456789','2026-03-18'),(10,'123 Test St',1,1,'Test','User','One',9876543210,'1990-01-01','testuser123','$2y$12$sOlLkP5sF106YBoqqKZO9eeeb/PFMoyabTblsTT3x4PGwB/RyC6rK','testuser123@example.com','Buddy','Male',4,'Tester',380001,1,'123456789012','2026-03-29'),(12,'Testing Address',1,1,'Secure','User','Test',9876543210,'1900-01-01','newsecureuser','$2y$12$TmYrCNkO2UW7YrjIeTyE6eS9lO7pIUcg.nKwAXaNwOG/cKZTxmtkK','secure@test.com','N/A','Male',9,'N/A',0,1,'123456789012','2026-03-30');
/*!40000 ALTER TABLE `user_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_table`
--

DROP TABLE IF EXISTS `vehicle_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicle_table` (
  `vehicle_id` int NOT NULL AUTO_INCREMENT,
  `e_fir_id` int NOT NULL,
  `vehicle_type` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name_of_manufacture` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `model` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `engine_number` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `chassis_number` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `vehicle_reg_number` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `color` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `manufacturing_year` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `approx_price` int DEFAULT NULL,
  `description_of_vehicle` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`vehicle_id`),
  KEY `e-firid FK` (`e_fir_id`),
  CONSTRAINT `efir_id fkk` FOREIGN KEY (`e_fir_id`) REFERENCES `e_fir_master` (`e_fir_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_table`
--

LOCK TABLES `vehicle_table` WRITE;
/*!40000 ALTER TABLE `vehicle_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicle_table` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-03-30  1:15:04
