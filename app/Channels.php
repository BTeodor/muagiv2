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
    protected $fillable = ['name', 'logo', 'homepage', 'hotline', 'description'];

    public function products(){
    	return $this->hasMany('App\Products', 'channel_id');
    }

    public function getAllProducts(){
    	return $this->hasMany('App\AllProduct', 'channel_id');
    }
}
