<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;


class UserPost extends FormRequest
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
            'bloqueado' => 'required|integer|in:0,1',
            'adm' => 'required|integer|in:0,1'
        ];
    }
}
