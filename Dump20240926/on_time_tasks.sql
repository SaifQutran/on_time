-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: on_time
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tasks` (
  `task_id` int(8) NOT NULL AUTO_INCREMENT,
  `task_name` varchar(100) NOT NULL,
  `task_description` text DEFAULT NULL,
  `assigner` int(6) NOT NULL,
  `due_date` datetime NOT NULL,
  `begin_date` datetime DEFAULT NULL,
  `finish_date` datetime DEFAULT NULL,
  `task_hours` int(4) DEFAULT NULL,
  `group_id` int(9) DEFAULT NULL,
  `status_id` int(3) NOT NULL DEFAULT 1,
  `progress` int(11) NOT NULL DEFAULT 0,
  `type_id` int(2) DEFAULT NULL,
  `priority_id` int(2) DEFAULT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (1,'تجهيز تصور المشروع','add page to the website',1,'2024-10-10 00:00:00','2024-10-01 00:00:00',NULL,7,1,3,0,NULL,1,'2024-09-17 21:00:00'),(3,'تجربة ثانية','يمكنسشكميت',1,'2024-09-25 00:00:00',NULL,NULL,6,2,5,100,1,3,'2024-09-20 18:00:00'),(4,'تجربة إضافة مهمة ','عليك أن تضيف مهمة بشكل ناجح مع عدد من الخصائص',1,'2024-09-22 00:00:00',NULL,NULL,10,3,2,36,1,1,'2024-09-20 18:00:00'),(5,'تجربة إضافة مهمة ','عليك أن تضيف مهمة بشكل ناجح مع عدد من الخصائص',1,'2024-09-22 00:00:00',NULL,NULL,10,4,5,100,3,1,'2024-09-20 18:00:00'),(6,'alsdjsalkdj','dlsakjdksaljdksaljd',1,'2024-09-24 00:00:00',NULL,NULL,5,1,5,100,2,1,'2024-09-20 18:00:00'),(7,'تجربة الأسماء ','you must focus',1,'2024-09-25 00:00:00',NULL,NULL,15,2,5,100,NULL,1,'2024-09-21 21:00:00'),(8,'تجربة جديدة','ممممممم',1,'2024-09-24 00:00:00',NULL,NULL,8,5,5,100,NULL,1,'2024-09-21 21:00:00'),(17,'تحربة قبل الصلاة','أضف مهام ومنفذين',1,'2024-09-24 00:00:00',NULL,NULL,9,6,5,100,NULL,1,'2024-09-21 21:00:00'),(18,'تحربة قبل الصلاة','أضف مهام ومنفذين',1,'2024-09-24 00:00:00',NULL,NULL,9,2,5,100,NULL,1,'2024-09-21 21:00:00'),(19,'تحربة قبل الصلاة','أضف مهام ومنفذين',1,'2024-09-24 00:00:00',NULL,NULL,9,3,5,100,NULL,1,'2024-09-21 21:00:00'),(20,'dskajdlksajd','dasdlksajdlksad',1,'2024-09-24 00:00:00',NULL,NULL,6,3,1,0,NULL,1,'2024-09-21 21:00:00'),(21,'dskajdlksajd','dasdlksajdlksad',1,'2024-09-24 00:00:00',NULL,NULL,6,3,1,0,NULL,1,'2024-09-21 21:00:00'),(22,'dskajdlksajd','dasdlksajdlksad',1,'2024-09-24 00:00:00',NULL,NULL,6,2,1,0,NULL,1,'2024-09-21 21:00:00'),(23,'dskajdlksajd','dasdlksajdlksad',1,'2024-09-24 00:00:00',NULL,NULL,6,4,1,0,NULL,1,'2024-09-21 21:00:00'),(32,'تحربة مهمة مع مرفق','كيمسنبكميستبسكميت',1,'2024-09-25 00:00:00',NULL,NULL,16,1,1,0,NULL,1,'2024-09-21 21:00:00');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-26 17:58:34
