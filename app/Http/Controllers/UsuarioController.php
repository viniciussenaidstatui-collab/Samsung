<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function cadastro_usuario(Request $request)
    {

    $request->validate(  [
        'email' => 'required',
        'telefone' => 'required',
        'nome' => 'required',
        'nascimento' => 'required',
        'genero' => 'required',
        'senha' => 'required'

    ]);

        try {
            $usuario = new Usuario;
            $usuario->email = $request->email;
            $usuario->telefone = $request->telefone;
            $usuario->nome = $request->nome;
            $usuario->nascimento = $request->nascimento;
            $usuario->genero = $request->genero;
            $usuario->senha = md5($request->senha);
            $usuario->save();

            $data = [
                'erro' => 'n',
                'data' => $usuario,
            ];

            return response()->json($data, 200);

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
