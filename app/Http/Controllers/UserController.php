<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Request\UserPost;

class UserController extends Controller
{
     public function index(Request $request)
    {

    	$qry = User::where('id','>=','0');
    	if($request->has('name')){
    		$qry->where('name','like','%'.$request->query('name').'%');
             
    	}
    	if($request->has('email')){
    		$qry->where('email','like','%'.$request->query('email').'%');	
    	}
        if($request->has('bloqueado')){
            $qry->where('bloqueado',$request->query('bloqueado'));
        }
    	$todosUtilizadores = $qry->paginate(10); 
        return view(
            'users.index')->with('users',$todosUtilizadores);
    }

    public function edit(User $user){

        return view('users.edit')
            ->withUser($user);
    }

    public function update(UserPost $request, User $user){

        return redirect()->route('users');
    }

}
