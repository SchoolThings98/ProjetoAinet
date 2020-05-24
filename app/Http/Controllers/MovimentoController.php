<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movimento;
use App\Categoria;
use App\User;




class MovimentoController extends Controller
{

	public function index(Request $request)
	{

        $qry = Movimento::where('id','>=','0');

        //$user1 = $user->name;
    	/*if($request->has('name')){
    		$qry->where('name','like','%'.$request->query('name').'%');
    	}
    	if($request->has('email')){
    		$qry->where('email',$request->query('email'));	
    	}*/
        /*
        if (request()->query('tipo')) {
            $movimentos = $movimentos->where('tipo', '=', 'D');
        }
        if (request()->query('tipo')) {
            $movimentos = $movimentos->where('tipo', '=','R');
        }
        if(request()->query('confirmado') == '1'){
            $movimentos = $movimentos->where('confirmado', '=', '1');
        }
        if(request()->query('confirmado') == '0'){
            $movimentos = $movimentos->where('confirmado', '=', '0');
        }*/

    	/* if($request->has('nome')){
            $categoria = Categoria::where('nome', $request->query('nome'));
    		// $qry->where('categoria_id',$categoria->id());
    	} */
    	/* if($request->has('tipo','>=','D')){
    		$qry->where('tipo','like','%'.$request->query('tipo').'%');
    	} */
    	$todosMovimentos = $qry->paginate(30);
        return view('movimentos.index')->with('movimentos',$todosMovimentos);

	}

    public function create(){


        return view('movimentos.create');
    }


}

