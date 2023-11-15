<?php

namespace App\UserStories\CreerMagazine;

use App\Entite\Magazine;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreerMagazine
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

    public function execute(CreerMagazineRequete $requete) : bool
    {
        // Valider les données en entrées (de la requête)

        $erreurs = $this->validator->validate($requete) ;
        if ($erreurs->count() > 0) {
            throw new \Exception('Les données ne sont pas renseignées', 1) ;
        }

        // Vérifier que le numero de publication n'existe pas déjà

        $magazine = $this->entityManager->getRepository(Magazine::class) ;
        if ($magazine->findOneBy(['numeroPublication' => $requete->numeroPublication]) != null)
        {
            throw new \Exception('Le numero de publication existe déja', 2) ;
        }

        // Créer le Magazine

        $magazine = new Magazine();
        $magazine->setNumeroPublication($requete->numeroPublication);
        $magazine->setTitre($requete->titre);
        $magazine->setDatePublication($requete->datePublication);
        $magazine->setDateCreation();
        $magazine->setDureeEmprunt();
        $magazine->setStatut("Nouveau");

        // Enregistrer le magazine en base de données

        $this->entityManager->persist($magazine);
        $this->entityManager->flush();

        return true;
    }
}