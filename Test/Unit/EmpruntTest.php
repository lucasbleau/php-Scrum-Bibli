<?php

namespace Test\Unit ;

use App\Entite\Adherent;
use App\Entite\Emprunt;
use App\Entite\Livre;
use App\Entite\Media;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class EmpruntTest extends TestCase
{
   #[test]
    public function verifierEmpruntEnCours_DateOk_True()
   {
       $emprunt = new Emprunt() ;
       $format = "d-m-Y" ;
       $emprunt->setDateEmprunt(\DateTime::createFromFormat($format, '17-10-2022'));
       $verifierEmpruntEnCours = $emprunt->verifierEmpruntEnCours();
       $this->assertTrue($verifierEmpruntEnCours);
   }

    #[test]
    public function verifierEmpruntEnCours_DateOk_False()
    {
        $emprunt = new Emprunt() ;
        $format = "d-m-Y" ;
        $emprunt->setDateEmprunt(\DateTime::createFromFormat($format, '17-10-2022'));
        $emprunt->setDateRetour(\DateTime::createFromFormat($format, '27-10-2022'));
        $verifierEmpruntEnCours = $emprunt->verifierEmpruntEnCours();
        $this->assertFalse($verifierEmpruntEnCours);
    }

    #[test]
   public function verifierEmpruntDepasser_DateDepasse_True()
   {
       $emprunt = new Emprunt() ;
//       $media = new Media();
//       $emprunt->
       $format = "d-m-Y" ;
       $emprunt->setDateEmprunt((new \DateTime())->modify("- 30 days"));
       $emprunt->setDateRetourEstime((new \DateTime())->modify("- 1 days"));
       $verifierEmpruntDepasse = $emprunt->verifierEmpruntDepasser();
       var_dump($verifierEmpruntDepasse);
       $this->assertTrue($verifierEmpruntDepasse);
   }

    #[test]
    public function verifierEmpruntDepasser_DateDepasse_False()
    {
        $emprunt = new Emprunt() ;
        $format = "d-m-Y" ;
        $emprunt->setDateEmprunt((new \DateTime())->modify("- 30 days"));
        $emprunt->setDateRetourEstime((new \DateTime())->modify("+ 10 days"));
        $verifierEmpruntDepasse = $emprunt->verifierEmpruntDepasser();
        $this->assertFalse($verifierEmpruntDepasse);
    }
}