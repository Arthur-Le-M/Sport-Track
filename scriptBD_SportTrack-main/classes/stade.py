class Stade:
    def __init__(self, generateur):
        genVille = generateur.generateCity()
        self.generateur = generateur
        self.ville = genVille[1]
        self.adresse = generateur.generateAdresse()
        self.type = generateur.generateTypeStade()
        self.codePostal = genVille[0]
        self.nom = "Stade de " + self.ville
    
    def toString(self):
        return(self.nom + " / " + self.ville + " / " + self.adresse + " / " + self.codePostal + " / " + self.type)
    
    def getVille(self):
        return self.ville