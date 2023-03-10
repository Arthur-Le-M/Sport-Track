<?php
require "../Template/header.php";
if(!isset($_SESSION['user'])){
    header('location: ../Inscription_Connexion/connexion.php');
    exit;
}
require "../Template/config.php";
$bdd = getConnection();

$idMatch = $_GET['id'];
//Récupérer les informations du match
$req = $bdd->prepare("SELECT m.id, m.jouer, e1.id AS id_equipe_dom, e2.id AS id_equipe_ext, m.heure_debut, e1.nom AS equipe_dom, e2.nom AS equipe_ext, SUM(CASE WHEN em.id_equipe = m.id_equipe_dom AND em.type = 'but' THEN 1 ELSE 0 END) AS score_dom, SUM(CASE WHEN em.id_equipe = m.id_equipe_ext AND em.type = 'but' THEN 1 ELSE 0 END) AS score_ext, s.nom AS stade, m.heure_debut AS heure_debut_match FROM matchtable m JOIN equipe e1 ON m.id_equipe_dom = e1.id JOIN equipe e2 ON m.id_equipe_ext = e2.id LEFT JOIN evenementmatch em ON m.id = em.id_match JOIN stade s ON m.id_stade = s.id WHERE m.id = :id GROUP BY m.id, m.heure_debut, e1.nom, e2.nom, s.nom, m.heure_debut;");
$req->execute(array(
    'id' => $idMatch
));
$match = $req->fetch();


?>
<link rel="stylesheet" href="page-match.css"/>
<link rel="stylesheet" href="../Template/style.css"/>
<main>
    <section id="sectionResultat">
        <div class="equipe">
            <?php
            print("<a href=page-equipe.php?id=".$match['id_equipe_dom']." <h5 class='nomEquipe'>" . $match['equipe_dom'] . "</h5></a>");
            ?>
            <div class="scoreEquipeContainer">
                <?php
                if($match['jouer'] == 0)
                    print("<p class='scoreEquipe'>-</p>");
                else
                    print("<p class='scoreEquipe'>" . $match['score_dom'] . "</p>");
                ?>
            </div>
        </div>
        <div class="versus">
            <p>VS</p>
        </div>
        <div class="equipe">
            <?php
            print("<a href=page-equipe.php?id=".$match['id_equipe_ext']." <h5 class='nomEquipe'>" . $match['equipe_ext'] . "</h5></a>");
            ?>
            <div class="scoreEquipeContainer">
                <?php
                if($match['jouer'] == 0)
                    print("<p class='scoreEquipe'>-</p>");
                else
                    print("<p class='scoreEquipe'>" . $match['score_ext'] . "</p>");
                ?>
            </div>
    </section>
    <section id="sectionInformation">
        <h3>Informations</h3>
        <?php
        print("<h4>Stade : " . $match['stade'] . "</h4>");
        print("<h4>Date : " . date("d/m/Y", strtotime($match['heure_debut_match'])) . "</h4>");
        print("<h4>Horaire : " . date("H:i", strtotime($match['heure_debut_match'])) . "</h4>");
        ?>

    </section>
</main>

<?php
require "../Template/footer.php";
?>