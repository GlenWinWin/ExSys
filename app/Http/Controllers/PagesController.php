<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Groups;
use App\Notifications;
use App\Scores;
use Session;
use App\Members;
use DB;
use App\Exam;
use App\User;

class PagesController extends Controller
{
	public function home(){
		$groups = Groups::where('prof_id', '=', Auth::user()->id)->get();
		$notifications = Notifications::where('id','=',[Auth::user()->id])->orderBy('notif_id','desc')->get();
		if(Auth::user()->typeOfUser == 1){
			$group_student = DB::select('select group_id,group_name FROM group_members NATURAL JOIN groups WHERE user_id = ?',[Auth::user()->id]);
			return view('pages.home_student')->with('groups',$group_student)->with('notifs',count($notifications));
		}
		else if(Auth::user()->typeOfUser == 2){
			return view('pages.home_prof')->with('groups',$groups)->with('notifs',count($notifications));
		}
		else{
			return view('pages.home_admin');
		}

	}
	// orderByRaw("RAND()")
	public function groups(){
		$notifications = Notifications::where('id','=',[Auth::user()->id])->orderBy('notif_id','desc')->get();
			$groups = Groups::where('prof_id', '=', Auth::user()->id)->get();
			return view('pages.groups')->with('groups',$groups)->with('notifs',count($notifications));
	}
	public function specific_group(Request $requests){
		$notifications = Notifications::where('id','=',[Auth::user()->id])->orderBy('notif_id','desc')->get();
		$arr = explode('?',$requests->fullUrl());
		$groups = Groups::where('prof_id', '=', Auth::user()->id)->get();
		$specific_group_count = Groups::where('group_id', '=', $arr[1])->where('prof_id', '=', Auth::user()->id)->count();
		$specific_group = Groups::where('group_id', '=', $arr[1])->where('prof_id', '=', Auth::user()->id)->first();
		$exams = Exam::where('group_id', '=', $arr[1])->get();
		$teachers = User::where('typeOfUser','=',2)->where('id','<>',Auth::user()->id)->get();
		$membersOfTheGroup = DB::table('users')
												->join('group_members','users.id','=','group_members.user_id')
												->select('users.name', 'users.profile_path', 'group_members.typeOfUser')
												->where('group_members.group_id','=',$arr[1])
												->orderBy('group_members.typeOfUser', 'desc')->get();
		if($specific_group_count == 1){
			return view('pages.specific_group')
			->with('groups',$groups)
			->with('groupName',$specific_group->group_name)
			->with('groupId',$specific_group->group_id)
			->with('exams',$exams)
			->with('notifs',count($notifications))
			->with('members',$membersOfTheGroup)
			->with('teachers',$teachers);
		}
		else{
			Session::flash('flash_message','You have not created that group!!');
			Session::flash('type_message','danger');

			return redirect()->back();
		}

	}
	public function group_specific(Request $requests){
		$arr = explode('?',$requests->fullUrl());
		$notifications = Notifications::where('id','=',[Auth::user()->id])->orderBy('notif_id','desc')->get();
		$groups = DB::select('select group_id,group_name FROM group_members NATURAL JOIN groups WHERE user_id = ?',[Auth::user()->id]);
		$specific_group_count = Groups::where('group_id', '=', $arr[1])->count();
		$specific_group = Groups::where('group_id', '=', $arr[1])->first();
		$exams = DB::select('select exam_id, group_id, exam_name,user_id,ifTaken,date_added from exams natural join scores where group_id = ? and user_id = ?',[$arr[1],Auth::user()->id]);
		$membersOfTheGroup = DB::table('users')
												->join('group_members','users.id','=','group_members.user_id')
												->select('users.name', 'users.profile_path', 'group_members.typeOfUser')
												->where('group_members.group_id','=',$arr[1])
												->orderBy('group_members.typeOfUser', 'desc')->get();
		if($specific_group_count == 1  && count($groups) > 0){
				return view('pages.group_student',['groups' => $groups,'groupName'=>$specific_group->group_name,
				'groupId'=>$specific_group->group_id,'exams'=>$exams,'notifs'=>count($notifications),'members'=>$membersOfTheGroup]);

		}
		else{
			Session::flash('flash_message','You are not belong to the group!!');
			Session::flash('type_message','danger');

			return redirect()->back();
		}

	}
}
