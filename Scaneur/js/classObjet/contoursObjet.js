/**
 * Objet Contours Objets 
 * @class ContoursObjets
 * @property {Array[Array[int]]} leContoursObjets
 * @author Sport Track
 */
class ContoursObjets {
    /**
     * Constructeur de l'objet ContoursObjets.
     *
     * @param {} unContoursObjets - Matrice de contour.
     */
    constructor(unContoursObjets) {
        this.leContoursObjets = unContoursObjets;
    };

    /**
     * SETTER : Modifie la matrice de contours.
     * @param {} uneContoursObjets - Matrice de contour.
     * 
     */
    setContoursObjets(unContoursObjets) {
        this.leContoursObjets = unContoursObjets;
    };
    /**
     * GETTER : Retourne la matrice de contours.
     *
     * @return {} Matrice de contour.
     */
    getContoursObjets() {
        return this.leContoursObjets;
    };
};