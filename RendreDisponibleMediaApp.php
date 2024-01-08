<?php

use App\UserStories\RendreDisponibleMedia\RendreDisponibleMedia;
use App\UserStories\RendreDisponibleMedia\RendreDisponibleMediaRequete;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\ValidatorBuilder;

require "./vendor/autoload.php";


$app = new \Silly\Application();

$app->command('RendreDisponibleUnMedia', function (SymfonyStyle $io) {
    require "bootstrap.php";
    $validateur = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
    $io->title("Rendre un nouveau média disponible");
    $id = $io->ask("Quel est l'id du média à modifier ?");
    $requete = new RendreDisponibleMediaRequete($id);
    $validateur = (new ValidatorBuilder())->enableAnnotationMapping()->getValidator();
    $rendreDisponible = new RendreDisponibleMedia($entityManager,$validateur);

    try{
        $rendreDisponible->execute($requete);
        // Si pas d'exception lancer
        $io->writeln("Le statut du média a été modifier !");
    }catch (Exception $e){
        $io->error($e->getMessage());
    }
});

$app->run();