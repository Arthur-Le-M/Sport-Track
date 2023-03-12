
    <?php
    // Import du header (commun à toutes les pages)
    require "../Template/header.php";
    ?>
    <link rel="stylesheet" href="./css/contact.css">
    <main>
        <div id="info-contact">
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