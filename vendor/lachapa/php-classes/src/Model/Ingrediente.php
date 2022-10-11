<?php

namespace LaChapa\Model;

use LaChapa\DB\Sql;
use LaChapa\Model;


class Ingrediente extends Model
{
    public function salvaIngrediente()
    {
        $sql = new Sql;

        $sql->query('INSERT INTO ingredientes
        (`nomeingrediente`,
        `valoradicional`)
        VALUES
        (:nomeingrediente,
        :valoradicional)',[
            ':nomeingrediente'=>$this->getnomeingrediente(),
            'valoradicional'=>$this->getvaloradicional()
        ]);
    }

    public static function listaIngredientes()
    {
        $sql = new Sql;

        return $sql->select('SELECT * FROM ingredientes WHERE ativo = 1 ORDER BY nomeingrediente'); 
    }

    public function deletarIngrediente($idingrediente)
    {
        $sql = new Sql;

        $sql->query('UPDATE `db_lachapa`.`ingredientes`
        SET
        `ativo` = 0
        WHERE `idingrediente` = :idingrediente',[
            ':idingrediente'=>$idingrediente
        ]);

    }

    public function updateIngrediente($idingrediente)
    {
        $sql = new Sql;

        $sql->query('UPDATE `db_lachapa`.`ingredientes`
        SET
        `nomeingrediente` = :nomeingrediente,
        `valoradicional` = :valoradicional
        WHERE `idingrediente` = :idingrediente',[
            'nomeingrediente'=>$this->getnomeingrediente(),
            'valoradicional'=>$this->getvaloradicional(),
            'idingrediente'=>$idingrediente
        ]);
    }

}
