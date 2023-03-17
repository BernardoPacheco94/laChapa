<?php

namespace LaChapa\Model;

use LaChapa\Model;
use LaChapa\DB\Sql;

class Cartao extends Model
{
    public function salvaCartoes(int $inicial, int $final)
    {
        $sql = new Sql;

        for ($i = $inicial; $i <= $final; $i++) {

            $sql->query('INSERT INTO `db_lachapa`.`cartoes`
            (`numero`)
            VALUES
            (:numero)', [
                ':numero' => $i
            ]);
        }
    }

    public static function listaCartoes()
    {
        $sql = new Sql;

        return $sql->select('SELECT * FROM `db_lachapa`.`cartoes` WHERE `ativo` = 1');
    }

    public function deletarCartao($idcartao)
    {
        $sql = new Sql;

        $sql->query('UPDATE `db_lachapa`.`cartoes`
        SET
        `ativo` = 0 
        WHERE `idcartao` = :idcartao',
        [
            ':idcartao' =>$idcartao
        ]);
    }
}
