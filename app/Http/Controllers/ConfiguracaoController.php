<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfiguracaoController extends Controller
{
    //
    public function indexConfiguracao()
    {
        return view('Painel.config');
    }
    public function carousel()
    {
        $consultaImagemCarusel = DB::select('SELECT * FROM e_carousel WHERE e_carousel.status = 1');

        return view('Administrativo.adminCarouselAndCards/carousel', compact('consultaImagemCarusel'));
    }
    public function carouselAdd(Request $request)
    {
        $uploadnameNovo = null;
        // $ttttt = array($request->file('testeaaa')[0]);
        if ($request->hasFile('testeaaa')) {
            //pegando o falor que tem na input
            $image = $request->file('testeaaa')[0];
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
    public function editarCarousel(Request $request)
    {

        $uploadnameNovo = null;
        if ($request->hasFile('imgEditar')) {
            //pegando o falor que tem na input
            $image = $request->file('imgEditar')[0];
            dd($image);
            //recuperando o nome do arquivo e nomeando com a data atual
            //Tirando todos os espaços em branco do nome da imagem
            $uploadnameNovo = str_replace(' ', '', time() . '.' . $image->getClientOriginalExtension());
            //salvando na pasta /img_carousel
            //Se a pasta não existir é criado automaticamente 
            $destinationPath = public_path('/img_carousel');
            //MOVENDO A IMAGEM PARA DENTRO DA PASTA
            $image->move($destinationPath, $uploadnameNovo);
        }
        if ($uploadnameNovo != null) {
            foreach ($image as $ssfff) {
                dd($ssfff->getClientOriginalName());
                $editarImg = Carousel::find($request->idImgEditar);
                $editarImg->imagem = $uploadnameNovo;
                $editarImg->update();
            }
        }

        // dd($editarImg);
    }
}
