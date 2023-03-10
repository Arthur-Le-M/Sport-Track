<?php 
$email = htmlspecialchars($GET_['email']);


$subject = 'Newsletter SportTrack';
$message = '<html><body>';
$message .= '<h1>Felicitation</h1>';
$message .= '<p>Vous etes inscrit à la newsletter de sportTrack <p> <br>
<p> vous pouvez vous désabonner a tout moment en cliquant sur <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"> se désabonner </a> .</p>';
$message .= '</body></html>';

// To send HTML mail, the Content-type header must be set
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';

// Additional headers
$headers[] = 'From: sender@example.com';

// Send the email


if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "L'adresse email est valide.";
    mail($email, $subject, $message, implode("\r\n", $headers));
} 
else {
    echo "L'adresse email n'est pas valide.";
}

?>