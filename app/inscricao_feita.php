<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inscricao_feita extends Model
{
    //
    protected $fillable = ['estado','inscricao_id','disciplina_id'];

    public function disciplina() {
        return $this->belongsTo('App\Disciplina');
    }
}