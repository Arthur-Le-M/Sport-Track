<?php
session_start();
require "../../Template/config.php"; // Lien pour la connexion a la BD

$idAuteur = $_SESSION['id'];
$idDestinataire = $_GET['id'];

$bdd = getConnection_Lecture();

$recupConv = $bdd->prepare('SELECT * FROM messages WHERE id_auteur = ? AND id_destinataire = ? OR id_auteur = ? AND id_destinataire = ? ORDER BY date DESC');
$recupConv->execute(array($idAuteur,$idDestinataire,$idDestinataire,$idAuteur));

$result = $recupConv->fetchAll();
$jsonResult = json_encode($result);

header('Content-Type: application/json');
echo $jsonResult;

?>