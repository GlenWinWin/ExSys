function setHiddenSpecificId(id){
  $("input[id=specific_group_id]").val(id);
  $('#specificGroup').submit();
}
function checkExamsProgress(id){
  $("input[id=specific_group_id]").val(id);
  $('#checkExamsProgress').submit();
}
function showProgress(id){
  $("input[id=specific_group_id]").val(id);
  $('#showProgress').submit();
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
function showScore(examId){
  $("input[id=specific_id]").val(examId);
  $('#showExamScoreForm').submit();
}
function editExam(examId){
  $("input[id=exam_id]").val(examId);
  $('#editExam').submit();
}
function viewExamResults(examId){
  $("input[id=viewexamResultsId]").val(examId);
  $('#viewExamResults').submit();
}
