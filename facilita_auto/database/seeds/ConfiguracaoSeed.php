<?php

use Illuminate\Database\Seeder;
use App\Configuracao;

class ConfiguracaoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!Configuracao::where('id', '=', 1)->count()){
            $admin = Configuracao::create([
                'taxa_servico'=> 0
            ]);
        }
    }
}
