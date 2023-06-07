<?php
require_once("class.BancoDeDados.php");

class Form_Aluno extends BancoDeDados
{
    public function ListarAlunos()
    {
        $arrayAlunos = $this->retornaArray(" select * from aluno");
        return $arrayAlunos;
    }

    public function listarAluno($idaluno)
    {
        $arrayAluno = $this->retornaArray(" select * from aluno where idaluno=" . $idaluno);

        return $arrayAluno;
    }

    public function alterarAluno($idaluno, $nmaluno)
    {
        $alterAluno = $this->executar(" update aluno set nmaluno = '" . $nmaluno . "' where idaluno = " . $idaluno);
        return $alterAluno;
    }

    public function excluirAluno($idaluno)
    {
        $excluirAluno = $this->executar(" delete from aluno where idaluno = " . $idaluno);
        return $excluirAluno;
    }

    public function incluirAluno($nmaluno)
    {
        $incluiAluno = $this->executar(" insert into aluno(nmaluno) values ('" . $nmaluno . "')");
        return $incluiAluno;
    }
}
