<?php

require_once("class.BancoDeDados.php");

class Form_Notas extends BancoDeDados
{
    public function ListarNotas()
    {
        $arrayNotas = $this->retornaArray(" select * from avaliacao n left outer join aluno a on n.idaluno = a.idaluno left outer join disciplina d on n.iddisciplina = d.iddisciplina ");
        return $arrayNotas;
    }
    public function ListarNota($idavaliacao)
    {
        $arrayNota = $this->retornaArray(" select * from avaliacao where idavaliacao = " . $idavaliacao);

        return $arrayNota;
    }
    public function alterarNota($idavaliacao, $nota)
    {
        $alterNota = $this->executar(" update avaliacao set nota = '" . $nota . "' where idavaliacao = " . $idavaliacao);
        return $alterNota;
    }
    public function excluirNota($idavaliacao)
    {
        $excluirNota = $this->executar(" delete from avaliacao where idavaliacao = " . $idavaliacao);
        return $excluirNota;
    }
    public function incluirNota($nota, $idaluno, $iddisciplina)
    {
        $incluirNota = $this->executar(" insert into avaliacao(idaluno, iddisciplina, nota) values ('" . $idaluno . "', '" . $iddisciplina . "', '" . $nota . "')");
        return $incluirNota;
    }
}
