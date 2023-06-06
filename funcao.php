<?php

function dumpF($string)
{
    echo "<pre>";
    var_dump($string);
    echo "</pre>";
}
/*
function listarAlunos()
{
    global $user, $password, $database, $hostname;

    $sqlAluno =   " SELECT * " .
        " FROM aluno ";

    $con = mysqli_connect($hostname, $user, $password) or die('Erro na conexão');
    if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
    # Seleciona o banco de dados 
    mysqli_select_db($con, $database) or die('Erro na seleção do banco');

    $resultado = mysqli_query($con, $sqlAluno);

    $registros = mysqli_num_rows($resultado);

    $rows = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

    return $rows;
}

function listarAluno($idaluno)
{
    global $user, $password, $database, $hostname;

    $sqlAluno =   " SELECT * " .
        " FROM aluno 
          WHERE idaluno = @idaluno
        ";
    $sql = str_replace("@idaluno", $idaluno, $sqlAluno);

    $con = mysqli_connect($hostname, $user, $password) or die('Erro na conexão');
    if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
    # Seleciona o banco de dados 
    mysqli_select_db($con, $database) or die('Erro na seleção do banco');

    $resultado = mysqli_query($con, $sql);

    $registros = mysqli_num_rows($resultado);

    $rows = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

    return $rows;
}

function alterarAluno($idaluno, $nmaluno)
{
    global $user, $password, $database, $hostname;

    $sqlUpdate = "update aluno
                     set nmaluno = '@nmaluno'
                   where idaluno = @idaluno";

    $sql = str_replace("@idaluno", $idaluno, $sqlUpdate);
    $sql = str_replace("@nmaluno", $nmaluno, $sql);

    echo $sql;

    $con = mysqli_connect($hostname, $user, $password) or die('Erro na conexão');
    if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
    # Seleciona o banco de dados 
    mysqli_select_db($con, $database) or die('Erro na seleção do banco');

    $resultado = mysqli_query($con, $sql);

    return (mysqli_affected_rows($con) == 1);
}

function excluirAluno($idaluno)
{
    global $user, $password, $database, $hostname;

    $sqlUpdate = "delete from aluno
                   where idaluno = @idaluno";

    $sql = str_replace("@idaluno", $idaluno, $sqlUpdate);

    echo $sql;

    $con = mysqli_connect($hostname, $user, $password) or die('Erro na conexão');
    if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
    # Seleciona o banco de dados 
    mysqli_select_db($con, $database) or die('Erro na seleção do banco');

    $resultado = mysqli_query($con, $sql);

    return (mysqli_affected_rows($con) == 1);
}

function incluirAluno($nmaluno)
{
    global $user, $password, $database, $hostname;

    $sqlInsert = "insert into aluno(nmaluno) values ('@nmaluno')";

    $sql = str_replace("@nmaluno", $nmaluno, $sqlInsert);

    echo $sql;

    $con = mysqli_connect($hostname, $user, $password) or die('Erro na conexão');
    if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
    # Seleciona o banco de dados 
    mysqli_select_db($con, $database) or die('Erro na seleção do banco');

    $resultado = mysqli_query($con, $sql);

    return (mysqli_affected_rows($con) == 1);
}
*/

/* grupo de funções para manipulação dos logins */
function listarLogins()
{
    $sqlListagem =  'SELECT * ' .
        ' FROM login l' .
        ' left outer join aluno a' .
        ' on l.idaluno = a.idaluno';

    global $user, $password, $database, $hostname;

    $con = mysqli_connect($hostname, $user, $password) or die('Erro na conexão');
    if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
    # Seleciona o banco de dados 
    mysqli_select_db($con, $database) or die('Erro na seleção do banco');

    $resultado = mysqli_query($con, $sqlListagem);

    $registros = mysqli_num_rows($resultado);

    $rows = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

    return $rows;
}

function listarAlunosNaoRelacionados()
{
    $sqlNaoUtilizados = 'select * ' .
        ' from aluno a ' .
        ' where a.idaluno not in (select l.idaluno from login l where l.idaluno = a.idaluno) ';


    global $user, $password, $database, $hostname;

    $con = mysqli_connect($hostname, $user, $password) or die('Erro na conexão');
    if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
    # Seleciona o banco de dados 
    mysqli_select_db($con, $database) or die('Erro na seleção do banco');

    $resultado = mysqli_query($con, $sqlNaoUtilizados);

    $registros = mysqli_num_rows($resultado);

    $rows = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

    return $rows;
}

function incluirLogin($dslogin, $dssenha, $idaluno)
{
    global $user, $password, $database, $hostname;

    $sqlInsert = "insert into login(dslogin,dssenha,idaluno) values ('@dslogin','@dssenha','@idaluno')";

    $sql = str_replace("@dslogin", $dslogin, $sqlInsert);
    $sql = str_replace("@dssenha", $dssenha, $sql);
    $sql = str_replace("@idaluno", $idaluno, $sql);

    echo $sql;

    $con = mysqli_connect($hostname, $user, $password) or die('Erro na conexão');
    if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
    # Seleciona o banco de dados 
    mysqli_select_db($con, $database) or die('Erro na seleção do banco');

    $resultado = mysqli_query($con, $sql);

    return (mysqli_affected_rows($con) == 1);
}

function alterarSenha($dslogin, $dssenha)
{
    global $user, $password, $database, $hostname;

    $sqlUpdate = "update login
                     set dssenha = '@dssenha'
                   where dslogin = '@dslogin'";

    $sql = str_replace("@dslogin", $dslogin, $sqlUpdate);
    $sql = str_replace("@dssenha", $dssenha, $sql);

    echo $sql;

    $con = mysqli_connect($hostname, $user, $password) or die('Erro na conexão');
    if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
    # Seleciona o banco de dados 
    mysqli_select_db($con, $database) or die('Erro na seleção do banco');

    $resultado = mysqli_query($con, $sql);

    return (mysqli_affected_rows($con) == 1);
}

function excluirAcesso($dslogin)
{
    global $user, $password, $database, $hostname;

    $sqlUpdate = "delete from login
                   where dslogin = '@dslogin'";

    $sql = str_replace("@dslogin", $dslogin, $sqlUpdate);

    echo $sql;

    $con = mysqli_connect($hostname, $user, $password) or die('Erro na conexão');
    if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
    # Seleciona o banco de dados 
    mysqli_select_db($con, $database) or die('Erro na seleção do banco');

    $resultado = mysqli_query($con, $sql);

    return (mysqli_affected_rows($con) == 1);
}
