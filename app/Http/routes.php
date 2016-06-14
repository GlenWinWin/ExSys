<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::post('exam/question', 'ExamsController@createExam');
Route::post('exam/take_exam', 'ExamsController@takeExam');
Route::post('exam/submit_exam', 'ExamsController@submitExam');
Route::post('group/create_group', 'GroupController@createGroup');
Route::post('group/join_group', 'GroupController@joinGroup');
Route::post('group/delete_group', 'GroupController@deleteGroup');
Route::post('group/update_group', 'GroupController@updateSpecificGroup');
Route::post('group/view_group', 'GroupController@viewGroup');
Route::post('group/view_group_student', 'GroupController@viewGroupStudent');
Route::post('group/view_progress', 'ProgressController@checkExamsProgress');
Route::post('exam/add_exam_group', 'ExamsController@createExamInfo');

Route::get('trial',[
  'middleware' => 'auth',
  'uses' => 'ExamsController@updateScore'
]);
Route::get('home',[
  'middleware' => 'auth',
  'uses' => 'PagesController@home'
]);
Route::get('groups',[
  'middleware' => 'auth',
  'uses' => 'PagesController@groups'
]);
Route::get('specific_group',[
	'middleware' => 'auth',
  'uses' => 'PagesController@specific_group'
]);
Route::get('my_progress',[
	'middleware' => 'auth',
  'uses' => 'ProgressController@view_progress'
]);
Route::get('show_progress',[
	'middleware' => 'auth',
  'uses' => 'ProgressController@viewProgress'
]);
Route::get('notification',[
	'middleware' => 'auth',
  'uses' => 'NotificationsController@notif'
]);
Route::get('count_notif',[
	'middleware' => 'auth',
  'uses' => 'NotificationsController@countNotif'
]);
Route::get('update_notification',[
	'middleware' => 'auth',
  'uses' => 'NotificationsController@updateNotif'
]);
Route::get('update_iftaken',[
	'middleware' => 'auth',
  'uses' => 'ExamsController@ifTaken'
]);
Route::get('take_exam',[
	'middleware' => 'auth',
  'uses' => 'ExamsController@takeYourExam'
]);
Route::get('update_exam',[
	'middleware' => 'auth',
  'uses' => 'ExamsController@updateYourExam'
]);
Route::get('view_results',[
	'middleware' => 'auth',
  'uses' => 'ExamsController@viewtheResult'
]);
Route::get('show_score',[
	'middleware' => 'auth',
  'uses' => 'ExamsController@showScore'
]);
Route::get('group_specific',[
	'middleware' => 'auth',
  'uses' => 'PagesController@group_specific'
]);
Route::get('add_exam_info',[
	'middleware' => 'auth',
  'uses' => 'ExamsController@addInfoExam'
]);
Route::get('show_score',[
	'middleware' => 'auth',
  'uses' => 'ExamsController@showScore'
]);
Route::get('preview_exam',[
	'middleware' => 'auth',
  'uses' => 'ExamsController@preview'
]);
Route::get('login',function(){
	if(Auth::check()){
		return redirect('home');
	}
	else{
		return view('auth.login');
	}
});
Route::get('pdf', function(){

        Fpdf::AddPage();
        Fpdf::SetFont('Arial','B',16);
        Fpdf::Cell(40,10,'Hello World!');
        Fpdf::Output();
        exit;

});
Route::get('logout','UsersController@logout');
Route::resource('users','UsersController',['only' => ['store','destroy']]);
Route::resource('product','ProductController');
Route::resource('exam','ExamsController');
Route::resource('group','GroupController');
//Route::get('product/{id}/destroy',['uses'=>'ProductController@destroy']);
