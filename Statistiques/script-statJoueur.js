//Définir si l'équipe du joueur à gagner ou perdu
function statJoueurGagnePerdu(){
    //Récupérer l'équipe du joueur
    var equipeJoueur = document.querySelector("#sectionPP h4").innerHTML;
    //Récupérer les matchs
    var matchs = document.querySelectorAll(".match");
    for(var i = 0; i < matchs.length; i++){
        var indicateurVictoire = matchs[i].querySelector(".resultat-gagnant");
        var equipes = matchs[i].querySelectorAll(".equipe");
        var equipe1 = equipes[0];
        var equipe2 = equipes[1];
        var scoreEquipe1 = equipe1.querySelector(".equipeScore").innerHTML;
        var scoreEquipe2 = equipe2.querySelector(".equipeScore").innerHTML;
        if(scoreEquipe1 < scoreEquipe2){
            equipe2.className = "equipe-win";
            indicateurVictoire.className = "resultat-perdant";
            indicateurVictoire.innerHTML = "D";
        }
        else if(scoreEquipe1 > scoreEquipe2){
            equipe1.className = "equipe-win";
            indicateurVictoire.className = "resultat-gagnant";
            indicateurVictoire.innerHTML = "V";

        }
        else{
            equipe1.className = "equipe";
            equipe2.className = "equipe";
            indicateurVictoire.className = "resultat-egalite";
            indicateurVictoire.innerHTML = "N";
        }
    }
}

statJoueurGagnePerdu();