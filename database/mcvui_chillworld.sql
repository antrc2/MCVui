-- MySQL dump 10.13  Distrib 8.0.39, for Linux (x86_64)
--
-- Host: localhost    Database: mcvui_chillworld
-- ------------------------------------------------------
-- Server version	8.0.39

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
-- Table structure for table `playerpoints_migrations`
--

DROP TABLE IF EXISTS `playerpoints_migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `playerpoints_migrations` (
  `migration_version` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playerpoints_migrations`
--

LOCK TABLES `playerpoints_migrations` WRITE;
/*!40000 ALTER TABLE `playerpoints_migrations` DISABLE KEYS */;
INSERT INTO `playerpoints_migrations` VALUES (2);
/*!40000 ALTER TABLE `playerpoints_migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `playerpoints_points`
--

DROP TABLE IF EXISTS `playerpoints_points`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `playerpoints_points` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) NOT NULL,
  `points` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playerpoints_points`
--

LOCK TABLES `playerpoints_points` WRITE;
/*!40000 ALTER TABLE `playerpoints_points` DISABLE KEYS */;
INSERT INTO `playerpoints_points` VALUES (1,'9e69a7e0-5fcd-3b8b-8c7f-847ba30156d2',24),(2,'feccaaad-f20e-33f3-a17a-999f809f5106',0),(3,'967b0435-0c9e-3658-8613-34b2664c2768',0),(4,'cf53f360-df1e-37c8-9534-daa454c24f43',0),(5,'2c088679-a09b-3c0f-9f32-18858969ec59',0),(6,'00000000-0000-0000-0009-01f2ee1a5eb9',0),(7,'9e0a58db-5280-32e9-885f-12f7bc6608d7',0),(8,'bbd141b8-f525-3467-93e7-1ad3485c2c57',0),(9,'e5e175cf-6ac6-377e-905c-a8064b458e40',0),(10,'449129a0-ceb8-3374-a3da-3ada8d97e539',0),(11,'acfd3f10-dc1f-3a55-958e-2248d20026fd',0),(12,'00000000-0000-0000-0009-01f7b8c3835c',0),(13,'2242f620-a983-37ca-bc55-8157bb6bcf6b',0),(14,'be7175d8-b7a3-30c1-a429-0e8bb6985888',0),(15,'a5dcce91-6423-3b08-b3a6-a9178f06dd8e',0),(16,'25641958-5427-3d64-bbce-62f4e88344f7',0),(17,'3eac6f51-4e79-3e34-b1e1-c5c3cb9b3d28',0),(18,'00000000-0000-0000-0009-01f01b676fe6',0),(19,'0b3bcc83-54b2-31df-9077-38bdd069fa6f',0),(20,'8ecf04a5-6879-396e-94af-bd0cf1466902',0),(21,'b9c7ca99-aec2-3b08-9e58-559415fd204d',0),(22,'53549b13-5a12-3473-a6e7-24724e0b8f05',0),(23,'00000000-0000-0000-0009-01f391df7bf8',0),(24,'8cb17735-ae9a-353a-90f8-597d84dceed8',0),(25,'d6a1048f-1697-34c5-93eb-29f9c1386d10',0),(26,'46ebccf1-a03e-3081-8205-40045f8d69f6',0),(27,'88d7026d-dc1a-3a84-9543-bf938b93ba8d',0),(28,'1c697ef1-8725-3ac8-b9c0-c3808157d74f',0),(29,'7fc031d0-d296-3f15-ab29-147b959fb6f0',0),(30,'4c23009a-e4ee-3338-af0e-803bfbc9a006',0),(31,'0bafb4d6-4063-3ab0-b15b-09771be2a06c',0),(32,'0fadcfac-0015-3d96-bea5-ccf72cb0eab0',0),(33,'67c87325-9bd8-37af-b131-acf164be04e2',0),(34,'b5dacfde-86c7-38f6-b84f-27e31e9d8688',0),(35,'77a8eb12-f9f3-359d-8486-708a2a12381e',0),(36,'1b74dcb5-16db-36d3-b84a-e972922d12b0',0),(37,'00000000-0000-0000-0009-01f8b4b6dd6f',0),(38,'7170b4d3-6d01-3f35-ac06-10bedb8855f5',0),(39,'ebde4b54-08a8-3d3a-9056-2764c9f40325',0),(40,'cd43c08a-977e-3b13-8a10-0861bb1afd6f',0),(41,'79541d07-e3a2-305a-a7e2-b1ea83bde4f6',0),(42,'77ec473f-9319-3d03-8483-011971523156',0),(43,'10b9dbe3-1d92-3106-aa3f-d89bf42ef239',0),(44,'3ba27e95-3dcd-3884-8402-94294758a2d1',0),(45,'6cf1c7f0-0760-3f69-8295-3946569e53de',0),(46,'808c9877-4c89-3ee7-ad70-ef1a129bf74f',0),(47,'00000000-0000-0000-0009-01fea3054293',0),(48,'77ef3048-071d-39d9-8e66-5caa1c377a32',0),(49,'83a3710d-2550-3f5e-ab4c-9f6e2cc1714e',0);
/*!40000 ALTER TABLE `playerpoints_points` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `playerpoints_username_cache`
--

DROP TABLE IF EXISTS `playerpoints_username_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `playerpoints_username_cache` (
  `uuid` varchar(36) NOT NULL,
  `username` varchar(30) NOT NULL,
  UNIQUE KEY `uuid` (`uuid`),
  KEY `playerpoints_username_cache_uuid_index` (`uuid`),
  KEY `playerpoints_username_cache_username_index` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playerpoints_username_cache`
--

LOCK TABLES `playerpoints_username_cache` WRITE;
/*!40000 ALTER TABLE `playerpoints_username_cache` DISABLE KEYS */;
INSERT INTO `playerpoints_username_cache` VALUES ('9e69a7e0-5fcd-3b8b-8c7f-847ba30156d2','AnTrc2'),('be7175d8-b7a3-30c1-a429-0e8bb6985888','DEEP_RIN'),('967b0435-0c9e-3658-8613-34b2664c2768','meovang');
/*!40000 ALTER TABLE `playerpoints_username_cache` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-14 13:05:55
