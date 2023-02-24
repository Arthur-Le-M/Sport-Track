<?php
session_start();
require "../config.php";
$bdd = getConnection();

/* 
 * Objectif de ce script php : générer un tableau contenant les infos : 
 * [id, pseudo, contenu-dernier-message, date-dernier-message] de chaque
 * utilisateur associé à celui connecté.
*/

// Préparation d'une requete qui regarde qui a eu une interaction avec l'user connecté
$recupContactsAssocies = $bdd->prepare('SELECT DISTINCT CASE WHEN id_auteur = ? THEN id_destinataire ELSE id_auteur END AS id FROM messages WHERE id_auteur = ? OR id_destinataire = ?');
$recupContactsAssocies->execute(array($_SESSION['id'],$_SESSION['id'],$_SESSION['id']));
$idContacts = $recupContactsAssocies->fetchAll();

// Préparation d'une requete qui récupèrera la licence d'un utilisateur
$recupLicence = $bdd->prepare('SELECT licence FROM inscrit WHERE id = ?');

// Préparation d'une requete qui récupèrera le pseudo d'un utilisateur
$recupPseudo = $bdd->prepare('SELECT * FROM joueur WHERE licence = ?');

// Récupération du dernier message entre 2 utilisateurs
$recupLastMsg = $bdd->prepare('SELECT * FROM messages WHERE (id_destinataire=? AND id_auteur=? AND date = (SELECT MAX(date) FROM messages WHERE id_destinataire=? AND id_auteur=?)) OR (id_destinataire=? AND id_auteur=? AND date = (SELECT MAX(date) FROM messages WHERE id_destinataire=? AND id_auteur=?)) ORDER BY id DESC');

// On enlève l'id du user connecté
$filtered_contacts = array();

foreach($idContacts as $contact) {
    // Création d'un nouveau contact
    $unContact = array();

    // Condition pour afficher tout le monde sauf lui même 
    if ($contact[0] != $_SESSION['id']) {
        // Je place l'id en cours dans le tab
        array_push($unContact,$contact[0]);

        // Récupération du numéro de licence
        $recupLicence->execute(array($contact[0]));
        $licenceJoueur = $recupLicence->fetch();
        $licence = $licenceJoueur[0];

        // Pour chaque id d'un contact, j'execute la requete qui récupère le pseudo de l'utilisateur
        $recupPseudo->execute(array($licence));
        $infoJoueur = $recupPseudo->fetch();

        $nom = $infoJoueur[1];
        $prenom = ucfirst(strtolower($infoJoueur[2])); // je met la chaine en minuscule (strtolower) et je met la première lettre en majuscule (ucfirst)

        $pseudo = $prenom." ".$nom;

        // je place le pseudo en cours dans le tab
        array_push($unContact,$pseudo);

        // Je récupère le dernier message 
        $recupLastMsg->execute(array($_SESSION['id'],$contact[0],$_SESSION['id'],$contact[0],$contact[0],$_SESSION['id'],$contact[0],$_SESSION['id']));
        $infosLastMsg = $recupLastMsg->fetchAll();

        // je place le contenu du dernier message du contact en cours dans le tab
        array_push($unContact,$infosLastMsg[0]['message']);
        // je place la date du dernier message du contact en cours dans le tab
        array_push($unContact,$infosLastMsg[0]['date']);
        
        // Je met dans mon tableau, mon contact en cours
        array_push($filtered_contacts,$unContact);
    }
}

// On trie le tableau en fonction du premier 
usort($filtered_contacts, function($a, $b) {
    return strtotime($b[3]) - strtotime($a[3]);
});

$jsonContacts = json_encode($filtered_contacts);

// On return le resultat json
header('Content-Type: application/json');
echo $jsonContacts;

?>