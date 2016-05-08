<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateEventRequest;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    //
	protected $channel;

	

    public function create(CreateEventRequest $request){
		if (($request->file('logo')) != NULL) {
			$desPath = "upload/channel/event";
			$imageName = $this->user->id . '.' . $request->file('logo')->getClientOriginalExtension();
			$request->file('logo')->move($desPath, $imageName);
			$image_path = '/upload/channel/event' . $imageName;
			$image_full_path = \URL::to('/') . $image_path;
		}
		else {
			$image_path = '/assets/img/profile.png';
			$image_full_path = \URL::to('/') . $image_path;
		}
    	$data = [
    		'title' => $request->title,
    		'event_link' => $request->event_link,
    		'start_time' => $request->start_time,
    		'end_time' => $request->end_time,
    		'description' => $request->description,
    		'image_link' => $request->image_link
    	];

    	var_dump($data);
    }
}
