<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    //relación one to many
    public function comments(){
        return $this->hasMany('App\Comment');
    }

    //relación one to many
    public function likes(){
        return $this->hasMany('App\Like');
    }
    
    //relación many to one
    public function user(){
        return $this->belongsTo('App\User', 'usuario_id');
    }
}
