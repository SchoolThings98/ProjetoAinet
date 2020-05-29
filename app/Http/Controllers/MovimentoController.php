<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movimento;
use App\Categoria;
use App\User;
use App\Http\Requests\UpdateMovimento;
use Auth;
use App\Conta;
use Storage;

class MovimentoController extends Controller
{

    
	public function index(Request $request)
	{

        $categoria = $request->categoria ?? '';
        $conta = $request->conta ?? '';

        $qry = Movimento::where('id','>=','0');

        if($conta){
            $qry->where('conta_id',$request->query('conta'));
        }
        if($categoria){
            $qry->where('categoria_id',$request->query('categoria'));
        }
        if($request->has('tipo')){
            $qry->where('tipo',$request->query('tipo'));
        }
        $contas = Conta::where('user_id',Auth::user()->id)->pluck('id','nome');
        $categorias = Categoria::pluck('id', 'nome');
    	$todosMovimentos = $qry->paginate(30);
        return view('movimentos.index')->with('movimentos',$todosMovimentos)
                                       ->withContas($contas)
                                       ->withCategorias($categorias)
                                       ->withSelectedCategoria($categoria)
                                       ->withSelectedConta($conta);

	}

    public function create(Conta $conta){
        $novoMovimento = new Movimento;
        $categorias = Categoria::pluck('nome', 'id');
        return view('movimentos.create')->withMovimento($novoMovimento)
                                        ->withCategorias($categorias)
                                        ->withConta($conta);
    }

    public function edit(Movimento $movimento)
    {
        $categorias = Categoria::pluck('nome', 'id');
        return view('movimentos.edit')->withMovimento($movimento)
                                      ->withCategorias($categorias);
    }

    public function store(UpdateMovimento $request, Conta $conta){
        $validated_data = $request->validated();
        $movimento = new Movimento;
        $movimento->conta_id = $conta->id; 
        $movimento->data = $validated_data['data'];
        $movimento->valor = $validated_data['valor'];
        $movimento->saldo_inicial = $conta->saldo_atual;
        $movimento->saldo_final = $validated_data['tipo'] == 'R' ? $conta->saldo_atual + $validated_data['valor'] : $conta->saldo_atual - $validated_data['valor'];
        $conta->saldo_atual = $movimento->saldo_final;
        $movimento->tipo = $validated_data['tipo'];
        $movimento->categoria_id = $validated_data['categoria_id'];
        $movimento->descricao = $validated_data['descricao'];
        $movimento->save();
        return redirect()->route('contas');
    }

    public function update(UpdateMovimento $request, Movimento $movimento){
        $validated_data = $request->validated();
        $movimento->data = $validated_data['data'];
        $movimento->valor = $validated_data['valor'];
        $movimento->tipo = $validated_data['tipo'];
        $movimento->categoria_id = $validated_data['categoria_id'];
        $movimento->descricao = $validated_data['descricao'];
        $path = $validated_data['imagem_doc']->store('/doc');
        $movimento->imagem_doc = $path;
        $movimento->save();
        return redirect()->route('contas');
    }

    public function displayDoc(Movimento $movimento)
    {
        if ( isset($movimento->imagem_doc) ) {
            return Storage::disk('local')->response("docs/" . $movimento->imagem_doc);
        }else{
            return response('Ficheiro não encontrado');
        }
    }


/*
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
    }*/
}

