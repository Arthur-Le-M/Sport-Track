<?php
require_once("../../Template/config.php");
$bdd = getConnection();
$nomtable= "MatchTable"; /* Connection bdd */

function readMatch($bdd, $id){
    $queryParams = [];
    $queryText = "SELECT m.id, m.heure_debut, m.heure_fin, eq.nom as equipe_dom, eq2.nom as equipe_ext, st.nom as nomStade 
                  FROM MatchTable m 
                  LEFT JOIN Equipe eq ON m.id_equipe_dom = eq.id 
                  LEFT JOIN Equipe eq2 ON m.id_equipe_ext = eq2.id 
                  LEFT JOIN Stade st ON m.id_stade = st.id 
                  WHERE m.id_equipe_dom=:id or m.id_equipe_ext=:id";
    $query = $bdd->prepare($queryText);
    $queryParams[":id"] = $id;
    $query->execute($queryParams);
    $events = $query->fetchAll(PDO::FETCH_ASSOC);
    return $events;
}

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $result = readMatch($bdd, $id);
        } else {
            $result = array("error" => "ID is required");
        }
        break;
    case "POST":
        // we'll implement this later
    break;
    default: 
        throw new Exception("Unexpected Method"); 
    break;
}
header("Content-Type: application/json; charset=UTF-8");
echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>