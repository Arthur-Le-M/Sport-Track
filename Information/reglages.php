<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../Template/style.css">
    <link rel="stylesheet" href="./css/reglages.css">
</head>
<body>
	<?php
        // Import du header (commun à toutes les pages)
        require "../Template/header.php";
    ?>
	<div class="div">
	<div class="box1">
		<h2>Cookies</h2>
		<label>
			<input class="apple-switch" type="checkbox">
			Activer les cookies
		</label>
	</div>

	<div class="box2">
		<h2>Changer le mot de passe</h2>
		<form>
			<label>
				Mot de passe actuel :
				<input class="inp" type="password" id="current-password">
			</label>
			<label>
				Nouveau mot de passe :
				<input class="inp" type="password" id="new-password">
			</label>
			<label>
				Confirmer le nouveau mot de passe :
				<input class="inp" type="password" id="confirm-password">
			</label>
			<input type="submit" value="Enregistrer les modifications">
		</form>
	</div>
</div>
	<script>
		// Supprime tous les cookies du site
		document.getElementById('delete-cookies').addEventListener('click', function() {
			var cookies = document.cookie.split(';');
			for (var i = 0; i < cookies.length; i++) {
				var cookie = cookies[i];
				var eqPos = cookie.indexOf('=');
				var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
				document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:00 GMT';
			}
			alert('Les cookies ont été supprimés.');
		});

		// Vérifie que les mots de passe correspondent avant de soumettre le formulaire
		document.querySelector('form').addEventListener('submit', function(event) {
			var currentPassword = document.getElementById('current-password').value;
			var newPassword = document.getElementById('new-password').value;
			var confirmPassword = document.getElementById('confirm-password').value;
			if (newPassword !== confirmPassword) {
				alert('Les nouveaux mots de passe ne correspondent pas.');
				event.preventDefault();
			} else if (currentPassword === newPassword) {
				alert('Le nouveau mot de passe doit être différent de l\'ancien.');
				event.preventDefault();
			}
		});
	</script>
	<?php
        // Import du header (commun à toutes les pages)
        require "../Template/footer.php";
    ?>
</body>
</html>


