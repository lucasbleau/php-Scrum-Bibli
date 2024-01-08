<?php

namespace App\Entite;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;

#[Entity]
class BlueRay extends Media
{
    #[Column(name: "realisateur", length: 30)]
    protected string $realisateur;
    #[Column(name: "duree", type: 'float')]
    protected \DateTime $duree;
    #[Column(name: "annee_sortie", length: 50)]
    protected string $anneeSortie;


    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getRealisateur(): string
    {
        return $this->realisateur;
    }

    /**
     * @param string $realisateur
     */
    public function setRealisateur(string $realisateur): void
    {
        $this->realisateur = $realisateur;
    }

    /**
     * @return DateTime
     */
    public function getDuree(): DateTime
    {
        return $this->duree;
    }

    /**
     * @param DateTime $duree
     */
    public function setDuree(DateTime $duree): void
    {
        $this->duree = $duree;
    }

    /**
     * @return string
     */
    public function getAnneeSortie(): string
    {
        return $this->anneeSortie;
    }

    /**
     * @param string $anneeSortie
     */
    public function setAnneeSortie(string $anneeSortie): void
    {
        $this->anneeSortie = $anneeSortie;
    }

    public function getType()
    {
        return "blueray";
    }

}