<?php

namespace LaChapa\Model;

use LaChapa\Model;
use LaChapa\DB\Sql;

class Comanda extends Model
{
    public function salvaComanda()
    {
        $sql = new Sql;

        $resultado = $sql->select('CALL `db_lachapa`.`sp_salva_comanda`(:idcomanda, :valortotal, :statuscomanda, :datacomanda, :nomecliente, :idatendente)', [
            ':idcomanda' => $this->getidcomanda(),
            ':valortotal' => $this->getvalortotal(),
            ':statuscomanda' => 'A',
            ':datacomanda' => $this->getdatacomanda(),
            ':nomecliente' => $this->getnomecliente(),
            ':idatendente' => $this->getidatendente()
        ]);

        return $this->setData($resultado[0]);
    }


    public function salvaComandaProdutos($idproduto, $vlfinalproduto)
    {
        $sql = new Sql;

        $sql->select('CALL `db_lachapa`.`sp_salva_comanda_produtos`(:idcomandaproduto, :idcomanda, :idproduto, :vlfinalproduto)', [
            ':idcomandaproduto' => $this->getidcomandaproduto(),
            ':idcomanda' => $this->getidcomanda(),
            ':idproduto' => $idproduto,
            ':vlfinalproduto' => $vlfinalproduto
        ]);
    }

    public function salvaComandaMesa()
    {
        $sql = new Sql;

        $sql->select('CALL `db_lachapa`.`sp_salva_comanda_mesa`(:idcomandamesa, :idcomanda, :idmesa)', [
            ':idcomandamesa' => 0,
            ':idcomanda' => $this->getidcomanda(),
            ':idmesa' => $this->getidmesa()
        ]);
    }

    public function salvaComandaProdutoPorcaoExtra($idproduto, $qtd, $idingrediente)
    {
        $sql = new Sql;

        $sql->select('CALL `db_lachapa`.`sp_salva_porcao_extra`(:idporcaoextra, :idproduto, :idcomanda, :idingrediente, :qtdporcaoextra)', [
            ':idporcaoextra' => 0,
            ':idcomanda' => $this->getidcomanda(),
            ':idproduto' => $idproduto,
            ':idingrediente' => $idingrediente,
            ':qtdporcaoextra' => $qtd
        ]);
    }

    public static function listaPorcaoExtraProdutoComanda($idproduto, $idcomanda)
    {
        $sql = new Sql;

        return $sql->select('SELECT * FROM `porcao-extra` 
        INNER JOIN ingredientes USING (idingrediente) 
        WHERE idproduto = :idproduto AND idcomanda = :idcomanda', [
            ':idproduto' => $idproduto,
            ':idcomanda' => $idcomanda
        ]);
    }


    public function salvaComandaIngredienteAdicional($idproduto, $qtd, $idingrediente)
    {
        $sql = new Sql;

        $sql->select('CALL `db_lachapa`.`sp_salva_ingrediente_adicional`(:idingredienteadicional, :idproduto, :idcomanda, :idingrediente, :qtdingredienteadicional)', [
            ':idingredienteadicional' => 0,
            ':idproduto' => $idproduto,
            ':idcomanda' => $this->getidcomanda(),
            ':idingrediente' => $idingrediente,
            ':qtdingredienteadicional' => $qtd
        ]);
    }

    public static function listaIngredienteAdicionalProdutoComanda($idproduto, $idcomanda)
    {
        $sql = new Sql;

        return $sql->select('SELECT * FROM `ingredienteadicional`
        INNER JOIN ingredientes USING (idingrediente)
         WHERE idproduto = :idproduto AND idcomanda = :idcomanda', [
            ':idproduto' => $idproduto,
            ':idcomanda' => $idcomanda
        ]);
    }

    public function salvaComandaProdutoRemoverIngrediente($idproduto, $idingrediente)
    {
        $sql = new Sql;

        $sql->select('CALL `db_lachapa`.`sp_salva_removeringrediente`(:idremoveringrediente, :idproduto, :idcomanda, :idingrediente)', [
            ':idremoveringrediente' => 0,
            ':idproduto' => $idproduto,
            ':idcomanda' => $this->getidcomanda(),
            ':idingrediente' => $idingrediente
        ]);
    }

    public static function listaRemoverIngredienteProdutoComanda($idproduto, $idcomanda)
    {
        $sql = new Sql;

        return $sql->select('SELECT * FROM `removeringrediente`
        INNER JOIN ingredientes USING (idingrediente)
        WHERE idproduto = :idproduto AND idcomanda = :idcomanda', [
            ':idproduto' => $idproduto,
            ':idcomanda' => $idcomanda
        ]);
    }

    public static function listaProdutosComanda($idcomanda)
    {
        $sql = new Sql;

        $resultado = $sql->select('SELECT * FROM comandas
        INNER JOIN `comanda-produtos` USING (idcomanda)
        INNER JOIN produtos USING (idproduto)
        WHERE idcomanda = :idcomanda', [
            ':idcomanda' => $idcomanda
        ]);

        

        for ($i = 0; $i < count($resultado); $i++) {
            $consultaporcaoextra = Comanda::listaPorcaoExtraProdutoComanda($resultado[$i]['idproduto'], $resultado[$i]['idcomanda']);

            if (count($consultaporcaoextra) > 0) {
                $resultado[$i]['porcaoextra'] = $consultaporcaoextra;
            }
            
            $consultaingredienteadicional = Comanda::listaIngredienteAdicionalProdutoComanda($resultado[$i]['idproduto'], $resultado[$i]['idcomanda']);
            
            if (count($consultaingredienteadicional) > 0) {
                $resultado[$i]['ingredienteadicional'] = $consultaingredienteadicional;
            }

            $consultaremoveringrediente = Comanda::listaRemoverIngredienteProdutoComanda($resultado[$i]['idproduto'], $resultado[$i]['idcomanda']);

            if (count($consultaremoveringrediente) > 0) {
                $resultado[$i]['removeringrediente'] = $consultaremoveringrediente;
            }
        }

        return $resultado;
    }

    public static function listaComandas()
    {
        $sql = new Sql;

        $resultado = $sql->select('SELECT * FROM comandas
        INNER JOIN `comanda-mesa` USING (idcomanda) 
        WHERE statuscomanda = "A"
        ');

        for ($i = 0; $i < count($resultado); $i++) {
            $resultado[$i]['produtos'] = Comanda::listaProdutosComanda($resultado[$i]['idcomanda']);
        }

        return $resultado;
    }
}
