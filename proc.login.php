<?php
require_once('./class/class.validacoesDeFormaulario.php');
require_once('./class/class.ValidacaoLogin.php');

$validarlog = new ValidarLogin();
$validar = new ValidacoesDeFormulario();


if (!isset($_POST["dslogin"]) || !isset($_POST["dssenha"])) {
    header("location:index.php?erro=ACESSOILEGAL");
}

if ($validar->validarNome($_POST["dslogin"]) == "ok") {
    $login = $_POST["dslogin"];
} else {
    header("location:index.php?erro=LOGIN" . $validar->validarNome($_POST["dslogin"]));
}

if ($validar->validarSenha($_POST["dssenha"]) == "ok") {
    $senha = md5($_POST["dssenha"]);
} else {
    header("location:index.php?erro=SENHA" . $validar->validarSenha($_POST["dssenha"]));
}

if ($validarlog->validarLogin($login, $senha)) {

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
