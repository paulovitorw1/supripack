<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CadastroUsuarioController extends Controller
{


    //
    public function cadastroUser(Request $request)
    {
        //validação
        $this->validate($request, [
            'nome' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6',

        ]);

        $addUser = User::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'id_e_permissao_fk' => 1
        ]);

        return response()->json($addUser);
    }
}
