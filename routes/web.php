<?php

Route::get('/', 'Painel\AnimalController@index');

//Rotas dos animais
Route::get('animais/deletar/{id}', 'Painel\AnimalController@destroyOne')->name('Animais.destroyOne');
Route::get('animais/deletar-varios/', 'Painel\AnimalController@destroyMany')->name('Animais.destroyMany');
Route::resource("Animais", "Painel\AnimalController");


//Rotas dos pedidos de adoção
Route::get('pedidos/aceitar-pedido/{id}', 'Painel\PedidoAdocaoController@aceitarPedidoAdocao')->name('PedidosAdocao.aceitarPedido');
Route::get('pedido/recusar-pedido/{id}', 'Painel\PedidoAdocaoController@recusarPedidoAdocao')->name('PedidosAdocao.recusarPedido');
Route::match(['get', 'post'], 'pedido/selecionar-animal', 'Painel\PedidoAdocaoController@selecionarAnimal')->name('PedidosAdocao.selecionarAnimal');
Route::resource("PedidosAdocao", "Painel\PedidoAdocaoController");


