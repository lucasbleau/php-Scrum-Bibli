<?php

namespace App\Entite;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;

#[Entity]
class Emprunt
{
    #[Id]
    #[Column(name: 'id_emprunt',type: 'integer')]
    #[GeneratedValue]
    private int $id;
    #[Column(type: 'datetime')]
    private \DateTime $dateEmprunt;
    #[Column(type: 'datetime')]
    private \DateTime $dateRetourEstime;
    #[Column(type: 'datetime',nullable: True)]
    private ?\DateTime $dateRetour;
    #[ManyToOne(targetEntity: Adherent::class)]
    #[JoinColumn(name: 'id_adherent', referencedColumnName: 'id_adherent')]
    private Adherent $adherent;
    #[OneToOne(targetEntity: Media::class)]
    #[JoinColumn(name: 'id_media', referencedColumnName: 'id_media')]
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
     * @param Adherent $adherent
     */
    public function setAdherent(Adherent $adherent): void
    {
        $this->adherent = $adherent;
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
    public function setDateEmprunt(): void
    {
        $this->dateEmprunt = new \DateTime();
    }


    public function getDateRetourEstime(): \DateTime
    {
        return $this->dateRetourEstime;
    }

    /**
     * @param DateTime $dateRetourEstime
     */
    public function setDateRetourEstime(): void
    {
        $this->dateRetourEstime = (new \DateTime())->modify("+".$this->media->getDureeEmprunt()." days");
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
     * @return Adherent
     */
    public function getAdherents(): Adherent
    {
        return $this->adherents;
    }

    /**
     * @param Adherent $adherents
     */
    public function setAdherents(Adherent $adherents): void
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
