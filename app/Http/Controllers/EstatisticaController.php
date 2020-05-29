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
        foreach ($qry as $conta) {
            $percentagem += $conta->saldo_atual;
        }
        $todosmovimentos = Movimento::whereBetween('data', [$primeriadata, $segundadata])
                            ->paginate(10);
        //return view('estatisticas.index',compact('contas', 'saldo_total','numeroMovimentos'));
        return view('estatisticas.index')
            ->with('contas',$todasAsContas)
            ->with('saldo_total', $saldototal)
            ->with('todosmovimentos', $todosmovimentos)
            ->with('primeiradata', $primeriadata)
            ->with('segundadata', $segundadata);
    }


}
