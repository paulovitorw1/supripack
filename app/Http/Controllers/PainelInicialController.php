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
    public function indexProdutoDestaque(Request $request)
    {

        $arrayProdutoUniq = array();
        $idCategoria = $request->idCategoria;

        $consultaProduto = DB::table('produtos')
            ->select('id', 'nome', 'descr', 'valor_uni_tributavel', 'produtos.status_destaque', 'id_foto', 'id_produto', 'nome_arquivo')
            ->leftJoin('fotos', 'fotos.id_produto', '=', 'produtos.id')
            ->where('produtos.status_destaque', '=', 1)
            ->get();
        //definindo linha unica 
        $consultaUniqueProduto = $consultaProduto->unique('id');
        //Pegando todos os dados
        $arrayProdutoUniq = $consultaUniqueProduto->values()->all();

        return response()->json($arrayProdutoUniq);
        // $consultaProdutoDestaque = DB::select('SELECT * FROM produtos INNER JOIN fotos ON produtos.id = fotos.id_foto WHERE produtos.status_destaque = 1');
        // return $consultaProdutoDestaque;
    }

    public function indexCategoria()
    {
        $responseJson = [];
        $consultaCategoria = DB::select('SELECT id, niv, nv1, nv1id, nv2, nv2id,nv3 FROM prod_grp WHERE instit = 1 AND prod_grp.niv = 1');
        // $responseJson = ['menu' => $consultaCategoria];

        $consultaSubCategoria = DB::select('SELECT id, niv, nv1, nv1id, nv2, nv2id,nv3 FROM prod_grp WHERE instit = 1 AND prod_grp.niv = 2 ');

        $consultaSubsCategoria = DB::select('SELECT id, niv, nv1, nv1id, nv2, nv2id,nv3 FROM prod_grp WHERE instit = 1 AND prod_grp.niv = 3');

        $responseJson = ['menu' => $consultaCategoria, 'subMenu' => $consultaSubCategoria, 'subsub' => $consultaSubsCategoria];

        return response()->json($responseJson);
    }
    public function indexCategoriaID(Request $request)
    {
        $idCategoria = $request->idCategoria;
        $consultaGrupCategoria = DB::select('SELECT id, niv, nv1, nv1id, nv2, nv2id,nv3 FROM prod_grp WHERE instit = 1 AND prod_grp.nv1id = ?', [$idCategoria]);

        return response()->json($consultaGrupCategoria);
    }
    //CONSULTANDO PRODUTO PELA CATEGORIA SELECIONADA
    public function indexBuscaProdutoCategoria(Request $request)
    {
        $arrayProdutoUniq = array();
        $idCategoria = $request->idCategoria;

        $consultaProduto = DB::table('produtos')
            ->select('id', 'nome', 'descr', 'valor_uni_tributavel', 'id_foto', 'id_produto', 'nome_arquivo')
            ->leftJoin('fotos', 'fotos.id_produto', '=', 'produtos.id')
            ->where('produtos.grupo', [$idCategoria])
            ->get();
        //definindo linha unica 
        $consultaUniqueProduto = $consultaProduto->unique('id');
        //Pegando todos os dados
        $arrayProdutoUniq = $consultaUniqueProduto->values()->all();

        return response()->json($arrayProdutoUniq);
    }
    //FUNÇÃO PARA BUSCAR PRODUTOS PELO INPUT DE PESQUISA
    public function indexPesquisaProduto(Request $request)
    {
        $nomeProduto = $request->textProduto;
        $idCategoria = $request->idCategoriaorSub;

        // $consultaProdutoPesquisa = DB::select("SELECT produtos.descr  FROM produtos WHERE produtos.descr LIKE '%..%' AND produtos.grupo = 13", []);
        $consultaProdutoPesquisa = DB::table('produtos')
            ->select('produtos.descr', 'produtos.grupo', 'fotos.id_foto', 'fotos.nome_arquivo')
            ->join('fotos', 'produtos.id', '=', 'fotos.id_produto')
            ->where(
                [
                    ['descr', 'like', '%' . $nomeProduto . '%'],
                    ['grupo', '=', $idCategoria],

                ]
            )
            ->get();

        return response()->json($consultaProdutoPesquisa);
    }
}
