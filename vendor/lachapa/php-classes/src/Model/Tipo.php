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
}
