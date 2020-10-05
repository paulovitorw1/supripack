<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $dasdas = array();
        // dd($arrayIDsProdutos);
        // for($i =0; $<$arrayCount; $i++){

        // }
        $arrayProdutos = array();
        foreach ($arrayIDsProdutos as $idprod) {
            $consultaProduto = DB::select('SELECT produtos.id, produtos.nome, produtos.descr, fotos.id_foto, fotos.id_produto, fotos.nome_arquivo FROM produtos LEFT JOIN fotos ON fotos.id_produto = produtos.id WHERE produtos.id = ?', [$idprod['produto_id']]);
            $arrayProdutos[] = $consultaProduto;
        }
        return response()->json($arrayProdutos);
    }
}
