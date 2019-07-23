<?php

use Illuminate\Database\Seeder;
use App\Permissao;

class PermissaoSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Ver contato
        $permissao = Permissao::where('nome', '=', 'contato_mostrar');
        if(!$permissao->count()){
            Permissao::create([
                'nome'=> 'contato_mostrar',
                'descricao'=> 'Mostrar tela de contato',
            ]);
        }else{
            $permissao = $permissao->first();
            $permissao->update([
                'nome'=> 'contato_mostrar',
                'descricao'=> 'Mostrar tela de contato',
            ]);
        }

        //Listar Usuario
        $permissao = Permissao::where('nome', '=', 'usuario_listar');
        if(!$permissao->count()){
            Permissao::create([
                'nome'=> 'usuario_listar',
                'descricao'=> 'Listar Usuários',
            ]);
        }else{
            $permissao = $permissao->first();
            $permissao->update([
                'nome'=> 'usuario_listar',
                'descricao'=> 'Listar Usuários',
            ]);
        }

        //Gerenciar Usuario
        $permissao = Permissao::where('nome', '=', 'usuario_gerenciar');
        if(!$permissao->count()){
            Permissao::create([
                'nome'=> 'usuario_gerenciar',
                'descricao'=> 'Gerenciar Usuários',
            ]);
        }else{
            $permissao = $permissao->first();
            $permissao->update([
                'nome'=> 'usuario_gerenciar',
                'descricao'=> 'Gerenciar Usuários',
            ]);
        }
        
        //Papel
        //Listar Papel
        $permissao = Permissao::where('nome', '=', 'papel_listar');
        if(!$permissao->count()){
            Permissao::create([
                'nome'=> 'papel_listar',
                'descricao'=> 'Listar Papeis',
            ]);
        }else{
            $permissao = $permissao->first();
            $permissao->update([
                'nome'=> 'papel_listar',
                'descricao'=> 'Listar Papeis',
            ]);
        }

        //Gerenciar Papel
        $permissao = Permissao::where('nome', '=', 'papel_gerenciar');
        if(!$permissao->count()){
            Permissao::create([
                'nome'=> 'papel_gerenciar',
                'descricao'=> 'Gerenciar papel',
            ]);
        }else{
            $permissao = $permissao->first();
            $permissao->update([
                'nome'=> 'papel_gerenciar',
                'descricao'=> 'Gerenciar papel',
            ]);
        }
       
    }
}
