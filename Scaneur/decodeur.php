    <?php require("./../Template/header.php"); ?>
    <link rel="stylesheet" href="./css/decodeur.css">
    <main class='corpsScaneur'>
        <div class="content">
            <video id="player" autoplay style="display: none"></video>
            <canvas id="videoCanvas"></canvas>
            <button id="photo">Scanner</button>
        </div>

        <div class="result">
            <button id="boutonJoueur" style="display: none;">Afficher Joueur</button>
        </div>
    </main>
    <?php require("./../Template/footer.php"); ?>
    <script async src="./librairie/opencv.js" type="text/javascript"></script>  
    <script src="./js/classObjet/licence.js"></script>
    <script src="./js/classObjet/grayCode.js"></script>
    <script src="./js/classObjet/listeRatios.js"></script>
    <script src="./js/classObjet/contoursObjet.js"></script>
    <script src="./js/classMethod/decodeur.js"></script>
    <script src="./js/main/mainDecodeur.js"></script>
</body>