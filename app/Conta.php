<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{

    //Use SoftDelete;
    public function movimentos(){
    	return $this->hasMany('App\Movimento');
    }

    /*
    public function admin(){
    	return $this->belongsToMany('App\Admin','autorizacoes_contas','conta_id','user_id');
    	
    }

    public function userNormal(){
    	return $this->belongsToMany('App\UserNormal','autorizacoes_contas','conta_id','user_id');
    	
    }

	*/


	public function user(){
    	return $this->belongsToMany('App\User','autorizacoes_contas','conta_id','user_id');
    	//incompleto falta colocar as chaves
    }	
}
