function setHiddenSpecificId(id){
  $("input[id=specific_group_id]").val(id);
  $('#specificGroup').submit();
}
function setGroupId(id){
  $("input[id=specific_id]").val(id);
  $('#specificGroupIdForm').submit();
}
function takeExam(examId,gId){
  $("input[id=specific_id]").val(examId);
  $("input[id=specific_group_id]").val(gId);
  $('#specificExamIdForm').submit();
}
