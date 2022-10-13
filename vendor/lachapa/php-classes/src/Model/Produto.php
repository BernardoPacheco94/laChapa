<?php

namespace LaChapa\Model;

use LaChapa\Model;
use LaChapa\DB\Sql;

class Produto extends Model{
    
    public function salvaProduto()
    {
        $sql = new Sql;

        $sql->query('INSERT INTO `db_lachapa`.`produtos`
        (`nomeproduto`,
        `valorproduto`)
        VALUES
        (:nomeproduto,
        :valorproduto)',[
            'nomeproduto'=>$this->getnomeproduto(),
            'valorproduto'=>$this->getvalorproduto()
        ]);
        
    }

    public function addTipo($idtipo)
    {
        $sql = new Sql;

        $sql->query('INSERT INTO `db_lachapa`.`produto-tipo`
        (`idproduto`,
        `idtipo`)
        VALUES
        (:idproduto,
        :idtipo)',[
            ':idproduto'=>$this->getidproduto(),
            ':idtipo'=>$idtipo
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