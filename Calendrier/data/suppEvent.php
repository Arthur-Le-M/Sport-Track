<?php
require("./../../Template/config.php");
$bdd = getConnection_Ecriture();
// récupérer les paramètres depuis le formulaire
$id = $_GET['id'];


try {
    // préparer la requête d'insertion
    $requete = $bdd->prepare("DELETE FROM Calendrier WHERE id=:id");
    // lier les paramètres
    $requete->bindParam(':id', $id);

    // exécuter la requête
    $requete->execute();

    echo "Le match a été supprimé avec succès.";
} catch(PDOException $e) {
    echo "Une erreur s'est produite : " . $e->getMessage();
}

// fermer la connexion à la base de données
$bdd = null;

?>