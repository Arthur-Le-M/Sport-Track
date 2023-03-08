<?php
require "../../Template/config.php";
$bdd = getConnection();

$idEquipe = $_GET['id'];

$req = $bdd->prepare("SELECT m.journee, COUNT(DISTINCT e.id) AS but_inscrit FROM EvenementMatch e JOIN MatchTable m ON e.id_match = m.id WHERE e.licence_joueur = :id_equipe AND e.type = 'BUT' GROUP BY m.journee ORDER BY m.journee ASC;");
$req->execute(array('id_equipe' => $idEquipe));
$data = $req->fetchAll();

$req = $bdd->prepare("SELECT MAX(m.journee) AS nb_journees FROM EvenementMatch e JOIN MatchTable m ON e.id_match = m.id WHERE e.licence_joueur = :id_equipe;");
$req->execute(array('id_equipe' => $idEquipe));
$nbJournees = $req->fetch(PDO::FETCH_ASSOC)['nb_journees'];

$data['nb_journees'] = $nbJournees;

header("Content-Type: application/json; charset=UTF-8");
echo json_encode($data, JSON_UNESCAPED_UNICODE);
?>