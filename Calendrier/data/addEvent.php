<?php
require("./../../Template/config.php");
$bdd = getConnection_Ecriture();
// récupérer les paramètres depuis le formulaire
$type_ = $_POST['type_'];
$categorie = $_POST['categorie'];
$debut = $_POST['debut'];
$fin = $_POST['fin'];
$id_equipe = $_POST['id_equipe'];
$id_stade = $_POST['id_stade'];


try {
    // préparer la requête d'insertion
    $requete = $bdd->prepare("INSERT INTO Calendrier (type_,categorie,debut ,fin , idEquipe, idStade) VALUES (:type_,:categorie, :debut, :fin,:id_equipe, :id_stade)");

    // lier les paramètres
    $requete->bindParam(':type_', $type_);
    $requete->bindParam(':categorie', $categorie);
    $requete->bindParam(':debut', $debut);
    $requete->bindParam(':fin', $fin);
    $requete->bindParam(':id_equipe', $id_equipe);
    $requete->bindParam(':id_stade', $id_stade);

    // exécuter la requête
    $requete->execute();

    echo "Le match a été ajouté avec succès.";
} catch(PDOException $e) {
    echo "Une erreur s'est produite : " . $e->getMessage();
}

// fermer la connexion à la base de données
$bdd = null;


?>

