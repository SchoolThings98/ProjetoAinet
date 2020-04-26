<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    
    public function movimentos(){
    	return $this->hasMany('App\Movimento');
    }

    public function users(){
    	return $this->belongsToMany('App\User','autorizacoes_contas');
    	//incompleto falta colocar as chaves
    }

}
