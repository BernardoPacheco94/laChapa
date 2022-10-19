
                      -- PROCEDURE
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