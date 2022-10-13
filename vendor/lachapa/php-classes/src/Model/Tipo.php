<?php

namespace LaChapa\Model;

use LaChapa\DB\Sql;
use LaChapa\Model;


class Tipo extends Model
{
    public function salvaTipo()
    {
        $sql = new Sql;

        $sql->query('INSERT INTO `db_lachapa`.`tipos`
        (`nometipo`)
        VALUES
        (:nometipo)',[
            ':nometipo'=>$this->getnometipo()
        ]);

    }

    public static function listaTipos()
    {
        $sql = new Sql;

        return $sql->select('SELECT * FROM tipos WHERE ativo = 1 ORDER BY nometipo'); 
    }

    public function deletarTipo($idtipo)
    {
        $sql = new Sql;

        $sql->query('UPDATE `db_lachapa`.`tipos`
        SET
        `ativo` = 0
        WHERE `idtipo` = :idtipo',[
            ':idtipo'=>$idtipo
        ]);

    }

    public function updateTipo($idtipo)
    {
        $sql = new Sql;

        $sql->query('UPDATE `db_lachapa`.`tipos`
        SET
        `nometipo` = :nometipo
        WHERE `idtipo` = :idtipo',[
            'nometipo'=>$this->getnometipo(),
            'idtipo'=>$idtipo
        ]);
    }

    public static function pesquisar($pesquisa)
    {
        $sql = new Sql;

        return $sql->select('SELECT * FROM tipos WHERE (nometipo LIKE :PESQUISA) AND ativo = 1',array(":PESQUISA"=>"%".$pesquisa."%"));
    }

}
