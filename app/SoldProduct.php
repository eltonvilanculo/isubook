<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoldProduct extends Model
{
    protected $fillable = [
        'sale_id', 'product_id', 'qty', 'return_at'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    public function sale()
    {
        return $this->belongsTo('App\Sale');
    }
}
