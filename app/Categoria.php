<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{

	//Use SoftDelete;
	//movimentos_c != da funçao movimetos do Modelo Conta
    public function movimentos(){
    	return $this->hasMany('App\Movimento', 'categoria_id', 'id');
    }
}
