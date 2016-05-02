<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AllProduct extends Model
{
    //
	use SoftDeletes;

    protected $table = 'all_products';
    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'video_link', 'product_link', 'image_link', 'channel_id', 'old_price', 'new_price', 'description'];

    public function channel(){
    	return $this->belongsTo('App\Channels', 'channel_id');
    }

}
