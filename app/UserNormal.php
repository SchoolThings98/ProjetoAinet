<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNormal extends Model
{
     public function user(){
    	return $this->belongsTo('App\User');
    }

   	public function users(){
    	return $this->belongsToMany('App\Conta','autorizacoes_contas');
    	//incompleto falta colocar as chaves
    }

}
