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
            //recuperando a extensao do arquivo e nomeando com a data atual
            $uploadnameNovo = time() . '.' . $image->getClientOriginalName();
            //salvando na pasta /img_usuario
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
}
