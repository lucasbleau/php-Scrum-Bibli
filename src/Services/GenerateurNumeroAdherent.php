<?php

namespace App\Services;

class GenerateurNumeroAdherent
{
    public function generer(): string
    {
        return str_pad("AD-", 9, rand(000000, 999999));
    }

}
