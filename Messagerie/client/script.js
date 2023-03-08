// Fichier contenant tous les sous programmes à utiliser
// Enchainement des étapes :
eventNouveauContactBtn();

// Affiche les contacts et définit les évents lors d'un clic sur contact
eventContacts();





// connexion au serveur de websocket
var id = document.getElementsByName("id_client")[0].value;
console.log("l'id est :", id)
var conn = new WebSocket('ws://localhost:8080?id=' + id);

conn.onopen = function () {
  console.log("Connexion ouverte!");
};

conn.onmessage = function (e) {
  //Récupération du JSON
  var data = JSON.parse(e.data);
  //recuperer les données
  var message = data.message
  var id = data.auteur;
  var date = data.heure;
  console.log("id recevoir: ", id,
    "date: ", date,
    "message: ", message)

  //verifier si la conversation est ouverte  
  if (document.getElementsByName(id).length > 0) {
    //Ajouter le message en html sur la page
    ajouterMessageReception(message, date);
  }
  else { console.log("conversation avec: " + id + " pas ouverte") }
};

conn.onclose = function (e) {
  console.log("Connexion fermée!");
}
// Déclare les actions à réaliser lors d'un clic sur le bouton "Nouveau Contact" 
function eventNouveauContactBtn() {
  document.querySelector("#nv-conv").addEventListener('click', (event) => {
    // Affichage de la fenetre modale 
    const modal = document.querySelector("#modal");
    modal.classList.add('visible');

    // Récupération du champ de saisie permettant de trier les joueurs
    const inputJoueur = document.querySelector("#input-pseudo");

    // Requete qui récupère tous les joueurs de la bd (sauf celui connecté)
    var url = "http://localhost/Sport-Track/Messagerie/API/retournerTousLesUsers.php";

    //Requete AJAX 
    var xhr1 = new XMLHttpRequest();
    xhr1.open("GET", url, true);
    xhr1.send();
    xhr1.onload = () => {
      console.log(xhr1.response)
      var tousLesJoueurs = JSON.parse(xhr1.response);
      console.log("joueurs:", tousLesJoueurs);
      afficherJoueursModale(tousLesJoueurs);

      // Evenement correspondant à la saisie dans l'input (effectue un tri et affiche les joueurs correspondant à la saisie)
      inputJoueur.addEventListener("keyup", function () {
        // Récupération de la valeur de l'input
        var valeurSaisie = inputJoueur.value;

        // Filtre en fonction de la saisie
        var joueursFiltres = tousLesJoueurs.filter(function (element) {
          return element[1].toLowerCase().includes(valeurSaisie.toLowerCase());
        });

        afficherJoueursModale(joueursFiltres);
      });
    }

    // Evenement qui ferme la fenetre modale si on clique autour
    modal.addEventListener("click", function (e) {
      // Vérifier si le clic est sur l'élément modal
      if (e.target === modal) {
        // Fermer la fenêtre modale
        modal.classList.remove('visible');
      }
    });
  });
}


// Affiche tous les joueurs dans la liste de la fenêtre modale affichée suite au clic sur "Nouveau Contact"
function afficherJoueursModale(tab) {
  return new Promise((resolve, reject) => {
    // Code pour afficher les contacts
    const boxListeJoueurs = document.querySelector("#tous-les-joueurs");

    var html = "";

    // Affichage de tous les utilisateurs
    if (tab.length === 0) {
      var htmlNoContact = "<p id='no-correspondance'>Aucun utilisateur trouvé.</p>";
      html += htmlNoContact;
    } else {
      for (var i = 0; i < tab.length; i++) {
        var htmlUnContact = "<a class='select-joueur'><div class='unJoueur' name='" + tab[i][0] + "'><div class='info-joueur'><img class='img-profil' src='http://localhost/Sport-Track/Messagerie/images/pp.png' alt=''><p id='pseudo'>" + tab[i][1] + "</p></div><a class='lancer-nv-conv'>Lancer Nv Conv</a></div></a>";
        html += htmlUnContact;
      }
    }
    boxListeJoueurs.innerHTML = html;

    // Evenement lié à la séléction d'un joueur pour new conversation
    const tousLesUsers = document.querySelectorAll(".select-joueur");
    // Evenement qui lance la conversation avec le nouveau contact
    const lesBtns = document.querySelectorAll(".lancer-nv-conv");

    for (var i = 0; i < lesBtns.length; i++) {
      lesBtns[i].addEventListener('click', (event) => {
        // Recuperer l'id de la conv a afficher
        var unJoueur = event.target.closest('.unJoueur');
        var id = parseInt(unJoueur.getAttribute('name'));

        var pseudo = unJoueur.querySelector('#pseudo').innerHTML;
        afficherPartieConversation(pseudo, id);

        // Fermer la fenetre modale
        modal.classList.remove('visible');
      });
    }

    // Promesse faite quand tous les contacts sont affichés
    setTimeout(() => {
      resolve();
    }, 500);
  });
}

// Affiche la partie gauche de l'écran, les contacts en liaison avec l'utilisateur connecté
function afficherContacts() {
  return new Promise((resolve, reject) => {
    // Code pour afficher les contacts
    var html = "";
    // Recupération de la section où on veut afficher tous les contacts associés
    var sectionContacts = document.querySelector("#tous-les-contacts");

    // On efface le contenu de la div avant d'y ajouter la nouvelle conv
    sectionContacts.innerHTML = "";

    // Interrogation de la bd qui va nous retourner les utilisateurs qui ont une interaction avec l'utilisateur connecté
    var url = "http://localhost/Sport-Track/Messagerie/API/retournerUsersAssocies.php";

    // Requete AJAX 
    var xhr2 = new XMLHttpRequest();
    xhr2.open("GET", url, true);
    xhr2.send();
    xhr2.onload = () => {
      // Affichage des contacts 
      var contactsAssocies = JSON.parse(xhr2.response);

      for (var i = 0; i < contactsAssocies.length; i++) {
        var idContact = contactsAssocies[i][0];
        var pseudoContact = contactsAssocies[i][1];
        var message = contactsAssocies[i][2];
        var date = contactsAssocies[i][3];

        var dateToday = new Date().getDate();
        var sqlDay = new Date(date).getDate();

        if (dateToday === sqlDay) {
          date = heureToString(contactsAssocies[i][3]);
        } else {
          date = dateToString(contactsAssocies[i][3]);
        }


        html += "<a class='select-contact'><div class='unContact' name='" + idContact + "'><img src='http://localhost/Sport-Track/Messagerie/images/pp.png' alt=''><div class='infos-contact'><p class='nom-contact'>" + pseudoContact + "</p><p class='last-msg'>" + date + " : " + message + "</p></div></div></a>";

        sectionContacts.innerHTML = html;
      }
    }
    // Promesse faite quand tous les contacts sont affichés
    setTimeout(() => {
      // console.log("Contacts affichés");
      resolve();
    }, 1000);
  });
}

// Déclare les actions à réaliser lors d'un clic sur un contact 
function eventContacts() {
  afficherContacts().then(() => {
    // Récupération de tous les boutons contacts de la page
    const mesContacts = document.querySelectorAll(".select-contact");

    for (var i = 0; i < mesContacts.length; i++) {
      mesContacts[i].addEventListener('click', (event) => {
        var unContact = event.target.closest('.unContact');
        var id = parseInt(unContact.getAttribute('name'));

        // Interrogation de la bd qui va nous retourner les infos de l'utilisateur sélectionné
        var url = "http://localhost/Sport-Track/Messagerie/API/retournerInfoUser.php?id=" + id;

        //Requete AJAX 
        var xhr3 = new XMLHttpRequest();
        xhr3.open("GET", url, true);
        xhr3.send();
        xhr3.onload = () => {
          if (xhr3.status === 200) {
            // On traite le contenu du fichier json obtenu
            var unUser = JSON.parse(xhr3.response);

            afficherPartieConversation(unUser, id)
          }
        }
      });
    }
  });
}

// Affiche la partie droite de l'écran, l'information de la discussion choisie (le nom/prenom), la conversation (vide) ainsi que la barre de saisie
function afficherPartieConversation(json, id) {
  const conversation = document.querySelector('#conversation');

  // On efface le contenu de la div avant d'y ajouter la nouvelle conv
  conversation.innerHTML = "";

  // Ecriture du code html de l'en-tete
  htmlEnTete = "<div id='info-utilisateur'><p id='entete-user'>" + json + "</p></div>";

  // Ecriture de la balise qui accueillera la conversations
  htmlConv = "<div id='tous-les-messages'></div>";

  // Ecriture du code html de la barre de saisie
  htmlSaisie = "<div id='saisie-message'><div id='form' name='" + id + "'><input type='text' placeholder='Envoyer un message ...' name='message' id='msg-input'><a id='msg-envoyer'><img id='msg-envoyer-icon' src='http://localhost/Sport-Track/Messagerie/images/envoyer.png'></a></div></div>";

  // Ecriture du code html de la balise <section id="conversation">
  var html = htmlEnTete + htmlConv + htmlSaisie;

  // Injection du code html dans cette même balise
  conversation.innerHTML = html;

  // Appel de la procédure qui fait l'évènement du bouton envoyer message
  eventEnvoyerMessage();

  // Evenement qui réalise un clic sur le bouton envoyer message quand on fait entrée dans le champ de saisie
  const input = document.getElementById("msg-input");
  const button = document.getElementById("msg-envoyer");

  input.addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
      button.click();
    }
  });

  // Une fois la partie conversation préparée, on affiche les messages entre la personne sélectionnée et la personne connectée
  afficherDiscussion(document.getElementById("tous-les-messages"), id);
}

// Affiche la conversation, c'est à dire affiche les messages dans la partie conversation préparée dans le sous programme précédent "afficherPartieConversation()"
function afficherDiscussion(baliseAffichage, id) {
  var htmlConv = "";
  console.log("affichage des messages ...")
  // Interrogation de la bd qui va nous retourner tous les messages entre l'utilisateur connecté et celui sélectionné
  var url = "http://localhost/Sport-Track/Messagerie/API/retournerConversation.php?id=" + id;

  //Requete AJAX
  var xhr4 = new XMLHttpRequest();
  xhr4.open("GET", url, true);
  xhr4.send();
  xhr4.onload = () => {
    if (xhr4.status === 200) {
      // On traite le contenu du fichier json obtenu
      var messages = JSON.parse(xhr4.response);

      if (messages.length === 0) {
        console.log("aucune message")
        htmlConv += "<p id='pas-de-msg'>Début de la conversation.</p>";
      }
      else {
        console.log("plusieurs messages")
        // Ecriture de la partie messages 
        for (var j = 0; j < messages.length; j++) {
          var date = heureToString(messages[j].date);
          console.log(messages[j])
          console.log("l'id est un", typeof id)
          console.log("l'auteur est un", typeof messages[j].id_auteur)
          switch (id) {
            case parseInt(messages[j].id_auteur):
              console.log("recu")
              htmlConv += "<div class='recu'><p class='msg-contenu'>" + messages[j].message + "</p><p class='msg-date'>" + date + "</p></div>";
              break;
            case parseInt(messages[j].id_destinataire):
              console.log("envoye")
              htmlConv += "<div class='envoye'><p class='msg-contenu'>" + messages[j].message + "</p><p class='msg-date'>" + date + "</p></div>";
              break;
            default:
              break;
          }
        }
      }
      // Injection du code html dans la messagerie
      baliseAffichage.innerHTML = htmlConv
      baliseAffichage.scrollTop = baliseAffichage.scrollHeight;
    }
  }
}

// Déclare l'action à réaliser lors d'un clic sur le bouton "Envoyer" de la barre de saisie
function eventEnvoyerMessage() {
  // Récupération de l'élément bouton par son id
  const msgEnvoyer = document.getElementById('msg-envoyer');

  // On déclare l'évenement quand on clique sur le bouton
  msgEnvoyer.addEventListener('click', (event) => {
    envoyerUnMessage();
  });
}

// Insérer un message dans la BD

function envoyerUnMessage() {
  const msgInput = document.getElementById("msg-input")
  var message = msgInput.value;
  const form = document.querySelector('#form');
  var id_destinataire = parseInt(form.getAttribute('name'));
  console.log("destinataire: ", id_destinataire);
  let date = new Date();
  // Preparation du message à envoyer
  let messageJSON = {
    "message": message,
    "destinataire": id_destinataire,
    "date": date,
  };

  let messageJSONString = JSON.stringify(messageJSON);
  
  // Après récupération du message dans la table, on vide l'input 
  msgInput.value = "";

  if (message === "" && message.length === 0) {
    // Affichage message erreur
    document.getElementById("champ-vide").innerHTML = "Veuillez saisir un message.";
  } else {
    // On retire le message d'erreur 
    document.getElementById("champ-vide").innerHTML = "";
    // envoi du message sur le websocket
    conn.send(messageJSONString);
    console.log("message envoyé au serveur");
    eventContacts();
    ajouterMessageEnvoi(message, date);
  }
};
/* ********** Autres sous programmes ********** */

// Transforme une date sql (2023-02-08 19:21:06) en string pour affichage (19h21)
function heureToString(dateSql) {
  var dateRecup = new Date(dateSql);
  var heures = dateRecup.getHours();
  var minutes = dateRecup.getMinutes();

  if (minutes < 10) {
    var date = heures + "h0" + minutes;
  } else {
    var date = heures + "h" + minutes;
  }
  return date;
}

// Transforme une date sql (2023-02-08 19:21:06) en string pour affichage (08/02/2023)
function dateToString(dateSql) {
  var dateRecup = new Date(dateSql);

  const options = { day: 'numeric', month: 'numeric', year: 'numeric' }; // options de formatage
  const date = dateRecup.toLocaleDateString('fr-FR', options);

  return date;
}

function ajouterMessageEnvoi(message, date) {
  var blocMessages = document.getElementById("tous-les-messages");
  // on creer le nouveau message 
  var nouveauMessage = "<div class='envoye'><p class='msg-contenu'>" + message + "</p><p class='msg-date'>" + heureToString(date) + "</p></div>";
  // on ajoute ce nouveau message 
  blocMessages.innerHTML = nouveauMessage + blocMessages.innerHTML;
}

function ajouterMessageReception(message, date) {
  var blocMessages = document.getElementById("tous-les-messages");
  // on creer le nouveau message 
  var nouveauMessage = "<div class='recu'><p class='msg-contenu'>" + message + "</p><p class='msg-date'>" + heureToString(date) + "</p></div>";
  // on ajoute ce nouveau message 
  blocMessages.innerHTML = nouveauMessage + blocMessages.innerHTML;
}