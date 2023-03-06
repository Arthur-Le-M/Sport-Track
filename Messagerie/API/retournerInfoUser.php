<?php
session_start();
require "../client/config.php"; // Lien pour la connexion a la BD

$id = $_GET['id'];

$bdd = getConnection();

// Recuperation de la licence 
$recupLicence = $bdd->prepare('SELECT * FROM inscrit WHERE id = ?');
$recupLicence->execute(array($id));
$licence = $recupLicence->fetch()['licence'];

// Recuperation du pseudo
$recupPseudo = $bdd->prepare('SELECT * FROM joueur WHERE licence = ?');
$recupPseudo->execute(array($licence));
$infoJoueur = $recupPseudo->fetch();

$nom = $infoJoueur[1];
$prenom = ucfirst(strtolower($infoJoueur[2])); // je met la chaine en minuscule (strtolower) et je met la première lettre en majuscule (ucfirst)

$pseudo = $prenom." ".$nom;

$jsonUser = json_encode($pseudo);

header('Content-Type: application/json');
echo $jsonUser;

?>