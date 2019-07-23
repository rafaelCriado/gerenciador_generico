<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Papel;
use App\Permissao;

class PapelController extends Controller
{
    //

    public function index(){
        //Auth
        if(!auth()->user()->can('papel_listar')){
            return redirect()->route('home');
        }

        $papels = Papel::all();
        return view('papel.index',  compact('papels'));
    }

    public function editar($id){
        //Auth
        if(!auth()->user()->can('papel_gerenciar')){
            return redirect()->route('home');
        }

        $papel = Papel::find($id);

        if($papel->nome == 'admin'){
            \Session::flash('mensagem', ['msg'=>'Esse papel não pode ser editado', 'class'=>'danger']);
            return redirect()->route('papel');
        }

        return view('papel.editar', compact('papel'));
    }
    public function excluir($id){
        //Auth
        if(!auth()->user()->can('papel_gerenciar')){
            return redirect()->route('home');
        }

        $papel = Papel::find($id);

        if($papel->nome == 'admin'){
            \Session::flash('mensagem', ['msg'=>'Esse papel não pode ser deletado', 'class'=>'danger']);
            return redirect()->route('papel');
        }

        $papel->delete();
        \Session::flash('mensagem',['msg'=>'Registro deletado com sucesso!','class'=>'success']);
        return redirect()->route('papel');
    }

    public function novo(){
        //Auth
        if(!auth()->user()->can('papel_gerenciar')){
            return redirect()->route('home');
        }

        return view('papel.novo');
    }

    public function incluir(Request $request){
        //Auth
        if(!auth()->user()->can('papel_gerenciar')){
            return redirect()->route('home');
        }

        $formData = $request->all();
        $papel = new Papel();
        $papel->nome = $formData['nome'];
        $papel->descricao = $formData['descricao'];
        
        if($papel->nome == 'admin'){
            \Session::flash('mensagem', ['msg'=>'Esse papel não pode ser adicionado', 'class'=>'danger']);
            return redirect()->route('papel.novo');
        }
        
        $save = $papel->save();
        if($save){
            \Session::flash('mensagem', ['msg'=>'Papel cadastrado com sucesso', 'class'=>'success']);
            return redirect()->route('papel');
        }else{
            \Session::flash('mensagem', ['msg'=>'Erro ao cadastrar papel!', 'class'=>'danger']);
            return redirect()->route('papel.novo');
        }
    }

    public function salvar($id, Request $request){
        //Auth
        if(!auth()->user()->can('papel_gerenciar')){
            return redirect()->route('home');
        }
        
        $papel = Papel::find($id);
        $dados = $request->all();

        if($papel->nome == 'admin'){
            \Session::flash('mensagem', ['msg'=>'Esse papel não pode ser editado', 'class'=>'danger']);
            return redirect()->route('papel');
        }
        
        $update = $papel->update($dados);
        if($update){
            \Session::flash('mensagem', ['msg'=>'Papel editado com sucesso', 'class'=>'success']);
        }else{
            \Session::flash('mensagem', ['msg'=>'Erro ao editar papel!', 'class'=>'danger']);            
        }

        return redirect()->route('papel.editar',$id);
    }

    public function permissao($id){
        
        $papel = Papel::find($id);
        $permissaos = Permissao::all();

        return view('papel.permissao', compact('papel', 'permissaos'));
    }

    public function salvarPermissao(Request $request, $id){
        $papel = Papel::find($id);
        $permissao = Permissao::find($request['permissao_id']);
        $papel->adicionarPermissao($permissao);
        \Session::flash('mensagem', ['msg'=>'Permissão adicionada com sucesso', 'class'=>'success']);
        return redirect()->back();
    }

    public function removerPermissao($id, $id_permissao){
        $papel = Papel::find($id);
        $permissao = Permissao::find($id_permissao);
        $papel->removerPermissao($permissao);
        \Session::flash('mensagem', ['msg'=>'Permissão removida com sucesso', 'class'=>'success']);
        return redirect()->back();
    
    }
}
