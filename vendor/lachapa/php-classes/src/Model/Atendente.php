<?php

namespace LaChapa\Model;

use LaChapa\Model;
use LaChapa\DB\Sql;

class Atendente extends Model
{
    public function salvaAtendente()
    {
        $sql = new Sql;

        $sql->query('INSERT INTO `db_lachapa`.`atendentes`
        (`nomeatendente`)
        VALUES
        (:nomeatendente)
        ',[
            ':nomeatendente'=>$this->getnomeatendente()
        ]);
    }

    public static function listaAtendentes()
    {
        $sql = new Sql;

        return $sql->select('SELECT * FROM atendentes WHERE ativo = 1 ORDER BY nomeatendente');        
    }


    public function deletarAtendente($idatendente)
    {
        $sql = new Sql;

        $sql->query('UPDATE `db_lachapa`.`atendentes`
        SET
        `ativo` = 0
        WHERE `idatendente` = :idatendente',[
            ':idatendente'=>$idatendente
        ]);

    }

    public function updateAtendente($idatendente)
    {
        $sql = new Sql;

        $sql->query('UPDATE `db_lachapa`.`atendentes`
        SET
        `nomeatendente` = :nomeatendente
        WHERE `idatendente` = :idatendente',[
            'nomeatendente'=>$this->getnomeatendente(),
            'idatendente'=>$idatendente
        ]);
    }
}