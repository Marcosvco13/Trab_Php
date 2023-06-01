<?php
require_once("class.BancoDeDados.php");

class Form_Aluno extends BancoDeDados
{
    public function ListarAlunos()
    {
        $arrayAluno = $this->retornaArray("select * from aluno");
        return $arrayAluno;
    }

    public function listarAluno($idaluno)
    {
        $arrayAluno = $this->retornaArray("select * from aluno where idaluno=" . $idaluno);

        return $arrayAluno;
    }
}
