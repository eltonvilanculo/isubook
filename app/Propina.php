<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propina extends Model
{
    //
    protected $fillable = ['estudante_id','duracao','estado'];


    public function estudantes(){
        return $this->hasMany('App\Estudante');
    }
}
