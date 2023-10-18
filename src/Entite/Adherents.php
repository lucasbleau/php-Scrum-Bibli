<?php

namespace App\Entite;
class Adherents
{
    private int $id;
    private int $numeroAdherent;
    private string $nom;
    private string $prenom;
    private string $email;
    private DateTime $dateAdhesion;

    /**
     * @param int $numeroAdherent
     */
    public function __construct(int $numeroAdherent)
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
    public function setNumeroAdherent(int $numeroAdherent): void
    {
        $this->numeroAdherent = $numeroAdherent;
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
    public function setDateAdhesion(DateTime $dateAdhesion): void
    {
        $this->dateAdhesion = $dateAdhesion;
    }


}

