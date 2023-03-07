<?php
session_start();
if(isset($_SESSION['user'])){
    header('location: accueil.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- En-tête de la page -->
        <meta charset="utf-8" />
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../Template/style.css">
				<link rel="stylesheet" href="style.css" />
    </head>

    <body>
        <?php require("../Template/header.php"); ?>
        <main>
            <section class="sectionTitre">
                <h2 class="titrePage">Connexion</h2>
            </section>
            <section class="sectionPage">
                <form class="formulaire" action="traitementConnexion.php" method="post">
                    <input class="inputElement" type="email" name="email" placeholder="Email*">
                    <input class="inputElement" type="password" name="passwd" placeholder="Mot de passe*">
                    <input class="buttonFormulaire" type="submit" value="SE CONNECTER">
                </form>
                <p class="messageLinkToAnother">Vous n'avez pas de compte ?</p>
                <p class="linkToAnother"><a href="inscription.php">Inscription</a></p>
            </section>
        </main>
        <?php require("../Template/footer.php"); ?>
    </body>
</html>