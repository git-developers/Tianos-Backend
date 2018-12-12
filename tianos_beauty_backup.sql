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
  `type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `user_create` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`),
  KEY `fk_category_category1_idx` (`category_id`),
  CONSTRAINT `FK_64C19C112469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,NULL,'001','Cosmeticos','cosmeticos','PRODUCT','2018-12-05 19:02:25',NULL,NULL,NULL,1),(2,1,'002','Ojos','ojos','PRODUCT','2018-12-05 19:02:25',NULL,NULL,NULL,1),(3,1,'003','Labios','labios','PRODUCT','2018-12-05 19:02:25',NULL,NULL,NULL,1),(4,NULL,'004','Shampoos','shampoos','PRODUCT','2018-12-05 19:02:25',NULL,NULL,NULL,1),(5,NULL,'005','Tintes','tintes','PRODUCT','2018-12-05 19:02:25',NULL,NULL,NULL,1),(6,NULL,'006','Cremas','cremas','PRODUCT','2018-12-05 19:02:25',NULL,NULL,NULL,1),(7,6,'007','Crema mano','crema-mano','PRODUCT','2018-12-05 19:02:25',NULL,NULL,NULL,1),(8,6,'008','Crema pie','crema-pie','PRODUCT','2018-12-05 19:02:25',NULL,NULL,NULL,1),(9,6,'009','Crema cuerpo','crema-cuerpo','PRODUCT','2018-12-05 19:02:25',NULL,NULL,NULL,1),(10,NULL,'010','Corte de cabello','corte-de-cabello','SERVICE','2018-12-05 19:02:25',NULL,NULL,NULL,1),(11,10,'011','Hombre','hombre','SERVICE','2018-12-05 19:02:25',NULL,NULL,NULL,1),(12,10,'012','Mujer','mujer','SERVICE','2018-12-05 19:02:25',NULL,NULL,NULL,1),(13,NULL,'013','Pedicure','pedicure','SERVICE','2018-12-05 19:02:25',NULL,NULL,NULL,1),(14,NULL,'014','Manicure','manicure','SERVICE','2018-12-05 19:02:25',NULL,NULL,NULL,1);
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
INSERT INTO `groupofusers` VALUES (1,'111','Grupo 1','grupo-1','2018-12-05 19:02:25',NULL,NULL,NULL,1),(2,'222','Grupo 2','grupo-2','2018-12-05 19:02:25',NULL,NULL,NULL,1),(3,'333','Grupo 3','grupo-3','2018-12-05 19:02:25',NULL,NULL,NULL,1);
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
INSERT INTO `module` VALUES (1,'001','Agenda','agenda','2018-12-05 19:02:25',NULL,NULL,NULL,1),(2,'002','Inventario','inventario','2018-12-05 19:02:25',NULL,NULL,NULL,1),(3,'003','Gestión de usuarios','gestion-de-usuarios','2018-12-05 19:02:25',NULL,NULL,NULL,1),(4,'005','Informes','informes','2018-12-05 19:02:25',NULL,NULL,NULL,1),(5,'006','Servicios','servicios','2018-12-05 19:02:25',NULL,NULL,NULL,1);
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
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  UNIQUE KEY `slug_UNIQUE` (`slug`),
  UNIQUE KEY `code_UNIQUE` (`code`),
  KEY `fk_point_of_sale_point_of_sale1_idx` (`point_of_sale_id`),
  CONSTRAINT `FK_F7A7B1FA6B7E9A73` FOREIGN KEY (`point_of_sale_id`) REFERENCES `point_of_sale` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `point_of_sale`
--

LOCK TABLES `point_of_sale` WRITE;
/*!40000 ALTER TABLE `point_of_sale` DISABLE KEYS */;
INSERT INTO `point_of_sale` VALUES (1,NULL,'111','point-of-sale-1','Salon Belleza Aeropuerto',-12.02407160,-77.11203260,NULL,'Av. Tomas Valle Mz.g 37 Lt.31 Aa.hh Bocanegra Callao','994826014','2018-12-05 19:02:25',NULL,NULL,NULL,1),(2,NULL,'222','point-of-sale-2','Salon Belleza Barranco',-12.14761230,-77.02137500,NULL,'Calle Union 208, Barranco','2484434','2018-12-05 19:02:25',NULL,NULL,NULL,1),(3,NULL,'333','point-of-sale-3','Salon Belleza Chorrillos',-12.09828210,-76.96201320,NULL,'Jr. Delfín Puccio Mz.a Lt.8 Urb.san Juan, Chorrillos','998461653','2018-12-05 19:02:25',NULL,NULL,NULL,1),(4,NULL,'444','point-of-sale-4','Salon Belleza El Porvenir',-12.06254110,-77.01679050,NULL,'Jr. Garibaldi 367, La Victoria','5731246','2018-12-05 19:02:25',NULL,NULL,NULL,1),(5,NULL,'555','point-of-sale-5','Salon Belleza La Molina',-12.06602910,-76.95910900,NULL,'Av. La Molina 740','999040550','2018-12-05 19:02:25',NULL,NULL,NULL,1),(6,NULL,'666','point-of-sale-6','Salon Belleza Lurigancho',-12.03015960,-77.01098910,NULL,'Av. Gran Chimu 1era Crda Zarate, Lurigancho (Porton Plomo)','999339483','2018-12-05 19:02:25',NULL,NULL,NULL,1),(7,NULL,'777','point-of-sale-7','Salon Belleza Magdalena',-12.09239160,-77.07074950,NULL,'Jr. Sn. Martin Cdra. 833 Mz.e Lt.9 Los Tulipanes, Magdalena','2636376','2018-12-05 19:02:25',NULL,NULL,NULL,1),(8,NULL,'888','point-of-sale-8','Salon Belleza Miraflores',-12.13583070,-77.01788320,NULL,'Av. Paseo De República 5260 Miraflores','975286372','2018-12-05 19:02:25',NULL,NULL,NULL,1),(9,NULL,'999','point-of-sale-9','Salon Belleza Plaza Grau',-12.07062280,-77.00045530,NULL,'Pueblo Joven Cerro El Pino','','2018-12-05 19:02:25',NULL,'2018-12-05 19:02:25',NULL,1),(10,NULL,'1010','point-of-sale-10','Salon Belleza Puente Piedra',-11.86125500,-77.07853080,NULL,'Av. Panam. norte 680 pasando byPass Puente Piedra','997013686','2018-12-05 19:02:25',NULL,'2018-12-05 19:02:25',NULL,1),(11,10,'1111','point-of-sale-11','Salon Belleza Sucursal 1',-12.02407160,-77.11203260,NULL,'Av. paz 234','994826014','2018-12-05 19:02:25',NULL,NULL,NULL,1),(12,10,'2222','point-of-sale-12','Salon Belleza Sucursal 2',-12.14761230,-77.02137500,NULL,'Av. paz 234','2484434','2018-12-05 19:02:25',NULL,NULL,NULL,1),(13,10,'3333','point-of-sale-13','Salon Belleza Sucursal 3',-12.09828210,-76.96201320,NULL,'Av. paz 234','998461653','2018-12-05 19:02:25',NULL,NULL,NULL,1);
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
INSERT INTO `point_of_sale_has_user` VALUES (9,2),(10,2);
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
INSERT INTO `profile` VALUES (1,NULL,'Super Administrator Tianos',NULL,'super-administrator-tianos','2018-12-05 19:02:25',NULL,NULL,NULL,1),(2,NULL,'PDV Administrator',NULL,'pdv-administrator','2018-12-05 19:02:25',NULL,NULL,NULL,1),(3,NULL,'Empleado',NULL,'employee','2018-12-05 19:02:25',NULL,NULL,NULL,1),(4,NULL,'Cliente',NULL,'client','2018-12-05 19:02:25',NULL,NULL,NULL,1),(5,NULL,'Guest (invitado)',NULL,'guest-invitado','2018-12-05 19:02:25',NULL,NULL,NULL,1);
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
INSERT INTO `profile_has_role` VALUES (1,1),(2,2),(3,3),(4,4),(5,5);
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,NULL,'Super Administrator Tianos','ROLE_SUPER_ADMIN','default-roles','default-roles','2018-12-05 19:02:25',NULL,NULL,NULL,1),(2,NULL,'PDV Administrator','ROLE_PDV_ADMIN','default-roles','default-roles','2018-12-05 19:02:25',NULL,NULL,NULL,1),(3,NULL,'Empleado','ROLE_EMPLOYEE','default-roles','default-roles','2018-12-05 19:02:25',NULL,NULL,NULL,1),(4,NULL,'Cliente','ROLE_CLIENT','default-roles','default-roles','2018-12-05 19:02:25',NULL,NULL,NULL,1),(5,NULL,'Guest (invitado)','ROLE_GUEST','default-roles','default-roles','2018-12-05 19:02:25',NULL,NULL,NULL,1),(6,NULL,'User create','ROLE_USER_CREATE','usuario','group-user','2018-12-05 19:02:25',NULL,NULL,NULL,1),(7,NULL,'User edit','ROLE_USER_EDIT','usuario','group-user','2018-12-05 19:02:25',NULL,NULL,NULL,1),(8,NULL,'User view','ROLE_USER_VIEW','usuario','group-user','2018-12-05 19:02:25',NULL,NULL,NULL,1),(9,NULL,'User delete','ROLE_USER_DELETE','usuario','group-user','2018-12-05 19:02:25',NULL,NULL,NULL,1),(10,NULL,'Client create','ROLE_CLIENT_CREATE','cliente','group-client','2018-12-05 19:02:25',NULL,NULL,NULL,1),(11,NULL,'client edit','ROLE_CLIENT_EDIT','cliente','group-client','2018-12-05 19:02:25',NULL,NULL,NULL,1),(12,NULL,'client view','ROLE_CLIENT_VIEW','cliente','group-client','2018-12-05 19:02:25',NULL,NULL,NULL,1),(13,NULL,'client delete','ROLE_CLIENT_DELETE','cliente','group-client','2018-12-05 19:02:25',NULL,NULL,NULL,1),(14,NULL,'Pdv create','ROLE_PDV_CREATE','pdv','group-pdv','2018-12-05 19:02:25',NULL,NULL,NULL,1),(15,NULL,'Pdv edit','ROLE_PDV_EDIT','pdv','group-pdv','2018-12-05 19:02:25',NULL,NULL,NULL,1),(16,NULL,'Pdv view','ROLE_PDV_VIEW','pdv','group-pdv','2018-12-05 19:02:25',NULL,NULL,NULL,1),(17,NULL,'Pdv delete','ROLE_PDV_DELETE','pdv','group-pdv','2018-12-05 19:02:25',NULL,NULL,NULL,1),(18,NULL,'Category create','ROLE_CATEGORY_CREATE','categoria','group-category','2018-12-05 19:02:25',NULL,NULL,NULL,1),(19,NULL,'Category edit','ROLE_CATEGORY_EDIT','categoria','group-category','2018-12-05 19:02:25',NULL,NULL,NULL,1),(20,NULL,'Category view','ROLE_CATEGORY_VIEW','categoria','group-category','2018-12-05 19:02:25',NULL,NULL,NULL,1),(21,NULL,'Category delete','ROLE_CATEGORY_DELETE','categoria','group-category','2018-12-05 19:02:25',NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` double DEFAULT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `user_create` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_product_category1_idx` (`category_id`),
  CONSTRAINT `FK_7332E16912469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,10,'001',25.33,'Servicio 1','servicio-1','2018-12-05 19:02:25',NULL,NULL,NULL,1),(2,10,'002',56.33,'Servicio 2','servicio-2','2018-12-05 19:02:25',NULL,NULL,NULL,1),(3,10,'003',28.33,'Servicio 3','servicio-3','2018-12-05 19:02:25',NULL,NULL,NULL,1),(4,10,'004',72.12,'Servicio 4','servicio-4','2018-12-05 19:02:25',NULL,NULL,NULL,1),(5,11,'005',67.12,'Servicio 5','servicio-5','2018-12-05 19:02:25',NULL,NULL,NULL,1),(6,11,'006',38.45,'Servicio 6','servicio-6','2018-12-05 19:02:25',NULL,NULL,NULL,1),(7,12,'007',87.43,'Servicio 7','servicio-7','2018-12-05 19:02:25',NULL,NULL,NULL,1),(8,12,'008',56.67,'Servicio 8','servicio-8','2018-12-05 19:02:25',NULL,NULL,NULL,1),(9,12,'009',123.44,'Servicio 9','servicio-9','2018-12-05 19:02:25',NULL,NULL,NULL,1),(10,13,'010',78.25,'Servicio 10','servicio-10','2018-12-05 19:02:25',NULL,NULL,NULL,1),(11,13,'011',34.67,'Servicio 11','servicio-11','2018-12-05 19:02:25',NULL,NULL,NULL,1),(12,14,'012',15.45,'Servicio 12','servicio-12','2018-12-05 19:02:25',NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
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
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `code` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `date_ticket` datetime NOT NULL,
  `user_create` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `IDX_97A0ADA319EB6921` (`client_id`),
  CONSTRAINT `FK_97A0ADA319EB6921` FOREIGN KEY (`client_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` VALUES (1,23,NULL,'xx','xx','2018-12-05 19:59:47','2018-12-20 00:00:00',NULL,NULL,NULL,1),(2,22,NULL,'ooooooooooo','ooooooooooo','2018-12-05 20:35:40','2018-12-13 00:00:00',NULL,NULL,NULL,1),(3,23,NULL,'','','2018-12-06 20:35:20','2018-12-06 00:00:00',NULL,NULL,NULL,1),(4,22,NULL,'','','2018-12-06 20:37:01','2018-12-06 20:37:01',NULL,NULL,NULL,1),(5,24,NULL,'','','2018-12-06 20:54:37','2018-12-06 20:54:37',NULL,NULL,NULL,1),(6,23,NULL,'','','2018-12-06 20:56:40','2018-12-06 20:56:40',NULL,NULL,NULL,1),(7,23,NULL,'','','2018-12-06 21:09:06','2018-12-06 21:09:06',NULL,NULL,NULL,1),(8,24,NULL,'GATAZI','gatazi','2018-12-06 21:17:48','2018-12-06 21:17:48',NULL,NULL,NULL,1),(9,18,NULL,'','','2018-12-06 21:18:59','2018-12-06 21:18:59',NULL,NULL,NULL,1),(10,22,NULL,'POLLAZO','pollazo','2018-12-06 21:21:13','2018-12-11 00:00:00',NULL,NULL,NULL,1),(11,17,NULL,'GATO 4444','gato-4444','2018-12-06 21:23:50','2018-12-07 00:00:00',NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_has_employee`
--

DROP TABLE IF EXISTS `ticket_has_employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_has_employee` (
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`ticket_id`,`user_id`),
  KEY `IDX_8C2F733E700047D2` (`ticket_id`),
  KEY `IDX_8C2F733EA76ED395` (`user_id`),
  CONSTRAINT `FK_8C2F733E700047D2` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`),
  CONSTRAINT `FK_8C2F733EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_has_employee`
--

LOCK TABLES `ticket_has_employee` WRITE;
/*!40000 ALTER TABLE `ticket_has_employee` DISABLE KEYS */;
INSERT INTO `ticket_has_employee` VALUES (1,6),(1,7),(2,7),(3,7),(3,8),(4,7),(5,8),(6,6),(7,7),(8,7),(9,5),(10,4),(11,4);
/*!40000 ALTER TABLE `ticket_has_employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_has_services`
--

DROP TABLE IF EXISTS `ticket_has_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_has_services` (
  `ticket_id` int(11) NOT NULL,
  `services_id` int(11) NOT NULL,
  PRIMARY KEY (`ticket_id`,`services_id`),
  KEY `IDX_A282E7F6700047D2` (`ticket_id`),
  KEY `IDX_A282E7F6AEF5A6C1` (`services_id`),
  CONSTRAINT `FK_A282E7F6700047D2` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`),
  CONSTRAINT `FK_A282E7F6AEF5A6C1` FOREIGN KEY (`services_id`) REFERENCES `services` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_has_services`
--

LOCK TABLES `ticket_has_services` WRITE;
/*!40000 ALTER TABLE `ticket_has_services` DISABLE KEYS */;
INSERT INTO `ticket_has_services` VALUES (1,1),(1,2),(2,10),(2,11),(3,8),(3,10),(4,10),(4,11),(5,10),(6,10),(7,10),(7,11),(8,10),(8,11),(9,12),(10,10),(10,11),(11,2),(11,3);
/*!40000 ALTER TABLE `ticket_has_services` ENABLE KEYS */;
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
  `point_of_sale_id` int(11) DEFAULT NULL,
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
  KEY `IDX_8D93D6496B7E9A73` (`point_of_sale_id`),
  KEY `FK_8D93D649CCFA12B8` (`profile_id`),
  CONSTRAINT `FK_8D93D6496B7E9A73` FOREIGN KEY (`point_of_sale_id`) REFERENCES `point_of_sale` (`id`),
  CONSTRAINT `FK_8D93D649CCFA12B8` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,1,NULL,'5c0820c1d29d1','5c0820c1d29d1','abringas@tianos.xyz','abringas@tianos.xyz',1,NULL,'$2y$13$8bBqprGpqllOqenyvxAl0uJcz1Cc4QlopBnhZMARtoKGp3ztOUZfu',NULL,NULL,NULL,'N;','5c0820c1d29d1-alfredo',NULL,'Alfredo','Bringas','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-12-05 19:02:25',NULL,NULL,NULL,NULL,NULL,NULL,1),(2,2,NULL,'5c0820c247d25','5c0820c247d25','aeinstein@tianos.xyz','aeinstein@tianos.xyz',1,NULL,'$2y$13$dlOJgWmR6Vgx4flBymLFiucq80dfltqG9QBvEPJthdqMtZJT6t/CS',NULL,NULL,NULL,'N;','5c0820c247d25-albert',NULL,'Albert','Einstein','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-12-05 19:02:25',NULL,NULL,NULL,NULL,NULL,NULL,1),(3,3,NULL,'5c0820c2b04cd','5c0820c2b04cd','bgates@tianos.xyz','bgates@tianos.xyz',1,NULL,'$2y$13$ruB12XymnNV.PbHZA47qiedkFGFwUHgbRtS7olidVaKTgdAOp5SbK',NULL,NULL,NULL,'N;','5c0820c2b04cd-bill',NULL,'Bill','Gates','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-12-05 19:02:25',NULL,NULL,NULL,NULL,NULL,NULL,1),(4,3,NULL,'5c0820c3254ac','5c0820c3254ac','inewton@tianos.xyz','inewton@tianos.xyz',1,NULL,'$2y$13$C/uSl0fpXbI4jfe0aUc9T.hT9oxKapEA1bdf1guYjB/gViK5myOPG',NULL,NULL,NULL,'N;','5c0820c3254ac-isaac',NULL,'Isaac','Newton','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-12-05 19:02:25',NULL,NULL,NULL,NULL,NULL,NULL,1),(5,3,NULL,'5c0820c38ed0a','5c0820c38ed0a','mpolo@tianos.xyz','mpolo@tianos.xyz',1,NULL,'$2y$13$VIDPwHNcXqznxUqY8FLoFeaoxG2gYlDBow0MVJMK5wbKhDzqs5zl6',NULL,NULL,NULL,'N;','5c0820c38ed0a-marco',NULL,'Marco','Polo','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-12-05 19:02:25',NULL,NULL,NULL,NULL,NULL,NULL,1),(6,3,NULL,'5c0820c40401a','5c0820c40401a','troosevelt@tianos.xyz','troosevelt@tianos.xyz',1,NULL,'$2y$13$ThwvARAFRrSeJYZIsIr5g.7.GP2PWaI7XJHySkiY.x3UyInpkZdm2',NULL,NULL,NULL,'N;','5c0820c40401a-theodore',NULL,'Theodore','Roosevelt','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-12-05 19:02:25',NULL,NULL,NULL,NULL,NULL,NULL,1),(7,3,NULL,'5c0820c46d436','5c0820c46d436','kmarx@tianos.xyz','kmarx@tianos.xyz',1,NULL,'$2y$13$PZ1Pyyb2Ek53RM8Ahg2PV.DLZ5OyiBXPjGr930Vamgi.sdTyiRPmS',NULL,NULL,NULL,'N;','5c0820c46d436-karl',NULL,'Karl','Marx','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-12-05 19:02:25',NULL,NULL,NULL,NULL,NULL,NULL,1),(8,3,NULL,'5c0820c4d623e','5c0820c4d623e','fdouglass@tianos.xyz','fdouglass@tianos.xyz',1,NULL,'$2y$13$qm8OFJ8fZnsOeqo0yv1ko.9EF6p8VSG/ccJDHdtY0EArgR57cS6me',NULL,NULL,NULL,'N;','5c0820c4d623e-frederick',NULL,'Frederick','Douglass','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-12-05 19:02:25',NULL,NULL,NULL,NULL,NULL,NULL,1),(9,3,NULL,'5c0820c54b68c','5c0820c54b68c','jlennon@tianos.xyz','jlennon@tianos.xyz',1,NULL,'$2y$13$Z6hQCS.GZHdIdnBJf597M.PomuOkRO1PioUjPSWO5Hf/6.8rzo0fm',NULL,NULL,NULL,'N;','5c0820c54b68c-john',NULL,'John','Lennon','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-12-05 19:02:25',NULL,NULL,NULL,NULL,NULL,NULL,1),(10,4,NULL,'5c0820c5b443c','5c0820c5b443c','sjobs@tianos.xyz','sjobs@tianos.xyz',1,NULL,'$2y$13$dp9u/Epo2/5afElFeVT85.2DdJNMOnOG68MiQbOdz7DTCggodiO5G',NULL,NULL,NULL,'N;','5c0820c5b443c-steve',NULL,'Steve','Jobs','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-12-05 19:02:25',NULL,NULL,NULL,NULL,NULL,NULL,1),(11,4,NULL,'5c0820c628d74','5c0820c628d74','rfederer@tianos.xyz','rfederer@tianos.xyz',1,NULL,'$2y$13$Ga0FWJrGIYS27W7qyzzihuylR3D/A81gRij55OZJuS/Cxro2vPgou',NULL,NULL,NULL,'N;','5c0820c628d74-roger',NULL,'Roger','Federer','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-12-05 19:02:25',NULL,NULL,NULL,NULL,NULL,NULL,1),(12,4,NULL,'5c0820c694c34','5c0820c694c34','njunior@tianos.xyz','njunior@tianos.xyz',1,NULL,'$2y$13$fvfAP18QlnM2vYRmzebpq.phovm/lMNFwCL5pSKnICxtqa23CbOZe',NULL,NULL,NULL,'N;','5c0820c694c34-neymar',NULL,'Neymar','Junior','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-12-05 19:02:25',NULL,NULL,NULL,NULL,NULL,NULL,1),(13,4,NULL,'5c0820c7096ab','5c0820c7096ab','kgarcia@tianos.xyz','kgarcia@tianos.xyz',1,NULL,'$2y$13$U7WkD9/ZgbMxc0CVRkcbme57/MEflHEIRh4Zx7UMYbtsJPIkGs8ES',NULL,NULL,NULL,'N;','5c0820c7096ab-keiko',NULL,'Keiko','Garcia','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-12-05 19:02:25',NULL,NULL,NULL,NULL,NULL,NULL,1),(14,4,NULL,'5c0820c7719d0','5c0820c7719d0','jlopez@tianos.xyz','jlopez@tianos.xyz',1,NULL,'$2y$13$WaQsXumkm3dMWxgdkF95HuSeLn4mEsvz.bGyzcnHCd.tUtTBhV.26',NULL,NULL,NULL,'N;','5c0820c7719d0-juan',NULL,'Juan','Lopez','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-12-05 19:02:25',NULL,NULL,NULL,NULL,NULL,NULL,1),(15,4,NULL,'5c0820c7da4bd','5c0820c7da4bd','rmedina@tianos.xyz','rmedina@tianos.xyz',1,NULL,'$2y$13$huCM8QlVTc7NYqnAmPF6pOYSdzMAGNxD1VdJaUSSa467eBrS9GYLO',NULL,NULL,NULL,'N;','5c0820c7da4bd-renee',NULL,'Renee','Medina','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-12-05 19:02:25',NULL,NULL,NULL,NULL,NULL,NULL,1),(16,4,NULL,'5c0820c84e417','5c0820c84e417','kjohnson@tianos.xyz','kjohnson@tianos.xyz',1,NULL,'$2y$13$KEGX1nLOKoN4ggqrmOjouepmoebLQKfyqBZfq8Mb6VZRwtLlDul0W',NULL,NULL,NULL,'N;','5c0820c84e417-katherine',NULL,'Katherine','Johnson','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-12-05 19:02:25',NULL,NULL,NULL,NULL,NULL,NULL,1),(17,4,NULL,'5c0820c8b728d','5c0820c8b728d','mhamilton@tianos.xyz','mhamilton@tianos.xyz',1,NULL,'$2y$13$X8bm2egMGJsCrPYUxUOFqO26hio4R.gXgCHlk/.LPgxWQbYRzqyhC',NULL,NULL,NULL,'N;','5c0820c8b728d-margaret',NULL,'Margaret','Hamilton','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-12-05 19:02:25',NULL,NULL,NULL,NULL,NULL,NULL,1),(18,4,NULL,'5c0820c92c45f','5c0820c92c45f','khepburn@tianos.xyz','khepburn@tianos.xyz',1,NULL,'$2y$13$unzCuI.HctFfV4xsu0nJYeEnFzrqW1JXJTIPRnhIPiswojCtfjb4a',NULL,NULL,NULL,'N;','5c0820c92c45f-katharine',NULL,'Katharine','Hepburn','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-12-05 19:02:25',NULL,NULL,NULL,NULL,NULL,NULL,1),(19,4,NULL,'5c0820c995472','5c0820c995472','dparker@tianos.xyz','dparker@tianos.xyz',1,NULL,'$2y$13$lTHVzJEw8ctNk64fXlSL4evyl2L47cY0uaNXyYBbg7ajPyEjhKjEC',NULL,NULL,NULL,'N;','5c0820c995472-dorothy',NULL,'Dorothy','Parker','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-12-05 19:02:25',NULL,NULL,NULL,NULL,NULL,NULL,1),(20,4,NULL,'5c0820ca0a61d','5c0820ca0a61d','alincoln@tianos.xyz','alincoln@tianos.xyz',1,NULL,'$2y$13$EMjHPAqCg8ZoUJ6DT7NDcOCVABFR528p44wpMdOfhVznFRyaUR11G',NULL,NULL,NULL,'N;','5c0820ca0a61d-abraham',NULL,'Abraham','Lincoln','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-12-05 19:02:25',NULL,NULL,NULL,NULL,NULL,NULL,1),(21,4,NULL,'5c0820ca73998','5c0820ca73998','wdisney@tianos.xyz','wdisney@tianos.xyz',1,NULL,'$2y$13$96oEBI4qboBpsttn5acSXudriRcdz8PCKFWLALz.Y01/8HqybOycK',NULL,NULL,NULL,'N;','5c0820ca73998-walt',NULL,'Walt','Disney','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-12-05 19:02:25',NULL,NULL,NULL,NULL,NULL,NULL,1),(22,4,NULL,'5c0820cadc2f8','5c0820cadc2f8','nbonaparte@tianos.xyz','nbonaparte@tianos.xyz',1,NULL,'$2y$13$Z9u54Fm3IQly20ro.eTjTORV3jwuMBcDYEhO3vvEbH4yjop5TmG06',NULL,NULL,NULL,'N;','5c0820cadc2f8-napoleon',NULL,'Napoleon','Bonaparte','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-12-05 19:02:25',NULL,NULL,NULL,NULL,NULL,NULL,1),(23,4,NULL,'5c0820cb50f75','5c0820cb50f75','aelizabeth@tianos.xyz','aelizabeth@tianos.xyz',1,NULL,'$2y$13$MmsqGePBgxRoN6sMoTKEbeKBVKvC4l/hYCWje2yeTz/L6e0XCDpeS',NULL,NULL,NULL,'N;','5c0820cb50f75-abraham',NULL,'Abraham','Elizabeth','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-12-05 19:02:25',NULL,NULL,NULL,NULL,NULL,NULL,1),(24,4,NULL,'5c0820cbb9868','5c0820cbb9868','bfranklin@tianos.xyz','bfranklin@tianos.xyz',1,NULL,'$2y$13$2r6x/cm4Iv1iqJQsp/G5V.dfh5inH4G9RK9w9GkqE2dBm4Fh47YIu',NULL,NULL,NULL,'N;','5c0820cbb9868-benjamin',NULL,'Benjamin','Franklin','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-12-05 19:02:25',NULL,NULL,NULL,NULL,NULL,NULL,1),(25,4,NULL,'5c0820cc2e181','5c0820cc2e181','wbrothers@tianos.xyz','wbrothers@tianos.xyz',1,NULL,'$2y$13$kCXmNf/1P.cA7dqAuxUANu4AKbMBzC.ybvh4PTyMUXDHMsSeffIpS',NULL,NULL,NULL,'N;','5c0820cc2e181-wright',NULL,'Wright','Brothers','Soy parte de Tianos!','Aún no he ingresado mi descripción.',NULL,NULL,NULL,NULL,'2018-12-05 19:02:25',NULL,NULL,NULL,NULL,NULL,NULL,1);
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

-- Dump completed on 2018-12-08  7:48:11
