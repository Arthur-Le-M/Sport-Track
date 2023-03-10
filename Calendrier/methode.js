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