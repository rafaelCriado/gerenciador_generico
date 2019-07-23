<?php

use GuzzleHttp\Middleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Auth::routes();


Route::get('/login', function(){
    return view('login.index');
})->name('login');

Route::post('/login', 'UsuarioController@login')->name('login');


Route::group(['middleware'=>'auth'], function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', function(){
        return redirect()->route('home');
    });
    Route::get('/logout', 'UsuarioController@logout')->name('logout');

    Route::get('/contato', 'ContatoController@index')->name('contato');
    Route::get('/busca', 'BuscaController@index')->name('busca');

    //Rotas de Usuario
    Route::get('/usuarios', 'UsuarioController@index')->name('usuarios');
    Route::get('/usuario/novo', 'UsuarioController@novo')->name('usuario.novo');
    Route::get('/usuario/perfil/{id}', 'UsuarioController@perfil')->name('usuario.perfil');
    Route::get('/usuario/editar/{id}', 'UsuarioController@editar')->name('usuario.editar');
    Route::get('/usuario/excluir/{id}', 'UsuarioController@excluir')->name('usuario.excluir');
    Route::post('/usuario/salvar', 'UsuarioController@incluir')->name('usuario.incluir');
    Route::put('/usuario/atualizar/{id}', 'UsuarioController@salvar')->name('usuario.salvar');

    Route::get('/usuarios/papel/{id}', 'UsuarioController@papel')->name('usuarios.papel');
    Route::post('/usuarios/papel/salvar/{id}', 'UsuarioController@salvarPapel')->name('usuarios.papel.salvar');
    Route::get('/usuarios/papel/remover/{id}/{papel_id}', 'UsuarioController@removerPapel')->name('usuarios.papel.remover');

    //Rotas de Papeis
    Route::get('/papel', 'PapelController@index')->name('papel');
    Route::get('/papel/novo', 'PapelController@novo')->name('papel.novo');
    Route::get('/papel/editar/{id}', 'PapelController@editar')->name('papel.editar');
    Route::get('/papel/excluir/{id}', 'PapelController@excluir')->name('papel.excluir');
    Route::post('/papel/salvar', 'PapelController@incluir')->name('papel.incluir');
    Route::put('/papel/atualizar/{id}', 'PapelController@salvar')->name('papel.salvar');

    //Permissoes
    Route::get('/papel/permissao/{id}', 'PapelController@permissao')->name('papel.permissao');
    Route::post('/papel/permissao/{id}/salvar', 'PapelController@salvarPermissao')->name('papel.permissao.salvar');
    Route::get('/papel/permissao/{id}/remover/{id_permissao}', 'PapelController@removerPermissao')->name('papel.permissao.remover');

    //Rota de configuracoes
    Route::get('/configuracoes', 'ConfiguracaoController@configuracao')->name('configuracao');
    Route::get('/configuracoes/editar', 'ConfiguracaoController@editar')->name('configuracao.editar');
    Route::put('/configuracoes/salvar', 'ConfiguracaoController@salvar')->name('configuracao.salvar');

    //Rota de Pedidos
    Route::get('/pedidos',                  'PedidoController@pedidos')->name('pedidos');
    Route::get('/pedido/novo',              'PedidoController@novo')->name('pedido.novo');
    Route::get('/pedido/editar/{id}',       'PedidoController@editar')->name('pedido.editar');
    Route::delete('/pedido/excluir/{id}',   'PedidoController@excluir')->name('pedido.excluir');
    Route::post('/pedido/incluir',          'PedidoController@incluir')->name('pedido.incluir');
    Route::put('/pedido/atualizar/{id}',    'PedidoController@salvar')->name('pedido.salvar');
    Route::get('/pedido/{id}',              'PedidoController@pedido')->name('pedido.info');

});

