<?php session_start();
require "config.php"; // Lien pour la connexion a la BD
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="messagerie.css">
    <title>Sport Track - Messagerie</title>
</head>
<body>
    <?php
    // Import du header (commun à toutes les pages)
    // require "header.php";
    ?>
    <header></header>

    <main>
        <div id="modal">
            <div id="modalDesc">
                <input type="text" placeholder="Saisir un utilisateur ..." name="pseudo" id="input-pseudo">
                <p id="resultat">Resultat de la recherche.</p>
                <div id="tous-les-joueurs"></div>
            </div>
        </div>
        <article id="messagerie">
            <section id="contacts">
                <a id="nv-conv">Nouveau Contact</a>
                <div id="tous-les-contacts">
                    <p id="no-conversation">Aucune conversation commencée.</p>
                </div>
            </section>
            <section id="conversation">
                <div id="info-conv">
                    <p id="entete-user">Sélectionnez un contact pour afficher votre conversation.</p>
                </div>
            </section>
        </article>
        <div id="champ-vide"></div>
        <input type="hidden" name="id_client" value="<?php echo $id; ?>">
    </main>

    <?php
    // Import du footer (commun à toutes les pages)
    // require "footer.php";
    ?>
    <script src="app.js"></script>
</body>
</html>
