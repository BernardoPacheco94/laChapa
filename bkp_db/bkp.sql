CREATE DATABASE  IF NOT EXISTS `db_lachapa` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `db_lachapa`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: db_lachapa
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.24-MariaDB

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
-- Table structure for table `atendentes`
--

DROP TABLE IF EXISTS `atendentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atendentes` (
  `idatendente` int(11) NOT NULL AUTO_INCREMENT,
  `nomeatendente` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `ativo` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idatendente`),
  UNIQUE KEY `idatendente_UNIQUE` (`idatendente`),
  UNIQUE KEY `nomeatendente_UNIQUE` (`nomeatendente`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atendentes`
--

LOCK TABLES `atendentes` WRITE;
/*!40000 ALTER TABLE `atendentes` DISABLE KEYS */;
INSERT INTO `atendentes` VALUES (1,'Bernardo',1),(2,'Luana',0),(3,'Gabriel',1);
/*!40000 ALTER TABLE `atendentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caixa`
--

DROP TABLE IF EXISTS `caixa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caixa` (
  `idcaixa` int(11) NOT NULL AUTO_INCREMENT,
  `dataabertura` datetime NOT NULL,
  `datafechamento` datetime NOT NULL,
  `valorinicial` float NOT NULL,
  `valordinheiro` float DEFAULT NULL,
  `valorcartaocredito` float DEFAULT NULL,
  `valorcartaodebito` float DEFAULT NULL,
  `valorpix` float DEFAULT NULL,
  `valortotal` float DEFAULT NULL,
  `status` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idcaixa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caixa`
--

LOCK TABLES `caixa` WRITE;
/*!40000 ALTER TABLE `caixa` DISABLE KEYS */;
/*!40000 ALTER TABLE `caixa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comanda-mesa`
--

DROP TABLE IF EXISTS `comanda-mesa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comanda-mesa` (
  `idcomandamesa` int(11) NOT NULL AUTO_INCREMENT,
  `idcomanda` int(11) NOT NULL,
  `idmesa` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcomandamesa`),
  KEY `FX_comanda_mesa` (`idmesa`),
  KEY `FK_mesa_comanda` (`idcomanda`),
  CONSTRAINT `idcomandamesa` FOREIGN KEY (`idcomanda`) REFERENCES `comandas` (`idcomanda`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idmesacomanda` FOREIGN KEY (`idmesa`) REFERENCES `mesas` (`idmesa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comanda-mesa`
--

LOCK TABLES `comanda-mesa` WRITE;
/*!40000 ALTER TABLE `comanda-mesa` DISABLE KEYS */;
INSERT INTO `comanda-mesa` VALUES (1,1,1),(2,2,2),(3,3,1),(4,4,1),(5,5,2),(6,60,2),(7,61,1),(8,62,1),(9,63,2),(10,68,2),(11,73,2),(12,75,2),(13,76,NULL),(14,77,3),(15,78,NULL),(16,79,1),(17,80,3),(18,81,1),(19,82,3),(20,83,1),(21,88,1),(22,89,1),(23,90,2),(24,91,2),(25,92,2),(26,93,2),(27,94,1),(28,95,1),(29,96,2),(30,97,1),(31,101,1),(33,105,1),(34,110,1),(35,111,1),(36,112,1),(37,113,1),(38,114,1),(39,115,1),(40,116,1),(41,117,1),(42,118,1),(43,120,1),(44,121,1),(45,122,1),(46,124,1),(47,125,1),(48,126,1),(49,127,1),(50,128,1),(51,129,1),(52,130,1),(53,131,1),(54,132,1),(55,133,1),(56,134,1),(57,135,1),(58,136,1),(59,137,1),(60,138,1);
/*!40000 ALTER TABLE `comanda-mesa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comanda-produtos`
--

DROP TABLE IF EXISTS `comanda-produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comanda-produtos` (
  `idcomandaproduto` int(11) NOT NULL AUTO_INCREMENT,
  `idcomanda` int(11) NOT NULL,
  `idproduto` int(11) NOT NULL,
  `vlfinalproduto` float DEFAULT NULL,
  PRIMARY KEY (`idcomandaproduto`),
  KEY `FK_produto_comanda` (`idcomanda`),
  KEY `FK_comanda_produto` (`idproduto`),
  CONSTRAINT `idcomandaproduto` FOREIGN KEY (`idcomanda`) REFERENCES `comandas` (`idcomanda`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idprodutocomanda` FOREIGN KEY (`idproduto`) REFERENCES `produtos` (`idproduto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comanda-produtos`
--

LOCK TABLES `comanda-produtos` WRITE;
/*!40000 ALTER TABLE `comanda-produtos` DISABLE KEYS */;
INSERT INTO `comanda-produtos` VALUES (1,1,7,NULL),(2,3,32,NULL),(3,1,20,NULL),(4,2,15,NULL),(5,2,15,NULL),(6,2,15,NULL),(7,2,15,NULL),(8,2,15,NULL),(13,1,15,NULL),(14,1,34,NULL),(15,1,26,NULL),(16,2,15,NULL),(17,79,32,NULL),(18,2,34,NULL),(19,2,34,NULL),(20,2,26,NULL),(21,2,15,NULL),(22,80,34,NULL),(23,80,32,NULL),(24,80,24,NULL),(25,81,34,NULL),(26,81,28,NULL),(27,82,33,NULL),(28,83,34,NULL),(29,88,34,NULL),(30,89,34,NULL),(31,90,34,NULL),(32,91,34,NULL),(33,92,34,NULL),(34,93,34,NULL),(35,93,27,NULL),(36,94,34,NULL),(37,95,34,NULL),(38,96,34,NULL),(39,97,34,NULL),(40,101,34,NULL),(41,110,34,NULL),(42,111,34,NULL),(43,112,34,NULL),(44,112,34,NULL),(45,113,34,NULL),(46,113,34,NULL),(47,113,24,NULL),(48,113,32,NULL),(49,113,33,NULL),(50,114,34,NULL),(51,114,33,NULL),(52,114,26,NULL),(53,115,34,NULL),(54,115,33,NULL),(55,115,32,NULL),(56,116,34,NULL),(57,116,34,NULL),(58,116,32,NULL),(59,117,34,NULL),(60,117,33,NULL),(61,117,32,NULL),(62,118,34,NULL),(63,120,34,NULL),(64,121,34,NULL),(65,122,33,NULL),(66,124,34,NULL),(67,125,34,NULL),(68,126,34,NULL),(69,127,34,NULL),(70,128,34,NULL),(71,129,34,NULL),(72,130,34,NULL),(73,131,34,NULL),(74,132,34,NULL),(75,133,34,NULL),(76,114,34,30),(77,135,27,NULL),(78,136,27,95),(79,137,33,24),(80,137,32,22),(81,138,34,25.5);
/*!40000 ALTER TABLE `comanda-produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comandas`
--

DROP TABLE IF EXISTS `comandas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comandas` (
  `idcomanda` int(11) NOT NULL AUTO_INCREMENT,
  `valortotal` float DEFAULT NULL,
  `statuscomanda` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  `datacomanda` timestamp NOT NULL DEFAULT current_timestamp(),
  `nomecliente` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idatendente` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcomanda`),
  UNIQUE KEY `idcomanda_UNIQUE` (`idcomanda`),
  KEY `atendentecomanda_idx` (`idatendente`),
  CONSTRAINT `atendentecomanda` FOREIGN KEY (`idatendente`) REFERENCES `atendentes` (`idatendente`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comandas`
--

LOCK TABLES `comandas` WRITE;
/*!40000 ALTER TABLE `comandas` DISABLE KEYS */;
INSERT INTO `comandas` VALUES (1,15,'P','2022-10-21 15:25:09','cliente',NULL),(2,15,'P','2022-10-21 17:45:27','',NULL),(3,15,'P','2022-10-21 17:45:42','',NULL),(4,15,'P','2022-10-21 19:27:29','',NULL),(5,15,'P','2022-10-21 19:27:34','',NULL),(6,15,'P','2022-10-21 19:53:39','',NULL),(7,15,'P','2022-10-21 20:22:45','',NULL),(8,15,'P','2022-10-22 01:58:35','',NULL),(9,15,'P','2022-10-22 01:59:36','',NULL),(10,15,'P','2022-10-22 02:00:31','',NULL),(11,15,'P','2022-10-22 02:01:08','',NULL),(12,15,'P','2022-10-22 02:01:51','',NULL),(13,15,'P','2022-10-22 02:16:18','',NULL),(14,15,'P','2022-10-22 02:17:34','',NULL),(15,15,'P','2022-10-22 20:13:49','',NULL),(16,NULL,'P','2022-10-22 20:48:11',NULL,NULL),(17,NULL,'P','2022-10-22 20:49:36',NULL,NULL),(18,NULL,'P','2022-10-22 20:49:40',NULL,NULL),(19,NULL,'P','2022-10-22 20:52:28',NULL,NULL),(20,NULL,'P','2022-10-22 20:52:44',NULL,NULL),(21,NULL,'P','2022-10-22 20:56:25',NULL,NULL),(22,NULL,'P','2022-11-04 21:53:11','',NULL),(23,20,'P','2022-11-07 21:41:12','',NULL),(24,32,'P','2022-11-16 11:20:18','',NULL),(25,NULL,'P','2022-11-18 21:15:46','',NULL),(26,15,'P','2022-11-18 21:16:15','',NULL),(27,NULL,'P','2022-11-18 21:18:28','',NULL),(28,NULL,'P','2022-11-18 21:18:52','',NULL),(29,NULL,'P','2022-11-18 21:21:02','',NULL),(30,NULL,'P','2022-11-18 21:21:07','',NULL),(31,13,'P','2022-11-18 21:24:35','',NULL),(32,15,'P','2022-11-18 21:24:56','',NULL),(33,20,'P','2022-11-18 21:26:56','',NULL),(34,26,'P','2022-11-18 21:27:34','',NULL),(35,NULL,'P','2022-11-18 21:28:18','',NULL),(36,15,'P','2022-11-18 21:28:26','',NULL),(37,15,'P','2022-11-18 21:28:32','',NULL),(38,15,'P','2022-11-18 21:35:59','',NULL),(39,NULL,'P','2022-11-29 19:49:00',NULL,NULL),(40,NULL,'P','2022-11-29 19:52:15',NULL,NULL),(41,NULL,'P','2022-11-29 19:52:45',NULL,NULL),(42,NULL,'P','2022-11-29 19:54:20',NULL,NULL),(43,NULL,'P','2022-11-29 19:54:23',NULL,NULL),(44,NULL,'P','2022-11-29 19:55:18',NULL,NULL),(45,NULL,'P','2022-11-30 20:27:31',NULL,NULL),(46,NULL,'P','2022-11-30 20:41:18',NULL,NULL),(47,NULL,'P','2022-11-30 20:42:51',NULL,NULL),(48,NULL,'P','2022-11-30 20:43:35',NULL,NULL),(49,NULL,'P','2022-11-30 20:44:36',NULL,NULL),(50,NULL,'P','2022-11-30 23:03:31',NULL,NULL),(52,NULL,'P','2022-12-03 18:30:51',NULL,NULL),(53,20,'P','2022-12-03 18:51:57','cliente teste',1),(54,50,'P','2022-12-03 18:53:34','procedure',1),(55,20,'P','2022-12-03 18:54:52','cliente',1),(56,20,'P','2022-12-03 18:57:43','nome',3),(57,20,'P','2022-12-04 18:57:41','teste',1),(58,20,'P','2022-12-04 18:59:46','cliente',3),(59,20,'P','2022-12-04 19:02:33','teste',1),(60,20,'P','2022-12-04 19:54:11','teste',1),(61,20,'P','2022-12-04 19:54:57','teste',1),(62,20,'P','2022-12-04 19:57:52','cliente',1),(63,20,'P','2022-12-04 20:18:15','cliente teste',1),(64,NULL,'P','2022-12-06 14:08:33','',NULL),(65,NULL,'P','2022-12-10 12:55:18','',NULL),(66,20,'P','2022-12-13 14:50:46','teste',1),(67,NULL,'P','2022-12-13 14:50:46',NULL,NULL),(68,20,'P','2022-12-13 14:51:52','cliente',1),(69,NULL,'P','2022-12-13 14:51:52',NULL,NULL),(71,NULL,'P','2022-12-13 15:04:24',NULL,NULL),(72,NULL,'P','2022-12-13 15:06:03',NULL,NULL),(73,45,'P','2022-12-13 15:07:00','cliente',1),(74,NULL,'P','2022-12-13 15:07:00',NULL,NULL),(75,20,'P','2022-12-13 15:10:56','cliente',1),(76,NULL,'P','2022-12-13 15:10:56',NULL,NULL),(77,20,'P','2022-12-13 15:12:03','cliente',1),(78,NULL,'P','2022-12-13 15:12:04',NULL,NULL),(79,60,'P','2022-12-13 16:25:52','cliente',1),(80,52,'P','2022-12-13 16:32:49','bernardo',1),(81,51,'P','2022-12-13 21:05:50','cliente teste',1),(82,114,'P','2022-12-13 21:10:58','Gabriel',1),(83,25.5,'P','2022-12-13 21:20:16','cliente',1),(88,26,'P','2022-12-13 21:42:24','cliente',1),(89,25.5,'P','2022-12-13 21:45:06','cliente',1),(90,25.5,'P','2022-12-13 21:45:49','cliente',1),(91,25.5,'P','2022-12-13 21:50:30','cliente',1),(92,31.5,'P','2022-12-13 21:52:08','cliente',3),(93,135.5,'P','2022-12-13 21:53:15','cliente',1),(94,40,'P','2022-12-13 21:57:53','cliente',1),(95,25.5,'P','2022-12-13 21:59:40','cliente',1),(96,31,'P','2022-12-13 22:00:25','teste',1),(97,20,'P','2022-12-13 22:07:28','cliente',1),(101,20,'P','2022-12-13 22:13:09','',1),(103,20,'P','2022-12-13 22:18:08','cliente',1),(105,20,'P','2022-12-13 22:21:53','cliente',1),(107,NULL,'P','2022-12-13 22:38:34',NULL,NULL),(108,NULL,'P','2022-12-13 22:39:26',NULL,NULL),(110,20,'P','2022-12-13 22:44:46','cliente',1),(111,40,'P','2022-12-13 22:47:47','teste',1),(112,40,'P','2022-12-13 22:49:10','cliente',1),(113,90,'P','2022-12-13 22:50:08','teste',1),(114,83.5,'P','2022-12-13 22:51:31','cliente',1),(115,62,'P','2022-12-13 22:53:17','cliente',1),(116,77.5,'P','2022-12-13 22:55:18','cliente',1),(117,67.5,'P','2022-12-14 00:02:54','cliente',1),(118,20,'P','2022-12-14 00:08:38','cliente',1),(120,20,'P','2022-12-14 00:12:37','cliente',1),(121,20,'P','2022-12-14 00:13:03','cliente',1),(122,22,'P','2022-12-14 00:13:21','cliente',1),(124,25.5,'P','2022-12-14 00:20:50','cliente',1),(125,20,'P','2022-12-14 00:23:49','cliente',1),(126,20,'P','2022-12-16 15:37:20','cliente',1),(127,25.5,'P','2022-12-16 15:38:34','cliente',1),(128,20,'P','2022-12-16 15:42:21','cliente',3),(129,20,'P','2022-12-16 15:42:41','cliente',1),(130,25.5,'P','2022-12-16 15:43:00','cliente',1),(131,20,'P','2022-12-16 15:43:15','cliente',1),(132,20,'P','2022-12-16 15:43:48','cliente',1),(133,20,'P','2022-12-16 15:58:38','cliente',1),(134,24,'P','2022-12-19 20:10:56','teste',1),(135,97,'P','2022-12-19 20:16:58','cliente',1),(136,95,'P','2022-12-19 20:21:41','cliente',1),(137,46,'A','2022-12-19 20:24:30','cliente',1),(138,25.5,'A','2022-12-19 20:34:43','teste',1);
/*!40000 ALTER TABLE `comandas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comandas-caixas`
--

DROP TABLE IF EXISTS `comandas-caixas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comandas-caixas` (
  `idcomandacaixa` int(11) NOT NULL AUTO_INCREMENT,
  `idcomanda` int(11) NOT NULL,
  `idcaixa` int(11) NOT NULL,
  PRIMARY KEY (`idcomandacaixa`),
  KEY `FK_comanda_caixa` (`idcomanda`),
  KEY `FK_caixa_comanda` (`idcaixa`),
  CONSTRAINT `idcaixacomanda` FOREIGN KEY (`idcaixa`) REFERENCES `caixa` (`idcaixa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idcomandacaixa` FOREIGN KEY (`idcomanda`) REFERENCES `comandas` (`idcomanda`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comandas-caixas`
--

LOCK TABLES `comandas-caixas` WRITE;
/*!40000 ALTER TABLE `comandas-caixas` DISABLE KEYS */;
/*!40000 ALTER TABLE `comandas-caixas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredienteadicional`
--

DROP TABLE IF EXISTS `ingredienteadicional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingredienteadicional` (
  `idingredienteadicional` int(11) NOT NULL AUTO_INCREMENT,
  `idcomanda` int(11) NOT NULL,
  `idproduto` int(11) NOT NULL,
  `qtdingredienteadicional` int(11) DEFAULT NULL,
  `idingrediente` int(11) DEFAULT NULL,
  PRIMARY KEY (`idingredienteadicional`),
  UNIQUE KEY `idingredienteadicional_UNIQUE` (`idingredienteadicional`),
  KEY `idprodutoingredienteadicional_idx` (`idproduto`),
  KEY `idcomandaingredienteadicional_idx` (`idcomanda`),
  KEY `idingredienteadc_idx` (`idingrediente`),
  CONSTRAINT `idcomandaingredienteadicional` FOREIGN KEY (`idcomanda`) REFERENCES `comandas` (`idcomanda`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idingredienteadc` FOREIGN KEY (`idingrediente`) REFERENCES `ingredientes` (`idingrediente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idprodutoingredienteadicional` FOREIGN KEY (`idproduto`) REFERENCES `produtos` (`idproduto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredienteadicional`
--

LOCK TABLES `ingredienteadicional` WRITE;
/*!40000 ALTER TABLE `ingredienteadicional` DISABLE KEYS */;
INSERT INTO `ingredienteadicional` VALUES (1,79,4,1,NULL),(2,79,4,1,NULL),(3,89,4,1,NULL),(4,90,4,1,NULL),(5,91,4,1,NULL),(6,92,4,1,NULL),(7,93,4,1,NULL),(8,95,4,1,NULL),(9,115,7,1,NULL),(10,116,4,1,NULL),(11,117,34,1,8),(12,124,34,1,8),(13,127,34,1,8),(14,135,27,1,5),(15,137,33,1,13),(16,138,34,1,8);
/*!40000 ALTER TABLE `ingredienteadicional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredientes`
--

DROP TABLE IF EXISTS `ingredientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingredientes` (
  `idingrediente` int(11) NOT NULL AUTO_INCREMENT,
  `nomeingrediente` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `valoradicional` float DEFAULT NULL,
  `ativo` int(11) DEFAULT 1,
  PRIMARY KEY (`idingrediente`),
  UNIQUE KEY `idingrediente_UNIQUE` (`idingrediente`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredientes`
--

LOCK TABLES `ingredientes` WRITE;
/*!40000 ALTER TABLE `ingredientes` DISABLE KEYS */;
INSERT INTO `ingredientes` VALUES (1,'catupiry',2,0),(2,'tomate',0,1),(3,'milho',0,1),(4,'ervilha',5.5,1),(5,'hamburguer',5,1),(6,'Frango',6,1),(7,'catupiry',2,1),(8,'pão',0,1),(9,'maionese',0,1),(10,'ketchup',0,1),(11,'cheddar',0,1),(12,'cebola',0,1),(13,'ovo',2,1);
/*!40000 ALTER TABLE `ingredientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mesas`
--

DROP TABLE IF EXISTS `mesas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mesas` (
  `idmesa` int(11) NOT NULL AUTO_INCREMENT,
  `livre` int(11) NOT NULL,
  `exibe` int(11) NOT NULL,
  PRIMARY KEY (`idmesa`),
  UNIQUE KEY `idmesa_UNIQUE` (`idmesa`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mesas`
--

LOCK TABLES `mesas` WRITE;
/*!40000 ALTER TABLE `mesas` DISABLE KEYS */;
INSERT INTO `mesas` VALUES (1,1,1),(2,1,0),(3,1,0),(4,1,0),(5,1,0),(6,1,0),(7,1,0);
/*!40000 ALTER TABLE `mesas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `porcao-extra`
--

DROP TABLE IF EXISTS `porcao-extra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `porcao-extra` (
  `idporcaoextra` int(11) NOT NULL AUTO_INCREMENT,
  `idcomanda` int(11) NOT NULL,
  `idproduto` int(11) NOT NULL,
  `qtdporcaoextra` int(11) DEFAULT NULL,
  `idingrediente` int(11) DEFAULT NULL,
  PRIMARY KEY (`idporcaoextra`),
  KEY `idcomandaporcaoextra_idx` (`idcomanda`),
  KEY `idprodutoporcaoextra_idx` (`idproduto`),
  KEY `idingredienteporcaoextra_idx` (`idingrediente`),
  CONSTRAINT `idcomandaporcaoextra` FOREIGN KEY (`idcomanda`) REFERENCES `comandas` (`idcomanda`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idingredienteporcaoextra` FOREIGN KEY (`idingrediente`) REFERENCES `ingredientes` (`idingrediente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idprodutoporcaoextra` FOREIGN KEY (`idproduto`) REFERENCES `produtos` (`idproduto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `porcao-extra`
--

LOCK TABLES `porcao-extra` WRITE;
/*!40000 ALTER TABLE `porcao-extra` DISABLE KEYS */;
INSERT INTO `porcao-extra` VALUES (1,79,8,2,NULL),(2,81,12,3,NULL),(3,81,11,2,NULL),(4,81,6,2,NULL),(5,82,13,2,NULL),(6,79,8,2,NULL),(7,83,8,2,NULL),(8,88,11,2,NULL),(9,88,6,2,NULL),(10,88,8,3,NULL),(11,89,8,3,NULL),(12,90,8,2,NULL),(13,91,8,2,NULL),(14,92,6,2,NULL),(15,93,12,2,NULL),(16,93,8,2,NULL),(17,95,8,2,NULL),(18,96,8,2,NULL),(19,115,8,2,NULL),(20,116,6,3,NULL),(21,116,8,5,NULL),(22,117,34,2,8),(23,117,32,2,13),(24,121,34,2,8),(25,124,34,2,8),(26,125,34,2,8),(27,127,34,2,8),(28,131,34,2,8),(29,135,27,2,5),(30,136,27,2,5),(31,137,33,2,13),(32,137,32,2,13),(33,138,34,2,8);
/*!40000 ALTER TABLE `porcao-extra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto-ingredientes`
--

DROP TABLE IF EXISTS `produto-ingredientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produto-ingredientes` (
  `idprodutoingrediente` int(11) NOT NULL AUTO_INCREMENT,
  `idproduto` int(11) NOT NULL,
  `idingrediente` int(11) NOT NULL,
  PRIMARY KEY (`idprodutoingrediente`),
  KEY `FK_produto_ingrediente` (`idproduto`),
  KEY `FK_ingrediente_produto` (`idingrediente`),
  CONSTRAINT `idingredienteproduto` FOREIGN KEY (`idingrediente`) REFERENCES `ingredientes` (`idingrediente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idprodutoingrediente` FOREIGN KEY (`idproduto`) REFERENCES `produtos` (`idproduto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto-ingredientes`
--

LOCK TABLES `produto-ingredientes` WRITE;
/*!40000 ALTER TABLE `produto-ingredientes` DISABLE KEYS */;
INSERT INTO `produto-ingredientes` VALUES (4,25,6),(16,29,4),(17,29,6),(18,31,4),(19,31,6),(20,15,6),(21,15,3),(22,15,2),(23,19,2),(29,28,4),(30,28,6),(31,28,5),(32,28,10),(33,28,9),(34,28,3),(35,28,13),(36,28,8),(37,28,2),(46,32,4),(47,32,6),(48,32,5),(49,32,10),(50,32,9),(51,32,3),(52,32,13),(53,32,8),(54,32,2),(55,33,12),(56,33,4),(57,33,5),(58,33,10),(59,33,9),(60,33,3),(61,33,13),(62,33,8),(63,33,2),(64,34,7),(65,34,12),(66,34,11),(67,34,6),(68,34,8),(69,24,6),(70,24,5),(71,24,10),(72,24,2),(73,27,4),(74,27,6),(75,27,5),(76,26,4),(77,26,6),(78,26,5),(79,26,10);
/*!40000 ALTER TABLE `produto-ingredientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto-tipo`
--

DROP TABLE IF EXISTS `produto-tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produto-tipo` (
  `idprodutotipo` int(11) NOT NULL AUTO_INCREMENT,
  `idproduto` int(11) NOT NULL,
  `idtipo` int(11) NOT NULL,
  PRIMARY KEY (`idprodutotipo`),
  KEY `FK_produto_tipo` (`idproduto`),
  KEY `FK_tipo_produto` (`idtipo`),
  CONSTRAINT `idprodutotipo` FOREIGN KEY (`idproduto`) REFERENCES `produtos` (`idproduto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idtipoproduto` FOREIGN KEY (`idtipo`) REFERENCES `tipos` (`idtipo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto-tipo`
--

LOCK TABLES `produto-tipo` WRITE;
/*!40000 ALTER TABLE `produto-tipo` DISABLE KEYS */;
INSERT INTO `produto-tipo` VALUES (1,7,13),(2,7,6),(3,8,13),(5,9,13),(7,10,13),(9,15,6),(11,19,9),(12,24,6),(13,25,13),(14,26,6),(15,27,13),(16,28,13),(17,29,6),(18,30,15),(19,31,15),(20,32,6),(21,33,13),(22,34,16);
/*!40000 ALTER TABLE `produto-tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `idproduto` int(11) NOT NULL AUTO_INCREMENT,
  `nomeproduto` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `valorproduto` float DEFAULT NULL,
  `ativo` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idproduto`),
  UNIQUE KEY `idproduto_UNIQUE` (`idproduto`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,'teste',12,1),(2,'teste',12,1),(3,'teste2',1,1),(4,'teste3',12,1),(5,'teste',13,1),(6,'teste5',1,1),(7,'xis frango',12,0),(8,'produto 6',1,0),(9,'produto 6',1,0),(10,'produto 6',1,0),(11,'1234',1,1),(12,'1234',1,1),(13,'1234',1,1),(14,'1234',1,1),(15,'produto editado',50,1),(16,'test9',1,1),(17,'test9',1,1),(18,'test9',1,1),(19,'segunda edição',12.5,0),(20,'',0,1),(21,'',0,1),(22,'',0,1),(23,'',0,1),(24,'prdt edt',10,1),(25,'xis frango',10,0),(26,'dog frango',11,1),(27,'xis misto',90,1),(28,'produto50',25,1),(29,'taskinho',10000,0),(30,'Agua com gas',5,0),(31,'new',20,0),(32,'Dog Frango',20,1),(33,'xis completo',20,1),(34,'baguete de frango',20,1);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `removeringrediente`
--

DROP TABLE IF EXISTS `removeringrediente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `removeringrediente` (
  `idremoveringrediente` int(11) NOT NULL AUTO_INCREMENT,
  `idcomanda` int(11) NOT NULL,
  `idproduto` int(11) NOT NULL,
  `idingrediente` int(11) NOT NULL,
  PRIMARY KEY (`idremoveringrediente`),
  KEY `idcomandaremoveringrediente_idx` (`idcomanda`),
  KEY `idprodutoremoveringrediente_idx` (`idproduto`),
  KEY `idingredienteremovido_idx` (`idingrediente`),
  CONSTRAINT `idcomandaremoveringrediente` FOREIGN KEY (`idcomanda`) REFERENCES `comandas` (`idcomanda`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idprodutoremoveringrediente` FOREIGN KEY (`idproduto`) REFERENCES `produtos` (`idproduto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `removeringrediente`
--

LOCK TABLES `removeringrediente` WRITE;
/*!40000 ALTER TABLE `removeringrediente` DISABLE KEYS */;
INSERT INTO `removeringrediente` VALUES (1,79,6,0),(2,79,6,0),(3,91,6,0),(4,92,7,0),(5,93,6,0),(6,95,6,0),(7,115,6,0),(8,116,11,0),(9,116,13,0),(10,8,34,117),(11,124,34,8),(12,127,34,8),(13,131,34,8),(14,135,27,5),(15,136,27,5),(16,137,33,13),(17,137,32,13),(18,138,34,8);
/*!40000 ALTER TABLE `removeringrediente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos`
--

DROP TABLE IF EXISTS `tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos` (
  `idtipo` int(11) NOT NULL AUTO_INCREMENT,
  `nometipo` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `ativo` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idtipo`),
  UNIQUE KEY `idtipoproduto_UNIQUE` (`idtipo`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos`
--

LOCK TABLES `tipos` WRITE;
/*!40000 ALTER TABLE `tipos` DISABLE KEYS */;
INSERT INTO `tipos` VALUES (1,'xis',0),(6,'Dog',1),(7,'Porção',1),(8,'Refrigerante',1),(9,'Xis Gourmet',1),(10,'Cerveja',1),(11,'Sanduíche',0),(12,'Drinks',1),(13,'Xis',1),(14,'Sanduíche',0),(15,'Bebida',1),(16,'Baguete',1);
/*!40000 ALTER TABLE `tipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `passhash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `ativo` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `idusuarios_UNIQUE` (`idusuario`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `nome_UNIQUE` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'db_lachapa'
--
/*!50003 DROP PROCEDURE IF EXISTS `sp_salva_comanda` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_salva_comanda`(

`pidcomanda` int(11),
`pvalortotal` float,
`pstatuscomanda` varchar(1),
`pdatacomanda` timestamp,
`pnomecliente` varchar(45),
`pidatendente` int(11)

)
BEGIN

	IF pidcomanda > 0 THEN
		UPDATE comandas
			SET 
				idcomanda = pidcomanda,
				valortotal = pvalortotal,
				statuscomanda = pstatuscomanda,
                datacomanda = pdatacomanda,
                nomecliente = pnomecliente,
                idatendente = pidatendente
			WHERE  idcomanda = pidcomanda;
	ELSE
		INSERT INTO `db_lachapa`.`comandas` (`valortotal`, `nomecliente`, `idatendente`)
		VALUES (pvalortotal, pnomecliente, pidatendente);
        
        SET pidcomanda = LAST_INSERT_ID();
	END IF;
    
    SELECT * FROM comandas WHERE idcomanda = pidcomanda;  

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_salva_comanda_mesa` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_salva_comanda_mesa`(

`pidcomandamesa` int(11),
`pidcomanda` int(11),
`pidmesa` int(11)
)
BEGIN

	IF pidcomandamesa > 0 THEN
		UPDATE `comanda-mesa`
			SET
				idcomandamesa = pdicomandamesa,
                idcomanda = pidcomanda,
                idmesa = pidmesa
			WHERE idcomandamesa = pidcomandamesa;
	ELSE
		INSERT INTO `comanda-mesa` (idcomanda, idmesa) VALUES (pidcomanda, pidmesa);
        
        SET pidcomandamesa = LAST_INSERT_ID();
	END IF;
    
    SELECT * FROM `comanda-mesa` WHERE idcomandamesa = pidcomandamesa;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_salva_comanda_produtos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_salva_comanda_produtos`(

`pidcomandaproduto` int(11),
`pidcomanda` int(11),
`pidproduto` int(11),
`pvlfinalproduto` float
)
BEGIN

	IF pidcomandaproduto > 0 THEN
		UPDATE `comanda-produtos`
			SET 
				idcomandaproduto = pidcomandaproduto,
				idcomanda = pidcomanda,
				idproduto = pidproduto,
                vlfinalproduto = pvlfinalproduto
			WHERE  idcomandaproduto = pidcomandaproduto;
	ELSE
		INSERT INTO `db_lachapa`.`comanda-produtos` (`idcomanda`, `idproduto`, `vlfinalproduto`)
		VALUES (pidcomanda, pidproduto, pvlfinalproduto);
        
        SET pidcomandaproduto = LAST_INSERT_ID();
	END IF;
    
    SELECT * FROM `comanda-produtos` WHERE idcomandaproduto = pidcomandaproduto; 


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_salva_ingrediente_adicional` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_salva_ingrediente_adicional`(


`pidingredienteadicional` int(11),
`pidproduto` int(11),
`pidcomanda` int(11),
`pidingrediente` int(11),
`pqtdingredienteadicional` int(11)

)
BEGIN

IF `pidingredienteadicional` > 0 THEN
		UPDATE `ingredienteadicional`
			SET 
				`idingredienteadicional` = `pidingredienteadicional`,
				`idproduto` = `pidproduto`,
				`idcomanda` = `pidcomanda`,
                `idingrediente` = `pidingrediente`,
				`qtdingredienteadicional` = `pqtdingredienteadicional`;
	ELSE 
		INSERT INTO `db_lachapa`.`ingredienteadicional`
						(`idproduto`,
						`idcomanda`,
                        `idingrediente`,
						`qtdingredienteadicional`)
		VALUES
						(pidproduto,
						pidcomanda,
                        pidingrediente,
						pqtdingredienteadicional);
		
        SET `pidingredienteadicional` = LAST_INSERT_ID();
        
        END IF;
        
	SELECT * FROM `ingredienteadicional` WHERE `idingredienteadicional` = `pidingredienteadicional`;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_salva_porcao_extra` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_salva_porcao_extra`(


`pidporcaoextra` int(11),
`pidproduto` int(11),
`pidcomanda` int(11),
`pidingrediente` int(11),
`pqtdporcaoextra` int(11)

)
BEGIN

IF `pidporcaoextra` > 0 THEN
		UPDATE `porcao-extra`
			SET 
				`idporcaoextra` = `pidporcaoextra`,
				`idproduto` = `pidproduto`,
				`idcomanda` = `pidcomanda`,
                `idingrediente` = `pidingrediente`,
				`qtdporcaoextra` = `pqtdporcaoextra`;
	ELSE 
		INSERT INTO `db_lachapa`.`porcao-extra`
						(`idproduto`,
						`idcomanda`,
                        `idingrediente`,
						`qtdporcaoextra`)
		VALUES
						(pidproduto,
						pidcomanda,
                        pidingrediente,
						pqtdporcaoextra);
		
        SET `pidporcaoextra` = LAST_INSERT_ID();
        
        END IF;
        
	SELECT * FROM `porcao-extra` WHERE `idporcaoextra` = `pidporcaoextra`;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_salva_produtos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_salva_produtos`(

`pidproduto` int(11),
`pnomeproduto` varchar(45),
`pvalorproduto` float,
`pativo` int(11)

)
BEGIN

	IF pidproduto > 0 THEN
		UPDATE produtos
			SET 
				nomeproduto = pnomeproduto,
				valorproduto = pvalorproduto,
				ativo = pativo
			WHERE  idproduto = pidproduto;
	ELSE
		INSERT INTO `db_lachapa`.`produtos` (`nomeproduto`,`valorproduto`,`ativo`)
		VALUES (pnomeproduto, pvalorproduto, 1);
        
        SET pidproduto = LAST_INSERT_ID();
	END IF;
    
    SELECT * FROM produtos WHERE idproduto = pidproduto;    

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_salva_removeringrediente` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_salva_removeringrediente`(


`pidremoveringrediente` int(11),
`pidproduto` int(11),
`pidcomanda` int(11),
`pidingrediente` int(11)

)
BEGIN

IF `pidremoveringrediente` > 0 THEN
		UPDATE `removeringrediente`
			SET 
				`idremoveringrediente` = `pidremoveringrediente`,
				`idproduto` = `pidproduto`,
				`idcomanda` = `pidcomanda`,
                `idingrediente` = `pidingrediente`;
	ELSE 
		INSERT INTO `db_lachapa`.`removeringrediente`
						(`idproduto`,
						`idcomanda`,
                        `idingrediente`)
		VALUES
						(pidproduto,
						pidcomanda,
                        pidingrediente);
		
        SET `pidremoveringrediente` = LAST_INSERT_ID();
        
        END IF;
        
	SELECT * FROM `removeringrediente` WHERE `idremoveringrediente` = `pidremoveringrediente`;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-19 17:35:29
