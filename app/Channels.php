<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Channels extends Model
{
    //
    use SoftDeletes;

    protected $table = 'channels';
    protected $dates = ['deleted_at'];
    // protected $dateFormat = 'U';
    protected $fillable = ['name', 'logo', 'homepage', 'hotline', 'description', 'relative_logo_link', 'user_id'];

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
}
