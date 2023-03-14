<?php
function getConnection_Ecriture() {
    $bdd = new PDO('mysql:host=172.17.0.2:3306;dbname=bd_sporttrack','ecriture','ecriture');
    return $bdd;
}

function getConnection_Lecture() {
    $bdd = new PDO('mysql:host=172.17.0.2:3306;dbname=bd_sporttrack','lecture','lecture');
    return $bdd;
}
?>