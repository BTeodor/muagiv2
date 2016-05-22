<?php

namespace App\Http\Controllers\Api\v2;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;
use App\ExternalClasses\MyClock;

class ScheduleController extends Controller
{

    /**
     * Determine if a product is on-air
     */
    function item_type($start_time, $end_time, $current_time){
        if ($current_time < $start_time) {
            return 1;
        }
        elseif ($current_time >= $start_time && $current_time <= $end_time) {
            return 0;
        }
        else return -1;
    }

    /**
     * Return broadcasting schedule
     */
    public function index(){
        $clock = new MyClock();
        $today = $clock->get_today_date_GMT_7("Y-m-d");
        $current_gmt7_time = $clock->get_current_time_GMT_7("H:i");
        $utc_time_mark = $clock->get_unix_time_UTC_from_GMT_7("00:00", $today);
        $utc_current_time = $clock->get_unix_time_UTC_from_GMT_7($current_gmt7_time, $today);
        $array = array();

        $schedules = App\Schedule::where('start_time', '>=', $utc_time_mark)->orderBy('start_time', 'asc')->get();

        if ($schedules == NULL) {
            return response()->json([
                'status' => false,
                'data' => ['message' => 'Empty']
            ]);
        }

        foreach ($schedules as $schedule) {
            $product_id = $schedule->product_id;
            $product = App\Products::withTrashed()->where('id', $product_id)->first();
            if ($product != NULL && $product->deleted_at == NULL) {
                $item_type = $this->item_type($schedule->start_time, $schedule->end_time, $utc_current_time);
                $item = ['id' => $schedule->product_id, 'title' => $product->title, 'channel_id' => $product->channel_id, 'image_link' => $product->image_link, 'video_link' => $product->video_link, 'product_link' => $product->product_link, 'description' => $product->description, 'old_price' => $product->old_price, 'new_price' => $product->new_price, 'start_time' => $schedule->start_time, 'end_time' => $schedule->end_time, 'stream_link' => $schedule->stream_link, 'item_type' => $item_type];
                if ($item_type != -1) {
                    array_push($array, $item);
                }
            }
        }

        return response()->json($array);
    }

    /**
     * index all schedule in one day, not care about on-air or off-air product
     */
    public function indexAll(){
        $clock = new MyClock();
        $today = $clock->get_today_date_GMT_7("Y-m-d");
        $current_gmt7_time = $clock->get_current_time_GMT_7("H:i");
        $utc_time_mark = $clock->get_unix_time_UTC_from_GMT_7("00:00", $today);
        $utc_current_time = $clock->get_unix_time_UTC_from_GMT_7($current_gmt7_time, $today);
        $array = array();

        $schedules = App\Schedule::where('start_time', '>=', $utc_time_mark)->orderBy('start_time', 'asc')->get();

        if ($schedules == NULL) {
            return response()->json([
                'status' => false,
                'data' => ['message' => 'Empty']
            ]);
        }

        foreach ($schedules as $schedule) {
            $product_id = $schedule->product_id;
            $product = App\Products::find($product_id);
            $item = ['id' => $schedule->product_id, 'title' => $product->title, 'channel_id' => $product->channel_id, 'image_link' => $product->image_link, 'video_link' => $product->video_link, 'product_link' => $product->product_link, 'description' => $product->description, 'old_price' => $product->old_price, 'new_price' => $product->new_price, 'start_time' => $schedule->start_time, 'end_time' => $schedule->end_time, 'stream_link' => $schedule->stream_link];
            array_push($array, $item);
        }

        return response()->json($array);
    }
}
