function showonlyone(thechosenone , t_f , mul ,iden) {
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
    if(t_f > 0){
        for(var i=1; i <= t_f;i++){
          var change_anchor = document.getElementById("myHeader"+i);
          if((document.getElementById("question_tf"+i).value != '') && ($('input[id=tf_option'+i+']:checked').size() > 0)){
              change_anchor.style.backgroundColor = '#4AFF49';
              change_anchor.style.color = '#5A738E';
          }
          else{
            change_anchor.style.backgroundColor = '#E6E9ED';
            change_anchor.style.color = '#5A738E';
          }
        }
    }
    if(mul > 0){
      for(var mm = t_f+1; mm <= (t_f+mul);mm++){
        var change_anchor = document.getElementById("myHeader"+mm);
        if((document.getElementById("question_mul"+mm).value != '') && ($('input[id=mul_option'+mm+']:checked').size() > 0)
      && (document.getElementById("a"+mm).value != '') && (document.getElementById("b"+mm).value != '') && (document.getElementById("c"+mm).value != '') && (document.getElementById("d"+mm).value != '')){
            change_anchor.style.backgroundColor = '#4AFF49';
            change_anchor.style.color = '#5A738E';
        }
        else{
          change_anchor.style.backgroundColor = '#E6E9ED';
          change_anchor.style.color = '#5A738E';
        }
      }
    }
    if(iden > 0){
      for(var idenn = mul+t_f+1; idenn<=(t_f+mul+iden);idenn++){
        var change_anchor_iden = document.getElementById("myHeader"+idenn);
        if((document.getElementById("questIden"+idenn).value !=  '') && (document.getElementById("tags_"+idenn).value !=  '') ) {
                  change_anchor_iden.style.backgroundColor = '#4AFF49';
                  change_anchor_iden.style.color = '#5A738E';
                }
                else{
                  change_anchor_iden.style.backgroundColor = '#E6E9ED';
                  change_anchor.style.color = '#5A738E';
                }
      }
    }
    $("body").scrollTop(0);

}
function onAddTag(tag) {
  alert("Added a tag: " + tag);
}
function onRemoveTag(tag) {
  alert("Removed a tag: " + tag);
}
function onChangeTag(input, tag) {
  alert("Changed a tag: " + tag);
}
function doTag(tag_number){
  $(function() {
    $('#tags_'+tag_number).tagsInput({
      width: 'auto'
    });
  });
}
function displayModal(t_f,mul,iden){
  var count = 0;
  if(t_f > 0){
      for(var i=1; i <= t_f;i++){
        var change_anchor = document.getElementById("myHeader"+i);
        if((document.getElementById("question_tf"+i).value != '') && ($('input[id=tf_option'+i+']:checked').size() > 0)){
            change_anchor.style.backgroundColor = '#4AFF49';
            change_anchor.style.color = '#5A738E';
            count++;
        }
        else{
          change_anchor.style.backgroundColor = '#E6E9ED';
          change_anchor.style.color = '#5A738E';
        }
      }
  }
  if(mul > 0){
    for(var mm = t_f+1; mm <= (t_f+mul);mm++){
      var change_anchor = document.getElementById("myHeader"+mm);
      if((document.getElementById("question_mul"+mm).value != '') && ($('input[id=mul_option'+mm+']:checked').size() > 0)
    && (document.getElementById("a"+mm).value != '') && (document.getElementById("b"+mm).value != '') && (document.getElementById("c"+mm).value != '') && (document.getElementById("d"+mm).value != '')){
          change_anchor.style.backgroundColor = '#4AFF49';
          change_anchor.style.color = '#5A738E';
          count++;
      }
      else{
        change_anchor.style.backgroundColor = '#E6E9ED';
        change_anchor.style.color = '#5A738E';
      }
    }
  }
  if(iden > 0){
    for(var idenn = mul+t_f+1; idenn<=(t_f+mul+iden);idenn++){
      var change_anchor_iden = document.getElementById("myHeader"+idenn);
      if((document.getElementById("questIden"+idenn).value !=  '') && (document.getElementById("tags_"+idenn).value !=  '') ) {
                change_anchor_iden.style.backgroundColor = '#4AFF49';
                change_anchor_iden.style.color = '#5A738E';
                count++;
              }
              else{
                change_anchor_iden.style.backgroundColor = '#E6E9ED';
                change_anchor.style.color = '#5A738E';
              }
    }
  }
  var filledQuestions =  document.getElementById("filledQuestions");
  filledQuestions.innerHTML = count;
  var remarks = document.getElementById("remarks");
  if(count == (t_f+mul+iden)){
    remarks.style.color = "#4AFF49";
    remarks.innerHTML = '<b><i class="fa fa-check"><i></b>';
  }
  else{
    remarks.style.color = "red";
    remarks.innerHTML = '<b><i class="fa fa-exclamation"><i></b>';
  }
}
function submitQuestion(){
  $('#formQuestion').submit();
}
