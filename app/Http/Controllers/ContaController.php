<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Conta;
use App\Movimento;
use App\Categoria;  
use App\Http\Requests\ContaPost;
use Auth;


class ContaController extends Controller
{

	

    public function index(Request $request)
    {

    	$qry = Conta::where('user_id',Auth::user()->id);
    	$todasAsContas = $qry->paginate(10);
        return view('contas.index')->with('contas',$todasAsContas);
    }


    public function create(){

    	$novaConta = new Conta;
    	return view('contas.create')->withConta($novaConta);

    }

    public function edit(Conta $conta){

		return view('contas.edit')
            		->withConta($conta);
    }


    public function info(Request $request, Conta $conta){
        $categoria = $request->categoria ?? '';
        $qry = $conta->movimentos();

        if($request->categoria === "sem_categoria")  
            $qry->whereNull('categoria_id');
        elseif($request->categoria !== "todas") 
            $qry->where('categoria_id',$request->query('categoria'));;
        if($request->has('tipo')){
            $qry->where('tipo',$request->query('tipo'));
        }
        $categorias = Categoria::pluck('nome', 'id');
    	$movimentosConta = $qry->orderBy('data','desc')->paginate(10);
     	return view('contas.conta-info')->withConta($conta)
    									->with('movimentos', $movimentosConta)
                                        ->withCategorias($categorias)
                                        ->withSelectedCategoria($categoria);
        
    }

    public function store(ContaPost $request){
    	$validated_data = $request->validated();
    	$conta= new Conta;
        $conta->nome = $validated_data['nome'];
        $conta->saldo_abertura = $validated_data['saldo_abertura'];
        $conta->descricao = $validated_data['descricao'];
        $conta->saldo_atual = $validated_data['saldo_abertura'];
        $conta->user_id = Auth::user()->id;
        $conta->save();
        return redirect()->route('contas');

    	
    }


    public function update(ContaPost $request, Conta $conta){
    	$validated_data = $request->validated();
    	$conta->nome = $validated_data['nome'];
        $conta->saldo_abertura = $validated_data['saldo_abertura'];
        $conta->descricao = $validated_data['descricao'];
        $conta->save();
        return redirect()->route('contas');

    }


    public function destroy(Conta $conta){

    	$oldName = $conta->nome;
        try {
        	$todosMovimentos = Movimento::where('conta_id',$conta->id)->withTrashed()->delete();;
            $conta->delete();
            return redirect()->route('contas')
                ->with('alert-msg', 'Curso "' . $conta->nome . '" foi apagado com sucesso!')
                ->with('alert-type', 'success');
        } catch (\Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem
            //dd($th);

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('contas')
                    ->with('alert-msg', 'Não foi possível apagar a Conta "' . $oldName . '", porque este curso já está em uso!')
                    ->with('alert-type', 'danger');
            } else {
                return redirect()->route('contas')
                    ->with('alert-msg', 'Não foi possível apagar o Curso "' . $oldName . '". Erro: ' . $th->errorInfo[2])
                    ->with('alert-type', 'danger');
            }
        }

    }
}
