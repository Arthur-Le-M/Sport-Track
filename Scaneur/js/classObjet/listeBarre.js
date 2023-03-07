/**
 * Objet Liste Barre
 * @classListeBarre
 * @property {string} listeBarre - La liste des barre
 * @author Sport Track
 */
class ListeBarre {
    /**
     * Constructeur de l'objet ListeBarre.
     *
     * @param {string} l - Liste de barres. Valeur par défaut : chaine vide.
     */
    constructor(l="") {
      this.listeBarre = l;
    }
    /**
     * Retourne la liste de barres.
     *
     * @return {string} Liste de barres.
     */
    getListeBarre(){
        return this.listeBarre;
    }

    /**
     * Modifie la liste de barres.
     *
     * @param {string} l - Nouvelle liste de barres. Valeur par défaut : chaine vide.
     */
    setListeBarre(l=""){
        this.listeBarre=l;
    }

  }