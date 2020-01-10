<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormRequestAnimais extends FormRequest
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
            'nome' => 'required|max:30',
            'peso' => 'required',
            'altura' => 'required',            
            'raca' =>  'required|max:40',
            'situacao_medica' => 'required|max:100',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo [Nome] é obrigatório',
            'nome.max' => 'O campo [Nome] tem tamanho máximo de 30 caracteres',
            'peso.required' => 'O campo [Peso] é obrigatório',            
            'altura.required' => 'O campo [Altura] é obrigatório',            
            'raca.required' => 'O campo [Raça] é obrigatório',
            'raca.max' => 'O campo [Raça] tem tamanho máximo de 40 caracteres',
            'situacao_medica.required' => 'O campo [Situação médica] é obrigatório',
            'situacao_medica.max' => 'O campo [Situação médica] tem tamanho máximo de 100 caracteres',
        ];
    }
}
