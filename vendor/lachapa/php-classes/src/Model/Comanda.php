<?php

namespace LaChapa\Model;

use LaChapa\Model;
use LaChapa\DB\Sql;

class Comanda extends Model
{
    public function salvaComanda()
    {
        $sql = new Sql;

        $resultado = $sql->select('CALL `db_lachapa`.`sp_salva_comanda`(:idcomanda, :valortotal, :statuscomanda, :datacomanda, :nomecliente, :idatendente, :idcartao)', [
            ':idcomanda' => $this->getidcomanda(),
            ':valortotal' => $this->getvalortotal(),
            ':statuscomanda' => 'A',
            ':datacomanda' => $this->getdatacomanda(),
            ':nomecliente' => $this->getnomecliente(),
            ':idatendente' => $this->getidatendente(),
            ':idcartao' => $this->getidcartao()
        ]);

        return $this->setData($resultado[0]);
    }


    public function salvaComandaProdutos($idproduto, $vlfinalproduto, $observacao, $nroitem)
    {
        $sql = new Sql;

        $sql->select('CALL `db_lachapa`.`sp_salva_comanda_produtos`(:idcomandaproduto, :idcomanda, :idproduto, :nroitem, :vlfinalproduto, :observacao)', [
            ':idcomandaproduto' => $this->getidcomandaproduto(),
            ':idcomanda' => $this->getidcomanda(),
            ':idproduto' => $idproduto,
            ':nroitem' => $nroitem,
            ':vlfinalproduto' => $vlfinalproduto,
            ':observacao' => $observacao
        ]);
    }

    public function salvaComandaMesa()
    {
        $sql = new Sql;

        $sql->select('CALL `db_lachapa`.`sp_salva_comanda_mesa`(:idcomandamesa, :idcomanda, :idmesa)', [
            ':idcomandamesa' => $this->getidcomandamesa(),
            ':idcomanda' => $this->getidcomanda(),
            ':idmesa' => $this->getidmesa()
        ]);
    }

    public function salvaComandaProdutoPorcaoExtra($idproduto, $qtd, $idingrediente, $nroitem)
    {
        $sql = new Sql;

        $sql->select('CALL `db_lachapa`.`sp_salva_porcao_extra`(:idporcaoextra, :idproduto, :idcomanda, :idingrediente, :qtdporcaoextra, :nroitem)', [
            ':idporcaoextra' => 0,
            ':idcomanda' => $this->getidcomanda(),
            ':idproduto' => $idproduto,
            ':idingrediente' => $idingrediente,
            ':qtdporcaoextra' => $qtd,
            ':nroitem' => $nroitem
        ]);
    }

    public static function listaPorcaoExtraProdutoComanda($idproduto, $idcomanda, $nroitem)
    {
        $sql = new Sql;

        return $sql->select('SELECT * FROM `porcao-extra` 
        INNER JOIN ingredientes USING (idingrediente) 
        WHERE idproduto = :idproduto 
        AND idcomanda = :idcomanda
        AND nroitem = :nroitem', [
            ':idproduto' => $idproduto,
            ':idcomanda' => $idcomanda,
            ':nroitem' => $nroitem
        ]);
    }


    public function salvaComandaIngredienteAdicional($idproduto, $qtd, $idingrediente, $nroitem)
    {
        $sql = new Sql;

        $sql->select('CALL `db_lachapa`.`sp_salva_ingrediente_adicional`(:idingredienteadicional, :idproduto, :idcomanda, :idingrediente, :qtdingredienteadicional, :nroitem)', [
            ':idingredienteadicional' => 0,
            ':idproduto' => $idproduto,
            ':idcomanda' => $this->getidcomanda(),
            ':idingrediente' => $idingrediente,
            ':qtdingredienteadicional' => $qtd,
            ':nroitem' => $nroitem
        ]);
    }

    public static function listaIngredienteAdicionalProdutoComanda($idproduto, $idcomanda, $nroitem)
    {
        $sql = new Sql;

        return $sql->select('SELECT * FROM `ingredienteadicional`
        INNER JOIN ingredientes USING (idingrediente)
         WHERE idproduto = :idproduto 
         AND idcomanda = :idcomanda
         AND nroitem = :nroitem', [
            ':idproduto' => $idproduto,
            ':idcomanda' => $idcomanda,
            ':nroitem' => $nroitem
        ]);
    }

    public function salvaComandaProdutoRemoverIngrediente($idproduto, $idingrediente, $nroitem)
    {
        $sql = new Sql;

        $sql->select('CALL `db_lachapa`.`sp_salva_removeringrediente`(:idremoveringrediente, :idproduto, :idcomanda, :idingrediente, :nroitem)', [
            ':idremoveringrediente' => 0,
            ':idproduto' => $idproduto,
            ':idcomanda' => $this->getidcomanda(),
            ':idingrediente' => $idingrediente,
            ':nroitem' => $nroitem
        ]);
    }

    public static function listaRemoverIngredienteProdutoComanda($idproduto, $idcomanda, $nroitem)
    {
        $sql = new Sql;

        return $sql->select('SELECT * FROM `removeringrediente`
        INNER JOIN ingredientes USING (idingrediente)
        WHERE idproduto = :idproduto 
        AND idcomanda = :idcomanda
        AND nroitem = :nroitem', [
            ':idproduto' => $idproduto,
            ':idcomanda' => $idcomanda,
            ':nroitem' => $nroitem
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
            $consultaporcaoextra = Comanda::listaPorcaoExtraProdutoComanda($resultado[$i]['idproduto'], $resultado[$i]['idcomanda'], $resultado[$i]['nroitem']);

            if (count($consultaporcaoextra) > 0) {
                $resultado[$i]['porcaoextra'] = $consultaporcaoextra;
            }
            
            $consultaingredienteadicional = Comanda::listaIngredienteAdicionalProdutoComanda($resultado[$i]['idproduto'], $resultado[$i]['idcomanda'], $resultado[$i]['nroitem']);
            
            if (count($consultaingredienteadicional) > 0) {
                $resultado[$i]['ingredienteadicional'] = $consultaingredienteadicional;
            }

            $consultaremoveringrediente = Comanda::listaRemoverIngredienteProdutoComanda($resultado[$i]['idproduto'], $resultado[$i]['idcomanda'], $resultado[$i]['nroitem']);

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
