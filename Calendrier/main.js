window.addEventListener('load', async () => {


  const calendar = document.querySelector(".calendar"),
    date = document.querySelector(".date"),
    eventsContainer = document.querySelector(".events"),
    daysContainer = document.querySelector(".days"),
    prev = document.querySelector(".prev"),
    next = document.querySelector(".next"),
    todayBtn = document.querySelector(".today-btn"),
    gotoBtn = document.querySelector(".goto-btn"),
    dateInput = document.querySelector(".date-input"),
    eventDay = document.querySelector(".event-day"),
    eventDate = document.querySelector(".event-date"),
    addEventWrapper = document.querySelector(".add-event-wrapper "),
    addEventTitle = document.querySelector(".event-name "),
    addEventCategorie = document.querySelector(".event-team "),
    addEventFrom = document.querySelector(".event-time-from "),
    addEventTo = document.querySelector(".event-time-to "),
    addEventSubmit = document.querySelector(".add-event-btn ");

  let today = new Date();
  let activeDay;
  let month = today.getMonth();
  let year = today.getFullYear();

  const months = [
    "Janvier",
    "Février",
    "Mars",
    "Avril",
    "Mai",
    "Juin",
    "Juillet",
    "Août",
    "Septembre",
    "Octobre",
    "Novembre",
    "Décembre",
  ];


  try {
    var addEventCloseBtn = document.querySelector(".close ");
    var addEventBtn = document.querySelector(".add-event");
    //function to add event
    addEventBtn.addEventListener("click", () => {
      addEventWrapper.classList.toggle("active");
    });

    addEventCloseBtn.addEventListener("click", () => {
      addEventWrapper.classList.remove("active");
    });

    document.addEventListener("click", (e) => {
      if (e.target !== addEventBtn && !addEventWrapper.contains(e.target)) {
        addEventWrapper.classList.remove("active");
      }
    });

    //allow 50 chars in eventtitle
    addEventTitle.addEventListener("input", (e) => {
      addEventTitle.value = addEventTitle.value.slice(0, 60);
    });

    addEventCategorie.addEventListener("input", (e) => {
      addEventCategorie.value = addEventCategorie.value.slice(0, 60);
    });


    //allow only time in eventtime from and to
    addEventFrom.addEventListener("input", (e) => {
      addEventFrom.value = addEventFrom.value.replace(/[^0-9:]/g, "");
      if (addEventFrom.value.length === 2) {
        addEventFrom.value += ":";
      }
      if (addEventFrom.value.length > 5) {
        addEventFrom.value = addEventFrom.value.slice(0, 5);
      }
    });

    addEventTo.addEventListener("input", (e) => {
      addEventTo.value = addEventTo.value.replace(/[^0-9:]/g, "");
      if (addEventTo.value.length === 2) {
        addEventTo.value += ":";
      }
      if (addEventTo.value.length > 5) {
        addEventTo.value = addEventTo.value.slice(0, 5);
      }
    });

    //function to add event to eventsArr
    addEventSubmit.addEventListener("click", () => {
      const eventTitle = addEventTitle.value;
      const eventCategorie = addEventCategorie.value;
      const eventTimeFrom = addEventFrom.value;
      const eventTimeTo = addEventTo.value;


      console.log(eventTimeFrom);
      if (eventTitle === "" || eventCategorie === "" || eventTimeFrom === "" || eventTimeTo === "") {
        alert("Veuillez remplir tous les champs.");
        return;
      }

      //check correct time format 24 hour
      const timeFromArr = eventTimeFrom.split(":");
      const timeToArr = eventTimeTo.split(":");
      if (
        timeFromArr.length !== 2 ||
        timeToArr.length !== 2 ||
        timeFromArr[0] > 23 ||
        timeFromArr[1] > 59 ||
        timeToArr[0] > 23 ||
        timeToArr[1] > 59
      ) {
        alert("Invalid Time Format");
        return;
      }

      const timeFrom = convertTime(eventTimeFrom);
      const timeTo = convertTime(eventTimeTo);

      //check if event is already added
      let eventExist = false;
      eventsArr.forEach((event) => {
        if (
          event.day === activeDay &&
          event.month === month + 1 &&
          event.year === year
        ) {
          event.events.forEach((event) => {
            if (event.title === eventTitle) {
              eventExist = true;
            }
          });
        }
      });
      if (eventExist) {
        alert("Evènement déjà ajouté !");
        return;
      }
      const newEvent = {
        title: eventTitle,
        time: timeFrom + " - " + timeTo,
      };
      let eventAdded = false;
      if (eventsArr.length > 0) {
        eventsArr.forEach((item) => {
          if (
            item.day === activeDay &&
            item.month === month + 1 &&
            item.year === year
          ) {
            item.events.push(newEvent);
            eventAdded = true;
          }
        });
      }
      console.log(activeDay)
      if (!eventAdded) {
        eventsArr.push({
          day: activeDay,
          month: month + 1,
          year: year,
          events: [newEvent],
        });
      }

      addEventWrapper.classList.remove("active");
      addEventTitle.value = "";
      addEventFrom.value = "";
      addEventTo.value = "";
      updateEvents(activeDay);
      //select active day and add event class if not added
      const activeDayEl = document.querySelector(".day.active");
      if (!activeDayEl.classList.contains("event")) {
        activeDayEl.classList.add("event");
      }

      const dateDebut = `${year}-${month + 1}-${activeDay} ${eventTimeFrom}:00`;
      const dateFin = `${year}-${month + 1}-${activeDay} ${eventTimeTo}:00`;
      addEvent(eventTitle, eventCategorie, dateDebut, dateFin, idEquipe, idStade);
      location.reload();

    });

  } catch (error) {
    // Gérer l'erreur éventuelle en affichant un message dans la console
    console.warn("Utilisateur connecté en tant que joueur");
  }

  const estValide = await getEvents(idEquipe);
  const estValide2 = await getMatchs(idEquipe);
  console.log(eventsArr);


  //function to add days in days with class day and prev-date next-date on previous month and next month days and active on today
  function initCalendar() {
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const prevLastDay = new Date(year, month, 0);
    const prevDays = prevLastDay.getDate();
    const lastDate = lastDay.getDate();
    const day = firstDay.getDay() - 1;
    const nextDays = 7 - lastDay.getDay();
    date.innerHTML = months[month] + " " + year;

    let days = "";

    for (let x = day; x > 0; x--) {
      days += `<div class="day prev-date">${prevDays - x + 1}</div>`;
    }

    for (let i = 1; i <= lastDate; i++) {
      //check if event is present on that day
      let event = false;
      eventsArr.forEach((eventObj) => {
        if (
          eventObj.day === i &&
          eventObj.month === month + 1 &&
          eventObj.year === year
        ) {
          event = true;
        }
      });
      if (
        i === new Date().getDate() &&
        year === new Date().getFullYear() &&
        month === new Date().getMonth()
      ) {
        activeDay = i;
        getActiveDay(i);
        updateEvents(i);
        if (event) {
          days += `<div class="day today active event">${i}</div>`;
        } else {
          days += `<div class="day today active">${i}</div>`;
        }
      } else {
        if (event) {
          days += `<div class="day event">${i}</div>`;
        } else {
          days += `<div class="day ">${i}</div>`;
        }
      }
    }

    for (let j = 1; j <= nextDays; j++) {
      days += `<div class="day next-date">${j}</div>`;
    }
    daysContainer.innerHTML = days;
    addListner();
  }

  //function to add month and year on prev and next button
  function prevMonth() {
    month--;
    if (month < 0) {
      month = 11;
      year--;
    }
    initCalendar();
  }

  function nextMonth() {
    month++;
    if (month > 11) {
      month = 0;
      year++;
    }
    initCalendar();
  }

  prev.addEventListener("click", prevMonth);
  next.addEventListener("click", nextMonth);

  initCalendar();

  //function to add active on day
  function addListner() {
    const days = document.querySelectorAll(".day");
    days.forEach((day) => {
      day.addEventListener("click", (e) => {
        getActiveDay(e.target.innerHTML);
        updateEvents(Number(e.target.innerHTML));
        activeDay = Number(e.target.innerHTML);
        //remove active
        days.forEach((day) => {
          day.classList.remove("active");
        });
        //if clicked prev-date or next-date switch to that month
        if (e.target.classList.contains("prev-date")) {
          prevMonth();
          //add active to clicked day afte month is change
          setTimeout(() => {
            //add active where no prev-date or next-date
            const days = document.querySelectorAll(".day");
            days.forEach((day) => {
              if (!day.classList.contains("prev-date") && day.innerHTML === e.target.innerHTML) {
                day.classList.add("active");
              }
            });
          }, 100);
        } else if (e.target.classList.contains("next-date")) {
          nextMonth();
          //add active to clicked day afte month is changed
          setTimeout(() => {
            const days = document.querySelectorAll(".day");
            days.forEach((day) => {
              if (
                !day.classList.contains("next-date") &&
                day.innerHTML === e.target.innerHTML
              ) {
                day.classList.add("active");
              }
            });
          }, 100);
        } else {
          e.target.classList.add("active");
        }
      });
    });
  }

  todayBtn.addEventListener("click", () => {
    today = new Date();
    month = today.getMonth();
    year = today.getFullYear();
    initCalendar();
  });

  dateInput.addEventListener("input", (e) => {
    dateInput.value = dateInput.value.replace(/[^0-9/]/g, "");
    if (dateInput.value.length === 2) {
      dateInput.value += "/";
    }
    if (dateInput.value.length > 7) {
      dateInput.value = dateInput.value.slice(0, 7);
    }
    if (e.inputType === "deleteContentBackward") {
      if (dateInput.value.length === 3) {
        dateInput.value = dateInput.value.slice(0, 2);
      }
    }
  });

  gotoBtn.addEventListener("click", gotoDate);

  function gotoDate() {
    const dateArr = dateInput.value.split("/");
    if (dateArr.length === 2) {
      if (dateArr[0] > 0 && dateArr[0] < 13 && dateArr[1].length === 4) {
        month = dateArr[0] - 1;
        year = parseInt(dateArr[1]);
        initCalendar();
        return;
      }
    }
    alert("Invalid Date");
  }

  //function get active day day name and date and update eventday eventdate
  function getActiveDay(date) {
    const day = new Date(year, month, date);
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const frDate = day.toLocaleDateString('fr-FR', options);
    const dayName = frDate.toString().split(" ")[0];
    eventDay.innerHTML = dayName;
    eventDate.innerHTML = date + " " + months[month] + " " + year;
  }

  //function update events when a day is active
  function updateEvents(date) {
    let events = "";
    eventsArr.forEach((event) => {
      if (
        date === event.day &&
        month + 1 === event.month &&
        year === event.year
      ) {
        event.events.forEach((event) => {
          let eventHtml = `<div class="event" id="${event.id}">
            <div class="title_time_event" id="${event.id}">
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
              <button class="boutonConsulter" onClick="window.location.href='../Profil/page-match.php?id=${event.id}'">
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

  function convertTime(time) {
    //convert time to 24 hour format
    let timeArr = time.split(":");
    let timeHour = timeArr[0];
    let timeMin = timeArr[1];
    let timeFormat = timeHour >= 12 ? "PM" : "AM";
    timeHour = timeHour % 12 || 12;
    time = timeHour + ":" + timeMin + " " + timeFormat;
    return time;
  }

});