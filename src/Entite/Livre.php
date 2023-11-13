<?php

namespace App\Entite;

class Livre extends Media
{
    protected string $isbn;
    protected string $auteur;
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


}