//Main Decodeur 

//Récupération des éléments de la page HTML par leur ID (context)
const parametres = { video: true, audio: false };
var video = document.getElementById("player");
const photo = document.getElementById('canvas');

const boutonPhoto = document.getElementById('photo');
navigator.mediaDevices.getUserMedia(parametres).then(function (stream) { player.srcObject = stream; });


// Fonction d'affichage de la mire
async function drawImg() {
  var videoCanvas = document.getElementById("videoCanvas");
  var ctx = videoCanvas.getContext('2d');
  videoCanvas.width = video.videoWidth;
  videoCanvas.height = video.videoHeight;
  ctx.drawImage(video, 0, 0, videoCanvas.width, videoCanvas.height);
  ctx.lineWidth = 2;
  //Placement de la mire sur le retour de webcam
  ctx.moveTo(180, 130);
  ctx.lineTo(190, 130);
  ctx.stroke();
  ctx.moveTo(180, 130);
  ctx.lineTo(180, 140);
  ctx.stroke();
  ctx.moveTo(480, 130);
  ctx.lineTo(470, 130);
  ctx.stroke();
  ctx.moveTo(480, 130);
  ctx.lineTo(480, 140);
  ctx.stroke();
  ctx.moveTo(180, 280);
  ctx.lineTo(190, 280);
  ctx.stroke();
  ctx.moveTo(180, 280);
  ctx.lineTo(180, 270);
  ctx.stroke();
  ctx.moveTo(480, 280);
  ctx.lineTo(470, 280);
  ctx.stroke();
  ctx.moveTo(480, 280);
  ctx.lineTo(480, 270);
  ctx.stroke();
  setTimeout(drawImg, 100)
};

//Lancement de la caméra à l'écran
video.onplay = async function () {
  setInterval(drawImg, 300);
};

function preparerEcran() {
  body.classList.toggle('cacher');
};

//Fonction qui se lance lors du click sur un bouton et qui lance le scanneur
boutonPhoto.addEventListener('click', async () => {
  //body.classList.toggle('cacher');
  var trouve = false;
  while (true) {
    try {
      // Canva a partir de la video
      await context.drawImage(player, 0, 0, photo.width, photo.height);
      // arrete la video    
      //player.srcObject.getVideoTracks().forEach(track=> track.stop());
      var hidden_ctx = await hiddenCanvas.getContext('2d');

      hidden_ctx.drawImage(photo,
        90, //x debut
        65, //y debut
        150,// largeur (ratio 2:1)
        75,// hauteur
        0,
        0,
        300,
        150
      )

      //Appelle des méthodes du scanneur
      let matriceImage = document.getElementById('hiddenCanvas');
      let ledecodeur = new Decodeur(matriceImage);
      var matriceContoursObjet = new ContoursObjets(ledecodeur.recuperationContourObjets());
      var uneListeRatio = new ListeRatios(ledecodeur.recuperationRatio(matriceContoursObjet.getContoursObjets()));
      var unGraycode = new GrayCode(ledecodeur.conversionGrayCode(uneListeRatio.getListeRatios()));
      var numLicence = new Licence(ledecodeur.conversionLicence(unGraycode.getGraycode()));
      const estValide = await ledecodeur.testerLicense(numLicence.getNumLicence());
      trouve = estValide;
    }
    catch (error) {
      // s'il y a une erreur, on met trouve a false 
      console.log(error);
      console.dir(error);
      trouve = false;
    }
    if (trouve == true) {
      console.log("LICENCE TROUVE ! FIN");
      window.location = ('http://localhost:80/SportTrack/Profil/page-joueur.php?licence='+numLicence.getNumLicence());
      break;
    }
  };
});