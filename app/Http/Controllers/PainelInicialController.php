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
    public function indexCategoria()
    {
        $responseJson = [];
        $consultaCategoria = DB::select('SELECT * FROM prod_grp WHERE instit = 1 AND prod_grp.niv = 1');
        // $responseJson = ['menu' => $consultaCategoria];

        $consultaSubCategoria = DB::select('SELECT * FROM prod_grp WHERE instit = 1 AND prod_grp.niv = 2 ');

        $consultaSubsCategoria = DB::select('SELECT * FROM prod_grp WHERE instit = 1 AND prod_grp.niv = 3');

        $responseJson = ['menu' => $consultaCategoria, 'subMenu' => $consultaSubCategoria, 'subsub' => $consultaSubsCategoria];

        return response()->json($responseJson);
    }
    public function indexCategoriaID(Request $request)
    {
        $jsjsjsj = $request->idCategoria;
        $asdadasdas = DB::select('SELECT * FROM prod_grp WHERE instit = 1 AND prod_grp.nv1id = ?', [$jsjsjsj]);
        return response()->json($asdadasdas);
    }
    public function indexBuscaProdutoCategoria(Request $request)
    {
        $idCategoria = $request->idCategoria;
        // dd($idCategoria);
        $consultaProduto = DB::select('SELECT * FROM produtos INNER JOIN fotos ON produtos.id = fotos.id_produto WHERE produtos.grupo = ?', [$idCategoria]);

        return response()->json($consultaProduto);
    }
}
