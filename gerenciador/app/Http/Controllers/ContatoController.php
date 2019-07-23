<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Franquia;

class ContatoController extends Controller
{
    
    public function index(){
        //Auth
        if(!auth()->user()->can('contato_mostrar')){
            return redirect()->route('home');
        }

        $matriz = Franquia::where('id',1)->first();
        //dd($matriz);
        return view('contato',compact('matriz'));
    }

}
