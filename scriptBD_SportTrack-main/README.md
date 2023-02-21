# Réécriture du projet en mode objet en cours

# ...

# Script Base de données pour l'application Sport Track

### Explication du but du script
Afin de mener à bien notre [projet "SportTrack"](https://github.com/TitouCoch/SportTrack) de 2ème année de BUT Informatique nous avions besoin d'une bases de données contenant des données sur un district du football amateur en France. Malheureusement impossible de nous en fournir une. **De ce fait nous avons décider de nous en créer une nous même**. En remplire une à la main aurait pris beaucoups de temps et très fatiguant c'est en qualité de bon développeurs que nous sommes que nous avons décidés d'automatiser le remplissage de la base de données.

### La base de données

Ce script à pour but de remplir seulement certaine table de la base de données :


| Nom de la table | Description |
| :--------------- |:---------------:|
| **Stade**  | Données des stades concernée par le district |
| **Equipe**  | Données des équipes concernée par le district |
| **Joueur**  | Données des joueurs concernée par le district |
| **Championnat**  | Données des championnats concernée par le district |
| **participerChampionnat**  | Table d'associations entre Equipe et Championnat |
| **MatchTable**  | Données des rencontres des équipes du district |
| **evenementMatch**  | Les évènements qui se passe pendant un matchs, les buts par exemple |

Les requêtes de créations de ces tables ce trouvent dans [ce fichier](requeteSQL/creationTable.txt).

### Guide d'utilisation

- Tout d'abord pour utiliser le script et pouvoir générer une base de données il va falloir créer les tables à la main sur son SGBD
Les requêtes de créations de ces tables :

```
CREATE TABLE Stade
(id INTEGER(5) NOT NULL PRIMARY KEY,
nom VARCHAR(50) NOT NULL,
adresse VARCHAR(50) NOT NULL,
code_postal INTEGER(5) NOT NULL,
ville VARCHAR(50) NOT NULL,
Type VARCHAR(25));

CREATE TABLE Equipe
(id INTEGER(5) NOT NULL PRIMARY KEY,
nom VARCHAR(100) NOT NULL,
ville VARCHAR(35) NOT NULL,
id_stade INTEGER(5) NOT NULL,
couleur VARCHAR(7) NOT NULL,
FOREIGN KEY (id_stade) REFERENCES Stade(id));	

CREATE TABLE Championnat
(id INTEGER(5) NOT NULL PRIMARY KEY,
intitule VARCHAR(25) NOT NULL,
niveau VARCHAR(2) NOT NULL);

CREATE TABLE participerChampionnat
(id_equipe INTEGER(5) NOT NULL,
id_championnat INTEGER(5) NOT NULL,
PRIMARY KEY(id_equipe, id_championnat),
FOREIGN KEY(id_equipe) REFERENCES Equipe(id),
FOREIGN KEY(id_championnat) REFERENCES Championnat(id));
CREATE TABLE Joueur
(licence VARCHAR(10) NOT NULL PRIMARY KEY,
nom VARCHAR(25) NOT NULL,
prenom VARCHAR(25) NOT NULL,
id_equipe INTEGER(5) NOT NULL,
poste VARCHAR(15)NOT NULL,
FOREIGN KEY(id_equipe) REFERENCES Equipe(id));

CREATE TABLE MatchTable
(id INTEGER(5) NOT NULL PRIMARY KEY,
jouer TINYINT(1) NOT NULL,
heure_debut DATETIME NOT NULL,
heure_fin DATETIME NOT NULL,
id_equipe_dom INTEGER(5) NOT NULL,
id_equipe_ext INTEGER(5) NOT NULL,
id_stade INTEGER(5) NOT NULL,
journee INTEGER(2),
commentaire TEXT,
FOREIGN KEY(id_equipe_dom) REFERENCES Equipe(id),
FOREIGN KEY(id_equipe_ext) REFERENCES Equipe(id),
FOREIGN KEY(id_stade) REFERENCES Stade(id));

CREATE TABLE EvenementMatch
(id INTEGER(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
id_match INTEGER(5) NOT NULL,
licence_joueur VARCHAR(10) NOT NULL,
type VARCHAR(15) NOT NULL,
temps INTEGER(2) NOT NULL,
commentaire TEXT,
FOREIGN KEY(id_match) REFERENCES MatchTable(id),
FOREIGN KEY(licence_joueur) REFERENCES Joueur(licence));

CREATE TABLE Inscrit
(id INTEGER(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
licence VARCHAR(10) NOT NULL,
mail VARCHAR(50) NOT NULL,
mdp VARCHAR(50) NOT NULL,
FOREIGN KEY(licence) REFERENCES Joueur(licence));

CREATE TABLE Message
(id INTEGER(5) NOT NULL PRIMARY KEY,
id_auteur INTEGER(5) NOT NULL FOREIGN KEY(Inscrit) REFERENCES(id),
id_destinataire INTEGER(5) NOT NULL FOREIGN KEY(Inscrit) REFERENCES(id),
date DATE NOT NULL,
contenu TEXT NOT NULL);

CREATE TABLE EventCalendrier
(id INTEGER(5) NOT NULL PRIMARY KEY,
intitule VARCHAR(20) NOT NULL,
heure_deb DATE NOT NULL,
heure_fin DATE NOT NULL,
id_equipe INTEGER(5) NOT NULL FOREIGN KEY(Equipe),
id_stade INTEGER(5) NOT NULL FOREIGN KEY(Stade),
id_createur INTEGER(5) NOT NULL FOREIGN KEY(Inscrit)
commentaire TEXT);
```

- Maintenant que les tables sont créer il faut configurer la connexion à la base de données dans le fichier ```scriptTable.py``` à la ligne 8.
```
conn = mysql.connector.connect(host='localhost',port='3306', user='root', password='', database = 'bd_sporttrack')
```
Modifier les informations selon la configuration de son SGBD

- Voilà la configuration est terminé on peut maintenant utilisé les fonction tel que ```genererBD``` pour générer sa base de données.

### Documentation

**Fonctionnement global**
Ce projet contient deux fichiers qui fonctionne ensemble : le script ```scriptTable.py``` appelle des fonctions de ```generateur.py```.

**Détatils des fonctions**
Je vais essentiellement détailler les fonctions importantes pour le moment.

Dans ```scriptTable.py``` : 

- Générer une base de données complète
```genererBD(nbChampionnat, nbJourneeASimuler, debutSaison):```
Elle prends 3 paramètre : ```nbChampionnat``` le nombre de championnat que l'on veut insérer dans notre BD, ```nbJourneeASimuler``` le nombre de journées que l'on veut simuler (les matchs de ces journée seront simuler), ```debutSaison```la date du debut de la saison en format de datetime ```datetime(year, month, day)```
- Vider la base de donnée 
```clearBD()```
Attention cette fonction va vider totalement la base de données, utile pour les tests.
