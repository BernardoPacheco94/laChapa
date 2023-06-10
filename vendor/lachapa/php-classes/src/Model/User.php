<?php

namespace LaChapa\Model;

use LaChapa\DB\Sql;
use LaChapa\Model;

class User extends Model
{

    const SESSION = "User"; //constante da sessao
    const ERROR = "UserError";
    const ERROR_REGISTER = "UserErrorRegister";
    const SUCCESS = "UserMsgSuccess";

    public static function login($login, $password)
    {
        $sql = new Sql;

        $result = $sql->select("SELECT * FROM usuarios WHERE nome = :LOGIN", array(
            ":LOGIN" => $login
        ));


        if (!count($result)) {
            throw new \Exception("Usuário inexistente ou senha inválida"); // a contrabarra no Exception é pq estamos usando o namespace, e nao há classe exception nesse namespace, portanto a classe exception deve vir da raiz
        }

        $data = $result[0]; //joga em data o resutado da query

        if (password_verify($password, $data['passhash'])) //valida a senha e inicia a sessao
        {
            $user = new User();

            $user->setidusuario($data["idusuario"]);

            $user->setData($data);

            $_SESSION[User::SESSION] = $user->getData(); //pega os dados e atribui na sessao

            return $user;
        } else {
            throw new \Exception("Usuário inexistente ou senha inválida");
        }
    }

    public  static function getFromSession() //retorna uma sessao vazia caso nao haja usuario
    {
        $user = new User;

        if (isset($_SESSION[User::SESSION]) && (int)$_SESSION[User::SESSION]['idusuario'] > 0) {
            $user->setData($_SESSION[User::SESSION]);
        }

        return $user;
    }

    public static function checkLogin() //verificar se está logado
    {
        if (
            !isset($_SESSION[User::SESSION])
            ||
            !$_SESSION[User::SESSION]
            ||
            !(int)$_SESSION[User::SESSION]["idusuario"] > 0
        ) {
            //nao está logado
            return false;
        } else {
            return true;
        }
    }

    // public static function verifyLogin($inadmin = true) //verifica se o usuário está logado e é admin
    // {
    //     if (!User::checkLogin($inadmin)) {

    //         if ($inadmin) {
    //             header('Location: /admin/login');
    //         } else {
    //             header('Location: /login');
    //         }
    //         exit;
    //     }
    // }

    public static function logout()
    {
        $_SESSION[User::SESSION] = NULL;
        session_destroy();
    }

    public static function listAll()
    {
        $sql = new Sql();

        return $sql->select("SELECT * FROM usuarios where ativo = 1 ORDER BY nome");
    }

    public function save()
    {
        $sql = new Sql;

        $securePass = password_hash($this->getpasshash(), PASSWORD_DEFAULT, ["cost" => 10]);

        $results = $sql->select("CALL sp_salva_usuario (:email, :passhash, :nome, :ativo)", array(
            ":email" => $this->getemail(),
            ":nome" => $this->getnome(),
            ":passhash" => $securePass,
            ":ativo" => 0
        ));

        $this->setData($results[0]);
    }
    
    public function novoUsuario($nome, $email, $passhash)
    {
        $sql = new Sql;

        $securePass = password_hash($passhash, PASSWORD_DEFAULT, ["cost" => 10]);

        $sql->select("CALL sp_salva_usuario (:idusuario, :email, :passhash, :nome, :ativo)", array(
            ":idusuario" => $this->getidusuario(),
            ":email" => $email,
            ":nome" => $nome,
            ":passhash" => $securePass,
            ":ativo" => 0
        ));
    }

    public function get($idusuario) //retorna os dados do usuario com a procedure (dados person)
    {
        $sql = new Sql;

        $results = $sql->select("SELECT * FROM usuarios WHERE idusuario = :idusuario", array(
            ":idusuario" => $idusuario
        ));

        $this->setData($results[0]);
    }

    public function update()
    {
        $sql = new Sql;

        $securePass = password_hash($this->getpasshash(), PASSWORD_DEFAULT, ["cost" => 10]);

        $results = $sql->select("CALL sp_salva_usuario (`:email`, `:passhash`, `:nome`, `:ativo`)", array(
            ":email" => $this->getemail(),
            ":nome" => $this->getnome(),
            ":passhash" => $securePass,
            ":ativo" => $this->getativo()
        ));

        $this->setData($results[0]);
    }

    public function delete($idusuario)
    {
        $sql = new Sql;

        $sql->query('UPDATE `db_lachapa`.`usuarios`
        SET
        `ativo` = 0
        WHERE `idusuario` = :idusuario',[
            ':idusuario'=>$idusuario
        ]);
    }


    public function setPassWord($pass)
    {
        $sql = new Sql;

        $sql->query("UPDATE usuarios SET passhash = :password WHERE idusuario = :idusuario", array(
            ":password" => $pass,
            ":idusuario" => $this->getidusuario()
        ));
    }

    public static function setError($msg)
    {
        $_SESSION[User::ERROR] = $msg;
    }

    public static function getError()
    {
        $msg = (isset($_SESSION[User::ERROR]) && $_SESSION[User::ERROR]) ? $_SESSION[User::ERROR] : '';

        User::clearError();

        return $msg;
    }

    public static function clearError()
    {
        $_SESSION[User::ERROR] = null;
    }

    public static function setErrorRegister($msg)
    {
        $_SESSION[User::ERROR_REGISTER] = $msg;
    }

    public static function getErrorRegister()
    {
        $msg = (isset($_SESSION[User::ERROR_REGISTER]) && $_SESSION[User::ERROR_REGISTER]) ? $_SESSION[User::ERROR_REGISTER] : '';

        User::clearErrorRegister();

        return $msg;
    }

    public static function clearErrorRegister()
    {
        $_SESSION[User::ERROR_REGISTER] = null;
    }

    public static function checkLoginExist($login)
    {
        $sql = new Sql;

        $result = $sql->select('SELECT * FROM usuarios WHERE nome = :nome', [
            'nome' => $login
        ]);

        return (count($result) > 0); //retorna true se já houver um login, false se não houver
    }


    public static function setMsgSuccess($msg)
    {
        $_SESSION[User::SUCCESS] = $msg;
    }

    public static function getMsgSuccess()
    {
        $msg = (isset($_SESSION[User::SUCCESS]) && $_SESSION[User::SUCCESS]) ? $_SESSION[User::SUCCESS] : '';

        User::clearMsgSuccess();

        return $msg;
    }

    public static function clearMsgSuccess()
    {
        $_SESSION[User::SUCCESS] = null;
    }


    // public static function getPage($page = 1, $itemsPerPage = 10)
    // {
    //     $start = ($page - 1) * $itemsPerPage;//inicial do limit

    //     $sql = new Sql;


    //     $result = $sql->select("
    //     SELECT SQL_CALC_FOUND_ROWS *
    //     FROM usuarios a INNER JOIN tb_persons b USING (idperson)LIMIT $start, $itemsPerPage;
    //     ");

    //     $resultTotal = $sql -> select('
    //     SELECT FOUND_ROWS() AS nrtotal;
    //     ');

    //     return [
    //         'data'=>$result,
    //         'total'=>(int)$resultTotal[0]['nrtotal'],
    //         'pages'=>ceil($resultTotal[0]['nrtotal'] / $itemsPerPage)//quantidade de paginas geradas, ceil arredonda numeros para cima
    //     ];
    // }
    // public static function getPageSearch($search, $page = 1, $itemsPerPage = 10)
    // {
    //     $start = ($page - 1) * $itemsPerPage;//inicial do limit

    //     $sql = new Sql;


    //     $result = $sql->select("
    //     SELECT SQL_CALC_FOUND_ROWS *
    //     FROM usuarios a INNER JOIN tb_persons b USING (idperson) WHERE b.desperson LIKE :search OR b.desemail = :search OR a.nome LIKE :search 
    //     LIMIT $start, $itemsPerPage;
    //     ",[
    //         "search" => '%'.$search.'%'
    //     ]);

    //     $resultTotal = $sql -> select('
    //     SELECT FOUND_ROWS() AS nrtotal;
    //     ');

    //     return [
    //         'data'=>$result,
    //         'total'=>(int)$resultTotal[0]['nrtotal'],
    //         'pages'=>ceil($resultTotal[0]['nrtotal'] / $itemsPerPage)//quantidade de paginas geradas, ceil arredonda numeros para cima
    //     ];
    // }
}
