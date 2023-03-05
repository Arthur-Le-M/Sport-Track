var id=1000;
let currentDate = new Date();
var conn = new WebSocket('ws://localhost:8080?'+ id);

conn.onopen = function(e) {
    console.log("Connection ouvert!");
    let messageJSON = {
        message: "hello2",
        destinataire: 24,
        heure: currentDate,
        envoyeur:1000
    };
    conn.send(JSON.stringify(messageJSON));
};


conn.onmessage = function(e) {
    //Récupération du JSON
    var data = JSON.parse(e.data);
    //Ajouter le message en html sur la page
};

conn.onclose = function(e) {
    console.log("Connection fermé!");
}

