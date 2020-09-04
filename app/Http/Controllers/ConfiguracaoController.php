<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfiguracaoController extends Controller
{
    //
    public function indexConfiguracao()
    {
        return view('Painel.config');
    }
    public function carousel()
    {
        return view('Administrativo.adminCarouselAndCards/carousel');
    }
    public function carouselAdd(Request $request)
    {
        dd($request->testeaaa);
        return $request;
    }
}
