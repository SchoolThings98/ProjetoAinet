<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMovimento extends FormRequest
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
            'data' => 'required|date_format:"Y-m-d"|before_or_equal:today',
            'valor' => 'required|numeric',
            'tipo' => 'required|in:D,R',
            'categoria_id' => 'nullable',
            'imagem_doc'=>'nullable',
            'descricao' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'data.required' => 'Preecha o camp Data',
            'data.date_format' => 'Formato do campo Data inválido',
            'data.before_or_equal' => 'Preencha o campo Data com uma data igual ou inferior a hoje',
            'valor.required' => 'Preencha o campo Valor',
            'tipo.required' => 'Preencha o campo Tipo',
            'tipo.in' => 'Insira um tipo válido'

        ];

    }
}
