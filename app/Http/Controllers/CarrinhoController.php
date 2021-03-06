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
    //LISTANDO OS PRODUTOS
    public function listaProduto(Request $request)
    {
        $arrayIDsProdutos = $request->idProdutos;

        $collectionConsultaProd = new Collection;
        foreach ($arrayIDsProdutos as $idprod) {
            $consultaProduto = DB::table('produtos')
                ->select('id', 'nome', 'descr', 'valor_uni_tributavel', 'id_foto', 'id_produto', 'nome_arquivo')
                ->leftJoin('fotos', 'fotos.id_produto', '=', 'produtos.id')
                ->where('produtos.id', [$idprod])
                ->get();
            foreach ($consultaProduto as $valorConsulta) {
                $collectionConsultaProd->push($valorConsulta);
            }
        }

        // dd($collectionConsultaProd);
        return DataTables::of($collectionConsultaProd)
            ->addColumn('valorUnidade', function ($collectionConsultaProd) {
                return '<p class="valorUnidade' . $collectionConsultaProd->id . ' tdvalorUnidade">' . $collectionConsultaProd->valor_uni_tributavel . '</p>';
            })
            ->addColumn('action', function ($collectionConsultaProd) {
                return
                    '<div class="cart_quantity_button">
                    <a class="cart_quantity_down" href="javascript:void(0)" onclick="quantRemove(' . $collectionConsultaProd->id . ');"id="menos">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;"> - </font>
                    </font>
                </a>
                    <input class="cart_quantity_input valor' . $collectionConsultaProd->id . '" type="text" name="quantity" value="1"
                        autocomplete="off" size="2" disabled>
                        <a class="cart_quantity_up " href="javascript:void(0)" onclick="quantdd(' . $collectionConsultaProd->id . ')" id="mais">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;"> + </font>
                        </font>
                    </a>
                </div>';
            })
            ->addColumn('removeProduto', function ($collectionConsultaProd) {
                return
                    '<a class="cart_quantity_delete" href="javascript:void(0)" onclick="removeProduto(' . $collectionConsultaProd->id . ');"><i class="fa fa-times"></i></a>';
            })
            ->addColumn('valorTotal', function ($collectionConsultaProd) {

                return '<p class="valorTotal' . $collectionConsultaProd->id . ' tdvalorTotal">' . $collectionConsultaProd->valor_uni_tributavel . '</p>';
            })
            ->rawColumns(['valorUnidade', 'action', 'valorTotal', 'removeProduto'])
            ->toJson();

        // ->make(true);
        // return response()->json($arrayProdutos);
    }
    public function editColunaDt(Request $request)
    {
        // $hshshsh = $request->
    }
    public function consultaCupom(Request $request)
    {
        $nomeCupom = strtoupper($request->nomeCupom);
        $responseRetorno = array();
        $consultaCupom = DB::select('SELECT * FROM e_cupom WHERE e_cupom.nome_cupom = ? AND e_cupom.cupom_quantidade >= 1 AND e_cupom.status = 1', [$nomeCupom]);
        if ($consultaCupom != null) {
            if ($consultaCupom[0]->status_uso != 3) {
                return response()->json($consultaCupom);
            } else {
                $responseErro['cupomErro'] = 0;
                return response()->json($responseErro);
            }
        } else {
            $responseErro['cupomErro'] = 0;
            return response()->json($responseErro);
        }
    }
}
