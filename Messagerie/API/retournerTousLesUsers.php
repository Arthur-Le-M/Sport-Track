<?php
session_start();
require "../config.php"; // Lien pour la connexion a la BD

$bdd = getConnection();

$recupAllUser = $bdd->prepare('SELECT * FROM users WHERE id != ?');
$recupAllUser->execute(array($_SESSION['id']));
$allUser = $recupAllUser->fetchAll();

$tousLesUsers = array();

foreach($allUser as $unUser) {
    $id = $unUser[0];
    $pseudo = $unUser[1];

    $array = array($id,$pseudo);
    array_push($tousLesUsers,$array);
}


$jsonUsers = json_encode($tousLesUsers);

header('Content-Type: application/json');
echo $jsonUsers;

?>