function showEach(thechosenone , t_f , mul , iden) {
    var newboxes = document.getElementsByTagName("div");
          for(var x=0; x<newboxes.length; x++) {
                name = newboxes[x].getAttribute("class");
                if (name == 'newboxes') {
                      if (newboxes[x].id == thechosenone) {
                        newboxes[x].style.display = 'block';
                      }
                else {
                      newboxes[x].style.display = 'none';
                }
              }
          }
                var count = 0;
                var change_anchor1 = document.getElementById("myAnchor1");
                var change_anchor2 = document.getElementById("myAnchor1");
                var change_anchor3 = document.getElementById("myAnchor1");

                if($('input[id=tf_option1]:checked').size() > 0){
                  change_anchor1.style.backgroundColor = '#4AFF49';
                  change_anchor1.style.color = '#5A738E';
                  count++;
                  document.getElementById("doneQuestion").innerHTML = count + "/" + (t_f+mul+iden);
                }
                else if($('input[id=option_mul1]:checked').size() > 0){
                  change_anchor2.style.backgroundColor = '#4AFF49';
                  change_anchor2.style.color = '#5A738E';
                  count++;
                  document.getElementById("doneQuestion").innerHTML = count + "/" + (t_f+mul+iden);
                }
                else if(document.getElementById("ident1").value != ''){
                  change_anchor3.style.backgroundColor = '#4AFF49';
                  change_anchor3.style.color = '#5A738E';
                  count++;
                  document.getElementById("doneQuestion").innerHTML = count + "/" + (t_f+mul+iden);
                }
                else{
                  change_anchor1.style.backgroundColor = '#E6E9ED';
                  change_anchor1.style.color = '#5A738E';
                }
                for(var counter = 2; counter <= (t_f+mul+iden);counter++){
                  var all = document.getElementById("myAnchor"+counter);
                  if($('input[id=tf_option'+counter+']:checked').size() > 0){
                    all.style.backgroundColor = '#4AFF49';
                    all.style.color = '#5A738E';
                    count++;
                    document.getElementById("doneQuestion").innerHTML = count + "/" + (t_f+mul+iden);
                  }
                  else if($('input[id=option_mul'+counter+']:checked').size() > 0){
                    all.style.backgroundColor = '#4AFF49';
                    all.style.color = '#5A738E';
                    count++;
                    document.getElementById("doneQuestion").innerHTML = count + "/" + (t_f+mul+iden);
                  }
                  else if(document.getElementById("ident"+counter).value != ''){
                    all.style.backgroundColor = '#4AFF49';
                    all.style.color = '#5A738E';
                    count++;
                    document.getElementById("doneQuestion").innerHTML = count + "/" + (t_f+mul+iden);
                  }
                  else{
                    all.style.backgroundColor = '#E6E9ED';
                    all.style.color = '#5A738E';
                  }
                }
  $("body").scrollTop(0);
}

function makingSure(t_f , mul , iden){
  var count = 0;
  var change_anchor1 = document.getElementById("myAnchor1");
  var change_anchor2 = document.getElementById("myAnchor1");
  var change_anchor3 = document.getElementById("myAnchor1");

  if($('input[id=tf_option1]:checked').size() > 0){
    change_anchor1.style.backgroundColor = '#4AFF49';
    change_anchor1.style.color = '#5A738E';
    count++;
    document.getElementById("doneQuestion").innerHTML = count + "/" + (t_f+mul+iden);
  }
  else if($('input[id=option_mul1]:checked').size() > 0){
    change_anchor2.style.backgroundColor = '#4AFF49';
    change_anchor2.style.color = '#5A738E';
    count++;
    document.getElementById("doneQuestion").innerHTML = count + "/" + (t_f+mul+iden);
  }
  else if(document.getElementById("ident1").value != ''){
    change_anchor3.style.backgroundColor = '#4AFF49';
    change_anchor3.style.color = '#5A738E';
    count++;
    document.getElementById("doneQuestion").innerHTML = count + "/" + (t_f+mul+iden);
  }
  else{
    change_anchor1.style.backgroundColor = '#E6E9ED';
    change_anchor1.style.color = '#5A738E';
  }
  for(var counter = 2; counter <= (t_f+mul+iden);counter++){
    var all = document.getElementById("myAnchor"+counter);
    if($('input[id=tf_option'+counter+']:checked').size() > 0){
      all.style.backgroundColor = '#4AFF49';
      all.style.color = '#5A738E';
      count++;
      document.getElementById("doneQuestion").innerHTML = count + "/" + (t_f+mul+iden);
    }
    else if($('input[id=option_mul'+counter+']:checked').size() > 0){
      all.style.backgroundColor = '#4AFF49';
      all.style.color = '#5A738E';
      count++;
      document.getElementById("doneQuestion").innerHTML = count + "/" + (t_f+mul+iden);
    }
    else if(document.getElementById("ident"+counter).value != ''){
      all.style.backgroundColor = '#4AFF49';
      all.style.color = '#5A738E';
      count++;
      document.getElementById("doneQuestion").innerHTML = count + "/" + (t_f+mul+iden);
    }
    else{
      all.style.backgroundColor = '#E6E9ED';
      all.style.color = '#5A738E';
    }
  }
}
function submitAnswers(){
  $('#formExam').submit();
}
