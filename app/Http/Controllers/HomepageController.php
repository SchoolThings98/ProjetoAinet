<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Conta;
use App\Movimento;

class HomepageController extends Controller
{
    public function index()
    {

    	
    	$numeroUtilizadores = User::count();
    	$numeroContas = Conta::count();
		$numeroMovimentos = Movimento::count();
        return view('homepage.index',compact('numeroUtilizadores', 'numeroContas','numeroMovimentos'));
        //return view('welcome');
    }
}
