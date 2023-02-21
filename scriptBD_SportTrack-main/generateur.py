# -*- coding: utf-8 -*-
"""
Created on Wed Sep 28 08:46:28 2022

@author: arthu
"""

from bdb import GENERATOR_AND_COROUTINE_FLAGS
import random
import pandas as pd

print("Chargement ...")

csvSurname = pd.read_csv('./CSV/liste_des_prenoms.csv', sep=';')
dfSurname = pd.DataFrame(csvSurname, columns= ['prenoms','sexe'])

surname = []
for i in dfSurname.index:
    if dfSurname["sexe"][i] == "M":
        surname.append(dfSurname['prenoms'][i].upper())


csvName = pd.read_csv('./CSV/patronymes.csv', sep=",")
dfName = pd.DataFrame(csvName)

name = []

for i in dfName.index:
    if dfName['count'][i] >= 150:
        name.append(dfName['patronyme'][i])

poste = ['GARDIEN', 'DEFENSEUR', 'MILIEU', 'ATTAQUANT', 'ENTRAINEUR', 'DIRIGEANT']

csvCities = pd.read_csv('./CSV/communes-64.csv', sep=";")
dfCities = pd.DataFrame(csvCities, columns=['Code INSEE', 'Commune'])

cities = []

for i in dfCities.index:
    if len(dfCities['Code INSEE'][i]) == 5:
        cities.append((dfCities['Code INSEE'][i], dfCities['Commune'][i]))


csvAdresse = pd.read_csv('./CSV/adresses-01.csv', nrows=10000, sep=';')
dfAdresse = pd.DataFrame(csvAdresse, columns=["nom_voie"])

adresse = []
for i in dfAdresse.index:
    if dfAdresse['nom_voie'][i] not in adresse:
        adresse.append(dfAdresse['nom_voie'][i])


championnatD1 = {'id':47387, 'intitule':'Pyrénées Atlantiques D1', 'niveau':'D1'}
championnatD2 = {'id':47388, 'intitule':'Pyrénées Atlantiques D2', 'niveau':'D2'}
championnatD3 = {'id':47389, 'intitule':'Pyrénées Atlantiques D3', 'niveau':'D3'}




def genRandomID(nb):
    idRandom = ""
    for i in range(nb):
        idRandom += str(random.randint(0, 9))
    return int(idRandom)

#Générateurs 
def genName():
    index = random.randint(0, len(name)-1)
    return name[index]

def genSurname():
    index = random.randint(0, len(surname)-1)
    return surname[index]

def genLicence():
    car = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"
    numLicence = ""
    for i in range(10):
        numLicence += car[random.randint(0, len(car)-1)]
    return numLicence

def genCity():
    index = random.randint(0, len(cities)-1)
    return cities[index]

def genTeamName(cityName):
    teamName = ""
    sigle = ["AJ", "AS", "FC", "Olympique", "SC", "RC", "US"]
    fin = random.randint(0, 1)
    indexSigle = random.randint(0, len(sigle)-1)
    if fin == 1:
        teamName += cityName + " " + sigle[indexSigle]
    else:
        teamName += sigle[indexSigle] + " " + cityName
    return teamName

def rgb_to_hex(rgb):
    return '%02x%02x%02x' % rgb

def genColor():
    couleur = (random.randint(0,255), random.randint(0,255), random.randint(0,255))
    hexa = "#" + str(rgb_to_hex(couleur))
    return hexa


def genTypeStade():
    typeStade = ["HERBE", "SYNTHETIQUE", "STABILISE"]
    index = random.randint(0, len(typeStade)-1)
    return typeStade[index]

def genAdresse():
    adresseRandom = ""
    adresseRandom += str(random.randint(0, 100))
    index = random.randint(0, len(adresse)-1)
    adresseRandom += " " + adresse[index]
    return adresseRandom

def creerJoueur(poste, id_equipe):
    dico = {'licence':'','name':'', 'surname':'', 'poste':'', 'id_equipe':0}
    dico['licence'] = genLicence()
    dico['name'] = genName()
    dico['surname'] = genSurname()
    dico['poste'] = poste
    dico['id_equipe'] = id_equipe
    return dico

def creerJoueursEquipe(id_equipe):
    equipe = []
    for i in range(2):
        equipe.append(creerJoueur('GARDIEN', id_equipe))
    for i in range(4):
        equipe.append(creerJoueur('DEFENSEUR', id_equipe))
    for i in range(4):
        equipe.append(creerJoueur('MILIEU', id_equipe))
    for i in range(4):
        equipe.append(creerJoueur('ATTAQUANT', id_equipe))
    for i in range(2):
        equipe.append(creerJoueur('ENTRAINEUR', id_equipe))
    for i in range(1):
        equipe.append(creerJoueur('DIRIGEANT', id_equipe))
    return equipe

def creerStade():
    ville = genCity()
    stade = {'id':0, 'name' : '', 'type':'','adresse':'', 'code_postal':0, 'ville':'', 'type':''}
    stade['id'] = genRandomID(5)
    stade['name'] = "Stade de " + str(ville[1])
    stade['type'] = genTypeStade()
    stade['ville'] = str(ville[1])
    stade['adresse'] = genAdresse()
    stade['code_postal'] = int(ville[0])
    return stade

def creerEquipe(ville, id_stade):
    equipe = {'id':0, 'nom':'', 'ville':'', 'id_stade':0, 'couleur':''}
    equipe['id'] = genRandomID(5)
    equipe['nom'] = genTeamName(str(ville))
    equipe['ville'] = ville
    equipe['id_stade'] = id_stade
    equipe['couleur'] = genColor()
    return equipe

def creerAssociationEquipeStade():
    stade = creerStade()
    equipe = creerEquipe(stade['ville'], stade['id'])
    tableJoueur = creerJoueursEquipe(equipe['id'])
    return (stade, equipe, tableJoueur)

def remplirChampionnat(championnat):
    participerChampionnat = []
    equipe = []
    stade = []
    joueurs = []
    for i in range(10):
        gen = creerAssociationEquipeStade()
        participerChampionnat.append((gen[1]['id'], championnat['id']))
        equipe.append(gen[1])
        stade.append(gen[0])
        joueurs.append(gen[2])
    return (participerChampionnat, equipe, stade, joueurs)


#Simulation de match
def evenementAleatoire():
    evenementPossible = ['BUT']
    i = random.randint(0, len(evenementPossible)-1)
    return evenementPossible[i]

print("Chargement terminé")