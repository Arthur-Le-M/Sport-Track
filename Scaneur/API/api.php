<?php
// Récupération du numéro de licence dans les données de la requête
$license = $_GET['license'];

// Requête à la base de données pour vérifier si le numéro de licence existe

$bdd= "bd_sporttrack"; // Base de données
$host= "localhost";
$user= "root"; // Utilisateur
$pass= "root"; // mp
$nomtable= "Joueur"; /* Connection bdd */
$link=mysqli_connect($host,$user,$pass,$bdd);
$query = "SELECT * FROM $nomtable WHERE licence = '$license'";
$result= mysqli_query($link,$query);
// Vérification si le numéro de licence existe
if (!$link) {}
else
{
  if (mysqli_num_rows($result) > 0) {
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