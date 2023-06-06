<?php
require_once('./class/class.validacoesDeFormaulario.php');
require_once('./class/class.ValidacaoLogin.php');

$validarlog = new ValidarLogin();
$validar = new ValidacoesDeFormulario();

if (!isset($_POST["dslogin"]) || !isset($_POST["dssenha"])) {
    header("location:index.php?erro=ACESSOILEGAL");
}

$login = $_POST["dslogin"];
$senha = $_POST["dssenha"];

/*
if ($validar->validarNome($_POST["dslogin"]) == "ok") {
    $login = $_POST["dslogin"];
} else {
    header("location:index.php?erro=LOGIN" . $validar->validarNome($_POST["dslogin"]));
}

if ($validar->validarSenha($_POST["dssenha"]) == "ok") {
    $senha = $_POST["dssenha"];
} else {
    header("location:index.php?erro=SENHA" . $validar->validarSenha($_POST["dssenha"]));
}
*/

if (count($validarlog->validarLogin($login, $senha)) == 1) {

    $token = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);

    session_name($token);

    session_start();

    $_SESSION["login"] = $login;
    $_SESSION["senha"] = $senha;

    $_SESSION["token"] = $token;

    header("location:welcome.php");
} else {
    header("location:index.php?erro=NAOLOCALIZADO");
}
