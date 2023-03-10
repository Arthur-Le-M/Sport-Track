//Récupérer l'image
var image = document.querySelector("img");
//Récupérer l'header
var header = document.querySelector("header");

//Quand ma souris va à droite de la page l'image va à gauche et inversement en utilisant le style translate et de façon smooth quand elle est dans l'header
window.addEventListener("mousemove", function(event){
    if(event.clientY < header.offsetHeight){
        image.style.transform = "translate(" + (window.innerWidth/2 - event.clientX)/30 + "px, " + (window.innerHeight/2 - event.clientY)/20 + "px)";
    }
});