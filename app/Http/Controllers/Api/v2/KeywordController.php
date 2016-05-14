<?php

namespace App\Http\Controllers\Api\v2;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;
use DB;
class KeywordController extends Controller
{
    //
    public function index(){
    	$json_keyword = json_encode(DB::table('keyword')->get());
    	echo $json_keyword;
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
