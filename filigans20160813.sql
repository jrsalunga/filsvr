CREATE DATABASE  IF NOT EXISTS `filigans` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `filigans`;
-- MySQL dump 10.13  Distrib 5.6.24, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: filigans
-- ------------------------------------------------------
-- Server version	5.6.24-0ubuntu2

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
-- Table structure for table `active_promo`
--

DROP TABLE IF EXISTS `active_promo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `active_promo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `promo_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `active_promo`
--

LOCK TABLES `active_promo` WRITE;
/*!40000 ALTER TABLE `active_promo` DISABLE KEYS */;
/*!40000 ALTER TABLE `active_promo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `additional_transactions`
--

DROP TABLE IF EXISTS `additional_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `additional_transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `amount` double NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `reference_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `booking_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_additional_transaction_1_idx` (`booking_id`),
  CONSTRAINT `fk_additional_transaction_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `additional_transactions`
--

LOCK TABLES `additional_transactions` WRITE;
/*!40000 ALTER TABLE `additional_transactions` DISABLE KEYS */;
INSERT INTO `additional_transactions` VALUES (45,450,'ASDFASDF','2342342',29,'2016-08-04 00:40:16','2016-08-04 00:40:16'),(46,-4000,'FAFSFAF','DFDFASDFAFD',29,'2016-08-04 00:40:59','2016-08-04 00:40:59'),(47,-4000,'FASFASF','dfFASFA',29,'2016-08-04 00:41:39','2016-08-04 00:41:39'),(48,11600,'Rendered Change','57a2f0ffb4d65',29,'2016-08-04 00:44:45','2016-08-04 00:44:45'),(49,1000,'Rendered Change','57a2f2bb7c611',30,'2016-08-04 00:52:23','2016-08-04 00:52:23'),(50,-500,'345345353','3534353',30,'2016-08-04 01:30:06','2016-08-04 01:30:06'),(52,1000,'Partial Payment','57a3009d578b5',34,'2016-08-04 01:45:17','2016-08-04 01:45:17'),(53,-200,'Partial Payment','57a3017ae525c',35,'2016-08-04 01:48:59','2016-08-04 01:48:59'),(55,-1680,'Paid Remaing Balance','57a3017ae525c',35,'2016-08-04 02:12:40','2016-08-04 02:12:40'),(56,-200,'Partial Payment','57a308360db46',36,'2016-08-04 02:17:42','2016-08-04 02:17:42'),(57,0,'Paid Remaing Balance','57a308360db46',36,'2016-08-04 02:17:50','2016-08-04 02:17:50'),(58,-200,'Paid Remaing Balance','57a308360db46',36,'2016-08-04 02:18:28','2016-08-04 02:18:28'),(59,1520,'Paid Remaing Balance','57a308360db46',36,'2016-08-04 02:18:56','2016-08-04 02:18:56'),(60,-1520,'Paid Remaing Balance','57a308360db46',36,'2016-08-04 02:20:25','2016-08-04 02:20:25'),(61,-500,'Partial Payment','57a308f90d9d4',37,'2016-08-04 02:20:57','2016-08-04 02:20:57'),(62,-3972,'Paid Remaing Balance','57a308f90d9d4',37,'2016-08-04 02:21:18','2016-08-04 02:21:18'),(63,-50,'Partial Payment','57a309a392cb9',38,'2016-08-04 02:23:47','2016-08-04 02:23:47'),(64,-174,'Paid Remaing Balance','57a309a392cb9',38,'2016-08-04 02:26:50','2016-08-04 02:26:50'),(65,-2000,'Partial Payment','57a30e234ee08',39,'2016-08-04 02:42:59','2016-08-04 02:42:59'),(66,-400,'Partial Payment','57a343baeb278',40,'2016-08-04 06:31:39','2016-08-04 06:31:39'),(67,-400,'Partial Payment','57a343bf2b62d',41,'2016-08-04 06:31:43','2016-08-04 06:31:43'),(68,-400,'Partial Payment','57a343e1b710c',42,'2016-08-04 06:32:17','2016-08-04 06:32:17'),(69,-500,'Partial Payment','57a344cd70f26',43,'2016-08-04 06:36:13','2016-08-04 06:36:13'),(70,-120,'Partial Payment','57a3452443463',44,'2016-08-04 06:37:40','2016-08-04 06:37:40'),(71,-200,'Partial Payment','57a35124f2e6b',45,'2016-08-04 07:28:53','2016-08-04 07:28:53'),(72,-88,'Paid Remaing Balance','57a35124f2e6b',45,'2016-08-04 07:29:09','2016-08-04 07:29:09'),(73,342,'sdfasfasf','23424234',45,'2016-08-04 07:30:34','2016-08-04 07:30:34'),(74,-333,'Partial Payment','57a351feb84f2',46,'2016-08-04 07:32:30','2016-08-04 07:32:30'),(75,-2342,'Partial Payment','57a3523404d9e',47,'2016-08-04 07:33:24','2016-08-04 07:33:24'),(76,-2342,'Partial Payment','57a352a899108',48,'2016-08-04 07:35:20','2016-08-04 07:35:20'),(77,-2342,'Partial Payment','57a3548e9a95e',49,'2016-08-04 07:43:26','2016-08-04 07:43:26'),(78,-23,'Partial Payment','57a354c6b2268',50,'2016-08-04 07:44:22','2016-08-04 07:44:22'),(79,-20,'Partial Payment','57a354ef164d0',51,'2016-08-04 07:45:03','2016-08-04 07:45:03'),(80,-100,'Partial Payment','57a35540c4ce7',52,'2016-08-04 07:46:24','2016-08-04 07:46:24'),(81,-10000,'Partial Payment','57a44f09c1f72',53,'2016-08-05 01:32:09','2016-08-05 01:32:09'),(82,-10,'Partial Payment','57a9840b5e0c7',54,'2016-08-09 00:19:39','2016-08-09 00:19:39'),(83,-1000,'Paid Remaing Balance','57a308f90d9d4',37,'2016-08-09 00:28:28','2016-08-09 00:28:28'),(84,-2000,'Paid Remaing Balance','57a308f90d9d4',37,'2016-08-09 00:28:37','2016-08-09 00:28:37'),(85,-800,'Paid Remaing Balance','57a308360db46',36,'2016-08-09 00:28:53','2016-08-09 00:28:53'),(86,-5000,'Partial Payment','57a98e08edd6d',55,'2016-08-09 01:02:17','2016-08-09 01:02:17'),(87,-5,'Partial Payment','57a98fa2d61b5',56,'2016-08-09 01:09:06','2016-08-09 01:09:06'),(88,-3000,'Partial Payment','57a990144be20',57,'2016-08-09 01:11:00','2016-08-09 01:11:00'),(89,-6,'Partial Payment','57a99372226ac',58,'2016-08-09 01:25:22','2016-08-09 01:25:22');
/*!40000 ALTER TABLE `additional_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booked_rooms`
--

DROP TABLE IF EXISTS `booked_rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booked_rooms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` int(10) unsigned NOT NULL,
  `room_type_id` int(10) unsigned NOT NULL,
  `room_id` int(10) unsigned DEFAULT NULL,
  `check_in` datetime NOT NULL,
  `check_out` datetime NOT NULL,
  `num_adults` tinyint(2) NOT NULL,
  `num_meals` tinyint(2) DEFAULT '0',
  `num_children` tinyint(2) DEFAULT '0',
  `room_price` double DEFAULT NULL,
  `food_price` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_booked_room_type_1_idx` (`booking_id`),
  KEY `fk_booked_rooms_1_idx` (`room_type_id`),
  KEY `fk_booked_rooms_2_idx` (`room_id`),
  CONSTRAINT `fk_booked_room_type_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_booked_rooms_1` FOREIGN KEY (`room_type_id`) REFERENCES `room_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booked_rooms`
--

LOCK TABLES `booked_rooms` WRITE;
/*!40000 ALTER TABLE `booked_rooms` DISABLE KEYS */;
INSERT INTO `booked_rooms` VALUES (19,29,3,11,'2016-08-24 14:00:00','2016-08-31 12:00:00',0,0,3,3100,1234,'2016-08-04 00:38:39','2016-08-04 00:38:39'),(20,30,3,11,'2016-09-20 14:00:00','2016-09-30 12:00:00',2,0,0,4200,3702,'2016-08-04 00:46:03','2016-08-04 00:46:03'),(21,34,3,12,'2016-08-26 14:00:00','2016-08-31 12:00:00',0,0,4,2100,0,'2016-08-04 01:45:17','2016-08-04 01:45:17'),(22,35,3,11,'2016-08-10 14:00:00','2016-08-13 12:00:00',0,0,3,1500,0,'2016-08-04 01:48:59','2016-08-04 01:48:59'),(23,36,3,11,'2016-08-18 14:00:00','2016-08-20 12:00:00',2,0,1,1000,0,'2016-08-04 02:17:42','2016-08-04 02:17:42'),(24,37,3,12,'2016-09-15 14:00:00','2016-09-22 12:00:00',0,0,4,3100,0,'2016-08-04 02:20:57','2016-08-04 02:20:57'),(25,38,5,9,'2016-08-29 14:00:00','2016-08-31 12:00:00',0,0,3,200,0,'2016-08-04 02:23:47','2016-08-04 02:23:47'),(26,39,5,9,'2016-09-15 14:00:00','2016-09-29 12:00:00',0,0,3,1400,0,'2016-08-04 02:42:59','2016-08-04 02:42:59'),(27,42,3,11,'2016-08-03 14:00:00','2016-08-09 12:00:00',0,0,2,3000,0,'2016-08-04 06:32:18','2016-08-04 06:32:18'),(28,43,3,12,'2016-08-09 14:00:00','2016-08-18 12:00:00',0,0,2,3700,0,'2016-08-04 06:36:13','2016-08-04 06:36:13'),(29,44,3,12,'2016-08-03 14:00:00','2016-08-05 12:00:00',0,0,1,1000,0,'2016-08-04 06:37:40','2016-08-04 06:37:40'),(30,51,5,15,'2016-08-27 14:00:00','2016-08-28 12:00:00',0,0,2,100,0,'2016-08-04 07:45:03','2016-08-12 19:29:28'),(31,52,3,12,'2016-08-23 14:00:00','2016-08-25 12:00:00',0,0,2,600,0,'2016-08-04 07:46:24','2016-08-04 07:46:24'),(32,53,5,9,'2016-08-09 14:00:00','2016-08-23 12:00:00',2,0,0,1400,0,'2016-08-05 01:32:09','2016-08-05 01:32:09'),(33,54,3,11,'2016-10-20 14:00:00','2016-10-25 12:00:00',0,0,3,5,0,'2016-08-09 00:19:39','2016-08-09 00:19:39'),(34,55,3,11,'2016-10-06 14:00:00','2016-10-13 12:00:00',3,0,0,7,0,'2016-08-09 01:02:17','2016-08-09 01:02:17'),(35,56,3,12,'2016-10-20 14:00:00','2016-10-21 12:00:00',0,0,2,1,0,'2016-08-09 01:09:07','2016-08-09 01:09:07'),(36,57,3,14,'2016-08-26 14:00:00','2016-08-29 12:00:00',0,0,2,1500,0,'2016-08-09 01:11:00','2016-08-09 01:11:00'),(37,58,3,13,'2016-10-20 14:00:00','2016-10-22 12:00:00',2,0,0,2,0,'2016-08-09 01:25:22','2016-08-09 01:25:22'),(38,58,3,14,'2016-10-20 14:00:00','2016-10-22 12:00:00',3,0,0,2,0,'2016-08-09 01:25:22','2016-08-09 01:25:22'),(39,58,3,15,'2016-10-20 14:00:00','2016-10-22 12:00:00',2,0,0,2,0,'2016-08-09 01:25:22','2016-08-09 01:25:22');
/*!40000 ALTER TABLE `booked_rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `booking_no` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` int(11) unsigned DEFAULT NULL,
  `booking_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `total_price` double NOT NULL,
  `amount_paid` double NOT NULL,
  `credits` double DEFAULT '0',
  `additional_remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'N.A',
  `cashier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `booked_timestamp` datetime NOT NULL,
  `checkout_timestamp` datetime NOT NULL,
  `booking_type` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'walk-in',
  PRIMARY KEY (`id`),
  UNIQUE KEY `booking_no_UNIQUE` (`booking_no`),
  KEY `fk_bookings_1_idx` (`customer_id`),
  CONSTRAINT `fk_bookings_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (29,'57a2f0ffb4d65',1,'completed',12904,11600,0,'','2016-08-04 00:38:39','2016-08-09 00:16:33','Fully Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(30,'57a2f2bb7c611',1,'completed',10350,1000,0,'','2016-08-04 00:46:03','2016-08-04 01:30:07','Partially Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(31,'57a30064c49d2',1,'completed',2352,0,0,'','2016-08-04 01:44:20','2016-08-09 00:26:50','Fully Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(32,'57a300691bc69',1,'Checked In',2352,0,0,'','2016-08-04 01:44:25','2016-08-09 00:27:33','Fully Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(33,'57a300833aa70',1,'Checked In',2352,0,0,'','2016-08-04 01:44:51','2016-08-09 00:25:51','Fully Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(34,'57a3009d578b5',1,'Checked In',2352,0,0,'','2016-08-04 01:45:17','2016-08-04 01:45:17','Partially Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(35,'57a3017ae525c',1,'Checked In',1680,0,0,'','2016-08-04 01:48:58','2016-08-04 01:48:58','Partially Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(36,'57a308360db46',1,'Checked In',1120,0,0,'','2016-08-04 02:17:42','2016-08-09 00:28:53','Fully Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(37,'57a308f90d9d4',1,'Checked In',3472,0,0,'','2016-08-04 02:20:57','2016-08-09 00:28:37','Fully Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(38,'57a309a392cb9',1,'completed',224,0,0,'','2016-08-04 02:23:47','2016-08-09 00:24:10','Fully Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(39,'57a30e234ee08',1,'completed',1568,0,0,'','2016-08-04 02:42:59','2016-08-04 06:01:22','Fully Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(40,'57a343baeb278',1,'Checked In',3360,0,0,'','2016-08-04 06:31:38','2016-08-04 06:31:38','Partially Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(41,'57a343bf2b62d',1,'Checked In',3360,0,0,'','2016-08-04 06:31:43','2016-08-04 06:31:43','Partially Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(42,'57a343e1b710c',1,'Checked In',3360,0,0,'','2016-08-04 06:32:17','2016-08-04 06:32:17','Partially Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(43,'57a344cd70f26',1,'Checked In',4144,0,0,'','2016-08-04 06:36:13','2016-08-04 06:36:13','Partially Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(44,'57a3452443463',1,'Checked In',1120,0,0,'','2016-08-04 06:37:40','2016-08-04 06:37:40','Partially Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(45,'57a35124f2e6b',1,'completed',166,0,0,'','2016-08-04 07:28:52','2016-08-04 07:30:34','Fully Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(46,'57a351feb84f2',1,'Checked In',112,0,0,'','2016-08-04 07:32:30','2016-08-04 07:32:30','Partially Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(47,'57a3523404d9e',1,'Checked In',112,0,0,'','2016-08-04 07:33:24','2016-08-04 07:33:24','Partially Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(48,'57a352a899108',1,'Checked In',112,0,0,'','2016-08-04 07:35:20','2016-08-04 07:35:20','Partially Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(49,'57a3548e9a95e',1,'Checked In',112,0,0,'','2016-08-04 07:43:26','2016-08-04 07:43:26','Partially Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(50,'57a354c6b2268',1,'Checked In',112,0,0,'','2016-08-04 07:44:22','2016-08-04 07:44:22','Partially Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(51,'57a354ef164d0',1,'Checked In',112,0,0,'','2016-08-04 07:45:03','2016-08-04 07:45:03','Partially Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(52,'57a35540c4ce7',1,'completed',672,0,0,'','2016-08-04 07:46:24','2016-08-05 01:19:32','Fully Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(53,'57a44f09c1f72',1,'Checked In',1568,0,0,'','2016-08-05 01:32:09','2016-08-05 01:32:09','Fully Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(54,'57a9840b5e0c7',1,'completed',11,0,0,'','2016-08-09 00:19:39','2016-08-09 00:41:20','Fully Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(55,'57a98e08edd6d',1,'Checked In',4732,0,0,'','2016-08-09 01:02:16','2016-08-09 01:02:16','Fully Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(56,'57a98fa2d61b5',1,'Checked In',2,0,0,'','2016-08-09 01:09:06','2016-08-09 01:09:06','Fully Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(57,'57a990144be20',1,'Checked In',2912,0,0,'','2016-08-09 01:11:00','2016-08-09 01:11:00','Fully Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in'),(58,'57a99372226ac',1,'completed',6,0,0,'','2016-08-09 01:25:22','2016-08-09 01:26:43','Fully Paid','','0000-00-00 00:00:00','0000-00-00 00:00:00','walk-in');
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `middlename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nationality` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_email_address_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'sdfasdfasdfasdads','fdfasdfsdfa','<p>sdfas</p>','2016-06-15','sdfasdfasdfasdads','','','',NULL,'2016-06-24 01:36:44','2016-08-04 09:51:38');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `features`
--

DROP TABLE IF EXISTS `features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `features` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `features`
--

LOCK TABLES `features` WRITE;
/*!40000 ALTER TABLE `features` DISABLE KEYS */;
INSERT INTO `features` VALUES (1,'Parking','2016-06-22 22:10:40','2016-06-23 22:20:46'),(3,'Breakfast','2016-06-22 22:33:16','2016-06-23 22:21:07'),(4,'Internet Access','2016-06-22 22:36:58','2016-06-29 23:33:16');
/*!40000 ALTER TABLE `features` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galleries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `caption` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=210 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleries`
--

LOCK TABLES `galleries` WRITE;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
INSERT INTO `galleries` VALUES (181,'dfadf','57734091d359a.jpg','2016-06-28 19:29:21','2016-06-28 20:03:44'),(182,'','577340964d9d3.jpg','2016-06-28 19:29:26','2016-06-28 19:29:26'),(183,'','5773409671805.jpg','2016-06-28 19:29:26','2016-06-28 19:29:26'),(184,'','577340969b992.jpg','2016-06-28 19:29:26','2016-06-28 19:29:26'),(185,'','5773477a6e529.jpg','2016-06-28 19:58:50','2016-06-28 19:58:50'),(186,'','5773477a8bae2.jpg','2016-06-28 19:58:50','2016-06-28 19:58:50'),(187,'','5773477aac63b.jpg','2016-06-28 19:58:50','2016-06-28 19:58:50'),(188,'','5773477adfbeb.jpg','2016-06-28 19:58:50','2016-06-28 19:58:50'),(189,'','5773477b11af1.jpg','2016-06-28 19:58:51','2016-06-28 19:58:51'),(190,'','5773477b2ccdf.jpg','2016-06-28 19:58:51','2016-06-28 19:58:51'),(191,'','5773477b4c245.jpg','2016-06-28 19:58:51','2016-06-28 19:58:51'),(192,'','5773477b727b0.jpg','2016-06-28 19:58:51','2016-06-28 19:58:51'),(193,'','5773477b90cfd.jpg','2016-06-28 19:58:51','2016-06-28 19:58:51'),(194,'','5773477bb6279.jpg','2016-06-28 19:58:51','2016-06-28 19:58:51'),(195,'','5773477bd401f.jpg','2016-06-28 19:58:51','2016-06-28 19:58:51'),(196,'','5773477c3d1f8.jpg','2016-06-28 19:58:52','2016-06-28 19:58:52'),(197,'','5773477c62b14.jpg','2016-06-28 19:58:52','2016-06-28 19:58:52'),(198,'','5773477c7f7cf.jpg','2016-06-28 19:58:52','2016-06-28 19:58:52'),(199,'','5773477c9fbcf.jpg','2016-06-28 19:58:52','2016-06-28 19:58:52'),(200,'','5773477cbfec0.jpg','2016-06-28 19:58:52','2016-06-28 19:58:52'),(201,'','5773477ce1726.jpg','2016-06-28 19:58:52','2016-06-28 19:58:52'),(202,'','5773477d0be7f.jpg','2016-06-28 19:58:53','2016-06-28 19:58:53'),(203,'','5773477d2b943.jpg','2016-06-28 19:58:53','2016-06-28 19:58:53'),(204,'','5773477d4cb23.jpg','2016-06-28 19:58:53','2016-06-28 19:58:53'),(205,'','5773477d6ba79.jpg','2016-06-28 19:58:53','2016-06-28 19:58:53'),(206,'','5773477d8ed0d.jpg','2016-06-28 19:58:53','2016-06-28 19:58:53'),(207,'','5773477dad823.jpg','2016-06-28 19:58:53','2016-06-28 19:58:53'),(208,'','5773477dcc68c.jpg','2016-06-28 19:58:53','2016-06-28 19:58:53'),(209,'','5773477debbb6.jpg','2016-06-28 19:58:53','2016-06-28 19:58:53');
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meal_plans`
--

DROP TABLE IF EXISTS `meal_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meal_plans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meal_plans`
--

LOCK TABLES `meal_plans` WRITE;
/*!40000 ALTER TABLE `meal_plans` DISABLE KEYS */;
INSERT INTO `meal_plans` VALUES (2,'Breakfast',1234,'2016-06-30 19:31:08','2016-06-30 19:47:21');
/*!40000 ALTER TABLE `meal_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2016_06_14_061001_create_room_type_table',1),('2016_06_14_061050_create_rooms_table',1),('2016_06_20_021108_create_booking_table',2),('2016_06_20_021137_create_booked_rooms',3),('2016_06_20_021109_create_booking_table',4),('2016_06_21_020006_create_booked_room_type',5),('2016_06_23_033308_create_features_table',6),('2016_06_23_999999_create_room_features_table',6),('2016_06_24_063549_create_promos_table',7),('2016_06_24_063551_create_promos_table',8),('2016_06_24_090409_create_customers_table',9),('2016_06_27_021603_add_columns_customers_table',10),('2016_06_27_031237_add_columns_roomtype_table',11),('2016_06_27_065353_create_website_settings_table',12),('2016_06_27_070034_create_galleries_table',12),('2016_06_30_010853_create_active_promo_table',13),('2016_07_01_022134_create_meal_plans_table',13),('2016_07_01_071107_create_sessions_table',14),('2016_08_03_041106_create_additional_transaction_table',15);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pricing_calendars`
--

DROP TABLE IF EXISTS `pricing_calendars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pricing_calendars` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `from` date NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `to` date NOT NULL,
  `price` int(11) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL,
  `target` int(11) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_promos_1_idx` (`target`),
  CONSTRAINT `fk_promos_1` FOREIGN KEY (`target`) REFERENCES `room_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pricing_calendars`
--

LOCK TABLES `pricing_calendars` WRITE;
/*!40000 ALTER TABLE `pricing_calendars` DISABLE KEYS */;
INSERT INTO `pricing_calendars` VALUES (2,'asdfsadfs','<p>dfasdfasd</p>','2016-08-17','asdfsadfs','2016-08-26',2342342,1,3,'2016-08-08 20:35:16','2016-08-08 21:36:37'),(3,'Piso lang','<p>test</p>','2016-10-01','piso-lang','2016-10-31',1,0,3,'2016-08-08 23:56:28','2016-08-08 23:56:28');
/*!40000 ALTER TABLE `pricing_calendars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room_features`
--

DROP TABLE IF EXISTS `room_features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room_features` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `room_type_id` int(10) unsigned NOT NULL,
  `feature_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `room_features_room_type_id_foreign` (`room_type_id`),
  KEY `room_features_feature_id_foreign` (`feature_id`),
  CONSTRAINT `room_features_feature_id_foreign` FOREIGN KEY (`feature_id`) REFERENCES `features` (`id`) ON DELETE CASCADE,
  CONSTRAINT `room_features_room_type_id_foreign` FOREIGN KEY (`room_type_id`) REFERENCES `room_type` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room_features`
--

LOCK TABLES `room_features` WRITE;
/*!40000 ALTER TABLE `room_features` DISABLE KEYS */;
INSERT INTO `room_features` VALUES (76,5,1,'','2016-06-29 23:39:37','2016-06-29 23:39:37'),(77,5,3,'','2016-06-29 23:39:37','2016-06-29 23:39:37'),(78,5,4,'','2016-06-29 23:39:37','2016-06-29 23:39:37'),(104,3,1,'','2016-08-04 21:46:41','2016-08-04 21:46:41'),(105,3,3,'','2016-08-04 21:46:41','2016-08-04 21:46:41');
/*!40000 ALTER TABLE `room_features` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room_type`
--

DROP TABLE IF EXISTS `room_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8_unicode_ci NOT NULL,
  `full_description` text COLLATE utf8_unicode_ci NOT NULL,
  `picture` text COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `max_adult` int(11) NOT NULL,
  `max_children` int(11) NOT NULL,
  `beds` int(11) NOT NULL,
  `room_area` double NOT NULL,
  `meal_plan` int(11) unsigned NOT NULL,
  `base_price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `booking_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price_monday` double NOT NULL,
  `price_tuesday` double NOT NULL,
  `price_wednesday` double NOT NULL,
  `price_thursday` double NOT NULL,
  `price_friday` double NOT NULL,
  `price_saturday` double NOT NULL,
  `price_sunday` double NOT NULL,
  `max_online_booking` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_room_type_1_idx` (`meal_plan`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room_type`
--

LOCK TABLES `room_type` WRITE;
/*!40000 ALTER TABLE `room_type` DISABLE KEYS */;
INSERT INTO `room_type` VALUES (3,'Super Deluxe','Some short description is in here.','<p>This is a loooooooooooooooooooong description.</p>','','superior-rooms',1,1,1,50,2,500,'2016-06-15 19:31:51','2016-08-04 21:45:51','',0,100,0,0,0,0,0,4),(5,'Regular Rooms','Some short description is in here.','<p>This is a loooooooooooooooooooong description.</p>','','superior-rooms-1',1,1,1,50,0,100,'2016-06-15 19:32:35','2016-06-29 23:39:37','',0,0,0,0,0,0,0,0),(6,'Superior Rooms','Some short description is in here.','This is a loooooooooooooooooooong description.','','superior-rooms-2',2,1,2,50,1,500,'2016-06-20 00:15:29','2016-06-20 00:15:29','',0,0,0,0,0,0,0,0),(13,'fdsfaf','fasdfdfdfsa','','','fdsfaf',1,1,1,23,0,23,'2016-06-30 00:21:11','2016-06-30 00:21:11','',0,0,0,0,0,0,0,0),(14,'dfadfdfasdf','asdfdfdf','','','dfadfdfasdf',1,1,1,212,0,12,'2016-06-30 00:21:57','2016-06-30 00:21:57','',12,0,0,0,0,0,0,0),(15,'dfadfdfasdf','asdfdfdf','','5774d6cee520e.jpg','dfadfdfasdf-1',1,1,1,212,0,12,'2016-06-30 00:22:38','2016-06-30 00:22:38','',12,0,0,0,0,0,0,0),(16,'dfadfdfasdf','asdfdfdf','','5774d6e529225.jpg','dfadfdfasdf-2',1,1,1,212,0,12,'2016-06-30 00:23:01','2016-06-30 00:23:01','',12,0,0,0,0,0,0,0),(17,'Super Deluxe','Some short description is in here.','','','super-deluxe',1,1,1,50,0,500,'2016-06-30 19:41:42','2016-06-30 19:41:42','',0,100,0,0,0,0,0,0);
/*!40000 ALTER TABLE `room_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rooms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `view` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `room_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'available',
  `room_type_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `target_booking` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'walk-in',
  PRIMARY KEY (`id`),
  UNIQUE KEY `rooms_room_no_unique` (`room_no`),
  KEY `rooms_room_type_id_foreign` (`room_type_id`),
  CONSTRAINT `rooms_room_type_id_foreign` FOREIGN KEY (`room_type_id`) REFERENCES `room_type` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rooms`
--

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` VALUES (9,'dfd','222','available',5,'2016-06-16 16:59:32','2016-08-04 06:08:25','walk-in'),(11,'Sea Side','100','booked',3,'2016-06-20 00:15:29','2016-08-04 06:32:18','walk-in'),(12,'Garage','102','booked',3,'2016-06-29 00:10:41','2016-08-12 00:57:18','walk-in'),(13,'Test','Test','available',3,'2016-08-09 00:37:19','2016-08-12 01:08:08','online'),(14,'Test','2342','available',3,'2016-08-09 00:37:22','2016-08-09 00:37:22','walk-in'),(15,'2342','1002','available',3,'2016-08-09 00:37:27','2016-08-12 19:16:07','walk-in');
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session_booking`
--

DROP TABLE IF EXISTS `session_booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `session_booking` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sessions_ip_address_unique` (`ip_address`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session_booking`
--

LOCK TABLES `session_booking` WRITE;
/*!40000 ALTER TABLE `session_booking` DISABLE KEYS */;
INSERT INTO `session_booking` VALUES (1,'127.0.0.1','[]','2016-06-30 23:48:10','2016-08-12 18:50:22');
/*!40000 ALTER TABLE `session_booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `middlename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'jonathan','Jonathans','a','Espanol','admin','foo@bar.com','$2y$10$v4uQItFgT1rY7tanoSDPlOu/q69R8thFTbJdoOXu5km/AmAq52hdy',NULL,'2016-06-15 19:02:19','2016-06-27 19:07:35'),(2,'dfasd','fasdfasdfsdf','sdfsadfsdf','sdfasdfas','','tan_asdfasdfasdfasdf0300@yahoo.com','',NULL,'2016-08-04 10:07:05','2016-08-04 10:07:05'),(3,'tantan','fjsldkfjaj','kljdslkfja','jdlkafj','housekeeping','tan_0300@yahoo.com','',NULL,'2016-08-12 22:19:14','2016-08-12 22:19:14');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `website_settings`
--

DROP TABLE IF EXISTS `website_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `website_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `about` text COLLATE utf8_unicode_ci NOT NULL,
  `contact_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `google_map` text COLLATE utf8_unicode_ci NOT NULL,
  `telephone_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `facebook` text COLLATE utf8_unicode_ci,
  `terms_and_condition` text COLLATE utf8_unicode_ci NOT NULL,
  `logo` text COLLATE utf8_unicode_ci NOT NULL,
  `tax` tinyint(2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `website_settings`
--

LOCK TABLES `website_settings` WRITE;
/*!40000 ALTER TABLE `website_settings` DISABLE KEYS */;
INSERT INTO `website_settings` VALUES (2,'<p>\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"</p>\r\n<p><img src=\"/photos/1/5774894907dea.jpg\" alt=\"Sample picture\" width=\"295\" height=\"295\" /></p>','asdfasdfasf','<script> </script>\r\n','','tan_0300@yahoo.com',NULL,'<p>dfdsdfasdfasdf</p>','',12,'2016-06-27 00:31:21','2016-06-29 18:52:07');
/*!40000 ALTER TABLE `website_settings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-13 14:33:59
