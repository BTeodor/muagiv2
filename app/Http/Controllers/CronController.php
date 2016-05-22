<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;

class CronController extends Controller
{
    /**
     * Get code of scj product from item_code
     */
    public function normalizeCode($code_string){
        if (strpos($code_string, "2016")) {
            $code_string = str_replace("2016", "", $code_string);
        }
        if (strpos($code_string, "2011")) {
            $code_string = str_replace("2011", "", $code_string);
        }
        if (strpos($code_string, "2012")) {
            $code_string = str_replace("2012", "", $code_string);
        }
        if (strpos($code_string, "2013")) {
            $code_string = str_replace("2013", "", $code_string);
        }
        if (strpos($code_string, "2014")) {
            $code_string = str_replace("2014", "", $code_string);
        }
        if (strpos($code_string, "2015")) {
            $code_string = str_replace("2015", "", $code_string);
        }
        if (strpos($code_string, "2017")) {
            $code_string = str_replace("2017", "", $code_string);
        }

        return $code_string;
    }
    /**
     * Cron function to get schedule of broadcasting products on www.scj.vn
     * @param No param
     * create product if not exist and add time to schedule table
     */
    public function run(){
        $clock = new App\ExternalClasses\MyClock();
        $today = $clock->get_today_date_GMT_7("Y-m-d");
        $tomorrow = $clock->get_nextday_date_GMT_7("Y-m-d");

        $baseURL = 'http://www.scj.vn';
        $mobileURL = 'http://www.m.scj.vn/#/detail/';
        $API_URL = "http://www.scj.vn/index.php?option=com_broadcasting&task=getEvent&lang=vi&type=day&start=".$today."&end=".$tomorrow;
        $json = file_get_contents($API_URL);
        $responses = json_decode($json);
        $start_date = $today;
        $array = array();
        $description = "";

        foreach ($responses as $product) {

            /* For product */
            $channel_id = App\Channels::findIdByName("scj");
            $title = $product->product_name;
            $image_link = $product->ori_url;
            $old_price = $product->marketprice;
            $new_price = $product->basic_price;
            $video_link = NULL;
            $scj_code = $product->item_code;
            $scj_code = $this->normalizeCode($scj_code);
            $product_link = $mobileURL.trim($scj_code);
            $auto_link = $product_link;

            $product_detail = ['title' => $title, 'channel_id' => $channel_id];
            $new_product = App\Products::firstOrCreate($product_detail);
            $new_product->update(['image_link' => $image_link, 'product_link' => $product_link, 'old_price' => $old_price, 'new_price' => $new_price, 'auto_link' => $auto_link]);
            if (empty($new_product->video_link)) {
                $new_product->update(['video_link' => $video_link]);
            }

            /* For schedule */
            $product_id = $new_product->id;
            $stream_link = "rtmp://vtsstr6.sctv.vn/colive/C037_SD_2";
            $available_time = $product->scjtime;
            list($start_time_string, $end_time_string) = explode("-", $available_time);
            $start_time = $clock->get_unix_time_UTC_from_GMT_7($start_time_string, $start_date);
            $end_time = $clock->get_unix_time_UTC_from_GMT_7($end_time_string, $start_date);

            $schedule_detail = ['product_id' => $product_id, 'available_time' => $available_time, 'start_date' => $start_date, 'start_time' => $start_time, 'end_time' => $end_time, 'start_time_string' => $start_time_string, 'end_time_string' => $end_time_string];
            $new_schedule = App\Schedule::firstOrCreate($schedule_detail);
            if (empty($new_schedule->stream_link)) {
                $new_schedule->update(['stream_link' => $stream_link]);
            }

            $data = ['id' => $new_product->id, 'title' => $title, 'channel_id' => $channel_id, 'image_link' => $image_link, 'video_link' => $video_link, 'product_link' => $product_link, 'description' => $description, 'old_price' => $old_price, 'new_price' => $new_price, 'start_time' => $start_time, 'end_time' => $end_time];

            array_push($array, $data);
        }
        return response()->json($array);
    }
}
