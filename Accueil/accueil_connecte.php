<?php
session_start();
/*if(!isset($_SESSION['user'])){
    header('location: connexion.php');
    exit;
}*/
require "../Template/config.php"; // Lien pour la connexion a la BD
$bdd = getConnection();
$recupPrenom = $bdd->prepare('SELECT prenom FROM joueur JOIN inscrit ON inscrit.licence=joueur.licence WHERE id=3');
$recupPrenom->execute();
//array($_SESSION['id'])
$resultat = $recupPrenom->fetch();
$prenom = $resultat['prenom'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="accueil_connecte.css" >
    <title>Document</title>
</head>
<body>
<?php
    // Import du header (commun à toutes les pages)
    require "../Template/header.php";
    ?>
<h1>Bienvenue <span style="color: #267AB8;"> <?php echo ucfirst(strtolower($prenom));?> </span> <img src="emoji.png" alt="icone" width="2.5%"></h1>
<div id ="conteneur" >
    <div id="boite1" class="boite" >
        <a href="../Messagerie/messagerie.php"><img src="msg.png" alt="description-de-l-image"></a>
    </div>
    <div id="boite2" class="boite" >
        <a href="lien-de-la-page"><img src="msg.png" alt="description-de-l-image"></a>
    </div>
    <div id="boite3" class="boite">
        <a href="lien-de-la-page"><img src="msg.png"  alt="description-de-l-image"></a>
    </div>
</div>
<?php
    // Import du footer (commun à toutes les pages)
    require "../Template/footer.php";
    ?>

</body>
</html>