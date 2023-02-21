from equipe import *
from stade import *
from match import *
from generateur import *
from planificationMatch import *

class Championnat:
    def __init__(self, intitule, niveau, gen):
        self.intitule = intitule
        self.niveau = niveau
        self.tableEquipe = []
        self.gen = gen
        self.planification = []
        self.remplirTableEquipe(10)
        self.planifierMatch()
        self.journeeSimulee = 0


    def toString(self):
        return(self.intitule + " / " + self.niveau)

    def getTableEquipe(self):
        return self.tableEquipe

    def insererEquipe(self, equipe):
        self.tableEquipe.append(equipe)
        
    
    def remplirTableEquipe(self, nbEquipe):
        for i in range(nbEquipe):
            e = Equipe(self.gen, Stade(self.gen))
            self.insererEquipe(e)
    
    def planifierMatch(self):
        self.planification = PlanificationMatch(self.getTableEquipe())

    def simulerJournee(self, nbJournee):
        tableMatch = self.planification.getListeMatch()
        for i in range(self.journeeSimulee, self.journeeSimulee + nbJournee):
            for y in range(len(tableMatch[i])):
                tableMatch[i][y].simulerMatch()
