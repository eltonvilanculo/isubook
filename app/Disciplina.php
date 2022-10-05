<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    //
    protected $guarded = ['id'];

    public function precedencias() {
        return $this->hasMany('App\Precedencia','prec_id','id');
    }
}