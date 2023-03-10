
var form = document.getElementById("form-newsletter");
form.addEventListener("submit",function(event) {
    console.log("ok");
    var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    var email = document.getElementById("input-email").value;
    console.log(email)
    document.getElementById("input-email").value = "";
    var pubs = document.getElementById("checkbox-pubs").checked;
    var news = document.getElementById("checkbox-news").checked;
    event.preventDefault();
    
    if (!regex.test(email)) 
    {
            var errorMessage = document.createElement("div");
            errorMessage.style.zIndex = "9999";
            errorMessage.innerHTML = "Erreur : Veuillez entrer une adresse email valide";
            errorMessage.style.position = 'fixed';
            errorMessage.style.top = '0';
            errorMessage.style.left = '50%';
            errorMessage.style.fontFamily = "Oswald";
            errorMessage.style.fontSize =  "20px";
            errorMessage.style.transform = 'translateX(-50%)';
            errorMessage.style.backgroundColor = 'white';
            errorMessage.style.color = 'red';
            errorMessage.style.padding = '30px';
            errorMessage.style.borderRadius = '10px';
            errorMessage.style.boxShadow = '10px 10px 10px rgba(0, 0, 0, 0.1)';
            errorMessage.style.opacity = "1";
            errorMessage.style.transition = "opacity 2s linear";
            
            // Ajouter le message d'erreur à la page HTML
            document.body.appendChild(errorMessage);
            // Cacher le message d'erreur après 5 secondes
            setTimeout(function() {
            errorMessage.style.opacity = "0";
            }, 1000);
    }
    else
    {
        // Affiche le code de l'article dans la console
        
        // Crée une URL avec les informations de l'article
        url = "/Sport-Track/Template/php/inscription-newsletter.php?email=" + email + "&news=" + news + "&pubs=" + pubs;
        // Affiche l'URL dans la console
        console.log(url);
        // Crée une nouvelle requête HTTP
        var xhr = new XMLHttpRequest();
        // Ouvre la requête avec la méthode GET, l'URL et l'option de requête asynchrone
        xhr.open('GET', url, true);
        // Définit une fonction à exécuter lorsque la réponse est prête
        xhr.onreadystatechange = function () {
            // Si la requête est terminée et que le statut de réponse est OK
            if (xhr.readyaState === 4 && xhr.status === 200) {
                // Affiche "ok" dans la console
                console.log("ok");
            }
        }
        // Envoie la requête
        xhr.send()

        // afficher le message de succes
        var successMessage = document.createElement("div");
            successMessage.style.zIndex = "9999";
            successMessage.innerHTML = "Félicitation : vous etes inscrit à la newsletter de SportTrack, allez tous ensemble ... 1 .. 2.. 3  .. SPORTRACK !";
            successMessage.style.position = 'fixed';
            successMessage.style.top = '0';
            successMessage.style.left = '50%';
            successMessage.style.fontFamily = "Oswald";
            successMessage.style.fontSize =  "20px";
            successMessage.style.transform = 'translateX(-50%)';
            successMessage.style.backgroundColor = 'white';
            successMessage.style.color = '#F92233';
            successMessage.style.padding = '30px';
            successMessage.style.borderRadius = '10px';
            successMessage.style.boxShadow = '10px 10px 10px rgba(0, 0, 0, 0.1)';
            successMessage.style.opacity = "1";
            successMessage.style.transition = "opacity 2s linear";

            // Ajouter le message d'erreur à la page HTML
            document.body.appendChild(successMessage);

            // Cacher le message d'erreur après 5 secondes
            setTimeout(function() {
            successMessage.style.opacity = "0";
            }, 5000);

            
    }
});
