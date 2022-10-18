<?php

namespace LaChapa\Model;

use LaChapa\Model;
use LaChapa\DB\Sql;
use LDAP\Result;

class Produto extends Model{
    
    public function salvaProduto()
    {
        $sql = new Sql;

        $resultado = $sql->select('CALL `db_lachapa`.`sp_salva_produtos`(:idproduto, :nomeproduto, :valorproduto, :ativo);',[
            'idproduto'=>$this->getidproduto(),
            'nomeproduto'=>$this->getnomeproduto(),
            'valorproduto'=>$this->getvalorproduto(),
            'ativo'=>1
        ]);

        return $this->setData($resultado[0]);        
    }

    public function addTipo(Tipo $tipo)
    {
        $sql = new Sql;

        $sql->query('INSERT INTO `db_lachapa`.`produto-tipo`
        (`idproduto`,
        `idtipo`)
        VALUES
        (:idproduto,
        :idtipo)',[
            ':idproduto'=>$this->getidproduto(),
            ':idtipo'=>$tipo->getidtipo()
        ]);
    }

    public function addIngrediente($idingrediente)
    {
        $sql = new Sql;

        $sql->query('INSERT INTO `db_lachapa`.`produto-ingredientes`
        (`idproduto`,
        `idingrediente`)
        VALUES
        (:idproduto,
        :idingrediente)',[
            ':idproduto'=>$this->getidproduto(),
            ':idingrediente'=>$idingrediente
        ]);
    }

    public function listaProdutos()
    {
        $sql = new Sql;

        
        $result = $sql->select('SELECT * 
        FROM produtos a
        INNER JOIN `produto-tipo` b USING (idproduto)
        INNER JOIN `tipos` c USING (idtipo)
        WHERE a.ativo = 1
        ');

        for($i=0; $i<(count($result)); $i++ )
        {
            array_push($result[$i], [
                'ingredientes'=>Produto::listaIngredientesProduto($result[$i]['idproduto'])
            ]);
        }

        return $result;

    }

    public static function listaIngredientesProduto($idproduto)
    {
        $sql = new Sql;

        $resultado = $sql->select('SELECT * 
        FROM produtos a
        INNER JOIN `produto-ingredientes` b USING (idproduto)
        INNER JOIN `ingredientes` c USING (idingrediente)
        WHERE b.idproduto= :idproduto AND a.ativo =1',[
            ':idproduto'=>$idproduto
        ]);

        $ingredientes =[];

        for ($i=0; $i < count($resultado) ; $i++) { 
            array_push($ingredientes, $resultado[$i]['nomeingrediente']);
        }

        return $ingredientes;
    }

    public function get($idproduto)
    {
        $sql = new Sql;

        $resultado = $sql->select('SELECT * FROM produtos WHERE idproduto = :idproduto',[
            'idproduto'=>$idproduto
        ]);

        return $this->setData($resultado[0]);
    }

    public function deletarProduto($idproduto)
    {
        $sql = new Sql;

        $sql->query('UPDATE `db_lachapa`.`produtos`
        SET
        `ativo` = 0
        WHERE `idproduto` = :idproduto',[
            ':idproduto'=>$idproduto
        ]);        
    }
}