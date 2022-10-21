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
-- Table structure for table `comanda-atendente`
--

DROP TABLE IF EXISTS `comanda-atendente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comanda-atendente` (
  `idcomandaatendente` int(11) NOT NULL AUTO_INCREMENT,
  `idatendente` int(11) DEFAULT NULL,
  `idcomanda` int(11) NOT NULL,
  PRIMARY KEY (`idcomandaatendente`),
  UNIQUE KEY `idcomandaatendente_UNIQUE` (`idcomandaatendente`),
  KEY `idcomandaatendente_idx` (`idcomanda`),
  KEY `idatendentecomanda_idx` (`idatendente`),
  CONSTRAINT `idatendentecomanda` FOREIGN KEY (`idatendente`) REFERENCES `atendentes` (`idatendente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idcomandaatendente` FOREIGN KEY (`idcomanda`) REFERENCES `comandas` (`idcomanda`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comanda-atendente`
--

LOCK TABLES `comanda-atendente` WRITE;
/*!40000 ALTER TABLE `comanda-atendente` DISABLE KEYS */;
/*!40000 ALTER TABLE `comanda-atendente` ENABLE KEYS */;
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
  `idmesa` int(11) NOT NULL,
  PRIMARY KEY (`idcomandamesa`),
  KEY `FX_comanda_mesa` (`idmesa`),
  KEY `FK_mesa_comanda` (`idcomanda`),
  CONSTRAINT `idcomandamesa` FOREIGN KEY (`idcomanda`) REFERENCES `comandas` (`idcomanda`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idmesacomanda` FOREIGN KEY (`idmesa`) REFERENCES `mesas` (`idmesa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comanda-mesa`
--

LOCK TABLES `comanda-mesa` WRITE;
/*!40000 ALTER TABLE `comanda-mesa` DISABLE KEYS */;
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
  PRIMARY KEY (`idcomandaproduto`),
  KEY `FK_produto_comanda` (`idcomanda`),
  KEY `FK_comanda_produto` (`idproduto`),
  CONSTRAINT `idcomanda` FOREIGN KEY (`idcomanda`) REFERENCES `comandas` (`idcomanda`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idproduto` FOREIGN KEY (`idproduto`) REFERENCES `produtos` (`idproduto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comanda-produtos`
--

LOCK TABLES `comanda-produtos` WRITE;
/*!40000 ALTER TABLE `comanda-produtos` DISABLE KEYS */;
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
  PRIMARY KEY (`idcomanda`),
  UNIQUE KEY `idcomanda_UNIQUE` (`idcomanda`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comandas`
--

LOCK TABLES `comandas` WRITE;
/*!40000 ALTER TABLE `comandas` DISABLE KEYS */;
INSERT INTO `comandas` VALUES (1,15,'A','2022-10-21 15:25:09','cliente');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mesas`
--

LOCK TABLES `mesas` WRITE;
/*!40000 ALTER TABLE `mesas` DISABLE KEYS */;
INSERT INTO `mesas` VALUES (1,1,1),(2,1,0),(3,1,0),(4,1,0),(5,1,0),(6,1,0);
/*!40000 ALTER TABLE `mesas` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto-ingredientes`
--

LOCK TABLES `produto-ingredientes` WRITE;
/*!40000 ALTER TABLE `produto-ingredientes` DISABLE KEYS */;
INSERT INTO `produto-ingredientes` VALUES (1,24,6),(2,24,5),(3,24,2),(4,25,6),(16,29,4),(17,29,6),(18,31,4),(19,31,6),(20,15,6),(21,15,3),(22,15,2),(23,19,2),(24,27,4),(25,27,6),(26,27,5),(27,26,6),(28,26,5),(29,28,4),(30,28,6),(31,28,5),(32,28,10),(33,28,9),(34,28,3),(35,28,13),(36,28,8),(37,28,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto-tipo`
--

LOCK TABLES `produto-tipo` WRITE;
/*!40000 ALTER TABLE `produto-tipo` DISABLE KEYS */;
INSERT INTO `produto-tipo` VALUES (1,7,13),(2,7,6),(3,8,13),(5,9,13),(7,10,13),(9,15,6),(11,19,9),(12,24,6),(13,25,13),(14,26,6),(15,27,13),(16,28,13),(17,29,6),(18,30,15),(19,31,15);
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,'teste',12,1),(2,'teste',12,1),(3,'teste2',1,1),(4,'teste3',12,1),(5,'teste',13,1),(6,'teste5',1,1),(7,'xis frango',12,0),(8,'produto 6',1,0),(9,'produto 6',1,0),(10,'produto 6',1,0),(11,'1234',1,1),(12,'1234',1,1),(13,'1234',1,1),(14,'1234',1,1),(15,'produto editado',50,1),(16,'test9',1,1),(17,'test9',1,1),(18,'test9',1,1),(19,'segunda edição',12.5,0),(20,'',0,1),(21,'',0,1),(22,'',0,1),(23,'',0,1),(24,'prdt',10,1),(25,'xis frango',10,1),(26,'dog frango',11,1),(27,'xis misto',90,1),(28,'produto50',25,1),(29,'taskinho',10000,1),(30,'Agua com gas',5,0),(31,'new',20,1);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos`
--

LOCK TABLES `tipos` WRITE;
/*!40000 ALTER TABLE `tipos` DISABLE KEYS */;
INSERT INTO `tipos` VALUES (1,'xis',0),(6,'Dog',1),(7,'Porção',1),(8,'Refrigerante',1),(9,'Xis Gourmet',1),(10,'Cerveja',1),(11,'Sanduíche',0),(12,'Drinks',1),(13,'Xis',1),(14,'Sanduíche',0),(15,'Bebida',1);
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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-10-21 12:26:27
