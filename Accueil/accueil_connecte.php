<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="accueil_connecte.css" >
    <title>Document</title>
</head>
<body>
<?php
    // Import du header (commun à toutes les pages)
    require "../Template/header.php";
    if(!isset($_SESSION['user'])){
        header('location: ../Inscription_Connexion/connexion.php');
        exit;
    }
    $id = $_SESSION['id'];

    require "../Template/config.php"; // Lien pour la connexion a la BD
    $bdd = getConnection();
    $recupPrenom = $bdd->prepare('SELECT prenom FROM joueur JOIN inscrit ON inscrit.licence=joueur.licence WHERE id=?');
    $recupPrenom->execute([$id]); // Vous devez passer le paramètre dans un tableau
    $resultat = $recupPrenom->fetch();
    $prenom = $resultat['prenom'];
    ?>
<h1>Bienvenue <span style="color: #F9B233;"> <?php echo ucfirst(strtolower($prenom));?> </span> <img src="emoji.png" alt="icone" width="2.5%"></h1>
<div id ="conteneur" >
    <div id="boite1" class="boite" >
        <a href="../Messagerie/messagerie.php"><img src="../Template/img/MessageImage2.png" alt="description-de-l-image"></a>
        <h3>Messagerie</h3>
    </div>
    <div id="boite2" class="boite" >
        <a href="../Calendrier/index.php"><img src="../Template/img/CalendrierImage2.png" alt="description-de-l-image"></a>
        <h3>Calendrier</h3>
    </div>
    <div id="boite3" class="boite">
        <a href="../Profil/page-joueur.php"><img src="../Template/img/StatisticImage2.png"  alt="description-de-l-image"></a>
        <h3>Profil</h3>
    </div>
</div>
    <div class="container">
		<article>
			<h2>Le Meilleur Joueur du Mois</h2>
			<p>Après une série de performances exceptionnelles, le joueur de football Antoine Dupont a été nommé le meilleur joueur du mois de février. Avec six buts en cinq matchs, il a été le principal artisan des victoires de son équipe.</p>
			<div class="img-container">
				<img src="https://via.placeholder.com/800x400.png?text=Antoine+Dupont" alt="Antoine Dupont">
			</div>
			<p>Interrogé après la remise de son prix, Alex Dupont s'est montré humble et a tenu à féliciter ses coéquipiers pour leur travail acharné. "Je ne peux pas y arriver tout seul", a-t-il déclaré. "C'est un effort d'équipe, et nous sommes tous très heureux des résultats que nous avons obtenus."</p>
			<div class="date">Publié le 12 mars 2023</div>
			<div class="author">Par Matis Chabana</div>
		</article>
	</div>
<?php
    // Import du footer (commun à toutes les pages)
    require "../Template/footer.php";
    ?>
</body>
</html>