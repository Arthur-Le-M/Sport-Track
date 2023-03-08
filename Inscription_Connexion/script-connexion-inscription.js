//Récupérer les inputs
var inputs = document.querySelectorAll("input");
for(var i = 0; i<inputs.length; i++){
    if(inputs[i].name == "email"){
        emailInput = inputs[i];
    }
    if(inputs[i].name == "passwd"){
        passwordInput = inputs[i];
    }
    if(inputs[i].name == "numLicence"){
        licenceInputs = inputs[i];
    }
}

//Quand le mail est entrain d'être écrit on vérifie qu'il prends la bonne forme
emailInput.addEventListener("input", function(){
    if(emailInput.value.match(/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/)){
        emailInput.className = "inputElementValide";
    }
    else{
        emailInput.className = "inputElementErreur";
    }
    if(emailInput.value.length == 0){
        emailInput.className = "inputElement";
    }
});

//Quand le mot de passe est en train d'être écrit on vérifie qu'il prends la bonne forme au moins 8 caractères dont 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial et on écrit en dessous les conditions en roiuge si ele ne sont pas respectées et en vert si elles le sont sous forme de liste à puce
passwordInput.addEventListener("input", function(){
    //On vérifie que le mot de passe respecte les conditions
    if(passwordInput.value.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,15}$/)){
        passwordInput.className = "inputElementValide";
    }
    else{
        passwordInput.className = "inputElementErreur";
    }
    if(passwordInput.value.length == 0){
        passwordInput.className = "inputElement";
    }
});

console.log(licenceInputs);
//Quand le numéro de licence est en train d'être écrit on vérifie qu'il prends la bonne forme 10 caractère et chiffre
licenceInputs.addEventListener("input", function(){
    if(licenceInputs.value.match(/^[0-9]{10}$/)){
        licenceInputs.className = "inputElementValide";
    }
    else{
        licenceInputs.className = "inputElementErreur";
    }
    if(licenceInputs.value.length == 0){
        licenceInputs.className = "inputElement";
    }
});
