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
            echo "<a href='/Sport-Track/index.php'> <img src='/Sport-Track/Template/img/maison.png'> </a>";
        }
        else{
            echo '<a href="/Sport-Track/Accueil/accueil_connecte.php"> <img src="/Sport-Track/Template/img/maison.png"> </a>';
        }
        ?>
        <a href="/Sport-Track/Messagerie/messagerie.php"> <img src="/Sport-Track/Template/img/messager.png"> </a>
        <a href="/Sport-Track/Calendrier/index.php"> <img src="/Sport-Track/Template/img/calendrier.png"> </a>
        <a href="/Sport-Track/Profil/page-joueur.php"> <img src="/Sport-Track/Template/img/personne.png"> </a>
    </div>
    <div id="right-part">
        <div id="scanner"> 
            <a href="/Sport-Track/Scaneur/encodeur.php"> <img src="/Sport-Track/Template/img/scanner.png"> </a>
        </div>
        <div class="conteneur-dropdown">
            <button class="dropdownButton">
                <img id="icon" src="/Sport-Track/Template/img/menu.png" />
            </button>
            <div class="dropdownContent">
                <span id="partage"><a href="#"> Partager </a></span>
                <a href="/Sport-Track/Information/avis.php"> Avis </a>
                <a href="/Sport-Track/Information/reglages.php" id="separation"> Réglages </a>
                <a href="/Sport-Track/Information/contact.php"> Contact </a>
                <a href="/Sport-Track/Information/aide.php"> Aide </a>
                <a href="/Sport-Track/Inscription_Connexion/deconnexion.php"> Déconnexion </a>
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