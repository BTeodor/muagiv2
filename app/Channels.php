<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App;

class Channels extends Model
{
    //
    use SoftDeletes;

    protected $table = 'channels';
    protected $dates = ['deleted_at'];
    // protected $dateFormat = 'U';
    protected $fillable = ['name', 'logo', 'homepage', 'hotline', 'description', 'relative_logo_link', 'user_id', 'maximum_no_hot_product'];

    public function products(){
    	return $this->hasMany('App\Products', 'channel_id');
    }

    public function getAllProducts(){
    	return $this->hasMany('App\AllProduct', 'channel_id');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function event(){
        return $this->hasMany('App\Event', 'channel_id');
    }

    public static function findIdByName($channel_name){
        $channel = App\Channels::where('name', 'like', "%{$channel_name}%")->orWhere('logo', 'like', "%{$channel_name}%")->orWhere('homepage', 'like', "%{$channel_name}%")->first();
        if ($channel == NULL) {
            return -1;
        }
        return $channel->id;
    }

    public function maximum_no_hot_product(){
        return $this->maximum_no_hot_product;
    }

    public function current_no_hot_product(){
        $count = App\Products::where('channel_id', $this->id)->where('is_hot', 1)->count();
        return $count;
    }

    public function countProduct(){
        return $this->products->count();
    }
}
