-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: tennis
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
-- Table structure for table `matches`
--

DROP TABLE IF EXISTS `matches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tourn_name` varchar(20) DEFAULT NULL,
  `player1_id` int(11) DEFAULT NULL,
  `player2_id` int(11) DEFAULT NULL,
  `match_date` date DEFAULT NULL,
  `winner_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_matches_player1` (`player1_id`),
  KEY `fk_matches_player2` (`player2_id`),
  KEY `fk_matches_winner` (`winner_id`),
  CONSTRAINT `fk_matches_player1` FOREIGN KEY (`player1_id`) REFERENCES `players` (`id`),
  CONSTRAINT `fk_matches_player2` FOREIGN KEY (`player2_id`) REFERENCES `players` (`id`),
  CONSTRAINT `fk_matches_winner` FOREIGN KEY (`winner_id`) REFERENCES `players` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matches`
--

LOCK TABLES `matches` WRITE;
/*!40000 ALTER TABLE `matches` DISABLE KEYS */;
INSERT INTO `matches` VALUES (1,'AO',1,7,'2023-11-18',1),(2,'AO',2,5,'2023-11-19',2),(3,'AO',1,2,'2023-11-20',2),(4,'French Open',3,4,'2023-11-21',4),(5,'French Open',5,8,'2023-11-22',5),(6,'French Open',4,5,'2023-11-23',5),(7,'Wimbledon',6,7,'2023-07-01',6),(8,'Wimbledon',3,8,'2023-07-02',8),(9,'Wimbledon',6,8,'2023-07-03',6),(10,'US Open',1,3,'2023-09-01',1),(11,'US Open',4,6,'2023-09-02',4),(12,'US Open',1,4,'2023-09-03',4);
/*!40000 ALTER TABLE `matches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `players`
--

DROP TABLE IF EXISTS `players`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `nationality` varchar(20) DEFAULT NULL,
  `handedness` varchar(5) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `players`
--

LOCK TABLES `players` WRITE;
/*!40000 ALTER TABLE `players` DISABLE KEYS */;
INSERT INTO `players` VALUES (1,'Carlos','Alcaraz','2024-01-24','French','R',2400,'Active'),(2,'Novak','Djokovic','1987-05-22','Serbian','R',2000,'Active'),(3,'Jannik','Sinner','2010-07-28','Italian','R',2160,'Active'),(4,'Holger','Rune','2003-04-19','Danish','R',3200,'Active'),(5,'Daniil ','Medvedev','1996-02-11','Russian','L',2720,'Active'),(6,'Casper','Ruud','1998-12-22','Norwegian','R',2720,'Active'),(7,'Denis','Shapovalov','1999-04-15','Canadian','L',1440,'Active'),(8,'Rafael','Nadal','1986-06-03','Spanish','L',1920,'Active');
/*!40000 ALTER TABLE `players` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sets`
--

DROP TABLE IF EXISTS `sets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `set_number` int(11) DEFAULT NULL,
  `match_ID` int(11) DEFAULT NULL,
  `player1_gameswon` int(11) DEFAULT NULL,
  `player2_gameswon` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `match_ID` (`match_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=398 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sets`
--

LOCK TABLES `sets` WRITE;
/*!40000 ALTER TABLE `sets` DISABLE KEYS */;
INSERT INTO `sets` VALUES (1,1,1,6,3),(2,2,1,6,3),(3,1,2,6,4),(4,2,2,4,6),(5,3,2,6,3),(6,1,3,6,4),(7,2,3,3,6),(8,3,3,5,7),(9,1,4,2,6),(10,2,4,5,7),(11,1,5,6,3),(12,2,5,7,5),(13,1,6,6,4),(14,2,6,3,6),(15,3,6,6,7),(16,1,7,6,4),(17,2,7,6,0),(18,1,8,1,6),(19,2,8,3,6),(20,1,9,7,6),(21,2,9,6,7),(22,3,9,6,4),(23,1,10,7,6),(24,2,10,6,3),(25,1,11,6,3),(26,2,11,3,6),(27,3,11,6,4),(28,1,12,3,6),(29,2,12,6,0),(30,3,12,1,6);
/*!40000 ALTER TABLE `sets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tournaments`
--

DROP TABLE IF EXISTS `tournaments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tournaments` (
  `tourn_name` varchar(20) NOT NULL,
  `location` varchar(20) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`tourn_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tournaments`
--

LOCK TABLES `tournaments` WRITE;
/*!40000 ALTER TABLE `tournaments` DISABLE KEYS */;
INSERT INTO `tournaments` VALUES ('AO','Australia','2023-11-18','2023-11-20'),('French Open','France','2023-11-21','2023-11-23'),('US Open','United States','2023-09-01','2023-09-03'),('Wimbledon','United Kingdom','2023-07-01','2023-07-03');
/*!40000 ALTER TABLE `tournaments` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-09 13:42:52
