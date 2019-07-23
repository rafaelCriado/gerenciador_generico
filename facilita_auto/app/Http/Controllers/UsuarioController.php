<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Papel;

class UsuarioController extends Controller
{
    //
    public function login(Request $request){
        $dados = $request->all();
        //dd($dados);
        if(Auth::attempt(['email'=> $dados['email'], 'password'=>$dados['password']])){
            \Session::flash('mensagem', ['msg'=>'Login realizado com sucesso', 'class'=>'success']);
            return redirect()->route('home');
        }else{
            \Session::flash('mensagem', ['msg'=>'Usuário ou senha inválido', 'class'=>'danger']);
            return redirect()->route('login');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function index(){
        //Auth
        if(!auth()->user()->can('usuario_listar')){
            return redirect()->route('home');
        }


       $usuarios = User::all();
       //dd($usuarios); 
       return view('usuarios.index', compact('usuarios'));
    }

    public function perfil($id){
        //Auth
        if(!auth()->user()->can('usuario_listar')){
            return redirect()->route('home');
        }

        $usuario = User::find($id);

        return view('usuarios.profile', compact('usuario'));
    }

    public function editar($id){

        //Auth
        if(!auth()->user()->can('usuario_gerenciar')){
            return redirect()->route('home');
        }

        $usuario = User::find($id);
        return view('usuarios.editar', compact('usuario'));
    }
    public function excluir($id){
        //Auth
        if(!auth()->user()->can('usuario_gerenciar')){
            return redirect()->route('home');
        }

        User::find($id)->delete();
        \Session::flash('mensagem',['msg'=>'Registro deletado com sucesso!','class'=>'success']);
        return redirect()->route('usuarios');
    }

    public function novo(){

        //Auth
        if(!auth()->user()->can('usuario_gerenciar')){
            return redirect()->route('home');
        }

        return view('usuarios.novo');
    }

    public function incluir(Request $request){
        //Auth
        if(!auth()->user()->can('usuario_gerenciar')){
            return redirect()->route('home');
        }

        $formData = $request->all();
        $usuario = new User();
        $usuario->name = $formData['name'];
        $usuario->email = $formData['email'];
        $usuario->password = bcrypt($formData['password']);
        $usuario->image = '';
        $save = $usuario->save();



        if($request->hasFile('image') && $request->file('image')->isValid()){
            $name = $usuario->id.kebab_case($usuario->nome);
            $extensao = $request->image->extension();
            $name_file = "{$name}.{$extensao}";
            $usuario->image = $name_file;
            $upload = $request->image->storeAs('users',$name_file);
            $usuario->save();
        }

        
        if($save){
            \Session::flash('mensagem', ['msg'=>'Usuário cadastrado com sucesso', 'class'=>'success']);
            return redirect()->route('usuarios');
        }else{
            \Session::flash('mensagem', ['msg'=>'Erro ao cadastrar usuário!', 'class'=>'danger']);
            return redirect()->route('usuario.novo');
        }
    }

    public function salvar($id, Request $request){
        //Auth
        if(!auth()->user()->can('usuario_gerenciar')){
            return redirect()->route('home');
        }
        
        $usuario = User::find($id);
        $dados = $request->all();

        $dados['image'] = $usuario->image;
        if($request->hasFile('image') && $request->file('image')->isValid()){
            if($usuario->image){
                $name = $usuario->image;
            }else{
                $name = $usuario->id.kebab_case($usuario->name);
            }

            $extensao = $request->image->extension();
            $name_file = "{$name}.{$extensao}";
            $dados['image'] = $name_file;
            $upload = $request->image->storeAs('users',$name_file);
        }


        if(isset($dados['password']) && strlen($dados['password'])>5){
            $dados['password'] = bcrypt($dados['password']);
        }else{
            unset($dados['password']);
        }

        $update = $usuario->update($dados);
        if($update){
            \Session::flash('mensagem', ['msg'=>'Usuário editado com sucesso', 'class'=>'success']);
        }else{
            \Session::flash('mensagem', ['msg'=>'Erro ao editar usuário!', 'class'=>'danger']);            
        }

        return redirect()->route('usuario.editar',$id);
    }

    public function papel($id){
        //Auth
        if(!auth()->user()->can('papel_listar')){
            return redirect()->route('home');
        }
        $usuario = User::find($id);
        $papels = Papel::all();
        return view('usuarios.papel', compact('usuario', 'papels'));
    }


    public function salvarPapel($id, Request $request){
        //Auth
        if(!auth()->user()->can('papel_gerenciar')){
            return redirect()->route('home');
        }

        $usuario = User::find($id);
        $dados = $request->all();
        $papel = Papel::find($dados['papel_id']);
        $usuario->adicionaPapel($papel);
        \Session::flash('mensagem', ['msg'=>'Papel adicionado com sucesso!', 'class'=>'success']);            
        return redirect()->back();
    }

    public function removerPapel($id, $papel_id){
        //Auth
        if(!auth()->user()->can('papel_gerenciar')){
             \Session::flash('mensagem', ['msg'=>'Seu usuário adicionado com sucesso!', 'class'=>'success']);
            return redirect()->route('home');
        }

        $usuario = User::find($id);
        $papel = Papel::find($papel_id);
        $usuario->excluirPapel($papel);
        \Session::flash('mensagem', ['msg'=>'Papel removido com sucesso!', 'class'=>'success']);   
        return redirect()->back();
    }
    
}
