  Chart.defaults.global.legend = {
    enabled: false
  };
  var ctx = document.getElementById("canvasDoughnut");
  var correct = document.getElementById("correctAnswers").value;
  var wrong = document.getElementById("wrongAnswers").value;

  var data = {
    labels: [
      "Wrong Answers",
      "Correct Answers"
    ],
    datasets: [{
      data: [wrong,correct],
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
