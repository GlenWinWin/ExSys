<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Groups;
use App\Notifications;
use App\Scores;
use App\Members;
use Validator;
use Session;
use Auth;
use DB;


class GroupController extends Controller
{
  public function index(){
    return redirect('groups');
  }
  public function createGroup(Request $requests){
    $groupName = $requests->group_name;
    $groupCode = $requests->groupCode;

        $group = new Groups;
        $group->group_name = $groupName;
        $group->group_passCode = $groupCode;
        $group->prof_id = Auth::user()->id;
        $group->save();

        $group_query = Groups::where('prof_id','=',Auth::user()->id)->orderBy('group_id','desc')->first();

        $group_members = new Members;
        $group_members->group_id = $group_query->group_id;
        $group_members->user_id = Auth::user()->id;
        $group_members->typeOfUser = 2;
        $group_members->save();

        Session::flash('flash_message','Group ' . $groupName . ' has been created.');
        Session::flash('type_message','success');

        return redirect('groups');
  }
  public function deleteGroup(Request $requests){
    $deleteGroupId = $requests->groupId;
    $deletedGroupName = $requests->deletedGroupName;
    $deletedRows =  Groups::where('group_id', '=', $deleteGroupId)->delete();
    $deletedMembers =  Members::where('group_id', '=', $deleteGroupId)->delete();
    Session::flash('flash_message',$deletedGroupName . ' has been deleted.');
    Session::flash('type_message','success');

    return redirect('groups');
  }
  public function viewGroup(Request $requests){
    return redirect()->action('PagesController@specific_group', [$requests->groupId]);
  }
  public function viewGroupStudent(Request $requests){
    return redirect()->action('PagesController@group_specific', [$requests->groupId]);
  }
  public function joinGroup(Request $requests){
    $selectGroup =  Groups::where('group_passCode','=',trim($requests->group_Code))->first();
    if(count($selectGroup) == 0){
      Session::flash('flash_message','Mismatch Passcode!!');
			Session::flash('type_message','success');
      
      return redirect('home');
    }
    else{
      $group_student = DB::select('select group_id,group_name FROM group_members NATURAL JOIN groups WHERE user_id = ? and group_id = ?',[Auth::user()->id,$selectGroup->group_id]);
      if(count($group_student) == 1){
        return redirect()->action('PagesController@group_specific', [$selectGroup->group_id]);
      }
      else{
        $group_members = new Members;
        $group_members->group_id = $selectGroup->group_id;
        $group_members->user_id = Auth::user()->id;
        $group_members->typeOfUser = 1;
        $group_members->save();

        $exams = DB::select('select e.exam_id as "exam_id", count(q.question) as "total" from exams e inner join questions q on e.exam_id = q.exam_id where e.group_id = ? group by e.exam_id',[$selectGroup->group_id]);
        foreach ($exams as $exam) {
          $scores = new Scores;
          $scores->exam_id = $exam->exam_id;
          $scores->user_id = Auth::user()->id;
          $scores->score = 0;
          $scores->total = $exam->total;
          $scores->ifTaken = 0;
          $scores->percentage = 0;
          $scores->save();
        }
        $addNotification = new Notifications;
        $addNotification->id = $selectGroup->prof_id;
        $addNotification->fromUser = Auth::user()->id;
        $addNotification->has_read = '0';
        $addNotification->notif_message = Auth::user()->name . " joined to your group " . $selectGroup->group_name . ".";
        $addNotification->save();

        return redirect()->action('PagesController@group_specific', [$selectGroup->group_id]);
      }
    }
  }
}
