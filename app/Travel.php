<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    //
    protected $guarded = ['id'];

    public function train() {
        return $this->belongsTo('App\Train');
    }

    public function workers() {
        return $this->hasMany('App\Assignment');
    }
    public function worker() {
        return $this->belongsTo('App\Worker');
    }

}
