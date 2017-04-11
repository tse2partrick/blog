-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: localhost    Database: partrick
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Current Database: `partrick`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `partrick` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `partrick`;

--
-- Table structure for table `adminuser`
--

DROP TABLE IF EXISTS `adminuser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adminuser` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `last_login_ip` varchar(30) DEFAULT NULL,
  `login_time` datetime DEFAULT NULL,
  `login_ip` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adminuser`
--

LOCK TABLES `adminuser` WRITE;
/*!40000 ALTER TABLE `adminuser` DISABLE KEYS */;
INSERT INTO `adminuser` VALUES (2,'nicolas','4297f44b13955235245b2497399d7a93','123@qq.com',NULL,NULL,NULL,NULL),(3,'admin','7fef6171469e80d32c0559f88b377245','275894290@qq.com','2017-03-03 07:59:31','::1','2017-03-10 00:02:55','::1');
/*!40000 ALTER TABLE `adminuser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `art_comment`
--

DROP TABLE IF EXISTS `art_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `art_comment` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `face` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `cmt_content` text,
  `create_time` datetime DEFAULT NULL,
  `art_title` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_art` (`art_title`),
  CONSTRAINT `fk_art` FOREIGN KEY (`art_title`) REFERENCES `article` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=490 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `art_comment`
--

LOCK TABLES `art_comment` WRITE;
/*!40000 ALTER TABLE `art_comment` DISABLE KEYS */;
INSERT INTO `art_comment` VALUES (1,'../images/123.jpg','匿名网友_::1','第一篇文章的评论','2017-03-06 14:41:51','第一篇文章'),(2,'../images/123.jpg','匿名网友_::1','文章的第二次评论','2017-03-06 14:43:54','第一篇文章'),(4,'../images/123.jpg','匿名网友_::1','测试评论','2017-03-06 14:47:42','山重水复疑无路'),(12,'../images/123.jpg','匿名网友_::1','aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','2017-03-06 20:26:30','第一篇文章'),(17,'../images/123.jpg','匿名网友_::1','aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','2017-03-06 20:48:42','第一篇文章'),(18,'../images/123.jpg','匿名网友_::1','aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','2017-03-06 20:48:49','第一篇文章'),(19,'../images/123.jpg','匿名网友_::1','aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','2017-03-06 20:48:55','第一篇文章'),(20,'../images/123.jpg','匿名网友_::1','aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','2017-03-06 20:49:02','第一篇文章'),(21,'../images/123.jpg','匿名网友_::1','aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','2017-03-06 20:49:10','第一篇文章'),(224,'../images/123.jpg','匿名网友_::1','测试内容1','2017-03-06 21:53:14','第一篇文章'),(225,'../images/123.jpg','匿名网友_::1','测试内容2','2017-03-06 21:53:14','第一篇文章'),(235,'../images/123.jpg','匿名网友_::1','测试内容12','2017-03-06 21:53:14','第一篇文章'),(236,'../images/123.jpg','匿名网友_::1','测试内容13','2017-03-06 21:53:14','第一篇文章'),(237,'../images/123.jpg','匿名网友_::1','测试内容14','2017-03-06 21:53:14','第一篇文章'),(238,'../images/123.jpg','匿名网友_::1','测试内容15','2017-03-06 21:53:14','第一篇文章'),(239,'../images/123.jpg','匿名网友_::1','测试内容16','2017-03-06 21:53:14','第一篇文章'),(240,'../images/123.jpg','匿名网友_::1','测试内容17','2017-03-06 21:53:14','第一篇文章'),(241,'../images/123.jpg','匿名网友_::1','测试内容18','2017-03-06 21:53:14','第一篇文章'),(242,'../images/123.jpg','匿名网友_::1','测试内容19','2017-03-06 21:53:14','第一篇文章'),(243,'../images/123.jpg','匿名网友_::1','测试内容20','2017-03-06 21:53:14','第一篇文章'),(244,'../images/123.jpg','匿名网友_::1','测试内容21','2017-03-06 21:53:14','第一篇文章'),(245,'../images/123.jpg','匿名网友_::1','测试内容22','2017-03-06 21:53:14','第一篇文章'),(246,'../images/123.jpg','匿名网友_::1','测试内容23','2017-03-06 21:53:14','第一篇文章'),(247,'../images/123.jpg','匿名网友_::1','测试内容24','2017-03-06 21:53:14','第一篇文章'),(248,'../images/123.jpg','匿名网友_::1','测试内容25','2017-03-06 21:53:14','第一篇文章'),(249,'../images/123.jpg','匿名网友_::1','测试内容26','2017-03-06 21:53:14','第一篇文章'),(250,'../images/123.jpg','匿名网友_::1','测试内容27','2017-03-06 21:53:14','第一篇文章'),(251,'../images/123.jpg','匿名网友_::1','测试内容28','2017-03-06 21:53:14','第一篇文章'),(252,'../images/123.jpg','匿名网友_::1','测试内容29','2017-03-06 21:53:14','第一篇文章'),(253,'../images/123.jpg','匿名网友_::1','测试内容30','2017-03-06 21:53:14','第一篇文章'),(254,'../images/123.jpg','匿名网友_::1','测试内容31','2017-03-06 21:53:14','第一篇文章'),(255,'../images/123.jpg','匿名网友_::1','测试内容32','2017-03-06 21:53:14','第一篇文章'),(256,'../images/123.jpg','匿名网友_::1','测试内容33','2017-03-06 21:53:14','第一篇文章'),(257,'../images/123.jpg','匿名网友_::1','测试内容34','2017-03-06 21:53:14','第一篇文章'),(258,'../images/123.jpg','匿名网友_::1','测试内容35','2017-03-06 21:53:14','第一篇文章'),(259,'../images/123.jpg','匿名网友_::1','测试内容36','2017-03-06 21:53:14','第一篇文章'),(260,'../images/123.jpg','匿名网友_::1','测试内容37','2017-03-06 21:53:14','第一篇文章'),(261,'../images/123.jpg','匿名网友_::1','测试内容38','2017-03-06 21:53:14','第一篇文章'),(262,'../images/123.jpg','匿名网友_::1','测试内容39','2017-03-06 21:53:14','第一篇文章'),(263,'../images/123.jpg','匿名网友_::1','测试内容40','2017-03-06 21:53:14','第一篇文章'),(264,'../images/123.jpg','匿名网友_::1','测试内容41','2017-03-06 21:53:14','第一篇文章'),(265,'../images/123.jpg','匿名网友_::1','测试内容42','2017-03-06 21:53:14','第一篇文章'),(266,'../images/123.jpg','匿名网友_::1','测试内容43','2017-03-06 21:53:14','第一篇文章'),(267,'../images/123.jpg','匿名网友_::1','测试内容44','2017-03-06 21:53:14','第一篇文章'),(268,'../images/123.jpg','匿名网友_::1','测试内容45','2017-03-06 21:53:14','第一篇文章'),(269,'../images/123.jpg','匿名网友_::1','测试内容46','2017-03-06 21:53:14','第一篇文章'),(270,'../images/123.jpg','匿名网友_::1','测试内容47','2017-03-06 21:53:14','第一篇文章'),(271,'../images/123.jpg','匿名网友_::1','测试内容48','2017-03-06 21:53:14','第一篇文章'),(272,'../images/123.jpg','匿名网友_::1','测试内容49','2017-03-06 21:53:14','第一篇文章'),(273,'../images/123.jpg','匿名网友_::1','测试内容50','2017-03-06 21:53:14','第一篇文章'),(274,'../images/123.jpg','匿名网友_::1','测试内容51','2017-03-06 21:53:14','第一篇文章'),(275,'../images/123.jpg','匿名网友_::1','测试内容52','2017-03-06 21:53:14','第一篇文章'),(276,'../images/123.jpg','匿名网友_::1','测试内容53','2017-03-06 21:53:14','第一篇文章'),(277,'../images/123.jpg','匿名网友_::1','测试内容54','2017-03-06 21:53:14','第一篇文章'),(278,'../images/123.jpg','匿名网友_::1','测试内容55','2017-03-06 21:53:14','第一篇文章'),(279,'../images/123.jpg','匿名网友_::1','测试内容56','2017-03-06 21:53:14','第一篇文章'),(280,'../images/123.jpg','匿名网友_::1','测试内容57','2017-03-06 21:53:14','第一篇文章'),(281,'../images/123.jpg','匿名网友_::1','测试内容58','2017-03-06 21:53:14','第一篇文章'),(282,'../images/123.jpg','匿名网友_::1','测试内容59','2017-03-06 21:53:14','第一篇文章'),(283,'../images/123.jpg','匿名网友_::1','测试内容60','2017-03-06 21:53:14','第一篇文章'),(284,'../images/123.jpg','匿名网友_::1','测试内容61','2017-03-06 21:53:14','第一篇文章'),(285,'../images/123.jpg','匿名网友_::1','测试内容62','2017-03-06 21:53:14','第一篇文章'),(286,'../images/123.jpg','匿名网友_::1','测试内容63','2017-03-06 21:53:14','第一篇文章'),(287,'../images/123.jpg','匿名网友_::1','测试内容64','2017-03-06 21:53:14','第一篇文章'),(288,'../images/123.jpg','匿名网友_::1','测试内容65','2017-03-06 21:53:14','第一篇文章'),(289,'../images/123.jpg','匿名网友_::1','测试内容66','2017-03-06 21:53:14','第一篇文章'),(290,'../images/123.jpg','匿名网友_::1','测试内容67','2017-03-06 21:53:14','第一篇文章'),(291,'../images/123.jpg','匿名网友_::1','测试内容68','2017-03-06 21:53:14','第一篇文章'),(292,'../images/123.jpg','匿名网友_::1','测试内容69','2017-03-06 21:53:14','第一篇文章'),(293,'../images/123.jpg','匿名网友_::1','测试内容70','2017-03-06 21:53:14','第一篇文章'),(294,'../images/123.jpg','匿名网友_::1','测试内容71','2017-03-06 21:53:14','第一篇文章'),(295,'../images/123.jpg','匿名网友_::1','测试内容72','2017-03-06 21:53:14','第一篇文章'),(296,'../images/123.jpg','匿名网友_::1','测试内容73','2017-03-06 21:53:14','第一篇文章'),(297,'../images/123.jpg','匿名网友_::1','测试内容74','2017-03-06 21:53:14','第一篇文章'),(298,'../images/123.jpg','匿名网友_::1','测试内容75','2017-03-06 21:53:14','第一篇文章'),(299,'../images/123.jpg','匿名网友_::1','测试内容76','2017-03-06 21:53:14','第一篇文章'),(300,'../images/123.jpg','匿名网友_::1','测试内容77','2017-03-06 21:53:14','第一篇文章'),(301,'../images/123.jpg','匿名网友_::1','测试内容78','2017-03-06 21:53:14','第一篇文章'),(302,'../images/123.jpg','匿名网友_::1','测试内容79','2017-03-06 21:53:14','第一篇文章'),(303,'../images/123.jpg','匿名网友_::1','测试内容80','2017-03-06 21:53:14','第一篇文章'),(304,'../images/123.jpg','匿名网友_::1','测试内容81','2017-03-06 21:53:14','第一篇文章'),(305,'../images/123.jpg','匿名网友_::1','测试内容82','2017-03-06 21:53:14','第一篇文章'),(306,'../images/123.jpg','匿名网友_::1','测试内容83','2017-03-06 21:53:14','第一篇文章'),(307,'../images/123.jpg','匿名网友_::1','测试内容84','2017-03-06 21:53:14','第一篇文章'),(308,'../images/123.jpg','匿名网友_::1','测试内容85','2017-03-06 21:53:14','第一篇文章'),(309,'../images/123.jpg','匿名网友_::1','测试内容86','2017-03-06 21:53:14','第一篇文章'),(310,'../images/123.jpg','匿名网友_::1','测试内容87','2017-03-06 21:53:14','第一篇文章'),(311,'../images/123.jpg','匿名网友_::1','测试内容88','2017-03-06 21:53:14','第一篇文章'),(312,'../images/123.jpg','匿名网友_::1','测试内容89','2017-03-06 21:53:14','第一篇文章'),(313,'../images/123.jpg','匿名网友_::1','测试内容90','2017-03-06 21:53:14','第一篇文章'),(314,'../images/123.jpg','匿名网友_::1','测试内容91','2017-03-06 21:53:14','第一篇文章'),(315,'../images/123.jpg','匿名网友_::1','测试内容92','2017-03-06 21:53:14','第一篇文章'),(316,'../images/123.jpg','匿名网友_::1','测试内容93','2017-03-06 21:53:14','第一篇文章'),(317,'../images/123.jpg','匿名网友_::1','测试内容94','2017-03-06 21:53:14','第一篇文章'),(318,'../images/123.jpg','匿名网友_::1','测试内容95','2017-03-06 21:53:14','第一篇文章'),(319,'../images/123.jpg','匿名网友_::1','测试内容96','2017-03-06 21:53:14','第一篇文章'),(320,'../images/123.jpg','匿名网友_::1','测试内容97','2017-03-06 21:53:14','第一篇文章'),(321,'../images/123.jpg','匿名网友_::1','测试内容98','2017-03-06 21:53:14','第一篇文章'),(322,'../images/123.jpg','匿名网友_::1','测试内容99','2017-03-06 21:53:14','第一篇文章'),(323,'../images/123.jpg','匿名网友_::1','测试内容100','2017-03-06 21:53:14','第一篇文章'),(324,'../images/123.jpg','匿名网友_::1','测试内容101','2017-03-06 21:53:14','第一篇文章'),(325,'../images/123.jpg','匿名网友_::1','测试内容102','2017-03-06 21:53:14','第一篇文章'),(326,'../images/123.jpg','匿名网友_::1','测试内容103','2017-03-06 21:53:14','第一篇文章'),(327,'../images/123.jpg','匿名网友_::1','测试内容104','2017-03-06 21:53:14','第一篇文章'),(328,'../images/123.jpg','匿名网友_::1','测试内容105','2017-03-06 21:53:14','第一篇文章'),(329,'../images/123.jpg','匿名网友_::1','测试内容106','2017-03-06 21:53:14','第一篇文章'),(330,'../images/123.jpg','匿名网友_::1','测试内容107','2017-03-06 21:53:14','第一篇文章'),(331,'../images/123.jpg','匿名网友_::1','测试内容108','2017-03-06 21:53:14','第一篇文章'),(332,'../images/123.jpg','匿名网友_::1','测试内容109','2017-03-06 21:53:14','第一篇文章'),(333,'../images/123.jpg','匿名网友_::1','测试内容110','2017-03-06 21:53:14','第一篇文章'),(334,'../images/123.jpg','匿名网友_::1','测试内容111','2017-03-06 21:53:14','第一篇文章'),(335,'../images/123.jpg','匿名网友_::1','测试内容112','2017-03-06 21:53:14','第一篇文章'),(336,'../images/123.jpg','匿名网友_::1','测试内容113','2017-03-06 21:53:14','第一篇文章'),(337,'../images/123.jpg','匿名网友_::1','测试内容114','2017-03-06 21:53:14','第一篇文章'),(338,'../images/123.jpg','匿名网友_::1','测试内容115','2017-03-06 21:53:14','第一篇文章'),(339,'../images/123.jpg','匿名网友_::1','测试内容116','2017-03-06 21:53:14','第一篇文章'),(340,'../images/123.jpg','匿名网友_::1','测试内容117','2017-03-06 21:53:14','第一篇文章'),(341,'../images/123.jpg','匿名网友_::1','测试内容118','2017-03-06 21:53:14','第一篇文章'),(342,'../images/123.jpg','匿名网友_::1','测试内容119','2017-03-06 21:53:14','第一篇文章'),(343,'../images/123.jpg','匿名网友_::1','测试内容120','2017-03-06 21:53:14','第一篇文章'),(344,'../images/123.jpg','匿名网友_::1','测试内容121','2017-03-06 21:53:14','第一篇文章'),(345,'../images/123.jpg','匿名网友_::1','测试内容122','2017-03-06 21:53:14','第一篇文章'),(346,'../images/123.jpg','匿名网友_::1','测试内容123','2017-03-06 21:53:14','第一篇文章'),(347,'../images/123.jpg','匿名网友_::1','测试内容124','2017-03-06 21:53:14','第一篇文章'),(348,'../images/123.jpg','匿名网友_::1','测试内容125','2017-03-06 21:53:14','第一篇文章'),(349,'../images/123.jpg','匿名网友_::1','测试内容126','2017-03-06 21:53:14','第一篇文章'),(350,'../images/123.jpg','匿名网友_::1','测试内容127','2017-03-06 21:53:14','第一篇文章'),(351,'../images/123.jpg','匿名网友_::1','测试内容128','2017-03-06 21:53:14','第一篇文章'),(352,'../images/123.jpg','匿名网友_::1','测试内容129','2017-03-06 21:53:14','第一篇文章'),(353,'../images/123.jpg','匿名网友_::1','测试内容130','2017-03-06 21:53:14','第一篇文章'),(354,'../images/123.jpg','匿名网友_::1','测试内容131','2017-03-06 21:53:14','第一篇文章'),(355,'../images/123.jpg','匿名网友_::1','测试内容132','2017-03-06 21:53:14','第一篇文章'),(356,'../images/123.jpg','匿名网友_::1','测试内容133','2017-03-06 21:53:14','第一篇文章'),(357,'../images/123.jpg','匿名网友_::1','测试内容134','2017-03-06 21:53:14','第一篇文章'),(358,'../images/123.jpg','匿名网友_::1','测试内容135','2017-03-06 21:53:14','第一篇文章'),(359,'../images/123.jpg','匿名网友_::1','测试内容136','2017-03-06 21:53:14','第一篇文章'),(360,'../images/123.jpg','匿名网友_::1','测试内容137','2017-03-06 21:53:14','第一篇文章'),(361,'../images/123.jpg','匿名网友_::1','测试内容138','2017-03-06 21:53:14','第一篇文章'),(362,'../images/123.jpg','匿名网友_::1','测试内容139','2017-03-06 21:53:14','第一篇文章'),(363,'../images/123.jpg','匿名网友_::1','测试内容140','2017-03-06 21:53:14','第一篇文章'),(364,'../images/123.jpg','匿名网友_::1','测试内容141','2017-03-06 21:53:14','第一篇文章'),(365,'../images/123.jpg','匿名网友_::1','测试内容142','2017-03-06 21:53:14','第一篇文章'),(366,'../images/123.jpg','匿名网友_::1','测试内容143','2017-03-06 21:53:14','第一篇文章'),(367,'../images/123.jpg','匿名网友_::1','测试内容144','2017-03-06 21:53:14','第一篇文章'),(368,'../images/123.jpg','匿名网友_::1','测试内容145','2017-03-06 21:53:14','第一篇文章'),(369,'../images/123.jpg','匿名网友_::1','测试内容146','2017-03-06 21:53:14','第一篇文章'),(370,'../images/123.jpg','匿名网友_::1','测试内容147','2017-03-06 21:53:14','第一篇文章'),(371,'../images/123.jpg','匿名网友_::1','测试内容148','2017-03-06 21:53:14','第一篇文章'),(372,'../images/123.jpg','匿名网友_::1','测试内容149','2017-03-06 21:53:14','第一篇文章'),(373,'../images/123.jpg','匿名网友_::1','测试内容150','2017-03-06 21:53:14','第一篇文章'),(374,'../images/123.jpg','匿名网友_::1','测试内容151','2017-03-06 21:53:14','第一篇文章'),(375,'../images/123.jpg','匿名网友_::1','测试内容152','2017-03-06 21:53:14','第一篇文章'),(376,'../images/123.jpg','匿名网友_::1','测试内容153','2017-03-06 21:53:14','第一篇文章'),(377,'../images/123.jpg','匿名网友_::1','测试内容154','2017-03-06 21:53:14','第一篇文章'),(378,'../images/123.jpg','匿名网友_::1','测试内容155','2017-03-06 21:53:14','第一篇文章'),(379,'../images/123.jpg','匿名网友_::1','测试内容156','2017-03-06 21:53:14','第一篇文章'),(380,'../images/123.jpg','匿名网友_::1','测试内容157','2017-03-06 21:53:14','第一篇文章'),(381,'../images/123.jpg','匿名网友_::1','测试内容158','2017-03-06 21:53:14','第一篇文章'),(382,'../images/123.jpg','匿名网友_::1','测试内容159','2017-03-06 21:53:14','第一篇文章'),(383,'../images/123.jpg','匿名网友_::1','测试内容160','2017-03-06 21:53:14','第一篇文章'),(384,'../images/123.jpg','匿名网友_::1','测试内容161','2017-03-06 21:53:14','第一篇文章'),(385,'../images/123.jpg','匿名网友_::1','测试内容162','2017-03-06 21:53:14','第一篇文章'),(386,'../images/123.jpg','匿名网友_::1','测试内容163','2017-03-06 21:53:14','第一篇文章'),(387,'../images/123.jpg','匿名网友_::1','测试内容164','2017-03-06 21:53:14','第一篇文章'),(388,'../images/123.jpg','匿名网友_::1','测试内容165','2017-03-06 21:53:14','第一篇文章'),(389,'../images/123.jpg','匿名网友_::1','测试内容166','2017-03-06 21:53:14','第一篇文章'),(390,'../images/123.jpg','匿名网友_::1','测试内容167','2017-03-06 21:53:14','第一篇文章'),(391,'../images/123.jpg','匿名网友_::1','测试内容168','2017-03-06 21:53:14','第一篇文章'),(392,'../images/123.jpg','匿名网友_::1','测试内容169','2017-03-06 21:53:14','第一篇文章'),(393,'../images/123.jpg','匿名网友_::1','测试内容170','2017-03-06 21:53:14','第一篇文章'),(394,'../images/123.jpg','匿名网友_::1','测试内容171','2017-03-06 21:53:14','第一篇文章'),(395,'../images/123.jpg','匿名网友_::1','测试内容172','2017-03-06 21:53:14','第一篇文章'),(396,'../images/123.jpg','匿名网友_::1','测试内容173','2017-03-06 21:53:14','第一篇文章'),(400,'../images/123.jpg','匿名网友_::1','测试内容177','2017-03-06 21:53:14','第一篇文章'),(404,'../images/123.jpg','匿名网友_::1','测试内容181','2017-03-06 21:53:14','第一篇文章'),(406,'../images/123.jpg','匿名网友_::1','测试内容183','2017-03-06 21:53:14','第一篇文章'),(408,'../images/123.jpg','匿名网友_::1','测试内容185','2017-03-06 21:53:14','第一篇文章'),(410,'../images/123.jpg','匿名网友_::1','测试内容187','2017-03-06 21:53:14','第一篇文章'),(411,'../images/123.jpg','匿名网友_::1','测试内容188','2017-03-06 21:53:14','第一篇文章'),(413,'../images/123.jpg','匿名网友_::1','测试内容190','2017-03-06 21:53:14','第一篇文章'),(415,'../images/123.jpg','匿名网友_::1','测试内容192','2017-03-06 21:53:14','第一篇文章'),(423,'../images/default_face.jpg','匿名网友_192.168.23.2','我来啦','2017-03-07 10:37:39','山重水复疑无路'),(471,'../images/123.jpg','站长_::1','评论咯','2017-03-09 14:40:10','山重水复疑无路'),(472,'../images/123.jpg','站长_::1','aaa','2017-03-09 14:41:01','山重水复疑无路'),(474,'../images/123.jpg','站长_::1',NULL,'2017-03-09 14:44:42',NULL),(476,'../images/123.jpg','站长_::1',NULL,'2017-03-09 14:46:16',NULL),(477,'../images/123.jpg','站长_::1','wwe','2017-03-09 14:48:06','山重水复疑无路'),(478,'../images/123.jpg','站长_::1','qqw','2017-03-09 14:48:14','山重水复疑无路'),(479,'../images/123.jpg','站长_::1','qq','2017-03-09 14:49:28','山重水复疑无路'),(486,'../images/123.jpg','站长_::1','q','2017-03-09 17:03:29','山重水复疑无路'),(489,'../images/123.jpg','站长_::1','qq','2017-03-10 22:47:39','fdwoxshib');
/*!40000 ALTER TABLE `art_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `art_visit`
--

DROP TABLE IF EXISTS `art_visit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `art_visit` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `visit_ip` varchar(50) NOT NULL,
  `visit_title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `art_visit_ibfk_1` (`visit_title`),
  CONSTRAINT `art_visit_ibfk_1` FOREIGN KEY (`visit_title`) REFERENCES `article` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `art_visit`
--

LOCK TABLES `art_visit` WRITE;
/*!40000 ALTER TABLE `art_visit` DISABLE KEYS */;
INSERT INTO `art_visit` VALUES (1,'::1','第一篇文章'),(2,'::1','山重水复疑无路'),(4,'192.168.23.2','山重水复疑无路'),(6,'192.168.23.2','第一篇文章'),(8,'::1','关于计算机的革命'),(22,'::1','fdwoxshib'),(26,'::1','qohwlxnbd'),(27,'::1','pmbdlosqv'),(28,'::1','sfxbunyqc'),(29,'::1','giodpqmuv');
/*!40000 ALTER TABLE `art_visit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `author` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `last_change_time` datetime DEFAULT NULL,
  `art_type` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=859 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (1,'第一篇文章','admin','第一篇文章','2017-02-28 00:00:00','2017-03-03 17:46:17','prose'),(2,'山重水复疑无路','admin','• css height• css line-height• css width• css min-width• css max-width• css min-height• css max-height• css border• css background• css float• css clear• css display• css font• css text-transform• css英文首字母大写• css font-variant• css font-weight• css font-style• css text-decoration• css 删除线• div css 虚线• css 注释• html 注释• css padding• css margin• css 文本• css font-size• css font-family• css color• css text-align• css text-indent• css 超链接(css a)• css 优化压缩• css id(css #)• css class(css .)• css ul li列表• css 圆角圆边• css 父级子级• css 指针概念• css cursor• css overflow• html px em pt网页单位• CSS important• CSS position• css z-index• css white-space• css img图片• css class id• css link与@import区别• css 选择器• css引入html• css height• css line-height• css width• css min-width• css max-width• css min-height• css max-height• css border• css background• css float• css clear• css display• css font• css text-transform• css英文首字母大写• css font-variant• css font-weight• css font-style• css text-decoration• css 删除线• div css 虚线• css 注释• html 注释• css padding• css margin• css 文本• css font-size• css font-family• css color• css text-align• css text-indent• css 超链接(css a)• css 优化压缩• css id(css #)• css class(css .)• css ul li列表• css 圆角圆边• css 父级子级• css 指针概念• css cursor• css overflow• html px em pt网页单位• CSS important• CSS position• css z-index• css white-space• css img图片• css class id• css link与@import区别• css 选择器• css引入html• css height• css line-height• css width• css min-width• css max-width• css min-height• css max-height• css border• css background• css float• css clear• css display• css font• css text-transform• css英文首字母大写• css font-variant• css font-weight• css font-style• css text-decoration• css 删除线• div css 虚线• css 注释• html 注释• css padding• css margin• css 文本• css font-size• css font-family• css color• css text-align• css text-indent• css 超链接(css a)• css 优化压缩• css id(css #)• css class(css .)• css ul li列表• css 圆角圆边• css 父级子级• css 指针概念• css cursor• css overflow• html px em pt网页单位• CSS important• CSS position• css z-index• css white-space• css img图片• css class id• css link与@import区别• css 选择器• css引入html• css height• css line-height• css width• css min-width• css max-width• css min-height• css max-height• css border• css background• css float• css clear• css display• css font• css text-transform• css英文首字母大写• css font-variant• css font-weight• css font-style• css text-decoration• css 删除线• div css 虚线• css 注释• html 注释• css padding• css margin• css 文本• css font-size• css font-family• css color• css text-align• css text-indent• css 超链接(css a)• css 优化压缩• css id(css #)• css class(css .)• css ul li列表• css 圆角圆边• css 父级子级• css 指针概念• css cursor• css overflow• html px em pt网页单位• CSS important• CSS position• css z-index• css white-space• css img图片• css class id• css link与@import区别• css 选择器• css引入html• css height• css line-height• css width• css min-width• css max-width• css min-height• css max-height• css border• css background• css float• css clear• css display• css font• css text-transform• css英文首字母大写• css font-variant• css font-weight• css font-style• css text-decoration• css 删除线• div css 虚线• css 注释• html 注释• css padding• css margin• css 文本• css font-size• css font-family• css color• css text-align• css text-indent• css 超链接(css a)• css 优化压缩• css id(css #)• css class(css .)• css ul li列表• css 圆角圆边• css 父级子级• css 指针概念• css cursor• css overflow• html px em pt网页单位• CSS important• CSS position• css z-index• css white-space• css img图片• css class id• css link与@import区别• css 选择器• css引入html• css height• css line-height• css width• css min-width• css max-width• css min-height• css max-height• css border• css background• css float• css clear• css display• css font• css text-transform• css英文首字母大写• css font-variant• css font-weight• css font-style• css text-decoration• css 删除线• div css 虚线• css 注释• html 注释• css padding• css margin• css 文本• css font-size• css font-family• css color• css text-align• css text-indent• css 超链接(css a)• css 优化压缩• css id(css #)• css class(css .)• css ul li列表• css 圆角圆边• css 父级子级• css 指针概念• css cursor• css overflow• html px em pt网页单位• CSS important• CSS position• css z-index• css white-space• css img图片• css class id• css link与@import区别• css 选择器• css引入html• css height• css line-height• css width• css min-width• css max-width• css min-height• css max-height• css border• css background• css float• css clear• css display• css font• css text-transform• css英文首字母大写• css font-variant• css font-weight• css font-style• css text-decoration• css 删除线• div css 虚线• css 注释• html 注释• css padding• css margin• css 文本• css font-size• css font-family• css color• css text-align• css text-indent• css 超链接(css a)• css 优化压缩• css id(css #)• css class(css .)• css ul li列表• css 圆角圆边• css 父级子级• css 指针概念• css cursor• css overflow• html px em pt网页单位• CSS important• CSS position• css z-index• css white-space• css img图片• css class id• css link与@import区别• css 选择器• css引入html• css height• css line-height• css width• css min-width• css max-width• css min-height• css max-height• css border• css background• css float• css clear• css display• css font• css text-transform• css英文首字母大写• css font-variant• css font-weight• css font-style• css text-decoration• css 删除线• div css 虚线• css 注释• html 注释• css padding• css margin• css 文本• css font-size• css font-family• css color• css text-align• css text-indent• css 超链接(css a)• css 优化压缩• css id(css #)• css class(css .)• css ul li列表• css 圆角圆边• css 父级子级• css 指针概念• css cursor• css overflow• html px em pt网页单位• CSS important• CSS position• css z-index• css white-space• css img图片• css class id• css link与@import区别• css 选择器• css引入html• css height• css line-height• css width• css min-width• css max-width• css min-height• css max-height• css border• css background• css float• css clear• css display• css font• css text-transform• css英文首字母大写• css font-variant• css font-weight• css font-style• css text-decoration• css 删除线• div css 虚线• css 注释• html 注释• css padding• css margin• css 文本• css font-size• css font-family• css color• css text-align• css text-indent• css 超链接(css a)• css 优化压缩• css id(css #)• css class(css .)• css ul li列表• css 圆角圆边• css 父级子级• css 指针概念• css cursor• css overflow• html px em pt网页单位• CSS important• CSS position• css z-index• css white-space• css img图片• css class id• css link与@import区别• css 选择器• css引入html• css height• css line-height• css width• css min-width• css max-width• css min-height• css max-height• css border• css background• css float• css clear• css display• css font• css text-transform• css英文首字母大写• css font-variant• css font-weight• css font-style• css text-decoration• css 删除线• div css 虚线• css 注释• html 注释• css padding• css margin• css 文本• css font-size• css font-family• css color• css text-align• css text-indent• css 超链接(css a)• css 优化压缩• css id(css #)• css class(css .)• css ul li列表• css 圆角圆边• css 父级子级• css 指针概念• css cursor• css overflow• html px em pt网页单位• CSS important• CSS position• css z-index• css white-space• css img图片• css class id• css link与@import区别• css 选择器• css引入html• css height• css line-height• css width• css min-width• css max-width• css min-height• css max-height• css border• css background• css float• css clear• css display• css font• css text-transform• css英文首字母大写• css font-variant• css font-weight• css font-style• css text-decoration• css 删除线• div css 虚线• css 注释• html 注释• css padding• css margin• css 文本• css font-size• css font-family• css color• css text-align• css text-indent• css 超链接(css a)• css 优化压缩• css id(css #)• css class(css .)• css ul li列表• css 圆角圆边• css 父级子级• css 指针概念• css cursor• css overflow• html px em pt网页单位• CSS important• CSS position• css z-index• css white-space• css img图片• css class id• css link与@import区别• css 选择器• css引入html• css height• css line-height• css width• css min-width• css max-width• css min-height• css max-height• css border• css background• css float• css clear• css display• css font• css text-transform• css英文首字母大写• css font-variant• css font-weight• css font-style• css text-decoration• css 删除线• div css 虚线• css 注释• html 注释• css padding• css margin• css 文本• css font-size• css font-family• css color• css text-align• css text-indent• css 超链接(css a)• css 优化压缩• css id(css #)• css class(css .)• css ul li列表• css 圆角圆边• css 父级子级• css 指针概念• css cursor• css overflow• html px em pt网页单位• CSS important• CSS position• css z-index• css white-space• css img图片• css class id• css link与@import区别• css 选择器• css引入html','2017-02-28 00:00:00','2017-03-03 17:23:51','prose'),(664,'fdwoxshib','uel','cjgrpzvkny','2017-03-01 14:06:04',NULL,'webtec'),(666,'qohwlxnbd','uas','pyzjgefkvc','2017-03-01 14:06:04',NULL,'webtec'),(667,'fsmznyeau','vkd','wltorbcpgj','2017-03-01 14:06:04',NULL,'webtec'),(668,'pmbdlosqv','xtk','cjryiwfhzn','2017-03-01 14:06:04',NULL,'webtec'),(669,'wjrilsnhx','fdy','teazmbupvk','2017-03-01 14:06:04',NULL,'webtec'),(670,'pxbczjafu','rlt','yveqhmnogs','2017-03-01 14:06:04',NULL,'webtec'),(671,'yhndczavl','wgs','trbmoixjfp','2017-03-01 14:06:04',NULL,'webtec'),(672,'auvdjonxe','wfi','ybzrlthmck','2017-03-01 14:06:04',NULL,'webtec'),(673,'ewyimdlpu','ktg','nsjvoabcxq','2017-03-01 14:06:04',NULL,'webtec'),(674,'rwnovlicp','ueq','jafzmxtkhb','2017-03-01 14:06:04',NULL,'webtec'),(675,'sfxbunyqc','ljg','zihetdkovr','2017-03-01 14:06:04',NULL,'webtec'),(676,'dxzhigmkq','tvs','ewjopalfub','2017-03-01 14:06:04',NULL,'webtec'),(677,'axdgpnvtr','oyu','chbmkwszjl','2017-03-01 14:06:04',NULL,'webtec'),(678,'uajfotpbq','kzl','schniegxdv','2017-03-01 14:06:04',NULL,'webtec'),(680,'giodpqmuv','fkc','hslzejwaby','2017-03-01 14:06:04',NULL,'webtec'),(681,'tbvpuqhfi','dkj','aogzwyclmn','2017-03-01 14:06:04',NULL,'webtec'),(683,'ieuftqwjy','vdc','zbloxhsrnm','2017-03-01 14:06:04',NULL,'webtec'),(684,'htcmaweqn','bzi','yksvlgdpxj','2017-03-01 14:06:04',NULL,'webtec'),(685,'libjfdetx','wzm','yvuqgrkhac','2017-03-01 14:06:04',NULL,'webtec'),(686,'ofhgaqsip','czu','rbmlktwdyv','2017-03-01 14:06:04',NULL,'webtec'),(687,'bgrnamzch','ksw','tqodvpluie','2017-03-01 14:06:04',NULL,'webtec'),(688,'opgbwevsz','fyl','uaktjimhnc','2017-03-01 14:06:04',NULL,'webtec'),(689,'wxgiukmlz','fnh','tyjvarcsed','2017-03-01 14:06:04',NULL,'webtec'),(690,'nxizosbcy','rqj','egfhwuvmat','2017-03-01 14:06:04',NULL,'webtec'),(691,'fgimdohzt','nlj','csyapeburx','2017-03-01 14:06:04',NULL,'webtec'),(692,'reljxabmd','gvu','fkhncqyzpt','2017-03-01 14:06:04',NULL,'webtec'),(693,'oqdvcepmn','ylj','wkfaitrgsz','2017-03-01 14:06:04',NULL,'webtec'),(694,'lyzijruap','xnw','stqfbvokgc','2017-03-01 14:06:04',NULL,'webtec'),(695,'lgrkvmuyi','aqe','ptbnozjcfh','2017-03-01 14:06:04',NULL,'webtec'),(696,'ymcjbsutd','erh','xkonpzwliq','2017-03-01 14:06:04',NULL,'webtec'),(697,'txzdmcgvn','ufs','bqeahlrowk','2017-03-01 14:06:04',NULL,'webtec'),(698,'fowsukind','hqm','crajbptxgz','2017-03-01 14:06:04',NULL,'webtec'),(699,'nekzbyxra','luf','shwgodcvpi','2017-03-01 14:06:04',NULL,'webtec'),(700,'mealuwfxp','ngv','yorschiqdk','2017-03-01 14:06:04',NULL,'webtec'),(701,'ihesdyfwc','jxp','zgnouktlvm','2017-03-01 14:06:04',NULL,'webtec'),(702,'xinywushg','qvp','dkmrlzjfob','2017-03-01 14:06:04',NULL,'webtec'),(703,'vjhqdywal','xto','grsnmzpkeu','2017-03-01 14:06:04',NULL,'webtec'),(704,'qrxbhloiz','vnw','fagdsujpey','2017-03-01 14:06:04',NULL,'webtec'),(705,'aypcisdzh','gjr','onktflbuxm','2017-03-01 14:06:04',NULL,'webtec'),(706,'rbghwxesl','pac','imuqkdjtoz','2017-03-01 14:06:04',NULL,'webtec'),(707,'walnxubsr','hfq','zykeoctvpm','2017-03-01 14:06:04',NULL,'webtec'),(708,'hpyvqjbco','rud','tkfwgixaes','2017-03-01 14:06:04',NULL,'webtec'),(709,'zwecxbnvm','raq','fydlhptgij','2017-03-01 14:06:04',NULL,'webtec'),(710,'wluhnorve','zgq','biaxtykjps','2017-03-01 14:06:04',NULL,'webtec'),(711,'jfhxuivba','nec','oslwpkdymz','2017-03-01 14:06:04',NULL,'webtec'),(712,'sqxrtjkmd','unf','hcazeolwpv','2017-03-01 14:06:04',NULL,'webtec'),(713,'opgxwyzch','bva','mujrqntdfe','2017-03-01 14:06:04',NULL,'webtec'),(714,'kszvrahfe','lmx','nptdqbgwui','2017-03-01 14:06:04',NULL,'webtec'),(715,'lqivheofz','pgm','rxctjsdywu','2017-03-01 14:06:04',NULL,'webtec'),(716,'olfjwpdru','nqk','ysbtviczex','2017-03-01 14:06:04',NULL,'webtec'),(717,'lcguqhdiz','nsv','kjotapmexr','2017-03-01 14:06:04',NULL,'webtec'),(718,'nidqwafcl','use','jthpbgzvrx','2017-03-01 14:06:04',NULL,'webtec'),(719,'qoyubpvwm','cfz','sgdxjiatnr','2017-03-01 14:06:04',NULL,'webtec'),(720,'qarkfwngv','xjb','ohpieytcsl','2017-03-01 14:06:04',NULL,'webtec'),(721,'nisdhfktm','blq','eyorwvxazg','2017-03-01 14:06:04',NULL,'webtec'),(722,'bikhmjpdr','uwe','zvxayoqnsg','2017-03-01 14:06:04',NULL,'webtec'),(723,'dhaplntwy','jfz','gvoxueirkc','2017-03-01 14:06:04',NULL,'webtec'),(724,'cxjrvlowd','fpe','inmuysqthk','2017-03-01 14:06:04',NULL,'webtec'),(725,'nxkjmvusw','ipr','ofbclgadzh','2017-03-01 14:06:04',NULL,'webtec'),(726,'dnyqsrxuj','clo','zkeatwvfgi','2017-03-01 14:06:04',NULL,'webtec'),(727,'vwqbjpiod','kug','erxzhamnsl','2017-03-01 14:06:04',NULL,'webtec'),(728,'npqlhuite','wcv','mdajysrgbo','2017-03-01 14:06:04',NULL,'webtec'),(730,'vgoualrih','tsy','zxfbkpmcwq','2017-03-01 14:06:04',NULL,'webtec'),(731,'klxboedti','pqs','grzuywnmfa','2017-03-01 14:06:04',NULL,'webtec'),(732,'kzywuedri','qtj','lgnbxcasfm','2017-03-01 14:06:04',NULL,'webtec'),(733,'mwifgnkbx','lqz','dyujerovhs','2017-03-01 14:06:04',NULL,'webtec'),(734,'rmlbjdxfu','sgt','iconzpwvke','2017-03-01 14:06:04',NULL,'webtec'),(735,'unxdaljtr','gpy','kmwbfoeqcz','2017-03-01 14:06:04',NULL,'webtec'),(736,'mvtjwlycn','qhp','xzfsoigedb','2017-03-01 14:06:04',NULL,'webtec'),(737,'nygazkrlm','tiu','wbopjeqsfd','2017-03-01 14:06:04',NULL,'webtec'),(738,'pamsyfudi','kcx','jbvtqoengw','2017-03-01 14:06:04',NULL,'webtec'),(739,'pvqknystg','fub','wcodrlzmxj','2017-03-01 14:06:04',NULL,'webtec'),(740,'eqrkfalmj','gdn','iuxcpvyzot','2017-03-01 14:06:04',NULL,'webtec'),(741,'ecxrhakdj','isq','zmpogwuyvt','2017-03-01 14:06:04',NULL,'webtec'),(742,'ztydbkslm','jpg','qnuehwfcvo','2017-03-01 14:06:04',NULL,'webtec'),(743,'qelhvmnoz','xbs','ftcudrjyki','2017-03-01 14:06:04',NULL,'webtec'),(744,'qihgjrlsf','dpt','bzcxvkynoa','2017-03-01 14:06:04',NULL,'webtec'),(745,'ecdpgqirv','yal','xfsunkzmbw','2017-03-01 14:06:04',NULL,'webtec'),(747,'yeacoinbk','gfr','xjsqphtvzd','2017-03-01 14:06:04',NULL,'webtec'),(748,'tzejbkxas','mfh','wnciqgloyv','2017-03-01 14:06:04',NULL,'webtec'),(749,'rhwnmbczf','vuo','ayeipkstxl','2017-03-01 14:06:04',NULL,'webtec'),(750,'zdrewscqb','ukv','ixpnmtgayh','2017-03-01 14:06:04',NULL,'webtec'),(751,'xhndqybza','usw','gfemjrkcop','2017-03-01 14:06:04',NULL,'webtec'),(752,'qurlcvedo','wbh','kmtynjxpsa','2017-03-01 14:06:04',NULL,'webtec'),(753,'tyqxpakiu','zom','rsgvbfclhw','2017-03-01 14:06:04',NULL,'webtec'),(755,'pzqbuaocl','ryd','sknivgemhj','2017-03-01 14:06:04',NULL,'webtec'),(756,'qsplycehx','bav','ndmujfgzkw','2017-03-01 14:06:04',NULL,'webtec'),(757,'wkfyjnqeo','cht','ubaszdpirx','2017-03-01 14:06:04',NULL,'webtec'),(758,'axhkruwpd','oyt','fbnlqczgjv','2017-03-01 14:06:04',NULL,'webtec'),(759,'oqxjndruv','zem','hbwptalgyc','2017-03-01 14:06:04',NULL,'webtec'),(760,'xzpfvjdrk','hlo','mebyqniguc','2017-03-01 14:06:04',NULL,'webtec'),(761,'xzuhwgaik','vcq','mlnpdsoyfj','2017-03-01 14:06:04',NULL,'webtec'),(762,'hgtpeczki','aqs','nxujdyvorl','2017-03-01 14:06:04',NULL,'webtec'),(763,'pqnlrvzbk','eth','yuicdmgwsa','2017-03-01 14:06:04',NULL,'webtec'),(764,'ljchkydwa','tqp','ngvbmsxzeo','2017-03-01 14:06:04',NULL,'webtec'),(765,'ramxjywuv','dpz','sbigolfeqh','2017-03-01 14:06:04',NULL,'webtec'),(766,'hqstmxpoy','kbv','wdenulacjf','2017-03-01 14:06:04',NULL,'webtec'),(767,'mvytkwnlz','oha','ixpbgqsure','2017-03-01 14:06:04',NULL,'webtec'),(768,'wfhtmpjrs','dlv','anyougebik','2017-03-01 14:06:04',NULL,'webtec'),(769,'ntpecbrva','dml','kfswqyxhzo','2017-03-01 14:06:04',NULL,'webtec'),(770,'dxeksmfzn','vta','wriqcbuphy','2017-03-01 14:06:04',NULL,'webtec'),(771,'fjouesvlz','bdn','qipcgxmway','2017-03-01 14:06:04',NULL,'webtec'),(772,'ylagubcjv','zpt','xkrdmnwqfs','2017-03-01 14:06:04',NULL,'webtec'),(773,'jmgvfibnt','wuk','sacyrxehdl','2017-03-01 14:06:04',NULL,'webtec'),(774,'hgdmylikv','csq','awfzjextur','2017-03-01 14:06:04',NULL,'webtec'),(775,'ydblnkfsg','qcj','pwhxteraum','2017-03-01 14:06:04',NULL,'webtec'),(776,'zvrstuyba','xge','cdmjkhlinw','2017-03-01 14:06:04',NULL,'webtec'),(777,'yqkmlhvao','nrg','zibefdswcp','2017-03-01 14:06:04',NULL,'webtec'),(779,'stgmkjaho','cxl','uiwbpzfyrq','2017-03-01 14:06:04',NULL,'webtec'),(780,'giowmfyjr','nta','xhpdqvczks','2017-03-01 14:06:04',NULL,'webtec'),(781,'srfjpihul','nad','cxzytbgowe','2017-03-01 14:06:04',NULL,'webtec'),(782,'uqlcoeijm','wsg','zdntvphxyf','2017-03-01 14:06:04',NULL,'webtec'),(783,'rtmoivhcx','glj','dwqzasbeup','2017-03-01 14:06:04',NULL,'webtec'),(784,'ocnatmdke','sfq','pguhbyriwv','2017-03-01 14:06:04',NULL,'webtec'),(785,'dghslraxf','tyn','jmebpkuzwi','2017-03-01 14:06:04',NULL,'webtec'),(786,'dhnetpjzm','kvr','iouxycgqbf','2017-03-01 14:06:04',NULL,'webtec'),(787,'iruveghzl','xbc','djyofmpkna','2017-03-01 14:06:04',NULL,'webtec'),(788,'msgpwfezh','rdu','binkaqcjyo','2017-03-01 14:06:04',NULL,'webtec'),(789,'juwdfxnio','hsz','cabqmryelp','2017-03-01 14:06:04',NULL,'webtec'),(791,'toekyzjsh','mqc','nvxfwuibdl','2017-03-01 14:06:04',NULL,'webtec'),(792,'ndboleuyq','hxw','fctsvkmzip','2017-03-01 14:06:04',NULL,'webtec'),(793,'ioxscrwfn','mty','pvkehlagbd','2017-03-01 14:06:04',NULL,'webtec'),(794,'hxnegbdkm','jct','ourzsavpyw','2017-03-01 14:06:04',NULL,'webtec'),(795,'ynqzthlsi','jvk','dapogrcuex','2017-03-01 14:06:04',NULL,'webtec'),(796,'qutrdmkpy','hva','wngjlxfcsz','2017-03-01 14:06:04',NULL,'webtec'),(797,'exantmdsj','hvq','ybrpzuogkl','2017-03-01 14:06:04',NULL,'webtec'),(798,'amkndlhsy','pui','etfgowjxcz','2017-03-01 14:06:04',NULL,'webtec'),(799,'cuxjifhgl','twy','eznsvrdpba','2017-03-01 14:06:04',NULL,'webtec'),(800,'idogczsxh','kbj','pretmulyqw','2017-03-01 14:06:04',NULL,'webtec'),(801,'tvnuaolhj','igy','ksmfbcperq','2017-03-01 14:06:04',NULL,'webtec'),(802,'etlidrxsy','hnz','qcokbgmvuw','2017-03-01 14:06:04',NULL,'webtec'),(803,'tasnhdbml','gxu','zywvcoqjpk','2017-03-01 14:06:04',NULL,'webtec'),(804,'eijymglpc','dqs','thznvfxbwk','2017-03-01 14:06:04',NULL,'webtec'),(805,'gbhrpvoqc','yxt','amewfjdlsu','2017-03-01 14:06:04',NULL,'webtec'),(806,'tsmgnvafq','yxz','djbprwlkce','2017-03-01 14:06:04',NULL,'webtec'),(807,'ezuxmaocp','yrj','bgwlnkdhit','2017-03-01 14:06:04',NULL,'webtec'),(808,'jubidwvah','lto','eqxrsmpnyg','2017-03-01 14:06:04',NULL,'webtec'),(809,'uqpstyxfl','azn','bgwremkcov','2017-03-01 14:06:04',NULL,'webtec'),(810,'styrquogc','zdf','beniwjmpav','2017-03-01 14:06:04',NULL,'webtec'),(811,'dxseqpywi','uvb','amjortznlg','2017-03-01 14:06:04',NULL,'webtec'),(812,'bztpvmase','khd','fwqnclrujg','2017-03-01 14:06:04',NULL,'webtec'),(813,'jkigwsout','cmy','lxbzaehdrp','2017-03-01 14:06:04',NULL,'webtec'),(814,'zjvretlbd','nik','asqxhyufop','2017-03-01 14:06:04',NULL,'webtec'),(815,'juzvfimtg','snh','yoclrbakpd','2017-03-01 14:06:04',NULL,'webtec'),(816,'gxrzavnhu','dsc','jqefkitbmp','2017-03-01 14:06:04',NULL,'webtec'),(817,'vofyzrgjc','hwd','taxlemnsuk','2017-03-01 14:06:04',NULL,'webtec'),(818,'ftpuokszl','vmx','wirjhnebyq','2017-03-01 14:06:04',NULL,'webtec'),(819,'kydlvwsbu','ifr','chqnpzatgx','2017-03-01 14:06:04',NULL,'webtec'),(820,'mhkcxtnvb','oiq','flwujersdg','2017-03-01 14:06:04',NULL,'webtec'),(821,'rdfotcuhi','jwa','mylsxzpgkv','2017-03-01 14:06:04',NULL,'webtec'),(822,'bmzsflxhp','iao','vtqwnucrge','2017-03-01 14:06:04',NULL,'webtec'),(824,'yfbewhvtq','clu','xmzaorjdin','2017-03-01 14:06:04',NULL,'webtec'),(825,'nyzmophqa','duf','rxcklibtjv','2017-03-01 14:06:04',NULL,'webtec'),(826,'zpfyequkr','imd','tbxawnshjc','2017-03-01 14:06:04',NULL,'webtec'),(827,'hcxgoqmns','iau','jvedkrwybf','2017-03-01 14:06:04',NULL,'webtec'),(828,'kowedvcag','npx','mstyzfqiul','2017-03-01 14:06:04',NULL,'webtec'),(829,'btwepdyzk','mla','rqucxnjhif','2017-03-01 14:06:04',NULL,'webtec'),(830,'ayzhcnqkx','iol','bgjvufwser','2017-03-01 14:06:04',NULL,'webtec'),(831,'obcqukdpr','emn','zagsythixj','2017-03-01 14:06:04',NULL,'webtec'),(832,'bkuvejhds','lgw','tnaprcxqyz','2017-03-01 14:06:04',NULL,'webtec'),(833,'evamhdlsk','xgt','ubcnzqfryw','2017-03-01 14:06:04',NULL,'webtec'),(834,'jyedzbtnr','fks','gpmhaulwoq','2017-03-01 14:06:04',NULL,'webtec'),(835,'rxgwzvtkq','sho','pnfmiujadl','2017-03-01 14:06:04',NULL,'webtec'),(836,'ebrwxukcd','gtn','hjvoqzlfip','2017-03-01 14:06:04',NULL,'webtec'),(837,'kvxojegid','alc','sfpnuqrtwy','2017-03-01 14:06:04',NULL,'webtec'),(838,'xjpvsnguk','lom','iyebqrthzc','2017-03-01 14:06:04',NULL,'webtec'),(840,'xrnblcaop','jwi','ufdqymtvez','2017-03-01 14:06:04',NULL,'webtec'),(841,'cnyxokzlj','qpm','dertuhifab','2017-03-01 14:06:04',NULL,'webtec'),(842,'jdmboftan','eqi','lkhuprzxyv','2017-03-01 14:06:04',NULL,'webtec'),(843,'dtpcxwosf','mnj','uqakgzhrvi','2017-03-01 14:06:04',NULL,'webtec'),(844,'ymdankjct','lsg','wxrboqeiuh','2017-03-01 14:06:04',NULL,'webtec'),(845,'gvwjuynzm','kbc','odfarlhtpq','2017-03-01 14:06:04',NULL,'webtec'),(846,'jbmnsvprh','lcz','kxytgfoiwa','2017-03-01 14:06:04',NULL,'webtec'),(848,'irtlcuovw','sem','hbxdnjkgqp','2017-03-01 14:06:04',NULL,'webtec'),(849,'uvowgcknt','lde','qsypjafxzi','2017-03-01 14:06:04',NULL,'webtec'),(855,'hwckujsla','bnf','zermovdtgp','2017-03-01 14:06:04',NULL,'webtec'),(856,'fcdeyrgwn','tbq','vljhpizxka','2017-03-01 14:06:04',NULL,'webtec'),(857,'关于计算机的革命','admin','关于计算机的革命关于计算机的革命关于计算机的革命关于计算机的革命关于计算机的革命','2017-03-03 07:59:02','2017-03-03 15:24:12','webtec'),(858,'月下独酌','admin','花间一壶酒，独酌无相亲','2017-03-03 11:02:30',NULL,'webtec');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `artvisitnum`
--

DROP TABLE IF EXISTS `artvisitnum`;
/*!50001 DROP VIEW IF EXISTS `artvisitnum`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `artvisitnum` (
  `title` tinyint NOT NULL,
  `num` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `cmt_reply`
--

DROP TABLE IF EXISTS `cmt_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmt_reply` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `reply_name` varchar(50) NOT NULL,
  `reply_face` varchar(50) DEFAULT NULL,
  `reply_content` text,
  `reply_time` datetime DEFAULT NULL,
  `comment_id` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cmt_reply_ibfk_1` (`comment_id`),
  CONSTRAINT `cmt_reply_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `art_comment` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=366 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmt_reply`
--

LOCK TABLES `cmt_reply` WRITE;
/*!40000 ALTER TABLE `cmt_reply` DISABLE KEYS */;
INSERT INTO `cmt_reply` VALUES (8,'站长_::1','../images/123.jpg','4444444','2017-03-08 09:39:25',423),(9,'站长_::1','../images/123.jpg','66666','2017-03-08 09:41:17',423),(11,'站长_::1','../images/123.jpg','rrrrrrr','2017-03-08 09:41:54',423),(13,'站长_::1','../images/123.jpg','tyuityu','2017-03-08 09:47:06',18),(31,'站长_::1','../images/123.jpg','55','2017-03-08 19:17:27',NULL),(32,'站长_::1','../images/123.jpg','回复 站长_::1：qqq','2017-03-08 19:28:04',423),(33,'站长_::1','../images/123.jpg','wwww','2017-03-08 19:29:08',423),(35,'站长_::1','../images/123.jpg','555','2017-03-08 19:29:34',423),(37,'站长_::1','../images/123.jpg','555','2017-03-08 19:29:52',423),(38,'站长_::1','../images/123.jpg','qwe','2017-03-08 21:33:12',423),(55,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(56,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(57,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(58,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(59,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(60,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(61,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(62,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(63,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(64,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(65,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(66,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(67,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(68,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(69,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(70,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(71,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(72,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(73,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(74,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(75,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(76,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(77,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(78,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(79,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(80,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(81,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(82,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(83,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(84,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(85,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(86,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(87,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(88,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(89,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(90,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(91,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(92,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(93,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:17',423),(94,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(95,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(96,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(97,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(98,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(99,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(100,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(101,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(102,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(103,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(104,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(105,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(106,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(107,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(108,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(109,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(110,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(111,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(112,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(113,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(114,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(115,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(116,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(117,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(118,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(119,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(120,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(121,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(122,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(123,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(124,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(125,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(126,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(127,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(128,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(129,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(130,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(131,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(132,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(133,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(134,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(135,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(136,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(137,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(138,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(139,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(140,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(141,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(142,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(143,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(144,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(145,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(146,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(147,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(148,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(149,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(150,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(151,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(152,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(153,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(154,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:18',423),(155,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(156,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(157,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(158,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(159,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(160,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(161,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(162,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(163,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(164,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(165,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(166,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(167,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(168,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(169,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(170,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(171,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(172,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(173,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(174,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(175,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(176,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(177,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(178,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(179,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(180,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(181,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(182,'站长_::1','../images/123.jpg','aaa','2017-03-08 21:35:19',423),(241,'站长_::1','../images/123.jpg','222','2017-03-08 23:00:05',4),(242,'站长_::1','../images/123.jpg','回复 站长_::1：3333','2017-03-08 23:00:14',4),(243,'站长_::1','../images/123.jpg','回复 站长_::1：1111','2017-03-08 23:00:23',4),(244,'站长_::1','../images/123.jpg','333','2017-03-08 23:00:27',4),(245,'站长_::1','../images/123.jpg','333','2017-03-08 23:00:34',4),(365,'站长_::1','../images/123.jpg','ww','2017-03-10 22:47:46',489);
/*!40000 ALTER TABLE `cmt_reply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `cmtnumview`
--

DROP TABLE IF EXISTS `cmtnumview`;
/*!50001 DROP VIEW IF EXISTS `cmtnumview`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `cmtnumview` (
  `title` tinyint NOT NULL,
  `num` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `cmtreplyview`
--

DROP TABLE IF EXISTS `cmtreplyview`;
/*!50001 DROP VIEW IF EXISTS `cmtreplyview`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `cmtreplyview` (
  `title` tinyint NOT NULL,
  `comment_id` tinyint NOT NULL,
  `reply_num` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `nickname` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Current Database: `partrick`
--

USE `partrick`;

--
-- Final view structure for view `artvisitnum`
--

/*!50001 DROP TABLE IF EXISTS `artvisitnum`*/;
/*!50001 DROP VIEW IF EXISTS `artvisitnum`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `artvisitnum` AS select `art_visit`.`visit_title` AS `title`,count(0) AS `num` from `art_visit` group by `art_visit`.`visit_title` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cmtnumview`
--

/*!50001 DROP TABLE IF EXISTS `cmtnumview`*/;
/*!50001 DROP VIEW IF EXISTS `cmtnumview`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cmtnumview` AS select `article`.`title` AS `title`,count(0) AS `num` from (`article` join `art_comment`) where (`article`.`title` = `art_comment`.`art_title`) group by `article`.`title` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `cmtreplyview`
--

/*!50001 DROP TABLE IF EXISTS `cmtreplyview`*/;
/*!50001 DROP VIEW IF EXISTS `cmtreplyview`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `cmtreplyview` AS select `art_comment`.`art_title` AS `title`,`cmt_reply`.`comment_id` AS `comment_id`,count(0) AS `reply_num` from (`cmt_reply` join `art_comment`) where (`cmt_reply`.`comment_id` = `art_comment`.`id`) group by `cmt_reply`.`comment_id` */;
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

-- Dump completed on 2017-03-11 14:15:44
