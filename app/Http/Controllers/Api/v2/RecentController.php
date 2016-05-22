<?php

namespace App\Http\Controllers\Api\v2;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;

class RecentController extends Controller
{
    //
    public function create(Request $request){
    	if (!isset($request->user_id) || !isset($request->product_id)) {
    		return response()->json([
    			'status' => false,
    			'data' => ['message' => 'Not found any user_id or product_id']
    		]);
    	}
        $user = App\User::find($request->user_id);

        if ($user == NULL) {
            return response()->json([
                'status' => false,
                'data' => ['message' => 'User not found']
            ]);
        }
        if(!App\Products::find($request->product_id)) 
            return response()->json([
                'status' => false,
                'data' => [
                    'message' => 'Product not found'
                ]
            ], 404);

    	try{
    		$user->watch_recent()->attach($request->product_id);
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
    		'data' => ['message' => 'Added to watch_recent list']
    	]);
    }

    public function delete(Request $request){
    	if (!isset($request->user_id) || !isset($request->product_id)) {
    		return response()->json([
    			'status' => false,
    			'data' => ['message' => 'Not found any user_id or product_id']
    		]);
    	}
        
        $user = App\User::find($request->user_id);
        if ($user == NULL) {
            return response()->json([
                'status' => false,
                'data' => ['message' => 'User not found']
            ]);
        }
        if(!App\Products::find($request->product_id)) 
            return response()->json([
                'status' => false,
                'data' => [
                    'message' => 'Product not found'
                ]
            ], 404);

    	try{
    		$user->watch_recent()->detach($request->product_id);
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
    		'data' => ['message' => 'Removed from watch_recent list']
    	]);
    }

    public function index(Request $request){
        if (!isset($request->user_id)) {
            return response()->json([
                'status' => false,
                'data' => ['message' => 'Not found any user_id or product_id']
            ]);
        }

        $user = App\User::find($request->user_id);
        if ($user == NULL) {
            return response()->json([
                'status' => false,
                'data' => ['message' => 'User not found']
            ]);
        }
        if(count($user->watch_recent) == 0) 
	        return response()->json([
	        	'status' => false,
	        	'data' => ['message' => 'Empty']
	        ]);

	    $data = array();
	    foreach ($user->watch_recent as $record) {
	    	$product_id = $record->pivot->product_id;
            $product = App\Products::where('id', $product_id)->first();
            array_push($data, collect($product)->merge(['stream_link' => NULL]));
	    }

    	return response()->json([
    		'status' => true,
    		'data' => $data
    	]);


    }
}
