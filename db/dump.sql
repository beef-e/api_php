-- MariaDB dump 10.19-11.3.2-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: api_movies
-- ------------------------------------------------------
-- Server version	11.3.2-MariaDB

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
-- Table structure for table `Attore`
--

DROP TABLE IF EXISTS `Attore`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Attore` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `secondo_nome` varchar(255) DEFAULT NULL,
  `cognome` varchar(255) DEFAULT NULL,
  `data_di_nascita` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Attore`
--

LOCK TABLES `Attore` WRITE;
/*!40000 ALTER TABLE `Attore` DISABLE KEYS */;
INSERT INTO `Attore` VALUES
(1,'Marlon',NULL,'Brando','1924-04-03'),
(2,'Maria',NULL,'Schneider','1952-03-27'),
(3,'Michael',NULL,'Douglas','1944-09-25'),
(4,'Sharon',NULL,'Stone','1958-03-10'),
(5,'Michael',NULL,'Brandon','1945-04-20'),
(6,'Mimsy',NULL,'Farmer','1945-02-28'),
(7,'Jean-Pierre',NULL,'Marielle','1932-04-12'),
(8,'Ted',NULL,'Neeley','1943-09-20'),
(9,'Carl',NULL,'Anderson','1945-02-27'),
(10,'Yvonne',NULL,'Elliman','1951-12-29'),
(11,'Nanni',NULL,'Moretti','1953-08-19'),
(12,'Lina',NULL,'Sastri','1953-11-17'),
(13,'Massimo',NULL,'Troisi','1953-02-19'),
(14,'Philippe',NULL,'Noiret','1930-10-01'),
(15,'Maria Grazia',NULL,'Cucinotta','1968-07-27'),
(16,'Bob',NULL,'Hoskins','1942-10-26'),
(17,'Christopher',NULL,'Lloyd','1938-10-22'),
(18,'Joanna',NULL,'Cassidy','1945-08-02'),
(19,'Roger',NULL,'Rabbit','1988-06-06');
/*!40000 ALTER TABLE `Attore` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Film`
--

DROP TABLE IF EXISTS `Film`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Film` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(255) NOT NULL,
  `anno_di_uscita` int(11) NOT NULL,
  `sinossi` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Film`
--

LOCK TABLES `Film` WRITE;
/*!40000 ALTER TABLE `Film` DISABLE KEYS */;
INSERT INTO `Film` VALUES
(1,'Ultimo tango a Parigi',1972,'Un dramma romantico che segue l\'incontro passionale tra un uomo americano di mezza età e una giovane parigina in lutto per la perdita dei loro coniugi.'),
(2,'Basic Instinct',1992,'Un thriller in cui un detective investiga su una serie di omicidi collegati a una scrittrice affascinante e manipolatrice, la cui ultima opera sembra riecheggiare gli omicidi stessi.'),
(3,'Quattro mosche di velluto grigio',1971,'Un giallo incentrato su un batterista di rock coinvolto in una serie di omicidi misteriosi, dove una serie di indizi porta a sospettare che lui stesso possa essere coinvolto, ma la verità è molto più oscura.'),
(4,'Jesus Christ Superstar',1973,'Un musical che narra gli ultimi giorni di Gesù Cristo dal punto di vista di Giuda Iscariota.'),
(5,'Ecce Bombo',1978,'Una commedia che segue le vicende di un giovane che cerca di trovare il proprio posto nel mondo, tra amori complicati, amicizie stravaganti e una famiglia eccentrica.'),
(6,'Il Postino',1994,'Un film ambientato in un\'isola italiana durante gli anni \'50, che racconta l\'amicizia tra un semplice postino e il celebre poeta Pablo Neruda, che lo aiuta a conquistare il cuore della donna che ama.'),
(7,'Chi ha incastrato Roger Rabbit',1988,'Un mix di animazione e live action dove un detective privato deve risolvere il mistero di un omicidio coinvolgente personaggi d\'animazione famosi in un mondo dove coesistono persone e cartoni animati.');
/*!40000 ALTER TABLE `Film` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Film_Attore`
--

DROP TABLE IF EXISTS `Film_Attore`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Film_Attore` (
  `film_id` int(11) NOT NULL,
  `attore_id` int(11) NOT NULL,
  PRIMARY KEY (`film_id`,`attore_id`),
  KEY `attore_id` (`attore_id`),
  CONSTRAINT `Film_Attore_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `Film` (`id`),
  CONSTRAINT `Film_Attore_ibfk_2` FOREIGN KEY (`attore_id`) REFERENCES `Attore` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Film_Attore`
--

LOCK TABLES `Film_Attore` WRITE;
/*!40000 ALTER TABLE `Film_Attore` DISABLE KEYS */;
INSERT INTO `Film_Attore` VALUES
(1,1),
(1,2),
(2,3),
(2,4),
(3,5),
(3,6),
(3,7),
(4,8),
(4,9),
(4,10),
(5,11),
(5,12),
(6,13),
(6,14),
(6,15),
(7,16),
(7,17),
(7,18),
(7,19);
/*!40000 ALTER TABLE `Film_Attore` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Film_Genere`
--

DROP TABLE IF EXISTS `Film_Genere`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Film_Genere` (
  `film_id` int(11) NOT NULL,
  `genere_id` varchar(255) NOT NULL,
  PRIMARY KEY (`film_id`,`genere_id`),
  KEY `genere_id` (`genere_id`),
  CONSTRAINT `Film_Genere_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `Film` (`id`),
  CONSTRAINT `Film_Genere_ibfk_2` FOREIGN KEY (`genere_id`) REFERENCES `Genere` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Film_Genere`
--

LOCK TABLES `Film_Genere` WRITE;
/*!40000 ALTER TABLE `Film_Genere` DISABLE KEYS */;
INSERT INTO `Film_Genere` VALUES
(7,'Animazione'),
(4,'Biografico'),
(5,'Commedia'),
(6,'Commedia'),
(7,'Commedia'),
(2,'Crime'),
(1,'Drammatico'),
(4,'Drammatico'),
(5,'Drammatico'),
(6,'Drammatico'),
(7,'Fantasy'),
(3,'Giallo'),
(3,'Horror'),
(4,'Musical'),
(2,'Mystery'),
(3,'Mystery'),
(1,'Romantico'),
(6,'Romantico'),
(2,'Thriller');
/*!40000 ALTER TABLE `Film_Genere` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Film_Regista`
--

DROP TABLE IF EXISTS `Film_Regista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Film_Regista` (
  `film_id` int(11) NOT NULL,
  `regista_id` int(11) NOT NULL,
  PRIMARY KEY (`film_id`,`regista_id`),
  KEY `regista_id` (`regista_id`),
  CONSTRAINT `Film_Regista_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `Film` (`id`),
  CONSTRAINT `Film_Regista_ibfk_2` FOREIGN KEY (`regista_id`) REFERENCES `Regista` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Film_Regista`
--

LOCK TABLES `Film_Regista` WRITE;
/*!40000 ALTER TABLE `Film_Regista` DISABLE KEYS */;
INSERT INTO `Film_Regista` VALUES
(1,1),
(2,2),
(3,3),
(4,4),
(5,5),
(6,6),
(7,7);
/*!40000 ALTER TABLE `Film_Regista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Genere`
--

DROP TABLE IF EXISTS `Genere`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Genere` (
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Genere`
--

LOCK TABLES `Genere` WRITE;
/*!40000 ALTER TABLE `Genere` DISABLE KEYS */;
INSERT INTO `Genere` VALUES
('Animazione'),
('Biografico'),
('Commedia'),
('Crime'),
('Drammatico'),
('Fantasy'),
('Giallo'),
('Horror'),
('Musical'),
('Mystery'),
('Romantico'),
('Thriller');
/*!40000 ALTER TABLE `Genere` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Regista`
--

DROP TABLE IF EXISTS `Regista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Regista` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `secondo_nome` varchar(255) DEFAULT NULL,
  `cognome` varchar(255) DEFAULT NULL,
  `data_di_nascita` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Regista`
--

LOCK TABLES `Regista` WRITE;
/*!40000 ALTER TABLE `Regista` DISABLE KEYS */;
INSERT INTO `Regista` VALUES
(1,'Bernardo',NULL,'Bertolucci','1941-03-16'),
(2,'Paul',NULL,'Verhoeven','1938-07-18'),
(3,'Dario',NULL,'Argento','1940-09-07'),
(4,'Norman','Frederick','Jewison','1926-07-21'),
(5,'Nanni',NULL,'Moretti','1953-08-19'),
(6,'Michael',NULL,'Radford','1946-02-24'),
(7,'Robert','Lee','Zemeckis','1952-05-14');
/*!40000 ALTER TABLE `Regista` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-05 20:56:23
