/**
 * Objet Liste Ratios
 * @class ListeRatios
 * @property {Array[float]} ListeRatios - La liste des ratios
 * @author Sport Track
 */
class ListeRatios {
    /**
     * Constructeur de l'objet ListeRatios.
     *
     * @param {Array[float]} uneListeRatios - Liste de ratios.
     */
    constructor(uneListeRatios) {
        this.ListeRatios = uneListeRatios;

    };
    /**
     * Méthode getListeRatios pour définir l'attribut de l'objet 
     * @function
     * @param {Array[float]} uneListeRatios - Une liste de ratios
     */
    setListeRatios(uneListeRatios) {
        this.ListeRatios = uneListeRatios;
    };
    /**
     * Méthode getListeRatios pour récupérer l'attribut de l'objet 
     * @function
     * @returns {Array[float]}
     */
    getListeRatios() {
        return this.ListeRatios;
    };

};