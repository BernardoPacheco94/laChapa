<?php

namespace LaChapa\Model;

use LaChapa\Model;
use LaChapa\DB\Sql;

class Comanda extends Model{
   public function novaComanda()
   {
    $sql = new Sql;

    $result = $sql->select('CALL `db_lachapa`.`sp_salva_comanda`(:idcomanda, :valortotal, :statuscomanda, :datacomanda, :nomecliente)',[
        ':idcomanda'=>$this->getidcomanda(),
        ':valortotal'=>$this->getvalortotal(),
        ':statuscomanda'=>$this->getstatuscomanda(),
        ':datacomanda'=>$this->getdatacomanda(),
        ':nomecliente'=>$this->getnomecliente()
    ]);

    return $this->setData($result[0]);
   }
}

