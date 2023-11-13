<?php

namespace App\Entite;

class Magazine extends Media
{
    protected int $numeroPublication;
    protected DateTime $datePublication;

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

    /**
     * @return DateTime
     */
    public function getDatePublication(): DateTime
    {
        return $this->datePublication;
    }

    /**
     * @param DateTime $datePublication
     */
    public function setDatePublication(DateTime $datePublication): void
    {
        $this->datePublication = $datePublication;
    }


}