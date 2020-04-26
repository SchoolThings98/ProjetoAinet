<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function contas(){
    	return $this->belongsToMany('App\Conta','autorizacoes_contas');
    	//incompleto falta colocar as chaves
    }
}
