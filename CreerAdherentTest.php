<?php

require  'bootstrap.php' ;

$adherent = new \App\Entite\Adherents();

$adherent->setPrenom("lucas");
$adherent->setNom("bleau");
$adherent->setEmail("lucas.bleau@gmail.com");
$adherent->setDateAdhesion(new \DateTime());
$adherent->setNumeroAdherent();

$entityManager->persist($adherent);
$entityManager->flush();
