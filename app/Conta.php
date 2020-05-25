<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Conta extends Model
{

    
    public function movimentos(){
    	return $this->hasMany('App\Movimento','conta_id','id');
    }
        
    public $timestamps = false;


	public function user(){
    	return $this->belongsToMany('App\User','autorizacoes_contas','conta_id','user_id');
    	//incompleto falta colocar as chaves
    }	
}
