<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/mentions-legales.css">
    <!-- Lien vers le CSS du header et du footer -->
    <link rel="stylesheet" href="../Template/style.css">
    <title>Mentions Légales · Sport Track</title>
</head>

<body>
    <?php
    // Import du header (commun à toutes les pages)
    require "../Template/header.php";
    ?>
    <main>
        <div id="titre">
            <h2>Mentions Légales</h2>
            <p class="date">Date de la dernière mise à jour : 07/03/2023</p>
        </div>
        <section id="editeur">
            <h3>Editeur du site</h3>
            <p>Ce site a été conçu et réalisé en 2023 par l'équipe <strong>Sport-Track</strong>.</p>
            <div class="adresse">
                <p><span>Adresse Postale : </span>
                <ul>
                    <li>2 avenue du parc Montaury</li>
                    <li>64600 Anglet</li>
                    <li>FRANCE</li>
                </ul></p>
            </div>
            <div class="contact">
                <p><span>Email :</span> team@sport-track.live</p>
                <p>Tel : +33 1 02 03 04 05</p>
            </div>
            <div class="team">
                <p><span>Equipe :</span>
                <ul>
                    <li>Titouan Cocheril</li>
                    <li>Arthur Le Menn</li>
                    <li>Ivan Salle</li>
                    <li>Matis Chabanat</li>
                </ul></p>
            </div>
            <p><span>Site :</span> <a id="link" href="#">http://sport-track.live/</a></p>
        </section>

        <section id="hebergeur">
        <h3>Hébergeur du site</h3>
            <p>Ce site est hébergé par la plateforme de cloud <strong>Microsoft Azure</strong>.</p>
            <p><span>Siret :</span> 4901 1029</p>
            <div class="adresse">
                <p><span>Adresse Postale :</span> </p>
                <ul>
                    <li>2 rue Kellerman</li>
                    <li>33500 Bordeaux</li>
                    <li>FRANCE</li>
                </ul>
            </div>
        </section>
    </main>
    <?php
    // Import du footer (commun à toutes les pages)
    require "../Template/footer.php";
    ?>
</body>
</html>
