<?php
session_start();
$_SESSION['id']=10;
function getConnection() {
    $bdd = new PDO('mysql:host=localhost;dbname=bd_sporttrack;charset=utf8;','root','root');
    return $bdd;
}
$bdd = getConnection();

$idDest = $_GET['id'];
$message = $_GET['message'];

// Insertion dans la BD
$message = htmlspecialchars($message); //on peut aussi utiliser strip_tags()
$insertMsg = $bdd->prepare('INSERT INTO messages(message, id_destinataire, id_auteur, date) VALUES (?, ?, ?, NOW())');
$insertMsg->execute(array($message, $idDest, $_SESSION['id']));

?>