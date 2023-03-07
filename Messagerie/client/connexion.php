<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="number" name="id"><br>
        <input type="submit" value="Valider">
    </form>
</body>
</html>

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