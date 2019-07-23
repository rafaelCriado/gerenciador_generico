<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidoRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [ 
            'nome'  => 'required|string',     
            'cpf'   => 'required',   
            'placa' => 'required',   
            'uf'    => 'required',   
        ];
    }

    public function messages(){
        return [
            'nome.required'     => 'O nome é obrigatório!',
            'nome.string'       => 'Nome informado inválido!',
            'placa.required'    => 'O campo Placa/Renavam é obrigatório!',
            'cpf.required'      => 'O CPF é obrigatório',
            'uf.required'       => 'O Estado é obrigatório!',
        ];
    }
}