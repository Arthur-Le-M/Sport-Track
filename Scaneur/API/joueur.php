<?php
$licence = $_GET['licence'];
require "../../Template/config.php"; // Lien pour la connexion a la BD
$bdd = getConnection_Lecture();
$verifLicence = $bdd->prepare("SELECT * FROM Joueur WHERE licence = :licence");
$verifLicence->execute(array(':licence' => $licence));

$link = $verifLicence->fetchAll();
  if (!$link) {}
  else {
    // If the license number exists, loop through the query results
    echo "<h1>Détails de la licence</<h1>";
    echo "<body>";
    echo "<div>";
    while ($row = mysqli_fetch_array($result)) {
      // Print each element of the query result in a clean HTML page
      echo '<p> Licence : ';
      echo $row['licence'];
      echo '</p>';
      echo '<p>Nom : ';
      echo $row['nom'];
      echo '</p>';
      echo '<p>Prénom : ';
      echo $row['prenom'];
      echo '</p>';
      echo '<p>ID Equipe : ';
      echo $row['id_equipe'];
      echo '</p>';
      echo '<p>Poste : ';
      echo $row['poste'];
      echo '</p>';
    }
    echo "</div>";


    echo "</body>";
    
    print "<style>
      body{
        display:flex;
        flex-direction:column;
        align-items:center;
        background-color:black;
      }
      h1{
        color: aliceblue;
        font-size:60px;
        font-family : Arial, Helvetica, sans-serif;
        align-items: center;
      }
      div{
        display:flex;
        flex-direction:column;
        align-items:center;
        margin-top:100px;
        test-align:center;
      }
      div p{
      color:white;
      font-size: 16px;
      font-weight: bold;
    }
    button {
      margin-top:40px;
      display: inline-block;
      font-size: 16px;
      padding: 10px 20px;
      color: white;
      background-color: #f9b233;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
      button:hover {
        background-color: #b78022;
    }
  </style>";
  }

?>




