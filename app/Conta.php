<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conta extends Model
{
	use SoftDeletes;
    
    public function movimentos(){
    	return $this->hasMany('App\Movimento','conta_id','id');
    }
        
    public $timestamps = false;


	public function user(){
    	return $this->belongsToMany('App\User','autorizacoes_contas','conta_id','user_id');
    	//incompleto falta colocar as chaves
    }

}
