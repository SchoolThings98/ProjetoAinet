<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Auth;

class UpdatePassword extends FormRequest
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
            'password_nova' => 'required|min:8|same:password_confirmada',
            'password_confirmada' => 'required',
            'password'=>  ['required', 
            function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    return $fail('Password Incorreta');
                }
                                }]
        ];
    }

     public function messages()
    {
        return [
            'password_nova.required' => 'Insira a password nova',
            'password_nova.min' => 'Password tem de ter no minimo 8 carateres',
            'password_nova.same' => 'Password nao coincide',
            'password_confirmada.required' => 'Tem de inserir a password de comfirmaçao'
        ];

    }
}
