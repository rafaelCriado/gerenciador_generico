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

        if(!Papel::where('nome', '=', 'franquia')->count()){
            $admin = Papel::create([
                'nome'=> 'franquia',
                'descricao'=> 'Perfil dos usuários das franquias',
            ]);
        }

        if(!Papel::where('nome', '=', 'franqueadora')->count()){
            $admin = Papel::create([
                'nome'=> 'franqueadora',
                'descricao'=> 'Perfil dos usuários da franqueadora',
            ]);
        }
    }
}
