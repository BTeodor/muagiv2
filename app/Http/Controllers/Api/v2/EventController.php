<?php

namespace App\Http\Controllers\Api\v2;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;
use DB;
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

    /**
	 * Find event by id
     * @param $request 
     */
    public function findEventById(Request $request){
    	if (!isset($request->event_id)) {
    		return response()->json([
    			'status' => false,
    			'data' => ['message' => 'Error']
    		]);
    	}
    	$event_id = $request->event_id;
    	if(count(App\Event::find($event_id)) == 0) 
    		return response()->json([
    			'status' => false,
    			'data' => ['message' => 'Event id not found']
    		]);
    	$event = App\Event::find($event_id);
    	return response()->json([
    		'status' => true,
    		'data' => $event
    	]);
    }

    /**
     * Return all events
     * @param $request
     */
    public function index(){
    	$events = App\Event::orderBy('updated_at', 'desc')->get();

    	if (count($events) == 0) {
    		return response()->json([
    			'status' => false,
    			'data' => []
    		]);
    	}
		return response()->json([
			'status' => true,
			'data' => $events
		]);
    }

    /**
     * Return all products in one event
     */
    public function listProducts(Request $request){
        $event_id = $request->event_id;
        $event = App\Event::find($event_id);
        if(count($event) == 0 || count($event->products) == 0)
            return response()->json([
                'status' => false,
                'data' => ['message' => 'Event not found or there is no product in this event']
            ]);
        $list_id = array();
        foreach ($event->products as $product) {
            array_push($list_id, $product->pivot->product_id);
        }

        $data = array();
        foreach ($list_id as $product_id) {
            array_push($data, collect(App\Products::find($product_id))->merge(['stream_link' => NULL]));
        }
        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }
}
