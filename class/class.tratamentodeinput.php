<?php
class TratamentoDeInput
{
    private $caracteresIndesejaveis = array('"', "'", '<', '>', '--');

    protected function valorInvalido($informacao)
    {
        if (empty(trim($informacao))) return true;

        foreach ($this->caracteresIndesejaveis as $caractere) {
            if (str_contains($informacao, $caractere)) {
                return true;
            } else {
                return false;
            }
        }
    }
}
