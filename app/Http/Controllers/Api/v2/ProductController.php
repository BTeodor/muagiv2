<?php

namespace App\Http\Controllers\Api\v2;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Products;
use App\ExternalClasses\MyClock;

class ProductController extends Controller
{
    //
    public function getDescription($id){
    	$product = Products::findOrFail($id);
    	if(empty($product) || empty($product->description)) return reponse()->json(["description" => "<p>Not Available</p>"]);
    	else return reponse()->json(["description" => $product->description]);
    }

    public function searchByProductName(Request $request){
    	if (isset($request->keyword)) {
    		$keyword = $request->keyword;
    		$products = Products::where('title', 'like', "%{$keyword}%")->get();
    		if (count($products) > 0) {
                $array = array();
                foreach ($products as $product) {
                    array_push($array, collect($product)->merge(['stream_link' => NULL]));
                }
    			return response()->json([
    				'status' => 200,
    				'data' => $array
    			]);
    		}
    		return response()->json([
    			'status' => 404,
    			'data' => ['message' => 'Không tìm thấy sản phầm chứa từ khoá '.$keyword]
    		]);
    	}
    	return response()->json([
    		'status' => 404,
    		'data' => ['message' => 'The field keyword not found']
    	]);

    }

    public function showProduct($id){
        $product = Products::withTrashed()->where('id', $id)->first();
        if ($product == NULL) {
            return "Product does not exist";
        }
        $categories = $product->categories;
        $channel = $product->channel;
        $events = $product->events;

        return view('dashboard.channel.product.show', compact('product', 'channel', 'events', 'categories'));
    }

    public function hotItem(){
        $products = Products::where('is_hot', 1)->get();
        if (count($products) == 0) {
            return response()->json([
                'status' => false,
                'data' => ['message' => 'Empty']
            ]);
        }
        $array = array();
        foreach ($products as $product) {
            array_push($array, collect($product)->merge(['stream_link' => NULL]));
        }
        return response()->json([
            'status' => true,
            'data' => $array
        ]);
    }
}
