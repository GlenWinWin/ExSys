function showEach(thechosenone , t_f , mul , iden , specific_id) {
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
          $("body").scrollTop(0);

                  var all = document.getElementById("myAnchor"+specific_id);
                  var count2 = 0;
                  if($('input[id=tf_option'+specific_id+']:checked').size() > 0 && document.getElementById(specific_id).value == ''){
                    all.style.backgroundColor = '#4AFF49';
                    all.style.color = '#5A738E';
                    $("input[id="+specific_id+"]").val("1");
                    count2++;
                    var count_hidden = +document.getElementById("count_hidden").value;
                    document.getElementById("doneQuestion").innerHTML = (count_hidden+count2) + "/" + (t_f+mul+iden);
                    $("input[id=count_hidden]").val(count_hidden+count2);
                  }
                  else if($('input[id=option_mul'+specific_id+']:checked').size() > 0 && document.getElementById(specific_id).value == ''){
                    all.style.backgroundColor = '#4AFF49';
                    all.style.color = '#5A738E';
                    $("input[id="+specific_id+"]").val("1");
                    count2++;
                    var count_hidden = +document.getElementById("count_hidden").value;
                    $("input[id=count_hidden]").val(count_hidden+count2);
                    document.getElementById("doneQuestion").innerHTML = (count_hidden+count2) + "/" + (t_f+mul+iden);
                  }
                  else if(document.getElementById("ident"+specific_id).value != '' && document.getElementById(specific_id).value == ''){
                    all.style.backgroundColor = '#4AFF49';
                    all.style.color = '#5A738E';
                    $("input[id="+specific_id+"]").val("1");
                    count2++;
                    var count_hidden = +document.getElementById("count_hidden").value;
                    document.getElementById("doneQuestion").innerHTML = (count_hidden+count2) + "/" + (t_f+mul+iden);
                    $("input[id=count_hidden]").val(count_hidden+count2);
                  }
                  else if($('input[id=tf_option'+specific_id+']:checked').size() == 0 && document.getElementById(specific_id).value != ''){
                    all.style.backgroundColor = '#E6E9ED';
                    all.style.color = '#5A738E';
                    $("input[id="+specific_id+"]").val("");
                    var count_hidden = +document.getElementById("count_hidden").value;
                    var value = ((count_hidden-1)+count2);
                    document.getElementById("doneQuestion").innerHTML = value + "/" + (t_f+mul+iden);
                    $("input[id=count_hidden]").val(value);
                  }
                  else if($('input[id=option_mul'+specific_id+']:checked').size() == 0 && document.getElementById(specific_id).value != ''){
                    all.style.backgroundColor = '#E6E9ED';
                    all.style.color = '#5A738E';
                    $("input[id="+specific_id+"]").val("");
                    var count_hidden = +document.getElementById("count_hidden").value;
                    var value = ((count_hidden-1)+count2);
                    document.getElementById("doneQuestion").innerHTML = value + "/" + (t_f+mul+iden);
                    $("input[id=count_hidden]").val(value);
                  }
                  // else if($('input[id=ident'+specific_id+']').size() == 0 && document.getElementById(specific_id).value != ''){
                  //   all.style.backgroundColor = '#E6E9ED';
                  //   all.style.color = '#5A738E';
                  //   $("input[id="+specific_id+"]").val("");
                  //   var count_hidden = +document.getElementById("count_hidden").value;
                  //   var value = ((count_hidden-1)+count2);
                  //   document.getElementById("doneQuestion").innerHTML = value + "/" + (t_f+mul+iden);
                  //   $("input[id=count_hidden]").val(value);
                  // }



}

function makingSure(t_f , mul , iden){
  var count = 0;
    for(var counter = 1; counter <= (t_f+mul+iden);counter++){
      var all = document.getElementById("myAnchor"+counter);
      if($('input[id=tf_option'+counter+']:checked').size() > 0){
        all.style.backgroundColor = '#4AFF49';
        all.style.color = '#5A738E';
        count++;
      }
      else if($('input[id=option_mul'+counter+']:checked').size() > 0){
        all.style.backgroundColor = '#4AFF49';
        all.style.color = '#5A738E';
        count++;
      }
      else if(document.getElementById("ident"+counter).value != ''){
        all.style.backgroundColor = '#4AFF49';
        all.style.color = '#5A738E';
        count++;
      }
      else{
        all.style.backgroundColor = '#E6E9ED';
        all.style.color = '#5A738E';
      }
      document.getElementById("doneQuestion").innerHTML = count + "/" + (t_f+mul+iden);
    }
}
function submitAnswers(){
  $('#formExam').submit();
}
