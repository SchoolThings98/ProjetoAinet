<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movimento;
use App\Categoria;
use App\User;
use App\Http\Requests\UpdateMovimento;
use Auth;
use App\Conta;

class MovimentoController extends Controller
{

	public function index(Request $request)
	{
        $conta_id = $request->conta_id;
        $qry = Movimento::query();
        $qry->where('conta_id',$conta_id);
        $contas = Conta::where('user_id',Auth::user()->id);
    	$todosMovimentos = $qry->paginate(30);
        return view('movimentos.index')->with('movimentos',$todosMovimentos)->with('contas', $contas);

	}

    public function create(){
        $validated_data = $request->validated();
        $movimento->data = $validated_data['data'];
        $movimento->valor = $validated_data['valor'];
        $movimento->tipo = $validated_data['tipo'];
        $movimento->categoria_id = $validated_data['categoria_id'];
        $movimento->descricao = $validated_data['descricao'];
        $movimento->save();
        return redirect()->route('movimentos');
        //return view('movimentos.create')->withMovimento($movimento);
    }

    public function edit(Movimento $movimento)
    {

        return view('movimentos.edit')->withMovimento($movimento);   
    }

    public function store(MovimentoPost $request){
        $validated_data = $request->validated();
        $movimento->data = $validated_data['data'];
        $movimento->valor = $validated_data['valor'];
        $movimento->tipo = $validated_data['tipo'];
        $movimento->categoria_id = $validated_data['categoria_id'];
        $movimento->descricao = $validated_data['descricao'];
        $movimento->save();
        return redirect()->route('movimentos');
    }

    public function update(UpdateMovimento $request, Movimento $movimento){
        $validated_data = $request->validated();
        $movimento->data = $validated_data['data'];
        $movimento->valor = $validated_data['valor'];
        $movimento->tipo = $validated_data['tipo'];
        $movimento->categoria_id = $validated_data['categoria_id'];
        $movimento->descricao = $validated_data['descricao'];
        $movimento->save();
        return redirect()->route('movimentos');
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

