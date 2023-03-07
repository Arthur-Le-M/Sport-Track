<?php
//On démarre la session
session_start();
//On verifie qu'une session est active
if(!isset($_SESSION['user'])){
    header('location: connexion.php');
    exit;
}
//On se connect à la base de donnée
$conn = new PDO('mysql:host=localhost;dbname=bd_sporttrack;charset=utf8','root','root');

//On récupère les données de l'user 
$req = "SELECT * FROM inscrit WHERE mail=:mail";
$req = $conn->prepare($req);
$req->execute(['mail'=>$_SESSION['user']]);
$res = $req->fetch();
$licence = $res['licence'];
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- En-tête de la page -->
        <meta charset="utf-8" />
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<link rel="stylesheet" href="style.css" />
                <link rel="stylesheet" href="../Template/style.css">
    </head>
    <body>
        <?php require("../Template/header.php"); ?>
        
        <main>
            <h2 class="titrePage">Bienvenue !</h2>
            <p id="licenceHiding"><?php print($licence) ?></p>
            <a href="deconnexion.php">Déconnexion</a>
        </main>
        <?php require("../Template/footer.php"); ?>
    </body>
</html>