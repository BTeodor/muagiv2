<?php

namespace App\Http\Controllers\Api\v2;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Products;

class ProductController extends Controller
{
    //
    public function getDescription($id){
    	$product = Products::findOrFail($id);
    	if(empty($product)) return reponse()->json(["description" => "<p>Not Available</p>"]);
    	else return reponse()->json(["description" => $product->description]);
    }

    public function searchByProductName(Request $request){
    	$keyword = "";
    	if (isset($request->keyword)) {
    		$keyword = $request->keyword;
    	}
    	return response()->json([
    		'status' => true,
    		'data' => Products::where('title', 'LIKE', '%'.$keyword.'%')->get()
    	]);

    }
}
