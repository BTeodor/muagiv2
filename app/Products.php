<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App;
class Products extends Model
{
    //
    use SoftDeletes;

    protected $table = 'products';
    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'video_link', 'product_link', 'image_link', 'channel_id', 'old_price', 'new_price', 'description', 'start_time', 'end_time', 'relative_image_link', 'auto_link', 'is_hot', 'json_keyword'];

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

    public function events(){
        return $this->belongsToMany('App\Event', 'event_product', 'product_id', 'event_id')->withPivot('event_id');
    }

    public function customPaginate($perPage, $search = null, $category = null){
        $query = App\Products::query();
        
        if ($category) {
            $list_id = DB::table('category_product')->where('category_id', $category)->lists('product_id');
            $query->whereIn('id', function($q){
                $q->select('product_id')->from('category_product')->where('category_id', $category);  
            });
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', "like", "%{$search}%");
                $q->orWhere('description', 'like', "%{$search}%");
            });
        }

        $result = $query->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }

    public function schedule(){
        $schedules = App\Schedule::where('product_id', $this->id)->get();
        return $schedules;
    }
    public function is_hot_item(){
        return $this->is_hot;
    }
}
