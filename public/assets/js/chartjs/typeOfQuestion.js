function createChart(){
  Chart.defaults.global.legend = {
    enabled: false
  };
  var ctx = document.getElementById("canvasDoughnut");
  var numberOfItems = +document.getElementById("numberOfItems").value;
  var true_or_false = +document.getElementById("typeOfExam1").value;
  var multiple_choice = +document.getElementById("typeOfExam2").value;
  var identification = +document.getElementById("typeOfExam3").value;
    if((true_or_false + multiple_choice + identification) === numberOfItems && numberOfItems != 0){
      var data = {
        labels: [
          "True or False",
          "Multiple Choice",
          "Identification"
        ],
        datasets: [{
          data: [true_or_false,multiple_choice,identification],
          backgroundColor: [
            "#455C73",
            "#9B59B6",
            "#BDC3C7"
          ],
          hoverBackgroundColor: [
            "#34495E",
            "#B370CF",
            "#CFD4D8"
          ]

        }]
      };
    }
  var canvasDoughnut = new Chart(ctx, {
    type: 'doughnut',
    tooltipFillColor: "rgba(51, 51, 51, 0.55)",
    data: data
  });
}
