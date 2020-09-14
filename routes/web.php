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
//
Route::group(['prefix' => 'admin/config'], function () {
    Route::get('/', 'ConfiguracaoController@indexConfiguracao')->name("ssss");
    //****************************CONFIGURAÇÃO PARA O SLIDE*************************************\\
    Route::get('/carousel', 'ConfiguracaoController@carousel')->name("view");
    Route::any('/carousel/adicinar', 'ConfiguracaoController@carouselAdd')->name("adicionarImgCarousel");
    Route::post('/carousel/editar', 'ConfiguracaoController@editarCarousel')->name("editarCarousel");
    Route::post('/carousel/delete', 'ConfiguracaoController@deleteCarousel')->name("deleteCarousel");
    //***********************CONFIGURAÇÃO PARA O CARDS DESTAQUE*******************************\\
    Route::get('/produto/destaque', 'ConfiguracaoController@cardsDestaque')->name('viewCardsDEstaque');
});
Auth::routes();
