-- MySQL dump 10.13  Distrib 5.1.33, for Win32 (ia32)
--
-- Host: localhost    Database: pde_protocol_production
-- ------------------------------------------------------
-- Server version	5.1.33-community

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
-- Table structure for table `protocol_assign_names`
--

DROP TABLE IF EXISTS `protocol_assign_names`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `protocol_assign_names` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'isActive? 1=NAI',
  `username_assigned` varchar(10) NOT NULL DEFAULT '1' COMMENT 'user1 - user10 (gia na mporeina blepei ta assigned to him)',
  `sort_order` int(5) NOT NULL DEFAULT '5' COMMENT 'Seira me thn opoia tha emfanizontai ta onomata sta combo',
  `is_hidden` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'For very old employees',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `protocol_assign_names`
--

LOCK TABLES `protocol_assign_names` WRITE;
/*!40000 ALTER TABLE `protocol_assign_names` DISABLE KEYS */;
INSERT INTO `protocol_assign_names` VALUES (1,'ΔΙΕΥΘΥΝΤΗΣ - Νικολάου',1,'1',1,0),(2,'Υποδιευθυντής-Παπαδόπουλος',1,'0',5,1),(3,'Κωνσταντινίδης',1,'0',3,0);
/*!40000 ALTER TABLE `protocol_assign_names` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `protocol_completion_media`
--

DROP TABLE IF EXISTS `protocol_completion_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `protocol_completion_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media_type` varchar(30) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'isActive? 1=NAI',
  `sort_order` int(5) NOT NULL DEFAULT '5' COMMENT 'Seira me thn opoia tha emfanizontai ta onomata sta combo',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `protocol_completion_media`
--

LOCK TABLES `protocol_completion_media` WRITE;
/*!40000 ALTER TABLE `protocol_completion_media` DISABLE KEYS */;
INSERT INTO `protocol_completion_media` VALUES (1,'email',1,5),(2,'ΦΑΞ',1,5),(21,'ΔΙΑΝΟΜΗ',1,6),(22,'Courier',1,6),(23,'ΕΛΤΑ',1,2),(24,'ΕΛΤΑ ΣΥΣΤ.',1,2),(25,'site',1,8);
/*!40000 ALTER TABLE `protocol_completion_media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `protocol_entries`
--

DROP TABLE IF EXISTS `protocol_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `protocol_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protocol_number` int(11) NOT NULL,
  `protocol_year` int(11) NOT NULL DEFAULT '2011',
  `date_eiserx_received` date NOT NULL COMMENT '2.Hmeromhnia paralabhs eiserx',
  `eiserx_eggrafo_arithmos` varchar(20) NOT NULL COMMENT '3.Arithmos eiserx eggrafou',
  `date_of_creation_eiserx_eggrafou` date NOT NULL COMMENT '4. Xronologia eggrafou',
  `eiserx_topos_ekdoshs` varchar(20) DEFAULT NULL COMMENT '5. Topos ekdoshs',
  `eiserx_arxh_ekdoshs` varchar(75) NOT NULL COMMENT '6.arxh ekdoshs',
  `eiserx_eggrafo_summary` varchar(300) NOT NULL COMMENT '7. perilhpsh eiserx eggrafou',
  `eiserx_ekdothhke_gia` varchar(40) NOT NULL COMMENT 'To DELETE - 8.Dieuth-Tmhma,Graf h proswpo gia to opoio ekdothhke',
  `out_arxh_pou_apeythynetai` varchar(150) NOT NULL COMMENT '9.Arxh sthn opoia apeyuynetai',
  `out_eggrafo_summary` varchar(300) NOT NULL COMMENT '10.Summary of outgoing document',
  `date_of_outgoing_doc` date NOT NULL COMMENT '11.Xronologia ekserxomenou eggrafou',
  `date_out_completion_date` date NOT NULL COMMENT '12.Date diekpairewshs outgoing doc',
  `out_completion_number` varchar(20) NOT NULL COMMENT 'To DELETE -13.Arithmos diekpairewshs',
  `out_ada_code` varchar(20) NOT NULL COMMENT 'ΑΔΑ εξερχομένου',
  `out_sxetikoi_arithmoi` varchar(50) NOT NULL COMMENT '14.Sxetikoi arithmoi',
  `fakelos_arxeiou` varchar(20) NOT NULL COMMENT '15. fakelos arxeiou',
  `comments` varchar(150) NOT NULL COMMENT '16.Parathrhseis',
  `current_status_id` int(11) NOT NULL DEFAULT '0',
  `assigned_to` varchar(100) NOT NULL,
  `assign_to_notify_only` varchar(100) NOT NULL,
  `out_completion_media` varchar(50) NOT NULL COMMENT 'Tropos diekpairewshs',
  `date_kataliktiki` date NOT NULL COMMENT 'KATALHKTIKH HMEROMHNIA',
  `last_edited_by` varchar(8) NOT NULL COMMENT 'last user that edited this',
  PRIMARY KEY (`id`),
  UNIQUE KEY `protocol_number` (`protocol_number`,`protocol_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `protocol_entries`
--

LOCK TABLES `protocol_entries` WRITE;
/*!40000 ALTER TABLE `protocol_entries` DISABLE KEYS */;
/*!40000 ALTER TABLE `protocol_entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `protocol_status`
--

DROP TABLE IF EXISTS `protocol_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `protocol_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(25) NOT NULL,
  `status_description` varchar(100) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `protocol_status`
--

LOCK TABLES `protocol_status` WRITE;
/*!40000 ALTER TABLE `protocol_status` DISABLE KEYS */;
INSERT INTO `protocol_status` VALUES (1,'ΓΙΝΟΝΤΑΙ ΕΝΕΡΓΕΙΕΣ',''),(2,'ΟΛΟΚΛΗΡΩΘΗΚΕ',''),(3,'ΣΕ ΑΝΑΜΟΝΗ',''),(4,'ΑΝΑΜΟΝΗ ΥΠΟΓΡΑΦΗΣ',''),(5,'ΑΝΑΜΟΝΗ ΑΔΑ',''),(6,'ΑΝΑΜΟΝΗ ΔΙΕΥΚΡΙΝΙΣΕΩΝ',''),(7,'ΕΧΕΙ ΤΑΧΥΔΡΟΜΗΘΕΙ',''),(8,'ΚΡΑΤΗΜΕΝΟ','ΕΧΕΙ ΚΡΑΤΗΘΕΙ Ο ΑΡ. ΠΡΩΤ.'),(9,'ΑΚΥΡΟ','');
/*!40000 ALTER TABLE `protocol_status` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-08 17:19:28
