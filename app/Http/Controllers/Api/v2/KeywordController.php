<?php

namespace App\Http\Controllers\Api\v2;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;
use DB;
use Illuminate\Support\Facades\Input;
class KeywordController extends Controller
{
    //
    public function index(){
        if (Input::get('term') != "") {
            $array = array();
            $search = Input::get('term');
            $keywords = DB::table('keyword')->where('keyword', 'like', "%{$search}%")->get();
            foreach ($keywords as $key) {
                array_push($array, $key->keyword);
            }
            return json_encode($array);
        }
    	$json_keyword = json_encode(DB::table('keyword')->get());
    	return $json_keyword;
    }

    public function autocomplete(){
    	$array = array();
    	$keywords = App\Keyword::all();
    	if ($keywords != NULL) {
	    	foreach ($keywords as $keyword) {
	    		array_push($array, $keyword->keyword);
	    	}
	    	echo json_encode($array);
    	}
    }
}
