<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inscricao extends Model
{
    //

    protected $fillable = ['estudante_id','estado'];


    public function estudante() {
        return $this->belongsTo('App\Estudante');
    }

    public function matriculas() {
        return $this->hasMany('App\inscricao_feita');
    }

}
