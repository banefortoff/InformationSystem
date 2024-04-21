-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: school
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `olymp_achivments`
--

DROP TABLE IF EXISTS `olymp_achivments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `olymp_achivments` (
  `id_olymp_ach` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `olymp_id` int(11) NOT NULL,
  `olymp_place_id` int(11) NOT NULL,
  `olymp_grade_ach` float DEFAULT NULL,
  PRIMARY KEY (`id_olymp_ach`),
  KEY `olymp_id` (`olymp_id`),
  KEY `olymp_place_id` (`olymp_place_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `olymp_achivments_ibfk_1` FOREIGN KEY (`olymp_id`) REFERENCES `olymp_info` (`olymp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `olymp_achivments_ibfk_2` FOREIGN KEY (`olymp_place_id`) REFERENCES `olymp_places` (`olymp_place_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `olymp_achivments_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `olymp_achivments`
--

LOCK TABLES `olymp_achivments` WRITE;
/*!40000 ALTER TABLE `olymp_achivments` DISABLE KEYS */;
INSERT INTO `olymp_achivments` VALUES (1,5,1,1,5),(2,5,3,3,4),(3,5,4,2,4),(4,11,2,1,11),(5,10,1,2,4),(6,5,1,3,3),(7,11,3,1,6),(8,1,4,1,5);
/*!40000 ALTER TABLE `olymp_achivments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `olymp_info`
--

DROP TABLE IF EXISTS `olymp_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `olymp_info` (
  `olymp_id` int(11) NOT NULL AUTO_INCREMENT,
  `name_olymp` varchar(100) NOT NULL,
  `olymp_subject` varchar(50) DEFAULT NULL,
  `olymp_level_id` int(11) NOT NULL,
  PRIMARY KEY (`olymp_id`),
  KEY `olymp_level_id` (`olymp_level_id`),
  CONSTRAINT `olymp_info_ibfk_1` FOREIGN KEY (`olymp_level_id`) REFERENCES `olymp_levels` (`olymp_level_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `olymp_info`
--

LOCK TABLES `olymp_info` WRITE;
/*!40000 ALTER TABLE `olymp_info` DISABLE KEYS */;
INSERT INTO `olymp_info` VALUES (1,'Олимпиада по биологии между школами Новоильинского района','Биология',2),(2,'Олимпиада по физики между школами Кемеровской области','Физика',4),(3,'Олимпиада по химии между школами города Новокузнецка','Химия',3),(4,'Олимпиада по физики между школами Новоильинского района','Физика',2),(5,'Олимпиада по географии между школами Кемеровской области','География',2);
/*!40000 ALTER TABLE `olymp_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `olymp_levels`
--

DROP TABLE IF EXISTS `olymp_levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `olymp_levels` (
  `olymp_level_id` int(11) NOT NULL AUTO_INCREMENT,
  `olymp_level_name` varchar(50) NOT NULL,
  `olymp_grade` int(11) NOT NULL,
  PRIMARY KEY (`olymp_level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `olymp_levels`
--

LOCK TABLES `olymp_levels` WRITE;
/*!40000 ALTER TABLE `olymp_levels` DISABLE KEYS */;
INSERT INTO `olymp_levels` VALUES (1,'Школьная олимпиада',3),(2,'Районная олимпиада',3),(3,'Муниципальная олимпиада',4),(4,'Региональная олимпиада',9),(5,'Федеральная олимпиада',9),(6,'Международная олимпиада',10);
/*!40000 ALTER TABLE `olymp_levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `olymp_places`
--

DROP TABLE IF EXISTS `olymp_places`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `olymp_places` (
  `olymp_place_id` int(11) NOT NULL AUTO_INCREMENT,
  `olymp_name_place` varchar(10) NOT NULL,
  `olymp_place_coef` float DEFAULT NULL,
  PRIMARY KEY (`olymp_place_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `olymp_places`
--

LOCK TABLES `olymp_places` WRITE;
/*!40000 ALTER TABLE `olymp_places` DISABLE KEYS */;
INSERT INTO `olymp_places` VALUES (1,'1-е место',1.3),(2,'2-е место',1.2),(3,'3-е место',1.1);
/*!40000 ALTER TABLE `olymp_places` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social_achivments`
--

DROP TABLE IF EXISTS `social_achivments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `social_achivments` (
  `id_social_ach` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `name_social_ach` varchar(100) NOT NULL,
  `social_grade` int(11) NOT NULL,
  PRIMARY KEY (`id_social_ach`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `social_achivments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social_achivments`
--

LOCK TABLES `social_achivments` WRITE;
/*!40000 ALTER TABLE `social_achivments` DISABLE KEYS */;
INSERT INTO `social_achivments` VALUES (1,1,'Участие в акции сбора средств бездомным животным',3),(2,19,'Участие в акции сбора средств бездомным животным',3);
/*!40000 ALTER TABLE `social_achivments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sport_achivments`
--

DROP TABLE IF EXISTS `sport_achivments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sport_achivments` (
  `id_sport_ach` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL,
  `sport_place_id` int(11) NOT NULL,
  `sport_grade_ach` float DEFAULT NULL,
  PRIMARY KEY (`id_sport_ach`),
  KEY `sport_id` (`sport_id`),
  KEY `sport_place_id` (`sport_place_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `sport_achivments_ibfk_1` FOREIGN KEY (`sport_id`) REFERENCES `sport_info` (`sport_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sport_achivments_ibfk_2` FOREIGN KEY (`sport_place_id`) REFERENCES `sport_places` (`sport_place_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sport_achivments_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sport_achivments`
--

LOCK TABLES `sport_achivments` WRITE;
/*!40000 ALTER TABLE `sport_achivments` DISABLE KEYS */;
INSERT INTO `sport_achivments` VALUES (1,1,1,1,5),(2,2,2,3,9),(3,4,4,2,4),(4,8,1,1,5),(5,19,4,1,5);
/*!40000 ALTER TABLE `sport_achivments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sport_info`
--

DROP TABLE IF EXISTS `sport_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sport_info` (
  `sport_id` int(11) NOT NULL AUTO_INCREMENT,
  `name_sport` varchar(100) NOT NULL,
  `sport_subject` varchar(50) DEFAULT NULL,
  `sport_level_id` int(11) NOT NULL,
  PRIMARY KEY (`sport_id`),
  KEY `sport_level_id` (`sport_level_id`),
  CONSTRAINT `sport_info_ibfk_1` FOREIGN KEY (`sport_level_id`) REFERENCES `sport_levels` (`sport_level_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sport_info`
--

LOCK TABLES `sport_info` WRITE;
/*!40000 ALTER TABLE `sport_info` DISABLE KEYS */;
INSERT INTO `sport_info` VALUES (1,'Соревнование по баскетболу между школами Новоильинского района','Баскетбол',1),(2,'Соревнование по футболу Кемеровской области','Футбол',3),(3,'Соревнование по футболу между школами города Новокузнецк','Футбол',2),(4,'Соревнование по тенису между школами Новоильинского района','Тенис',1);
/*!40000 ALTER TABLE `sport_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sport_levels`
--

DROP TABLE IF EXISTS `sport_levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sport_levels` (
  `sport_level_id` int(11) NOT NULL AUTO_INCREMENT,
  `sport_level_name` varchar(50) NOT NULL,
  `sport_grade` int(11) NOT NULL,
  PRIMARY KEY (`sport_level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sport_levels`
--

LOCK TABLES `sport_levels` WRITE;
/*!40000 ALTER TABLE `sport_levels` DISABLE KEYS */;
INSERT INTO `sport_levels` VALUES (1,'Районное соревнование',3),(2,'Муниципальное соревнование',4),(3,'Региональное соревнование',9),(4,'Федеральное соревнование',9),(5,'Международная олимпиада',10);
/*!40000 ALTER TABLE `sport_levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sport_places`
--

DROP TABLE IF EXISTS `sport_places`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sport_places` (
  `sport_place_id` int(11) NOT NULL AUTO_INCREMENT,
  `sport_name_place` varchar(10) NOT NULL,
  `sport_place_coef` float DEFAULT NULL,
  PRIMARY KEY (`sport_place_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sport_places`
--

LOCK TABLES `sport_places` WRITE;
/*!40000 ALTER TABLE `sport_places` DISABLE KEYS */;
INSERT INTO `sport_places` VALUES (1,'1-е место',1.3),(2,'2-е место',1.2),(3,'3-е место',1.1);
/*!40000 ALTER TABLE `sport_places` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_name` varchar(70) NOT NULL,
  `class_parallel` int(11) NOT NULL,
  `class_letter` varchar(1) NOT NULL,
  `characteristic_class` varchar(400) DEFAULT NULL,
  `all_grade` float DEFAULT NULL,
  `sum_olymp_grade` float DEFAULT NULL,
  `sum_sport_grade` float DEFAULT NULL,
  `sum_social_grade` float DEFAULT NULL,
  PRIMARY KEY (`student_id`),
  CONSTRAINT `CONSTRAINT_1` CHECK (`class_parallel` > 0 and `class_parallel` < 12)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,'Бальжинимаев Соёл Амгаланович',8,'А','Активный ученик с прекрасными оценками',13,5,5,3),(2,'Иванов Иван Петрович',8,'А',' Активный участник олимпиад по разным предметам, который всегда стремится улучшить свои знания и навыки.',9,0,9,0),(3,'Слепцов Денис Константинович',8,'Б','Спортивный и выносливый, который участвует как в школьных, так и в городских соревнованиях.',0,0,0,0),(4,'Виноградова Юлия Никитична',8,'Б','Интересующийся общественной жизнью и участвующий в социальных акциях, таких как благотворительность ученик.',4,0,4,0),(5,'Казанцев Алексей Ильич',9,'А','Желающий сделать вклад в улучшение школьной жизни. Участвет в организации мероприятий и активно работает в структурах классных коллективов.',16,16,0,0),(7,'Герасимов Михаил Романович',9,'А','Организованный и ответственный, который проявляет активность в жизни школы.',0,0,0,0),(8,'Булгакова Лилия Антоновна',9,'Б','Трудолюбивый и нацеленный на достижение высоких результатов в учебе.',5,0,5,0),(9,'Лазарева Александра Матвеевна',9,'Б','Радость других учеников и привлекающий внимание своей позитивной энергией.',0,0,0,0),(10,'Маслова Полина Никитична',7,'Б','Всегда готовый прийти на помощь одноклассникам и преподавателям.',4,4,0,0),(11,'Сергей Владимирович Смирнов',7,'Б','Является талантливым и целеустремленным учеником. Он регулярно принимает участие в олимпиадах и показывает высокие результаты. Обладает отличными аналитическими способностями и способностью к критическому мышлению. Всегда стремится к новым знаниям и развитию своих навыков. Мы гордимся его успехами и уверены в его будущих достижениях.',17,17,0,0),(12,'Чистяков Матвей Георгиевич',7,'А','Имеющий хорошими коммуникативными навыками. Умеет налаживать отношения со сверстниками и взрослыми.',0,0,0,0),(13,'Мельникова Алиса Арсентьевна',7,'А',' Усидчивый и терпеливый, который не боится трудностей и препятствий.',0,0,0,0),(14,'Орлов Дмитрий Михайлович',6,'А','Одаренный и критически мыслящий ученик, который умеет анализировать и оценивать информацию, а не только ее запоминать.',0,0,0,0),(15,'Денисов Андрей Егорович',6,'Б','Преданный своим увлечениям и хобби, проявляющий себя в различных клубах и кружках.',0,0,0,0),(16,'Горюнов Андрей Маркович',6,'Б','Компетентный в новых технологиях. Умеет работать с языками программирования и веб-разработкой.',0,0,0,0),(17,'Себастьянов Антон Алексеевич',6,'В','Нарцисс',0,0,0,0),(18,'Савельев Иван Николаевич',8,'А','',0,0,0,0),(19,'Батюта Алексей Владимирович',10,'А','Питон',8,0,5,3);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `pass` varchar(260) NOT NULL,
  `user_level` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$qAChZLTckEan4Devfya36u2GHyyHz.Hl9E5JJNiRMB2nB04VJ6bha',1),(2,'user','$2y$10$ErsY0PXk4LdYCd36dyzwCeShr7IdbINpy8DX.xzXXnlLAcYLJWT2u',2);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `view_all_grade`
--

DROP TABLE IF EXISTS `view_all_grade`;
/*!50001 DROP VIEW IF EXISTS `view_all_grade`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_all_grade` (
  `ФИО ученика` tinyint NOT NULL,
  `Параллель` tinyint NOT NULL,
  `Класс` tinyint NOT NULL,
  `Сумма всех достижений` tinyint NOT NULL,
  `Сумма всех достижений в олимпиадах` tinyint NOT NULL,
  `Сумма всех спортивных достижений` tinyint NOT NULL,
  `Сумма всех социальных достижений` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_only_all_grade`
--

DROP TABLE IF EXISTS `view_only_all_grade`;
/*!50001 DROP VIEW IF EXISTS `view_only_all_grade`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_only_all_grade` (
  `ФИО ученика` tinyint NOT NULL,
  `Параллель` tinyint NOT NULL,
  `Класс` tinyint NOT NULL,
  `Сумма всех достижений` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_only_olymp_grade`
--

DROP TABLE IF EXISTS `view_only_olymp_grade`;
/*!50001 DROP VIEW IF EXISTS `view_only_olymp_grade`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_only_olymp_grade` (
  `ФИО ученика` tinyint NOT NULL,
  `Параллель` tinyint NOT NULL,
  `Класс` tinyint NOT NULL,
  `Сумма всех олимпиадных достижений` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_only_social_grade`
--

DROP TABLE IF EXISTS `view_only_social_grade`;
/*!50001 DROP VIEW IF EXISTS `view_only_social_grade`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_only_social_grade` (
  `ФИО ученика` tinyint NOT NULL,
  `Параллель` tinyint NOT NULL,
  `Класс` tinyint NOT NULL,
  `Сумма всех социальных достижений` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_only_sport_grade`
--

DROP TABLE IF EXISTS `view_only_sport_grade`;
/*!50001 DROP VIEW IF EXISTS `view_only_sport_grade`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_only_sport_grade` (
  `ФИО ученика` tinyint NOT NULL,
  `Параллель` tinyint NOT NULL,
  `Класс` tinyint NOT NULL,
  `Сумма всех спортивных достижений` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Dumping routines for database 'school'
--
/*!50003 DROP PROCEDURE IF EXISTS `get_all_ach_by_name` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_all_ach_by_name`(IN n varchar(70))
Begin
Select student_name, class_parallel, class_letter, name_olymp, olymp_name_place, olymp_level_name from olymp_achivments join students on students.student_id = olymp_achivments.student_id join olymp_info on olymp_achivments.olymp_id = olymp_info.olymp_id join olymp_levels on olymp_levels.olymp_level_id = olymp_info.olymp_level_id join olymp_places on olymp_places. olymp_place_id = olymp_achivments.olymp_place_id where student_name = n;
Select student_name, class_parallel, class_letter, name_sport, sport_name_place, sport_level_name from sport_achivments join students on students.student_id = sport_achivments.student_id join sport_info on sport_achivments.sport_id = sport_info.sport_id join sport_levels on sport_levels.sport_level_id = sport_info.sport_level_id join sport_places on sport_places. sport_place_id = sport_achivments.sport_place_id where student_name = n;
Select student_name, class_parallel, class_letter, name_social_ach from social_achivments join students on students.student_id = social_achivments.student_id where student_name = n;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_all_grade` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_all_grade`()
Begin
DECLARE count INT DEFAULT 0;
DECLARE i INT DEFAULT 1;
DECLARE num_olymp float DEFAULT 0;
DECLARE num_sport float DEFAULT 0;
DECLARE num_social float DEFAULT 0;
DECLARE num_all float DEFAULT 0;
Select MAX(student_id) into count
From students;
While i <= count do

Update students
Set sum_olymp_grade = 0
where student_id = i;

Update students
Set sum_sport_grade = 0
where student_id = i;

Update students
Set sum_social_grade = 0
where student_id = i;

Update students
Set all_grade = 0
where student_id = i;

call get_sport_grade_achivments();
call get_olymp_grade_achivments();

Select sum(olymp_grade_ach) into num_olymp
From olymp_achivments join students on students.student_id = olymp_achivments.student_id where olymp_achivments.student_id = i;

Select sum(sport_grade_ach) into num_sport
From sport_achivments join students on students.student_id = sport_achivments.student_id where sport_achivments.student_id = i;

Select sum(social_grade) into num_social
From social_achivments join students on students.student_id = social_achivments.student_id where social_achivments.student_id = i;

Set num_all =  ifnull(num_olymp, 0) + ifnull(num_sport, 0) + ifnull(num_social, 0);

Update students
Set all_grade = num_all
where student_id = i;

Update students
Set sum_olymp_grade = ifnull(num_olymp, 0)
where student_id = i;

Update students
Set sum_sport_grade = ifnull(num_sport, 0)
where student_id = i;

Update students
Set sum_social_grade = ifnull(num_social, 0)
where student_id = i;

Set i = i + 1;
end while;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_count_by_olymp_level` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_count_by_olymp_level`(IN l varchar(50))
Begin
select count(DISTINCT student_name, olymp_level_name) from olymp_achivments join students on students.student_id = olymp_achivments.student_id join olymp_info on olymp_achivments.olymp_id = olymp_info.olymp_id join olymp_levels on olymp_levels.olymp_level_id = olymp_info.olymp_level_id where olymp_level_name = l; 
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_count_by_olymp_name` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_count_by_olymp_name`(IN n varchar(100))
Begin
select count(DISTINCT student_name, name_olymp) from olymp_achivments join students on students.student_id = olymp_achivments.student_id join olymp_info on olymp_achivments.olymp_id = olymp_info.olymp_id join olymp_levels on olymp_levels.olymp_level_id = olymp_info.olymp_level_id join olymp_places on olymp_places. olymp_place_id = olymp_achivments.olymp_place_id where name_olymp = n; end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_count_by_sport_level` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_count_by_sport_level`(IN l varchar(50))
Begin
select count(DISTINCT student_name, sport_level_name) from sport_achivments join students on students.student_id = sport_achivments.student_id join sport_info on sport_achivments.sport_id = sport_info.sport_id join sport_levels on sport_levels.sport_level_id = sport_info.sport_level_id where sport_level_name = l; 
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_count_by_sport_name` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_count_by_sport_name`(IN n varchar(100))
Begin
select count(DISTINCT student_name, name_sport) from sport_achivments join students on students.student_id = sport_achivments.student_id join sport_info on sport_achivments.sport_id = sport_info.sport_id join sport_levels on sport_levels.sport_level_id = sport_info.sport_level_id join sport_places on sport_places. sport_place_id = sport_achivments.sport_place_id where name_sport = n;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_count_by_sport_subject` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_count_by_sport_subject`(IN s varchar(50))
Begin
select count(DISTINCT student_name, sport_subject) from sport_achivments join students on students.student_id = sport_achivments.student_id join sport_info on sport_achivments.sport_id = sport_info.sport_id join sport_levels on sport_levels.sport_level_id = sport_info.sport_level_id join sport_places on sport_places. sport_place_id = sport_achivments.sport_place_id WHERE sport_subject = s;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_count_by_subject` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_count_by_subject`(IN s varchar(50))
Begin

select count(DISTINCT student_name, olymp_subject) from olymp_achivments join students on students.student_id = olymp_achivments.student_id join olymp_info on olymp_achivments.olymp_id = olymp_info.olymp_id join olymp_levels on olymp_levels.olymp_level_id = olymp_info.olymp_level_id join olymp_places on olymp_places. olymp_place_id = olymp_achivments.olymp_place_id where olymp_subject = s;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_count_students_by_parallel` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_count_students_by_parallel`(IN p int)
Begin
select count(student_name) from students where all_grade > 0 AND class_parallel = p; end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_olymp_ach_by_name` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_olymp_ach_by_name`(IN n varchar(70))
Begin
Select student_name, class_parallel, class_letter, name_olymp, olymp_name_place, olymp_level_name from olymp_achivments join students on students.student_id = olymp_achivments.student_id join olymp_info on olymp_achivments.olymp_id = olymp_info.olymp_id join olymp_levels on olymp_levels.olymp_level_id = olymp_info.olymp_level_id join olymp_places on olymp_places. olymp_place_id = olymp_achivments.olymp_place_id where student_name = n;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_olymp_grade_achivments` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_olymp_grade_achivments`()
Begin
DECLARE olymp_count INT DEFAULT 0;
DECLARE i INT DEFAULT 1;
DECLARE olymp_grade_NUM float DEFAULT 0;
DECLARE olymp_place_NUM float DEFAULT 0;
DECLARE olymp_grade_ach_NUM float DEFAULT 0;

Select count(*) into olymp_count
From olymp_achivments;
While i <= olymp_count do

Update olymp_achivments
Set olymp_grade_ach = 0
where id_olymp_ach = i;

Select olymp_grade into olymp_grade_NUM
From olymp_achivments join olymp_info on olymp_achivments.olymp_id = olymp_info.olymp_id join olymp_levels on olymp_levels.olymp_level_id = olymp_info.olymp_level_id  where olymp_achivments.id_olymp_ach = i;

Select olymp_place_id into olymp_place_NUM
From olymp_achivments where olymp_achivments.id_olymp_ach = i;

IF olymp_grade_NUM = 3 THEN
    IF olymp_place_NUM = 1 THEN
        set olymp_grade_ach_NUM = 5;
    ELSEIF olymp_place_NUM = 2 THEN
        set olymp_grade_ach_NUM = 4;
    ELSE
        set olymp_grade_ach_NUM = 3;
    END IF;
ELSEIF olymp_grade_NUM = 4 THEN
    IF olymp_place_NUM = 1 THEN
        set olymp_grade_ach_NUM = 6;
    ELSEIF olymp_place_NUM = 2 THEN
        set olymp_grade_ach_NUM = 5;
    ELSE
        set olymp_grade_ach_NUM = 4;
    END IF;
ELSEIF olymp_grade_NUM = 9 THEN
    IF olymp_place_NUM = 1 THEN
        set olymp_grade_ach_NUM = 11;
    ELSEIF olymp_place_NUM = 2 THEN
        set olymp_grade_ach_NUM = 10;
    ELSE
        set olymp_grade_ach_NUM = 9;
    END IF;
ELSEIF olymp_grade_NUM = 10 THEN
    IF olymp_place_NUM = 1 THEN
        set olymp_grade_ach_NUM = 12;
    ELSEIF olymp_place_NUM = 2 THEN
        set olymp_grade_ach_NUM = 11;
    ELSE
        set olymp_grade_ach_NUM = 10;
    END IF;
END IF;

Update olymp_achivments
Set olymp_grade_ach = olymp_grade_ach_NUM
where olymp_achivments.id_olymp_ach = i;

Set i = i + 1;
end while;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_social_ach_by_name` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_social_ach_by_name`(IN n varchar(70))
Begin
Select student_name, class_parallel, class_letter, name_social_ach from social_achivments join students on students.student_id = social_achivments.student_id where student_name = n;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_sport_ach_by_name` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_sport_ach_by_name`(IN n varchar(70))
Begin
Select student_name, class_parallel, class_letter, name_sport, sport_name_place, sport_level_name from sport_achivments join students on students.student_id = sport_achivments.student_id join sport_info on sport_achivments.sport_id = sport_info.sport_id join sport_levels on sport_levels.sport_level_id = sport_info.sport_level_id join sport_places on sport_places. sport_place_id = sport_achivments.sport_place_id where student_name = n;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_sport_grade_achivments` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_sport_grade_achivments`()
Begin
DECLARE sport_count INT DEFAULT 0;
DECLARE i INT DEFAULT 1;
DECLARE sport_grade_NUM float DEFAULT 0;
DECLARE sport_place_NUM float DEFAULT 0;
DECLARE sport_grade_ach_NUM float DEFAULT 0;

Select count(*) into sport_count
From sport_achivments;
While i <= sport_count do

Update sport_achivments
Set sport_grade_ach = 0
where id_sport_ach = i;

Select sport_grade into sport_grade_NUM
From sport_achivments join sport_info on sport_achivments.sport_id = sport_info.sport_id join sport_levels on sport_levels.sport_level_id = sport_info.sport_level_id  where sport_achivments.id_sport_ach = i;

Select sport_place_id into sport_place_NUM
From sport_achivments where sport_achivments.id_sport_ach = i;

IF sport_grade_NUM = 3 THEN
    IF sport_place_NUM = 1 THEN
        set sport_grade_ach_NUM = 5;
    ELSEIF sport_place_NUM = 2 THEN
        set sport_grade_ach_NUM = 4;
    ELSE
        set sport_grade_ach_NUM = 3;
    END IF;
ELSEIF sport_grade_NUM = 4 THEN
    IF sport_place_NUM = 1 THEN
        set sport_grade_ach_NUM = 6;
    ELSEIF sport_place_NUM = 2 THEN
        set sport_grade_ach_NUM = 5;
    ELSE
        set sport_grade_ach_NUM = 4;
    END IF;
ELSEIF sport_grade_NUM = 9 THEN
    IF sport_place_NUM = 1 THEN
        set sport_grade_ach_NUM = 11;
    ELSEIF sport_place_NUM = 2 THEN
        set sport_grade_ach_NUM = 10;
    ELSE
        set sport_grade_ach_NUM = 9;
    END IF;
ELSEIF sport_grade_NUM = 10 THEN
    IF sport_place_NUM = 1 THEN
        set sport_grade_ach_NUM = 12;
    ELSEIF sport_place_NUM = 2 THEN
        set sport_grade_ach_NUM = 11;
    ELSE
        set sport_grade_ach_NUM = 10;
    END IF;
END IF;

Update sport_achivments
Set sport_grade_ach = sport_grade_ach_NUM
where sport_achivments.id_sport_ach = i;

Set i = i + 1;
end while;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `view_all_grade`
--

/*!50001 DROP TABLE IF EXISTS `view_all_grade`*/;
/*!50001 DROP VIEW IF EXISTS `view_all_grade`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_all_grade` AS select `students`.`student_name` AS `ФИО ученика`,`students`.`class_parallel` AS `Параллель`,`students`.`class_letter` AS `Класс`,`students`.`all_grade` AS `Сумма всех достижений`,`students`.`sum_olymp_grade` AS `Сумма всех достижений в олимпиадах`,`students`.`sum_sport_grade` AS `Сумма всех спортивных достижений`,`students`.`sum_social_grade` AS `Сумма всех социальных достижений` from `students` order by `students`.`all_grade` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_only_all_grade`
--

/*!50001 DROP TABLE IF EXISTS `view_only_all_grade`*/;
/*!50001 DROP VIEW IF EXISTS `view_only_all_grade`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_only_all_grade` AS select `students`.`student_name` AS `ФИО ученика`,`students`.`class_parallel` AS `Параллель`,`students`.`class_letter` AS `Класс`,`students`.`all_grade` AS `Сумма всех достижений` from `students` order by `students`.`all_grade` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_only_olymp_grade`
--

/*!50001 DROP TABLE IF EXISTS `view_only_olymp_grade`*/;
/*!50001 DROP VIEW IF EXISTS `view_only_olymp_grade`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_only_olymp_grade` AS select `students`.`student_name` AS `ФИО ученика`,`students`.`class_parallel` AS `Параллель`,`students`.`class_letter` AS `Класс`,`students`.`sum_olymp_grade` AS `Сумма всех олимпиадных достижений` from `students` order by `students`.`sum_olymp_grade` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_only_social_grade`
--

/*!50001 DROP TABLE IF EXISTS `view_only_social_grade`*/;
/*!50001 DROP VIEW IF EXISTS `view_only_social_grade`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_only_social_grade` AS select `students`.`student_name` AS `ФИО ученика`,`students`.`class_parallel` AS `Параллель`,`students`.`class_letter` AS `Класс`,`students`.`sum_social_grade` AS `Сумма всех социальных достижений` from `students` order by `students`.`sum_social_grade` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_only_sport_grade`
--

/*!50001 DROP TABLE IF EXISTS `view_only_sport_grade`*/;
/*!50001 DROP VIEW IF EXISTS `view_only_sport_grade`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_only_sport_grade` AS select `students`.`student_name` AS `ФИО ученика`,`students`.`class_parallel` AS `Параллель`,`students`.`class_letter` AS `Класс`,`students`.`sum_sport_grade` AS `Сумма всех спортивных достижений` from `students` order by `students`.`sum_sport_grade` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-18 12:48:16
