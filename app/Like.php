<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    //relación many to one
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    //relación many to one
    public function image(){
        return $this->belongsTo('App\Image', 'image_id');
    }
}
