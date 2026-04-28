<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\TokenUser;
use Carbon\Carbon;
use App\Jobs\RenovaCache;

class UsuarioController extends Controller
{
    public function cadastra_usuario(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'telefone' => 'required',
            'nome' => 'required',
            'nascimento' => 'required',
            'genero' => 'required',
            'senha' => 'required'
        ]);

        try {
            $usuario = new Usuario();
            $usuario->email = $request->email;
            $usuario->telefone = $request->telefone;
            $usuario->nome = $request->nome;
            $usuario->nascimento = $request->nascimento;
            $usuario->genero = $request->genero;
            $usuario->senha = md5($request->senha);
            $usuario->save();

            // Novo usuário cadastrado: renova o cache
            RenovaCache::dispatch();

            $data = [
                'erro' => 'n',
                'data' => $usuario,
            ];

            return response()->json($data, 200);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function login_usuario(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'senha' => 'required'
        ]);

        $usuario = Usuario::where('email', '=', $request->email)
            ->where('senha', '=', md5($request->senha))
            ->first();

        if ($usuario) {
            TokenUser::where('user_id', $usuario->id)->delete();
            
            $token = new TokenUser();
            $token->user_id = $usuario->id;
            $data_atual = date("Y-m-d H:i:s");
            $token->token = md5($usuario->id . $usuario->email . $data_atual);
            $agora = Carbon::now();
            $agora->addDays(7);
            $token->valido_ate = $agora;
            $token->save();

            $data = [
                'erro' => 'n',
                'msg' => 'Usuário Logado',
                'token' => $token->token
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'erro' => 's',
                'msg' => 'Usuário não encontrado ou senha inválida'
            ];

            return response()->json($data, 200);
        }
    }

    public function altera_cadastro(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'telefone' => 'required',
            'nascimento' => 'required',
            'genero' => 'required',
            'id_cadastro' => 'required'
        ]);

        try {
            $usuario = Usuario::find($request->id_cadastro);
            $usuario->nome = $request->nome;
            $usuario->email = $request->email;
            $usuario->telefone = $request->telefone;
            $usuario->nascimento = $request->nascimento;
            $usuario->genero = $request->genero;
            
            if ($request->has('senha') && !empty($request->senha)) {
                $usuario->senha = md5($request->senha);
            }
            
            $usuario->save();

            // Usuário alterado: renova o cache
            RenovaCache::dispatch();

            $data = [
                'erro' => 'n',
                'usuario' => $usuario,
            ];

            return response()->json($data, 200);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function exibe_cadastro($id)
    {
        $usuario = Usuario::find($id);

        $data = [
            'erro' => 'n',
            'usuario' => $usuario,
        ];

        return response()->json($data, 200);
    }

    public function todos_cadastros(Request $request)
    {
        $usuarios = Usuario::all();

        $data = [
            'erro' => 'n',
            'usuarios' => $usuarios,
        ];

        return response()->json($data, 200);
    }

    public function visualiza_cadastro($id_cadastro)
    {
        $usuario = Usuario::find($id_cadastro);

        return view('perfil')->with('usuario', $usuario);
    }

    public function deleta_cadastro($id_cadastro)
    {
        $usuario = Usuario::find($id_cadastro);

        return view('deleta_cadastro')->with('usuario', $usuario);
    }

    public function apagar_cadastro(Request $request)
    {
        $request->validate([
            'id_cadastro' => 'required',
        ]);

        $usuario = Usuario::find($request->id_cadastro);
        $usuario->delete();

        // Usuário deletado: renova o cache
        RenovaCache::dispatch();

        $data = [
            'erro' => 'n',
            'usuario' => $usuario,
        ];

        return response()->json($data, 200);
    }
}