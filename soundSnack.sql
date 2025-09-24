-- MySQL dump 10.13  Distrib 8.0.43, for Linux (x86_64)
--
-- Host: localhost    Database: SoundSnack
-- ------------------------------------------------------
-- Server version	8.0.43-0ubuntu0.24.04.1

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
-- Table structure for table `Artists`
--

DROP TABLE IF EXISTS `Artists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Artists` (
  `id_artist` smallint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `biography` text,
  `cover` varchar(255) DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `date_of_death` date DEFAULT NULL,
  `place_of_birth` varchar(100) NOT NULL,
  PRIMARY KEY (`id_artist`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Artists`
--

LOCK TABLES `Artists` WRITE;
/*!40000 ALTER TABLE `Artists` DISABLE KEYS */;
INSERT INTO `Artists` VALUES (1,'Axel Patricio Fernando Witteveen','Axel Patricio Fernando Witteveen, es un cantante y compositor argentino. Ha sido galardonado con cinco Premios Carlos Gardel, un MTV Europe Music Awards, un MTV Latinoamérica, dos 40 principales, un MTV Millennial Awards, un Kids Choice Awards Argentina, un TVyNovelas, un Heat Latin Music Awards, entre otros.','images/artist/axelWitteveen/axelWitteveen.jpg','1977-01-01',NULL,'Rafael Calzada, Almirante Brown, Buenos Aires, Argentina');
/*!40000 ALTER TABLE `Artists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Songs`
--

DROP TABLE IF EXISTS `Songs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Songs` (
  `id_song` smallint unsigned NOT NULL AUTO_INCREMENT,
  `id_artist` smallint unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `album` varchar(100) NOT NULL,
  `duration` decimal(4,2) DEFAULT NULL,
  `genre` varchar(50) NOT NULL,
  `video` varchar(255) DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_song`),
  KEY `id_artist` (`id_artist`),
  CONSTRAINT `Songs_ibfk_1` FOREIGN KEY (`id_artist`) REFERENCES `Artists` (`id_artist`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Songs`
--

LOCK TABLES `Songs` WRITE;
/*!40000 ALTER TABLE `Songs` DISABLE KEYS */;
INSERT INTO `Songs` VALUES (1,1,'Te Equivocas','La clave para conquistarte',4.16,'Pop/Balada','https://youtu.be/GzmcPHBMx5c?si=2lO9zA0BTdQ8crvZ','images/artist/axelWitteveen/laClaveParaConquistarte.jpg');
/*!40000 ALTER TABLE `Songs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-09-26  2:32:24
