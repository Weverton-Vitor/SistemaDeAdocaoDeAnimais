<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormRequestDadosPedidoAdocao extends FormRequest
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
            'nome_adotante' => 'required|max:40',
            'cpf_adotante' => 'required|max:14',
            'telefone_adotante' => 'required|max:11',
            'email_adotante' => 'required|max:50',
            'cidade' => 'required|max:70',
            'cep' => 'required|max:9',
            'bairro' => 'required|max:70',
            'rua' => 'required|max:70',
            'numero_casa' => 'required|max:3'
        ];
    }

    public function messages()
    {
        return [
            'nome_adotante.required' => 'O campo [Nome] é obrigatório',
            'nome_adotante.max' => 'O campo [Nome] tem tamanho máximo de 40 caracteres',
            'cpf_adotante.required' => 'O campo [CPF] é obrigatório',            
            'cpf_adotante.max' => 'O campo [CPF] tem tamanho máximo de 14 caracteres', 
            'telefone_adotante.required' => 'O campo [Telefone] é obrigatório',
            'telefone_adotante.max' => 'O campo [Telefone] tem tamanho máximo de 11 caracteres',
            'email_adotante.required' => 'O campo [Email] é obrigatório',
            'email_adotante.max' => 'O campo [Email] tem tamanho máximo de 50 caracteres',
            'cidade.required' => 'O campo [Cidade] é obrigatório',
            'cidade.max' => 'O campo [Cidade] tem tamanho máximo de 70 caracteres',
            'cep.required' => 'O campo [CEP] é obrigatório',
            'cep.max' => 'O campo [CEP] tem tamanho máximo de 9 caracteres',
            'bairro.required' => 'O campo [Bairro] é obrigatório',
            'bairro.max' => 'O campo [Bairro] tem tamanho máximo de 70 caracteres',
            'rua.required' => 'O campo [Rua] é obrigatório',
            'rua.max' => 'O campo [Rua] tem tamanho máximo de 70 caracteres',
            'numero_casa.required' => 'O campo [Nº da casa] é obrigatório',
            'numero_casa.max' => 'O campo [Nº da casa] tem tamanho máximo de 3 caracteres',
        ];
    }
}
