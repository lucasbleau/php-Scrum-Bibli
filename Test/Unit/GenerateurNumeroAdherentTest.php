<?php

namespace Test\Unit;

use App\Services\GenerateurNumeroAdherent;
use PHPUnit\Event\Code\Test;
use PHPUnit\Framework\TestCase;

class GenerateurNumeroAdherentTest extends TestCase
{
    /**
     * @test
     */
    public function GenerateurNumeroAdherent_Bonnelongueur_True()
    {
        $numeroAdherents = new GenerateurNumeroAdherent() ;
        $numeroAdherent = $numeroAdherents->generer() ;
        $this->assertEquals(9, strlen($numeroAdherent));
    }

}