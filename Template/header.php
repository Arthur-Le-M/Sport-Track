<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Sport-Track/Messagerie/messagerie.css">
    <!-- Lien vers le CSS du header et du footer -->
    <link rel="stylesheet" href="/Sport-Track/Template/style.css">
    <title>Sport Track</title>
</head>
<body>
<header>
    <div id="logo"> 
        <a href="#"> <img src="/Sport-Track/Template/img/logo.png"> </a>
    </div>
    <div id="barre-nav">
        <?php 
        session_start();
        if(!isset($_SESSION['user'])){
            echo "<a href='../index.php'> <img src='../Template/img/maison.png'> </a>";
        }
        else{
            echo '<a href="../Accueil/accueil_connecte.php"> <img src="../Template/img/maison.png"> </a>';
        }
        ?>
        <a href="../Messagerie/messagerie.php"> <img src="../Template/img/messager.png"> </a>
        <a href="../Calendrier/index.php"> <img src="../Template/img/calendrier.png"> </a>
        <a href="../Profil/page-joueur.php"> <img src="../Template/img/personne.png"> </a>
    </div>
    <div id="right-part">
        <div id="scanner"> 
            <a href="Scaneur/encodeur.php"> <img src="../Template/img/scanner.png"> </a>
        </div>
        <div class="conteneur-dropdown">
            <button class="dropdownButton">
                <img id="icon" src="/Sport-Track/Template/img/menu.png" />
            </button>
            <div class="dropdownContent">
                <span id="partage"><a href="#"> Partager </a></span>
                <a href="Information/avis.php"> Avis </a>
                <a href="Information/reglages.php" id="separation"> Réglages </a>
                <a href="../information/contact.php"> Contact </a>
                <a href="Information/aide.php"> Aide </a>
                <a href="Inscription_Connexion/deconnexion.php"> Déconnexion </a>
            </div>
        </div>
    </div>
</header>

<script>
const btn = document.getElementById("partage");

// function for web share api
function webShareAPI(header, description, link) {
  navigator
    .share({
      title: header,
      text: description,
      url: link,
    })
    .then(() => console.log("Successful share"))
    .catch((error) => console.log("Error sharing", error));
}

if (navigator.share) {
  // Show button if it supports webShareAPI
  btn.style.display = "block";
  btn.addEventListener("click", () =>
    webShareAPI("Lien Site", "Application de Sport Amateur", "Sport-Track.live/")
  );
} else {
  // Hide button if it doesn't supports webShareAPI
  btn.style.display = "none";
  console.warn();("Navigateur n'a pas l'API de partage de lien");
}
</script>