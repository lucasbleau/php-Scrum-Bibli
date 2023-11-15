<?php

namespace Test\Integration\UserStories;

use App\Entite\Magazine;
use App\UserStories\CreerLivre\CreerLivre;
use App\UserStories\CreerMagazine\CreerMagazine;
use App\UserStories\CreerMagazine\CreerMagazineRequete;
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

class CreerMagazineTest extends TestCase
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
    public function creerMagazine_ValeursCorrects_True()
    {
        $requete = new CreerMagazineRequete("142536", "titre1", "12/12/2002");
        $creerMagazine = new CreerMagazine($this->entityManager,$this->validator);

        $resultat = $creerMagazine->execute($requete);

        $repository = $this->entityManager->getRepository(Magazine::class);
        $magazine = $repository->findOneBy(['numeroPublication' => "142536"]);
        $this->assertNotNull($magazine);
        $this->assertEquals("142536", $magazine->getNumeroPublication());
    }

    #[test]
    public function creerMagazine_ValeursNonRentre_Exception()
    {
        $requete = new CreerMagazineRequete("", "titre1", "12/12/2002");
        $creerMagazine = new CreerMagazine($this->entityManager,$this->validator);

        $this->expectException(\Exception::class);
        $resultat = $creerMagazine->execute($requete);

    }
}