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
    	if(empty($product)) return reponse()->json(["description" => "<p>Not Available</p>"]);
    	else return reponse()->json(["description" => $product->description]);
    }

    public function searchByProductName(Request $request){
    	if (isset($request->keyword)) {
            $clock = new MyClock();
            $today = $clock->get_today_date_GMT_7("Y-m-d");
    		$keyword = $request->keyword;
    		$products = Products::where('start_date', $today)->where('title', 'LIKE', '%'.$keyword.'%')->get(array('id','title', 'video_link', 'product_link', 'image_link', 'channel_id', 'old_price', 'new_price', 'start_time', 'end_time', 'available_time', 'start_date'));
    		if (count($products) > 0) {
    			return response()->json([
    				'status' => 200,
    				'data' => $products
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
        $channel = $product->channel;
        $event = $product->event;

        return response()->json([
            'status' => true,
            'data' => [
                'product' => $product,
                'channel' => $channel,
                'event' => $event
            ]
        ]);
        return view('dashboard.channel.product.show', compact('product', 'channel', 'event'));
    }
}
