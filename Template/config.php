<?php

function getConnection() {
    $bdd = new PDO('mysql:host=localhost;dbname=bd_sporttrack','root','');
    return $bdd;
}

// gerer les droits de chaque utilisateur
// créer des comptes avec des droits limités sur la bd
?>