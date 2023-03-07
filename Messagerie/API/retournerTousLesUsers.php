<?php
session_start();
require "../../Template/config.php"; // Lien pour la connexion a la BD

$bdd = getConnection();

$recupAllUser = $bdd->prepare('SELECT * FROM inscrit WHERE id != ?');
$recupAllUser->execute(array($_SESSION['id']));
$allUser = $recupAllUser->fetchAll();

$recupPseudo = $bdd->prepare('SELECT * FROM joueur WHERE licence = ?');


$tousLesUsers = array();

foreach($allUser as $unUser) {
    $id = $unUser[0];
    $licence = $unUser[1];

    // Récupération des informations des joueurs
    $recupPseudo->execute(array($licence));
    $infoJoueur = $recupPseudo->fetch();

    $nom = $infoJoueur[1];
    $prenom = ucfirst(strtolower($infoJoueur[2])); // je met la chaine en minuscule (strtolower) et je met la première lettre en majuscule (ucfirst)

    $pseudo = $prenom." ".$nom;

    $array = array($id,$pseudo);
    array_push($tousLesUsers,$array);
}


$jsonUsers = json_encode($tousLesUsers);

header('Content-Type: application/json');
echo $jsonUsers;

?>