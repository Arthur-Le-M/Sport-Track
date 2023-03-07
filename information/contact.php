<?php require("../Template/header.php"); ?>
<form method="post" action="traitement.php">
    <h2>Nous contacter : </h2>
  <div class="form-group">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>
  </div>
  
  <div class="form-group">
    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" required>
  </div>
  
  <div class="form-group">
    <label for="email">Email :</label>
    <input type="email" id="email" name="email" required>
  </div>
  
  <div class="form-group">
    <label for="message">Message :</label>
    <textarea id="message" name="message" rows="5" required></textarea>
  </div>
  
  <button type="submit">Envoyer</button>
  <?php if (isset($_GET['result'])) : ?>
    <div class="message<?= strpos($_GET['result'], 'Erreur') !== false ? 'error' : 'success'; ?>"><?= $_GET['result']; ?></div>
<?php endif; ?>
</form>
<?php require("../../Template/footer.php"); ?>
</body>
</html>


<style>
    /* Style général du formulaire */
    @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap');

form {
    font-family:'Oswald';
    max-width: 500px;
    margin: 0 auto;
}

form h2{
    text-align: center;
    padding-bottom: 3%;
    padding-top: 2%;
}

/* Style des groupes de champs */

.form-group {
  margin-bottom: 20px;
}

/* Style des labels */

label {
  display: block;
  margin-bottom: 15px;
  font-weight: bold;
}

/* Style des inputs */

input[type="text"],
input[type="email"],
textarea {
  display: block;
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  border: none;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  border:0.1px solid black;
}

/* Style du bouton */

button[type="submit"] {
  display: block;
  width: 100%;
  padding: 10px;
  background-color: #F9B233;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  font-family:'Oswald';
}

button[type="submit"]:hover {
  background-color: #d4d4d4;
  color: #ffffff;
}

.messagesuccess{
  display:flex;
  margin-top:10px;
  width:90px;
  height:40px;
  justify-content:center;
  align-items:center;
  text-align:center;
  background-color:#30b422;
  color:#fff;
}
.messageerror{
  display:flex;
  margin-top:10px;
  width:90px;
  height:40px;
  justify-content:center;
  align-items:center;
  text-align:center;
  background-color:red;
  color:#fff;
}

</style>
