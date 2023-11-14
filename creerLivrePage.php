
<?php

use Symfony\Component\Validator\Validation;

require "bootstrap.php";
require "vendor/autoload.php" ;

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $requete = new \App\UserStories\CreerLivre\CreerLivreRequete($_POST['isbn'], $_POST['titre'], $_POST['auteur'], $_POST['nombrePage'], $_POST['dateCreation']);
    $validateur = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
    $creerLivre = new \App\UserStories\CreerLivre\CreerLivre($entityManager, $validateur) ;

    try {
        $creerLivre->execute($requete);
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

<p class="titre">Creer un Livre : </p>

<form method="post" class="form">

    <div class="ligne-form">
        <label for="isbn">Entrer un ISBN : </label>
        <input type="text" name="isbn">
    </div>

    <div class="ligne-form">
        <label for="titre">Entrer un titre : </label>
        <input type="text" name="titre">
    </div>

    <div class="ligne-form">
        <label for="auteur">Entrer un auteur : </label>
        <input type="text" name="auteur">
    </div>

    <div class="ligne-form">
        <label for="nombrePage">Entrer un nombre de page : </label>
        <input type="text" name="nombrePage">
    </div>

    <div class="ligne-form">
        <label for="dateCreation">Entrer un date de Création du livre : </label>
        <input type="text" name="dateCreation">
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