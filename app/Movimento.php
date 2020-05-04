<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimento extends Model
{
    
	//Use SoftDelete;
	public function conta(){
		return $this->belongTo('App\Conta');
	}

    public function categoria(){

    	return $this->hasOne('App\Categoria');
    }
}
