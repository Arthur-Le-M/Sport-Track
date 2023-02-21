
from secrets import choice
import mysql.connector
import generateur
import datetime
import random

conn = mysql.connector.connect(host='localhost',port='3306', user='root', password='', database = 'bd_sporttrack')
cursor = conn.cursor()


#Fonction permettant d'insérer un Stade généré dans la base de données
def insererStade():
    #Verification ID et ville
    while True:
        stade = generateur.creerStade()
        queryVerif = 'SELECT COUNT(*) FROM Stade WHERE id = %s'
        val = [stade['id']]
        cursor.execute(queryVerif, val)
        #Si le résultat de la requête est égale à 0
        if cursor.fetchall()[0][0] == 0:
            queryVerif = "SELECT COUNT(*) FROM Stade WHERE ville = %s"
            val = [stade['ville']]
            cursor.execute(queryVerif, val)
            if cursor.fetchall()[0][0] == 0:
                break;
            else:
                print('Ville déjà utilisé')
        else:
            print('ID déjà utilisé')
    #Verif ID et ville Terminé
    query = 'INSERT INTO Stade (id, nom, adresse, code_postal, ville, type) VALUES(%s, %s, %s, %s, %s, %s)'
    val = (stade['id'], stade['name'], stade['adresse'], stade['code_postal'], stade['ville'], stade['type'])
    cursor.execute(query, val)
    conn.commit()
    return stade['id']

#Fonction permettant d'insérer une Equipe générée dans la base de données
def insererEquipe(idStade):
    #Récupération de la ville
    query = 'SELECT ville FROM Stade WHERE id = %s'
    val = [idStade]
    cursor.execute(query, val)
    ville = cursor.fetchall()[0][0]

    #Verif ID
    while True:
        equipe = generateur.creerEquipe(ville, idStade)
        query = 'SELECT COUNT(*) FROM Equipe WHERE id = %s'
        val = [equipe['id']]
        cursor.execute(query, val)
        if cursor.fetchall()[0][0] == 0:
            break;
        else:
            print('ID déjà utilisé')
    
    query = "INSERT INTO Equipe (id, nom, ville, id_stade, couleur) VALUES(%s, %s, %s, %s, %s);"
    val = (equipe['id'], equipe['nom'], ville, idStade, equipe['couleur'] ) 
    cursor.execute(query, val)
    conn.commit()
    return equipe['id']

#Fonction permettant d'insérer un Joueur généré dans la base de données
def insererJoueur(idEquipe, poste):
    #Verif ID
    while True:
        joueur = generateur.creerJoueur(poste, idEquipe)
        query = 'SELECT COUNT(*) FROM Joueur WHERE licence = %s'
        val = [joueur['licence']]
        cursor.execute(query, val)
        if cursor.fetchall()[0][0] == 0:
            break;
        else:
            print('Licence déjà utilisé')
    query = "INSERT INTO Joueur (licence, nom, prenom, id_equipe, poste) VALUES(%s, %s, %s, %s, %s)"
    val = (joueur['licence'], joueur['name'], joueur['surname'], idEquipe, poste)
    cursor.execute(query, val)
    conn.commit()

#fichier permettant d'ajouter un composition cohérente de joueurs dans une équipe
def insererJoueurEquipe(idEquipe):
    for i in range(2):
        insererJoueur(idEquipe, 'GARDIEN')
    for i in range(4):
        insererJoueur(idEquipe, 'DEFENSEUR')
    for i in range(4):
        insererJoueur(idEquipe, 'MILIEU')
    for i in range(4):
        insererJoueur(idEquipe, 'ATTAQUANT')
    for i in range(2):
        insererJoueur(idEquipe, 'ENTRAINEUR')
    for i in range(1):
        insererJoueur(idEquipe, 'DIRIGEANT')

#Fonction permettant d'ajouter un tuple à participerChampionnat
def lierChampionnatEquipe(idEquipe, idChampionnat):
    query = "INSERT INTO participerChampionnat (id_equipe, id_championnat) VALUES(%s, %s)"
    val = [idEquipe, idChampionnat]
    cursor.execute(query, val)
    conn.commit()

#Fonction permettant de créer un Championnat et le remplir automatiquement avec Equipe, Stade, Joueurs
def creerChampionnat():
    nomChampionnat = input('Nom : ')
    niveauChampionnat = input('Niveau (D1, D2 etc...) : ')
    nombreEquipe = input("Nombre d'équipes : ")
    #Verif ID
    while True:
        idChampionnat = generateur.genRandomID(5)
        query = 'SELECT COUNT(*) FROM Championnat WHERE id=%s'
        val = [idChampionnat]
        cursor.execute(query, val)
        if cursor.fetchall()[0][0] == 0:
            break;
        else:
            print('ID déjà utilisé')
    
    #Ajouts du Championnat
    query = "INSERT INTO Championnat (id, intitule, niveau) VALUES(%s, %s, %s)"
    val = [idChampionnat, nomChampionnat, niveauChampionnat]
    cursor.execute(query, val)
    conn.commit()

    #Insertion des équipes
    for i in range(int(nombreEquipe)):
        idStade = insererStade()
        idEquipe = insererEquipe(idStade)
        insererJoueurEquipe(idEquipe)
        lierChampionnatEquipe(idEquipe, idChampionnat)
        
    return idChampionnat

def inverseTuple(ancienTuple):
    return (ancienTuple[1], ancienTuple[0])

def round_robin(tableIdEquipe):
    arretable = False
    #Tuple définit pour le cas d'arrêt
    arret = (tableIdEquipe[0], tableIdEquipe[len(tableIdEquipe)-1])
    #Cas de tableau impaire
    if len(tableIdEquipe) % 2:
        tableIdEquipe.append(None)
    planification = []
    while True:
        #Création de la journée
        journee = []
        for i in range(int(len(tableIdEquipe) / 2)):
            journee.append((tableIdEquipe[i], tableIdEquipe[len(tableIdEquipe) - i - 1]))
        tableIdEquipe.insert(1, tableIdEquipe.pop())
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
            journee.append(inverseTuple(premierePartieSaison[i][j]))
        planification.append(journee)
    return planification

def planifierMatch(idChampionnat, debutSaison):
    #Récupérer les idEquipe que l'on va stocker dans un tableau
    listeIdEquipe = []
    query = 'SELECT id_equipe FROM participerChampionnat WHERE id_championnat = %s'
    val = [idChampionnat]
    cursor.execute(query, val)
    record = cursor.fetchall()
    for i in range(len(record)):
        listeIdEquipe.append(record[i][0])
    nombreEquipes = len(listeIdEquipe)
    

    #Planification de journée:
    planification = round_robin(listeIdEquipe)

    #Gerer la date sous le format DATETIME : 1000-01-01 00:00:
    dicoDate = {}
    dateActuelle = debutSaison
    journee = 0
    while journee < len(planification):
        dateActuelle += datetime.timedelta(weeks=1)
        print(journee, dateActuelle < datetime.date(dateActuelle.year, 12, 15) and dateActuelle > datetime.date(dateActuelle.year, 1, 10))
        if dateActuelle < datetime.date(dateActuelle.year, 12, 15) and dateActuelle > datetime.date(dateActuelle.year, 1, 10):
            dicoDate[journee] = dateActuelle
            journee += 1

    #Insérer la planification dans la table match

    for i in range(len(planification)-1):
        print(len(planification), len(dicoDate))
        dateJournee = dicoDate[i]
        print(dateJournee)
        for j in range(len(planification[i])):
            #On récupère toutes les informations que l'on a besoin
            #On récupère les équipes domicile et extérieur
            idEquipeDom = planification[i][j][0] 
            idEquipeExt = planification[i][j][1]
            #On récupère les horaires et la date
            heure = random.randint(13, 21)
            heureDebut = datetime.datetime(dateJournee.year, dateJournee.month, dateJournee.day, heure, 30, 00)
            heureFin = datetime.datetime(dateJournee.year, dateJournee.month, dateJournee.day, heure+2, 15, 00)
            #On récupère le stade de l'équipe domicile
            query = "SELECT id_stade FROM Equipe WHERE id = %s"
            val = [idEquipeDom]
            cursor.execute(query, val)
            record = cursor.fetchall()
            idStade = record[0][0]
            #On créer l'id
            while True:
                idMatch = generateur.genRandomID(5)
                query = "SELECT COUNT(*) FROM MatchTable WHERE id = %s"
                val = [idMatch]
                cursor.execute(query, val)
                record = cursor.fetchall()
                if record[0][0] == 0:
                    break
            #Les info sont récupérer on insère dans la base
            query = """
            INSERT INTO MatchTable (id, jouer, heure_debut, heure_fin, id_equipe_dom, id_equipe_ext, id_stade, journee)
            VALUES (%s, %s, %s, %s, %s, %s, %s, %s)
            """
            val = [idMatch, 0, heureDebut, heureFin, idEquipeDom, idEquipeExt, idStade, i+1]
            cursor.execute(query, val)
            conn.commit()

def simulerMatch(idMatch, dureeMatch=90, frequenceEvent=5):
    #Récupérer les informations du match
    query = 'SELECT id_equipe_dom, id_equipe_ext FROM MatchTable WHERE id = %s'
    val = [idMatch]
    cursor.execute(query, val)
    record = cursor.fetchall()
    equipes = []
    #On stock les équipes dans un tableau
    equipes.append(record[0][0])
    equipes.append(record[0][1])
    for i in range(dureeMatch):
        probaEvenement = random.randint(0, 100)
        if probaEvenement <= frequenceEvent:
            typeEvent = generateur.evenementAleatoire()
            tempsEvent = i
            equipeConcernee = choice(equipes)
            #On va récupérer un joueur aléatoire dans l'équipe
            query = "SELECT licence FROM Joueur WHERE id_equipe=%s AND poste IN ('DEFENSEUR', 'MILIEU', 'ATTAQUANT')"
            val = [equipeConcernee]
            cursor.execute(query, val)
            record = cursor.fetchall()
            joueursConcernes = []
            for j in range(len(record)):
                joueursConcernes.append(record[j][0])
            licenceJoueur = choice(joueursConcernes)
            #On insère la ligne dans la table Event
            query = 'INSERT INTO EvenementMatch (id_match, licence_joueur, type, temps) VALUES (%s, %s, %s, %s)'
            val = [idMatch, licenceJoueur, typeEvent, tempsEvent]
            cursor.execute(query, val)
            conn.commit()

            #On modifie la ligne du match pour changer son état à joué
            query = "UPDATE MatchTable SET jouer = 1 WHERE id=%s"
            val = [idMatch]
            cursor.execute(query, val)
            conn.commit()

    print('Match ', idMatch, ' simulé')

def simulerJournee(numJournee):
    query = "SELECT id FROM MatchTable WHERE journee = %s"
    val = [numJournee]
    cursor.execute(query, val)
    equipe = cursor.fetchall()
    print(equipe)
    for i in range(len(equipe)):
        simulerMatch(equipe[i][0])

#Création d'un script principal
def genererBD(nbChampionnat, nbJourneeASimuler, debutSaison):
    #Création des championnats équipes, joueurs, stades
    championnat = []
    for i in range(nbChampionnat):
        idChamp = creerChampionnat()
        championnat.append(idChamp)
    
    #Prévition des matchs
    for i in range(len(championnat)):
        planifierMatch(championnat[i], debutSaison)

    #Simulation des matchs
    for i in range(nbJourneeASimuler):
        simulerJournee(i+1)

#Fonction pour vider la base de données
def clearBD():
    query = "DELETE FROM evenementMatch WHERE 1"
    cursor.execute(query)
    conn.commit()

    query = "DELETE FROM MatchTable WHERE 1"
    cursor.execute(query)
    conn.commit()

    query = "DELETE FROM participerChampionnat WHERE 1"
    cursor.execute(query)
    conn.commit()

    query = "DELETE FROM championnat WHERE 1"
    cursor.execute(query)
    conn.commit()

    query = "DELETE FROM Inscrit WHERE 1"
    cursor.execute(query)
    conn.commit()

    query = "DELETE FROM Joueur WHERE 1"
    cursor.execute(query)
    conn.commit()

    query = "DELETE FROM equipe WHERE 1"
    cursor.execute(query)
    conn.commit()

    query = "DELETE FROM Stade WHERE 1"
    cursor.execute(query)
    conn.commit()
#Format de date utilisé : date = datetime.date(2022, 8, 12)

clearBD()
genererBD(3, 6, datetime.date(2022, 8, 21))
conn.disconnect()