<?php

namespace App\Http\Controllers\WebUser;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class UserController extends Controller
{
	public function getLogin(){
		return view('webuser.login');
	}



	public function getRegister(){
		return view('webuser.register');
	}
}
