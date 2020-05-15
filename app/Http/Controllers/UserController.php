<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


class UserController extends Controller
{
     public function index(Request $request)
    {

    	$qry = User::where('id','>=','0');
    	if($request->has('name')){
    		$qry->where('name','like','%'.$request->query('name').'%');
    	}
    	if($request->has('email')){
    		$qry->where('email',$request->query('email'));	
    	}
    	$todosUtilizadores = $qry->paginate(10);
        return view(
            'users.index')->with('users',$todosUtilizadores);
    }

}
