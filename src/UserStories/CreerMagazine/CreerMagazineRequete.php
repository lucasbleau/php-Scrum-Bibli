<?php

namespace App\UserStories\CreerMagazine;

use Symfony\Component\Validator\Constraints as Assert;

class CreerMagazineRequete
{
    #[Assert\NotBlank(
        message: "Le numero de publication est obligatoire"
    )]
    public string $numeroPublication;
    #[Assert\NotBlank(
        message: "Le titre du livre est obligatoire"
    )]
    public string $titre;
    #[Assert\NotBlank(
        message: "La date de publication est obligatoire"
    )]
    public string $datePublication;


    /**
     * @param string $numeroPublication
     * @param string $titre
     * @param string $datePublication
     */
    public function __construct(string $numeroPublication, string $titre, string $datePublication)
    {
        $this->numeroPublication = $numeroPublication;
        $this->titre = $titre;
        $this->datePublication = $datePublication;
    }
}