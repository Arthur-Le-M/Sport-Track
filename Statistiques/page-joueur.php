<?php
require "../Template/header.php";
?>
<link rel="stylesheet" href="page-joueur.css"/>

<main>
    <div id="containerGauche">
        <section id="sectionPP">
            <img id="pp" src="#" alt="Photo de profil">
            <h5>Prenom</h5>
            <h3>Nom</h3>
            <h4>Club</h4>
            <h5>Poste</h5>
        </section>
        <section id="statPerso">
            <article class="statElement">
                <p class="statElementVal">0</p>
                <p class="statElementUnité">Unité</p>
            </article>
            <article class="statElement">
                <p class="statElementVal">0</p>
                <p class="statElementUnité">Unité</p>
            </article>
            <article class="statElement">
                <p class="statElementVal">0</p>
                <p class="statElementUnité">Unité</p>
            </article>
        </section>
    </div>
    <div id="containerDroite">
        <section id="matchContainer">
            <h5 id="matchContainerTitle">Matchs :</h5>
            <article class="match">
                <div class="dateContainer">
                    <p class="date">Date</p>
                </div>
                <div class="equipesContainer">
                    <div class="equipe">
                        <p class="equipeNom">Equipe 1</p>
                        <p class="equipeScore">0</p>
                    </div>
                    <div class="equipe">
                        <p class="equipeNom">Equipe 1</p>
                        <p class="equipeScore">0</p>
                    </div>
                </div>
                <div class="resultatContainer">
                    <p class="resultat">V</p>
                </div>
            </article>
        </section>
    </div>
</main>

<?php
require "../Template/footer.php";
?>