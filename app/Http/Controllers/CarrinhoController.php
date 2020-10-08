<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
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

        $ocococo = new Collection;
        foreach ($arrayIDsProdutos as $idprod) {
            $consultaProduto = DB::table('produtos')
                ->select('id', 'nome', 'descr', 'valor_uni_tributavel', 'id_foto', 'id_produto', 'nome_arquivo')
                ->leftJoin('fotos', 'fotos.id_produto', '=', 'produtos.id')
                ->where('produtos.id', [$idprod])
                ->get();
            foreach ($consultaProduto as $ddd) {
                $ocococo->push($ddd);
            }
        }
        // dd($ocococo);
        return DataTables::of($ocococo)
            ->addColumn('action', function ($ocococo) {
                return
                    '<div class="cart_quantity_button">
                    <a class="cart_quantity_up " href="javascript:void(0)" onclick="quantdd(' . $ocococo->id . ')" id="mais">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;"> + </font>
                        </font>
                    </a>
                    <input class="cart_quantity_input valor' . $ocococo->id . '" type="text" name="quantity" value="1"
                        autocomplete="off" size="2">
                    <a class="cart_quantity_down" href="javascript:void(0)" onclick="quantRemove(' . $ocococo->id . ');"id="menos">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;"> - </font>
                        </font>
                    </a>
                </div>';
            })
            ->addColumn('sssss', function ($ocococo) {
                return
                    '<button onclick="" class="btn btn-secondary btn-acoes"><i class="fas fa-eye"></i></button>';
            })
            ->rawColumns(['action', 'sssss'])
            ->toJson();

        // ->make(true);
        // return response()->json($arrayProdutos);
    }
}
