
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Inscription</title>
  <style>
    body {
      background-color: #f0e68c;
    }
    form {
      border: 1px solid black;
      padding: 20px;
      width: 300px;
      margin: auto;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 0 10px #000;
    }
    label {
      display: block;
      margin-bottom: 10px;
    }
    input[type="submit"] {
      background-color: #f0e68c;
      border: 2px solid black;
      color: black;
      padding: 5px 20px;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: black;
      color: white;
    }
  </style>
</head>
<body>
  <form action="inscription.php" method="post">
    <label for="email">Email :</label>
    <input type="email" name="email" required>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" required>

    <label for="licence">Licence :</label>
    <input type="text" name="licence" required>

    <label for="accept_conditions">J'accepte les conditions générales d'utilisation :</label>
    <input type="checkbox" name="accept_conditions" required>

    <input type="submit" value="S'inscrire">



<?php

session_start();

if(isset($_POST['id'])) {
    if(!empty($_POST['id'])) {
        $id = $_POST['id'];

        $_SESSION['id'] = $id;

        header('Location: messagerie.php');
    } else {
        echo "rentrez un id";
    }
}



?>