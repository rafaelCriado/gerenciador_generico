<?php

use Illuminate\Database\Seeder;
use App\Papel;

class PapelSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         //
         if(!Papel::where('nome', '=', 'admin')->count()){
            $admin = Papel::create([
                'nome'=> 'admin',
                'descricao'=> 'Administrador do Sistema',
            ]);
        }
    }
}
