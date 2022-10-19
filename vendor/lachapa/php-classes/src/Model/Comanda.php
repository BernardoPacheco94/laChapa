<?php

namespace LaChapa\Model;

use LaChapa\Model;
use LaChapa\DB\Sql;

class Comanda extends Model{
   public function novaComanda()
   {
    $sql = new Sql;

    $result = $sql->select('CALL `db_lachapa`.`sp_salva_comanda`(`:idcomanda`, `:valortotal`, `status`, `data`, `nomecliente`)',[
        ':idcomanda'=>$this->getidcomanda(),
        ':valortotal'=>$this->getvalortotal(),
        ':status'=>$this->getstatus(),
        ':data'=>$this->getdata(),
        ':nomecliente'=>$this->getnomecliente()
    ]);

    return $this->setData($result[0]);
   }
}

