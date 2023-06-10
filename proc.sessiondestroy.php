<?php
session_name(md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));
session_start();

$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

unset($_SESSION['login']);
unset($_SESSION['senha']);
unset($_SESSION['token']);
$_SESSION = null;

session_destroy();
session_start();
session_destroy();
header("Location: index.php");
