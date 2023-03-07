/**
 * Objet GrayCode 
 * @class GrayCode
 * @property {string} graycode
 * @author Sport Track
 */
class GrayCode {
    /**
     * Constructeur de l'objet GrayCode.
     *
     * @param {string} g - Gray code.
     */
    constructor(g) {
      this.graycode = g;
    }
    /**
     * Getter : Retourne le Gray code.
     *
     * @return {string} Gray code.
     */
    getGraycode(){
        return this.graycode;
    }

    /**
     * Setter : Modifie le paramètre de l'objet Gray code.
     *
     * @param {string} g - Nouveau Gray code.
     */
    setGraycode(g){
        this.graycode=g;
    }

  }