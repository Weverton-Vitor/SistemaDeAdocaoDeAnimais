<?php

Route::get('/', 'Painel\AnimalController@index');

Route::get('animais/deletar/{id}', 'Painel\AnimalController@destroyOne')->name('Animais.destroyOne');
Route::get('animais/deletar-varios/', 'Painel\AnimalController@destroyMany')->name('Animais.destroyMany');
Route::resource("Animais", "Painel\AnimalController");

Route::get('pedidos/aceitar-pedido/{id}', 'Painel\PedidoAdocaoController@aceitarPedidoAdocao')->name('PedidosAdocao.aceitarPedido');
Route::get('pedido/recusar-pedido/{id}', 'Painel\PedidoAdocaoController@recusarPedidoAdocao')->name('PedidosAdocao.recusarPedido');
Route::resource("PedidosAdocao", "Painel\PedidoAdocaoController");


