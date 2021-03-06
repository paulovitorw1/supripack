<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\ProdutoDestaque;
use App\Models\Cupom;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Contracts\DataTable;
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
    //********************************************************************************************************//
    //**************************************FUNÇÕES PARA OS CUPOM ********************************************//
    //********************************************************************************************************//
    public function viewCupom(Request $request)
    {
        //Consultado todos os cupons
        $consultaCupons = DB::select('SELECT * FROM e_cupom WHERE e_cupom.status = 1');
        if ($request->ajax()) {

            return DataTables::of($consultaCupons)
                ->addColumn('action', function ($consultaCupons) {
                    return
                        '<div class="divBtnAcoes">' .
                        '<button onclick="viewCupom(' . $consultaCupons->e_id_cupom . ')" class="btn btn-secondary btn-acoes"><i class="fas fa-eye"></i></button>' .
                        '<button onclick="editarCupom(' . $consultaCupons->e_id_cupom . ')" class="btn btn-secondary btn-acoes"><i class="fas fa-edit"></i></button>' .
                        '<button onclick="deleteCupom(' . $consultaCupons->e_id_cupom . ')" class="btn btn-secondary btn-acoes"><i class="fas fa-trash"></i></button>' .
                        '</div>';
                })->make(true);
        }
        return view('Administrativo.adminCarouselAndCards/cupom');
    }
    public function addCupom(Request $request)
    {
        $dataValidadeCupomMysql = null;
        $valorCupom = null;

        if ($request->porcentagemOUvalorreal == 1) {
            // $valorCupom = preg_replace('/[^0-9]/', '', substr($request->valorCupom, 0, -2));
            $removeVp = str_replace('.', '', $request->valorCupom);
            $valorCupom = str_replace(',', '.', $removeVp);
        } else {
            //
            $valorCupom = str_replace(',', '.', substr($request->valorCupom, 0, -1));
        }

        // $dataddd = date_format('Y-m-d H:i:s', strtotime());
        if ($request->validadeCupom != null) {
            $dataValidadeCupomMysql = DateTime::createFromFormat('d/m/Y', $request->validadeCupom);
            $dataValidadeCupomMysql->format('Y-m-d');
        }
        //Verificando se o nome do cupom digitado já existe na base de dados
        $consultaVerifcupom = DB::select('SELECT nome_cupom FROM e_cupom WHERE nome_cupom = ? ', [$request->nomecupom]);
        // $user = DB::select('SELECT * FROM users');
        //VALIDANDO E PASSANDO AS REGAS
        $validacaoRegras = [
            'tipoCupom' => 'required',
            'nomecupom' => 'required',
            'porcentagemOUvalorreal' => 'required',
            'valorCupom' => 'required',
            'cupomQuantidade' => 'required',
            'validadeCupom' => 'required',

        ];
        //PERSONALIZANDO AS MENSAGENS DE ERRO
        $mensagensPersonalizada = [
            //CAMPOS PADRÃO
            'required' => 'O campo :attribute é obrigatório.',
            // /*PERSONALIZANDO*/
            // //PESSOA FÍSICA
            'porcentagemOUvalorreal.required' => 'O campo tipo valor é obrigatorio.',
            'nomecupom.required' => 'O campo nome do cupom é obrigatorio.',
            'cupomQuantidade.required' => 'O campo quantidade de cupom é obrigatorio.',

        ];
        if ($consultaVerifcupom == null) {
            $this->validate($request, $validacaoRegras, $mensagensPersonalizada);
            $addCupom  = Cupom::create([
                'e_id_usuario_addCupom' => 3,
                'tipo_cupom' => $request->tipoCupom,
                'nome_cupom' => strtoupper($request->nomecupom),
                'porcentagemOUvalorreal' => $request->porcentagemOUvalorreal,
                'valor_cupom' => $valorCupom,
                'cupom_quantidade' => $request->cupomQuantidade,
                'data_validade' => $dataValidadeCupomMysql,
            ]);
            return response()->json($addCupom);
        } else {
            $mensagemE['cupomErrro'] = 1;
            return response()->json($mensagemE);
        }
    }
    public function visualizarCupom(Request $request)
    {
        $idCupomEdite = $request->idCupomEdit;
        $consultaVerifcupom = DB::select('SELECT * FROM e_cupom WHERE e_id_cupom = ? ', [$idCupomEdite]);

        return response()->json($consultaVerifcupom);
    }
    public function atualizarCupom(Request $request)
    {
        $dataValidadeCupomMysql = null;
        $valorCupom = null;

        if ($request->editporcentagemOUvalorreal == 1) {
            // $valorCupom = preg_replace('/[^0-9]/', '', substr($request->editvalorCupom, 0, -2));
            $removeVp = str_replace('.', '', $request->editvalorCupom);
            $valorCupom = str_replace(',', '.', $removeVp);
        } else {
            //
            $valorCupom = str_replace(',', '.', substr($request->editvalorCupom, 0, -1));
        }

        // $dataddd = date_format('Y-m-d H:i:s', strtotime());
        if ($request->editvalidadeCupom != null) {
            $dataValidadeCupomMysql = DateTime::createFromFormat('d/m/Y', $request->editvalidadeCupom);
            $dataValidadeCupomMysql->format('Y-m-d');
        }
        //Verificando se o nome do cupom digitado já existe na base de dados
        $consultaVerifcupom = DB::select('SELECT nome_cupom FROM e_cupom WHERE nome_cupom = ? ', [$request->nomecupom]);
        //VALIDANDO E PASSANDO AS REGAS
        $regrasValidacao = [
            'edittipoCupom' => 'required',
            'editnomecupom' => 'required',
            'editporcentagemOUvalorreal' => 'required',
            'editvalorCupom' => 'required',
            'editcupomQuantidade' => 'required',
            'editvalidadeCupom' => 'required',

        ];
        //PERSONALIZANDO AS MENSAGENS DE ERRO
        $mensagensPersonalizada = [
            //CAMPOS PADRÃO
            'required' => 'O campo :attribute é obrigatório.',
            // /*PERSONALIZANDO*/
            'editporcentagemOUvalorreal.required' => 'O campo tipo valor é obrigatorio.',
            'edittipoCupom.required' => 'O campo nome do cupom é obrigatorio.',
            'editcupomQuantidade.required' => 'O campo quantidade de cupom é obrigatorio.',

        ];
        $this->validate($request, $regrasValidacao, $mensagensPersonalizada);

        $idCupomEdite = $request->idCupomEdit;
        $editarcupom = Cupom::find($idCupomEdite);
        $editarcupom->e_id_usuario_editCupom = 2;
        $editarcupom->tipo_cupom = $request->edittipoCupom;
        $editarcupom->nome_cupom = strtoupper($request->editnomecupom);
        $editarcupom->porcentagemOUvalorreal = $request->editporcentagemOUvalorreal;
        $editarcupom->valor_cupom = $valorCupom;
        $editarcupom->cupom_quantidade = $request->editcupomQuantidade;
        $editarcupom->data_validade = $dataValidadeCupomMysql;

        $editarcupom->update();


        return response()->json($editarcupom);
    }
    public function deleteCupom(Request $request)
    {
        $idCupomDelete = $request->idCupom;
        $deletecupom = Cupom::find($idCupomDelete);
        $deletecupom->status = 2;
        $deletecupom->status_uso = 3;
        $deletecupom->update();

        return response()->json($deletecupom);
    }

    //Validacao dos campos, validacao personalizadas
    public function validacaoPersoanalizada(Request $request)
    {
        // $user = DB::select('SELECT * FROM users');
        //VALIDANDO E PASSANDO AS REGAS
        $validacaoRegras = [
            'tipoCupom' => 'required',
            'nomecupom' => 'required',
            'porcentagemOUvalorreal' => 'required',
            'valorCupom' => 'required',
            'cupomQuantidade' => 'required',
            'validadeCupom' => 'required',

        ];
        //PERSONALIZANDO AS MENSAGENS DE ERRO
        $mensagensPersonalizada = [
            //CAMPOS PADRÃO
            'required' => 'O campo :attribute é obrigatório.',
            // /*PERSONALIZANDO*/
            // //PESSOA FÍSICA
            'porcentagemOUvalorreal.required' => 'O campo tipo valor é obrigatorio.',
            'nomecupom.required' => 'O campo nome do cupom é obrigatorio.',
            'cupomQuantidade.required' => 'O campo quantidade de cupom é obrigatorio.',

        ];
        $this->validate($request, $validacaoRegras, $mensagensPersonalizada);
    }
}
