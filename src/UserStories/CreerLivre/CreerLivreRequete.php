<?php

namespace App\UserStories\CreerLivre;

use Symfony\Component\Validator\Constraints as Assert;

class CreerLivreRequete
{
    #[Assert\NotBlank(
        message: "L'isbn est obligatoire"
    )]
    public string $isbn;
    #[Assert\NotBlank(
        message: "Le titre du Magazine est obligatoire"
    )]
    public string $titre;
    #[Assert\NotBlank(
        message: "Le nom de l'auteur est obligatoire"
    )]
    public string $auteur;

    #[Assert\NotBlank(
        message: "Le nombre de pages est obligatoire"
    )]
    public string $nombrePage;

    /**
     * @param string $isbn
     * @param string $titre
     * @param string $auteur
     * @param string $nombrePage
     */
    public function __construct(string $isbn, string $titre, string $auteur, string $nombrePage)
    {
        $this->isbn = $isbn;
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->nombrePage = $nombrePage;

    }
}