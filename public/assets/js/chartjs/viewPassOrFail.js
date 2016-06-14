Chart.defaults.global.legend = {
  enabled: false
};
var ctx = document.getElementById("canvasDoughnut");
var passed = document.getElementById("passedStudents").value;
var failed = document.getElementById("failedStudents").value;

var data = {
  labels: [
    'Failed',
    'Passed'
  ],
  datasets: [{
    data: [failed,passed],
    backgroundColor: [
      "#FF4949",
      "#30DC2F"
    ],
    hoverBackgroundColor: [
      "#F55252",
      "#49E048"
    ]

  }]
};

var canvasDoughnut = new Chart(ctx, {
  type: 'doughnut',
  tooltipFillColor: "rgba(51, 51, 51, 0.55)",
  data: data
});
