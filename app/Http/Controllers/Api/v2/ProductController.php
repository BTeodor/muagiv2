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
    		$products = Products::where('title', 'like', "%{$keyword}%")->orWhere('json_keyword', 'like', "%{$keyword}%")->get();
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

    public function compare(Request $request){
        if ($request->has('product_id')) {
            $product_id = $request->only('product_id');
            $product = Products::withTrashed()->where('id', $product_id)->first();

            if ($product == NULL) {
                return response()->json([
                    'status' => false,
                    'data' => ['message' => "Product not found"]
                ]);
            }
            $keyword_string = $product->json_keyword;
            $title = $product->title;
            $array = array();
            // $item = collect($product)->merge(['from' => $product->channel->name, 'stream_link' => NULL]);
            // array_push($array, $item);

            if ($keyword_string != "") {
                $keyword_array = explode(",", $keyword_string);
                foreach ($keyword_array as $keyword) {
                    $products = Products::where('title', '<>', $title)->where('json_keyword', 'like', "%{$keyword}%")->get();
                    if($products->count() > 0) 
                        foreach ($products as $product) {
                            $channel_name = $product->channel->name;
                            $item = collect($product)->merge(['from' => $channel_name, 'stream_link' => NULL]);
                            if(!in_array($item, $array)) array_push($array, $item);
                        }
                }

                foreach ($keyword_array as $keyword) {
                    $products = Products::where('title', '<>', $title)->where('title', 'like', "%{$keyword}%")->get();
                    if($products->count() > 0) 
                        foreach ($products as $product) {
                            $channel_name = $product->channel->name;
                            $item = collect($product)->merge(['from' => $channel_name, 'stream_link' => NULL]);
                            if(!in_array($item, $array)) array_push($array, $item);
                        }
                }
            }
            else {
                // $title_array = preg_split('/\PL+/u', $title, -1, PREG_SPLIT_NO_EMPTY);
                // // return response()->json($title_array);
                // foreach ($title_array as $keyword) {
                //     if (strlen($keyword) >= 4) {
                //         $products = Products::where('title', '<>', $title)->where('json_keyword', 'like', "%{$keyword}%")->get();
                //         if($products->count() > 0) 
                //             foreach ($products as $product) {
                //                 $channel_name = $product->channel->name;
                //                 $item = collect($product)->merge(['from' => $channel_name, 'stream_link' => NULL]);
                //                 if(!in_array($item, $array)) array_push($array, $item);
                //             }
                //     }
                // }
            }

            if (count($array) == 0) {
                return response()->json([
                    'status' => false,
                    'data' => ['message' => "Not found any similar product"]
                ]);
            }
            return response()->json([
                'status' => true,
                'data' => $array
            ]);
        }
        return response()->json([
            'status' => false,
            'data' => ['message' => "Error"]
        ]);
    }
}
