<?php

namespace App\Http\Controllers;

use App\Pedido;
use App\Estado;
use Illuminate\Http\Request;
use App\Http\Requests\PedidoRequest;


class PedidoController extends Controller
{
    //Lista de todos os pedidos
    public function pedidos(){
        try {
            $pedidos = Pedido::all();
            return view('pedido.index', ['pedidos'=> $pedidos]);
        } catch (\Exception $th) {
            return back()->withErrors('Ops! Aconteceu algum problema, tente novamente!');
        }
    }

    //Mostra informações de um pedido
    public function pedido($id){
        try {
            $pedido = Pedido::find($id);
            $arrayView = [
                'pedido'=>$pedido
            ];
            return view('pedido.info', $arrayView);
        } catch (\Exception $th) {
            return back()->withErrors('Ops! Aconteceu algum problema, tente novamente!');;
        } 
    }

    //Tela de cadastro de novo pedido
    public function novo(){
        try {
            $estados = Estado::all();
            return view('pedido.novo', ['estados'=> $estados]);
        } catch (\Exception $th) {
            return back()->withErrors('Ops! Aconteceu algum problema, tente novamente!');;
        }
    }

    //Tela de editar um pedido expecifico
    public function editar($id){
        try {
            $pedido = Pedido::find($id);
            dd($pedido);
        } catch (\Exception $th) {
            return back()->withErrors('Ops! Aconteceu algum problema, tente novamente!');;
        }
    }

    //Salvar dados de um pedido
    public function salvar(Request $request, $id){
        try {
            $pedido = Pedido::find($id);
            dd($pedido);
        } catch (\Exception $th) {
            return back()->withErrors('Ops! Aconteceu algum problema, tente novamente!');;
        }
    }

    //Incluir novo pedido
    public function incluir(PedidoRequest $request){
        try {
            $formData = $request->all();

            $pedido         = new Pedido();
            $pedido->nome   = request('nome');
            $pedido->cpf    = request('cpf');
            $pedido->placa  = request('placa');
            $pedido->uf     = request('uf');
            
            $save = $pedido->save();
            if($save){
                \Session::flash('mensagem', ['msg'=>'Pedido cadastrado com sucesso', 'class'=>'success']);
                return redirect()->route('pedido.info', $pedido->id);
            }else{
                \Session::flash('mensagem', ['msg'=>'Erro ao cadastrar pedido!', 'class'=>'danger']);
                return redirect()->route('pedido.novo');
            }
        } catch (\Exception $th) {
            return back()->withErrors('Ops! Aconteceu algum problema, tente novamente!');;
        }
    }

    //Excluir pedido
    public function excluir($id){
        try {
            $pedido = Pedido::find($id);
            dd($pedido);
        } catch (\Exception $th) {
            return back()->withErrors('Ops! Aconteceu algum problema, tente novamente!');;
        }
    }
}
