<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    //
    protected $table = 'schedule';
    protected $fillable = ['product_id', 'start_time', 'end_time', 'start_date', 'start_time_string', 'end_time_string', 'available_time'];

    public function product(){
    	$product = App\Products::find($this->product_id);
    	return $product;
    }
}
