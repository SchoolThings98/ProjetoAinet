<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserPost;
use App\Http\Requests\PerfilPost;

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

    public function update(UserPost $request,User $user){
        $validated_data = $request->validated();
        $user->bloqueado = $validated_data['bloqueado'];
        $user->adm = $validated_data['adm'];
        $user->save();
        return redirect()->route('users')
                    ->with('alert-msg', 'User "' . $user->name . '" foi alterado com sucesso!')
                    ->with('alert-type', 'success');
    }

    public function perfil(){
        return view('users.perfil');
    }

    public function update_perfil(PerfilPost $request, User $user){
        $validated_data = $request->validated();
        $user->name = $validated_data['name'];
        $user->email = $validated_data['email'];
        $user->NIF = $validated_data['NIF'];
        $user->telefone = $validated_data['telefone'];
        $user->save();
        return redirect()->route('homepage');
    }

}
