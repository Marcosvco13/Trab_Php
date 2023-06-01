<?php
require_once("class.tratamentodeinput.php");
require_once("class.BancoDeDados.php");

class ValidarLogin extends BancoDeDados
{
    public function validarLogin($dslogin, $dssenha)
    {
        $sql = $this->retornaArray(" SELECT * " . " FROM login l " . " WHERE l.dslogin= " . $dslogin . " and l.dssenha = " . $dssenha);

        return $sql;
    }

    public function revalidarLogin()
    {
        $token = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);

        session_name($token);
        session_start();


        if (!isset($_SESSION["login"]) || !isset($_SESSION["senha"]) || !isset($_SESSION["token"])) {
            session_destroy();
            header("location:index.php?erro=SEMLOGIN");
        }

        if ($_SESSION["token"] != $token) {
            session_destroy();
            header("location:index.php?erro=INVASAO");
        }

        if (!$this->validarLogin($_SESSION["login"], $_SESSION["senha"])) {
            session_destroy();
            header("location:index.php?erro=LOGININVALIDO");
        }
    }
}

$validarLogin = new ValidarLogin();

$puta = $validarLogin->validarLogin('admin', 'teste');

dumpF($puta);

#$bd = new BancoDeDados('10.0.0.1', 'admin', '123', 'aedb');
#$bd2 = new BancoDeDados();
#dumpF($bd);
#dumpf($bd2);
#$variavel = $bd2->retornaArray("select * from login");

#dumpf($variavel);