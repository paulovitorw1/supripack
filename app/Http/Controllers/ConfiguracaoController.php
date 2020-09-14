<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    //**************************FUNÇÕES PARA OS CARDS DE DESTAQUE*********************************************//
    //********************************************************************************************************//
    public function cardsDestaque()
    {
        //Consulta img para carousel tela de config
        $consultaImagemCarusel = DB::select('SELECT * FROM e_carousel WHERE e_carousel.status = 1');
        return view('Administrativo.adminCarouselAndCards/cardsDestaque', compact('consultaImagemCarusel'));
    }
}
