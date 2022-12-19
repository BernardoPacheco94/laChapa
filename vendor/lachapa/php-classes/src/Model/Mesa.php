<?php

namespace LaChapa\Model;

use LaChapa\Model;
use LaChapa\DB\Sql;

class Mesa extends Model
{
    public static function exibeTodas()
    {
        $sql = new Sql;

        return $sql->select('SELECT * FROM mesas ORDER BY idmesa');
    }

    public static function exibeLivres()
    {
        $sql = new Sql;

        return $sql->select('SELECT * FROM mesas WHERE livre = :livre ORDER BY idmesa',[
            ':livre' => 1
        ]);
    }

    public static function mesasExibidas()
    {
        $sql = new Sql;

        $result = $sql->select('SELECT * FROM mesas WHERE exibe = :exibe ORDER BY idmesa',[
            ':exibe' => 1
        ]);
        
        
        for ($i=0; $i < count($result); $i++) { // Não será necessário usar esse for
            array_push($result[$i], [
                'comandas' => Mesa::exibirComandas($result[$i]['idmesa'])
            ]);
        }

        return $result;
    }

    public static function mesasOcultas()
    {
        $sql = new Sql;

        return $sql->select('SELECT * FROM mesas WHERE exibe = :exibe ORDER BY idmesa',[
            ':exibe' => 0
        ]);
    }

    public static function exibeOcupadas()
    {
        $sql = new Sql;

        return $sql->select('SELECT * FROM mesas WHERE livre = :livre ORDER BY idmesa',[
            ':livre' => 0
        ]);
    }

    public function novaMesa()
    {
        $sql = new Sql;

        $sql->query('INSERT INTO `mesas`
        (`livre`,
        `exibe`)
        VALUES
        (:livre,
        :exibe)',[
            'livre'=> 1,
            'exibe'=> 1
        ]);
    }

    public function removerMesa($idmesa)
    {
        $sql = new Sql;

        $sql->query('UPDATE mesas SET exibe = 0 WHERE idmesa = :idmesa',[
            ':idmesa' => $idmesa
        ]);
    }

    public function exibirMesa($idmesa)
    {
        $sql = new Sql;
        
        $sql->query('UPDATE mesas SET exibe = 1 WHERE idmesa = :idmesa',[
            ':idmesa' => $idmesa
        ]);
    }

    public function get($idmesa)
    {
        $sql = new Sql;

        $resultado = $sql->select('SELECT * FROM mesas WHERE idmesa = :idmesa',[
            'idmesa'=>$idmesa
        ]);

        return $this->setData($resultado[0]);
    }

    public static function exibirComandas($idmesa)
    {
        $sql = new Sql;

        $result = $sql->select('SELECT * FROM comandas
        INNER JOIN `comanda-mesa` USING (idcomanda)
        INNER JOIN mesas USING (idmesa)
        WHERE idmesa = :idmesa AND statuscomanda = "A"',[
            ':idmesa' =>$idmesa
        ]);

        for ($i=0; $i < count($result); $i++) {
            array_push($result[$i],[
                'produtosComanda' => Comanda::listaProdutosComanda($result[$i]['idcomanda'])
                ]
            );           
        }

        return $result;
    }

    
}