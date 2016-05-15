CREATE DATABASE  IF NOT EXISTS `bdr_api` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `bdr_api`;
-- MySQL dump 10.13  Distrib 5.5.46, for Win64 (x86)
--
-- Host: 127.0.0.1    Database: bdr_api
-- ------------------------------------------------------
-- Server version	5.5.46-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bdr_todo`
--

DROP TABLE IF EXISTS `bdr_todo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bdr_todo` (
  `uuid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Contador de registros',
  `type` char(20) NOT NULL,
  `content` text NOT NULL,
  `sort_order` smallint(6) DEFAULT '0',
  `done` tinyint(1) DEFAULT '0',
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COMMENT='Lista de TODOs de um usuario visitante';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bdr_todo`
--

LOCK TABLES `bdr_todo` WRITE;
/*!40000 ALTER TABLE `bdr_todo` DISABLE KEYS */;
INSERT INTO `bdr_todo` VALUES (3,'shopping','teste',10,1,'2016-05-15 12:19:35'),(5,'shopping','teste',11,1,'2016-05-15 13:15:38'),(6,'shopping','teste',13,1,'2016-05-15 13:15:40'),(7,'shopping','teste',14,1,'2016-05-15 13:15:41'),(8,'shopping','teste',15,1,'2016-05-15 13:15:43'),(9,'shopping','teste',12,1,'2016-05-15 13:15:44'),(10,'shopping','teste 3',0,0,'2016-05-15 13:15:46'),(11,'shopping','teste',16,1,'2016-05-15 13:15:49'),(12,'shopping','teste',17,1,'2016-05-15 13:15:51'),(13,'shopping','teste',19,1,'2016-05-15 13:15:52'),(15,'shopping','teste',21,0,'2016-05-15 13:36:17'),(16,'shopping','teste',22,0,'2016-05-15 13:36:36'),(17,'shopping','lorem ipsum dolor sit amet',18,0,'2016-05-15 13:37:25'),(18,'shopping','lorem ipsum dolor sit amet',1,0,'2016-05-15 16:06:14'),(19,'work','lorem ipsum dolor sit amet',2,0,'2016-05-15 16:06:30'),(20,'shopping','lorem ipsum dolor sit amet',3,0,'2016-05-15 16:07:30'),(21,'work','lorem ipsum dolor sit amet',4,0,'2016-05-15 16:08:06'),(23,'work','lorem ipsum dolor sit amet',6,0,'2016-05-15 16:12:14'),(24,'work','lorem ipsum dolor sit amet',7,0,'2016-05-15 16:14:46'),(25,'shopping','lorem ipsum dolor sit amet',8,0,'2016-05-15 16:15:47'),(26,'shopping','lorem ipsum dolor sit amet',9,0,'2016-05-15 16:16:58'),(27,'shopping','lorem ipsum dolor sit amet',0,0,'2016-05-15 16:17:38'),(28,'work','lorem ipsum dolor sit amet',0,0,'2016-05-15 16:18:36'),(29,'work','lorem ipsum dolor sit amet',0,0,'2016-05-15 16:19:50'),(30,'work','lorem ipsum dolor sit amet',0,0,'2016-05-15 16:21:41'),(31,'work','lorem ipsum dolor sit amet',0,0,'2016-05-15 16:22:03');
/*!40000 ALTER TABLE `bdr_todo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'bdr_api'
--

--
-- Dumping routines for database 'bdr_api'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-15 16:26:26
