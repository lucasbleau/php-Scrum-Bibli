<?php

namespace App\UserStories\EmprunterMedia;


use App\Entite\Adherent;
use App\Entite\Emprunt;
use App\Entite\Livre;
use App\Entite\Media;
use App\Entite\StatutMedia;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class EmprunterMedia {
    private EntityManagerInterface $entityManager;
    private ValidatorInterface $validateur;

    /**
     * @param EntityManagerInterface $entityManager
     * @param ValidatorInterface $validateur
     */
    public function __construct(EntityManagerInterface $entityManager, ValidatorInterface $validateur)
    {
        $this->entityManager = $entityManager;
        $this->validateur = $validateur;
    }

    public function execute(EmprunterMediaRequete $requete) :bool|Exception {
        // Valider les données en entrées (de la requête)
        $erreur = $this->validateur->validate($requete);
        if ($erreur->count()<> 0) {
            $messageErreur = ($erreur->get(0))->getMessage();
            for ($i=1;$i<$erreur->count();$i++) {
                $messageErreur .= " et ".($erreur->get($i))->getMessage();
            }
            throw new \Exception($messageErreur);
        }

        // Vérifie que le media existe
        $media = $this->entityManager->getRepository(Media::class);
        if ($media->findOneBy(["id" => $requete->id]) == null) {
            throw new \Exception("Le media n'existe pas !");
        }

        // Vérifier que le media est disponible
        if (($media->findOneBy(["id" => $requete->id]))->getStatus() != StatutMedia::DISPO) {
            throw new \Exception("Le media n'est pas disponible");
        }

        // Vérifie que l'adherent existe
        $adherent = $this->entityManager->getRepository(Adherent::class);
        if ($adherent->findOneBy(["numeroAdherent" => $requete->numAdherent]) == null) {
            throw new \Exception("L'adherent n'existe pas !");
        }

        // Vérifier que l'adhésion de l'adhérent est valide
        if ((($adherent->findOneBy(["numeroAdherent" => $requete->numAdherent]))->getDateAdhesion())->modify("+1 year") < new \DateTime()) {
            throw new \Exception("L'adhésion de l'adhérent n'est pas valide");
        }

        // Recherche le Media
        $repository = $this->entityManager->getRepository(Media::class);
        $mediaRepository = $repository->findOneBy(["id" => $requete->id]);

        // Recherche l'adherent
        $repository = $this->entityManager->getRepository(Adherent::class);
        $adherentRepository = $repository->findOneBy(["numeroAdherent" => $requete->numAdherent]);

        // Creer l'emprunt
        $emprunt = new Emprunt();
        $emprunt->setMedia($mediaRepository);
        $emprunt->setAdherent($adherentRepository);
        $emprunt->setDateEmprunt();
        $emprunt->setDateRetourEstime();

        $this->entityManager->persist($emprunt);
        $this->entityManager->flush();
        return true;

    }


}