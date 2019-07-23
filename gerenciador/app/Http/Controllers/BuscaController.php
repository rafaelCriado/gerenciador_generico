<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Franquia;
use App\Download;
use App\Categoria;

class BuscaController extends Controller
{
    public function index(Request $request){
        $query = $request->all();

        $dados['usuarios'] = $this->consultaUsuario($query['q']);
        $dados['franquias'] = $this->consultaFranquia($query['q']);
        $dados['download'] = $this->consultaDownload($query['q']);
        $dados['categorias'] = $this->consultaCategoria($query['q']);
        //dd($dados['categorias']);
        return view('busca.index', compact('query','dados'));
    }


    private function consultaUsuario($query){
        //Auth
        if(!auth()->user()->can('usuario_listar')){
            return;
        }

        return User::where('name', 'LIKE', '%'.$query.'%')->orWhere('email', $query)->get();
    }

    private function consultaFranquia($query){
        //Auth
        if(!auth()->user()->can('franquia_listar')){
            return;
        }

        return Franquia::where('nome_fantasia', 'LIKE', '%'.$query.'%')
                     ->orWhere('email', $query)
                     ->orWhere('razao_social', 'LIKE', '%'.$query.'%')
                     ->orWhere('apelido', 'LIKE', '%'.$query.'%')
                     ->orWhere('endereco_cidade', 'LIKE', '%'.$query.'%')
                     ->get();
    }

    private function consultaDownload($query){
        //Auth
        if(!auth()->user()->can('download_listar')){
            return;
        }

        return Download::where('nome', 'LIKE', '%'.$query.'%')
                     ->orWhere('tipo', 'LIKE', '%'.$query.'%')
                     ->orWhere('descricao', 'LIKE', '%'.$query.'%')
                     ->get();
    }

    private function consultaCategoria($query){
        //Auth
        if(!auth()->user()->can('download_listar')){
            return;
        }

        return Categoria::where('nome', 'LIKE', '%'.$query.'%')->get();
        
    }
}
