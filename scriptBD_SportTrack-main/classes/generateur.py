import random
import pandas as pd

class Generateur:
    def __init__(self):
        print("Chargement des données CSV 0%")
        #Récupération de prénoms
        csvSurname = pd.read_csv('./CSV/liste_des_prenoms.csv', sep=';')
        dfSurname = pd.DataFrame(csvSurname, columns= ['prenoms','sexe'])
        self.surname = []
        for i in dfSurname.index:
            if dfSurname["sexe"][i] == "M":
                self.surname.append(dfSurname['prenoms'][i].upper())
        print("Chargement des données CSV 25%")
        #Récupération des noms de famillles
        csvName = pd.read_csv('./CSV/patronymes.csv', sep=",")
        dfName = pd.DataFrame(csvName)
        self.name = []
        for i in dfName.index:
            if dfName['count'][i] >= 150:
                self.name.append(dfName['patronyme'][i])
        print("Chargement des données CSV 50%")
        #Récupération de villes
        csvCities = pd.read_csv('./CSV/communes-64.csv', sep=";")
        dfCities = pd.DataFrame(csvCities, columns=['Code INSEE', 'Commune'])
        self.cities = []
        for i in dfCities.index:
            if len(dfCities['Code INSEE'][i]) == 5:
                self.cities.append((dfCities['Code INSEE'][i], dfCities['Commune'][i]))
        print("Chargement des données CSV 75%")
        #Récupération des adresses
        csvAdresse = pd.read_csv('./CSV/adresses-01.csv', nrows=10000, sep=';')
        dfAdresse = pd.DataFrame(csvAdresse, columns=["nom_voie"])
        self.adresse = []
        for i in dfAdresse.index:
            if dfAdresse['nom_voie'][i] not in self.adresse:
                self.adresse.append(dfAdresse['nom_voie'][i])
        print("Chargement des données CSV 100%")
        print("Chargement terminé")
    
    def generateID(self, range):
        idRandom = ""
        for i in range(range):
            idRandom += str(random.randint(0, 9))
        return int(idRandom)
    
    def generateHumanName(self):
        index = random.randint(0, len(self.name)-1)
        return self.name[index]

    def generateHumanSurname(self):
        index = random.randint(0, len(self.surname)-1)
        return self.surname[index]
    
    def generateLicenceFoot(self):
        car = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"
        numLicence = ""
        for i in range(10):
            numLicence += car[random.randint(0, len(car)-1)]
        return numLicence
    
    def generateCity(self):
        index = random.randint(0, len(self.cities)-1)
        return self.cities[index]
    
    def generateTypeStade(self):
        typeStade = ["HERBE", "SYNTHETIQUE", "STABILISE"]
        index = random.randint(0, len(typeStade)-1)
        return typeStade[index]
    
    def generateAdresse(self):
        adresseRandom = ""
        adresseRandom += str(random.randint(0, 100))
        index = random.randint(0, len(self.adresse)-1)
        adresseRandom += " " + self.adresse[index]
        return adresseRandom

    def generateTeamName(self, cityName):
        teamName = ""
        sigle = ["AJ", "AS", "FC", "Olympique", "SC", "RC", "US", "EA", "ES", "CO", "CA", "SM", "CS"]
        fin = random.randint(0, 1)
        indexSigle = random.randint(0, len(sigle)-1)
        if fin == 1:
            teamName += cityName + " " + sigle[indexSigle]
        else:
            teamName += sigle[indexSigle] + " " + cityName
        return teamName
    
    def rgb_to_hex(self, rgb):
        return '%02x%02x%02x' % rgb

    def generateColor(self):
        couleur = (random.randint(0,255), random.randint(0,255), random.randint(0,255))
        hexa = "#" + str(self.rgb_to_hex(couleur))
        return hexa
    
