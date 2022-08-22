<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'client_id', 'user_id','return_at','return_status'
    ];
    public function client() {
        return $this->belongsTo('App\User');
    }
    public function transactions() {
        return $this->hasMany('App\Transaction');
    }
    public function products() {
        return $this->hasMany('App\SoldProduct');
    }
    public function user() {
        return $this->belongsTo('App\User');
    }
}
