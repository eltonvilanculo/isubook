<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    //

    protected $guarded = ['id'];

    public function centrals(){

        return $this->hasMany(Central::class);
    }

}
