<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Lien vers le CSS du header et du footer -->
    <link rel="stylesheet" href="../Template/style.css">
    <title>Sport Track</title>
</head>
<body>
<header>
    <div id="logo"> 
    <?php 
        session_start();
        ob_start();
        if(isset($_SESSION['user'])){
            echo '<a href="../Accueil/accueil_connecte.php"> <img src="../Template/img/logo.png"> </a>';
        }
        else{
            echo '<a href="../index.php"> <img src="../Template/img/logo.png"> </a>';
        }

        ?>
    </div>
    <div id="barre-nav">
    <?php
        if(!isset($_SESSION['user'])){
            echo '<a href="../index.php"> 

            <svg id="Calque_1" data-name="Calque 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 58.55 56.57"><defs></defs><path class="cls-1" d="M127.83,240.09h3.68a1.1,1.1,0,0,0,.73-1.93l-26.17-22.71a1.09,1.09,0,0,0-1.44,0L78.45,238.16a1.1,1.1,0,0,0,.72,1.93h3.69A1.11,1.11,0,0,1,84,241.2l0,25.45a1.1,1.1,0,0,0,1.1,1.1h40.56a1.1,1.1,0,0,0,1.1-1.1l0-25.45A1.11,1.11,0,0,1,127.83,240.09Z" transform="translate(-76.07 -213.18)"/><rect class="cls-1" x="20.95" y="33.41" width="17.53" height="21.16"/></svg> </a>';
        }
        else{
            echo '<a href="../Accueil/accueil_connecte.php"> 

            <svg id="Calque_1" data-name="Calque 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 58.55 56.57"><defs></defs><path class="cls-1" d="M127.83,240.09h3.68a1.1,1.1,0,0,0,.73-1.93l-26.17-22.71a1.09,1.09,0,0,0-1.44,0L78.45,238.16a1.1,1.1,0,0,0,.72,1.93h3.69A1.11,1.11,0,0,1,84,241.2l0,25.45a1.1,1.1,0,0,0,1.1,1.1h40.56a1.1,1.1,0,0,0,1.1-1.1l0-25.45A1.11,1.11,0,0,1,127.83,240.09Z" transform="translate(-76.07 -213.18)"/><rect class="cls-1" x="20.95" y="33.41" width="17.53" height="21.16"/></svg> </a>';
        }
        ?>
        <a href="../Messagerie/messagerie.php"><svg id="iconMessage" data-name="Calque 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 69.09 43.86"><defs><style>.cls-2{font-size:31.16px;fill:#1d1d1b;font-family:MyriadPro-Regular, Myriad Pro;}</style></defs><path class="cls-1" d="M162.2,238.22c0,2.89,1.57,5.54,4.21,7.65.9.72-7.19,9.23-6.07,9.81,1.72.88,12.79-6.27,14.92-5.78a30.78,30.78,0,0,0,6.93.77c11,0,20-5.57,20-12.45s-9-12.45-20-12.45S162.2,231.35,162.2,238.22Z" transform="translate(-158.24 -221.43)"/><path class="cls-1" d="M223.37,245.76c0,2.88-1.58,5.54-4.22,7.65-.9.72,7.2,9.23,6.07,9.81-1.71.88-12.79-6.27-14.91-5.78a30.85,30.85,0,0,1-6.93.77c-11,0-20-5.58-20-12.45s9-12.45,20-12.45S223.37,238.88,223.37,245.76Z" transform="translate(-158.24 -221.43)"/><text class="cls-2" transform="translate(35.13 26.08)">...</text></svg> </a>
        <a href="../Calendrier/index.php"> <svg id="Calque_1" data-name="Calque 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 59.96 53.57"><defs></defs><path class="cls-1" d="M2,13.14H53.09a0,0,0,0,1,0,0V38A7.95,7.95,0,0,1,45.14,46H9.95A7.95,7.95,0,0,1,2,38V13.14A0,0,0,0,1,2,13.14Z"/><path class="cls-1" d="M9.74,4.53h35.6a7.74,7.74,0,0,1,7.74,7.74v.87a0,0,0,0,1,0,0H2a0,0,0,0,1,0,0v-.87A7.74,7.74,0,0,1,9.74,4.53Z"/><line class="cls-1" x1="39.77" y1="9.13" x2="39.77"/><line class="cls-1" x1="15.32" y1="9.13" x2="15.32"/><circle class="cls-1" cx="41.93" cy="35.53" r="16.03"/><polyline class="cls-1" points="46.41 40.83 41.93 35.53 41.93 24.12"/></svg> </a>
        <a href="../Profil/page-joueur.php"> <svg id="Calque_1" data-name="Calque 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52.9 55.17"><defs></defs><path class="cls-1" d="M387.17,261.88h-48.9c0-18.31,10.94-33.15,24.45-33.15S387.17,243.57,387.17,261.88Z" transform="translate(-336.27 -208.72)"/><circle class="cls-1" cx="26.45" cy="16.01" r="14.01"/></svg> </a>
    </div>
    <div id="right-part">
        <div id="scanner"> 
            <a href="../Scaneur/encodeur.php"> <img src="../Template/img/scanner.png"> </a>
        </div>
        <div class="conteneur-dropdown">
            <button class="dropdownButton">
                <img id="icon" src="../Template/img/menu.png" />
            </button>
            <div class="dropdownContent">
                <span id="partage"><a href="#"> Partager </a></span>
                <a href="../Information/avis.php"> Avis </a>
                <a href="../Information/reglages.php" id="separation"> Réglages </a>
                <a href="../information/contact.php"> Contact </a>
                <a href="../Information/aide.php"> Aide </a>
                <a href="../Inscription_Connexion/deconnexion.php"> Déconnexion </a>
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