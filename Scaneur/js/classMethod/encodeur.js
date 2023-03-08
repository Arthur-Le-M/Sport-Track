/**
 * Class méthode objet Encodeur de licence
 * @class Encodeur
 * @property {string} licence - Le numéro de licence
 * @author Sport Track
 */
class Encodeur {
    //ATTRIBUTS et CONSTRUCTEUR
    constructor(licence) {
        //Table Encodage gray code

        //Initialisation des variables
        /**
         * Numéro de licence du joueur
         * @type {string}
         */
        this.licence = licence;
        /**
         * Table d'encodage, correspondance entre les caractères et le gray code
         * @type {Object}
         */
        this.TABLE_ENCODAGE = {
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
        /**
         * Table de correspondance entre les le gray code et les ratios
         * @type {Object}
         */
        this.CORRESP_GRAYCODE_BARRE = {
            1: [0, 0, 0],
            2: [0, 0, 1],
            3: [0, 1, 1],
            4: [1, 1, 1],
            5: [1, 1, 0],
            6: [1, 0, 0],
            7: [1, 0, 1],
            8: [0, 1, 0]
        };

    };

    /**
     * Fonction qui convertie le numéro de licence en gray code à l'aide de la table de correspondance
     * @function
     * @param {string} numLicence - Le numéro de licence 
     * @returns {string} licenceGrayCode 
     */
    //Méthode : Aucune données >> Méthode convertionGrayCode >> licenceGrayCode
    convertionGrayCode(numLicence = "") {
        console.log(numLicence.length);
        //licenceGrayCode >> Initialisation des variables >> licenceGrayCode
        var licenceGrayCode = ""
        //Parcours complet du numéro de licence avec traitement systématique (conversion gray code)
        for (var caracCourant = 0; caracCourant < numLicence.length; caracCourant++) {
            //licenceGrayCode, TABLE_ENCODAGE >> Traduction du caractère courant en graycode >> licenceGrayCode
            licenceGrayCode += (this.TABLE_ENCODAGE[numLicence[caracCourant]]);
        }
        //Retourne la licence convertie en gray code
        console.log(licenceGrayCode)
        return licenceGrayCode;
    }

    /**
     * Fonction qui convertie la phrase gray code en une liste de hauteur de barre à l'aide de la table de correspondance
     * @function
     * @param {string} licenceGrayCode - La phrase gray code 
     * @returns {Array} listeBarre 
     */
    //Méthode : licenceGrayCode >> conversionBarre >> liteBarre
    conversionBarres(licenceGrayCode) {
        //listeBarre >> Initialisation de liste barres >> listeBarre
        var listeBarre = []
        //Parcours complet de licenceGrayCode avec traitement systématique qui transforme 3 bits de la liste en  taille de barre
        for (var i = 0; i < licenceGrayCode.length; i += 3) {
            //Séparation de la liste gray code en motBinaire de 3 bits, Conversion motBinaire en taille barre
            //motBinaire >> Initialisation du mot binaire >> motBinaire
            var motBinaire = [];
            //Affectation mot binaire
            for (var decalage = 0; decalage < 3; decalage++) {
                //motBinaire, licenceGrayCode >> Ajout du bit courant dans la liste mot binaire >> motBinaire
                motBinaire.push(parseInt(licenceGrayCode[i + decalage]));
            }
            //Conversion du mot binaire en taille de barre avec une recherche de première occurence
            //Parcour des clé du dictionnaire CORRESP_GRAYCODE_BARRE
            for (var posCourante in this.CORRESP_GRAYCODE_BARRE) {
                //Condition qui vérifie l'égalité entre le motBinaire et les valeurs du dictionnaire CORRESP_GRAYCODE_BARRE
                if (JSON.stringify(motBinaire) === JSON.stringify(this.CORRESP_GRAYCODE_BARRE[posCourante])) {
                    //listeBarre, posCourante>> Affectation de la posCourante dans la liste des barres >> listeBarre 
                    listeBarre.push(posCourante);
                    break;
                }
            }
        }
        //Retourne la liste des hauteurs de barres
        console.log(listeBarre)
        return listeBarre
    }

    /**
     * Fonction qui convertie la phrase gray code en une liste de hauteur de barre à l'aide de la table de correspondance
     * @function
     * @param {Array} listeBarre - La liste de hauteur de barre
     */
    //Méthode : Aucune données >> genererCodeBarre >> Aucun résultat
    genererCodeBarre(listeBarre, indicateur) {
        //Affichage du ST code
        //Parcours complet du ST code avec traitement sytématique 
        for (var i = 0; i < listeBarre.length; i++) {
            //barreHTMLTemp >> Affectation de la hauteur pour les éléments grpahique correspondant aux barres >> barreHTMLTemp
            var barreHTMLTemp = document.getElementsByClassName('vertical' + i)[0];
            var barreHTMLTemp2 = document.getElementsByClassName('vertical' + (i+21))[0];
            //hateurBareTemp >> Affectation de la hauteur de barre dans une variable temporaire >> hauteurBarreTemp
            var hauteurBarreTemp = indicateur * listeBarre[i];
            //barreHTMLTemp, hauteurBarreTemp >> Affectation de la hauteur courante à l'élément graphique courant >> Aucun résultat
            barreHTMLTemp.style.height = `${hauteurBarreTemp}px`
            barreHTMLTemp2.style.height = `${hauteurBarreTemp}px`
            //Application de quelques rêgle CSS
            barreHTMLTemp.style.borderLeft = "5px solid white"
            barreHTMLTemp2.style.borderLeft = "5px solid white"

            barreHTMLTemp.style.display = "inline-block"
            barreHTMLTemp2.style.display = "inline-block"

            barreHTMLTemp.style.marginLeft = "1.8%"
            barreHTMLTemp2.style.marginLeft = "1.8%"

            barreHTMLTemp.style.borderRadius = "5px"
            barreHTMLTemp2.style.borderRadius = "5px"

        }

    }

};