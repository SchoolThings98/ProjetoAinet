<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movimento;
use App\Categoria;
use App\User;
use App\Http\Requests\UpdateMovimento;
use Auth;
use App\Conta;
use Illuminate\Support\Facades\Storage;


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
        $movimento->tipo = $validated_data['tipo'];
        $movimento->categoria_id = $validated_data['categoria_id'];
        $movimento->descricao = $validated_data['descricao'];
        $data = $validated_data['data'];
        //$todosMovDatasParaAFrente = Movimento::where('data','>',$data)->orderBy('data', 'asc')->get();
        //dd($todosMovDatasParaAFrente);
        //$todosMovContaDatasParaAFrente= $todosMovDatasParaAFrente->where('conta_id', $conta->id);
        //$todosMovContaDatasParaAFrente = Movimento::where(['data','>',$data],['conta_id','=',$conta->id])->orderBy('data', 'asc')->get();
        $todosMovContaDatasParaAFrente = Movimento::where('data','>',$data)->where('conta_id',$conta->id)->orderBy('data', 'asc')->get();
        //dd($todosMovContaDatasParaAFrente->count());

        //rever o algoritmo

        if($todosMovContaDatasParaAFrente->count()==0){
            //dd("lista vazia");
            $saldo_final =$validated_data['tipo'] == 'R' ? $conta->saldo_atual + $validated_data['valor'] : $conta->saldo_atual - $validated_data['valor'];
            $movimento->saldo_inicial = $conta->saldo_atual;
            $movimento->saldo_final = $saldo_final;
            $conta->saldo_atual = $saldo_final;
            $conta->data_ultimo_movimento = $validated_data['data'];
            $movimento->save();
            $conta->save();
               
        }else{
            $movimentoAnterior = Movimento::where('conta_id',$conta->id)->where('data','<=',$data)->orderBy('data', 'desc')->first();
            //dd($movimentoAnterior);
            if($movimentoAnterior == null){
                $movimento->saldo_inicial = $conta->saldo_abertura;
                $movimento->saldo_final = $validated_data['tipo'] == 'R' ? $conta->saldo_abertura + $validated_data['valor'] : $conta->saldo_abertura - $validated_data['valor'];
                $movimento->save();
                $saldo_final;
                foreach($todosMovContaDatasParaAFrente as $mov){
                    $movAnteriorAosParaAlterar = Movimento::where('conta_id',$conta->id)->where('data','<=',$mov->data)->orderBy('data','desc')->orderBy('id','desc')->first();
                    //dd($movAnterior);
                    if($movAnteriorAosParaAlterar == null){
                            //$saldo_MovAnterior = $movAnterior->saldo_final;
                            $mov->saldo_inicial= $movimento->saldo_final;
                            $saldo_final = $mov->tipo == 'R' ? $movimento->saldo_final+ $mov->valor : $movimento->saldo_final - $mov->valor;
                            $mov->saldo_final = $saldo_final;
                            $conta->saldo_atual = $saldo_final;
                            $mov->save();
                            $conta->save();
                     }else{

                            $mov->saldo_inicial = $movAnteriorAosParaAlterar->saldo_final;
                            $saldo_final=  $mov->tipo == 'R' ? $movAnteriorAosParaAlterar->saldo_final+ $mov->valor : $movAnteriorAosParaAlterar->saldo_final - $mov->valor;
                            $mov->saldo_final = $saldo_final;
                            $conta->saldo_atual = $saldo_final;
                            $mov->save();
                            $conta->save();
                     }
                }
            }else{

                    $movMesmaData = Movimento::where('conta_id',$conta->id)->where('data','=',$data)->orderBy('id','desc')->first();

                    if($movMesmaData == null){
                        $movimento->saldo_inicial = $movimentoAnterior->saldo_final;
                        $movimento->saldo_final = $validated_data['tipo'] == 'R' ? $movimentoAnterior->saldo_final + $validated_data['valor'] : $movimentoAnterior->saldo_final - $validated_data['valor'];
                        $movimento->save();
                        $saldo_final;
                        foreach($todosMovContaDatasParaAFrente as $mov){
                            $movAnterior = Movimento::where('conta_id',$conta->id)->where('data','<',$mov->data)->orderBy('data','desc')->first();
                            //dd($movAnterior);
                            $saldo_MovAnterior = $movAnterior->saldo_final;
                            $mov->saldo_inicial= $saldo_MovAnterior;
                            $saldo_final = $mov->tipo == 'R' ? $movAnterior->saldo_final+ $mov->valor : $movAnterior->saldo_final - $mov->valor;
                            $mov->saldo_final = $saldo_final;
                            $conta->saldo_atual = $saldo_final;
                            $mov->save();
                            $conta->save();
                        } 



                    }else{
                        $movimento->saldo_inicial = $movMesmaData->saldo_final;
                        $movimento->saldo_final = $validated_data['tipo'] == 'R' ? $movMesmaData->saldo_final + $validated_data['valor'] : $movMesmaData->saldo_final - $validated_data['valor'];
                        $movimento->save();
                        $saldo_final;
                        foreach($todosMovContaDatasParaAFrente as $mov){
                            $movAnterior = Movimento::where('conta_id',$conta->id)->where('data','=',$mov->data)->orderBy('id','desc')->first();
                            //dd($movAnterior);
                            $saldo_MovAnterior = $movAnterior->saldo_final;
                            $mov->saldo_inicial= $saldo_MovAnterior;
                            $saldo_final = $mov->tipo == 'R' ? $movAnterior->saldo_final+ $mov->valor : $movAnterior->saldo_final - $mov->valor;
                            $mov->saldo_final = $saldo_final;
                            $conta->saldo_atual = $saldo_final;
                            $mov->save();
                            $conta->save();
                        } 
                    }
            }


        }

        

        return redirect()->route('contas');
    }

    public function update(UpdateMovimento $request, Movimento $movimento){
        $validated_data = $request->validated();
        $movimento->data = $validated_data['data'];
        $movimento->valor = $validated_data['valor'];
        $movimento->tipo = $validated_data['tipo'];
        $movimento->categoria_id = $validated_data['categoria_id'];
        $movimento->descricao = $validated_data['descricao'];
        $movimento->save();
        /*$path = $validated_data['imagem_doc']->store('/doc');
        $movimento->imagem_doc = $path;*/
        if ($request->hasFile('imagem_doc')) {
            $path = $request->foto->store('doc');
            $movimento->imagem_doc = basename($path);
        }
        
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

    public function destroy(Movimento $movimento){

        $oldId = $movimento->id;


        try {
            $movimento->delete();
            return redirect()->route('contas')
                ->with('alerta-msg', 'Movimento "' . $movimento->id . '" foi apagado com sucesso!')
                ->with('alerta-type', 'success');
        } catch (\Throwable $th) {
            // $th é a exceção lançada pelo sistema - por norma, erro ocorre no servidor BD MySQL
            // Descomentar a próxima linha para verificar qual a informação que a exceção tem
            //dd($th);

            if ($th->errorInfo[1] == 1451) {   // 1451 - MySQL Error number for "Cannot delete or update a parent row: a foreign key constraint fails (%s)"
                return redirect()->route('contas.info')
                    ->with('alerta-msg', 'Não foi possível apagar a movimento "' . $oldId . '", porque este curso já está em uso!')
                    ->with('alerta-type', 'danger');
            } else {
                return redirect()->route('contas.info')
                    ->with('alerta-msg', 'Não foi possível apagar o movimento "' . $oldId . '". Erro: ' . $th->errorInfo[2])
                    ->with('alerta-type', 'danger');
            }
        }

    }


     public function destroy_doc(Movimento $movimento)
    {
        Storage::delete('doc' . $movimento->imagem_doc);
        $movimento->imagem_doc = null;
        $movimento->save();
        return redirect()->route('movimentos.edit', ['movimento' => $movimento])
            ->with('alert-msg', 'Documento associado "' . $movimento->id . '" foi removido!')
            ->with('alert-type', 'success');
    }



}

