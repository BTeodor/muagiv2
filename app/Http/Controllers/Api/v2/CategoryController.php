<?php

namespace App\Http\Controllers\Api\v2;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;

class CategoryController extends Controller
{
    //
    public function index(){
    	$categories = App\Category::all();

    	if ($categories == NULL) {
    		return response()->json([
    			'status' => false,
    			'data' => ['message' => "Empty"]
    		]);
    	}
		return response()->json([
			'status' => true,
			'data' => $categories
		]);
    }
}
