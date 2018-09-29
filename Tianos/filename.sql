-- MySQL dump 10.13  Distrib 5.7.23, for Linux (x86_64)
--
-- Host: localhost    Database: tianos_beauty
-- ------------------------------------------------------
-- Server version	5.7.23-0ubuntu0.16.04.1

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
-- Table structure for table `calendar`
--

DROP TABLE IF EXISTS `calendar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `user_create` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendar`
--

LOCK TABLES `calendar` WRITE;
/*!40000 ALTER TABLE `calendar` DISABLE KEYS */;
/*!40000 ALTER TABLE `calendar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `user_create` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`),
  KEY `fk_category_category1_idx` (`category_id`),
  CONSTRAINT `FK_64C19C112469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,NULL,'cat-111','Categoria 111','categoria-111','2018-09-29 05:12:20',NULL,NULL,NULL,1),(2,NULL,'cat-222','Categoria 222','categoria-222','2018-09-29 05:12:20',NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `friend_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_friends_user1_idx` (`user_id`),
  KEY `fk_friends_user2_idx` (`friend_id`),
  CONSTRAINT `FK_21EE70696A5458E8` FOREIGN KEY (`friend_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_21EE7069A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friends`
--

LOCK TABLES `friends` WRITE;
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;
/*!40000 ALTER TABLE `friends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `google_drive_file`
--

DROP TABLE IF EXISTS `google_drive_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `google_drive_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `unique_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `file_id` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `file_mime_type` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_mime_type_short` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_icon_link` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_name` text COLLATE utf8_unicode_ci NOT NULL,
  `file_name_original` text COLLATE utf8_unicode_ci,
  `file_size` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `has_thumbnail` tinyint(1) NOT NULL DEFAULT '0',
  `count_share` int(11) DEFAULT NULL,
  `count_view` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_google_drive_file_user_idx` (`user_id`),
  CONSTRAINT `FK_148FFCAAA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `google_drive_file`
--

LOCK TABLES `google_drive_file` WRITE;
/*!40000 ALTER TABLE `google_drive_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `google_drive_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `google_drive_file_count`
--

DROP TABLE IF EXISTS `google_drive_file_count`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `google_drive_file_count` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_id` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `count_share` int(11) DEFAULT NULL,
  `count_view` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `google_drive_file_count`
--

LOCK TABLES `google_drive_file_count` WRITE;
/*!40000 ALTER TABLE `google_drive_file_count` DISABLE KEYS */;
/*!40000 ALTER TABLE `google_drive_file_count` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `google_drive_file_vote`
--

DROP TABLE IF EXISTS `google_drive_file_vote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `google_drive_file_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `google_drive_file_id` int(11) DEFAULT NULL,
  `vote` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_google_drive_file_like_google_drive_file1_idx` (`google_drive_file_id`),
  KEY `fk_google_drive_file_like_user1_idx` (`user_id`),
  CONSTRAINT `FK_35D550BF77A02D92` FOREIGN KEY (`google_drive_file_id`) REFERENCES `google_drive_file` (`id`),
  CONSTRAINT `FK_35D550BFA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `google_drive_file_vote`
--

LOCK TABLES `google_drive_file_vote` WRITE;
/*!40000 ALTER TABLE `google_drive_file_vote` DISABLE KEYS */;
/*!40000 ALTER TABLE `google_drive_file_vote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groupofusers`
--

DROP TABLE IF EXISTS `groupofusers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groupofusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `user_create` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groupofusers`
--

LOCK TABLES `groupofusers` WRITE;
/*!40000 ALTER TABLE `groupofusers` DISABLE KEYS */;
INSERT INTO `groupofusers` VALUES (1,'111','Grupo 1','grupo-1','2018-09-29 05:12:20',NULL,NULL,NULL,1),(2,'222','Grupo 2','grupo-2','2018-09-29 05:12:20',NULL,NULL,NULL,1),(3,'333','Grupo 3','grupo-3','2018-09-29 05:12:20',NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `groupofusers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `user_create` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module`
--

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
INSERT INTO `module` VALUES (1,'001','Agenda','agenda','2018-09-29 05:12:20',NULL,NULL,NULL,1),(2,'002','Inventario','inventario','2018-09-29 05:12:20',NULL,NULL,NULL,1),(3,'003','Gestión de usuarios','gestion-de-usuarios','2018-09-29 05:12:20',NULL,NULL,NULL,1),(4,'005','Informes','informes','2018-09-29 05:12:20',NULL,NULL,NULL,1),(5,'006','Seguridad','seguridad','2018-09-29 05:12:20',NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `point_of_sale`
--

DROP TABLE IF EXISTS `point_of_sale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `point_of_sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `point_of_sale_id` int(11) DEFAULT NULL,
  `code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` decimal(11,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `address` text COLLATE utf8_unicode_ci,
  `phone` tinytext COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `user_create` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`),
  KEY `fk_point_of_sale_point_of_sale1_idx` (`point_of_sale_id`),
  CONSTRAINT `FK_F7A7B1FA6B7E9A73` FOREIGN KEY (`point_of_sale_id`) REFERENCES `point_of_sale` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `point_of_sale`
--

LOCK TABLES `point_of_sale` WRITE;
/*!40000 ALTER TABLE `point_of_sale` DISABLE KEYS */;
INSERT INTO `point_of_sale` VALUES (1,NULL,'111','Salon Belleza Aeropuerto','salon-belleza-aeropuerto',-12.02407160,-77.11203260,NULL,'Av. Tomas Valle Mz.g 37 Lt.31 Aa.hh Bocanegra Callao','994826014','2018-09-29 05:12:20',NULL,NULL,NULL,1),(2,NULL,'222','Salon Belleza Barranco','salon-belleza-barranco',-12.14761230,-77.02137500,NULL,'Calle Union 208, Barranco','2484434','2018-09-29 05:12:20',NULL,NULL,NULL,1),(3,NULL,'333','Salon Belleza Chorrillos','salon-belleza-chorrillos',-12.09828210,-76.96201320,NULL,'Jr. Delfín Puccio Mz.a Lt.8 Urb.san Juan, Chorrillos','998461653','2018-09-29 05:12:20',NULL,NULL,NULL,1),(4,NULL,'444','Salon Belleza El Porvenir','salon-belleza-el-porvenir',-12.06254110,-77.01679050,NULL,'Jr. Garibaldi 367, La Victoria','5731246','2018-09-29 05:12:20',NULL,NULL,NULL,1),(5,NULL,'555','Salon Belleza La Molina','salon-belleza-la-molina',-12.06602910,-76.95910900,NULL,'Av. La Molina 740','999040550','2018-09-29 05:12:20',NULL,NULL,NULL,1),(6,NULL,'666','Salon Belleza Lurigancho','salon-belleza-lurigancho',-12.03015960,-77.01098910,NULL,'Av. Gran Chimu 1era Crda Zarate, Lurigancho (Porton Plomo)','999339483','2018-09-29 05:12:20',NULL,NULL,NULL,1),(7,NULL,'777','Salon Belleza Magdalena','salon-belleza-magdalena',-12.09239160,-77.07074950,NULL,'Jr. Sn. Martin Cdra. 833 Mz.e Lt.9 Los Tulipanes, Magdalena','2636376','2018-09-29 05:12:20',NULL,NULL,NULL,1),(8,NULL,'888','Salon Belleza Miraflores','salon-belleza-miraflores',-12.13583070,-77.01788320,NULL,'Av. Paseo De República 5260 Miraflores','975286372','2018-09-29 05:12:20',NULL,NULL,NULL,1),(9,NULL,'999','Salon Belleza Plaza Grau','salon-belleza-plaza-grau',-12.07062280,-77.00045530,NULL,'Pueblo Joven Cerro El Pino','','2018-09-29 05:12:20',NULL,'2018-09-29 16:29:43',NULL,1),(10,NULL,'1010','Salon Belleza Puente Piedra','salon-belleza-puente-piedra',-11.86125500,-77.07853080,NULL,'Av. Panam. norte 680 pasando byPass Puente Piedra','997013686','2018-09-29 05:12:20',NULL,'2018-09-29 16:29:29',NULL,1);
/*!40000 ALTER TABLE `point_of_sale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `point_of_sale_has_module`
--

DROP TABLE IF EXISTS `point_of_sale_has_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `point_of_sale_has_module` (
  `point_of_sale_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  PRIMARY KEY (`point_of_sale_id`,`module_id`),
  KEY `IDX_3C7EEC526B7E9A73` (`point_of_sale_id`),
  KEY `IDX_3C7EEC52AFC2B591` (`module_id`),
  CONSTRAINT `FK_3C7EEC526B7E9A73` FOREIGN KEY (`point_of_sale_id`) REFERENCES `point_of_sale` (`id`),
  CONSTRAINT `FK_3C7EEC52AFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `point_of_sale_has_module`
--

LOCK TABLES `point_of_sale_has_module` WRITE;
/*!40000 ALTER TABLE `point_of_sale_has_module` DISABLE KEYS */;
INSERT INTO `point_of_sale_has_module` VALUES (9,4),(10,1),(10,2),(10,3),(10,5);
/*!40000 ALTER TABLE `point_of_sale_has_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `point_of_sale_has_user`
--

DROP TABLE IF EXISTS `point_of_sale_has_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `point_of_sale_has_user` (
  `point_of_sale_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`point_of_sale_id`,`user_id`),
  KEY `IDX_6D10130A6B7E9A73` (`point_of_sale_id`),
  KEY `IDX_6D10130AA76ED395` (`user_id`),
  CONSTRAINT `FK_6D10130A6B7E9A73` FOREIGN KEY (`point_of_sale_id`) REFERENCES `point_of_sale` (`id`),
  CONSTRAINT `FK_6D10130AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `point_of_sale_has_user`
--

LOCK TABLES `point_of_sale_has_user` WRITE;
/*!40000 ALTER TABLE `point_of_sale_has_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `point_of_sale_has_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `slug` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `user_create` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_product_category1_idx` (`category_id`),
  CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name_canonical` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `user_create` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (1,NULL,'Super Administrator Tianos',NULL,'super-administrator-tianos','2018-09-29 05:12:20',NULL,NULL,NULL,1),(2,NULL,'Administrator PDV',NULL,'administrator','2018-09-29 05:12:20',NULL,NULL,NULL,1),(3,NULL,'Empleado',NULL,'employee','2018-09-29 05:12:20',NULL,NULL,NULL,1),(4,NULL,'Cliente',NULL,'client','2018-09-29 05:12:20',NULL,NULL,NULL,1),(5,NULL,'Guest (invitado)',NULL,'guest-invitado','2018-09-29 05:12:20',NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile_has_role`
--

DROP TABLE IF EXISTS `profile_has_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile_has_role` (
  `profile_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`profile_id`,`role_id`),
  KEY `IDX_F35F3084CCFA12B8` (`profile_id`),
  KEY `IDX_F35F3084D60322AC` (`role_id`),
  CONSTRAINT `FK_F35F3084CCFA12B8` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`),
  CONSTRAINT `FK_F35F3084D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_has_role`
--

LOCK TABLES `profile_has_role` WRITE;
/*!40000 ALTER TABLE `profile_has_role` DISABLE KEYS */;
INSERT INTO `profile_has_role` VALUES (1,1),(1,2),(1,3),(1,4);
/*!40000 ALTER TABLE `profile_has_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `group_rol` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_rol_tag` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `user_create` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,NULL,'User create','ROLE_USER_CREATE','usuario','group-user','2018-09-29 05:12:20',NULL,NULL,NULL,1),(2,NULL,'User edit','ROLE_USER_EDIT','usuario','group-user','2018-09-29 05:12:20',NULL,NULL,NULL,1),(3,NULL,'User view','ROLE_USER_VIEW','usuario','group-user','2018-09-29 05:12:20',NULL,NULL,NULL,1),(4,NULL,'User delete','ROLE_USER_DELETE','usuario','group-user','2018-09-29 05:12:20',NULL,NULL,NULL,1),(5,NULL,'Client create','ROLE_CLIENT_CREATE','cliente','group-client','2018-09-29 05:12:20',NULL,NULL,NULL,1),(6,NULL,'client edit','ROLE_CLIENT_EDIT','cliente','group-client','2018-09-29 05:12:20',NULL,NULL,NULL,1),(7,NULL,'client view','ROLE_CLIENT_VIEW','cliente','group-client','2018-09-29 05:12:20',NULL,NULL,NULL,1),(8,NULL,'client delete','ROLE_CLIENT_DELETE','cliente','group-client','2018-09-29 05:12:20',NULL,NULL,NULL,1),(9,NULL,'Pdv create','ROLE_PDV_CREATE','pdv','group-pdv','2018-09-29 05:12:20',NULL,NULL,NULL,1),(10,NULL,'Pdv edit','ROLE_PDV_EDIT','pdv','group-pdv','2018-09-29 05:12:20',NULL,NULL,NULL,1),(11,NULL,'Pdv view','ROLE_PDV_VIEW','pdv','group-pdv','2018-09-29 05:12:20',NULL,NULL,NULL,1),(12,NULL,'Pdv delete','ROLE_PDV_DELETE','pdv','group-pdv','2018-09-29 05:12:20',NULL,NULL,NULL,1),(13,NULL,'Category create','ROLE_CATEGORY_CREATE','categoria','group-category','2018-09-29 05:12:20',NULL,NULL,NULL,1),(14,NULL,'Category edit','ROLE_CATEGORY_EDIT','categoria','group-category','2018-09-29 05:12:20',NULL,NULL,NULL,1),(15,NULL,'Category view','ROLE_CATEGORY_VIEW','categoria','group-category','2018-09-29 05:12:20',NULL,NULL,NULL,1),(16,NULL,'Category delete','ROLE_CATEGORY_DELETE','categoria','group-category','2018-09-29 05:12:20',NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `token` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D044D5D4A76ED395` (`user_id`),
  CONSTRAINT `FK_D044D5D4A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session`
--

LOCK TABLES `session` WRITE;
/*!40000 ALTER TABLE `session` DISABLE KEYS */;
/*!40000 ALTER TABLE `session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) DEFAULT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `device_code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `headline` varchar(144) COLLATE utf8_unicode_ci DEFAULT NULL,
  `about_me` text COLLATE utf8_unicode_ci,
  `dob` date DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `user_create` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `last_access` datetime DEFAULT NULL,
  `reset_password_hash` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_date` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`),
  KEY `FK_8D93D649CCFA12B8` (`profile_id`),
  CONSTRAINT `FK_8D93D649CCFA12B8` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,1,'5baf09b4bd8c3','5baf09b4bd8c3','abringas@tianos.xyz','abringas@tianos.xyz',1,NULL,'$2y$13$N5akyngVULyFzb7BKubv/O5lbL9pG5LcRqWQAYyNA./BqFdCGrOoO',NULL,NULL,NULL,'N;','5baf09b4bd8c3-alfredo',NULL,'Alfredo','Bringas','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-09-29 05:12:20',NULL,NULL,NULL,NULL,NULL,NULL,1),(2,2,'5baf09b52e9ba','5baf09b52e9ba','aeinstein-5baf09b52e964@tianos.xyz','aeinstein-5baf09b52e964@tianos.xyz',1,NULL,'$2y$13$m52TsFHzD/6C8RvUdSp1SO2u67asNwGqb/q3h8DR7h.7jNu3Hm5g.',NULL,NULL,NULL,'N;','5baf09b52e9ba-albert',NULL,'Albert','Einstein','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-09-29 05:12:20',NULL,NULL,NULL,NULL,NULL,NULL,1),(3,3,'5baf09b593d2f','5baf09b593d2f','bgates-5baf09b593cd8@tianos.xyz','bgates-5baf09b593cd8@tianos.xyz',1,NULL,'$2y$13$QqeuoAcIVTh.AZ/cBj3DlevBvFP2FSNn.6SCftAfxRdmfBm3ZKDoC',NULL,NULL,NULL,'N;','5baf09b593d2f-bill',NULL,'Bill','Gates','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-09-29 05:12:20',NULL,NULL,NULL,NULL,NULL,NULL,1),(4,3,'5baf09b60416c','5baf09b60416c','inewton-5baf09b604117@tianos.xyz','inewton-5baf09b604117@tianos.xyz',1,NULL,'$2y$13$dGN3p//ScLzXxhr1bbxRF.1U7Kzpjuo9Bu.M.vXL2x9jwulMJHtnS',NULL,NULL,NULL,'N;','5baf09b60416c-isaac',NULL,'Isaac','Newton','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-09-29 05:12:20',NULL,NULL,NULL,NULL,NULL,NULL,1),(5,4,'5baf09b669794','5baf09b669794','sjobs@tianos.xyz','sjobs@tianos.xyz',1,NULL,'$2y$13$61kZvtfYeQjDlrIjtCN5/ep1Hz5.NGi/MnY7AM3pmdG/xY8jH4Ss6',NULL,NULL,NULL,'N;','5baf09b669794-steve',NULL,'Steve','Jobs','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-09-29 05:12:20',NULL,NULL,NULL,NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visit`
--

DROP TABLE IF EXISTS `visit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `point_of_sale_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `visit_start` datetime DEFAULT NULL,
  `visit_end` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `user_create` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `uuid` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_visita_user1_idx` (`user_id`),
  KEY `fk_visita_point_of_sale1_idx` (`point_of_sale_id`),
  CONSTRAINT `FK_437EE9396B7E9A73` FOREIGN KEY (`point_of_sale_id`) REFERENCES `point_of_sale` (`id`),
  CONSTRAINT `FK_437EE939A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visit`
--

LOCK TABLES `visit` WRITE;
/*!40000 ALTER TABLE `visit` DISABLE KEYS */;
/*!40000 ALTER TABLE `visit` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-29 17:31:21
