<?php

class Emprunts
{
    protected int $id ;

    private DateTime $dateEmprunt ;
    private DateTime $dateRetourEstime ;
    private DateTime $dateRetour ;
    private Adherents $adherents ;
    private Media $media ;
    public function __construct()
    {
    }

    /**
     * @return DateTime
     */
    public function getDateEmprunt(): DateTime
    {
        return $this->dateEmprunt;
    }

    /**
     * @param DateTime $dateEmprunt
     */
    public function setDateEmprunt(DateTime $dateEmprunt): void
    {
        $this->dateEmprunt = $dateEmprunt;
    }

    /**
     * @return DateTime
     */
    public function getDateRetourEstime(): DateTime
    {
        return $this->dateRetourEstime;
    }

    /**
     * @param DateTime $dateRetourEstime
     */
    public function setDateRetourEstime(DateTime $dateRetourEstime): void
    {
        $this->dateRetourEstime = $dateRetourEstime;
    }

    /**
     * @return DateTime
     */
    public function getDateRetour(): DateTime
    {
        return $this->dateRetour;
    }

    /**
     * @param DateTime $dateRetour
     */
    public function setDateRetour(DateTime $dateRetour): void
    {
        $this->dateRetour = $dateRetour;
    }


}