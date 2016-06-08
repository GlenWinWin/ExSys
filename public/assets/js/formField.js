function clickButton(){
      $('#formField').submit();
}
function stoppedTyping(){

      var examName = document.getElementById("examName").value;
      var numberOfItems = +document.getElementById("numberOfItems").value;
      var true_or_false = +document.getElementById("typeOfExam1").value;
      var multiple_choice = +document.getElementById("typeOfExam2").value;
      var identification = +document.getElementById("typeOfExam3").value;

        if((numberOfItems > 0) && examName.length > 0) {
          if(((true_or_false + multiple_choice + identification )  === numberOfItems)){
            document.getElementById('btnSubmit').disabled = false;
          }
          else{
            document.getElementById('btnSubmit').disabled = true;

          }
        } else {
            document.getElementById('btnSubmit').disabled = true;
        }
}
function ableAddGroupButton(){
  var groupName = document.getElementById("group_name").value;

  if(groupName == null || groupName == ""){
    document.getElementById('addButtonGroup').disabled = true;
  }
  else{
    document.getElementById('addButtonGroup').disabled = false;
  }
}
function submitCreateGroupForm(){
  $('#createGroupForm').submit();
}
function submitDeleteGroupForm(){
  $('#deleteGroupForm').submit();
}
function setValue(){
    var code = "";

    var charset = "abcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 7; i++ ){
        code += charset.charAt(Math.floor(Math.random() * charset.length));
    }
    document.getElementById("groupCode").innerHTML = code;
    $("input[id=group_Code]").val(code);
}
function setId(id,name){
  $("input[id=idGroup]").val(id);
  $("input[id=deletedGroupName]").val(name);
}
