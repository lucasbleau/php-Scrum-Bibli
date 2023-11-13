<?php

namespace Test\Integration\UserStories;

use App\Entite\Adherent;
use App\Services\GenerateurNumeroAdherent;
use App\UserStories\CreerAdherent\CreerAdherentRequete;
use App\UserStories\CreerAdherent\CreerAdherent;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\NotSupported;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\SchemaTool;
use Dotenv\Validator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreerAdherentTest extends TestCase
{
    protected EntityManagerInterface $entityManager;
    protected GenerateurNumeroAdherent $generateur;
    protected ValidatorInterface $validator;

    // cette methode va etre executé avant chaque test
    protected function setUp() : void
    {
        echo "setup ---------------------------------------------------------";
        // Configuration de Doctrine pour les tests
        $config = ORMSetup::createAttributeMetadataConfiguration(
            [__DIR__.'/../../../src/'],
            true
        );

        // Configuration de la connexion à la base de données
        // Utilisation d'une base de données SQLite en mémoire
        $connection = DriverManager::getConnection([
            'driver' => 'pdo_sqlite',
            'path' => ':memory:'
        ], $config);

        // Création des dépendances
        $this->entityManager = new EntityManager($connection, $config);
        $this->generateur = new GenerateurNumeroAdherent();
        $this->validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();

        // Création du schema de la base de données
        $schemaTool = new SchemaTool($this->entityManager);
        $metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();
        $schemaTool->createSchema($metadata);
    }

    /**
     * @throws NotSupported
     */
    #[test]
    public function creerAdherent_ValeursCorrectes_True() {

        // Arrange

        $requete = new CreerAdherentRequete("john", "doe", "john.doe@test.com") ;
        $creerAdherent = new CreerAdherent($this->entityManager, $this->generateur, $this->validator);

        // Act

        $resultat = $creerAdherent->execute($requete) ;

        // Assert

        $repository = $this->entityManager->getRepository(Adherent::class) ;
        $adherent = $repository->findOneBy(['email' => "john.doe@test.com"]) ;
        $this->assertNotNull($adherent);
        $this->assertEquals("john", $adherent->getPrenom());

    }

    #[test]
    public function creerAdherent_ValeurFausses_Exception() {

        // Arrange

        $requete = new CreerAdherentRequete("", "", "") ;
        $adherent = new CreerAdherent($this->entityManager, $this->generateur, $this->validator) ;

        // Act

        $this->expectException(\Exception::class);
        $resultat = $adherent->execute($requete) ;

    }

    #[test]
    public function creerAdherent_ValeurPrenomNonRemplie_Exception() {

        // Arrange

        $requete = new CreerAdherentRequete("", "doe", "john.doe@test.com") ;
        $adherent = new CreerAdherent($this->entityManager, $this->generateur, $this->validator) ;

        // Act

        $this->expectException(\Exception::class);
        $resultat = $adherent->execute($requete) ;
    }

    #[test]
    public function creerAdherent_ValeurNomNonRemplie_Exception() {

        // Arrange

        $requete = new CreerAdherentRequete("john", "", "john.doe@test.com") ;
        $adherent = new CreerAdherent($this->entityManager, $this->generateur, $this->validator) ;

        // Act

        $this->expectException(\Exception::class);
        $resultat = $adherent->execute($requete) ;
    }
}