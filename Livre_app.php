<?php

use App\UserStories\CreerLivre\CreerLivre;
use App\UserStories\CreerLivre\CreerLivreRequete;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Validator\Validation;

require "vendor/autoload.php";

$app = new \Silly\Application();

$app->command('CreationLivre ',function (SymfonyStyle $io)
{
    require "bootstrap.php";
    $io->title("Creation d'un Livre");
    $validateur = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
    $isbn = $io->ask("Entrer l'isbn", 0);
    $titre = $io->ask("Entrer un titre", 0);
    $auteur = $io->ask("Entrer un auteur", 0);
    $nombrePage= $io->ask("Entrer un nombre de page", 0);

    $requete = new CreerLivreRequete($isbn, $titre,$auteur,$nombrePage);
    $livre = new CreerLivre($entityManager,$validateur);

    try {
        $livre->execute($requete);
        echo "le livre à bien été creer !" ;
    } catch (\Exception $e) {
        echo $e->getMessage();
    }

}
) ;

$app->run();