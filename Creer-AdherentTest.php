<?php

require  'bootstrap.php' ;

$adherent = new \App\Entite\Adherent();

$adherent->setPrenom("toto");
$adherent->setNom("bleau");
$adherent->setEmail("lucas.bleau@gmail.com");
$adherent->setDateAdhesion(new \DateTime());
$adherent->setNumeroAdherent("3");

$entityManager->persist($adherent);
$entityManager->flush();
