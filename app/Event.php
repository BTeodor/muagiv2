<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $table = 'event';

    protected $fillable = ['title', 'event_link', 'image_link', 'start_time', 'end_time', 'description', 'channel_id', 'relative_image_link', 'start_time_string', 'end_time_string'];

    public function channel(){
    	return $this->belongsTo('App\Channels');
    }

    public function products(){
    	return $this->belongsToMany('App\Products', 'event_product', 'event_id', 'product_id')->withPivot('product_id');
    }
}
