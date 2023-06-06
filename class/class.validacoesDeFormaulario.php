<?php
require_once("class.tratamentodeinput.php");

class ValidacoesDeFormulario extends TratamentoDeInput
{

    const _TAMANHOMAXNOME = 20;
    const _TAMANHOMINNOME = 10;
    const _TAMANHOMAXEMAIL = 300;
    const _TAMANHOMINSENHA = 10;
    const _TAMANHOMAXSENHA = 25;

    public function validarNome($nome)
    {
        if ($this->valorInvalido($nome)) return false;
        if (strlen($nome) < self::_TAMANHOMINNOME || strlen($nome) > self::_TAMANHOMAXNOME) return false;

        return "ok";
    }

    public function validarEmail($email)
    {
        if ($this->valorInvalido($email)) return false;
        if (strlen($email) < self::_TAMANHOMAXEMAIL) return false;
        if (empty($email) == true) return false;
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) return false;

        return "ok";
    }

    public function validarSenha($senha)
    {
        if ($this->valorInvalido($senha)) return false;
        if (strlen($senha) < self::_TAMANHOMINSENHA || strlen($senha) > self::_TAMANHOMAXSENHA) return false;
        if (empty($senha) == true) return false;

        return "ok";
    }
}

$validarInformacao = new ValidacoesDeFormulario();
