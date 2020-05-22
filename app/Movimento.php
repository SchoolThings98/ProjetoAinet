<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimento extends Model
{
    
	//Use SoftDelete;
	public function conta(){
		return $this->belongTo('App\Conta');
	}


	//este caso e diferente pois para funcionar como indicado na tebela
	// de relacionamentos trocamos a ordem e o em vez de o movimeto ter
	//hasOne('App\Categoria') fica belongsTo('App\Categoria') e o 
	//categoria fica com o hasMany;

    public function categoria(){

    	return $this->belongsTo('App\Categoria');
    }

    public function tipoToString()
    {
    	switch ($this->tipo){
    		case 'D':
    			return 'Despesa';
    		case 'R':
    			return 'Receita';
    	}
    	return '';
    }

    
}
