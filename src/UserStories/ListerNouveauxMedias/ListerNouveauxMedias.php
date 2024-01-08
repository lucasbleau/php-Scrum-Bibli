<?php

namespace App\UserStories\ListerNouveauxMedias;
require "./vendor/autoload.php";

use App\Entite\Media;
use App\Entite\StatutMedia;
use Doctrine\ORM\EntityManagerInterface;

class ListerNouveauxMedias
{
    private EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function execute() :  array {
        $repository = $this->entityManager->getRepository(Media::class);
        $mediaRepository = $repository->findBy(["statut" => StatutMedia::NEW], ["dateCreation" => "DESC"]);
        $medias = [];
        foreach($mediaRepository as $media)
        {
            $medias[] = ["id" => $media->getId(), "titre" => $media->getTitre(), "statut" => $media->getStatut(), "dateCreation" => $media->getDateCreation(), "type" => $media->getType()];
        }

        return $medias;
    }
}