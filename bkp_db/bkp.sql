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
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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

-- Dump completed on 2022-12-19 18:31:25
