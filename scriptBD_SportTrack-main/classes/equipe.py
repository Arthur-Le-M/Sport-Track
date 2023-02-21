from joueur import *
import random

class Equipe:
    def __init__(self, generateur, stade):
        self.generateur = generateur
        self.stade = stade
        self.ville = stade.getVille()
        self.nom = self.generateur.generateTeamName(str(self.ville))
        self.couleur = generateur.generateColor()
        self.tableJoueur = []
        self.remplirTableJoueur()
    
    def toString(self):
        return(self.nom + " / " + self.ville + " / " + self.couleur + " / " + self.stade.toString())

    def getStade(self):
        return self.stade
    
    def insererJoueur(self, joueur):
        joueur.setEquipe(self)
        self.tableJoueur.append(joueur)

    def remplirTableJoueur(self):
        for i in range(1):
            j = Joueur(self.generateur, "DIRIGEANT")
            self.insererJoueur(j)
        for i in range(2):
            j = Joueur(self.generateur, "ENTRAINEUR")
            self.insererJoueur(j)
        for i in range(2):
            j = Joueur(self.generateur, "GARDIEN")
            self.insererJoueur(j)
        for i in range(5):
            j = Joueur(self.generateur, "DEFENSEUR")
            self.insererJoueur(j)
        for i in range(5):
            j = Joueur(self.generateur, "MILIEU")
            self.insererJoueur(j)
        for i in range(4):
            j = Joueur(self.generateur, "ATTAQUANT")
            self.insererJoueur(j)

    def getTableJoueur(self):
        return self.tableJoueur

    def getRandomJoueur(self):
        while True:
            indexRandom = random.randint(0, len(self.tableJoueur)-1)
            if self.tableJoueur[indexRandom].getPoste() != "DIRIGEANT" and self.tableJoueur[indexRandom].getPoste() != "ENTRAINEUR":
                break
        return self.tableJoueur[indexRandom]