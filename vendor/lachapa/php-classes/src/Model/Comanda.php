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


    public function salvaProdutosComanda()
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

    // public function salvaTeste($id)
    // {
    //     $sql = new Sql;
    //     $result = $sql->select('CALL `db_lachapa`.`new_procedure` (:idtable_teste, :id)',[
    //         ':idtable_teste' => 0,
    //         ':id' => $id
    //     ]);

    //     return $result[0];
    // }
}
