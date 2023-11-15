<?php

use App\UserStories\CreerMagazine\CreerMagazine;
use App\UserStories\CreerMagazine\CreerMagazineRequete;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Validator\Validation;

require "vendor/autoload.php";

$app = new \Silly\Application();

$app->command('CreationMagazine ', function (SymfonyStyle $io) {
    require "bootstrap.php";
    $io->title("Creation d'un Magazine");
    $validateur = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();

    $numeroPublication = $io->ask("Entrer le numero de publication", 0);
    $titre = $io->ask("Entrer un titre", 0);
    $datePublication = $io->ask("Entrer une date de publication", "dd/mm/aaaa");

    $requete = new CreerMagazineRequete($numeroPublication, $titre, $datePublication);
    $magazine = new CreerMagazine($entityManager, $validateur);

    try {
        $magazine->execute($requete);
        echo "le magazine à bien été creer !";
    } catch (\Exception $e) {
        echo $e->getMessage();
    }

}
);

$app->run();