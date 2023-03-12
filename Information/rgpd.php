<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/rgpd.css">
    <!-- Lien vers le CSS du header et du footer -->
    <link rel="stylesheet" href="../Template/style.css">
    <title>RGPD · Sport Track</title>
</head>

<body>
    <?php
    // Import du header (commun à toutes les pages)
    require "../Template/header.php";
    ?>
        <div id="titre">
            <h2>RGPD</h2>
            <p class="date">Date de la dernière mise à jour : 07/03/2023</p>
        </div>
        <main>
        <p class='rgpdP'>Le RGPD (Règlement Général sur la Protection des Données) est une réglementation européenne qui régit la protection des données personnelles des citoyens de l'Union Européenne. Ce règlement vise à renforcer les droits des individus en matière de protection de leurs données personnelles, ainsi qu'à responsabiliser les entreprises et organisations qui traitent ces données. Le RGPD contient des dispositions concernant la collecte, le traitement, la conservation et la destruction des données personnelles, ainsi que des mesures de sécurité à mettre en place pour protéger ces données contre les fuites, les pertes ou les piratages. Le RGPD impose également des sanctions en cas de non-respect de ces dispositions, afin de garantir une protection efficace des données personnelles.</p>
        <a href="../Information/doc/RGPD.pdf" class="buttonDownload">Download</a>
    </main>
    <?php
    // Import du footer (commun à toutes les pages)
    require "../Template/footer.php";
    ?>
</body>
</html>