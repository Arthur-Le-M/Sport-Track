<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/contact.css">
    <!-- Lien vers le CSS du header et du footer -->
    <link rel="stylesheet" href="../Template/style.css">
    <title>Contact · Sport Track</title>
</head>

<body>
    <?php
    // Import du header (commun à toutes les pages)
    require "../Template/header.php";
    ?>
    <main>
        <div id="info-contact">
            <p id="text1">Besoin d'aide ? Une question ? Un problème à résoudre ?</p>
            <p id="text2">Contactez-nous !</p>
            <p id="text3">Notre équipe est là pour vous aider.</p>
        </div>
        <form method="post" action="contact-traitement.php">
            <div class="form-group">
                <label for="nom">Nom - Prénom :</label>
                <input type="text" placeholder="Luc Leclerc" id="nom" name="nom" required>
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" placeholder="lucleclerc@exemple.com" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="objet">Objet :</label>
                <input type="text" placeholder="Je n'arrive pas à ..." id="objet" name="objet" required>
            </div>

            <div class="form-group">
                <label for="message">Message :</label>
                <textarea placeholder="Comment pouvons-nous vous aider ?" id="message" name="message" rows="5" required></textarea>
            </div>

            <button type="submit">Envoyer</button>
            <!-- <?php if (isset($_GET['result'])) : ?>
                <div class="message<?= strpos($_GET['result'], 'Erreur') !== false ? 'error' : 'success'; ?>"><?= $_GET['result']; ?></div>
            <?php endif; ?> -->
        </form>
    </main>
    <?php
    // Import du footer (commun à toutes les pages)
    require "../Template/footer.php";
    ?>
</body>
</html>