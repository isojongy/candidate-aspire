# ************************************************************
# Sequel Pro SQL dump
# Version 5446
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.30)
# Database: apsire_db
# Generation Time: 2021-07-26 02:49:46 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table failed_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table payments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ref_no` varchar(12) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `content` varchar(500) DEFAULT NULL,
  `amount` double(11,0) DEFAULT NULL,
  `paid_amount` double(11,0) DEFAULT NULL,
  `remain_amount` double(11,0) DEFAULT NULL,
  `total_amount` double(11,0) DEFAULT NULL,
  `penalty_fee` double(11,0) DEFAULT NULL COMMENT 'base on penalty_amount',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;

INSERT INTO `payments` (`id`, `ref_no`, `user_id`, `loan_id`, `content`, `amount`, `paid_amount`, `remain_amount`, `total_amount`, `penalty_fee`, `deleted_at`, `created_at`, `updated_at`)
VALUES
	(1,'D51E8F73BA54',1,18,'trả 300k',300000000,300000000,780088767,1080000000,88767,NULL,'2021-07-25 16:32:42','2021-07-25 16:32:42'),
	(2,'04DD6E113C52',1,18,'trả 300k',300000000,600000000,480177534,1080000000,88767,NULL,'2021-07-25 16:33:13','2021-07-25 16:33:13'),
	(3,'BC38CD95EF00',1,18,'trả 300k',300000000,900000000,180266301,1080000000,88767,NULL,'2021-07-25 16:33:42','2021-07-25 16:33:42'),
	(4,'762143D214F6',1,18,'trả 300k',300000000,1200000000,0,1080000000,88767,NULL,'2021-07-25 16:33:43','2021-07-25 16:33:43');

/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table loan_plans
# ------------------------------------------------------------

DROP TABLE IF EXISTS `loan_plans`;

CREATE TABLE `loan_plans` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(199) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `type` enum('month','year','mix') DEFAULT 'month',
  `duration` int(11) DEFAULT NULL COMMENT 'days',
  `interest_rate` int(2) DEFAULT NULL COMMENT '[0,100] month',
  `penalty_rate` int(2) DEFAULT NULL COMMENT '[0,100] month',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `loan_plans` WRITE;
/*!40000 ALTER TABLE `loan_plans` DISABLE KEYS */;

INSERT INTO `loan_plans` (`id`, `name`, `description`, `type`, `duration`, `interest_rate`, `penalty_rate`, `deleted_at`, `created_at`, `updated_at`)
VALUES
	(1,'small','6 months','month',30,5,2,NULL,NULL,NULL),
	(2,'medium','2 years and 3 months','mix',760,6,2,NULL,NULL,NULL),
	(3,'large','over 3 years','year',1095,8,3,NULL,NULL,NULL);

/*!40000 ALTER TABLE `loan_plans` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table loans
# ------------------------------------------------------------

DROP TABLE IF EXISTS `loans`;

CREATE TABLE `loans` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `loan_plan_id` int(3) DEFAULT NULL COMMENT '[0, 100] months',
  `interest_rate` int(2) DEFAULT NULL,
  `penalty_rate` int(2) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `arrangement_fee` double(11,0) DEFAULT NULL,
  `paid_amount` double(11,0) DEFAULT NULL,
  `remain_amount` double(11,0) DEFAULT NULL,
  `total_amount` double(11,0) DEFAULT NULL,
  `daily_amount` double(11,0) DEFAULT NULL,
  `penalty_amount` double(11,0) DEFAULT NULL,
  `origin_amount` double(11,0) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `loans` WRITE;
/*!40000 ALTER TABLE `loans` DISABLE KEYS */;

INSERT INTO `loans` (`id`, `user_id`, `loan_plan_id`, `interest_rate`, `penalty_rate`, `start_date`, `end_date`, `arrangement_fee`, `paid_amount`, `remain_amount`, `total_amount`, `daily_amount`, `penalty_amount`, `origin_amount`, `deleted_at`, `created_at`, `updated_at`)
VALUES
	(18,1,3,8,3,'2021-08-01 00:00:00','2022-08-01 00:00:00',100000,1200000000,0,1080000000,2958904,88767,1000000000,NULL,'2021-07-25 16:10:01','2021-07-25 16:33:43'),
	(19,1,3,8,3,'2021-08-01 00:00:00','2022-08-01 00:00:00',100000,NULL,1080000000,1080000000,2958904,88767,1000000000,NULL,'2021-07-25 16:38:44','2021-07-25 16:38:44'),
	(20,1,3,8,3,'2021-08-01 00:00:00','2022-08-01 00:00:00',100000,NULL,1080000000,1080000000,2958904,88767,1000000000,NULL,'2021-07-25 16:39:05','2021-07-25 16:39:05'),
	(21,1,3,8,3,'2021-08-01 00:00:00','2022-08-01 00:00:00',100000,NULL,1080000000,1080000000,2958904,88767,1000000000,NULL,'2021-07-25 16:40:48','2021-07-25 16:40:48'),
	(22,1,3,8,3,'2021-08-01 00:00:00','2022-08-01 00:00:00',100000,NULL,1080000000,1080000000,2958904,88767,1000000000,NULL,'2021-07-25 16:40:50','2021-07-25 16:40:50'),
	(23,1,3,8,3,'2021-08-01 00:00:00','2022-08-01 00:00:00',100000,NULL,1080000000,1080000000,2958904,88767,1000000000,NULL,'2021-07-25 16:40:51','2021-07-25 16:40:51'),
	(24,1,3,8,3,'2021-08-01 00:00:00','2022-08-01 00:00:00',100000,NULL,1080000000,1080000000,2958904,88767,1000000000,NULL,'2021-07-25 16:40:56','2021-07-25 16:40:56'),
	(25,1,3,8,3,'2021-08-01 00:00:00','2022-08-01 00:00:00',100000,NULL,1080000000,1080000000,2958904,88767,1000000000,NULL,'2021-07-25 16:41:00','2021-07-25 16:41:00');

/*!40000 ALTER TABLE `loans` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_000000_create_users_table',1),
	(2,'2014_10_12_100000_create_password_resets_table',1),
	(3,'2019_08_19_000000_create_failed_jobs_table',1),
	(4,'2021_06_04_024303_create_permission_tables',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `type`)
VALUES
	(1,'Dev 1','dev1@gmail.com',NULL,'$2y$10$kagWcNSPmcmPmcEbCIlTse1Cj2eurdZleBF2G4nwA3PP.dUPLIEBO',NULL,NULL,NULL,NULL),
	(2,'Dev test','devtest@gmail.com',NULL,'$2y$10$nKALSaUs2UhOQm7.8OINZu.hTgyr8mumFRAM2RD5HoM.OANltmVJy',NULL,'2021-07-24 06:54:19','2021-07-24 06:54:19',NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
