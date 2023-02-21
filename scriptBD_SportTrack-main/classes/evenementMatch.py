class EvenementMatch:
    def __init__(self, match, joueur, type, temps, commentaire=""):
        self.match = match
        self.joueur = joueur
        self.type = type
        self.temps = temps
        self.commentaire = commentaire

    def toString(self):
        return "But de " + self.joueur.name