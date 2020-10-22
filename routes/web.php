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
Route::group(['prefix' => 'inicial'], function () {
    Route::get('/', 'PainelInicialController@indexInicialView')->name('viewInicial');
    Route::get('/slide', 'PainelInicialController@indexSlide')->name('indexSlide');
    Route::post('/produto/destaque', 'PainelInicialController@indexProdutoDestaque')->name('indexProdutoDestaque');
    Route::get('/categoria', 'PainelInicialController@indexCategoria')->name('indexCategoria');
    Route::post('/meuCategoria', 'PainelInicialController@indexCategoriaID')->name('indexCategoriaID');
    Route::post('/filtro/produto', 'PainelInicialController@indexBuscaProdutoCategoria')->name('indexBuscaProdutoCategoria');
    Route::post('/filtro/produto/pesquisa', 'PainelInicialController@indexPesquisaProduto')->name('indexPesquisaProduto');
});
//GRUPO DE ROTAS PARA O CARRINHO
Route::group(['prefix' => 'inicial/carrinho'], function () {
    Route::get('/', 'CarrinhoController@indexCarrinho')->name('indexCarrinho');
    Route::post('/lista/produto', 'CarrinhoController@listaProduto')->name('listaProduto');
});
//Tela Inicial
//
Route::group(['prefix' => 'usuario'], function () {
    Route::post('/adicinar', 'CadastroUsuarioController@cadastroUser')->name("cadastroUser");
});
//
Route::group(['prefix' => 'admin/config'], function () {
    Route::get('/', 'ConfiguracaoController@indexConfiguracao')->name("ssss");
    //***************************************************************************************\\
    //*********************************ROTAS PARA O SLIDE*************************************\\
    //*****************************************************************************************\\
    Route::get('/carousel', 'ConfiguracaoController@carousel')->name("view");
    Route::any('/carousel/adicinar', 'ConfiguracaoController@carouselAdd')->name("adicionarImgCarousel");
    Route::post('/carousel/editar', 'ConfiguracaoController@editarCarousel')->name("editarCarousel");
    Route::post('/carousel/delete', 'ConfiguracaoController@deleteCarousel')->name("deleteCarousel");
    //*******************************************************************************************\\
    //******************************ROTAS PARA O CARDS DESTAQUE***********************************\\
    //*********************************************************************************************\\
    Route::get('/produto/destaque', 'ConfiguracaoController@viewProdutoDestaque')->name('viewCardsDEstaque');
    Route::post('/produto/destaque/visualizar', 'ConfiguracaoController@viewProduto')->name('viewProduto');
    Route::post('/produto/destaque/addDestaque', 'ConfiguracaoController@addDestaque')->name('addDestaque');
    Route::post('/produto/destaque/delete', 'ConfiguracaoController@deleteDestaque')->name("deleteDestaque");
    //*******************************************************************************************\\
    //******************************ROTAS PARA O CUPOM********************************************\\
    //*********************************************************************************************\\
    //Rota para fazer a validações dos campos
    // Route::any('/cupom/validacao', 'ConfiguracaoController@validacaoPersoanalizada')->name('validacaoPersoanalizada');
    Route::get('/cupom', 'ConfiguracaoController@viewCupom')->name('viewCupom');
    Route::post('/cupom/adicionar', 'ConfiguracaoController@addCupom')->name('addCupom');
    Route::post('/cupom/visualizar', 'ConfiguracaoController@visualizarCupom')->name('visualizarCupom');
    Route::post('/cupom/atualizar', 'ConfiguracaoController@atualizarCupom')->name('atualizarCupom');
    Route::post('/cupom/delete', 'ConfiguracaoController@deleteCupom')->name('deleteCupom');
});
Auth::routes();
