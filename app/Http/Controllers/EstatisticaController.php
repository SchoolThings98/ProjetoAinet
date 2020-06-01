<?php

namespace App\Http\Controllers;

use Auth;
use App\Conta;
use App\Movimento;
use Illuminate\Http\Request;

class EstatisticaController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request){
        $primeriadata = $request->data1;
        $segundadata = $request->data2;
        $saldototal = Conta::where('user_id', Auth::user()->id)
                                    ->sum('saldo_atual');
    	$qry = Conta::where('user_id',Auth::user()->id);
    	$todasAsContas = $qry->get();
      $movimentos = Movimento::whereBetween('data', [$primeriadata, $segundadata]);
        foreach ($qry as $conta) {
            $percentagem += $conta->saldo_atual;
        }
        if ($request->tipo == 'R') {
            $movimentos->where('tipo', 'R');

        }elseif($request->tipo == 'D'){
            $movimentos->where('tipo', 'D');
        }

        $todosmovimentos = $movimentos->paginate(10);
      /*  $mes = Movimento::whereMonth('data', '01')->get();
       $receita = 0;
       $despesa = 0;
       $contador = 0;
       dd($mes);
       foreach ($mes as $movimento) {
            $receita += Movimento::where('tipo', 'R')->count();
            $despesa += Movimento::where('tipo', 'D')->count();
            $contador += 1;
        }
        $mediaR = $receita/$contador;
        $mediaD = $despesa/$contador; */
        //return view('estatisticas.index',compact('contas', 'saldo_total','numeroMovimentos'));
        return view('estatisticas.index')
            ->with('contas',$todasAsContas)
            ->with('saldo_total', $saldototal)
            ->with('todosmovimentos', $todosmovimentos)
            // ->with('mediaR', $mediaR)
            // ->with('mediaD', $mediaD)
            ->with('primeiradata', $primeriadata)
            ->with('segundadata', $segundadata);
    }
}
