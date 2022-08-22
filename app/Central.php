<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Central extends Model
{
    //
    protected $guarded = ['id'];

    public function province(){

        return $this->belongsTo(Provinces::class);

    }
}
