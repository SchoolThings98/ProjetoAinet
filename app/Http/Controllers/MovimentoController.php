<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movimento;
use App\Categoria;



class MovimentoController extends Controller
{

	public function index(Request $request)
	{$qry = Movimento::where('id','>=','0');
    	/* if($request->has('nome')){
            $categoria = Categoria::where('nome', $request->query('nome'));
    		// $qry->where('categoria_id',$categoria->id());
    	} */
    	/* if($request->has('tipo','>=','D')){
    		$qry->where('tipo','like','%'.$request->query('tipo').'%');
    	} */
    	$todosMovimentos = $qry->paginate(30);
        return view(
            'movimentos.index')->with('movimentos',$todosMovimentos);

	}


}

