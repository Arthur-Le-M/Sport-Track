function updateEvents(date) {
  let events = "";
  eventsArr.forEach((event) => {
    if (
      date === event.day &&
      month + 1 === event.month &&
      year === event.year
    ) {
      event.events.forEach((event) => {
        let eventHtml = `<div class="event">
          <div class="title_time_event">
            <div class="title">
              <i class="fas fa-circle"></i>
              <h3 class="event-title">${event.title}</h3>
            </div>
            <div class="event-time">
              <span class="event-time">${event.time}</span>
            </div>
          </div>`;
        if (event.title.startsWith("Match")) {
          eventHtml += `<div class="divBoutonConsulter">
            <button class="boutonConsulter" onClick="window.location.href='http://localhost/Sport-Track/Profil/page-match.php?id=${event.id}'">
              Consulter
            </button>
          </div>`;
        }
        eventHtml += `</div>`;
        events += eventHtml;
      });
    }
  });
  if (events === "") {
    events = `<div class="no-event">
          <h3>No Events</h3>
      </div>`;
  }
  eventsContainer.innerHTML = events;
  saveEvents();
}


//function to save events in local storage
function saveEvents() {
  localStorage.setItem("events", JSON.stringify(eventsArr));
}

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