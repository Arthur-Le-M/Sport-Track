<?php
require "../../Template/config.php";
$bdd = getConnection();

$idEquipe = $_GET['id'];

$req = $bdd->prepare('SELECT e.nom AS equipe, COUNT(DISTINCT j.licence) AS nb_joueurs, COUNT(DISTINCT m.id) AS nb_matchs, COUNT(DISTINCT IF(em.type = "but" AND em.id_equipe = :id, em.id, NULL)) AS nb_buts FROM equipe e LEFT JOIN joueur j ON j.id_equipe = e.id LEFT JOIN matchtable m ON m.id_equipe_dom = e.id OR m.id_equipe_ext = e.id LEFT JOIN evenementmatch em ON m.id = em.id_match WHERE e.id = :id AND m.jouer = 1 GROUP BY e.nom;');
$req->execute(array('id' => $idEquipe));
$equipe = $req->fetch();

$req = $bdd->prepare('SELECT m.id, m.heure_debut, e1.nom, e2.nom,SUM(CASE WHEN em.id_equipe = m.id_equipe_dom THEN 1 ELSE 0 END) AS score_dom,SUM(CASE WHEN em.id_equipe = m.id_equipe_ext THEN 1 ELSE 0 END) AS score_ext FROM `matchtable` m JOIN equipe e1 ON m.id_equipe_dom = e1.id JOIN equipe e2 ON m.id_equipe_ext = e2.id LEFT JOIN evenementmatch em ON m.id = em.id_match AND em.type = "but" WHERE m.jouer = 1 AND (m.id_equipe_dom = :id_equipe OR m.id_equipe_ext = :id_equipe) GROUP BY m.id, m.heure_debut, e1.nom, e2.nom ORDER BY m.heure_debut DESC;');
$req->execute(array('id_equipe' => $idEquipe));
$matchs = $req->fetchAll();


//Calculer les pourcentages a partir de la liste de match et du nombre de match
$victoire = 0;
$defaite = 0;
$egalite = 0;
foreach ($matchs as $match) {
    $numEquipe = 0;
    if($equipe[0] == $match[2]){
        $numEquipe = 0;
    } else {
        $numEquipe = 1;
    }
    if ($match[4] > $match[5] && $numEquipe == 0 || $match[4] < $match[5] && $numEquipe == 1) {
        $victoire++;
    } else if ($match[4] == $match[5]) {
        $egalite++;
    } else {
        $defaite++;
    }
}
$victoire = $victoire / $equipe[2] * 100;
$defaite = $defaite / $equipe[2] * 100;
$egalite = $egalite / $equipe[2] * 100;
$data = [round($defaite),round($egalite),round($victoire)];

header("Content-Type: application/json; charset=UTF-8");
echo json_encode($data, JSON_UNESCAPED_UNICODE);
?>