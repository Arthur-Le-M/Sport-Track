  <?php 
  require("../Template/header.php"); 
  if(!isset($_SESSION['user'])){
      header('location: ../Inscription_Connexion/connexion.php');
      ob_end_flush();
      exit;
    }
  require "../Template/config.php"; // Lien pour la connexion a la BD
  $conn = getConnection_Ecriture();
  
  if(!isset($_SESSION['poste'])){
    $recupPoste = $conn->prepare('SELECT poste FROM Joueur WHERE licence=?');
    $recupPoste->execute([$_SESSION['licence']]);
    $resultat = $recupPoste->fetch();
    $_SESSION['poste'] = $resultat['poste'];

    $recupClub = $conn->prepare('SELECT id_equipe FROM Joueur WHERE licence=?');
    $recupClub->execute([$_SESSION['licence']]);
    $resultat = $recupClub->fetch();
    $_SESSION['idClub'] = $resultat['id_equipe'];

    $recupStade = $conn->prepare('SELECT id_stade FROM Equipe WHERE id=?');
    $recupStade->execute([$_SESSION['idClub']]);
    $resultat = $recupStade->fetch();
    $_SESSION['idStade'] = $resultat['id_stade'];
  }
  ?>
  <link rel="stylesheet" href="../Template/style.css">
  <link href="style.css" rel="stylesheet">
  <script src="ajax.js" type="text/javascript"></script>
  <script src="main.js" type="text/javascript"></script>
  <div class="container">
    <div class="left">
      <div class="calendar">
        <div class="month">
          <i class="fas fa-angle-left prev"></i>
          <div class="date">december 2015</div>
          <i class="fas fa-angle-right next"></i>
        </div>
        <div class="weekdays">
          <div>Lundi</div>
          <div>Mardi</div>
          <div>Mercredi</div>
          <div>Jeudi</div>
          <div>Vendredi</div>
          <div>Samedi</div>
          <div>Dimanche</div>
        </div>
        <div class="days"></div>
        <div class="goto-today">
          <div class="goto">
            <input type="text" placeholder="mm/yyyy" class="date-input" />
            <button class="goto-btn">Ok</button>
          </div>
          <button class="today-btn">Aujourd'hui</button>
        </div>
      </div>
    </div>
    <div class="right">
      <div class="today-date">
        <div class="event-day">wed</div>
        <div class="event-date">12th december 2022</div>
      </div>
      <div class="events"></div>

      <div class="add-event-wrapper">
        <div class="add-event-header">
          <div class="title">Ajouter évènnement</div>
          <i class="fas fa-times close"></i>
        </div>
        <div class="add-event-body">
          <div class="add-event-input">
            <input type="text" placeholder="Type d'évènement" class="event-name" />
          </div>
          <div class="add-event-input">
            <input type="text" placeholder="Catégorie" class="event-team" />
          </div>
          <div class="add-event-input">
            <input type="text" placeholder="Heure Début" class="event-time-from" />
          </div>
          <div class="add-event-input">
            <input type="text" placeholder="Heure Fin" class="event-time-to" />
          </div>
        </div>
        <div class="add-event-footer">
          <button class="add-event-btn">Ajouter</button>
        </div>

      </div>
    </div>
    <?php
        if($_SESSION['poste']=='DIRIGEANT' || $_SESSION['poste']=='ENTRAINEUR'){
            print '<button class="add-event">';
            print '<i class="fas fa-plus"></i>';
            print ' </button>';
        }
        ?>
  </div>
  <?php
      echo "<script>var idEquipe = '{$_SESSION['idClub']}';
                    var idStade = '{$_SESSION['idStade']}';
            </script>";
      ?>

  <?php
    if ($_SESSION['poste']=='DIRIGEANT' || $_SESSION['poste']=='ENTRAINEUR') {
    echo '<script src="methode.js"></script>';
    echo '<style>
      .events .event:hover {
        background: #e73d16;
      }
      .events .event::after {
        content: "X";
        position: absolute;
        top: 50%;
        left: 0;
        font-size: 3rem;
        line-height: 1;
        display: none;
        align-items: center;
        justify-content: center;
        opacity: 0.3;
        color: var(--primary-clr);
        transform: translateY(-50%);
      }
    </style>';
                  }
                ?>
  <?php require("../Template/footer.php"); ?>
</body>


</html>