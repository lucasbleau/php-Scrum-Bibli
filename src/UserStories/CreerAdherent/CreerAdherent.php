<?php

namespace App\UserStories\CreerAdherent;


use App\Entite\Adherent;
use App\Services\GenerateurNumeroAdherent;
use Doctrine\ORM\EntityManagerInterface;
use Dotenv\Validator;
use PHPUnit\Logging\Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use function PHPUnit\Framework\throwException;

class CreerAdherent
{
    private EntityManagerInterface $entityManager ;

    private GenerateurNumeroAdherent $numeroAdherent ;

    private ValidatorInterface $validator ;

    /**
     * @param EntityManagerInterface $entityManager
     * @param GenerateurNumeroAdherent $numeroAdherent
     * @param ValidatorInterface $validator
     */
    public function __construct(EntityManagerInterface $entityManager, GenerateurNumeroAdherent $numeroAdherent, ValidatorInterface $validator)
    {
        $this->entityManager = $entityManager;
        $this->numeroAdherent = $numeroAdherent;
        $this->validator = $validator;
    }

    public function execute(CreerAdherentRequete $requete) :  bool {

        // Valider les données en entrées (de la requête)

        $erreurs = $this->validator->validate($requete) ;
        if ($erreurs->count() > 0) {
            throw new \Exception('Les données ne sont pas renseignées', 1) ;
        }

        // Vérifier que l'email n'existe pas déjà

        $adherent = $this->entityManager->getRepository(Adherent::class) ;
        if ($adherent->findOneBy(['email' => $requete->email]) !== null)
        {
            throw new \Exception('Lemail existe déja', 2) ;
        }

        // Générer un numéro d'adhérent au format AD-999999

        $numeroAdherent = $this->numeroAdherent->generer();

        // Vérifier que le numéro n'existe pas déjà

        if ($adherent->findOneBy(['numeroAdherent' => $numeroAdherent]) <> null)
        {
            var_dump($numeroAdherent) ;
            throw new \Exception('Le numéro adhérant générer est déja utilisé', 3) ;
        }

        // Créer l'adhérent

        $adherent = new Adherent() ;
        $adherent->setNumeroAdherent($numeroAdherent);
        $adherent->setPrenom($requete->prenom);
        $adherent->setNom($requete->nom);
        $adherent->setEmail($requete->email);
        $adherent->setDateAdhesion(new \DateTime());

        // Enregistrer l'adhérent en base de données

        $this->entityManager->persist($adherent);
        $this->entityManager->flush();

        return true;
    }
}