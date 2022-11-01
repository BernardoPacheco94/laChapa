<?php

namespace LaChapa\Model;

use LaChapa\Model;
use LaChapa\DB\Sql;
use LDAP\Result;

class Produto extends Model{
    
    public function salvaProduto()
    {
        $sql = new Sql;

        $resultado = $sql->select('CALL `db_lachapa`.`sp_salva_produtos`(:idproduto, :nomeproduto, :valorproduto, :ativo)',[
            ':idproduto'=>$this->getidproduto(),
            ':nomeproduto'=>$this->getnomeproduto(),
            ':valorproduto'=>$this->getvalorproduto(),
            ':ativo'=>1
        ]);

        return $this->setData($resultado[0]);        
    }

    public function addTipo(Tipo $tipo)
    {
        $sql = new Sql;

        $sql->query('INSERT INTO `db_lachapa`.`produto-tipo`
        (`idproduto`,
        `idtipo`)
        VALUES
        (:idproduto,
        :idtipo)',[
            ':idproduto'=>$this->getidproduto(),
            ':idtipo'=>$tipo->getidtipo()
        ]);
    }

    public function addIngrediente($idingrediente)
    {
        $sql = new Sql;

        $sql->query('INSERT INTO `db_lachapa`.`produto-ingredientes`
        (`idproduto`,
        `idingrediente`)
        VALUES
        (:idproduto,
        :idingrediente)',[
            ':idproduto'=>$this->getidproduto(),
            ':idingrediente'=>$idingrediente
        ]);
    }

    public static function listaProdutos()
    {
        $sql = new Sql;

        
        $result = $sql->select('SELECT * 
        FROM produtos a
        INNER JOIN `produto-tipo` b USING (idproduto)
        INNER JOIN `tipos` c USING (idtipo)
        WHERE a.ativo = 1
        ');

        for($i=0; $i<(count($result)); $i++ )
        {
            array_push($result[$i], [
                'ingredientes'=>Produto::listaIngredientesProduto($result[$i]['idproduto'])
            ]);
        }

        return $result;

    }

    public static function listaIngredientesProduto($idproduto)
    {
        $sql = new Sql;

        $resultado = $sql->select('SELECT * 
        FROM produtos a
        INNER JOIN `produto-ingredientes` b USING (idproduto)
        INNER JOIN `ingredientes` c USING (idingrediente)
        WHERE b.idproduto= :idproduto AND a.ativo =1',[
            ':idproduto'=>$idproduto
        ]);

        $ingredientes['ingredientes'] = [];
        

        for ($i=0; $i < count($resultado) ; $i++) { 
            array_push($ingredientes['ingredientes'], 
            [
                'idingrediente' => $resultado[$i]['idingrediente'] ,
                'nome' => $resultado[$i]['nomeingrediente'], 
                'valoradicional' => $resultado[$i]['valoradicional'],
                'quantidade' => 1 
            ]);
        }

        return $ingredientes;
    }

    public function get($idproduto)
    {
        $sql = new Sql;

        $resultado = $sql->select('SELECT * FROM produtos WHERE idproduto = :idproduto',[
            'idproduto'=>$idproduto
        ]);

        return $this->setData($resultado[0]);
    }

    public static function getAjax($idproduto)
    {
        $sql = new Sql;

        $resultado = $sql->select('SELECT * FROM produtos WHERE idproduto = :idproduto',[
            'idproduto'=>$idproduto
        ]);

        array_push($resultado[0], Produto::listaIngredientesProduto($idproduto));

        return json_encode($resultado[0]);
    }

    public function deletarProduto($idproduto)
    {
        $sql = new Sql;

        $sql->query('UPDATE `db_lachapa`.`produtos`
        SET
        `ativo` = 0
        WHERE `idproduto` = :idproduto',[
            ':idproduto'=>$idproduto
        ]);        
    }

    public function updateTipo($idproduto)
    {
        $sql = new Sql;

        $sql->query('UPDATE `db_lachapa`.`produto-tipo`
        SET
        `idtipo` = :idtipo
        WHERE `idproduto` = :idproduto',[
            ':idtipo'=>$this->getidtipo(),
            ':idproduto'=>$idproduto
        ]);
    }

    public function limpaIngredientes($idproduto)
    {
        $sql = new Sql;

        $sql->query('DELETE FROM `produto-ingredientes` WHERE idproduto = :idproduto',[
            ':idproduto'=>$idproduto
        ]);        
    }

    public static function pesquisar($pesquisa)
    {
        $sql = new Sql;

        $result = $sql->select('SELECT * 
        FROM produtos a
        INNER JOIN `produto-tipo` b USING (idproduto)
        INNER JOIN `tipos` c USING (idtipo)
        WHERE (a.nomeproduto LIKE :PESQUISA) AND  a.ativo = 1 ',
        [
            ":PESQUISA"=>"%".$pesquisa."%"
        ]);

        for($i=0; $i<(count($result)); $i++ )
        {
            array_push($result[$i], [
                'ingredientes'=>Produto::listaIngredientesProduto($result[$i]['idproduto'])
            ]);
        }

        return $result;
    }

    public static function filtraPorTipo($idtipo)
    {
        $sql = new Sql;

        $result = $sql->select('SELECT * 
        FROM produtos a
        INNER JOIN `produto-tipo` b USING (idproduto)
        INNER JOIN `tipos` c USING (idtipo)
        WHERE (c.idtipo LIKE :idtipo) AND  a.ativo = 1 ',
        [
            ":idtipo"=>$idtipo
        ]);

        for($i=0; $i<(count($result)); $i++ )
        {
            array_push($result[$i], [
                'ingredientes'=>Produto::listaIngredientesProduto($result[$i]['idproduto'])
            ]);
        }

        return $result;        
    }

}

