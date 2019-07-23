<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Configuracao;

class ConfiguracaoController extends Controller
{
    public function configuracao(){
        $configuracao = Configuracao::find(1);
        return view('configuracao.index',compact('configuracao'));
    }

    public function editar(){
        $configuracao = Configuracao::find(1);
        return view('configuracao.editar',compact('configuracao'));
    }

    public function salvar(Request $request){
        $configuracao = Configuracao::find(1);
        $configuracao->taxa_servico = request('taxa_servico');

        $save = $configuracao->save();
        if($save){
            \Session::flash('mensagem', ['msg'=>'Configuração salva com sucesso', 'class'=>'success']);
            return redirect()->route('configuracao');
        }else{
            \Session::flash('mensagem', ['msg'=>'Erro ao salvar configurações!', 'class'=>'danger']);
            return redirect()->back();
        }
    }
}
