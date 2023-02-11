// Appel du sous programme pour refresh la conv
setInterval(refreshConversation, 1000);

setInterval(definirBoutonContact(),5000);

/* * * Affichage de tous les contacts qui ont deja envoyé un message à l'utilisateur connecté ****************************** */
function afficherContacts() {
  return new Promise((resolve, reject) => {
    // Code pour afficher les contacts
    var html = "";
    // Recupération de la section où on veut afficher tous les contacts associés
    var sectionContacts = document.querySelector("#tous-les-contacts");

    // On efface le contenu de la div avant d'y ajouter la nouvelle conv
    removeChildren(sectionContacts);

    // Interrogation de la bd qui va nous retourner les utilisateurs qui ont une interaction avec l'utilisateur connecté
    var url = "API/retournerUsersAssocies.php";

    // Requete AJAX 
    var xhr4 = new XMLHttpRequest();
    xhr4.open("GET", url, true);
    xhr4.send();
    xhr4.onload = () => {
      // Affichage des contacts 
      var contactsAssocies = JSON.parse(xhr4.response);

      for (var i = 0; i < contactsAssocies.length; i++) {
        var idContact = contactsAssocies[i][0];
        var pseudoContact = contactsAssocies[i][1];
        var message = contactsAssocies[i][2];
        var date = dateToString(contactsAssocies[i][3]);

        html += "<a class='select-contact'><div class='unContact' name='" + idContact + "'><img src='images/pp.png' alt=''><div class='infos-contact'><p class='nom-contact'>" + pseudoContact + "</p><p class='last-msg'>" + date + " : " + message + "</p></div></div></a>";

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

/* * * Affichage de tous les contacts qui ont deja envoyé un message à l'utilisateur connecté puis définission de l'event ****************************** */
function definirBoutonContact() {
  // Affichage des contacts ayant eu au moins une interaction avec l'utilisateur connecté
  afficherContacts().then(() => {
    // console.log("Suite du programme definirBoutonContact");
    // Evenement clic sur un contact
    // Récupération de tous les boutons contacts de la page
    var mesContacts = document.querySelectorAll(".select-contact");

    for (var i = 0; i < mesContacts.length; i++) {
      mesContacts[i].addEventListener('click', (event) => {
        var unContact = event.target.closest('.unContact');
        var id = parseInt(unContact.getAttribute('name'));

        var conversation = document.querySelector('#conversation');
        var html, htmlEnTete, htmlConv, htmlSaisie = "";

        // On efface le contenu de la div avant d'y ajouter la nouvelle conv
        removeChildren(conversation);

        // 1. Afficher l'en-tete d'un utilisateur
        var url = "API/retournerInfoUser.php?id=" + id;

        //Requete AJAX 
        var xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);
        xhr.send();
        xhr.onload = () => {
          if (xhr.status === 200) {
            // On traite le contenu du fichier json obtenu
            var unUser = JSON.parse(xhr.response);

            preparerPageConversation(unUser, id)
          }
        }
      });
    }
  });
}

function preparerPageConversation(json, id) {
  var conversation = document.querySelector('#conversation');

  // Ecriture du code html de l'en-tete
  htmlEnTete = "<div id='info-utilisateur'><p id='entete-user'>" + json + "</p></div>";

  // Ecriture de la balise qui accueillera la conversations
  htmlConv = "<div id='tous-les-messages'></div>";

  // Ecriture du code html de la barre de saisie
  htmlSaisie = "<div id='saisie-message'><div id='form' name='" + id + "'><input type='text' placeholder='Envoyer un message ...' name='message' id='msg-input'><a id='msg-envoyer'><img id='msg-envoyer-icon' src='images/envoyer.png'></a></div></div>";

  // Ecriture du code html de la balise <section id="conversation">
  html = htmlEnTete + htmlConv + htmlSaisie;

  // Injection du code html dans la balise <section id="conversation">
  conversation.innerHTML = html;

  // Affichage de la conversation
  afficherConversation(document.getElementById("tous-les-messages"), id);

  // Appel de la procédure qui fait l'évènement du bouton envoyer message
  definirBoutonEnvoyer();

  // Evenement qui réalise un clic sur le bouton envoyer message quand on fait entrée dans le champ de saisie
  const input = document.getElementById("msg-input");
  const button = document.getElementById("msg-envoyer");

  input.addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
      button.click();
    }
  });
}

/* * * Evenement clic sur le bouton envoyer ****************************** */
function definirBoutonEnvoyer() {
  // Récupération de l'élément bouton par son id
  var msgEnvoyer = document.getElementById('msg-envoyer');

  // On déclare l'évenement quand on clique sur le bouton
  msgEnvoyer.addEventListener('click', (event) => {
    envoyerUnMessage();
  });
}

/* * * Evenement clic sur bouton nouvelle conversation ****************************** */
var newConv = document.querySelector("#nv-conv");

newConv.addEventListener('click', (event) => {
  // Affichage de la fenetre modale 
  const modal = document.querySelector("#modal");
  modal.classList.add('visible');

  const inputJoueur = document.querySelector("#input-pseudo");
  const AllUsersContainer = document.querySelector("#tous-les-joueurs");

  // Requete qui récupère tous les joueurs de la bd
  var url = "API/retournerTousLesUsers.php";

  //Requete AJAX 5
  var xhr5 = new XMLHttpRequest();
  xhr5.open("GET", url, true);
  xhr5.send();
  xhr5.onload = () => {
    var users = JSON.parse(xhr5.response);

    // Evenement correspondant à la saisie dans l'input 
    inputJoueur.addEventListener("keyup", function () {
      // Récupération de la valeur de l'input
      var saisie = inputJoueur.value;

      // Filtre en fonction de la saisie
      var filteredUsers = users.filter(function (element) {
        return element[1].toLowerCase().includes(saisie.toLowerCase());
      });

      afficherJoueurs(filteredUsers);
    });

    afficherJoueurs(users);
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

/* * * Sous programme qui affiche les joueurs dans la fenetre modale ****************************** */
function afficherJoueurs(tab) {
  return new Promise((resolve, reject) => {
    // Code pour afficher les contacts
    const AllUsersContainer = document.querySelector("#tous-les-joueurs");

    var html = "";

    // Affichage de tous les utilisateurs
    if (tab.length === 0) {
      var htmlNoContact = "<p id='no-correspondance'>Aucun utilisateur trouvé.</p>";
      html += htmlNoContact;
    } else {
      for (var i = 0; i < tab.length; i++) {
        var htmlUnContact = "<a class='select-joueur'><div class='unJoueur' name='" + tab[i][0] + "'><div class='info-joueur'><img class='img-profil' src='images/pp.png' alt=''><p id='pseudo'>" + tab[i][1] + "</p></div><a class='lancer-nv-conv'>Lancer Nv Conv</a></div></a>";
        html += htmlUnContact;
      }
    }
    AllUsersContainer.innerHTML = html;

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
        preparerPageConversation(pseudo, id);

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


/* * * Sous programme qui retire tous les éléments d'une div ****************************** */
function removeChildren(element) {
  while (element.firstChild) {
    element.removeChild(element.firstChild);
  }
}

/* * * Sous programme qui affiche une conversation entre 2 personnes à l'endroit baliseAffichage ****************************** */
function afficherConversation(baliseAffichage, id) {
  var url = "API/retournerConversation.php?id=" + id;
  var htmlConv = "";

  //Requete AJAX 2
  var xhr2 = new XMLHttpRequest();
  xhr2.open("GET", url, true);
  xhr2.send();
  xhr2.onload = () => {
    if (xhr2.status === 200) {
      // On traite le contenu du fichier json obtenu
      var messages = JSON.parse(xhr2.response);

      if (messages.length === 0) {
        htmlConv += "<p id='pas-de-msg'>Début de la conversation.</p>";
      } else {
        // Ecriture de la partie messages 
        for (var j = 0; j < messages.length; j++) {
          var date = dateToString(messages[j].date);

          switch (id) {
            case messages[j].id_auteur:
              htmlConv += "<div class='recu'><p class='msg-contenu'>" + messages[j].message + "</p><p class='msg-date'>" + date + "</p></div>";
              break;
            case messages[j].id_destinataire:
              htmlConv += "<div class='envoye'><p class='msg-contenu'>" + messages[j].message + "</p><p class='msg-date'>" + date + "</p></div>";
              break;
            default:
              break;
          }
        }
      }
      // Injection du code html dans la messagerie
      baliseAffichage.innerHTML = htmlConv;
    }
  }
}

/* * * Sous programme qui refresh la conv toutes les secondes ****************************** */
function refreshConversation() {
  // On verifie si l'utilisateur a cliqué sur un contact en regardant si une conversation a été affichée
  if (document.getElementById("tous-les-messages")) {
    // Recup de l'id de la conv affichée 
    var form = document.querySelector('#form');
    var id = parseInt(form.getAttribute('name'));

    afficherConversation(document.getElementById("tous-les-messages"), id);
  }
}

/* * * Sous programme qui transforme une date sql (2023-02-08 19:21:06) en string pour affichage (19h21) ****************************** */
function dateToString(dateSql) {
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

/* * * Sous programme qui envoie un message ****************************** */
function envoyerUnMessage() {
  var msgInput = document.getElementById("msg-input")
  var message = msgInput.value;
  var form = document.querySelector('#form');
  var id = parseInt(form.getAttribute('name'));

  // Après récupération du message dans la table, on vide l'input 
  msgInput.value = "";

  if (message === "" && message.length === 0) {
    // Affichage message erreur
    document.getElementById("champ-vide").innerHTML = "Vous ne pouvez pas envoyer de message vide.";
  } else {
    // On retire le message d'erreur 
    document.getElementById("champ-vide").innerHTML = "";

    var url = "API/insertMsg.php?id=" + id + "&message=" + message;

    //Requete AJAX 
    var xhr3 = new XMLHttpRequest();
    xhr3.open("GET", url, true);
    xhr3.send();
    xhr3.onload = () => {
      if (xhr3.status === 200) {
        // Affichage du message qui vient d'être saisi (refresh de la conv)
        refreshConversation();
        afficherContacts();
      }
    }
  }
}