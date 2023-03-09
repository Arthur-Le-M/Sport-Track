<?php
session_start();
$_SESSION['id']='041zixz0qS';
if(!isset($_SESSION['role'])){
    $_SESSION['role']='coach';
    $_SESSION['idClub']='12427';
    $_SESSION['idStade']='1720';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/encodeur.css">
    <link rel="stylesheet" href="../Template/style.css">
</head>

<body>
    <?php require("./../Template/header.php"); ?>


        <span class="divBarres">
            <img class="logoST" src="./image.png">
            <span class="barreReference"></span>
            <span class="vertical0"></span>
            <span class="vertical1"></span>
            <span class="vertical2"></span>
            <span class="vertical3"></span>
            <span class="vertical4"></span>
            <span class="vertical5"></span>
            <span class="vertical6"></span>
            <span class="vertical7"></span>
            <span class="vertical8"></span>
            <span class="vertical9"></span>
            <span class="vertical10"></span>
            <span class="vertical11"></span>
            <span class="vertical12"></span>
            <span class="vertical13"></span>
            <span class="vertical14"></span>
            <span class="vertical15"></span>
            <span class="vertical16"></span>
            <span class="vertical17"></span>
            <span class="vertical18"></span>
            <span class="vertical19"></span>
            <span class="vertical20"></span>
            <span id="barreReference2" class="barreReference"></span>
        </span>



        <div id="overlay">
            <div id="modal-container">
                <div id="modal-content">
                    <img class="logoST" src="./image.png">
                    <span class="barreReference"></span>
                    <span class="vertical21"></span>
                    <span class="vertical22"></span>
                    <span class="vertical23"></span>
                    <span class="vertical24"></span>
                    <span class="vertical25"></span>
                    <span class="vertical26"></span>
                    <span class="vertical27"></span>
                    <span class="vertical28"></span>
                    <span class="vertical29"></span>
                    <span class="vertical30"></span>
                    <span class="vertical31"></span>
                    <span class="vertical32"></span>
                    <span class="vertical33"></span>
                    <span class="vertical34"></span>
                    <span class="vertical35"></span>
                    <span class="vertical36"></span>
                    <span class="vertical37"></span>
                    <span class="vertical38"></span>
                    <span class="vertical39"></span>
                    <span class="vertical40"></span>
                    <span class="vertical41"></span>
                    <span id="barreReference4" class="barreReference"></span>
                </div>
            </div>
        </div>

        <?php
    if ($_SESSION['role'] === 'coach') {
            echo "<button class='changePage' onclick=\"location.href='./decodeur.php'\">Scanneur</button>";
        }
?>



    <script src="./js/classObjet/licence.js"></script>
    <script src="./js/classObjet/grayCode.js"></script>
    <script src="./js/classObjet/listeBarre.js"></script>
    <script src="./js/classMethod/encodeur.js"></script>
    <script src="./js/main/mainEncodeur.js"></script>
    <?php 
    if (isset($_SESSION['id'])) {
        echo "<script>mainEncodeur('{$_SESSION['id']}');
        </script>";
    }
    require("./../Template/footer.php"); ?>
</body>

</html>