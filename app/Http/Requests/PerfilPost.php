<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerfilPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'NIF' => 'required|integer|min:100000000|max:999999999',
            'telefone' => 'required|string|min:6|max:15'            
        ];
    }

     public function messages()
    {
        return [
            'name.required' => 'Tem de inserir um nome',
            'email.required' => 'Tem de inserir um email',
            'NIF.requiered' => 'Tem de inserir NIF',
            'NIF.integer' => 'NIF so pode ter numeros',
            'telefone.requiered' => 'Tem de inserir u numero de telefone'
        ];

    }
}
