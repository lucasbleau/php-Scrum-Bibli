
<?php

use App\UserStories\CreerMagazine\CreerMagazine;
use App\UserStories\CreerMagazine\CreerMagazineRequete;
use Symfony\Component\Validator\Validation;

require "bootstrap.php";
require "vendor/autoload.php" ;

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $requete = new CreerMagazineRequete($_POST['numeroPublication'], $_POST['titre'], $_POST['datePublication']);
    $validateur = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
    $creerMagazine = new CreerMagazine($entityManager, $validateur) ;

    try {
        $creerMagazine->execute($requete);
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

<div>
    <a href="index.php" class="retour">Retour</a>
    <p class="titre">Creer un Magazine : </p>
</div>

<form method="post" class="form">

    <div class="ligne-form">
        <label for="numeroPublication">Numero de publication : </label>
        <input type="text" name="numeroPublication"
            <?php
            if (isset($_POST['numeroPublication'])) {
                ?> value="<?= $_POST['numeroPublication'] ?>"
            <?php } ?> >
    </div>

    <div class="ligne-form">
        <label for="titre">Titre : </label>
        <input type="text" name="titre"
            <?php
            if (isset($_POST['titre'])) {
                ?> value="<?= $_POST['titre'] ?>"
            <?php } ?> >
    </div>

    <div class="ligne-form">
        <label for="datePublication">Date de publication: </label>
        <input type="text" name="datePublication"
            <?php
            if (isset($_POST['datePublication'])) {
                ?> value="<?= $_POST['datePublication'] ?>"
            <?php } ?> >
    </div>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($message))
        {
            ?>
            <div class="message-form">
                <p> <?= $message ?> </p>
            </div>
            <?php
        } else {
            ?>
            <div class="message-just-form">
                <p> Magazine créé avec succès </p>
            </div>
            <?php
        }
    }

    ?>

    <div class="bouton-form">
        <input type="submit" value="Créer">
    </div>

</form>

</body>
</html>