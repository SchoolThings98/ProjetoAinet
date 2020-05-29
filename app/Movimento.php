<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movimento extends Model
{

	use SoftDeletes;
	public function conta(){
		return $this->belongTo('App\Conta','conta_id','id');
	}


	//este caso e diferente pois para funcionar como indicado na tebela
	// de relacionamentos trocamos a ordem e o em vez de o movimeto ter
	//hasOne('App\Categoria') fica belongsTo('App\Categoria') e o
	//categoria fica com o hasMany;

    public function categoriaRef(){

    	return $this->belongsTo('App\Categoria', 'categoria_id', 'id');
    }

/*    public function getUpdatedAtColumn() {
        return null;
    }*/


    public $timestamps = false;
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
