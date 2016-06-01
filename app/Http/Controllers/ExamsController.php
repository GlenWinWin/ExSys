<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Question;
use App\Scores;
use App\Exam;
use Session;
use Auth;
use DB;
use App\Groups;


class ExamsController extends Controller
{
    public function addInfoExam(Request $requests){
      $arr = explode('?',$requests->fullUrl());
      $groups = Groups::where('prof_id', '=', Auth::user()->id)->get();
      return view('exams/create_exam')->with('groups',$groups)->with('groupId',$arr[1]);
    }
    public function createExamInfo(Request $requests){
      return redirect()->action('ExamsController@addInfoExam', [$requests->groupId]);;
    }
    public function index(){

    }
    public function store(Request $requests){
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
      ->with('groupId',$groupId);
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

      $exam = new Exam;
      $exam->exam_name = $exam_name;
      $exam->exam_time_limit = $time_limit;
      $exam->prof_id = Auth::user()->id;
      $exam->group_id = $requests->groupId;
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

        Session::flash('flash_message','Exam has has been created.');
        Session::flash('type_message','success');

        return redirect()->action('PagesController@specific_group', [$requests->groupId]);
    }
    public function takeExam(Request $requests){
     return redirect()->action('ExamsController@takeYourExam', [$requests->examId]);
    }
    public function takeYourExam(Request $requests){
      $arr = explode('?',$requests->fullUrl());
      $groups = DB::select('select group_id,group_name FROM group_members NATURAL JOIN groups WHERE user_id = ?',[Auth::user()->id]);
      $examId = $arr[1];
      $ifAGroupMember = DB::select('select user_id from exams natural join group_members where exam_id = ? and user_id = ?',[$examId,Auth::user()->id]);
      $questions = DB::select('select exam_name,exam_time_limit,question,answers,group_id,type_of_question,a,b,c,d FROM exams NATURAL JOIN questions WHERE exam_id = ? ORDER BY RAND()',[$examId]);
      $true_false = Question::where('exam_id','=',$examId)->where('type_of_question','=','true_or_false')->get();
      $multiple_choice = Question::where('exam_id','=',$examId)->where('type_of_question','=','multiple_choice')->get();
      $identification = Question::where('exam_id','=',$examId)->where('type_of_question','=','identification')->get();
      $scores = Scores::where('user_id','=',Auth::user()->id)->where('exam_id','=',$arr[1])->get();
      $time_limit = 0;
      $groupId = 0;
      foreach($questions  as $quest){
        $time_limit = $quest->exam_time_limit;
        $groupId = $quest->group_id;
      }
      if(count($ifAGroupMember) > 0 && count($scores) == 0){
        return view('exams/takeExam',['groups'=>$groups,'questions'=>$questions,'time_limit'=>$time_limit,'examId'=>$examId,
        'groupId'=>$groupId,'true_false'=>count($true_false),'multiple_choice'=>count($multiple_choice),'identification'=>count($identification)]);
      }
      else if(count($ifAGroupMember) > 0 && count($scores) > 0){
        return redirect()->action('PagesController@group_specific', [$groupId]);
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
      $scores = new Scores;
      $scores->exam_id = $examId;
      $scores->user_id = Auth::user()->id;
      $scores->score = $score;
      $scores->total = $total;
      $scores->save();

      return redirect()->action('PagesController@group_specific', [$groupId]);

    }
    public function showScore(Request $requests){
      $arr = explode('?',$requests->fullUrl());
      $score = Scores::where('user_id','=',Auth::user()->id)->where('exam_id','=',$arr[1])->get();
      if(count($score) > 0){
        foreach($score as $sc){
          echo 'You Score ' . $sc->score . '/'.$sc->total;
        }
      }
      else{
        Session::flash('flash_message','No score for you with that exam.');
        Session::flash('type_message','danger');

        return redirect('home');
      }
    }

}
