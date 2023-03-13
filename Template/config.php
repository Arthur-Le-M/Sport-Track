<?php

function getConnection_Ecriture() {
    $bdd = new PDO('mysql:host=localhost:3306;dbname=bd_sporttrack','ecriture','ecriture');
    return $bdd;
}

function getConnection_Lecture() {
    $bdd = new PDO('mysql:host=localhost:3306;dbname=bd_sporttrack','lecture','lecture');
    return $bdd;
}

// gerer les droits de chaque utilisateur
// créer des comptes avec des droits limités sur la bd
?>