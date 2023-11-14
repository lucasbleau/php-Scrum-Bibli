<?php

namespace App\UserStories\CreerLivre;

use App\Entite\Livre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreerLivre
{
    private EntityManagerInterface $entityManager ;

    private ValidatorInterface $validator ;

    /**
     * @param EntityManagerInterface $entityManager
     * @param ValidatorInterface $validator
     */
    public function __construct(EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    public function execute(CreerLivreRequete $requete) : bool
    {
        // Valider les données en entrées (de la requête)

        $erreurs = $this->validator->validate($requete) ;
        if ($erreurs->count() > 0) {
            throw new \Exception('Les données ne sont pas renseignées', 1) ;
        }

        // Vérifier que l'isbn n'existe pas déjà

        $livre = $this->entityManager->getRepository(Livre::class) ;
        if ($livre->findOneBy(['isbn' => $requete->isbn]) != null)
        {
            throw new \Exception('L isbn existe déja', 2) ;
        }

        // Vérifier que le nombre de page renseignée est supérieur à 0

        if ($requete->nombrePage <= 0)
        {
            throw new \Exception('Le nombre de page est egal à 0') ;
        }

        // Créer le livre

        $livre = new Livre() ;
        $livre->setIsbn($requete->isbn);
        $livre->setTitre($requete->titre);
        $livre->setAuteur($requete->auteur);
        $livre->setNombrePage($requete->nombrePage);
        $livre->setDateCreation($requete->dateCreation);
        $livre->setDureeEmprunt();
        $livre->setStatut("Nouveau");

        // Enregistrer l'adhérent en base de données

        $this->entityManager->persist($livre);
        $this->entityManager->flush();

        return true;
    }
}