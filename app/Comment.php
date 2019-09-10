<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    //relación Many to one
    public function user(){
        return $this->belongsTo('App\User', 'user_id');  
    }

    //relación Many to one
    public function images(){
        return $this->belongsTo('App\Image', 'image_id');  
    }
}
