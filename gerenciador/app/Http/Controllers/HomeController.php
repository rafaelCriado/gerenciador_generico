<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Download;
use App\Franquia;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qtde = [
            'usuarios'=> User::count(),
        ];
        return view('home', compact('qtde'));
    }
}
