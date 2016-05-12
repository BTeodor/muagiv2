<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories';

    protected $fillable = ['name', 'name_vi', 'name_en', 'description', 'image'];

    public function products(){
    	return $this->belongsToMany('App\Products', 'category_product', 'category_id', 'product_id')->withPivot('product_id');
    }
}
