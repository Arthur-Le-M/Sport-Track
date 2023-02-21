from match import *
from generateur import *
from equipe import *
import datetime
import random

class PlanificationMatch:
    def __init__(self, listeEquipe):
        self.listeEquipe = listeEquipe
        self.listeMatch = []
        self.planifierMatch(datetime.date(2022, 8, 21))


    def planifierMatch(self, debutSaison):
        #Planification de journées
        self.planification = self.roundRobin(self.listeEquipe)
        
        #Gérer la date sous format DATETIME 1000-01-01 00:00
        dicoDate = {}
        dateActuelle = debutSaison
        journee = 0
        while journee < len(self.planification):
            dateActuelle += datetime.timedelta(weeks=1)
            if dateActuelle < datetime.date(dateActuelle.year, 12, 15) and dateActuelle > datetime.date(dateActuelle.year, 1, 10):
                dicoDate[journee] = dateActuelle
                journee += 1
        
        #Créer les objet match et le insérer dans la liste des matchs
        for i in range(len(self.planification)-1):
            dateJournee = dicoDate[i]
            numJournee = i+1
            tabJournee = []
            for j in range(len(self.planification[i])):
                #On récupère toutes les informations que l'on a besoin
                #On récupère les équipes domicile et extérieur
                equipeDom = self.planification[i][j][0] 
                equipeExt = self.planification[i][j][1]
                #On récupère les horaires et la date
                heure = random.randint(13, 21)
                heureDebut = datetime.datetime(dateJournee.year, dateJournee.month, dateJournee.day, heure, 30, 00)
                heureFin = datetime.datetime(dateJournee.year, dateJournee.month, dateJournee.day, heure+2, 15, 00)
                #Ainsi que le stade
                stade = equipeDom.getStade()
                #On créer l'objet Match
                match = Match(heureDebut, heureFin, equipeDom, equipeExt, stade, numJournee)
                tabJournee.append(match)
            self.listeMatch.append(tabJournee)
    
    def getListeMatch(self):
        return self.listeMatch

    #Méthode privées propre à cette classe
    def inverseTuple(self, ancienTuple):
        return (ancienTuple[1], ancienTuple[0])

    def roundRobin(self, listeEquipe):
        arretable = False
        #Tuple définit pour le cas d'arrêt
        arret = (listeEquipe[0], listeEquipe[len(listeEquipe)-1])
        #Cas de tableau impaire
        if len(listeEquipe) % 2:
            listeEquipe.append(None)
        planification = []
        while True:
            #Création de la journée
            journee = []
            for i in range(int(len(listeEquipe) / 2)):
                journee.append((listeEquipe[i], listeEquipe[len(listeEquipe) - i - 1]))
            listeEquipe.insert(1, listeEquipe.pop())
            #Condition d'arrêt
            if journee[0] == arret and arretable == True:
                break
            elif journee[0] == arret:
                arretable = True
            planification.append(journee)
        #Fin de la première partie de saison
        #Deuxième partie de saison : On retourne toute les rencontre pour toutes les journée
        premierePartieSaison = planification
        for i in range(len(premierePartieSaison)):
            journee = []
            for j in range(len(premierePartieSaison[i])):
                journee.append(self.inverseTuple(premierePartieSaison[i][j]))
            planification.append(journee)
        return planification

    def getListeMatch(self):
        return self.listeMatch