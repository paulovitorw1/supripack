<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\ProdutoDestaque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class ConfiguracaoController extends Controller
{
    //LAYOUT PADRÃO DE CONFIGURACAO
    public function indexConfiguracao()
    {
        return view('Painel.config');
    }

    //********************************************************************************************************//
    //************************************FUNÇÕES PARA OS SLIDE***********************************************//
    //********************************************************************************************************//

    //CAROUSEL
    public function carousel()
    {
        //Consulta img para carousel tela de config
        $consultaImagemCarusel = DB::select('SELECT * FROM e_carousel WHERE e_carousel.status = 1');

        return view('Administrativo.adminCarouselAndCards/carousel', compact('consultaImagemCarusel'));
    }
    //ADICINAOD 
    public function carouselAdd(Request $request)
    {
        $uploadnameNovo = null;
        if ($request->hasFile('addImgCarousel')) {
            //pegando o falor que tem na input
            $image = $request->file('addImgCarousel')[0];
            //recuperando o nome do arquivo e nomeando com a data atual
            //Tirando todos os espaços em branco do nome da imagem
            $uploadnameNovo = str_replace(' ', '', time() . '.' . $image->getClientOriginalName());
            //salvando na pasta /img_carousel
            //Se a pasta não existir é criado automaticamente 
            $destinationPath = public_path('/img_carousel');
            //MOVENDO A IMAGEM PARA DENTRO DA PASTA
            $image->move($destinationPath, $uploadnameNovo);
        }
        if ($uploadnameNovo != null) {
            $addImagens = Carousel::create([
                'imagem' => $uploadnameNovo,
                'e_carouselordem' => '1'
            ]);
        }

        return response()->json($uploadnameNovo);
        // return $request;
    }
    //Editando a img do carousel
    public function editarCarousel(Request $request)
    {

        $uploadnameNovo = null;
        if ($request->hasFile('imgEditar')) {
            //pegando o falor que tem na input
            $arrayIDimg = array(
                'img' => $image = $request->file('imgEditar'),
                'id' => $request->idImgEditar
            );
            // dd($arrayIDimg);
            $image = $request->file('imgEditar');
            for ($i = 0; $i < count($arrayIDimg['id']); $i++) {
                $chaveIdArray = key($image);
                //recuperando o nome do arquivo e nomeando com a data atual
                //Tirando todos os espaços em branco do nome da imagem
                $uploadnameNovo = str_replace(' ', '', time() .  mt_rand() . '.' . $image[$chaveIdArray]->getClientOriginalExtension());
                //salvando na pasta /img_carousel
                //Se a pasta não existir é criado automaticamente 
                $destinationPath = public_path('/img_carousel');
                //MOVENDO A IMAGEM PARA DENTRO DA PASTA
                $image[$chaveIdArray]->move($destinationPath, $uploadnameNovo);
                $editarImg = Carousel::find($arrayIDimg['id'][$i]);
                $editarImg->imagem = $uploadnameNovo;
                $editarImg->update();
                next($image);
            }
        }
        return response()->json($editarImg);

        // dd($editarImg);
    }
    //Deletando (Mudando o status do registro)
    public function  deleteCarousel(Request $request)
    {
        //Pegando os IDs enviado por ajax
        $valorID = $request->idDelete;
        //percorrendo os id
        foreach ($valorID as $id) {
            $deleteImgCarousel = Carousel::find($id);
            $deleteImgCarousel->status = '0';
            $deleteImgCarousel->update();
        }
        return response()->json($deleteImgCarousel);
    }

    //********************************************************************************************************//
    //****************************FUNÇÕES PARA OS PRODUTOS DE DESTAQUE****************************************//
    //********************************************************************************************************//
    public function viewProdutoDestaque(Request $request)
    {
        //Consulta img para carousel tela de config
        $consultaProduto = DB::select('SELECT * FROM produtos  WHERE produtos.instit = 2');
        if ($request->ajax()) {
            return DataTables::of($consultaProduto)
                ->addColumn('action', function ($consultaProduto) {
                    if ($consultaProduto->status_destaque == 1) {
                        return
                            '<button onclick="viewProduto(' . $consultaProduto->id . ')" class="btn btn-secondary btn-acoes"><i class="fas fa-eye"></i></button>' .
                            // <i class="fas fa-minus-circle"></i>
                            '<button onclick="deleteDestaque(' . $consultaProduto->id . ')" class="btn btn-danger btn-acoes btn_' . $consultaProduto->id . '" title="excluir produto em destaque"><i class="fas fa-minus-circle"></i></button>';
                        // '<input type="checkbox" class="checkbox tesasdate" id="ssssss" name="checkboxDestaque[]" value="' . $consultaProduto->id . '" checked />';
                    } else {
                        return
                            '<button onclick="viewProduto(' . $consultaProduto->id . ')" class="btn btn-secondary btn-acoes"><i class="fas fa-eye"></i></button>' .
                            '<input type="checkbox" class="checkbox " name="checkboxDestaque" value="' . $consultaProduto->id . '" />';
                    }
                })->make(true);
        }
        return view('Administrativo.adminCarouselAndCards/cardsDestaque', compact('consultaProduto'));
    }
    public function viewProduto(Request $request)
    {
        $idproduto = $request->idProduto;

        //Consultando produto 
        $consultaProdutoID = DB::select('SELECT * FROM produtos INNER JOIN prod_grp ON prod_grp.id = produtos.grupo INNER JOIN fotos ON fotos.id_produto = produtos.id INNER JOIN e_produto_destaque ON e_produto_destaque.id_produto_fk = produtos.id WHERE produtos.id = 127', [$idproduto]);
        return response()->json($consultaProdutoID);
    }
    //Adicionando produto em destaque
    public function addDestaque(Request $request)
    {
        //recebendo 1 ou mais de 1 ID
        $idNovoDestaque = $request->chklistaPdestaque;
        //laço para percorrer todos os IDs e atualizar a coluna status_destaque
        foreach ($idNovoDestaque as $id) {
            $addDestaque = ProdutoDestaque::find($id);
            $addDestaque->status_destaque = 1;
            $addDestaque->update();
        }
        return response()->json($addDestaque);
    }
    //Deletando produtos em destaque
    public function deleteDestaque(Request $request)
    {
        //recebendo o ID do produto
        $idProduto = $request->idProdutoDest;
        //pegar o produto e a atulizar seu status para 0
        $deleteProdutoDestaque = ProdutoDestaque::find($idProduto);
        $deleteProdutoDestaque->status_destaque = 0;
        $deleteProdutoDestaque->update();
        return response()->json($deleteProdutoDestaque);
    }
}
