<?php

namespace App\Entite;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;

#[Entity]
class Magazine extends Media
{
    #[Column(name: "numero_publication", length: "20")]
    protected int $numeroPublication;
    #[Column(name: "date_publication", length: "20")]
    protected \DateTime $datePublication;

    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getNumeroPublication(): int
    {
        return $this->numeroPublication;
    }

    /**
     * @param int $numeroPublication
     */
    public function setNumeroPublication(int $numeroPublication): void
    {
        $this->numeroPublication = $numeroPublication;
    }

    public function getDatePublication(): \DateTime
    {
        return $this->datePublication;
    }

    public function setDatePublication(string $datePublication): void
    {
        $this->datePublication = \DateTime::createFromFormat('d/m/Y', $datePublication);
    }

    public function setDureeEmprunt(): void
    {
        $this->dureeEmprunt = 15 ;
    }

}