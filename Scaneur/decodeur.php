<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/decodeur.css">
    <link rel="stylesheet" href="../Template/style.css">
    <title>Algorithme</title>
</head>
<body>
    <?php require("./../Template/header.php"); ?>
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