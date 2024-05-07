<?php

use Symfony\Component\Console\Style\SymfonyStyle;
require 'vendor/autoload.php' ;

$app = new \Silly\Application() ;

$app->command('ListerNouveauxMedias',function (SymfonyStyle $io)
    {
        require "bootstrap.php" ;
        $medias = (new \App\UserStories\ListerNouveauxMedias\ListerNouveauxMedias($entityManager))->execute();
        $table = $io->createTable();
        $table->setHeaderTitle("Liste des nouveaux médias");
        $table->setHeaders(['id', 'titre', 'statut', 'dateCreation', 'type']);
        $table->setRows($medias);
        $table->render();
    }
);

$app->run();
