<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContatoController extends Controller
{
    
    public function index(){
        //Auth
        if(!auth()->user()->can('contato_mostrar')){
            return redirect()->route('home');
        }

        return view('contato');
    }

}
