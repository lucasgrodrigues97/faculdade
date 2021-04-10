<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlunosFormRequest extends FormRequest
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
            'nome' => 'required|min:3',
            'cep' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome precisa ser preenchido',
            'nome.min' => 'O campo nome precisa ter no mínimo 3 caracteres',
            'cep.required' => 'O campo CEP precisa ser preenchido'
        ];
    }
}
