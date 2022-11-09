<?php

namespace LaChapa\Model;

use LaChapa\Model;
use LaChapa\DB\Sql;

class Comanda extends Model
{
    public function salvaComanda()
    {
        $sql = new Sql;

        $result = $sql->select('CALL `db_lachapa`.`sp_salva_comanda`(:idcomanda, :valortotal, :statuscomanda, :datacomanda, :nomecliente, :idatendente)', [
            ':idcomanda' => $this->getidcomanda(),
            ':valortotal' => $this->getvalortotal(),
            ':statuscomanda' => $this->getstatuscomanda(),
            ':datacomanda' => $this->getdatacomanda(),
            ':nomecliente' => $this->getnomecliente(),
            ':idatendente' => $this->getidatendente()
        ]);

        return $this->setData($result[0]);
    }


    public function salvaProduosComanda()
    {
        $sql = new Sql;

        $sql->query('INSERT INTO `db_lachapa`.`comanda-produtos`
    (`idcomanda`,
    `idproduto`)
    VALUES
    (:idcomanda,
    :idproduto);', [
            ':idcomanda' => $this->getidcomanda(),
            ':idproduto' => $this->getidproduto()
        ]);
    }
}
