Chart.defaults.global.legend = {
  enabled: false
};
var ctx = document.getElementById("canvasDoughnut");

var data = {
  labels: [
    'Failed',
    'Passed'
  ],
  datasets: [{
    data: [15,25],
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
