<?php
session_start();

//On récupère les variables transmis par la méthode POST
$mail = htmlspecialchars($_POST['email']);
$passwd = htmlspecialchars($_POST['passwd']);

//Connexion à la base de donnée
require "../Template/config.php"; // Lien pour la connexion a la BD
$conn = getConnection_Lecture();

//On verifie que l'email est valide
$req = "SELECT * FROM Inscrit WHERE mail=:mail";
$req = $conn->prepare($req);
$req->execute(['mail'=>$mail]);
$res = $req->fetchAll();
if(count($res)==1){
    //L'email est valide
    //LES VERIFICATION SONT SUCCINTE CAR C'EST UNE VERSION TEST DU PROJET
    //On vérifie que le mot de passe correspond à l'email
    $req = "SELECT mdp FROM Inscrit WHERE mail=:mail";
    $req = $conn->prepare($req);
    $req->execute(['mail'=>$mail]);
    $res = $req->fetch();
    if(password_verify($passwd, $res['mdp'])){
        //Le mot de passe est bon
        //On ajoute l'id au variables de session // Lien pour la connexion a la BD
        $recupID = $conn->prepare('SELECT id, licence FROM Inscrit WHERE mail=? AND mdp=?');
        $recupID->execute([$mail,$res['mdp']]);
        //array($_SESSION['id'])
        $resultat = $recupID->fetch();
        $id = $resultat['id'];
        $licence = $resultat['licence'];
        //On démarre la session
        $_SESSION['user'] = $mail;
        $_SESSION['id'] = $id;
        $_SESSION['licence'] = $licence;
        header('location: ../Accueil/accueil_connecte.php');
        exit;
    }else{
        //Le mot de passe est faux
        header('location: connexion.php?err=true');
        exit;
    }
}else{
    //L'email n'est pas valide
    header('location: connexion.php?err=true');
    exit;
}

?>