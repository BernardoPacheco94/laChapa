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


    public function salvaComandaProdutos($idproduto, $vlfinalproduto)
    {
        $sql = new Sql;

        $sql->select('CALL `db_lachapa`.`sp_salva_comanda_produtos`(:idcomandaproduto, :idcomanda, :idproduto, :vlfinalproduto)',[
            ':idcomandaproduto' => $this->getidcomandaproduto(),
            ':idcomanda' => $this->getidcomanda(),
            ':idproduto' => $idproduto,
            ':vlfinalproduto' => $vlfinalproduto
        ]);

        // return $result[0];
    }

    public function salvaComandaMesa()
    {
        $sql = new Sql;

        $sql->select('CALL `db_lachapa`.`sp_salva_comanda_mesa`(:idcomandamesa, :idcomanda, :idmesa)',[
            ':idcomandamesa'=>0,
            ':idcomanda'=>$this->getidcomanda(),
            ':idmesa'=>$this->getidmesa()
        ]);

        // return $result[0];
    }

    public function salvaComandaProdutoPorcaoExtra($idproduto, $qtd, $idingrediente){
        $sql = new Sql;

        $sql->select('CALL `db_lachapa`.`sp_salva_porcao_extra`(:idporcaoextra, :idproduto, :idcomanda, :idingrediente, :qtdporcaoextra)',[
            ':idporcaoextra' => 0,
            ':idcomanda' => $this->getidcomanda(),
            ':idproduto' => $idproduto,
            ':idingrediente' => $idingrediente,
            ':qtdporcaoextra' => $qtd
        ]);

        // return $result[0];
    }

    public function salvaComandaIngredienteAdicional($idproduto, $qtd, $idingrediente){
        $sql = new Sql;

        $sql->select('CALL `db_lachapa`.`sp_salva_ingrediente_adicional`(:idingredienteadicional, :idproduto, :idcomanda, :idingrediente, :qtdingredienteadicional)',[
            ':idingredienteadicional' => 0,
            ':idproduto' => $idproduto,
            ':idcomanda' => $this->getidcomanda(),
            ':idingrediente' => $idingrediente,
            ':qtdingredienteadicional' => $qtd
        ]);

        // return $result[0];
    }
    public function salvaComandaProdutoRemoverIngrediente($idproduto, $idingrediente){
        $sql = new Sql;

        $sql->select('CALL `db_lachapa`.`sp_salva_removeringrediente`(:idremoveringrediente, :idproduto, :idcomanda, :idingrediente)',[
            ':idremoveringrediente' => 0,
            ':idproduto' => $idproduto,
            ':idcomanda' => $this->getidcomanda(),
            ':idingrediente' => $idingrediente
        ]);

        // return $result[0];
    }

    public static function listaProdutosComanda($idcomanda)
    {
        $sql = new Sql;

        return $sql->select('SELECT * FROM comandas
        INNER JOIN `comanda-produtos` USING (idcomanda)
        INNER JOIN produtos USING (idproduto)
        WHERE idcomanda = :idcomanda',[
            ':idcomanda' => $idcomanda
        ]);
    }


    
}
