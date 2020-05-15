<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Movimento;


class MovimentoController extends Controller
{

	public function index(Request $request)
	{
		$qry = Movimento::where('id','>=','0');
    	/*if($request->has('name')){
    		$qry->where('name','like','%'.$request->query('name').'%');
    	}
    	if($request->has('email')){
    		$qry->where('email',$request->query('email'));	
    	}*/
    	$todosMovimentos = $qry->paginate(10);
        return view(
            'movimentos.index')->with('movimentos',$todosMovimentos);

	}


}

