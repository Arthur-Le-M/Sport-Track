<?php
//On récupère les variables transmis par la méthode POST
$licence = htmlspecialchars($_POST['numLicence']);
$mail = htmlspecialchars($_POST['email']);
$passwd = htmlspecialchars($_POST['passwd']);

//Connexion à la base de donnée
require "../Template/config.php"; // Lien pour la connexion a la BD
$conn = getConnection_Ecriture();

//Vérification des inputs
//Vérification de l'existence de la licence
$req = "SELECT * FROM Joueur WHERE licence=:licence";
$req = $conn->prepare($req);
$req->execute(['licence'=>$licence]);
$res = $req->fetchAll();
if(count($res) == 1){
    //La licence existe bel et bien
    //On vérifie que la licence n'est pas déjà utilisé pour un profil inscrit
    $req = "SELECT * FROM Inscrit WHERE licence=:licence";
    $req = $conn->prepare($req);
    $req->execute(['licence'=>$licence]);
    $res = $req->fetchAll();
    if(count($res) == 0){
        //La licence n'est pas utilisé
        //DANS CETTE VERSION NOUS N'ALLONS PAS VERIFIER LA VALIDITER LE L'EMAIL NI DU MDP
        //Insertion dans la base de donnée -> Inscription
        $req = "INSERT INTO Inscrit(licence, mail, mdp) VALUES(:licence, :mail, :mdp)";
        $req = $conn->prepare($req);
        //Hashage du mot de passe
        $passwd = password_hash($passwd, PASSWORD_DEFAULT);
        //Execution de la requete
        $req->execute(['licence'=>$licence, 'mail'=>$mail, 'mdp'=>$passwd]);
        //Redirection vers connexion
        header("Location: connexion.php");
        exit;
    }else{
        //La licence est utilisé
        //Redirection avec le paramètre erreur
        header("Location: inscription.php?err=licence");
        exit;
    }
}else{
    //La licence n'existe pas
    //Redirection avec le paramètre erreur
    header("Location: inscription.php?err=licence");
    exit;
}


?>