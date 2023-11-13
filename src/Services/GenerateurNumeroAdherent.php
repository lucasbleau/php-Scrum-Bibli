<?php

namespace App\Services;

class GenerateurNumeroAdherent
{
    public function generer(): string
    {
        $numero = str_pad("AD-", 9, rand(000000, 999999));
        return $numero;
    }

}

$a = new GenerateurNumeroAdherent();
$b = $a->generer();
echo $b ;
