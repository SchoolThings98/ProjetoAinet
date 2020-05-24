<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Conta;
use App\Http\Requests\ContaPost;

class ContaController extends Controller
{
    public function index(Request $request)
    {

    	$qry = Conta::where('id','>=','0');
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

    public function store(ContaPost $request){
    	$validated_data = $request->validated();
    	$conta= new Conta;
        $conta->nome = $validated_data['nome'];
        $conta->saldo_abertura = $validated_data['saldo_abertura'];
        $conta->save();
        return redirect()->route('contas');

    	
    }


    public function update(ContaPost $request, Conta $conta){
    	$validated_data = $request->validated();
    	$conta->nome = $validated_data['nome'];
        $conta->saldo_abertura = $validated_data['saldo_abertura'];
        $conta->save();
        return redirect()->route('contas');

    }
}