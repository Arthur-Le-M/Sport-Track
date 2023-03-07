//MAIN ENCODEUR
const divBarres = document.getElementsByClassName('divBarres');
const overlay = document.getElementById('overlay');
const modal = document.getElementById('modal-container');
divBarres[0].addEventListener('click', () => {
    overlay.classList.add('visible');
    modal.classList.add('visible');
});

overlay.addEventListener('click', () => {
    overlay.className ='overlay';
    modal.className ='modal-container';
});

//Function main encodeur lancé lors du click sur un bouton
function mainEncodeur(name){
//Appelle des fonction d'encodeur
var uneLicence = new Licence(name);
var unEncodeur = new Encodeur(uneLicence.getNumLicence());
var unGrayCode = new GrayCode(unEncodeur.convertionGrayCode(uneLicence.getNumLicence()));
let uneListeBarre = new ListeBarre(unEncodeur.conversionBarres(unGrayCode.getGraycode()));
unEncodeur.genererCodeBarre(uneListeBarre.getListeBarre(),20);



};

function checkWidth() {
    if (window.innerWidth < 650) {
        var unEncodeur = new Encodeur()
      unEncodeur.genererCodeBarre(uneListeBarre.getListeBarre(),10)
    }
  }

window.addEventListener('resize', checkWidth);