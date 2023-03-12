function chargerChartEquipe(_id) {
  const ctx3 = document.getElementById('myChart3');
  const xhr = new XMLHttpRequest();
  xhr.open("GET", '../Profil/API/chargerChartEquipe.php?id=' + _id);
  xhr.send();
  // Attendre la réponse avant de continuer
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE && this.status === 200) {
      // Parse la réponse en tant que JSON
      let response = JSON.parse(this.responseText);
      new Chart(ctx3, {
        type: 'doughnut',
        data: {
          labels: [
            'Défaite',
            'Nul',
            'Victoire'
          ],
          datasets: [{
            label: 'Ratio victoire défaite',
            data: response,
            backgroundColor: [
              '#FF7878',
              '#E6B566',
              '#B6E2A1'
            ],
            hoverOffset: 4
          }]
        },
      });
    }
  }
}


function chargerChartJoueur(_id) {
  const ctx3 = document.getElementById('myChart');
  // Récupérer les données via AJAX
  const xhr = new XMLHttpRequest();
  xhr.open("GET", '../Profil/API/chargerChartJoueur.php?id=' + _id);
  xhr.send();

  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE && this.status === 200) {
      // Parse la réponse en tant que JSON
      let response = JSON.parse(this.responseText);
      var data = numberToArray(response.nb_journees); //récupération du nombre de journée de match dans un tableau

      for (var i = 0; i < data.length; i++) {
        try{
          data[i] = { x: response[i][0], y: response[i][1], r: 10 }; //insertion pour chaque journée du nombre de but
        }catch(e){
        }
      }
      console.log(data); 
      
      new Chart(document.getElementById('myChart'), {
        type: 'bubble',
        data: {
          datasets: [{
            label: 'Nombre de but par journée',
            data: data,
            backgroundColor: [getRandomColor(),getRandomColor(),getRandomColor()]
          }]
        },
        options: {
          scales: {
              y: {
                  min: 0,
                  suggestedMin: 0, 
                  suggestedMax: 5, 
                  ticks: {
                    precision: 0
                }
              },
              x:{
                min: 0,
              }
          }
      }
      });
    }
  }
}


function numberToArray(num) {
  var arr = [];
  for (var i = 0; i <= num; i++) {
    arr.push(i);
  }
  return arr;
}


function getRandomColor() {
  var r = Math.floor(Math.random() * 256);
  var g = Math.floor(Math.random() * 256);
  var b = Math.floor(Math.random() * 256);
  return "rgb(" + r + ", " + g + ", " + b + ")";
}