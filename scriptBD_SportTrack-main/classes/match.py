from evenementMatch import *
from equipe import *
import random

class Match:
    def __init__(self, heure_debut, heure_fin, dom, ext, stade, journee, commentaire=""):
        self.jouer = 0
        self.heure_debut = heure_debut
        self.heure_fin = heure_fin
        self.equipe_dom = dom
        self.equipe_ext = ext
        self.stade = stade
        self.journee = journee
        self.commentaire = commentaire
        self.simuler = False
        self.evenementDuMatch = []
    
    def toString(self):
        return "Match : " + str(self.heure_debut) + " / " + str(self.heure_fin) + " / " + self.equipe_dom.toString() + " / " + self.equipe_ext.toString() + " / " + self.stade.toString() + " / " + str(self.journee) + " / " + self.commentaire

    def simulerMatch(self, chance=random.randint(1, 3)):
        if(self.simuler == False):
            compteurA = 0
            compteurB = 0
            for i in range(90):
                lancement = random.randint(0, 100)
                if lancement <= chance:
                    if(random.randint(1,2) == 1):
                        compteurA += 1
                        self.evenementDuMatch.append(EvenementMatch(self, self.equipe_dom.getRandomJoueur(), "BUT", i))
                    else:
                        compteurB += 1
                        self.evenementDuMatch.append(EvenementMatch(self, self.equipe_ext.getRandomJoueur(), "BUT", i))
            self.simuler = True
            print(str(compteurA) + "-" + str(compteurB))