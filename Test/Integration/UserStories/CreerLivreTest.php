<?php

namespace Test\Integration\UserStories;

use App\Entite\Livre;
use App\Services\GenerateurNumeroAdherent;
use App\UserStories\CreerLivre\CreerLivre;
use App\UserStories\CreerLivre\CreerLivreRequete;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Doctrine\ORM\Exception\NotSupported;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\ToolsException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreerLivreTest extends TestCase
{
    protected EntityManagerInterface $entityManager;
    protected ValidatorInterface $validator;


    /**
     * @throws MissingMappingDriverImplementation
     * @throws ToolsException
     * @throws Exception
     */
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
    public function creerLivre_ValeursCorrects_True()
    {
        $requete = new CreerLivreRequete("142536", "titre1", "lucas", "52", "12/01/2003");
        $creerLivre = new CreerLivre($this->entityManager,$this->validator);

        $resultat = $creerLivre->execute($requete);

        $repository = $this->entityManager->getRepository(Livre::class);
        $livre = $repository->findOneBy(['isbn' => "142536"]);
        $this->assertNotNull($livre);
        $this->assertEquals("lucas", $livre->getAuteur());
    }

    #[test]
    public function creerLivre_IsbnDejaUtilise_Exception()
    {
        $requete = new CreerLivreRequete("142536", "titre1", "lucas", "52", "12/01/2003");
        $creerLivre = new CreerLivre($this->entityManager,$this->validator);

        $resultat = $creerLivre->execute($requete);

        $this->expectException(\Exception::class);
        $resultat = $creerLivre->execute($requete);
    }

    #[test]
    public function creerLivre_nombrePageSup0_Exception()
    {
        $requete = new CreerLivreRequete("142536", "titre1", "lucas", "0", "12/01/2003");
        $creerLivre = new CreerLivre($this->entityManager,$this->validator);

        $this->expectException(\Exception::class);
        $resultat = $creerLivre->execute($requete);
    }

}