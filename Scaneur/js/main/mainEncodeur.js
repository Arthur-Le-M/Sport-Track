//MAIN ENCODEUR

const codeBarre = document.getElementsByClassName('divBarres');

codeBarre.addEventListener('click', () => {
    
});
//Function main encodeur lancé lors du click sur un bouton
function mainEncodeur(name){
//Appelle des fonction d'encodeur
var uneLicence = new Licence(name);
var unEncodeur = new Encodeur(uneLicence.getNumLicence());
var unGrayCode = new GrayCode(unEncodeur.convertionGrayCode(uneLicence.getNumLicence()));
var uneListeBarre = new ListeBarre(unEncodeur.conversionBarres(unGrayCode.getGraycode()));
unEncodeur.genererCodeBarre(uneListeBarre.getListeBarre());

};