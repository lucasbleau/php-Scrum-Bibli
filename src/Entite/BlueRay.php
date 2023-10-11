<?php

namespace Entite;

class BlueRay extends Media
{
    protected int $id;
    protected string $realisateur;
    protected DateTime $duree;
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


}