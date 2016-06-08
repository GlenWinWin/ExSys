<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Question;
use App\Scores;
use App\Notifications;
use App\Exam;
use Session;
use Auth;
use DB;
use App\Groups;
use App\Members;



class ExamsController extends Controller
{
    public function addInfoExam(Request $requests){
      $notifications = Notifications::where('id','=',[Auth::user()->id])->orderBy('notif_id','desc')->get();
      $arr = explode('?',$requests->fullUrl());
      $groups = Groups::where('prof_id', '=', Auth::user()->id)->get();
      return view('exams/create_exam')->with('groups',$groups)->with('groupId',$arr[1])->with('notifs',count($notifications));
    }
    public function createExamInfo(Request $requests){
      return redirect()->action('ExamsController@addInfoExam', [$requests->groupId]);;
    }
    public function store(Request $requests){
      $notifications = Notifications::where('id','=',[Auth::user()->id])->orderBy('notif_id','desc')->get();
      $numberOfItems = $requests->numberOfItems;
      $true_false = $requests->typeOfExam1;
      $multiple_choice = $requests->typeOfExam2;
      $identification = $requests->typeOfExam3;
      $examName = $requests->examName;
      $groupId = $requests->groupId;
      $groups = Groups::where('prof_id', '=', Auth::user()->id)->get();

      return view('exams/create_exam_question')
      ->with('numberOfItems',$numberOfItems)
      ->with('true_false',$true_false)
      ->with('multiple_choice',$multiple_choice)
      ->with('identification',$identification)
      ->with('examName',$examName)
      ->with('groups',$groups)
      ->with('groupId',$groupId)
      ->with('notifs',count($notifications));
    }
    public function createExam(Request $requests){
      $tf_question = $requests->request->get('true_false_question');
      $multi_question = $requests->request->get('mulQuestion');
      $iden_question = $requests->request->get('iden_question');
      $true_false = $requests->true_false;
      $multiple_choice = $requests->multiple_choice;
      $identification = $requests->identification;
      $exam_name = $requests->examName;
      $time_limit = $requests->timeLimit;
      $random = $requests->check_random;
      $ifRandom = $random != '' ? 1 : 0;

      $exam = new Exam;
      $exam->exam_name = $exam_name;
      $exam->exam_time_limit = $time_limit;
      $exam->prof_id = Auth::user()->id;
      $exam->group_id = $requests->groupId;
      $exam->ifRandom = $ifRandom;
      $exam->date_added = date('Y-m-d');
      $exam->save();

      $exam_query = Exam::where('prof_id','=',Auth::user()->id)->orderBy('exam_id','desc')->first();

        for($i = 0;$i < $true_false; $i++) {
          $question = new Question;
          $question->exam_id = $exam_query->exam_id;
          $question->question = $tf_question[$i];
          $question->answers = $requests->request->get('tf'.($i+1));
          $question->type_of_question = 'true_or_false';
          $question->save();
        }
        for($j = 0;$j < $multiple_choice; $j++) {
          $question = new Question;
          $question->exam_id = $exam_query->exam_id;
          $question->question = $multi_question[$j];
          $question->answers = $requests->request->get('ml'.($j+($true_false+1)));
          $question->a = $requests->request->get('a'.($j+($true_false+1)));
          $question->b = $requests->request->get('b'.($j+($true_false+1)));
          $question->c = $requests->request->get('c'.($j+($true_false+1)));
          $question->d = $requests->request->get('d'.($j+($true_false+1)));
          $question->type_of_question = 'multiple_choice';
          $question->save();
        }
        for($i = 0;$i < $identification; $i++) {
          $question = new Question;
          $question->exam_id = $exam_query->exam_id;
          $question->question = $iden_question[$i];
          $question->answers = strtolower($requests->request->get('iden'.($i+($multiple_choice+$true_false+1))));
          $question->type_of_question = 'identification';
          $question->save();
        }
        $questions = DB::select('select exam_name,exam_time_limit,question,answers,group_id,type_of_question,a,b,c,d FROM exams NATURAL JOIN questions WHERE exam_id = ? ORDER BY RAND()',[$exam_query->exam_id]);
        $addMember = Members::where('group_id','=',$requests->groupId)->where('typeOfUser','=',1)->get();
        $specific_group = Groups::where('group_id', '=', $requests->groupId)->get();
        $groupName = '';
        foreach ($specific_group as $group) {
          $groupName = $group->group_name;
        }
        foreach ($addMember as $member) {
          $scores = new Scores;
          $scores->exam_id = $exam_query->exam_id;
          $scores->user_id = $member->user_id;
          $scores->score = 0;
          $scores->total = count($questions);
          $scores->ifTaken = 0;
          $scores->percentage = 0;
          $scores->save();

          $addNotification = new Notifications;
          $addNotification->id = $member->user_id;
          $addNotification->fromUser = Auth::user()->id;
          $addNotification->has_read = '0';
          $addNotification->notif_message = Auth::user()->name . " added ". $exam_name ." to your " . $groupName . " group.";
          $addNotification->save();
        }

        Session::flash('flash_message','Exam has has been created.');
        Session::flash('type_message','success');

        return redirect()->action('PagesController@specific_group', [$requests->groupId]);
    }
    public function takeExam(Request $requests){
     return redirect()->action('ExamsController@takeYourExam', [$requests->examId]);
    }
    public function takeYourExam(Request $requests){
      $notifications = Notifications::where('id','=',[Auth::user()->id])->orderBy('notif_id','desc')->get();
      $arr = explode('?',$requests->fullUrl());
      $groups = DB::select('select group_id,group_name FROM group_members NATURAL JOIN groups WHERE user_id = ?',[Auth::user()->id]);
      $examId = $arr[1];
      $ifAGroupMember = DB::select('select user_id from exams natural join group_members where exam_id = ? and user_id = ?',[$examId,Auth::user()->id]);
      $questions = DB::select('select exam_name,exam_time_limit,question,answers,group_id,type_of_question,a,b,c,d FROM exams NATURAL JOIN questions WHERE exam_id = ? ORDER BY RAND()',[$examId]);
      $true_false = Question::where('exam_id','=',$examId)->where('type_of_question','=','true_or_false')->get();
      $multiple_choice = Question::where('exam_id','=',$examId)->where('type_of_question','=','multiple_choice')->get();
      $identification = Question::where('exam_id','=',$examId)->where('type_of_question','=','identification')->get();
      $scores = Scores::where('user_id','=',Auth::user()->id)->where('exam_id','=',$arr[1])->where('score','=',0)->get();
      $time_limit = 0;
      $groupId = 0;

      foreach($questions  as $quest){
        $time_limit = $quest->exam_time_limit;
        $groupId = $quest->group_id;
      }
      if(count($ifAGroupMember) > 0 && count($scores) > 0){
        return view('exams/takeExam',['groups'=>$groups,'questions'=>$questions,'time_limit'=>$time_limit,'examId'=>$examId,
        'groupId'=>$groupId,'true_false'=>count($true_false),'multiple_choice'=>count($multiple_choice),'identification'=>count($identification),'notifs'=>count($notifications)]);
      }
      else{
        Session::flash('flash_message','Oopps! that is not your exam.');
        Session::flash('type_message','danger');

        return redirect('home');
      }

    }
    public function submitExam(Request $requests){
      $total = $requests->totalQuestions;
      $examId = $requests->exam_id;
      $groupId = $requests->group_id;
      $question = $requests->request->get('question');
      $score = 0;
      for($i = 0; $i < $total; $i++){
        $identification_answer = $requests->request->get('iden'.($i+1));
        $multiple_choice_answer = $requests->request->get('ml'.($i+1));
        $tf_answer = $requests->request->get('tf'.($i+1));
        $true_falseQuestion = Question::where('question','=',$question[$i])->where('type_of_question','=','true_or_false')->get();
        $multiple_choiceQuestion = Question::where('question','=',$question[$i])->where('type_of_question','=','multiple_choice')->get();
        $identificationQuestion = Question::where('question','=',$question[$i])->where('type_of_question','=','identification')->get();
        if(count($true_falseQuestion) == 1){
          $answer = '';
          foreach($true_falseQuestion as $tf){
            $answer = $tf->answers;
          }
          if($answer == $tf_answer){
            $score++;
          }
        }
        else if(count($multiple_choiceQuestion) == 1){
          $answer = '';
          foreach($multiple_choiceQuestion as $mul){
            $answer = $mul->answers;
          }
          if($answer == $multiple_choice_answer){
            $score++;
          }
        }
        else{
          $answers = '';
          foreach($identificationQuestion as $iden){
            $answers = $iden->answers;
          }
          $rightAnswers = explode(',',$answers);
          if(in_array(trim(strtolower($identification_answer)),$rightAnswers)){
            $score++;
          }
        }
      }
      $scores = Scores::where('user_id','=',Auth::user()->id)->where('exam_id','=',$examId)->update(  ['score'=>$score,'ifTaken'=>1,'percentage'=>round(((($score/$total)*50)+50))]);

      return redirect()->action('ProgressController@view_progress', [$groupId]);

    }
    public function showScore(Request $requests){
      $notifications = Notifications::where('id','=',[Auth::user()->id])->orderBy('notif_id','desc')->get();
      $groups = DB::select('select group_id,group_name FROM group_members NATURAL JOIN groups WHERE user_id = ?',[Auth::user()->id]);
      $score = Scores::where('user_id','=',Auth::user()->id)->where('exam_id','=',$requests->examId)->get();
      if(count($score) > 0){
        $getScore = 0;
        $total = 0;
        foreach($score as $sc){
          $getScore = $sc->score;
          $total = $sc->total;
        }
        return view('exams.showExamScore')->with('groups',$groups)->with('notifs',count($notifications))->with('correct',$getScore)->with('wrong',$total-$getScore);
      }
      else{
        Session::flash('flash_message','No score for you with that exam.');
        Session::flash('type_message','danger');

        return redirect('home');
      }
    }
    public function updateYourExam(Request $requests){
      $exam_id = $requests->exam_id;
      //$specific_exam = ""
      $notifications = Notifications::where('id','=',[Auth::user()->id])->orderBy('notif_id','desc')->get();
      $groups = Groups::where('prof_id','=',Auth::user()->id);
      return view('exams.editExam')->with('groups',$groups)->with('notifs',count($notifications));
    }
    public function viewtheResult(Request $requests){
      $notifications = Notifications::where('id','=',[Auth::user()->id])->orderBy('notif_id','desc')->get();
      $groups = Groups::where('prof_id','=',Auth::user()->id);
      $exams = Exam::where('exam_id','=',$requests->view_id)->where('prof_id','=',Auth::user()->id)->get();
      if(count($exams) > 0){
        $examResults = DB::select('select u.name as "Name", s.score as "Score", s.total as "Total", s.ifTaken as "taken" from scores s inner join users u on s.user_id = u.id where s.exam_id = ? group by u.name order by s.score desc',[$requests->view_id]);
        return view('exams.viewExamResult',['groups'=>$groups,'notifs'=>count($notifications),'examResults'=>$examResults]);
      }
      else{
        echo 'That is not your exam';
      }
    }
}
