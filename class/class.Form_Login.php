<?php
require_once("class.BancoDeDados.php");

class Form_Login extends BancoDeDados
{
    public function ListarLogins()
    {
        $arraysLogins = $this->retornaArray(" select * from login l left outer join aluno a on l.idaluno = a.idaluno");
        return $arraysLogins;
    }

    public function listarAlunosNaoRelacionados()
    {
        $ListAlunos = $this->retornaArray(" select * from aluno a where a.idaluno not in (select l.idaluno from login l where l.idaluno = a.idaluno)");
        return $ListAlunos;
    }

    public function incluirLogin($dslogin, $dssenha, $idaluno)
    {
        $InsertLogin = $this->executar(" insert into login(dslogin, dssenha, idaluno) values ('" . $dslogin . "', '" . $dssenha . "', '" . $idaluno . "')");
        return $InsertLogin;
    }

    public function alterarSenha($dslogin, $dssenha)
    {
        $AlterSenha = $this->executar(" update login set dssenha = '" . $dssenha . "' where dslogin = '" . $dslogin . "'");
        return $AlterSenha;
    }

    public function excluirAcesso($dslogin)
    {
        $ExcluirLogin = $this->executar("delete from login where dslogin = '" . $dslogin . "'");
        return $ExcluirLogin;
    }
}
