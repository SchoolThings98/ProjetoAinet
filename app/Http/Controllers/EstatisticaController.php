<?php

namespace App\Http\Controllers;

use App\Conta;
use Illuminate\Http\Request;
use Auth;

class EstatisticaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $saldototal = Conta::where('user_id', Auth::user()->id)->sum('saldo_atual');
    	$qry = Conta::where('user_id',Auth::user()->id);
    	$todasAsContas = $qry->paginate(10);
        foreach ($qry as $conta) {
            $percentagem += $conta->saldo_atual;

        }




        //return view('estatisticas.index',compact('contas', 'saldo_total','numeroMovimentos'));
        return view('estatisticas.index')
        ->with('contas',$todasAsContas)
        ->with('saldo_total', $saldototal);



    }
}
