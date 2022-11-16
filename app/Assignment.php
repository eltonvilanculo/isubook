<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    //
    protected $fillable = [
        'worker_id', 'travel_id','start_at','end_at'
    ];

    public function worker()
    {
        return $this->belongsTo('App\Worker');
    }
    public function travel()
    {
        return $this->belongsTo('App\Travel');
    }

}
