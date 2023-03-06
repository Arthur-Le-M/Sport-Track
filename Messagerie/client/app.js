connexionServeur()
{
    var id = document.getElementsByName("id_client")[0].value;
    var conn = new WebSocket('ws://localhost:8080?id=' + id);
}

conn.onopen = function(e) {
    console.log("Connexion ouverte!");
};


conn.onmessage = function(e) {
    //Récupération du JSON
    var data = JSON.parse(e.data);
    //Ajouter le message en html sur la page
};

conn.onclose = function(e) {
    console.log("Connexion fermée!");
};


function envoyerUnMessage() {
    const msgInput = document.getElementById("msg-input")
    var message = msgInput.value;
    const form = document.querySelector('#form');
    var id_destinataire = parseInt(form.getAttribute('name'));
    // Preparation du message à envoyer
    let messageJSON = {
        "message": message,
        "destinataire": id_destinataire,
      };

    // envoi du message au serveur
      conn.send(messageJSON);
      console.log("message envoyé au serveur");

    // Après récupération du message dans la table, on vide l'input 
    msgInput.value = "";
  
    if (message === "" && message.length === 0) {
      // Affichage message erreur
      document.getElementById("champ-vide").innerHTML = "Veuillez saisir un message.";
    } else {
      // On retire le message d'erreur 
      document.getElementById("champ-vide").innerHTML = "";
      // envoi du message sur le websocket
      }
    }
