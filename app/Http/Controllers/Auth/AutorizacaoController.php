<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Autorizacao;
use Auth;

class UserController extends Controller
{
     public function index(Request $request)
    {

    	$qry = User::where('user_id','>=','0');
    	if($request->has('name')){
    		$qry->where('name','like','%'.$request->query('name').'%');

    	}
    	if($request->has('email')){
    		$qry->where('email','like','%'.$request->query('email').'%');
    	}
        if($request->has('bloqueado')){
            $qry->where('bloqueado',$request->query('bloqueado'));
        }
        return view('users.index')->with('users');
    }