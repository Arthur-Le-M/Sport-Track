// Récupérer tous les liens dans la liste
const links = document.querySelectorAll('ul li a');

// Parcourir tous les liens
for (const link of links) {
    // Ajouter un écouteur d'événements pour le clic sur chaque lien
    link.addEventListener('click', (event) => {
        // Empêcher le comportement par défaut du lien, qui est de naviguer vers une autre page
        event.preventDefault();
        
        // Récupérer l'élément avec l'ID qui correspond à l'ancre du lien
        const target = document.querySelector(link.getAttribute('href'));

        // Faire défiler la page jusqu'à l'élément cible
        target.scrollIntoView({ behavior: 'smooth' });
    });
}