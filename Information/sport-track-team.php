<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/sport-track-team.css">
    <!-- Lien vers le CSS du header et du footer -->
    <link rel="stylesheet" href="../Template/style.css">
    <title>Qui sommes-nous · Sport Track</title>
</head>

<body>
    <?php
    // Import du header (commun à toutes les pages)
    require "../Template/header.php";
    ?>
    <main>
        <div id="titre">
            <h2>Sport Track</h2>
            <p>Qui sommes-nous ?</p>
        </div>
        <div id="sport-track-team">
            <img src="images/avatarArthur.png" alt="Avatar Arthur Le Menn" class="avatar">
            <img src="images/avatarMatis.png" alt="Avatar Matis Chabanat" class="avatar">
            <img src="images/avatarTitou.png" alt="Avatar Titouan Cocheril" class="avatar">
            <img src="images/avatarIvan.png" alt="Avatar Ivan Salle" class="avatar">
        </div>
        <div id="description">
            <section id="partie1">
                <div id="intitule">
                    <h3>
                        <p>L'histoire de</p>
                        <p id="marque">Sport Track</p>
                    </h3>
                    <img src="../Template/img/logo.png" alt="logo sport track">
                </div>
                <div id="texte">
                    <p>Sport Track a été fondée à Anglet, en 2021, dans le cadre de notre projet d'étude lors du BUT Informatique. C'est une application destinée à la gestion de clubs sportifs amateurs.</p>
                    <p>Elle est destinée aux sportifs licenciés qui souhaitent avoir un visuel sur leurs résultats/statistiques lors des matchs mais aussi sur ceux des autres.</p>
                    <p>Elle est aussi doté d'un système de messagerie qui permettront aux joueurs de communiquer entre-eux, mais aussi d'un calendrier qui recence les évènements avenir.</p>
                </div>
            </section>
            <section id="partie2">
                <h3>Vos interlocuteurs</h3>
                <div id="texte">
                    <p>Actuellement en deuxième année de BUT Informatique à Anglet, notre équipe est composée de quatre membres, chacun apportant sa propre expertise et ses compétences uniques pour faire avancer notre projet.</p>
                    <p>Retournons sur les 4 avatars que l'on retrouve en haut de page. Nous retrouvons respectivement <strong>Arthur Le Menn</strong>, <strong>Matis Chabanat</strong>, <strong>Titouan Cocheril</strong> et <strong>Ivan Salle</strong>.</p>
                    <p>Nous avons choisi le thème du sport car étant nous 4 de grands sportifs, cela nous tenait à coeur de réaliser un projet sur ce thème.</p>
                </div> 
            </section>
        </div>
    </main>
    <?php
    // Import du footer (commun à toutes les pages)
    require "../Template/footer.php";
    ?>
</body>
</html>
