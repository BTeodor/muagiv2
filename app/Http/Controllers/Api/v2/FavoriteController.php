<?php

namespace App\Http\Controllers\Api\v2;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;

class FavoriteController extends Controller
{
    //
    public function post(Request $request){
    	if (!isset($request->user_id) || !isset($request->product_id)) {
    		return Response::json([
    			'status' => false,
    			'data' => ['message' => 'Not found any user_id or product_id']
    		]);
    	}

    	if(!\Auth::check()) {
            return response()->json([
                'status' => false,
                'data' => [
                    'msg' => 'Don\'t have permisson'
                ]
            ], 403);
        }

        if(!App\Products::find($request->product_id)) 
            return response()->json([
                'status' => false,
                'data' => [
                    'message' => 'Product not found'
                ]
            ], 404);

    	$user = App\User::find($request->user_id);
    	try{
    		$user->favorite()->attach($request->product_id);
    	} catch(\Illuminate\Database\QueryException $e){
            return response()->json([
                'status' => false,
                'data' => [
                    'code' => $e->getCode(),
                    'message' => $e->errorInfo[2]
                ]
            ], 500);
    	}
    	return response()->json([
    		'status' => true,
    		'data' => ['message' => 'Liked']
    	]);
    }

    public function delete(Request $request){
    	if (!isset($request->user_id) || !isset($request->product_id)) {
    		return Response::json([
    			'status' => false,
    			'data' => ['message' => 'Not found any user_id or product_id']
    		]);
    	}

    	if(!\Auth::check()) {
            return response()->json([
                'status' => false,
                'data' => [
                    'msg' => 'Don\'t have permisson'
                ]
            ], 403);
        }

        if(!App\Products::find($request->product_id)) 
            return response()->json([
                'status' => false,
                'data' => [
                    'message' => 'Product not found'
                ]
            ], 404);
        
	    $user = App\User::find($request->user_id);

    	try{
    		$user->favorite()->detach($request->product_id);
    	} catch(\Illuminate\Database\QueryException $e){
            return response()->json([
                'status' => false,
                'data' => [
                    'code' => $e->getCode(),
                    'message' => $e->errorInfo[2]
                ]
            ], 500);
    	}
    	return response()->json([
    		'status' => true,
    		'data' => ['message' => 'Unliked']
    	]);
    }

    public function index(){
    	if(!\Auth::check()) {
            return response()->json([
                'status' => false,
                'data' => [
                    'msg' => 'Don\'t have permisson'
                ]
            ], 403);
        }
        $user = \Auth::user();

        if(count($user->favorite()->get()) == 0) 
	        return response()->json([
	        	'status' => false,
	        	'data' => ['message' => 'Empty']
	        ]);

	    $data = array();
	    foreach (($user->favorite()->get()) as $record) {
	    	$product_id = $record->pivot->product_id;
	    	array_push($data, App\Products::where('id', $product_id)->get(array('id','title', 'video_link', 'product_link', 'image_link', 'channel_id', 'old_price', 'new_price', 'start_time', 'end_time', 'available_time', 'start_date')));
	    }

    	return response()->json([
    		'status' => true,
    		'data' => $data
    	]);


    }
}
