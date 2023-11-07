<?php

namespace App\Services;

class GenerateurNumeroAdherent
{
    public function generer(): string
    {
        $numero = random_int(1, 999);
        return "AD-$numero";
    }

}