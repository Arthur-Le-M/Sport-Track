<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="politique-de-conf.css">
    <!-- Lien vers le CSS du header et du footer -->
    <link rel="stylesheet" href="../Template/style.css">
    <title>Politique de confidentialité · Sport Track</title>
</head>

<body>
    <?php
    // Import du header (commun à toutes les pages)
    require "../Template/header.php";
    ?>
    <main>
        <div id="titre">
            <h2>Politique de confidentialité</h2>
            <p class="date">Date de la dernière mise à jour : 07/03/2023</p>
        </div>
    </main>
    <?php
    // Import du footer (commun à toutes les pages)
    require "../Template/footer.php";
    ?>
</body>
</html>
