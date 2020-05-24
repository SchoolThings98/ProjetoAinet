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
        /*if($request->has('name')){
            $qry->where('name','like','%'.$request->query('name').'%');
        }
        if($request->has('email')){
            $qry->where('email',$request->query('email'));  
        }*/

        /*if (request()->query('tipo')) {
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
        $this->authorize('create', Movimento::class);
        $pagetitle = "Adicionar movimento";

        return view('movimentos.create', compact('pagetitle'));
    }

    public function edit($id)
    {
        $this->authorize('update', Movimento::findOrFail($id));
        $pagetitle = "Editar Movimento";
        $movimento = Movimento::findOrFail($id);

        return view('movimentos.edit', compact('pagetitle'));   
    }

     public function destroy($id)
    {
        $this->authorize('delete', Movimento::findOrFail($id));
        Movimento::destroy($id);
        return redirect()->action('MovimentoController@index')->with('status', 'Movimento eliminado com sucesso!');
    }

    public function confirmarMovimento(Request $request, $id)
    {
        $this->authorize('confirmar', Movimento::findOrFail($id));
        $movimentoModel = Movimento::findOrFail($id);
        $movimentoModel['confirmado'] = '1';
        $movimentoModel->save();
        return redirect()->action('MovimentoController@index')->with('status', 'Movimento confirmado com sucesso!');
    }
}

