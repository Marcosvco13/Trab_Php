<?php

require_once("class.BancoDeDados.php");

class Form_Notas extends BancoDeDados
{
    public function ListarNotas()
    {
        $arrayNotas = $this->retornaArray(" select * from avaliacao");
        return $arrayNotas;
    }
    public function ListarNota($idavaliacao)
    {
        $arrayNota = $this->retornaArray(" select * from avaliacao where idavaliacao = " . $idavaliacao);

        return $arrayNota;
    }
    public function AlterarMateria($idavaliacao, $nota)
    {
        $alterNota = $this->executar(" update avaliacao set nota = '" . $nota . "' where idavaliacao = " . $idavaliacao);
        return $alterNota;
    }
    public function excluirDisciplina($idavaliacao)
    {
        $excluirNota = $this->executar(" delete from avaliacao where idavaliacao = " . $idavaliacao);
        return $excluirNota;
    }
    public function incluirDisciplina($nota, $idaluno, $iddisciplina)
    {
        $incluirNota = $this->executar(" insert into avaliacao(idaluno, iddisciplina, nota) values ('" . $idaluno . "', '" . $iddisciplina . "', '" . $nota . "')");
        return $incluirNota;
    }
}
