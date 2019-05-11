<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Comment extends Model
{
    protected $table='comment';
    function user(){
    	return $this->belongsTo('App\User','idUser','id');
    }
}
