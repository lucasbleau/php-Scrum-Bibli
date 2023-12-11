
<?php

use App\UserStories\CreerLivre\CreerLivre;
use App\UserStories\CreerLivre\CreerLivreRequete;
use Symfony\Component\Validator\Validation;

require "bootstrap.php";
require "vendor/autoload.php" ;

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $requete = new CreerLivreRequete($_POST['isbn'], $_POST['titre'], $_POST['auteur'], $_POST['nombrePage']);
    $validateur = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
    $creerLivre = new CreerLivre($entityManager, $validateur) ;

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



<div>
    <a href="index.php" class="retour">Retour</a>
    <p class="titre">Creer un Livre : </p>
</div>

<form method="post" class="form">

    <div class="ligne-form">
        <label for="isbn">ISBN : </label>
        <input type="text" name="isbn"
            <?php
            if (isset($_POST['isbn'])) {
                ?> value="<?= $_POST['isbn'] ?>"
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
        <label for="auteur">Auteur : </label>
        <input type="text" name="auteur"
            <?php
            if (isset($_POST['auteur'])) {
                ?> value="<?= $_POST['auteur'] ?>"
            <?php } ?> >
    </div>

    <div class="ligne-form">
        <label for="nombrePage">Nombre de page : </label>
        <input type="text" name="nombrePage"
            <?php
            if (isset($_POST['nombrePage'])) {
                ?> value="<?= $_POST['nombrePage'] ?>"
            <?php } ?> >
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