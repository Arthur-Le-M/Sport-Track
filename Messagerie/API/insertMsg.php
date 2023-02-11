<?php
session_start();
require "../config.php"; // Lien pour la connexion a la BD

$bdd = getConnection();

$idDest = $_GET['id'];
$message = $_GET['message'];

// Insertion dans la BD
$message = htmlspecialchars($message); //on peut aussi utiliser strip_tags()
$insertMsg = $bdd->prepare('INSERT INTO messages(message, id_destinataire, id_auteur, date) VALUES (?, ?, ?, NOW())');
$insertMsg->execute(array($message, $idDest, $_SESSION['id']));

?>