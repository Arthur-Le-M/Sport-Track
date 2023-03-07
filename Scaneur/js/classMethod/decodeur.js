/**
 * Contient les methode pour decoder le st_code
 * @class Decodeur
 */
class Decodeur {
 //ATTRIBUTS et CONSTRUCTEUR
 /**
 * creer un nouveau constructeur
 * @constructor
 * @param {Array.<Array.<Array.<number>>>} matriceImage - matrice de l'image
 * @property {Object} dictableEncodageGrayCode - le dictionnaire utilisée pour encoder les caractères
 * @property {Array.<(number[]|number)>} correspGrayCodeBarre - la table de correspondance des ratios de hauteur et du gray code
 */
 constructor(matriceImage) {
 this.matriceImage = matriceImage;
 this.dictableEncodageGrayCode = {
 'a': '000000',
 'b': '000001',
 'c': '000011',
 'd': '000010',
 'e': '000110',
 'f': '000111',
 'g': '000101',
 'h': '000100',
 'i': '001100',
 'j': '001101',
 'k': '001111',
 'l': '001110',
 'm': '001010',
 'n': '001011',
 'o': '001001',
 'p': '001000',
 'q': '011000',
 'r': '011001',
 's': '011011',
 't': '011010',
 'u': '011110',
 'v': '011111',
 'w': '011101',
 'x': '011100',
 'y': '010100',
 'z': '010101',
 'A': '010111',
 'B': '010110',
 'C': '010010',
 'D': '010011',
 'E': '010001',
 'F': '010000',
 'G': '110000',
 'H': '110001',
 'I': '110011',
 'J': '110010',
 'K': '110110',
 'L': '110111',
 'M': '110101',
 'N': '110100',
 'O': '111100',
 'P': '111101',
 'Q': '111111',
 'R': '111110',
 'S': '111010',
 'T': '111011',
 'U': '111001',
 'V': '111000',
 'W': '101000',
 'X': '101001',
 'Y': '101011',
 'Z': '101010',
 0: '101110',
 1: '101111',
 2: '101101',
 3: '101100',
 4: '100100',
 5: '100101',
 6: '100111',
 7: '100110',
 8: '100010',
 9: '100011'
 };
 this.correspGrayCodeBarre =[[0.125, [0, 0, 0]],
 [0.250, [0, 0, 1]],
 [0.375, [0, 1, 1]],
 [0.500, [1, 1, 1]],
 [0.625, [1, 1, 0]],
 [0.750, [1, 0, 0]],
 [0.875, [1, 0, 1]],
 [1, [0, 1, 0]]]
 // ENCAPSULATION
 };
 // METHODES SPECIFIQUES
 /**
 * récupere les contours des objets de l'image grace a l'algorithme de détectin de bord canny
 * @method
 * @returns {Array.<Array.<Array.<number>>>} - la matrice des contours de chaques objets de l'image 
 */
 recuperationContourObjets() {
 // Methode: matriceImage >> recuperationContourObjets >> matriceContoursObjet
 // INITIALISATION
 let matriceImage = cv.imread(this.matriceImage);
 var matriceContoursObjets = new Array();
 var matriceImageNiveauDeGris = matriceImage.clone()
 // matriceImage >> conversion image en niveaux de gris >> matriceImageNiveauDeGris
 cv.cvtColor(matriceImage, matriceImageNiveauDeGris, cv.COLOR_RGBA2GRAY, 0);
 //afficher image:
 //
 cv.imshow(output1, matriceImageNiveauDeGris);
 //
 //matriceImageNiveauDeGris >>detection des bords des objets >> matriceImageAvecContours
 var matriceImageAvecContours = matriceImageNiveauDeGris.clone()
 cv.Canny(matriceImageNiveauDeGris, matriceImageAvecContours, 50, 200, 3, false);
 //afficher image:
 //
 cv.imshow(output2, matriceImageAvecContours);
 //
 // creation des matrices et liste de vecteurs contours et hierarchy
 let contours = new cv.MatVector();
 let hierarchy = new cv.Mat();
 // matriceImageAvecContours >> récupération des contours de chaques objets >> matriceContoursObjets
 cv.findContours(matriceImageAvecContours, contours, hierarchy, cv.RETR_EXTERNAL, cv.CHAIN_APPROX_NONE);
 //mise sous forme de matrice de dimension 3
 // parcours complet de la liste d'objets
 for (var i = 0; i < contours.size(); ++i) {
 matriceContoursObjets[i] = new Array();
 var ci = contours.get(i); //Récupération de l'objet courant dans une variable
 // parcours des points du contours de l'objet
 for (var j = 0; j < ci.data32S.length; j += 2) {
 var coordonneeX = ci.data32S[j]; //Récupération de la coordonnée x
 var coordonneeY = ci.data32S[j + 1]; //Récupération de la coordonnée y
 // Insertion du point sous forme de liste contenant x et y
 matriceContoursObjets[i].push([coordonneeX, coordonneeY]);
 }
 }
 console.log("DEBUT : Récupère dans l'image une matrice de contours d'objet");
 return matriceContoursObjets;
 };
 /**
 * récupere les ratios des hauteurs des barre du st_code apres avoir remis le code droit et avoir triée les objets de l'image
 * @method
 * @returns {Array.<Array.<Array.<number>>>} - la matrice des contours de chaques objets de l'image 
 */
 //Méthode : matriceContoursObjets >> Récupération du ratio en fonction de la hauteur des barres obtenues sur la photo >> listeRatios
 recuperationRatio(matriceContourObjet) {
 /**
 * 
 * @param {Array.<Array.<Array.<number>>>} matrice - la matrice des contours des objets 
 * @returns {Array<Array>} - la liste des valeurs xmin, xmax, ymin, ymax, hauteur, largeur
 */
 function recupererListeObjets(matrice){
 //matriceContoursObjet >> RECUPERATION DES HAUTEURS ET POSITIONS DES OBJETS >> listeObjet
 // listeObjets >> Initialisation >> listeObjets
 var liste = [];
 //listeObjets >> Parcours complet de la matrice des contours objets avec traitement systématique >> listeObjets
 for (var objetCourant = 0; objetCourant < matrice.length; objetCourant++)
 {
 //ymin, ymax, xpos >> Intialisation des variables avec le premier point de contours de lo'objet >> ymin, ymax, ypos
 var ymin = matrice[objetCourant][0][1];
 var ymax = matrice[objetCourant][0][1];
 var xmin = matrice[objetCourant][0][0];
 var xmax = matrice[objetCourant][0][0];
 for (var point = 0; point < matrice[objetCourant].length; point++) {
 if (matrice[objetCourant][point][1] > ymax) {
 ymax = matrice[objetCourant][point][1];
 }
 if (matrice[objetCourant][point][1] < ymin) {
 ymin = matrice[objetCourant][point][1];
 }
 if (matrice[objetCourant][point][0] > xmax) {
 xmax = matrice[objetCourant][point][0];
 }
 if (matrice[objetCourant][point][0] < xmin) {
 xmin = matrice[objetCourant][point][0];
 }
 }
 // calcule de la hauteur de la barre
 var hauteur = ymax - ymin;
 var largeur = xmax - xmin;
 // ajout de la hauteur et de posx dans la listeObjets
 liste.push([xmin, xmax, ymin, ymax, hauteur, largeur]);
 }
 return liste;
 }

 /**
 * 
 * @param {Array<Array>} listeObjets - la liste des objets de l'image decrit par xmin, xmax, ymin, ymax, hauteur, largeur
 * @returns {Array<Array>} - la liste des objets de réferences du st_code
 */
 function trouverReferences(listeObjets) {
 var listeReferences = [];
 var marge = 2; // marge d'erreur pour trouver des objets circulaires
 var XmaxLogo = -1;
 for (var i = 0; i < listeObjets.length; i++) //parcours de tout les objets de l'image
 { 
 var hauteurTemp = listeObjets[i][4]; // hauteur de l'objet courant 
 if (hauteurTemp - marge <= listeObjets[i][5] && listeObjets[i][5] <= hauteurTemp + marge && listeObjets[i][0]>XmaxLogo && hauteurTemp != 0) 
 // si l'objet courant est un cercle ( sa hauteur correspond a peu pres a sa longueur) et qu'il placé apres le logo 
 {
 listeReferences.push(listeObjets[i]); // on le met dans la liste des references ( petit cercle au debut et la fin du code)
 if(hauteurTemp >= 20) // si c'est un cercle assez grand il est considéré comme le logo
 {
 XmaxLogo = listeObjets[i][1] // on precise le Xmax du logo
 }
 }
 }
 return listeReferences
 }

 //creation de la fonction pour le tri
 function fonctionTri(a, b) {
 if (a[0] === b[0]) {
 return 0;
 }
 else {
 if (a[0] > b[0]) {
 return 1;
 }
 else {
 return -1;
 }
 }
 }
 /**
 * calcule la distance euclidienne entre les points a et b 
 * @param {number} a 
 * @param {number} b 
 * @returns {float} - la distance euclidienne entre le point a et b 
 */
 //fonction pour calculer une distance euclidienne dans un repere cartesien (ici l'image)
 function distance(a, b) {
 return Math.sqrt((b[0] - a[0]) ** 2 + (b[1] - a[1]) ** 2)
 }
 /**
 * convertis un angle en radiant en degrés
 * @param {float} a - l'angle en radiants
 * @returns {float} - l'angle en degrés
 */
 function toDegree(a)
 {
 return a * 180/Math.PI;
 }
 /**
 * convertis un angle en degrés en radiants
 * @param {float} a - l'angle en degrés
 * @returns {float} - l'angle en radiants
 */
 function toRadian(a)
 {
 return a/(180/Math.PI);
 }

 /**
 * fonction qui calcule l'angle entre l'axe des abscisse et la ligne formée par les 2 boules de references du st_code
 * @param {Array<number>} boule1 - la boule de référence à gauche du code
 * @param {Array<number>} boule2 - la boule de référence à droite du code
 * @returns {float} - l'angle en degrés
 */
 function calculerAngle(boule1, boule2) {

 // initialisation des points
 var pointA = [boule1[0] + boule1[4] / 2, boule1[2] + boule1[5] / 2];
 var pointB = [boule2[0] + boule2[4] / 2, boule2[2] + boule2[5] / 2];
 // definition d'un point virtuel qui formera avec le point A une droite parallele à l'axe des absciess
 var pointVirtuel = [pointB[0], pointA[1]];
 //afficher les droites sur l'image
 contx2.strokeStyle = '#f00';
 contx2.beginPath();
 contx2.moveTo(pointA[0], pointA[1]);
 contx2.lineTo(pointB[0], pointB[1]);
 contx2.stroke();
 contx2.strokeStyle = '#f00';
 contx2.beginPath();
 contx2.moveTo(pointA[0], pointA[1]);
 contx2.lineTo(pointVirtuel[0], pointVirtuel[1]);
 contx2.stroke();

 console.log("Coordonnées boule référence 1 : ", pointA);
 console.log("Coordonnées boule référence 2 : ", pointB);
 console.log("Coordonnées boule virtuelle : ", pointVirtuel);

 // calcul des distance
 // calcul de la valeur de l'hypothenuse avec les points A et B
 var hypothenuse = distance(pointA, pointB); 
 // calcul de la valeur du coté adjacent avec le point A et le point Virtuel
 var adjacent = distance(pointA, pointVirtuel);
 console.log("Hypotenuse:", hypothenuse, "Adjacent:", adjacent);
 // utilisation du calcul trigonometriques pour obtenir l'angle
 var angle = Math.acos(adjacent / hypothenuse);
 angle = toDegree(angle);
 // selon la position du point virutel, on defini l'angle comme positif ou negatif
 
 if(pointVirtuel[1]<pointB[1]) // si le point virtuel est au dessus du point B, alors l'angle est negatif
 {
 console.log("L'angle est positif:",-angle);
 return -angle;
 }
 else // si le point virtuel est en dessous du point B, alors l'angle est positif
 {
 console.log("L'angle est positif:",angle);
 return angle;
 }
 
 }
 /**
 * donne les coordonées d'un point après une rotation d'un certain angle dans un repère cartesien
 * @param {Array<number>} x - l'abscisse du point
 * @param {Array<number>} y - l'ordonnée du point 
 * @param {float} angle - l'angle en degrés
 * @returns {Array<number>} - le point après rotation
 */
 function rotationPoint(x,y,angle)
 {
 var angleRadian = toRadian(angle)
 return [x*Math.cos(angleRadian)+y*-1*Math.sin(angleRadian) ,x*Math.sin(angleRadian)+y*Math.cos(angleRadian)]
 }
 /**
 * renvoie un matrice de point apres une rotation d'un certain angle par rapport a un certain point qui est le centre autour duquel s'effectue la rotation
 * @param {Array<number>} centre - le centre de la rotation
 * @param {Array.<Array.<Array.<number>>>} matrice - la matrice des objets de l'image 
 * @param {float} angle - l'angle en degrés de la rotation
 * @returns {Array.<Array.<Array.<number>>>} - la matrice des points après la rotation
 */
 function rotationEnsemble(centre,matrice,angle)
 { 
 // on enleves les dessins du canvas 
 contx3.clearRect(0, 0, output3.width, output3.height);

 var matriceApresRotation = [];
 for(var objet=0; objet < matrice.length; objet++)
 {
 matriceApresRotation.push([])
 for(var point=0; point < matrice[objet].length;point++)
 { 
 // le y du point dans un repere cartesien de centre "centre"
 var XRepereCentre = matrice[objet][point][0] - centre[0];
 var YRepereCentre = matrice[objet][point][1] - centre[1];
 // rotation des coordonées du point
 var nouveauPoint = rotationPoint(XRepereCentre,YRepereCentre,angle);
 // remettre les points dans le plan d'origine
 var XRepereOrigine = nouveauPoint[0] + centre[0];
 var YRepereOrigine = nouveauPoint[1] + centre[1];
 // dessin du point sur le canva
 contx3.fillStyle = 'white';
 contx3.fillRect(XRepereOrigine,YRepereOrigine, 1, 1);
 // remplacer le point par le nouveau point apres rotation
 matriceApresRotation[objet].push([XRepereOrigine,YRepereOrigine])
 }
 }
 
 return matriceApresRotation
 }
 /**
 * récupere les ratios de hauteurs des barres du st_code
 * @param {Array<Array>} listeObjets - la liste d'objets de l'image
 * @returns {Array<Array>} - la liste des ratios des hauteurs des barres
 */
 function calculerLesRatios(listeObjets)
 {
 var hauteurReference = logo[4];
 var listeRatios = [];
 // hauteurReference, listeObjetsTrie >> Parcours et calcul de chaques ratios >> listeRatios
 for (var objetCourant = 0; objetCourant < listeObjets.length; objetCourant++)
 {
 {
 // listeRatios, hauteurReference, listeObjetTrie >> Division de la hauteur de l'objet courant par la hauteur référence et insertion dans la liste des ratios >> listeRatios
 var ratio = (listeObjets[objetCourant][4] / hauteurReference);
 listeRatios.push(ratio);
 }

 }
 return listeRatios;
 }
 /**
 * filtre les objets en fonction de leurs position et gardent seulement ceux dont la position est bien entre la boule1 et la boule2 (les reperes)
 * @param {Array.<Array.<Array.<number>>>} liste - la liste des objets a filtrer
 * @returns {Array.<Array.<Array.<number>>>} la liste triée 
 */
 function filtreObjet(liste)
 { 
 // initialisation des variables
 var listeObjetFiltreApresRotation = [];
 var margeY = 10; //la marge de la limite en Y
 var margeX = 10; //la marge de la limite en X

 // on recuperes les limites a partir des références
 var limiteXmax = boule2[0] + margeX;
 var limiteYmax = logo[3] + margeY;
 // tracer la limite minimum en X sur le canva
 contx3.strokeStyle = '#f00';
 contx3.beginPath();
 contx3.moveTo(limiteXmax, 0);
 contx3.lineTo(limiteXmax, output3.height);
 contx3.stroke();
 
 var limiteXmin = boule1[1] - margeX;
 var limiteYmin = logo[2] - margeY;
 // tracer la limite maximum en X sur le canva
 contx3.strokeStyle = '#f00';
 contx3.beginPath();
 contx3.moveTo(limiteXmin, 0);
 contx3.lineTo(limiteXmin, output3.height);
 contx3.stroke();

 // tracer la limite minimum en Y sur le canva 
 contx3.strokeStyle = '#f00';
 contx3.beginPath();
 contx3.moveTo(0,limiteYmin);
 contx3.lineTo(output3.width,limiteYmin);
 contx3.stroke();


 //tracer la limite maximum en Y sur le canva

 contx3.strokeStyle = '#f00';
 contx3.beginPath();
 contx3.moveTo(0,limiteYmax);
 contx3.lineTo(output3.width,limiteYmax);
 contx3.stroke();

 // parcourir tout les objets de la liste
 for (var i = 0; i < liste.length; i++)
 {
 var objetCourant = liste[i];
 // verifier si l'objet est entre limiteXmin et limiteXmax et limiteYmin et limiteYmax
 if(objetCourant[0]>limiteXmin && objetCourant[1]<limiteXmax && objetCourant[2] > limiteYmin && objetCourant[3]<limiteYmax) 
 {
 // si l'objet est bien dans la zone de recherche on l'ajoute a la listeObjetFiltreApresRotation
 listeObjetFiltreApresRotation.push(objetCourant)
 }
 }
 return listeObjetFiltreApresRotation;
 }

 // on utilise toutes les fonctions déclarées precedement

 //on recupere la liste des objets de la matriceContourObjet
 var listeObjets = recupererListeObjets(matriceContourObjet);
 console.log("Récupère liste objet");
 // on tri les objets dans l'ordre croissant des position en X
 var listeObjetsTrie = listeObjets.sort(fonctionTri);
 console.log("Trie la liste Objet");
 // on recupere les objets qui sont les references du code
 var listeReferences = trouverReferences(listeObjetsTrie);
 console.log("Trouve les références dans cette liste");

 var logo = listeReferences[0]; // la premiere reference est le logo

 var boule1 = listeReferences[1]; // la deuxieme reference est la boule1

 var boule2 = listeReferences[2]; // la troisieme reference est la boule2
 //on va ensuite tourner le code de sorte à ce que les elements soient droit et que la ligne formée par les 2 boules references soit parallele à l'axe des abscisses
 // le centre de rotation de sera le centre du logo

 var centreLogo = [logo[0]+(logo[1]-logo[2])/2,logo[2]+(logo[3]-logo[2])/2];
 // on calcul l'angle de rotation pour remettre les éléments droit

 var angleRotation = calculerAngle(boule1,boule2);
 // on effectue la rotation et on récupere la nouvelle matrice d'element droits
 var matriceObjetsApresRotation = rotationEnsemble(centreLogo,matriceContourObjet,angleRotation);
 console.log("Rotation de la matrice");
 //console.log("matrice Avant Filtrage",matriceObjetsApresRotation);


 //on recupere ensuite la liste des objets a partir de la matrice
 var listeObjetsApresRotation = recupererListeObjets(matriceObjetsApresRotation);
 //console.log("liste Objet Avant Filtrage",listeObjetsApresRotation);

 // on applique le filtre pour garder seulement les objets qui sont entres les boules references eliminée le bruit (element indesirables)
 var listeObjetsFiltreApresRotation = filtreObjet(listeObjetsApresRotation,logo,boule1,boule2);
 //console.log("liste Objet Apres Filtrage",listeObjetsFiltreApresRotation);
 console.log("Filtrage du bruit dans l'image");
 var listeObjetsFiltreEtTrieApresRotation = listeObjetsFiltreApresRotation.sort(fonctionTri);
 //console.log("liste Objet Apres trie",listeObjetsFiltreEtTrieApresRotation);

 var listeRatios = calculerLesRatios(listeObjetsFiltreEtTrieApresRotation);

 console.log("Calcul Liste Ratios :",listeRatios)
 return listeRatios;
 };
 /**
 * convertie la liste des ratios en mot en graycode
 * @method
 * @param {Array<float>} listeRatios - la liste des ratios des hauteurs des barres
 * @returns {Array<number>} -la licence en graycode
 */
 conversionGrayCode(listeRatios) {
 function valeurAbsolue(a) {
 if (a < 0) { return -a }
 else { return a };
 }
 //licenceGrayCode >> INITIALISATION VARIABLE >> licenceGrayCode
 var licenceGrayCode = "";
 
 //listeRatios, licenceGrayCode >> Parcours complet de listeRatios avec traitement systématique >> licenceGrayCode
 for (var i = 0; i < listeRatios.length; i++) {

 //listeRatios, licenceGrayCode >> Recherche de la valeur la plus proche du ratio >> licenceGrayCode
 // min, inidicePlusProche >> Initialisation variable >> min, indicePlusProche
 var min = 1;
 var indicePlusProche;
 //licenceGrayCode, listeRatios, min, indicePlusProche >> Recherche de la première occurence du ratio dans la variable global TABLE_DECODAGE >> licenceGrayCode
 for (var ligne = 0; ligne < this.correspGrayCodeBarre.length; ligne++) {
 //Si la différence entre la valeur courante de liste ratio et la valeur reference de la table d'encodage est inférieur à min
 if (valeurAbsolue(listeRatios[i] - this.correspGrayCodeBarre[ligne][0]) < min) {
 //min, indicePlusProche >> Affectation de l'indice de la TABLE_DECODAGE le plus proche de la valeur courante de listeRatios >> min, indicePlusProche
 min = valeurAbsolue(listeRatios[i] - this.correspGrayCodeBarre[ligne][0])
 indicePlusProche = ligne;
 }
 }
 //licenceGrayCode, indicePlusProche >>Parcours et ajout de la correspondance en gray code dans licenceGrayCode >> licenceGrayCode
 for (var bit = 0; bit < 3; bit++) {
 licenceGrayCode += this.correspGrayCodeBarre[indicePlusProche][1][bit];
 }
 }
 console.log("Convertion en grayCode",licenceGrayCode)
 return licenceGrayCode;
 };
 /**
 * convertie le mot en graycode en chaine de caractères
 * @method
 * @param {Array<number>} licenceGreyCode - la licence en gray code 
 * @returns {string} -la licence en chaine de caratères
 */
 conversionLicence(licenceGreyCode) {
 // licenceGrayCode >> conversion licenceGrayCode en chaine de caracteres >> numLicence
 // initialisation des variables >> numLicence, motBinaire
 var numLicence = "";
 var motBinaire = "";
 // licenceGrayCode, motBinaire >> Parcours complet de licenceGrayCode avec traitement systematique
 // licenceGrayCode, motBinaire >> recuperation de 6 bits de la liste dans un motBinaire temporaire >> motBinaire
 for (var bit = 0; bit < licenceGreyCode.length - 1; bit += 6) {
 //motBinaire >> remise de mot binaire en liste vide >> motBinaire
 motBinaire = "";
 if (licenceGreyCode.length - bit < 6) {
 break;
 }
 for (var decalage = 0; decalage < 6; decalage++) {
 motBinaire += licenceGreyCode[bit + decalage];
 }

 // motBinaire, licenceGrayCode, numLicence >> recherche de premiere occurence dans la variable globale TABLE_ENCODAGE_GRAY_CODE >> numLicence
 for (var cle in this.dictableEncodageGrayCode ) {
 if (JSON.stringify(motBinaire) == JSON.stringify(this.dictableEncodageGrayCode[cle])) {
 // numLicence >> Ajout du caractere correspondait dans numLicence >> numLicence
 numLicence += cle;
 }
 }
 }
 console.log("Le numéro de licence est :",numLicence);
 return numLicence;
 }
 /**
 * teste l'existence de la licence dans la base de données 
 * @method 
 * @param {string} numLicence - la licence en chaine de caractères
 * @returns {boolean} - vrai si le test a fonctionnée faut si il n'a pas fontionné
 */
 async testerLicense(numLicence)
 {
 // Envoyez la requête AJAX
 const xhr = new XMLHttpRequest();
 xhr.open("GET" , 'http://localhost:80/Sport-Track/Scaneur/API/api.php?license='+numLicence);
 xhr.send();
 // Attendre la réponse avant de continuer
 const response = await new Promise((resolve,reject) => {
 xhr.onreadystatechange = function () {
 if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
 // Parse la réponse en tant que JSON
 const response = JSON.parse(this.responseText);
 // Vérifie si la licence existe
 if (response.licenseExists == true) {
 // La licence existe
 resolve(true);
 } else {
 // La licence n'existe pas
 resolve(false);
 }
 }
 };
 });
 return response
 }

};