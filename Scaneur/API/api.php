<?php
// Récupération du numéro de licence dans les données de la requête
$license = $_GET['license'];

// Requête à la base de données pour vérifier si le numéro de licence existe
require "../../Template/config.php"; // Lien pour la connexion a la BD
$bdd = getConnection_Lecture();
$verifLicence = $bdd->prepare("SELECT * FROM Joueur WHERE licence = :licence");
$verifLicence->execute(array(':licence' => $licence));

$link = $verifLicence->fetchAll();
// Vérification si le numéro de licence existe
if (!$link) {}
else
{
  if ($verifLicence->rowCount() > 0) {
    // Le numéro de licence existe
    $response = ['licenseExists' => true];
  } else {
    // Le numéro de licence n'existe pas
    $response = ['licenseExists' => false];
  }
  // Retourne la réponse sous forme d'objet JSON
  print(json_encode($response));
}

?>