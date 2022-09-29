<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    //
    protected $guarded = ['id'];

    function route(){
        return $this->belongsTo('App\Route','route_id');
    }


}