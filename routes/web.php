<?php

Route::get('/', 'Painel\AnimalController@index');

Route::get('animais/deletar/{id}', 'Painel\AnimalController@destroyOne')->name('Animais.destroyOne');
Route::get('animais/deletar-varios/', 'Painel\AnimalController@destroyMany')->name('Animais.destroyMany');
Route::resource("Animais", "Painel\AnimalController");


Route::resource("PedidosAdocao", "Painel\PedidoAdocaoController");


