class ParticiperChampionnat:
    def __init__(self, equipe, championnat):
         self.equipe = equipe;
         self.championnat = championnat

    def toString(self):
        return self.equipe.toString() + " ==> " + self.championnat.toString()