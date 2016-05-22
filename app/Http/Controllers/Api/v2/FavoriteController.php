<?php

namespace App\Http\Controllers\Api\v2;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;

class FavoriteController extends Controller
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

    public function index(Request $request){

        if (!isset($request->user_id)) {
            return response()->json([
                'status' => false,
                'data' => ['message' => 'Not found user_id or product_id']
            ]);
        }

        $user = App\User::find($request->user_id);
        if ($user == NULL) {
            return response()->json([
                'status' => false,
                'data' => ['message' => 'Not found user_id or product_id']
            ]);
        }

        if(count($user->favorite) == 0) 
	        return response()->json([
	        	'status' => false,
	        	'data' => ['message' => 'Empty']
	        ]);

	    $data = array();
	    foreach (($user->favorite) as $record) {
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
