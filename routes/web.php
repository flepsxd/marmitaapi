<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('auth/login', 'AuthController@authenticate');

$router->group(['prefix' => 'usuarios'], function () use ($router) {
    $router->get('/', 'UsuariosController@index');
    $router->get('/{id}', 'UsuariosController@show');
    $router->post('/', 'UsuariosController@create');
    $router->put('/{id}', 'UsuariosController@update');
    $router->delete('/{id}', 'UsuariosController@delete');
});

$router->group(['prefix' => 'cidades'], function () use ($router) {
    $router->get('/', 'CidadesController@index');
    $router->get('/{id}', 'CidadesController@show');
    $router->post('/', 'CidadesController@create');
    $router->put('/{id}', 'CidadesController@update');
    $router->delete('/{id}', 'CidadesController@delete');
});

$router->group(['prefix' => 'bairros'], function () use ($router) {
    $router->get('/', 'BairrosController@index');
    $router->get('/{id}', 'BairrosController@show');
    $router->post('/', 'BairrosController@create');
    $router->put('/{id}', 'BairrosController@update');
    $router->delete('/{id}', 'BairrosController@delete');
});

$router->group(['prefix' => 'pessoas'], function () use ($router) {
    $router->get('/', 'PessoasController@index');
    $router->get('/{id}', 'PessoasController@show');
    $router->post('/', 'PessoasController@create');
    $router->put('/{id}', 'PessoasController@update');
    $router->delete('/{id}', 'PessoasController@delete');
});

$router->group(['prefix' => 'produtos'], function () use ($router) {
    $router->get('/', 'ProdutosController@index');
    $router->get('/{idproduto}', 'ProdutosController@show');
    $router->post('/', 'ProdutosController@create');
    $router->put('/{idproduto}', 'ProdutosController@update');
    $router->delete('/{idproduto}', 'ProdutosController@delete');
});

$router->group(['prefix' => 'enderecos'], function () use ($router) {
    $router->get('/', 'EnderecosController@index');
    $router->get('/{id}', 'EnderecosController@show');
    $router->post('/', 'EnderecosController@create');
    $router->put('/{id}', 'EnderecosController@update');
    $router->delete('/{id}', 'EnderecosController@delete');
});

$router->group(['prefix' => 'agendamentos'], function () use ($router) {
    $router->get('/', 'AgendamentosController@index');
    $router->get('/{id}', 'AgendamentosController@show');
    $router->post('/', 'AgendamentosController@create');
    $router->put('/{id}', 'AgendamentosController@update');
    $router->delete('/{id}', 'AgendamentosController@delete');
});

$router->group(['prefix' => 'pedidos'], function () use ($router) {
    $router->get('/', 'PedidosController@index');
    $router->get('/timeline', 'PedidosController@timeline');
    $router->get('/{id}', 'PedidosController@show');
    $router->post('/', 'PedidosController@create');
    $router->put('/{id}', 'PedidosController@update');
    $router->delete('/{id}', 'PedidosController@delete');
});

$router->group(['prefix' => 'pedidositens'], function () use ($router) {
    $router->get('/', 'PedidosItensController@index');
    $router->get('/pedido/{id}', 'PedidosItensController@byPedido');
    $router->get('/{id}', 'PedidosItensController@show');
    $router->post('/', 'PedidosItensController@create');
    $router->put('/{id}', 'PedidosItensController@update');
    $router->delete('/{id}', 'PedidosItensController@delete');
});

$router->group(['prefix' => 'agendamentositens'], function () use ($router) {
    $router->get('/', 'AgendamentosItensController@index');
    $router->get('/{id}', 'AgendamentosItensController@show');
    $router->post('/', 'AgendamentosItensController@create');
    $router->put('/{id}', 'AgendamentosItensController@update');
    $router->delete('/{id}', 'AgendamentosItensController@delete');
});

$router->group(['prefix' => 'lancamentos'], function () use ($router) {
    $router->get('/', 'LancamentosController@index');
    $router->get('/{id}', 'LancamentosController@show');
    $router->post('/', 'LancamentosController@create');
    $router->put('/{id}', 'LancamentosController@update');
    $router->delete('/{id}', 'LancamentosController@delete');
});

$router->group(['prefix' => 'etapas'], function () use ($router) {
    $router->get('/', 'EtapasController@index');
    $router->get('/{id}', 'EtapasController@show');
    $router->post('/', 'EtapasController@create');
    $router->put('/{id}', 'EtapasController@update');
    $router->delete('/{id}', 'EtapasController@delete');
});

