<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    //
    public function indexCarrinho()
    {
        return view('Cliente.PaginaInicial.carrinho');
    }
}
