
                      -- PROCEDURE SALVA PRODUTOS
-- CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_salva_produtos`(

-- `pidproduto` int(11),
-- `pnomeproduto` varchar(45),
-- `pvalorproduto` float,
-- `pativo` int(11)

-- )
-- BEGIN

-- 	IF pidproduto > 0 THEN
-- 		UPDATE produtos
-- 			SET 
-- 				nomeproduto = pnomeproduto,
-- 				valorproduto = pvalorproduto,
-- 				ativo = pativo
-- 			WHERE  idproduto = pidproduto;
-- 	ELSE
-- 		INSERT INTO `db_lachapa`.`produtos` (`nomeproduto`,`valorproduto`,`ativo`)
-- 		VALUES (pnomeproduto, pvalorproduto, 1);
        
--         SET pidproduto = LAST_INSERT_ID();
-- 	END IF;
    
--     SELECT * FROM produtos WHERE idproduto = pidproduto;    

-- END



-------------------------------------------------------

                        -----PROCEDURE SALVA COMANDA
-- CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_salva_comanda`(

-- `pidcomanda` int(11),
-- `pvalortotal` float,
-- `pstatuscomanda` varchar(1),
-- `pdatacomanda` timestamp,
-- `pnomecliente` varchar(45)

-- )
-- BEGIN

-- 	IF pidcomanda > 0 THEN
-- 		UPDATE comandas
-- 			SET 
-- 				idcomanda = pidcomanda,
-- 				valortotal = pvalortotal,
-- 				statuscomanda = pstatuscomanda,
--                 datacomanda = pdatacomanda,
--                 nomecliente = pnomecliente                
-- 			WHERE  idcomanda = pidcomanda;
-- 	ELSE
-- 		INSERT INTO `db_lachapa`.`comandas` (`valortotal`, `nomecliente`)
-- 		VALUES (pvalortotal, pnomecliente);
        
--         SET pidcomanda = LAST_INSERT_ID();
-- 	END IF;
    
--     SELECT * FROM comandas WHERE idcomanda = pidcomanda;  

-- END