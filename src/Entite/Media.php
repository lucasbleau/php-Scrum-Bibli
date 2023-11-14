<?php

namespace App\Entite;


use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\InheritanceType;

#[Entity]
#[InheritanceType("JOINED")]
#[DiscriminatorColumn(name: "type", type: "string")]
#[DiscriminatorMap(["livre" => "Livre", "blueray" => "BlueRay", "magazine" => "Magazine"])]
abstract class Media
{
    #[Id]
    #[GeneratedValue]
    #[Column(name: "id_media", type: "integer")]
    protected int $id;

    #[Column(name: "titre", length: "50")]
    protected string $titre;
    #[Column(name: "statut", length: "20")]
    protected string $statut;
    #[Column(name: "date_creation", length: "20")]
    protected \DateTime $dateCreation;
    #[Column(name: "duree_emprunt", length: "20")]
    protected int $dureeEmprunt;

    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getStatut(): string
    {
        return $this->statut;
    }

    /**
     * @param string $statut
     */
    public function setStatut(string $statut): void
    {
        $this->statut = $statut;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreation(): \DateTime
    {
        return $this->dateCreation;
    }

    /**
     * @param string $dateCreation
     */
    public function setDateCreation(string $dateCreation): void
    {
        $this->dateCreation = \DateTime::createFromFormat('d/m/Y', $dateCreation);
    }

    /**
     * @return \DateTime
     */
    public function getDateEmprunt(): \DateTime
    {
        return $this->dateEmprunt;
    }

    /**
     * @param \DateTime $dateEmprunt
     */
    public function setDateEmprunt(\DateTime $dateEmprunt): void
    {
        $this->dateEmprunt = $dateEmprunt;
    }

    public function setDureeEmprunt() : void
    {
    }

}