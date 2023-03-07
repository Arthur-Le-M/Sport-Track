<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- En-tête de la page -->
        <meta charset="utf-8" />
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<link rel="stylesheet" href="style.css" />
                <link rel="stylesheet" href="../Template/style.css">
    </head>

    <body>
        <?php require("../Template/header.php"); ?>
        <main>
            <section class="sectionTitre">
                <h2 class="titrePage">Inscription</h2>
            </section>
            <section class="sectionPage">
                <form class="formulaire" action="traitementInscription.php" method="post">
                    <input class="inputElement" type="email" name="email" placeholder="Email*">
                    <input class="inputElement" type="password" name="passwd" placeholder="Mot de passe*">
                    <input class="inputElement" type="text" name="numLicence" placeholder="N° Licence*">
                    <div class="validConditionContainer">
                        <input class="checkBox" type="checkbox" name="validCondition">
                        <label for="validCondition">Accepter les <a href="#" >conditions générales d'utilisations</a></label>
                    </div>
                    <input class="buttonFormulaire" type="submit" value="S'INSCRIRE">
                </form>
                <p class="messageLinkToAnother">Vous avez déjà un compte ?</p>
                <p class="linkToAnother"><a href="connexion.php">Connexion</a></p>
            </section>
        </main>
        <?php require("../Template/footer.php"); ?>
    </body>
</html>