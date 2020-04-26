<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
	//movimentos_c =/= da funçao movimetos do Modelo Conta
    public function movimentos_c(){
    	return $this->belongsToMany('App\Movimento');
    }
}
