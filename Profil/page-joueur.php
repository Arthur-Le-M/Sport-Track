<?php
require "../Template/header.php";
if(!isset($_SESSION['user'])){
    header('location: ../Inscription_Connexion/connexion.php');
    ob_end_flush();
    exit;
}
require "../Template/config.php";
$bdd = getConnection_Lecture();
$licence = $_SESSION['licence'];

//Récupérer les informaton du joueur
$req = $bdd->prepare('SELECT j.nom, j.prenom, j.id_equipe, j.poste, e.nom, COUNT(*) FROM joueur j JOIN equipe e ON j.id_equipe = e.id JOIN matchtable m ON j.id_equipe = id_equipe_dom OR id_equipe = id_equipe_ext WHERE licence=:licence AND m.jouer = 1 GROUP BY j.nom, j.prenom, j.id_equipe, j.poste, e.nom;');
$req->execute(array('licence' => $licence));
$joueur = $req->fetch();

//Récupérer le nombre de but du joueur
$req = $bdd->prepare('SELECT COUNT(*) FROM EvenementMatch WHERE licence_joueur=:licence AND type="BUT";');
$req->execute(array('licence' => $licence));
$but = $req->fetch();

//Récupérer les matchs du joueur
$req = $bdd->prepare('SELECT m.id, m.heure_debut, e1.nom, e2.nom,SUM(CASE WHEN em.id_equipe = m.id_equipe_dom THEN 1 ELSE 0 END) AS score_dom,SUM(CASE WHEN em.id_equipe = m.id_equipe_ext THEN 1 ELSE 0 END) AS score_ext FROM `matchtable` m JOIN equipe e1 ON m.id_equipe_dom = e1.id JOIN equipe e2 ON m.id_equipe_ext = e2.id LEFT JOIN evenementmatch em ON m.id = em.id_match AND em.type = "but" WHERE m.jouer = 1 AND (m.id_equipe_dom = :id_equipe OR m.id_equipe_ext = :id_equipe) GROUP BY m.id, m.heure_debut, e1.nom, e2.nom ORDER BY m.heure_debut DESC;');
$req->execute(array('id_equipe' => $joueur[2]));
$matchs = $req->fetchAll();

?>
<link rel="stylesheet" href="page-joueur.css"/>
<link rel="stylesheet" href="../Template/style.css"/>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<main>
    <div id="containerGauche">
        <section id="sectionPP">
            <img id="pp" src="images/pp.jpg" alt="Photo de profil">
            <?php
            print("<h5>".$joueur[0]."</h5>");
            print("<h3>".$joueur[1]."</h3>");
            print("<a id='lienEquipe' href='page-equipe.php?id=$joueur[2]'><h4>".$joueur[4]."</h4></a>");
            print("<h5>".$joueur[3]."</h5>");
            ?>
        </section>
        <section id="statPerso">
            <article class="statElement">
                <p class="statElementVal">20</p>
                <p class="statElementUnité">ans</p>
            </article>
            <article class="statElement">
                <?php
                print("<p class='statElementVal'>".$but[0]."</p>");
                ?>
                <p class="statElementUnité">buts</p>
            </article>
            <article class="statElement">
                <?php
                print("<p class='statElementVal'>".$joueur[5]."</p>");
                ?>
                <p class="statElementUnité">matchs</p>
            </article>
        </section>
    </div>
    <div id="containerDroite">
        <section id="matchContainer">
            <h5 id="matchContainerTitle">Matchs :</h5>
            <?php
            foreach ($matchs as $match) {
                print("<a href='page-match.php?id=".$match[0]."'>");
                print("<article class='match'>");
                print("<div class='dateContainer'>");
                //transformer le fomat de la date en date simple dd/mm/yyyy
                $match[1] = date("d/m/Y", strtotime($match[1]));
                print("<p class='date'>".$match[1]."</p>");
                print("</div>");
                print("<div class='equipesContainer'>");
                if($match[4] > $match[5]) {
                    print("<div class='equipe-win'>");
                } else {
                    print("<div class='equipe'>");
                }
                print("<p class='equipeNom'>".$match[2]."</p>");
                print("<p class='equipeScore'>".$match[4]."</p>");
                print("</div>");
                if($match[4] < $match[5]) {
                    print("<div class='equipe-win'>");
                } else {
                    print("<div class='equipe'>");
                }
                print("<p class='equipeNom'>".$match[3]."</p>");
                print("<p class='equipeScore'>".$match[5]."</p>");
                print("</div>");
                print("</div>");
                print("<div class='resultatContainer'>");
                if ($match[4] > $match[5]) {
                    print("<p class='resultat-gagnant'>V</p>");
                } else if ($match[4] < $match[5]) {
                    print("<p class='resultat-perdant'>D</p>");
                } else {
                    print("<p class='resultat-egalite'>N</p>");
                }
                print("</div>");
                print("</article>");
                print("</a>");
            }
            ?>
            <!-- Template d'un match
            <article class="match">
                <div class="dateContainer">
                    <p class="date">06/03/2023</p>
                </div>
                <div class="equipesContainer">
                    <div class="equipe-win">
                        <p class="equipeNom">Equipe 1</p>
                        <p class="equipeScore">2</p>
                    </div>
                    <div class="equipe">
                        <p class="equipeNom">Equipe 2</p>
                        <p class="equipeScore">0</p>
                    </div>
                </div>
                <div class="resultatContainer">
                    <p class="resultat-gagnant">V</p>
                </div>
            </article>
            -->
        </section>

        <div>
            <canvas id="myChart"></canvas>
        </div>
        <script src="chart.js"></script>
        <?php 
            if (isset($licence)) {
                echo "<script>chargerChartJoueur('{$licence}');</script>";
            }
        ?>
    </div>
</main>

<?php
require "../Template/footer.php";
?>