<?php
require_once("config.php");
$nomtable= "Calendrier"; /* Connection bdd */
$db = new PDO("mysql:host=$host;dbname=$bdd", $user, $pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function readCalendrier($db, $id){
    $queryParams = [];
    $queryText = "SELECT e.type_, e.categorie, e.debut, e.fin, eq.nom as nom_equipe, st.nom as nom_stade 
                  FROM Calendrier e 
                  LEFT JOIN equipe eq ON e.idEquipe = eq.id 
                  LEFT JOIN stade st ON e.idStade = st.id 
                  WHERE e.idEquipe=:id";
    $query = $db->prepare($queryText);
    $queryParams[":id"] = $id;
    $query->execute($queryParams);
    $events = $query->fetchAll(PDO::FETCH_ASSOC);
    return $events;
}

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $result = readCalendrier($db, $id);
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

