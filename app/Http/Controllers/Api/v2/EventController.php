<?php

namespace App\Http\Controllers\Api\v2;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;
class EventController extends Controller
{
    //
    public function listByChannelId(Request $request){
    	if (!isset($request->channel_id)) {
    		return response()->json([
    			'status' => false,
    			'data' => ['message' => 'Error']
    		]);
    	}
    	$channel_id = $request->channel_id;
    	if(empty(App\Channels::find($channel_id))) 
    		return response()->json([
    			'status' => false,
    			'data' => ['message' => 'Channel id not found']
    		]);
    	$events = App\Event::where('channel_id', $channel_id)->get();

    	if (count($events->toArray()) == 0) {
    		return response()->json([
    			'status' => false,
    			'data' => ['message' => 'Empty']
    		]);
    	}

    	return response()->json([
    		'status' => true,
    		'data' => $events
    	]);

    }
}
