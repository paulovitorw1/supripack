<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PainelInicialController extends Controller
{
    //
    public function indexInicialView()
    {
        return view('Cliente.PaginaInicial/cardsEslide');
    }
    //
    public function indexSlide(Request $request)
    {
        //Consulta img para carousel tela de config
        $consultaImagemCarusel = DB::select('SELECT * FROM e_carousel WHERE e_carousel.status = 1');
        // if ($request->ajax()) {
        // }
        // return view();
        return response()->json($consultaImagemCarusel);
    }
    public function indexProdutoDestaque()
    {
        $consultaProdutoDestaque = DB::select('SELECT * FROM produtos INNER JOIN fotos ON produtos.id = fotos.id_foto WHERE produtos.status_destaque = 1');
        return response()->json($consultaProdutoDestaque);
    }
}
