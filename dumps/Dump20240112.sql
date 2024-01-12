-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: metro_boulot_dodo
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `admin_email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `admin_password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_email` (`admin_email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'thegoat@gmail.com','Goat01#@');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enterprise`
--

DROP TABLE IF EXISTS `enterprise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enterprise` (
  `enterprise_id` int NOT NULL AUTO_INCREMENT,
  `enterprise_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `enterprise_email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `enterprise_siret` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `enterprise_adress` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `enterprise_password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `enterprise_zipcode` int DEFAULT NULL,
  `enterprise_city` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `enterprise_photo` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`enterprise_id`),
  UNIQUE KEY `enterprise_siret` (`enterprise_siret`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enterprise`
--

LOCK TABLES `enterprise` WRITE;
/*!40000 ALTER TABLE `enterprise` DISABLE KEYS */;
INSERT INTO `enterprise` VALUES (1,'Plume Futée','plumefute@orange.fr','97853642215874','12 rue des charmes','F54rt69@',44000,'Nantes','picture1.jpeg'),(2,'Dream Stones','dreamstones@gmail.com','84697223455986','69 rue de la science','Lh10122005#',27100,'Val de Reuil','picture2.jpeg');
/*!40000 ALTER TABLE `enterprise` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `events_id` int NOT NULL AUTO_INCREMENT,
  `events_startdate` date DEFAULT NULL,
  `events_challengedescrib` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `events_photo` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `events_enddate` date DEFAULT NULL,
  `events_challengename` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `enterprise_id` int NOT NULL,
  PRIMARY KEY (`events_id`),
  KEY `enterprise_id` (`enterprise_id`),
  CONSTRAINT `events_ibfk_1` FOREIGN KEY (`enterprise_id`) REFERENCES `enterprise` (`enterprise_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'2024-02-01','Relevez le défi de cumuler des kilomètres écolo en marchant ou en pédalant lors de notre événement exclusif ! Que ce soit pour le travail ou les loisirs, adoptez un mode de déplacement respectueux de l\'environnement. En avant vers une vie active, durable et pleine d\'aventures !','picture01.jpeg','2024-05-31','ÉcoMouv\' Challenge',2);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ride`
--

DROP TABLE IF EXISTS `ride`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ride` (
  `ride_id` int NOT NULL AUTO_INCREMENT,
  `ride_date` date DEFAULT NULL,
  `ride_distance` float(5,2) DEFAULT NULL,
  `ride_photo` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  `transport_id` int NOT NULL,
  PRIMARY KEY (`ride_id`),
  KEY `user_id` (`user_id`),
  KEY `transport_id` (`transport_id`),
  CONSTRAINT `ride_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `userprofil` (`user_id`),
  CONSTRAINT `ride_ibfk_2` FOREIGN KEY (`transport_id`) REFERENCES `transport` (`transport_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ride`
--

LOCK TABLES `ride` WRITE;
/*!40000 ALTER TABLE `ride` DISABLE KEYS */;
/*!40000 ALTER TABLE `ride` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transport`
--

DROP TABLE IF EXISTS `transport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transport` (
  `transport_id` int NOT NULL AUTO_INCREMENT,
  `transport_type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`transport_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transport`
--

LOCK TABLES `transport` WRITE;
/*!40000 ALTER TABLE `transport` DISABLE KEYS */;
INSERT INTO `transport` VALUES (1,'Vélo'),(2,'Trotinette'),(3,'Roller'),(4,'Skate'),(5,'Marche');
/*!40000 ALTER TABLE `transport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transport_pris_en_compte`
--

DROP TABLE IF EXISTS `transport_pris_en_compte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transport_pris_en_compte` (
  `events_id` int NOT NULL,
  `transport_id` int NOT NULL,
  PRIMARY KEY (`events_id`,`transport_id`),
  KEY `transport_id` (`transport_id`),
  CONSTRAINT `transport_pris_en_compte_ibfk_1` FOREIGN KEY (`events_id`) REFERENCES `events` (`events_id`),
  CONSTRAINT `transport_pris_en_compte_ibfk_2` FOREIGN KEY (`transport_id`) REFERENCES `transport` (`transport_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transport_pris_en_compte`
--

LOCK TABLES `transport_pris_en_compte` WRITE;
/*!40000 ALTER TABLE `transport_pris_en_compte` DISABLE KEYS */;
INSERT INTO `transport_pris_en_compte` VALUES (1,1),(1,5);
/*!40000 ALTER TABLE `transport_pris_en_compte` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userprofil`
--

DROP TABLE IF EXISTS `userprofil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userprofil` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_validate` tinyint NOT NULL,
  `user_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_firstname` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_pseudo` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_describ` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_dateofbirth` date DEFAULT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_photo` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `enterprise_id` int NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`),
  KEY `enterprise_id` (`enterprise_id`),
  CONSTRAINT `userprofil_ibfk_1` FOREIGN KEY (`enterprise_id`) REFERENCES `enterprise` (`enterprise_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userprofil`
--

LOCK TABLES `userprofil` WRITE;
/*!40000 ALTER TABLE `userprofil` DISABLE KEYS */;
INSERT INTO `userprofil` VALUES (1,0,'Poirier-Halley','Hélène','LNwarrior',NULL,'poirier.helene@outlook.fr','1981-10-25','$2y$10$ClnIJj1xwj8oNHuICBaNYOgNw/pV20bS6kQg2BRHZTResn/1ZRlke',NULL,2),(23,0,'Poirier-HALLEY','Linda','Butterfly27',NULL,'linda.halley92@gmail.com','1979-11-02','$2y$10$kNJwTGVxHe7fvV3E2CvfQ.7PcLvafvxlFncH3nV3ILNb2Assu9U4y',NULL,1);
/*!40000 ALTER TABLE `userprofil` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-12 11:59:33
