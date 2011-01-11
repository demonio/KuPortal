-- MySQL dump 10.13  Distrib 5.1.41, for debian-linux-gnu (i486)
--
-- Host: localhost    Database: kuportal
-- ------------------------------------------------------
-- Server version	5.1.41-3ubuntu12.8

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
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Usuarios','Administración de usuarios'),(2,'Roles','Administración de roles'),(3,'Accesos','Administración de accesos'),(4,'Recursos','Administración de recursos'),(5,'Menús','Administración de menús'),(6,'Blog','Administración del blog');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recurso`
--

DROP TABLE IF EXISTS `recurso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recurso` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `url` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url_UNIQUE` (`url`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recurso`
--

LOCK TABLES `recurso` WRITE;
/*!40000 ALTER TABLE `recurso` DISABLE KEYS */;
INSERT INTO `recurso` VALUES (1,'Crear usuario','admin/usuario/crear/'),(2,'Listar usuarios','admin/usuario/index/'),(3,'Editar usuario','admin/usuario/editar/'),(4,'Crear recurso','admin/recurso/crear/'),(5,'Listar recursos','admin/recurso/index/'),(6,'Editar recurso','admin/recurso/editar/'),(7,'Crear rol','admin/rol/crear/'),(8,'Listar roles','admin/rol/index/'),(9,'Editar rol','admin/rol/editar/'),(10,'Crear MenÃº','admin/menu/crear/'),(11,'Listar menÃºs','admin/menu/index/'),(12,'Editar menÃº','admin/menu/editar/'),(13,'Crear acceso','admin/acceso/crear/'),(14,'Listar accesos','admin/acceso/index/'),(15,'Editar acceso','admin/acceso/editar/'),(16,'Inicio admin','admin/index/index/'),(17,'Cambiar clave','admin/usuario/cambiar_clave/');
/*!40000 ALTER TABLE `recurso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rol` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'Administrador'),(2,'Editor');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol_recurso`
--

DROP TABLE IF EXISTS `rol_recurso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rol_recurso` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `rol_id` int(10) NOT NULL,
  `recurso_id` bigint(20) NOT NULL,
  `menu_id` int(10) NOT NULL,
  `visible` char(1) NOT NULL,
  `estado` char(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rol_fk` (`rol_id`),
  KEY `fk_rol_recurso_recuso_id` (`recurso_id`),
  KEY `fk_rol_recurso_menu_id` (`menu_id`),
  CONSTRAINT `fk_rol_recurso_menu_id` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`),
  CONSTRAINT `fk_rol_recurso_recuso_id` FOREIGN KEY (`recurso_id`) REFERENCES `recurso` (`id`),
  CONSTRAINT `fk_rol_recurso_rol_id` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol_recurso`
--

LOCK TABLES `rol_recurso` WRITE;
/*!40000 ALTER TABLE `rol_recurso` DISABLE KEYS */;
INSERT INTO `rol_recurso` VALUES (1,1,1,1,'1','A'),(2,1,2,1,'1','A'),(3,1,3,1,'0','A'),(4,1,4,4,'1','A'),(5,1,5,4,'1','A'),(6,1,6,4,'0','A'),(7,1,7,2,'1','A'),(8,1,8,2,'1','A'),(9,1,9,2,'0','A'),(10,1,10,3,'1','A'),(11,1,11,3,'1','A'),(12,1,12,3,'0','A'),(13,1,13,3,'1','A'),(14,1,14,3,'1','A'),(15,1,15,3,'0','A'),(16,1,16,3,'0','A'),(17,1,17,1,'0','A');
/*!40000 ALTER TABLE `rol_recurso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nick` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `clave` text NOT NULL,
  `estado` char(1) NOT NULL,
  `nombre` text NOT NULL,
  `avatar` varchar(200) DEFAULT NULL,
  `rol_id` int(10) NOT NULL,
  `registrado_at` datetime DEFAULT NULL,
  `actualizado_in` datetime DEFAULT NULL,
  `reset` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_nick` (`nick`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_usuario_rol_id` (`rol_id`),
  CONSTRAINT `fk_usuario_rol_id` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'admin','admin@domain.com','7c4a8d09ca3762af61e59520943dc26494f8941b','1','Administrador',NULL,1,'2011-01-06 21:28:36','2011-01-11 08:14:20','kuS7wWaCqQ79krQEXILeTdxqaFoxNUW8');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-01-11  8:16:30
