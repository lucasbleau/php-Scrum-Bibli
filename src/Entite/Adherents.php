<?php

namespace App\Entite;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;


#[Entity]
#[Table(name: 'adherent')]

class Adherents
{
    #[Id]
    #[Column(name: 'id_adherent',type: 'integer')]
    #[GeneratedValue]
    private int $id;

    #[Column(name: 'numero_adherent',length: 10)]
    private string $numeroAdherent;

    #[Column(name: 'nom_adherent',length: 100)]
    private string $nom;

    #[Column(name: 'prenom_adherent',length: 100)]
    private string $prenom;
    #[Column(name: 'email_adherent',length: 100)]
    private string $email;
    #[Column(name: 'date_adhesion_adherent',length: 100)]
    private \DateTime $dateAdhesion;


    public function __construct()
    {
    }



    /**
     * @return int
     */
    public function getNumeroAdherent(): int
    {
        return $this->numeroAdherent;
    }

    /**
     * @param int $numeroAdherent
     */
    public function setNumeroAdherent(): void
    {
        $this->numeroAdherent = "AD-" . random_int(100000,999999);
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return DateTime
     */
    public function getDateAdhesion(): DateTime
    {
        return $this->dateAdhesion;
    }

    /**
     * @param DateTime $dateAdhesion
     */
    public function setDateAdhesion(\DateTime $dateAdhesion): void
    {
        $this->dateAdhesion = $dateAdhesion;
    }

}

