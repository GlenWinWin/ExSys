<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications;
use App\Http\Requests;
use DB;
use Auth;
use Session;
use App\Members;
use App\Groups;

class ProgressController extends Controller
{
  public function checkExamsProgress(Request $requests){
    return redirect()->action('ProgressController@view_progress', [$requests->groupId]);
  }
  public function viewProgress(Request $requests){
    $checkIfHasmember = Members::where('group_id','=',$requests->groupId)->where('typeOfUser','=','1')->get();
    $notifications = Notifications::where('id','=',[Auth::user()->id])->orderBy('notif_id','desc')->get();
    $groups = Groups::where('prof_id', '=', Auth::user()->id)->get();

    if(count($checkIfHasmember) > 0){
      $members = DB::select('select u.name as "Name" , u.profile_path as "Pic", round(avg(s.percentage)) as "Average" from scores s inner join users u on s.user_id = u.id inner join exams e on s.exam_id = e.exam_id where e.group_id = ? group by u.id order by round(avg(s.percentage)) desc',[$requests->groupId]);

      if(count($members) > 0){
        return view('progress.viewProgress',['groups'=>$groups, 'notifs'=>count($notifications), 'members' => $members]);
      }
      else{
        echo 'No exams yet professor';
      }
    }
    else{
      Session::flash('flash_message','No Students Yet!');
      Session::flash('type_message','info');
      return redirect()->back();
    }
  }
  public function view_progress(Request $requests){
		$notifications = Notifications::where('id','=',[Auth::user()->id])->orderBy('notif_id','desc')->get();
		$arr = explode('?',$requests->fullUrl());
		$scores = DB::select('select exam_name,percentage from scores natural join exams where group_id = ? and user_id = ?',[$arr[1],Auth::user()->id]);
		if(count($scores) > 0){
			$group_student = DB::select('select group_id,group_name FROM group_members NATURAL JOIN groups WHERE user_id = ?',[Auth::user()->id]);
			return view('progress.checkmyprogress')->with('groups',$group_student)->with('scores',$scores)->with('notifs',count($notifications));
		}
		else{
			Session::flash('flash_message','That is not your exam!!');
			Session::flash('type_message','info');
			return redirect('home');
		}

	}

}
