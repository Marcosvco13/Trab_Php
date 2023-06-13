<?php

require_once("class.BancoDeDados.php");

class Form_Materias extends BancoDeDados
{
    public function ListarMaterias()
    {
        $arrayMaterias = $this->retornaArray(" select * from disciplina");
        return $arrayMaterias;
    }
    public function ListarMateria($iddisciplina)
    {
        $arrayMateria = $this->retornaArray(" select * from disciplina where iddisciplina = " . $iddisciplina);

        return $arrayMateria;
    }
    public function AlterarMateria($iddisciplina, $dsdisciplina)
    {
        $alterDisciplina = $this->executar(" update disciplina set dsdisciplina = '" . $dsdisciplina . "' where iddisciplina = " . $iddisciplina);
        return $alterDisciplina;
    }
    public function excluirDisciplina($iddisciplina)
    {
        $excluirDisciplina = $this->executar(" delete from disciplina where iddisciplina = " . $iddisciplina);
        return $excluirDisciplina;
    }
    public function incluirDisciplina($dsdisciplina)
    {
        $incluirDisciplina = $this->executar(" insert into disciplina(dsdisciplina) values ('" . $dsdisciplina . "')");
        return $incluirDisciplina;
    }
}
