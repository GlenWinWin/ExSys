<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Auth;
use Validator;
use Session;

class UsersController extends Controller
{
    public function store(Request $requests){
        $inputs = $requests->all();

    	$validator = Validator::make(
            array(
                'email' => $requests->email,
                'password' => $requests->password
            ),
            array(
                'email' => 'required|email',
                'password' => 'required'
            ),
            array(
                'email.required' => 'Email is mandatory !',
                'password.required' => 'Password is necessary !'
            )
        );

        if($validator->passes()){
          $attempt = Auth::attempt([
            'email' => $requests->email,
            'password' => $requests->password,
          ]);
          if($attempt){
            Session::flash('flash_message','Login Successfully');
            Session::flash('type_message','success');

            return redirect('home');
          }
          else{
            Session::flash('flash_message','Credentials Invalid');
            Session::flash('type_message','danger');

            return redirect('login')->withInput();

          }
        }
        else{
            return view('auth.login')->withErrors($validator,'errors');

        }
    }
    public function logout(){
      Auth::logout();

      Session::flash('flash_message','You have been logout');
      Session::flash('type_message','info');

      return redirect('login');

    }
    public function makeAdmin(){
    	return 'Admin';
    }
}
