<?php

Route::get('/', 'Site\SiteController@index');

//Rotas para o site
Route::get('/Contato', 'Site\SiteController@contato')->name('Site.contato');
Route::get('/Adote-um-animal', 'Site\SiteController@adoteUmAnimal')->name('Site.adoteUmAnimal');
Route::get('/Sobre', 'Site\SiteController@sobre')->name('Site.sobre');
Route::resource('Site', 'Site\SiteController');



Route::middleware(['auth'])->group(function () {
    //Rotas para o painel em geral
    Route::get('usuario/cadastrar', 'Painel\PainelController@createUser')->name('Painel.createUser');
    Route::resource("Painel", "Painel\PainelController");
    
    //Rotas dos animais
    Route::get('animais/deletar/{id}', 'Painel\AnimalController@destroyOne')->name('Animais.destroyOne');
    Route::get('animais/deletar-varios/', 'Painel\AnimalController@destroyMany')->name('Animais.destroyMany');
    Route::resource("Animais", "Painel\AnimalController");
    
    
    //Rotas dos pedidos de adoção
    Route::get('pedidos/excluir/{id}', 'Painel\PedidoAdocaoController@destroyOne')->name('PedidosAdocao.destroyOne');
    Route::get('pedidos/aceitar-pedido/{id}', 'Painel\PedidoAdocaoController@aceitarPedidoAdocao')->name('PedidosAdocao.aceitarPedido');
    Route::get('pedido/recusar-pedido/{id}', 'Painel\PedidoAdocaoController@recusarPedidoAdocao')->name('PedidosAdocao.recusarPedido');
    Route::match(['get', 'post'], 'pedido/validar-dados', 'Painel\PedidoAdocaoController@validarDados')->name('PedidosAdocao.validarDados');
    Route::match(['get', 'post'], 'pedido/selecionar-animal', 'Painel\PedidoAdocaoController@selecionarAnimal')->name('PedidosAdocao.selecionarAnimal');
    Route::resource("PedidosAdocao", "Painel\PedidoAdocaoController");
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
