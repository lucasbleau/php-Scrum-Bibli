<?php

namespace App\Entite;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;

#[Entity]
class Livre extends Media
{
    #[Column(name: "isbn", length: "20")]
    protected string $isbn;
    #[Column(name: "auteur", length: "50")]
    protected string $auteur;
    #[Column(name: "nombre_page", length: "5")]
    protected int $nombrePage;

    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getIsbn(): string
    {
        return $this->isbn;
    }

    /**
     * @param string $isbn
     */
    public function setIsbn(string $isbn): void
    {
        $this->isbn = $isbn;
    }

    /**
     * @return string
     */
    public function getAuteur(): string
    {
        return $this->auteur;
    }

    /**
     * @param string $auteur
     */
    public function setAuteur(string $auteur): void
    {
        $this->auteur = $auteur;
    }

    /**
     * @return int
     */
    public function getNombrePage(): int
    {
        return $this->nombrePage;
    }

    /**
     * @param int $nombrePage
     */
    public function setNombrePage(int $nombrePage): void
    {
        $this->nombrePage = $nombrePage;
    }

    public function setDureeEmprunt(): void
    {
        $this->dureeEmprunt = 21 ;
    }

    public function getType()
    {
        return "livre";
    }
}