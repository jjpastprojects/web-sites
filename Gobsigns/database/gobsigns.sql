-- MySQL dump 10.13  Distrib 5.6.27, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: gobsigns
-- ------------------------------------------------------
-- Server version	5.6.27-0ubuntu0.15.04.1

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
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_log`
--

LOCK TABLES `activity_log` WRITE;
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
INSERT INTO `activity_log` VALUES (1,1,'New client \"lucas\" added','127.0.0.1',NULL,'2016-06-29 22:43:21','2016-06-29 22:43:21'),(2,1,'New location \"aaa\" added','127.0.0.1',NULL,'2016-07-01 21:02:53','2016-07-01 21:02:53'),(3,1,'New location \"a\" added','127.0.0.1',NULL,'2016-07-01 21:56:33','2016-07-01 21:56:33'),(4,1,'Location \"a\" updated','127.0.0.1',NULL,'2016-07-02 20:39:09','2016-07-02 20:39:09'),(5,1,'Location \"a\" updated','127.0.0.1',NULL,'2016-07-02 20:42:56','2016-07-02 20:42:56');
/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contact_number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `app_description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('save_for_later','reject','select','unread') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'unread',
  `resume` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `job_id` (`job_id`),
  KEY `username` (`user_id`),
  CONSTRAINT `applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `job_applications_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assigned_awards`
--

DROP TABLE IF EXISTS `assigned_awards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assigned_awards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `award_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`award_id`),
  KEY `award_id` (`award_id`),
  CONSTRAINT `assigned_awards_award_id_foreign` FOREIGN KEY (`award_id`) REFERENCES `awards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `assigned_awards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assigned_awards`
--

LOCK TABLES `assigned_awards` WRITE;
/*!40000 ALTER TABLE `assigned_awards` DISABLE KEYS */;
/*!40000 ALTER TABLE `assigned_awards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assigned_tasks`
--

DROP TABLE IF EXISTS `assigned_tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assigned_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`task_id`),
  KEY `task_id` (`task_id`),
  CONSTRAINT `assigned_tasks_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `assigned_tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assigned_tasks`
--

LOCK TABLES `assigned_tasks` WRITE;
/*!40000 ALTER TABLE `assigned_tasks` DISABLE KEYS */;
/*!40000 ALTER TABLE `assigned_tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attachment_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `attachment_description` text COLLATE utf8_unicode_ci NOT NULL,
  `task_id` int(11) NOT NULL,
  `attachment_username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `attachment_username` (`attachment_username`),
  KEY `task_id` (`task_id`),
  CONSTRAINT `attachments_attachment_username_foreign` FOREIGN KEY (`attachment_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `attachments_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachments`
--

LOCK TABLES `attachments` WRITE;
/*!40000 ALTER TABLE `attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `award_types`
--

DROP TABLE IF EXISTS `award_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `award_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `award_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `award_types`
--

LOCK TABLES `award_types` WRITE;
/*!40000 ALTER TABLE `award_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `award_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awards`
--

DROP TABLE IF EXISTS `awards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `awards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `award_type_id` int(11) NOT NULL,
  `gift` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cash` int(10) DEFAULT NULL,
  `month` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `year` year(4) NOT NULL,
  `award_description` text COLLATE utf8_unicode_ci NOT NULL,
  `award_date` date NOT NULL,
  `created_at` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `award_type_id` (`award_type_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `award_types_award_type_id_foreign` FOREIGN KEY (`award_type_id`) REFERENCES `award_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `awards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awards`
--

LOCK TABLES `awards` WRITE;
/*!40000 ALTER TABLE `awards` DISABLE KEYS */;
/*!40000 ALTER TABLE `awards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bank_accounts`
--

DROP TABLE IF EXISTS `bank_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `bank_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `account_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `account_number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ifsc_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bank_branch` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `bank_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank_accounts`
--

LOCK TABLES `bank_accounts` WRITE;
/*!40000 ALTER TABLE `bank_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bank_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `client_description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'Administration','<p><br></p>','2016-06-17 15:09:42','2016-06-17 18:39:42');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clock`
--

DROP TABLE IF EXISTS `clock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `clock_in` datetime NOT NULL,
  `clock_out` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `clock_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clock`
--

LOCK TABLES `clock` WRITE;
/*!40000 ALTER TABLE `clock` DISABLE KEYS */;
/*!40000 ALTER TABLE `clock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `comment_username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `task_id` (`task_id`),
  KEY `comment_username` (`comment_username`),
  CONSTRAINT `comment_comment_username_foreign` FOREIGN KEY (`comment_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comment_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_field_values`
--

DROP TABLE IF EXISTS `custom_field_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `custom_field_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` int(11) DEFAULT NULL,
  `field_id` int(11) NOT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `field_id` (`field_id`),
  CONSTRAINT `custom_field_values_field_id_foreign` FOREIGN KEY (`field_id`) REFERENCES `custom_fields` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_field_values`
--

LOCK TABLES `custom_field_values` WRITE;
/*!40000 ALTER TABLE `custom_field_values` DISABLE KEYS */;
/*!40000 ALTER TABLE `custom_field_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_fields`
--

DROP TABLE IF EXISTS `custom_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `custom_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `field_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `field_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `field_type` enum('text','number','email','url','textarea','select','radio','checkbox') COLLATE utf8_unicode_ci NOT NULL,
  `field_values` text COLLATE utf8_unicode_ci,
  `field_required` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_fields`
--

LOCK TABLES `custom_fields` WRITE;
/*!40000 ALTER TABLE `custom_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `custom_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document_types`
--

DROP TABLE IF EXISTS `document_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `document_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_type_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document_types`
--

LOCK TABLES `document_types` WRITE;
/*!40000 ALTER TABLE `document_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `document_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `document_type_id` int(11) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `document_title` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `document_description` text COLLATE utf8_unicode_ci NOT NULL,
  `document` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `document_type_id` (`document_type_id`),
  CONSTRAINT `documents_document_type_id_foreign` FOREIGN KEY (`document_type_id`) REFERENCES `document_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense_heads`
--

DROP TABLE IF EXISTS `expense_heads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expense_heads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_head` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_heads`
--

LOCK TABLES `expense_heads` WRITE;
/*!40000 ALTER TABLE `expense_heads` DISABLE KEYS */;
/*!40000 ALTER TABLE `expense_heads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_head_id` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `amount` int(11) NOT NULL,
  `expense_date` date NOT NULL,
  `remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `expense_head_id` (`expense_head_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `expenses_expense_head_id_foreign` FOREIGN KEY (`expense_head_id`) REFERENCES `expense_heads` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `expenses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `holidays`
--

DROP TABLE IF EXISTS `holidays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `holidays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `holiday_description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `holidays`
--

LOCK TABLES `holidays` WRITE;
/*!40000 ALTER TABLE `holidays` DISABLE KEYS */;
/*!40000 ALTER TABLE `holidays` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `designation_id` int(11) NOT NULL,
  `numbers` int(11) NOT NULL,
  `job_description` text COLLATE utf8_unicode_ci,
  `status` enum('open','closed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'open',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `designation_id` (`designation_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `jobs_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `jobs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_types`
--

DROP TABLE IF EXISTS `leave_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leave_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_types`
--

LOCK TABLES `leave_types` WRITE;
/*!40000 ALTER TABLE `leave_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `leave_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leaves`
--

DROP TABLE IF EXISTS `leaves`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leaves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `leave_description` text COLLATE utf8_unicode_ci NOT NULL,
  `leave_status` enum('pending','approved','rejected') COLLATE utf8_unicode_ci NOT NULL,
  `leave_comment` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`leave_type_id`),
  KEY `leaves_leave_type_id_foreign` (`leave_type_id`),
  CONSTRAINT `leaves_leave_type_id_foreign` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `leaves_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leaves`
--

LOCK TABLES `leaves` WRITE;
/*!40000 ALTER TABLE `leaves` DISABLE KEYS */;
/*!40000 ALTER TABLE `leaves` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `top_location_id` int(11) DEFAULT NULL,
  `location` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `job_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `store` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip` int(11) NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `manager` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `manager_mobile_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `regional_manager` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `regional_manager_mobile_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ground_signs` float NOT NULL,
  `car_signs` float NOT NULL,
  `walker_signs` float NOT NULL,
  `verbiage_decals` float NOT NULL,
  `address_decals` float NOT NULL,
  `ground_signs_quantity` float NOT NULL,
  `car_rental_enterprise` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `holiday_date_none` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `daily_walker_monday` float NOT NULL,
  `daily_walker_tuesday` float NOT NULL,
  `daily_walker_wednesday` float NOT NULL,
  `daily_walker_thursday` float NOT NULL,
  `daily_walker_friday` float NOT NULL,
  `daily_walker_saturday` float NOT NULL,
  `daily_walker_sunday` float NOT NULL,
  `daily_driver_monday` float NOT NULL,
  `daily_driver_tuesday` float NOT NULL,
  `daily_driver_wednesday` float NOT NULL,
  `daily_driver_thursday` float NOT NULL,
  `daily_driver_friday` float NOT NULL,
  `daily_driver_saturday` float NOT NULL,
  `daily_driver_sunday` float NOT NULL,
  `daily_checkin_monday` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `daily_checkin_tuesday` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `daily_checkin_wednesday` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `daily_checkin_thursday` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `daily_checkin_friday` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `daily_checkin_saturday` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `daily_checkin_sunday` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `remaining_ground_signs` float NOT NULL,
  `remaining_car_signs` float NOT NULL,
  `remaining_walker_signs` float NOT NULL,
  `forms_required_monday` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `forms_required_tuesday` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `forms_required_wednesday` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `forms_required_thursday` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `forms_required_friday` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `forms_required_saturday` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `forms_required_sunday` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `agency_name_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `agency_address1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `agency_address2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `agency_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `agency_state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `agency_zip` int(11) NOT NULL,
  `agency_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `agency_dm_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `agency_branch_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `agency_range_target` int(11) NOT NULL,
  `agency_order_confirms` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `walker_start_day` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `walker_start_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `walker_end_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `drivers_start_day` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `drivers_start_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `drivers_end_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `print_sign_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `print_color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `print_layout_approval` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `printer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `print_quantity` float NOT NULL,
  `print_rate_per` float NOT NULL,
  `print_total` float NOT NULL,
  `verbiage_top_line` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `verbiage_star_burst` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `verbiage_store_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `verbiage_bottom_line` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `verbiage_additional_lines` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `verbiage_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `package_ground` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `package_express` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emailing_eventNotify` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emailing_invoice` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_order_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `signwalker_mon_qty` float NOT NULL,
  `signwalker_tue_qty` float NOT NULL,
  `signwalker_wed_qty` float NOT NULL,
  `signwalker_thu_qty` float NOT NULL,
  `signwalker_fri_qty` float NOT NULL,
  `signwalker_sat_qty` float NOT NULL,
  `signwalker_sun_qty` float NOT NULL,
  `signwalker_total_walkers` float NOT NULL,
  `signwalker_mon_hours` float NOT NULL,
  `signwalker_tue_hours` float NOT NULL,
  `signwalker_wed_hours` float NOT NULL,
  `signwalker_thu_hours` float NOT NULL,
  `signwalker_fri_hours` float NOT NULL,
  `signwalker_sat_hours` float NOT NULL,
  `signwalker_sun_hours` float NOT NULL,
  `signwalker_total_hours` float NOT NULL,
  `signwalker_hourly_rate` float NOT NULL,
  `signwalker_total_amount` float NOT NULL,
  `signdriver_mon_qty` float NOT NULL,
  `signdriver_tue_qty` float NOT NULL,
  `signdriver_wed_qty` float NOT NULL,
  `signdriver_thu_qty` float NOT NULL,
  `signdriver_fri_qty` float NOT NULL,
  `signdriver_sat_qty` float NOT NULL,
  `signdriver_sun_qty` float NOT NULL,
  `signdriver_total_walkers` float NOT NULL,
  `signdriver_mon_hours` float NOT NULL,
  `signdriver_tue_hours` float NOT NULL,
  `signdriver_wed_hours` float NOT NULL,
  `signdriver_thu_hours` float NOT NULL,
  `signdriver_fri_hours` float NOT NULL,
  `signdriver_sat_hours` float NOT NULL,
  `signdriver_sun_hours` float NOT NULL,
  `signdriver_total_hours` float NOT NULL,
  `signdriver_hourly_rate` float NOT NULL,
  `signdriver_total_amount` float NOT NULL,
  `services_sign_rate` float NOT NULL,
  `services_walker_rate` float NOT NULL,
  `services_driver_rate` float NOT NULL,
  `services_other` float NOT NULL,
  `services_prepaid` float NOT NULL,
  `services_deduction` float NOT NULL,
  `services_balance_due` float NOT NULL,
  `consultantfees_install_rate` float NOT NULL,
  `consultantfees_walker_rate` float NOT NULL,
  `consultantfees_driver_rate` float NOT NULL,
  `consultantfees_other` float NOT NULL,
  `consultantfees_prepaid` float NOT NULL,
  `consultantfees_deduction` float NOT NULL,
  `consultantfees_balance_due` float NOT NULL,
  `advances_walker_advance` float NOT NULL,
  `advances_driver_advance` float NOT NULL,
  `advances_other` float NOT NULL,
  `advances_prepaid` float NOT NULL,
  `advances_deduction` float NOT NULL,
  `advances_balance_due` float NOT NULL,
  `shipping_consultant_checks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_promotional_materials` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sales_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sales_amount` float NOT NULL,
  `area_manager_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `area_manager_amount` float NOT NULL,
  `district_manager_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `district_manager_amount` float NOT NULL,
  `capital_deduction_amount` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `department_id` (`client_id`),
  KEY `top_designation_id` (`top_location_id`),
  CONSTRAINT `designations_department_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `designations_top_designation_id_foreign` FOREIGN KEY (`top_location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES (1,1,NULL,'Admin','1','','','','','',0,'','','','','','',0,0,0,0,0,0,'','',0,0,0,0,0,0,0,0,0,0,0,0,0,0,'','','','','','','',0,0,0,'','','','','','','','','','','','',0,'','','',0,'','','','','','','','','','','',0,0,0,'','','','','','','','','','','','',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'','','',0,'',0,'',0,0,'2016-06-22 14:53:23','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user_id` int(10) unsigned NOT NULL,
  `to_user_id` int(10) unsigned NOT NULL,
  `subject` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `read` int(11) NOT NULL,
  `delete_sender` int(11) NOT NULL DEFAULT '0',
  `delete_receiver` int(11) NOT NULL DEFAULT '0',
  `attachment` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `from_user_id` (`from_user_id`,`to_user_id`),
  KEY `to_user_id` (`to_user_id`),
  CONSTRAINT `messages_from_user_id_foreign` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `messages_to_user_id_foreign` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `note_content` text COLLATE utf8_unicode_ci NOT NULL,
  `note_username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `unique_id` (`task_id`),
  KEY `username` (`note_username`),
  CONSTRAINT `notes_note_username_foreign` FOREIGN KEY (`note_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `notes_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notice`
--

DROP TABLE IF EXISTS `notice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  CONSTRAINT `notice_username_foreign` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notice`
--

LOCK TABLES `notice` WRITE;
/*!40000 ALTER TABLE `notice` DISABLE KEYS */;
/*!40000 ALTER TABLE `notice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notice_location`
--

DROP TABLE IF EXISTS `notice_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notice_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notice_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `notice_id` (`notice_id`),
  KEY `designation_id` (`location_id`),
  CONSTRAINT `notice_designation_designation_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `notice_designation_notice_id_foreign` FOREIGN KEY (`notice_id`) REFERENCES `notice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notice_location`
--

LOCK TABLES `notice_location` WRITE;
/*!40000 ALTER TABLE `notice_location` DISABLE KEYS */;
/*!40000 ALTER TABLE `notice_location` ENABLE KEYS */;
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
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
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
-- Table structure for table `payroll`
--

DROP TABLE IF EXISTS `payroll`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payroll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_slip_id` int(11) NOT NULL,
  `salary_type_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`salary_type_id`),
  KEY `salary_type_id` (`salary_type_id`),
  KEY `payroll_slip_id` (`payroll_slip_id`),
  CONSTRAINT `payroll_payroll_slip_id_foreign` FOREIGN KEY (`payroll_slip_id`) REFERENCES `payroll_slip` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `payroll_salary_type_id_foreign` FOREIGN KEY (`salary_type_id`) REFERENCES `salary_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payroll`
--

LOCK TABLES `payroll` WRITE;
/*!40000 ALTER TABLE `payroll` DISABLE KEYS */;
/*!40000 ALTER TABLE `payroll` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payroll_slip`
--

DROP TABLE IF EXISTS `payroll_slip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payroll_slip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `month` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_contribution` date DEFAULT NULL,
  `employee_contribution` decimal(10,2) NOT NULL DEFAULT '0.00',
  `employer_contribution` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `payroll_slip_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payroll_slip`
--

LOCK TABLES `payroll_slip` WRITE;
/*!40000 ALTER TABLE `payroll_slip` DISABLE KEYS */;
/*!40000 ALTER TABLE `payroll_slip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,59,1),(2,1,1),(3,2,1),(4,3,1),(5,4,1),(6,70,1),(7,28,1),(8,29,1),(9,30,1),(10,31,1),(11,5,1),(12,6,1),(13,7,1),(14,8,1),(15,56,1),(16,66,1),(17,67,1),(18,68,1),(19,69,1),(20,84,1),(21,85,1),(22,57,1),(23,71,1),(24,58,1),(25,44,1),(26,45,1),(27,46,1),(28,47,1),(29,48,1),(30,49,1),(31,75,1),(32,83,1);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'client','manage_client','Manage Client','2015-08-27 22:08:03','2015-08-27 22:08:03'),(2,'client','create_client','Create Client','2015-08-27 22:08:51','2015-08-27 22:08:51'),(3,'client','edit_client','Edit Client','2015-08-27 22:08:57','2015-08-27 22:08:57'),(4,'client','delete_client','Delete Client','2015-08-28 07:26:54','2015-08-28 07:26:54'),(5,'location','manage_location','Manage Location','2015-08-28 07:19:51',NULL),(6,'location','create_location','Create Location','2015-08-28 07:19:51',NULL),(7,'location','edit_location','Edit Location','2015-08-28 07:21:20',NULL),(8,'location','delete_location','Delete Location','2015-08-28 07:21:20',NULL),(9,'employee','manage_employee','Manage Employee','2015-08-28 08:08:41',NULL),(10,'employee','create_employee','Create Employee','2015-08-28 08:08:41',NULL),(11,'employee','edit_employee','Edit Employee','2015-08-28 08:09:00',NULL),(12,'employee','delete_employee','Delete Employee','2015-08-28 08:09:00',NULL),(13,'employee','profile_update_employee','Profile Update Employee','2015-08-28 08:11:16',NULL),(14,'employee','view_employee','View Employee','2015-08-28 08:11:16',NULL),(15,'job','manage_job','Manage Job','2015-08-28 08:12:18',NULL),(16,'job','create_job','Create Job','2015-08-28 08:12:18',NULL),(17,'job','edit_job','Edit Job','2015-08-28 08:12:36',NULL),(18,'job','delete_job','Delete Job','2015-08-28 08:12:36',NULL),(19,'job','view_job','View Job','2015-08-28 08:16:14',NULL),(20,'job','view_job_application','View Job Application','2015-08-28 08:16:14',NULL),(21,'job','edit_job_application','Edit Job Application','2015-08-28 08:16:41',NULL),(22,'job','apply_job','Apply Job','2015-08-28 08:16:41',NULL),(23,'job','delete_job_application','Delete Job Application','2015-08-28 08:17:21',NULL),(24,'expense','manage_expense','Manage Expense','2015-08-28 08:26:49',NULL),(25,'expense','create_expense','Create Expense','2015-08-28 08:26:49',NULL),(26,'expense','edit_expense','Edit Expense','2015-08-28 08:27:05',NULL),(27,'expense','delete_expense','Delete Expense','2015-08-28 08:27:05',NULL),(28,'holiday','manage_holiday','Manage Holiday','2015-08-28 08:42:59',NULL),(29,'holiday','create_holiday','Create Holiday','2015-08-28 08:42:59',NULL),(30,'holiday','edit_holiday','Edit Holiday','2015-08-28 08:43:15',NULL),(31,'holiday','delete_holiday','Delete Holiday','2015-08-28 08:43:15',NULL),(32,'attendance','update_attendance','Update Attendance','2015-08-28 09:10:18',NULL),(33,'attendance','daily_attendance','Daily Attendance','2015-08-28 09:10:18',NULL),(34,'attendance','upload_attendance','Upload Attendance','2015-08-28 09:14:07',NULL),(35,'leave','manage_leave','Manage leave','2015-08-28 09:21:12',NULL),(36,'leave','view_leave','View Leave','2015-08-28 09:21:12',NULL),(37,'leave','create_leave','Create Leave','2015-08-28 09:21:45',NULL),(38,'leave','edit_leave','Edit Leave','2015-08-28 09:21:45',NULL),(39,'leave','edit_leave_status','Edit Leave Status','2015-08-28 09:22:08',NULL),(40,'leave','delete_leave','Delete Leave','2015-08-28 09:22:08',NULL),(41,'payroll','manage_payroll','Manage Payroll','2015-08-28 09:24:03',NULL),(42,'payroll','create_payroll','Create Payroll','2015-08-28 09:24:03',NULL),(43,'payroll','generate_payroll','Generate Payroll','2015-08-28 09:24:13',NULL),(44,'ticket','manage_ticket','Manage Ticket','2015-08-28 09:26:18',NULL),(45,'ticket','view_ticket','View Ticket','2015-08-28 09:26:18',NULL),(46,'ticket','update_status_ticket','Update Status Ticket','2015-08-28 09:26:39',NULL),(47,'ticket','create_ticket','Create Ticket','2015-08-28 09:26:39',NULL),(48,'ticket','edit_ticket','Edit Ticket','2015-08-28 09:26:57',NULL),(49,'ticket','delete_ticket','Delete Ticket','2015-08-28 09:26:57',NULL),(50,'task','manage_task','Manage Task','2015-08-28 09:29:27',NULL),(51,'task','update_progress_task','Update Progress Task','2015-08-28 09:29:27',NULL),(52,'task','view_task','View Task','2015-08-28 09:29:45',NULL),(53,'task','create_task','Create Task','2015-08-28 09:29:45',NULL),(54,'task','edit_task','Edit Task','2015-08-28 09:29:59',NULL),(55,'task','delete_task','Delete Task','2015-08-28 09:29:59',NULL),(56,'message','manage_message','Manage Message','2015-08-28 09:30:41',NULL),(57,'sms','manage_sms','Manage SMS','2015-08-28 09:33:18',NULL),(58,'template','manage_template','Manage Template','2015-08-28 09:33:18',NULL),(59,'','send_template','Send Template','2015-08-28 09:35:05',NULL),(60,'language','manage_language','Manage Language','2015-08-28 09:36:52',NULL),(61,'language','set_language','Set Language','2015-08-28 09:36:52',NULL),(62,'award','manage_award','Manage Award','2015-09-12 15:31:06',NULL),(63,'award','create_award','Create Award','2015-09-12 15:31:06',NULL),(64,'award','edit_award','Edit Award','2015-09-12 15:31:27',NULL),(65,'award','delete_award','Delete Award','2015-09-12 15:31:27',NULL),(66,'notice','manage_notice','Manage Notice','2015-09-12 17:41:49',NULL),(67,'notice','create_notice','Create Notice','2015-09-12 17:41:49',NULL),(68,'notice','edit_notice','Edit Notice','2015-09-12 17:42:06',NULL),(69,'notice','delete_notice','Delete Notice','2015-09-12 17:42:06',NULL),(70,'custom_field','manage_custom_field','Manage Custom Field','2015-09-26 04:09:04',NULL),(71,'sms_template','manage_sms_template','Manage SMS Template','2015-09-29 07:02:54',NULL),(72,'attendance','manage_everyone_attendance','Manage Everyone\'s Attendance','2015-10-11 12:14:18',NULL),(73,'leave','manage_everyone_leave','Manage Everyone\'s Leave','2015-10-11 12:16:35',NULL),(74,'payroll','manage_everyone_payroll','Manage Everyone\'s Payroll','2015-10-11 12:24:20',NULL),(75,'ticket','manage_everyone_ticket','Manage Everyone\'s Ticket','2015-10-11 12:29:12',NULL),(76,'task','manage_everyone_task','Manage Everyone\'s Task','2015-10-11 12:36:10',NULL),(77,'employee','reset_employee_password','Reset Employee Password','2015-10-11 14:03:23',NULL),(78,'employee','manage_all_employee','Manage All Employee','2015-10-25 07:04:51',NULL),(79,'employee','manage_subordinate','Manage Subordinate','2015-10-25 07:04:51',NULL),(80,'attendance','manage_subordinate_attendance','Manage Subordinate Attendance','2015-10-25 08:55:16',NULL),(81,'payroll','manage_subordinate_payroll','Manage Subordinate Payroll','2015-10-25 09:40:39',NULL),(82,'leave','manage_subordinate_leave','Manage Subordinate Leave','2015-10-25 10:55:55',NULL),(83,'ticket','manage_subordinate_ticket','Manage Subordinate Ticket','2015-10-25 11:51:19',NULL),(84,'notice','manage_subordinate_notice','Manage Notice to Subordinate','2015-10-25 12:19:08',NULL),(85,'notice','manage_all_notice','Manage All Notice','2015-10-25 12:22:41',NULL),(86,'task','manage_subordinate_task','Manage Subordinate Task','2015-10-25 12:54:58',NULL),(87,'job','manage_subordinate_job','Manage Subordinate Job','2015-11-18 17:15:59',NULL),(88,'job','manage_all_job','Manage All Job','2015-11-25 06:07:55',NULL),(89,'award','manage_all_award','Manage All Award','2015-11-25 08:16:58',NULL),(90,'award','manage_subordinate_award','Manage Subordinate Award','2015-11-25 08:16:58',NULL);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `employee_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `father_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mother_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_joining` date DEFAULT NULL,
  `date_of_leaving` date DEFAULT NULL,
  `date_of_retirement` date DEFAULT NULL,
  `contact_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `alternate_contact_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `alternate_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `present_address` text COLLATE utf8_unicode_ci NOT NULL,
  `permanent_address` text COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_link` text COLLATE utf8_unicode_ci NOT NULL,
  `twitter_link` text COLLATE utf8_unicode_ci NOT NULL,
  `blogger_link` text COLLATE utf8_unicode_ci NOT NULL,
  `linkedin_link` text COLLATE utf8_unicode_ci NOT NULL,
  `googleplus_link` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `profile_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (1,1,'',NULL,'','',NULL,NULL,NULL,'','','','','',NULL,'','','','','','2016-06-17 14:13:33','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `assigned_roles_user_id_foreign` (`user_id`),
  KEY `assigned_roles_role_id_foreign` (`role_id`),
  CONSTRAINT `assigned_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `assigned_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1,1);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Admin','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salary`
--

DROP TABLE IF EXISTS `salary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `salary_type_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `salary_type_id` (`salary_type_id`),
  CONSTRAINT `salary_salary_type_id_foreign` FOREIGN KEY (`salary_type_id`) REFERENCES `salary_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `salary_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salary`
--

LOCK TABLES `salary` WRITE;
/*!40000 ALTER TABLE `salary` DISABLE KEYS */;
/*!40000 ALTER TABLE `salary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salary_types`
--

DROP TABLE IF EXISTS `salary_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salary_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salary_head` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `salary_type` enum('earning','deduction') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `salary_head` (`salary_head`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salary_types`
--

LOCK TABLES `salary_types` WRITE;
/*!40000 ALTER TABLE `salary_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `salary_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_title` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `task_description` text COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `due_date` date NOT NULL,
  `hours` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `task_progress` int(11) NOT NULL,
  `task_username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `task_username` (`task_username`),
  CONSTRAINT `tasks_task_username_foreign` FOREIGN KEY (`task_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_attachments`
--

DROP TABLE IF EXISTS `ticket_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attachment_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `attachment_description` text COLLATE utf8_unicode_ci NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `attachment_username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `attachment_username` (`attachment_username`),
  KEY `ticket_id` (`ticket_id`),
  CONSTRAINT `ticket_attachments_attachment_username_foreign` FOREIGN KEY (`attachment_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticket_attachments_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_attachments`
--

LOCK TABLES `ticket_attachments` WRITE;
/*!40000 ALTER TABLE `ticket_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_comments`
--

DROP TABLE IF EXISTS `ticket_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `comment_username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `comment_username` (`comment_username`),
  CONSTRAINT `ticket_comments_comment_username_foreign` FOREIGN KEY (`comment_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticket_comments_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_comments`
--

LOCK TABLES `ticket_comments` WRITE;
/*!40000 ALTER TABLE `ticket_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_notes`
--

DROP TABLE IF EXISTS `ticket_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `note_content` text COLLATE utf8_unicode_ci NOT NULL,
  `note_username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `username` (`note_username`),
  CONSTRAINT `ticket_notes_note_username_foreign` FOREIGN KEY (`note_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticket_notes_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_notes`
--

LOCK TABLES `ticket_notes` WRITE;
/*!40000 ALTER TABLE `ticket_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `ticket_subject` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `ticket_description` text COLLATE utf8_unicode_ci,
  `ticket_priority` enum('low','medium','high','critical') COLLATE utf8_unicode_ci NOT NULL,
  `ticket_status` enum('open','closed') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `todos`
--

DROP TABLE IF EXISTS `todos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `todos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `visibility` enum('public','private') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'private',
  `todo_title` text COLLATE utf8_unicode_ci NOT NULL,
  `todo_description` text COLLATE utf8_unicode_ci,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `todos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `todos`
--

LOCK TABLES `todos` WRITE;
/*!40000 ALTER TABLE `todos` DISABLE KEYS */;
/*!40000 ALTER TABLE `todos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `location_id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_login` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login_now` timestamp NULL DEFAULT NULL,
  `last_login_ip_now` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `username` (`username`),
  KEY `designation_id` (`location_id`),
  CONSTRAINT `users_designation_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'','',1,'admin','admin@admin.com','111-111-111','$2y$08$NeqbsAexc0HZy.VE0p0NduyMaGGpcDl7G8PNAOskF9EKtgbuXAWUi','wTmh0KTzOzhsv7sh59djSsCeaSQDHYxGh4uGMjhTFkiYtlHCx3TBqeCIblkp','0000-00-00 00:00:00','2016-07-03 09:11:32','2016-07-03 06:15:37','127.0.0.1','2016-07-03 09:11:32','192.168.2.233');
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

-- Dump completed on 2016-07-03 16:08:44
