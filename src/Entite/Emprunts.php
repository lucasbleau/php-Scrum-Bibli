<?php

namespace App\Entite;


class Emprunts
{
    private int $id;
    private \DateTime $dateEmprunt;
    private \DateTime $dateRetourEstime;
    private ?\DateTime $dateRetour;
    private Adherents $adherents;
    private Media $media;

    public function __construct()
    {
        $this->dateRetour = null ;
    }

    public function verifierEmpruntEnCours(): bool
    {
        if ($this->dateRetour == null) {
            return true;
        } else {
            return false;
        }
    }

    public function verifierEmpruntDepasser(): bool
    {
        if ($this->verifierEmpruntEnCours()) {
            $dateRetourEstime = new \DateTime();
            $dateRetour = $this->dateRetourEstime;
            if ($dateRetour->diff($dateRetourEstime)->invert == 0) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    public function getDateEmprunt(): \DateTime
    {
        return $this->dateEmprunt;
    }

    /**
     * @param DateTime $dateEmprunt
     */
    public function setDateEmprunt(\DateTime $dateEmprunt): void
    {
        $this->dateEmprunt = $dateEmprunt;
    }


    public function getDateRetourEstime(): \DateTime
    {
        return $this->dateRetourEstime;
    }

    /**
     * @param DateTime $dateRetourEstime
     */
    public function setDateRetourEstime(\DateTime $dateRetourEstime): void
    {
        $this->dateRetourEstime = $dateRetourEstime;
    }

    /**
     * @return DateTime
     */
    public function getDateRetour(): \DateTime
    {
        return $this->dateRetour;
    }

    /**
     * @param DateTime $dateRetour
     */
    public function setDateRetour(\DateTime $dateRetour): void
    {
        $this->dateRetour = $dateRetour;
    }

    /**
     * @return Adherents
     */
    public function getAdherents(): Adherents
    {
        return $this->adherents;
    }

    /**
     * @param Adherents $adherents
     */
    public function setAdherents(Adherents $adherents): void
    {
        $this->adherents = $adherents;
    }

    /**
     * @return Media
     */
    public function getMedia(): Media
    {
        return $this->media;
    }

    /**
     * @param Media $media
     */
    public function setMedia(Media $media): void
    {
        $this->media = $media;
    }

}
