<?php

namespace LaChapa\Model;

use LaChapa\Model;
use LaChapa\DB\Sql;

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
}