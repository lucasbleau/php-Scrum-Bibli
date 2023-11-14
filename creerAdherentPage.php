
<?php

use Symfony\Component\Validator\Validation;

require "bootstrap.php";
require "vendor/autoload.php" ;

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $requete = new \App\UserStories\CreerAdherent\CreerAdherentRequete($_POST['prenom'], $_POST['nom'], $_POST['email']) ;
    $generateur = new \App\Services\GenerateurNumeroAdherent();
    $validateur = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
    $creerAdherent = new App\UserStories\CreerAdherent\CreerAdherent($entityManager, $generateur, $validateur);

    try {
        $creerAdherent->execute($requete);
    } catch (\Exception $e) {
        $message = $e->getMessage();
    }

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

<a href="index.php" class="retour">Retour</a>

<p class="titre">Creer un Adherent : </p>

<form method="post" class="form">

    <div class="ligne-form">
        <label for="prenom">Entrer un Prenom : </label>
        <input type="text" name="prenom">
    </div>

    <div class="ligne-form">
        <label for="nom">Entrer un Nom : </label>
        <input type="text" name="nom">
    </div>

    <div class="ligne-form">
        <label for="email">Entrer un Email : </label>
        <input type="text" name="email">
    </div>


        <?php

            if (isset($message))
            {
                ?>
                <div class="message-form">
                    <p> <?= $message ?> </p>
                </div>
                <?php
            }

        ?>

    <div class="bouton-form">
        <input type="submit" value="Créer">
    </div>

</form>

</body>
</html>