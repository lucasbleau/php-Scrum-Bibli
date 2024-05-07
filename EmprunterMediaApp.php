<?php

use App\UserStories\CreerLivre\CreerLivre;
use App\UserStories\CreerLivre\CreerLivreRequete;
use App\UserStories\EmprunterMedia\EmprunterMedia;
use App\UserStories\EmprunterMedia\EmprunterMediaRequete;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Validator\Validation;

require "./vendor/autoload.php";


$app = new \Silly\Application();

$app->command('EmprunterMedia', function (SymfonyStyle $io ) {
    require "bootstrap.php";
    $validateur = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
    $io->title("Emprunter un media");
    $id = $io->ask("Veuillez saisir l'id du média","");
    $numAdherent = $io->ask("Veuillez saisir le numéro d'adhérent","");


    $requete = new EmprunterMediaRequete($id,$numAdherent);
    $empruntMedia = new EmprunterMedia($entityManager,$validateur);

    try {
        $empruntMedia->execute($requete);
        $io->writeln("L'emprunt a bien été créer !");
    } catch (\Exception $e) {
        $io->error($e->getMessage());
    }
});

$app->run();