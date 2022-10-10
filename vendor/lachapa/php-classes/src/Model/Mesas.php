<?php

namespace LaChapa\Model;

use LaChapa\Model;
use LaChapa\DB\Sql;

class Mesas extends Model
{
    public static function exibeTodas()
    {
        $sql = new Sql;

        return $sql->select('SELECT * FROM mesas ORDER BY idmesa');
    }

    public static function exibeLivres()
    {
        $sql = new Sql;

        return $sql->select('SELECT * FROM mesas WHERE livre = :livre ORDER BY idmesa',[
            ':livre' => 1
        ]);
    }

    public static function exibeOcupadas()
    {
        $sql = new Sql;

        return $sql->select('SELECT * FROM mesas WHERE livre = :livre ORDER BY idmesa',[
            ':livre' => 0
        ]);
    }

    public function novaMesa()
    {
        $sql = new Sql;

        $sql->query('INSERT INTO `mesas`
        (`livre`,
        `exibe`)
        VALUES
        (:livre,
        :exibe)',[
            'livre'=> 1,
            'exibe'=> 1
        ]);

        // $this->setData($result[0]);
    }
}