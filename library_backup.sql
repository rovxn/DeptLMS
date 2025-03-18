-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: library
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'TEST','test',NULL),(2,'TEST','test',NULL),(4,'admin','e10adc3949ba59abbe56e057f20f883e',NULL);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblauthors`
--

DROP TABLE IF EXISTS `tblauthors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblauthors` (
  `AuthorId` int(11) NOT NULL AUTO_INCREMENT,
  `AuthorName` varchar(255) NOT NULL,
  PRIMARY KEY (`AuthorId`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblauthors`
--

LOCK TABLES `tblauthors` WRITE;
/*!40000 ALTER TABLE `tblauthors` DISABLE KEYS */;
INSERT INTO `tblauthors` VALUES (3,'Virendra Kumar'),(4,'Bhurchandi, K M'),(5,'Gottfried, Byron S'),(6,'Mazidi, Muhammad Ali, et al.'),(7,'Pressman, Roger S'),(8,'Dr.Rajiv Chopra'),(9,'Ze-Nian Li,Mark S Drew'),(10,'Horowitz, Ellis'),(11,'Dr.S.Jose'),(12,'Carl Hamacher'),(13,'A. AnandKumar'),(14,'Bolton, William'),(15,'Kennedy, George; Davis, Bernard; Prasanna, S R M'),(16,'Anand Kumar, A'),(17,'Forouzan, Behrouz A'),(18,'Oppenheim, Alan V; Willsky, Alan S; Nawab, S Hamid'),(19,'Shadab Irfan'),(20,'Raymond M Smullyan'),(21,'Streetman, Ben G; Banerjee, Sanjay Kumar'),(22,'Pushpa Singh and Narendra Singh'),(23,'Ross, Timothy J'),(24,'Bhurchandi, K M; Ray, A K'),(25,'Balagurusamy, E'),(26,'Adesh Kumar Pandey'),(27,'R.Theagarajan ,S.Dhanasekaran & S.Dhanapal'),(28,'Lafore, Robert'),(29,'Sanjay K Bose'),(30,'Radhakrishnan Pillai'),(31,'John J Donovan'),(32,'Y Daniel Liang'),(33,'Authors'),(34,'S.K Jha'),(35,'Proakis, John G; Manolakis, Dimitris G'),(36,'R.Rubi Kouser'),(37,'Silberschatz, Abraham, et al.'),(38,'Veerarajan, T'),(39,'Forouzan, Behrouz A; Gilberg, RIchard F'),(40,'Dr.Sanjay Sharma'),(41,'Brown, Stephen'),(42,'Anilkumar, K N'),(43,'Jeeva Jose & P.Sojanhal'),(44,'V K Jain'),(45,'Proakis, John G'),(46,'Peterson, Larry L; Davie, Bruce S'),(47,'Datt, Gaurav; Mahajan, Ashwani'),(48,'Stanley B Lippman,Josee Lajoie'),(49,'Silberschatz, Abraham'),(50,'Brown, Stephen; Vranesic, Zvonko'),(51,'G.S. Baluja'),(52,'Santiram Kal'),(53,'Beck, Leland L; Dhanabalachadran Manula'),(54,'Hamacher, V Carl'),(55,'Peter Prinz and Tony Crawford'),(56,'Dr S .Anandamurugan'),(57,'Dan W.P'),(58,'R.S. Aggarwal'),(59,'Kennedy, George'),(60,'Beck, Leland L'),(61,'Dr.Lalit K Arora & Anjali Arora'),(62,'Subrata Saha,Subhodip Mukherjee'),(63,'Choudhury, Roy D; Jain, Shail B'),(64,'Mahajan, Sunita; Shah, Seema'),(65,'Robert W Sebesta'),(66,'Riktesh Srivastava,Rajita Srivastava'),(67,'Dr. R.B Patel,Prem Nath'),(68,'Mazidi, Muhammad Ali'),(69,'Horowitz, Ellis, Sahni, Sartaj; Anderson Freed, Susan'),(70,'Khanna, O P; Sarup, A'),(71,'Gaonkar, Ramesh S'),(72,'Khanna, O P'),(73,'R.S. Salaria'),(74,'Gottfried, Byron S; Chhabra, Jitender Kumar'),(75,'Gupta, J B'),(76,'Ciletti, Michael D'),(77,'Horowitz, Ellis, et al.'),(78,'Udit Agarwal'),(79,'Adesh K Pandey'),(80,'Er.Rajiv Chopra'),(81,'Zurada, Jacek M'),(82,'Proakis, John G; Salehi, Masoud'),(83,'Hamacher, V Carl, et al.'),(84,'Tomasi, Wayne'),(85,'S.Jose'),(86,'Hopcroft, John E; Motwani, Rajeev; Ullman, Jeffrey D'),(87,'Mark J Guzdial and Barbara Ericson'),(88,'Schildt, Herbert'),(89,'Kal, Santiram'),(90,'Hopcroft, John E'),(91,'H S Behera,Janmenjoy Nayak,Hadibandhu Pattnayak');
/*!40000 ALTER TABLE `tblauthors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblbooks`
--

DROP TABLE IF EXISTS `tblbooks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblbooks` (
  `BookId` int(11) NOT NULL AUTO_INCREMENT,
  `BookName` varchar(255) NOT NULL,
  `CatId` int(11) NOT NULL,
  `AuthorId` int(11) NOT NULL,
  `ISBNNumber` varchar(50) NOT NULL,
  `BookCount` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`BookId`),
  UNIQUE KEY `ISBNNumber` (`ISBNNumber`),
  KEY `CatId` (`CatId`),
  KEY `AuthorId` (`AuthorId`),
  CONSTRAINT `tblbooks_ibfk_1` FOREIGN KEY (`CatId`) REFERENCES `tblcategory` (`CatId`) ON DELETE CASCADE,
  CONSTRAINT `tblbooks_ibfk_2` FOREIGN KEY (`AuthorId`) REFERENCES `tblauthors` (`AuthorId`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=394 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblbooks`
--

LOCK TABLES `tblbooks` WRITE;
/*!40000 ALTER TABLE `tblbooks` DISABLE KEYS */;
INSERT INTO `tblbooks` VALUES (10,'Advanced Microprocessors and Peripherals',2,4,'978-0-00-00002',5),(11,'Advanced Microprocessors and Peripherals',3,4,'978-0-00-00003',5),(12,'Advanced Microprocessors and Peripherals',4,4,'978-0-00-00004',5),(13,'Advanced Microprocessors and Peripherals',5,4,'978-0-00-00005',5),(14,'Microprocessor Architecture, Programming and Applications with the 8085',6,71,'978-0-00-00006',5),(15,'Microprocessor Architecture, Programming and Applications with the 8085',7,71,'978-0-00-00007',5),(16,'Microprocessor Architecture, Programming and Applications with the 8085',8,71,'978-0-00-00008',5),(17,'Microprocessor Architecture, Programming and Applications with the 8085',9,71,'978-0-00-00009',5),(18,'8051 Microcontroller and Embedded Systems using Assembly and C',10,68,'978-0-00-00010',5),(19,'8051 Microcontroller and Embedded Systems using Assembly and C',11,68,'978-0-00-00011',5),(20,'8051 Microcontroller and Embedded Systems using Assembly and C',12,68,'978-0-00-00012',5),(21,'8051 Microcontroller and Embedded Systems using Assembly and C',13,68,'978-0-00-00013',5),(22,'Computer Organization',14,54,'978-0-00-00014',5),(23,'Computer Organization',15,54,'978-0-00-00015',5),(24,'Computer Organization',16,54,'978-0-00-00016',5),(25,'Computer Organization',17,54,'978-0-00-00017',5),(34,'Software Engineering: A Practitioners Approach',26,7,'978-0-00-00026',5),(35,'Software Engineering: A Practitioners Approach',27,7,'978-0-00-00027',5),(36,'Software Engineering: A Practitioners Approach',28,7,'978-0-00-00028',5),(37,'Software Engineering: A Practitioners Approach',29,7,'978-0-00-00029',5),(38,'Fundamentals of Computer Algorithms',30,10,'978-0-00-00030',5),(39,'Fundamentals of Computer Algorithms',31,10,'978-0-00-00031',5),(40,'Fundamentals of Computer Algorithms',32,10,'978-0-00-00032',5),(41,'Fundamentals of Computer Algorithms',33,10,'978-0-00-00033',5),(42,'Object Oriented Programming in C++',34,28,'978-0-00-00034',5),(43,'Object Oriented Programming in C++',35,28,'978-0-00-00035',5),(44,'Object Oriented Programming in C++',36,28,'978-0-00-00036',5),(45,'Object Oriented Programming in C++',37,28,'978-0-00-00037',5),(46,'Programming in ANSI C',38,25,'978-0-00-00038',5);
/*!40000 ALTER TABLE `tblbooks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcategory`
--

DROP TABLE IF EXISTS `tblcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblcategory` (
  `CatId` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(255) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`CatId`),
  UNIQUE KEY `CategoryName` (`CategoryName`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcategory`
--

LOCK TABLES `tblcategory` WRITE;
/*!40000 ALTER TABLE `tblcategory` DISABLE KEYS */;
INSERT INTO `tblcategory` VALUES (2,'Advanced microprocessors and peripherals',1),(3,'Microprocessor architecture, programming and applications with the 8085',1),(4,'8051 Microcontroller and embedded systems using assembly and C',1),(5,'Computer organization',1),(6,'Distributed computing',1),(7,'Computer networks: A systems approach',1),(8,'Software engineering: A practitioners approach',1),(9,'Fundamentals of computer algorithms',1),(10,'Object oriented programming in C++',1),(11,'Programming in ANSI C',1),(12,'Programming with C',1),(13,'Java: The complete reference',1),(14,'System software: An introduction to systems programming',1),(15,'Operating system concepts',1),(16,'Unix and shell programming: A textbook',1),(17,'Fundamentals of data structures in C',1),(18,'Database system concepts',1),(19,'Introduction to artificial neural systems',1),(20,'Indian economy',1),(21,'Discrete mathematics with graph theory and combinatorics',1),(22,'Introduction to automata theory, languages and computation',1),(23,'Fuzzy logic with engineering applications',1),(24,'Engineering graphicsunique methods easy solutions',1),(25,'Mechatronics: A multidisciplinary approach',1),(26,'Basic electronics: Devices, circuits and IT fundamentals',1),(27,'Electronics devices and circuits',1),(28,'Solid state electronic devices',1),(29,'Linear integrated circuits',1),(30,'Fundamentals of digital circuits',1),(31,'Electronic communication systems',1),(32,'Digital communications',1),(33,'Electronic communications systems: fundamentals through advanced',1),(34,'Digital signal processing: Principles, algorithms, and applications',1),(35,'Signals and systems',1),(36,'Fundamentals of digital logic with verilog design',1),(37,'Advanced digital design with the Verilog HDL',1),(38,'Industrial engineering and management',1);
/*!40000 ALTER TABLE `tblcategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblissuedbookdetails`
--

DROP TABLE IF EXISTS `tblissuedbookdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblissuedbookdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `StudentID` varchar(20) NOT NULL,
  `BookId` int(11) NOT NULL,
  `IssueDate` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `StudentID` (`StudentID`),
  KEY `BookId` (`BookId`),
  CONSTRAINT `tblissuedbookdetails_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `tblstudents` (`StudentId`) ON DELETE CASCADE,
  CONSTRAINT `tblissuedbookdetails_ibfk_2` FOREIGN KEY (`BookId`) REFERENCES `tblbooks` (`BookId`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblissuedbookdetails`
--

LOCK TABLES `tblissuedbookdetails` WRITE;
/*!40000 ALTER TABLE `tblissuedbookdetails` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblissuedbookdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblstudents`
--

DROP TABLE IF EXISTS `tblstudents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblstudents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `StudentId` varchar(7) NOT NULL,
  `FullName` varchar(120) NOT NULL,
  `MobileNumber` varchar(10) NOT NULL,
  `EmailId` varchar(120) NOT NULL,
  `Password` varchar(120) NOT NULL,
  `Status` int(1) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `StudentId` (`StudentId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblstudents`
--

LOCK TABLES `tblstudents` WRITE;
/*!40000 ALTER TABLE `tblstudents` DISABLE KEYS */;
INSERT INTO `tblstudents` VALUES (1,'21cs263','test ','1231231234','test@gmail.com','098f6bcd4621d373cade4e832627b4f6',1,'2025-03-16 04:45:20',NULL);
/*!40000 ALTER TABLE `tblstudents` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-18 14:04:23
