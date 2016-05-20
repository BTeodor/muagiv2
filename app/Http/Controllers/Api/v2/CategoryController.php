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

    public function indexProduct($id){
        $category = App\Category::find($id);
        if ($category == NULL || count($category->products) == 0) {
            return response()->json([
                'status' => false,
                'data' => ['message' => 'Empty']
            ]);
        }

        $products = collect($category->products)->sortByDesc('updated_at');
        $array = array();
        foreach ($products as $product) {
            $item = collect($product)->merge(['stream_link' => NULL]);
            array_push($array, $item);
        }

        return response()->json([
            'status' => true,
            'data' => $array
        ]);
    }

    public function indexOnAirProduct($id){
        $category = App\Category::find($id);
        if ($category == NULL || count($category->products) == 0) {
            return response()->json([
                'status' => false,
                'data' => ['message' => 'Empty']
            ]);
        }

        $clock = new App\ExternalClasses\MyClock();
        $today = $clock->get_today_date_GMT_7("Y-m-d");
        $query_schedule = App\Schedule::query()->where('start_date', '=', $today);
        $query_schedule->whereIn('product_id', function($q) use ($id){
            $q->select('product_id')->from('category_product')->where('category_id', $id);
        });

        $schedule = $query_schedule->orderBy('start_time', 'asc')->get();
        if (count($schedule) == 0) {
            return response()->json([
                'status' => false,
                'data' => ['message' => 'Empty']
            ]);
        }
        $array = array();
        foreach ($schedule as $item) {
            $data = ['product_id' => $item->product_id, 'title' => $item->product()->title, 'channel_id' => $item->product()->channel_id, 'image_link' => $item->product()->image_link, 'video_link' => $item->product()->video_link, 'product_link' => $item->product()->product_link, 'description' => $item->product()->description, 'old_price' => $item->product()->old_price, 'new_price' => $item->product()->new_price, 'start_time' => $item->start_time, 'end_time' => $item->end_time, 'stream_link' => $item->stream_link];
            array_push($array, $data);
        }

        return response()->json([
            'status' => true,
            'data' => $array
        ]);
    }
}
