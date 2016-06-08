<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Notifications;
use App\User;
use Auth;
use DB;

class NotificationsController extends Controller
{
    public function notif(){
      $notifications = Notifications::where('id','=',[Auth::user()->id])->orderBy('notif_id','desc')->get();
      $messages = array();
      $names = array();
      $profile_paths = array();
      foreach($notifications as $notif){
        $userDetails = User::where('id','=',$notif->fromUser)->get();
        $name='';
        $prof_path='';
        foreach($userDetails as $user){
          $name = $user->name;
          $prof_path = $user->profile_path;
        }
        array_push($messages,$notif->notif_message);
        array_push($names,$name);
        array_push($profile_paths,$prof_path);
      }
      if(count($notifications) > 0){
        return view('notifs.notification')
        ->with('messages',$messages)
        ->with('names',$names)
        ->with('prof_pics',$profile_paths);
      }
    }
    public function countNotif(){
      $notifications = DB::select('select name from notifications natural join users where id = ? and has_read = 0 order by notif_id desc',[Auth::user()->id]);
      $notifs = count($notifications) > 0 ? count($notifications) : '';
      return $notifs;
    }
    public function updateNotif(){
      $update_notif = Notifications::where('id','=',Auth::user()->id)->update(['has_read'=>'1']);
    }
}
