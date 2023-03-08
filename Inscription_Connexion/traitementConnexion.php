<?php
session_start();

//On récupère les variables transmis par la méthode POST
$mail = htmlspecialchars($_POST['email']);
$passwd = htmlspecialchars($_POST['passwd']);

//Connexion à la base de donnée
require "../Template/config.php"; // Lien pour la connexion a la BD
$conn = getConnection();

//On verifie que l'email est valide
$req = "SELECT * FROM inscrit WHERE mail=:mail";
$req = $conn->prepare($req);
$req->execute(['mail'=>$mail]);
$res = $req->fetchAll();
if(count($res)==1){
    //L'email est valide
    //LES VERIFICATION SONT SUCCINTE CAR C'EST UNE VERSION TEST DU PROJET
    //On vérifie que le mot de passe correspond à l'email
    $req = "SELECT mdp FROM inscrit WHERE mail=:mail";
    $req = $conn->prepare($req);
    $req->execute(['mail'=>$mail]);
    $res = $req->fetch();
    if(password_verify($passwd, $res['mdp'])){
        //Le mot de passe est bon
        //On démarre la session
        $_SESSION['user'] = $mail;
        header('location: accueil.php');
        exit;
    }else{
        //Le mot de passe est faux
        header('location: connexion.php?err=passwd');
        exit;
    }
}else{
    //L'email n'est pas valide
    header('location: connexion.php?err=mail');
    exit;
}

?>