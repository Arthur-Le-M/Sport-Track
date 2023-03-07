<?php
session_start();
$_SESSION['id']='jetestavec';
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
    <title>Algorithme</title>
</head>
<body>
    <?php require("./../Template/header.php"); ?>

    <div class="divBarres">
        <img class="logoST" src="./image.png">
        <span id="barreReference"></span>
        <span id="vertical0" class="barreHTML"></span>
        <span id="vertical1" class="barreHTML"></span>
        <span id="vertical2" class="barreHTML"></span>
        <span id="vertical3"></span>
        <span id="vertical4"></span>
        <span id="vertical5"></span>
        <span id="vertical6"></span>
        <span id="vertical7"></span>
        <span id="vertical8"></span>
        <span id="vertical9"></span>
        <span id="vertical10"></span>
        <span id="vertical11"></span>
        <span id="vertical12"></span>
        <span id="vertical13"></span>
        <span id="vertical14"></span>
        <span id="vertical15"></span>
        <span id="vertical16"></span>
        <span id="vertical17"></span>
        <span id="vertical18"></span>
        <span id="vertical19"></span>
        <span id="vertical20"></span>
        <span id="barreReference"></span>
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