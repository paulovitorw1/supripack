<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PainelInicialController extends Controller
{
    //
    public function indexInicialView()
    {
        return view('Cliente.PaginaInicial/cardsEslide');
    }

    public function indexSlide()
    {
    }
}
