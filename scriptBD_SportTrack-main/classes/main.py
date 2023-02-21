#Import
from generateur import *
from joueur import *
from stade import *
from equipe import *
from championnat import *
from participerChampionnat import *
from planificationMatch import *


#Main
def main():
    gen = Generateur()
    c = Championnat("D1 Pyrénées Atlantiques", "D1", gen)
    print(c.planification.listeMatch)
    c.simulerJournee(5)

main()
    
