<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContaPost extends FormRequest
{

    use SoftDeletes;
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
            'nome'=> 'required|string|max:20',
            'saldo_abertura'=> 'required|numeric',
            'descricao' => 'nullable|string',
            'email' => 'sometimes|email|exists:users,email'
        ];
    }
}
