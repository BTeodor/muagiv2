<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    //
    use SoftDeletes;

    protected $table = 'products';
    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'video_link', 'product_link', 'image_link', 'channel_id', 'old_price', 'new_price', 'description', 'start_time', 'end_time', 'available_time', 'start_date', 'relative_image_link'];

    public function channel(){
    	return $this->belongsTo('App\Channels', 'channel_id');
    }

    public function userLiked(){
    	return $this->belongsToMany('App\User', 'favorite', 'product_id', 'user_id')->withTimestamps()->withPivot('user_id');
    }

    public function userWatched(){
        return $this->belongsToMany('App\User', 'watch_recent', 'product_id', 'user_id')->withTimestamps()->withPivot('user_id');
    }

    public function categories(){
        return $this->belongsToMany('App\Category', 'category_product', 'product_id', 'category_id')->withPivot('category_id');
    }

    public function event(){
        return $this->belongsToMany('App\Event', 'event_product', 'product_id', 'event_id')->withPivot('event_id');
    }
}
