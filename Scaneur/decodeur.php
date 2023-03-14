    <?php 
    require("./../Template/header.php");
    if(!isset($_SESSION['user'])){
        header('location: ../Inscription_Connexion/connexion.php');
        ob_end_flush();
        exit;
    }
    ?>
    <link rel="stylesheet" href="./css/decodeur.css">
    <main class='corpsScaneur'>
        <div class="content">
            <video id="player" autoplay style="display: none"></video>
            <canvas id="videoCanvas"></canvas>
            <button id="photo">Scanner</button>
        </div>
    <div class="result">
        <canvas id="canvas" width="320" height="240"></canvas>
        <canvas type=hidden id="hiddenCanvas"></canvas>
        <canvas id="output1"></canvas>
        <canvas id="output2"></canvas>
        <canvas id="output3"></canvas>
        <canvas id="output4"></canvas>
        <canvas id="output5"></canvas>
        <p id="text"></p>
        <button id="boutonJoueur" style="display: none;">Afficher Joueur</button>
    </div>

    </main>
    <script async src="./librairie/opencv.js" type="text/javascript"></script>  
    <script src="./js/classObjet/licence.js"></script>
    <script src="./js/classObjet/grayCode.js"></script>
    <script src="./js/classObjet/listeRatios.js"></script>
    <script src="./js/classObjet/contoursObjet.js"></script>
    <script src="./js/classMethod/decodeur.js"></script>
    <script src="./js/main/mainDecodeur.js"></script>
    <?php require("./../Template/footer.php"); ?>
</body>