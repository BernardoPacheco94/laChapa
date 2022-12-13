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
            ':statuscomanda' => 'A',
            ':datacomanda' => $this->getdatacomanda(),
            ':nomecliente' => $this->getnomecliente(),
            ':idatendente' => $this->getidatendente()
        ]);

        return $this->setData($result[0]);
    }


    public function salvaComandaProdutos($idproduto)
    {
        $sql = new Sql;

        $result = $sql->select('CALL `db_lachapa`.`sp_salva_comanda_produtos`(:idcomandaproduto, :idcomanda, :idproduto)',[
            ':idcomandaproduto' => $this->getidcomandaproduto(),
            ':idcomanda' => $this->getidcomanda(),
            ':idproduto' => $idproduto
        ]);

        return $result[0];
    }

    public function salvaComandaMesa()
    {
        $sql = new Sql;

        $result = $sql->select('CALL `db_lachapa`.`sp_salva_comanda_mesa`(:idcomandamesa, :idcomanda, :idmesa)',[
            ':idcomandamesa'=>0,
            ':idcomanda'=>$this->getidcomanda(),
            ':idmesa'=>$this->getidmesa()

        ]);

        return $this->setData($result[0]);
    }

}
