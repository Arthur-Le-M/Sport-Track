<?php
session_start();
if(isset($_SESSION['user'])){
    header('location: accueil.php');
    exit;
}

$err = $_GET['err'] ?? null;
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
                    <?php if($err == 'true'){
                        print('<input class="inputElementErreur" type="email" name="email" placeholder="Email*">');
                    } 
                    else{
                        print('<input class="inputElement" type="email" name="email" placeholder="Email*">');
                    }

                    if($err == 'true'){
                        print('<input class="inputElementErreur" type="password" name="passwd" placeholder="Mot de passe*">');
                    } 
                    else{
                        print('<input class="inputElement" type="password" name="passwd" placeholder="Mot de passe*">');
                    }
                    if($err == 'true'){
                        print('<p class="messageErreur">Le mail ou le mot de passe est incorrect</p>');
                    }
                    ?>

                    
                    <input class="buttonFormulaire" type="submit" value="SE CONNECTER">
                </form>
                <p class="messageLinkToAnother">Vous n'avez pas de compte ?</p>
                <p class="linkToAnother"><a href="inscription.php">Inscription</a></p>
            </section>
        </main>
        <?php require("../Template/footer.php"); ?>
    </body>
</html>