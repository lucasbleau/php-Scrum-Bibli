<?php

namespace App\UserStories\RendreDisponibleMedia;


use App\Entite\Media;
use App\Entite\StatutMedia;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RendreDisponibleMedia{
    private EntityManagerInterface $entityManager;
    private ValidatorInterface $validateur;


    public function __construct(EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $this->entityManager = $entityManager;
        $this->validateur = $validator;
    }


    public function execute(RendreDisponibleMediaRequete $requete): bool{
        // Valider les données en entrées (de la requête)
        $erreur = $this->validateur->validate($requete);
        if ($erreur->count()<> 0) {
            $messageErreur = ($erreur->get(0))->getMessage();
            for ($i=1;$i<$erreur->count();$i++) {
                $messageErreur .= " et ".($erreur->get($i))->getMessage();
            }
            throw new \Exception($messageErreur);
        }

        //Vérifier que le média existe
        $repository = $this->entityManager->getRepository(Media::class);
        if ($repository->findOneBy(["id" => $requete->id]) == null) {
            throw new Exception("Ce média n'existe pas");
        }

        //Vérfier que le média a le statut nouveau
        if(($repository->findOneBy(["id" => $requete->id]))->getStatut() != StatutMedia::NEW){
            throw new Exception("Ce média n'est pas 'nouveau' (statut).");
        }

        $media = $repository->findOneBy(["id" => $requete->id]);
        $media->setStatut(StatutMedia::DISPO);
        $this->entityManager->persist($media);
        $this->entityManager->flush();
        return true;
    }
}