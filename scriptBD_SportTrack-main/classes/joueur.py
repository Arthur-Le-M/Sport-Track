
class Joueur:
    def __init__(self, generateur, poste):
        self.generateur = generateur;
        self.poste = poste
        self.name = generateur.generateHumanName()
        self.surname = generateur.generateHumanSurname()
        self.licence = generateur.generateLicenceFoot()
    
    def toString(self):
        return(self.licence + " / " + self.name + " / " + self.surname + " / " + self.poste + " / " + self.equipe.toString())

    def setEquipe(self, equipe):
        self.equipe = equipe
    
    def getPoste(self):
        return self.poste