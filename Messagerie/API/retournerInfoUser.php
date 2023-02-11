<?php
require "../config.php"; // Lien pour la connexion a la BD

$id = $_GET['id'];

$bdd = getConnection();

$recupUser = $bdd->prepare('SELECT * FROM users WHERE id = ?');
$recupUser->execute(array($id));
$user = $recupUser->fetch()['pseudo'];
$jsonUser = json_encode($user);

header('Content-Type: application/json');
echo $jsonUser;

?>