<?php

function getConnection() {
    $bdd = new PDO('mysql:host=localhost;dbname=messagerie;charset=utf8;','root','');
    return $bdd;
}

// gerer les droits de chaque utilisateur
// créer des comptes avec des droits limités sur la bd
?>