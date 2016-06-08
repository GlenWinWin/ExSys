  $(function () {
    var exams = +document.getElementById("exams").value;
    var exam1 = '',exam2='',exam3='';
    var percent1 = 0,percent2 = 0,percent3 = 0;
    for(var counter = 1; counter <= exams; counter++){
      if(counter == 1){
        exam1 = document.getElementById("examName"+counter).value;
        percent1 = +document.getElementById("percentage"+counter).value;
        percent1 = percent1 != 0 ? percent1 : 0;
      }
      else if(counter == 2){
        exam2 = document.getElementById("examName"+counter).value;
        percent2 = +document.getElementById("percentage"+counter).value;
        percent2 = percent2 != 0 ? percent2 : 0;
      }
      else{
        exam3 = document.getElementById("examName"+counter).value;
        percent3 = +document.getElementById("percentage"+counter).value;
        percent3 = percent3 != 0 ? percent3 : 0;
      }
    }
    exam1 = exam1 != '' ? exam1 : 'Exam 1';
    exam2 = exam2 != '' ? exam2 : 'Exam 2';
    exam3 = exam3 != '' ? exam3 : 'Exam 3';

      Morris.Bar({
          element: 'graph_bar',
          data: [
              {exam: exam1, score: percent1},
              {exam: exam2, score: percent2},
              {exam: exam3, score: percent3}

          ],
          xkey: 'exam',
          ykeys: ['score'],
          ymax:100,
          labels: ['Percentage'],
          barRatio: 0.5,
          barColors: ['#26B99A'],
          xLabelAngle: 35,
          hideHover: 'auto',
          resize: true
      });
  });
//,'#3498DB'
//'#34495E', '#ACADAC',
