        <?php require("../Template/header.php"); 
        if(isset($_SESSION['user'])){
            header('location: ../Accueil/accueil_connecte.php');
            ob_end_flush();
            exit;
        }
        $err = $_GET['err'] ?? null;
        ?>
        <link rel="stylesheet" href="style.css" />
        <script src="script-connexion-inscription.js" defer></script>
        <main>
            <section class="sectionTitre">
                <h2 class="titrePage">Inscription</h2>
            </section>
            <section class="sectionPage">
                <form class="formulaire" action="traitementInscription.php" method="post">
                    <input class="inputElement" type="email" name="email" placeholder="Email*">
                    <input class="inputElement" type="password" name="passwd" placeholder="Mot de passe*">
                    <?php
                        if($err == 'licence'){
                            print('<input class="inputElementErreur" type="text" name="numLicence" placeholder="N° Licence*">');
                        } 
                        else{
                            print('<input class="inputElement" type="text" name="numLicence" placeholder="N° Licence*">');
                        }
                    ?>
                    <div class="validConditionContainer">
                        <input class="checkBox" type="checkbox" name="validCondition">
                        <label for="validCondition">Accepter les <a href="#" >conditions générales d'utilisations</a></label>
                    </div>
                    <?php
                        if($err == 'licence'){
                            print('<p class="messageErreur">Licence incorrect</p>');
                        }
                    ?>
                    <input class="buttonFormulaire" type="submit" value="S'INSCRIRE">
                </form>
                <p class="messageLinkToAnother">Vous avez déjà un compte ?</p>
                <p class="linkToAnother"><a href="connexion.php">Connexion</a></p>
            </section>
        </main>
        <?php require("../Template/footer.php"); ?>
    </body>
</html>