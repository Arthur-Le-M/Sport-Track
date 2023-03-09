<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../Template/style.css">
  <link href="style.css" rel="stylesheet">
</head>
<?php
session_start();
if(!isset($_SESSION['role'])){
    $_SESSION['role']='coach';
    $_SESSION['idClub']='12427';
    $_SESSION['idStade']='1720';
}

?>

<body>
  <?php require("../Template/header.php"); ?>
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
        if($_SESSION['role']=='coach'){
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

  <script src="ajax.js" type="text/javascript"></script>
  <script src="main.js" type="text/javascript"></script>
  <?php
    if ($_SESSION['role'] === 'coach') {
    echo '<script>
    var eventsContainer = document.querySelector(".events");
    eventsContainer.addEventListener("click", (e) => {
      if (e.target.classList.contains("event")) {
        if (confirm("Êtes-vous sur de vouloir supprimer cette évènement ?")) {
          const eventTitle = e.target.children[0].children[1].innerHTML;
          eventsArr.forEach((event) => {
            if (
              event.day === activeDay &&
              event.month === month + 1 &&
              event.year === year
            ) {
              event.events.forEach((item, index) => {
                if (item.title === eventTitle) {
                  event.events.splice(index, 1);
                }
              });
              //if no events left in a day then remove that day from eventsArr
              if (event.events.length === 0) {
                eventsArr.splice(eventsArr.indexOf(event), 1);
                //remove event class from day
                const activeDayEl = document.querySelector(".day.active");
                if (activeDayEl.classList.contains("event")) {
                  activeDayEl.classList.remove("event");
                }
              }
            }
          });
          updateEvents(activeDay);
        }
      }
    });
    </script>';
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