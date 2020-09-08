<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfiguracaoController extends Controller
{
    //
    public function indexConfiguracao()
    {
        return view('Painel.config');
    }
    public function carousel()
    {
        return view('Administrativo.adminCarouselAndCards/carousel');
    }
    public function carouselAdd(Request $request)
    {
        // $ttttt = array($request->file('testeaaa')[0]);
        if ($request->hasFile('testeaaa')) {
            //pegando o falor que tem na input
            $image = $request->file('testeaaa')[0];
            // dd($image);
            //recuperando a extensao do arquivo e nomeando com a data atual
            $uploadnameNovo = time() . '.' . $image->getClientOriginalName();
            //salvando na pasta /img_usuario
            //Se a pasta não existir é criado automaticamente 
            $destinationPath = public_path('/img_carousel');
            //MOVENDO A IMAGEM PARA DENTRO DA PASTA
            $image->move($destinationPath, $uploadnameNovo);
        }
        return $image;
        // return $request;
    }
}
