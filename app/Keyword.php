<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    //
    protected $table = 'keyword';

    protected $fillable = ['keyword', 'updated_at', 'created_at'];
}
