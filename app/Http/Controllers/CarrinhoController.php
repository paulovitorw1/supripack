<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;


class CarrinhoController extends Controller
{
    //RETORNANDO VIEW 
    public function indexCarrinho()
    {
        return view('Cliente.PaginaInicial.carrinho');
    }

    public function listaProduto(Request $request)
    {
        $arrayIDsProdutos = $request->idProdutos;
        // dd($arrayIDsProdutos);
        // for($i =0; $<$arrayCount; $i++){

        // }
        // $consultaProduto = array();
        foreach ($arrayIDsProdutos as $idprod) {
            $consultaProduto[] = DB::select('SELECT produtos.id, produtos.nome, produtos.descr, produtos.valor_uni_tributavel, fotos.id_foto, fotos.id_produto, fotos.nome_arquivo FROM produtos LEFT JOIN fotos ON fotos.id_produto = produtos.id WHERE produtos.id = ?', [$idprod]);
            // $arrayProdutos[] = $consultaProduto;
        }

        $consultaProduto = response()->json($consultaProduto);
        // dd($consultaProduto);
       // criando botoes de ações da tabela
        return DataTables::of($consultaProduto)
            ->addColumn('action', function ($consultaProduto) {
                return
                    '<button onclick="" class="btn btn-secondary btn-acoes"><i class="fas fa-eye"></i></button>';
            })->make(true);
        // return response()->json($arrayProdutos);
    }
}
