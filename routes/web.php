<?php

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

Route::get('/', function () {
    return redirect('/inicial');
});
//Tela Inicial
Route::get('/inicial', 'PainelInicialController@indexInicialView')->name('viewInicial');
//
Route::group(['prefix' => 'usuario'], function () {
    Route::post('/adicinar', 'CadastroUsuarioController@cadastroUser')->name("cadastroUser");
});
Auth::routes();
