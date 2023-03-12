    <?php
        // Import du header (commun à toutes les pages)
        require "../Template/header.php";
    ?>
        <link rel="stylesheet" href="./css/aide.css">
    <div class="container">
    <h2>Questions régulièrement posées</h2>
    <div class="accordion">
        <div class="accordion-item">
        <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">Comment puis-je consulter le calendrier des activités de mon club de football amateur ?</span><span class="icon" aria-hidden="true"></span></button>
        <div class="accordion-content">
            <p>Vous pouvez consulter le calendrier des activités de votre club de football amateur sur notre site web, ou en téléchargeant l'application mobile de notre club. Vous y trouverez toutes les informations sur les entraînements, les matchs et les événements à venir.</p>
        </div>
        </div>
        <div class="accordion-item">
        <button id="accordion-button-2" aria-expanded="false"><span class="accordion-title">Comment puis-je être informé des dernières nouvelles et des changements concernant mon club de football amateur ?</span><span class="icon" aria-hidden="true"></span></button>
        <div class="accordion-content">
            <p>Nous vous informons régulièrement par e-mail, SMS ou notification sur l'application mobile de toutes les dernières nouvelles et les changements concernant votre club de football amateur. Nous vous recommandons également de suivre notre page sur les réseaux sociaux pour rester informé.</p>
        </div>
        </div>
        <div class="accordion-item">
        <button id="accordion-button-3" aria-expanded="false"><span class="accordion-title">Comment puis-je signaler une absence ou un retard à un entraînement ou à un match ?</span><span class="icon" aria-hidden="true"></span></button>
        <div class="accordion-content">
            <p>Pour signaler une absence ou un retard à un entraînement ou à un match, veuillez contacter directement votre entraîneur ou le responsable de votre équipe par téléphone ou par e-mail. Il est important de signaler votre absence ou votre retard dès que possible afin que votre équipe puisse s'organiser en conséquence.</p>
        </div>
        </div>
        <div class="accordion-item">
        <button id="accordion-button-4" aria-expanded="false"><span class="accordion-title">Comment puis-je accéder aux statistiques et aux résultats de mon club de football amateur ?</span><span class="icon" aria-hidden="true"></span></button>
        <div class="accordion-content">
            <p>Vous pouvez accéder aux statistiques et aux résultats de votre club de football amateur sur notre site web ou en téléchargeant l'application mobile de notre club. Vous y trouverez toutes les informations sur les matchs passés, les scores, les buteurs et les classements.</p>
        </div>
        </div>
        <div class="accordion-item">
        <button id="accordion-button-5" aria-expanded="false"><span class="accordion-title">Comment puis-je contacter le service clientèle de mon club de football amateur ?</span><span class="icon" aria-hidden="true"></span></button>
        <div class="accordion-content">
            <p>Pour contacter le service clientèle de votre club de football amateur, vous pouvez envoyer un e-mail à l'adresse de contact indiquée sur notre site web ou nous appeler directement par téléphone. Nous sommes disponibles pour répondre à toutes vos questions et préoccupations concernant votre participation au sein de notre club sportif.</p>
        </div>
        </div>
    </div>
    </div>
    <?php
        // Import du header (commun à toutes les pages)
        require "../Template/footer.php";
    ?>
<script>
    const items = document.querySelectorAll(".accordion button");
    function toggleAccordion() {
    const itemToggle = this.getAttribute('aria-expanded');
    for (i = 0; i < items.length; i++) {
    items[i].setAttribute('aria-expanded', 'false');
    }
    if (itemToggle == 'false') {
    this.setAttribute('aria-expanded', 'true');
    }
    }
    items.forEach(item => item.addEventListener('click', toggleAccordion));
</script>
</body>
</html>
