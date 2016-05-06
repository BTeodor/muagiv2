<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ChannelController extends Controller
{
    //
	public function index(){
		$edit = true;
		$user = \Auth::user();
		$channel = $user->channel()->get();
		return view('dashboard.channel.channel', compact('edit', 'user', 'channel'));
	}
}
