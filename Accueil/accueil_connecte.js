// Sélectionner le conteneur des balles
const balleContainer = document.getElementById('balle-container');

// Tableau contenant les chemins d'accès des images de balle
const imagesBalles = ['tennis.png', 'foot.png', 'rugby.png', 'basketball.png'];

// Fonction pour créer une nouvelle balle
function createBalle() {
  // Créer un nouvel élément image pour la balle
  const balle = document.createElement('img');

  // Définir les attributs de la balle
  const imageBalleAleatoire = imagesBalles[Math.floor(Math.random() * imagesBalles.length)];
  balle.src = imageBalleAleatoire;
  const tailleAleatoire = Math.floor(Math.random() * 50) + 40;
  balle.style.width = tailleAleatoire + 'px';
  balle.style.height = tailleAleatoire + 'px';
  balle.style.position = 'absolute';
  
  balle.style.left = Math.floor(Math.random() * window.innerWidth) + 'px';
  balle.style.top = Math.floor(Math.random() * window.innerHeight) + 'px';
  // Ajouter la balle en tant qu'enfant du conteneur de balles
  balle.classList.add('fade-in');
  balleContainer.appendChild(balle);
 // Définir l'opacité initiale à 0


  // Supprimer la balle la plus ancienne s'il y en a plus de 3
  const balles = balleContainer.querySelectorAll('img');
  if (balles.length > 5) {
    balles[0].classList.add('fade-out');
    setTimeout(function() {
        balleContainer.removeChild(balles[0]);
      }, 500);
    
  }
}

// Appeler la fonction createBalle toutes les secondes
setInterval(createBalle, 1000);
