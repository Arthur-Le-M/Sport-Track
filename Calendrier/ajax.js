//function to get events from local storage
const eventsArr = [];
var roleImportant=false;
async function getEvents(_id) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", 'data/retrieveEvent.php?id=' + _id);
    xhr.send();
    // Attendre la réponse avant de continuer
    const response = await new Promise((resolve, reject) => {
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && this.status === 200) {
                // Parse la réponse en tant que JSON
                let response = JSON.parse(this.responseText);
                response.forEach((event) => {
                    const datetimeString = event.debut;
                    const [dateString, timeString] = datetimeString.split(" ");
                    const [year, month, day] = dateString.split("-").map(part => parseInt(part));
                    const [dhour, dminute, dsecond] = timeString.split(":").map(part => (part));
                    const datetimeStringFin = event.fin;
                    const [dateStringFin, timeStringFin] = datetimeStringFin.split(" ");
                    const [fhour, fminute, fsecond] = timeStringFin.split(":").map(part => (part));
                    const newEvent = {
                        title: event.type_ + " (" + event.categorie + ")",
                        time: dhour + ":" + dminute + " - " + fhour + ":" + fminute,
                        team: event.nom_equipe,
                        id: event.id,
                        stadium: event.nom_stade
                    };
                    let eventAdded = false;
                    if (eventsArr.length > 0) {
                        eventsArr.forEach((item) => {
                            if (
                                item.day === day &&
                                item.month === month &&
                                item.year === year
                            ) {
                                item.events.push(newEvent);
                                eventAdded = true;
                            }
                        });
                    }
                    if (!eventAdded) {
                        const newDay = {
                            day: day,
                            month: month,
                            year: year,
                            events: [newEvent]
                        };
                        eventsArr.push(newDay);
                    }
                });
                resolve(true);
            }
        }

    });
    return response
}


async function getMatchs(id_) {
    const xhr2 = new XMLHttpRequest();
    xhr2.open("GET", 'data/retrieveMatch.php?id=' + id_);
    xhr2.send();
    // Attendre la réponse avant de continuer
    const response = await new Promise((resolve, reject) => {
        xhr2.onreadystatechange = function () {
            if (xhr2.readyState === XMLHttpRequest.DONE && this.status === 200) {
                // Parse la réponse en tant que JSON
                const response = JSON.parse(this.responseText);
                // Boucle à travers les données
                response.forEach((event) => {
                    const datetimeString = event.heure_debut;
                    const [dateString, timeString] = datetimeString.split(" ");
                    const [year, month, day] = dateString.split("-").map(part => parseInt(part));
                    const [dhour, dminute, dsecond] = timeString.split(":").map(part => (part));
                    const datetimeStringFin = event.heure_fin;
                    const [dateStringFin, timeStringFin] = datetimeStringFin.split(" ");
                    const [fhour, fminute, fsecond] = timeStringFin.split(":").map(part => (part));
                    const newEvent = {
                        id:event.id,
                        title: "Match " + event.equipe_dom + " - " + event.equipe_ext,
                        time: dhour + ":" + dminute + " - " + fhour + ":" + fminute,
                        team: event.nom_equipe,
                        stadium: event.nom_stade
                    };
                    let eventAdded = false;
                    if (eventsArr.length > 0) {
                        eventsArr.forEach((item) => {
                            if (
                                item.day === day &&
                                item.month === month &&
                                item.year === year
                            ) {
                                item.events.push(newEvent);
                                eventAdded = true;
                            }
                        });
                    }
                    if (!eventAdded) {
                        const newDay = {
                            day: day,
                            month: month,
                            year: year,
                            events: [newEvent]
                        };
                        eventsArr.push(newDay);
                    }
                });
                resolve(true);
            }
        };

    });
    return response
}


function addEvent(type_, categorie, debut, fin, id_equipe, id_stade) {
    // créer un objet FormData pour envoyer les données au fichier PHP
    const formData = new FormData();
    formData.append('type_', type_);
    formData.append('categorie', categorie);
    formData.append('debut', debut);
    formData.append('fin', fin);
    formData.append('id_equipe', id_equipe);
    formData.append('id_stade', id_stade);

    // envoyer les données au fichier PHP en utilisant la méthode POST
    const xhr = new XMLHttpRequest();
    xhr.open("POST", 'data/addEvent.php');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert(xhr.responseText); // afficher la réponse du serveur
        }
    };
    xhr.send(formData);
}

function suppEvent(_id) {
    // envoyer les données au fichier PHP en utilisant la méthode POST
    const xhr = new XMLHttpRequest();
    console.log("L'id qui va être supptimé est ",_id)
    xhr.open("GET", 'data/suppEvent.php?id='+ _id);
    xhr.send();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert(xhr.responseText); // afficher la réponse du serveur
        }
    };

}


