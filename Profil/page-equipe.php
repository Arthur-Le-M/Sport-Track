<?php

require "../Template/header.php";
if(!isset($_SESSION['user'])){
    header('location: ../Inscription_Connexion/connexion.php');
    exit;
}
require "../Template/config.php";
$bdd = getConnection();

//Récupérer les informaton de l'équipe le nombre de joueurs, de matchs et de buts
$idEquipe = $_GET['id'];
$req = $bdd->prepare('SELECT e.nom AS equipe, COUNT(DISTINCT j.licence) AS nb_joueurs, COUNT(DISTINCT m.id) AS nb_matchs, COUNT(DISTINCT IF(em.type = "but" AND em.id_equipe = :id, em.id, NULL)) AS nb_buts FROM equipe e LEFT JOIN joueur j ON j.id_equipe = e.id LEFT JOIN matchtable m ON m.id_equipe_dom = e.id OR m.id_equipe_ext = e.id LEFT JOIN evenementmatch em ON m.id = em.id_match WHERE e.id = :id AND m.jouer = 1 GROUP BY e.nom;');
$req->execute(array('id' => $idEquipe));
$equipe = $req->fetch();

//Récupérer les matchs de l'équipe
$req = $bdd->prepare('SELECT m.id, m.heure_debut, e1.nom, e2.nom,SUM(CASE WHEN em.id_equipe = m.id_equipe_dom THEN 1 ELSE 0 END) AS score_dom,SUM(CASE WHEN em.id_equipe = m.id_equipe_ext THEN 1 ELSE 0 END) AS score_ext FROM `matchtable` m JOIN equipe e1 ON m.id_equipe_dom = e1.id JOIN equipe e2 ON m.id_equipe_ext = e2.id LEFT JOIN evenementmatch em ON m.id = em.id_match AND em.type = "but" WHERE m.jouer = 1 AND (m.id_equipe_dom = :id_equipe OR m.id_equipe_ext = :id_equipe) GROUP BY m.id, m.heure_debut, e1.nom, e2.nom ORDER BY m.heure_debut DESC;');
$req->execute(array('id_equipe' => $idEquipe));
$matchs = $req->fetchAll();
?>

<link rel="stylesheet" href="../Template/style.css"/>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="page-equipe.css"/>
<main>
    <?php
    print("<h2>".$equipe[0]."</h2>");
    ?>
    <section id="statContainer">
        <article class="statElement">
            <?php
            print("<p class='statElementVal'>".$equipe[1]."</p>");
            ?>
            <p class="statElementUnité">joueurs</p>
        </article>
        <article class="statElement">
            <?php
            print("<p class='statElementVal'>".$equipe[3]."</p>");
            ?>
            <p class="statElementUnité">buts</p>
        </article>
        <article class="statElement">
            <?php
            print("<p class='statElementVal'>".$equipe[2]."</p>");
            ?>
            <p class="statElementUnité">matchs</p>
        </article>
    </section>
    
    <section class="chart">
        <div>
            <canvas id="myChart3"></canvas>
        </div>
        <script src="chart.js"></script>
        <?php 
            if (isset($idEquipe)) {
                echo '<script>chargerChartEquipe('.$idEquipe.')</script>';
            }
        ?>

    </section>
    <section id="matchsContainer">
        <h3>Matchs</h3>
        <?php
        foreach ($matchs as $match) {
            $numEquipe = 0;
            if($equipe[0] == $match[2]){
                $numEquipe = 0;
            } else {
                $numEquipe = 1;
            }
            print("<a href='page-match.php?id=$match[0]'");
            print("<article class='match'>");
            print("<div class='dateContainer'>");
            print("<p class='date'>".date("d/m/Y", strtotime($match[1]))."</p>");
            print("</div>");
            print("<div class='equipesContainer'>");
            //Si l'équipe est l'équipe gagnante alors elle aura la class equipe-win
            if($match[4] > $match[5]){
                print("<div class='equipe-win'>");
            } else {
                print("<div class='equipe'>");
            }
            print("<p class='equipeNom'>".$match[2]."</p>");
            print("<p class='equipeScore'>".$match[4]."</p>");
            print("</div>");
            if($match[4] < $match[5]){
                print("<div class='equipe-win'>");
            } else {
                print("<div class='equipe'>");
            }
            print("<p class='equipeNom'>".$match[3]."</p>");
            print("<p class='equipeScore'>".$match[5]."</p>");
            print("</div>");
            print("</div>");
            print("<div class='resultatContainer'>");
            if ($match[4] > $match[5] && $numEquipe == 0) {
                print("<p class='resultat-gagnant'>V</p>");
            }elseif($match[4] < $match[5] && $numEquipe == 1){
                print("<p class='resultat-gagnant'>V</p>");
            }else if ($match[4] == $match[5]) {
                print("<p class='resultat-egalite'>E</p>");
            } else {
                print("<p class='resultat-perdant'>D</p>");
            }
            print("</div>");
            print("</article>");
            print("</a>");
        }
        ?>
    </section>
</main>

<?php
require "../Template/footer.php";
?>