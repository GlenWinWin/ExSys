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
Route::get('makeAdmin','UsersController@makeAdmin');
Route::group(['prefix' => 'product','prefix'=>'exam'] ,function(){
	Route::get('all',[
		'uses' => 'ProductController@index'
	]);
});
Route::post('exam/question', 'ExamsController@createExam');
Route::post('exam/take_exam', 'ExamsController@takeExam');
Route::post('exam/submit_exam', 'ExamsController@submitExam');
Route::post('group/create_group', 'GroupController@createGroup');
Route::post('group/join_group', 'GroupController@joinGroup');
Route::post('group/delete_group', 'GroupController@deleteGroup');
Route::post('group/view_group', 'GroupController@viewGroup');
Route::post('group/view_group_student', 'GroupController@viewGroupStudent');
Route::post('exam/add_exam_group', 'ExamsController@createExamInfo');


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
Route::get('take_exam',[
	'middleware' => 'auth',
  'uses' => 'ExamsController@takeYourExam'
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
Route::get('login',function(){
	if(Auth::check()){
		return redirect('home');
	}
	else{
		return view('auth.login');
	}
});
Route::get('logout','UsersController@logout');
Route::resource('users','UsersController',['only' => ['store','destroy']]);
Route::resource('product','ProductController');
Route::resource('exam','ExamsController');
Route::get('exam/redirect',['uses'=>'ExamsController@back']);
Route::resource('group','GroupController');
Route::get('product/{id}/destroy',['uses'=>'ProductController@destroy']);
