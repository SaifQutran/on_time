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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `user_photo` varchar(150) DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(14) NOT NULL,
  `password` varchar(20) NOT NULL DEFAULT '123',
  `is_manager` tinyint(4) NOT NULL DEFAULT 0,
  `token` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Saif','Ahmed','Qutran','../attachments/users/1/pic.png','Hr manager','sai@cg.com',779021401,'qw',1,''),(2,'أحمد','محمد','علي','../attachments/users/2/pic.png','مدير','ahmed@example.com',123456789,'password1',1,''),(3,'سارة','خالد','حسن','photo2.jpg','مدير','sara@example.com',123456790,'password2',1,''),(4,'علي','حسن','الزهراني','photo3.jpg','مدير','ali@example.com',123456791,'password3',1,''),(5,'منى','سعيد','القحطاني','photo4.jpg','مدير','mona@example.com',123456792,'password4',1,''),(6,'فهد','عبدالله','الشهري','photo5.jpg','مدير','fahd@example.com',123456793,'password5',1,''),(7,'ليلى','علي','العمري','photo6.jpg','موظف','layla@example.com',123456794,'password6',0,''),(8,'يوسف','سالم','العتيبي','photo7.jpg','موظف','yousef@example.com',123456795,'password7',0,''),(9,'نورة','محمد','البركاتي','photo8.jpg','موظف','noura@example.com',123456796,'password8',0,''),(10,'سالم','عبدالرحمن','الصقري','photo9.jpg','موظف','salem@example.com',123456797,'password9',0,''),(11,'هدى','حسن','السبيعي','photo10.jpg','موظف','huda@example.com',123456798,'password10',0,''),(12,'راشد','علي','الفتحي','photo11.jpg','موظف','rashid@example.com',123456799,'password11',0,''),(13,'فاطمة','سعيد','الأسلمي','photo12.jpg','موظف','fatima@example.com',123456800,'password12',0,''),(14,'مروان','عبدالله','البلوي','photo13.jpg','موظف','marwan@example.com',123456801,'password13',0,''),(15,'جمال','سلمان','الجعيدي','photo14.jpg','موظف','jamal@example.com',123456802,'password14',0,''),(16,'عائشة','فهد','المطيري','photo15.jpg','موظف','aisha@example.com',123456803,'password15',0,''),(17,'بدر','محمد','الحميدي','photo16.jpg','موظف','badr@example.com',123456804,'password16',0,''),(18,'سمية','علي','الدوخي','photo17.jpg','موظف','sumaya@example.com',123456805,'password17',0,''),(19,'خالد','عبدالعزيز','الزيدي','photo18.jpg','موظف','khalid@example.com',123456806,'password18',0,''),(20,'علياء','سالم','السميري','photo19.jpg','موظف','aliya@example.com',123456807,'password19',0,''),(21,'حسن','فهد','البدري','photo20.jpg','موظف','hasan@example.com',123456808,'password20',0,''),(44,'علي','عبدالله','','../attachments/users/44/pic.jpg','مبرمج فنااان','sdsad@fas.com',700301782,'alii',1,'');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-26 17:58:28
