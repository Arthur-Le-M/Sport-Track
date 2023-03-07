<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Récupérer les données du formulaire
  $nom = $_POST["nom"];
  $prenom = $_POST["prenom"];
  $email = $_POST["email"];
  $message = $_POST["message"];
  
  // Construire le corps de l'e-mail
  $subject = "Nouveau message de " . $nom . " " . $prenom;
  $body = "De: " . $nom . " " . $prenom . " (" . $email . ")\n\n";
  $body .= "Message:\n" . $message;
  
  // Liste des destinataires
  $to = "isalle@iutbayonne.univ-pau.fr, tcocheril001@iutbayonne.univ-pau.fr, chabanat.matis@etud.univ-pau.fr, almenn@iutbayonne.univ-pau.fr";
  
  // En-têtes de l'e-mail
  $headers = "From: " . $email . "\r\n";
  $headers .= "Reply-To: " . $email . "\r\n";
  
  // Envoyer l'e-mail
  try {
    if (mail($to, $subject, $body, $headers)) {
        $result = "Valide";
    } else {
        throw new Exception("Erreur");
    }
} catch (Exception $e) {
    $result = "Erreur";
}
  header('Location: contact.php?result='.$result);
  exit;
}
?>