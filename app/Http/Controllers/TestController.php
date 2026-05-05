<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SamsungModel;

class TestController extends Controller
{
    public function salva_samsung(Request $request)  
    {
        $request->validate([
            'cor' => 'required',
            'ano' => 'required',
            'modelo' => 'required',
            'aparelho' => 'required'
        ]);

        try {

          $usuario = $request->usuario;

           if (!$usuario) {
            return response()->json([
                'erro' => 's',
                'msg' => 'Usuário não identificado'
            ], 401);
        }
            $samsung = new SamsungModel();
            $samsung->cor = $request->cor;
            $samsung->ano = $request->ano;
            $samsung->modelo = $request->modelo;
            $samsung->aparelho = $request->aparelho;
            $samsung->user_id = $usuario->id;
            $samsung->save();

            $data = [
                'erro' => 'n',
                'samsung' => $samsung,
            ];

            return response()->json($data, 200);

        } catch(\Throwable $th) {
            return response()->json([
                'erro' => 's',
                'msg' => $th->getMessage()
            ], 500);
        }
    }
    public function exibe_samsung($id)
    {
        $samsung = SamsungModel::find($id);

        $data = [
            'erro' => 'n',
            'samsung' => $samsung,
        ];

        return response()->json($data, 200);
    }

    public function todos_samsung(Request $request)
    {
        $samsung = SamsungModel::get()->all();

        $data = [
            'erro' => 'n',
            'samsung' => $samsung,
        ];

        return response()->json($data, 200);
    }

    public function mostra_loja($id_loja)
    {
        $samsung = SamsungModel::find($id_loja);

        return view('alterar')->with('samsung', $samsung);
    }

    public function altera_loja(Request $request)
    {
        $request->validate([
            'cor' => 'required',
            'ano' => 'required',
            'modelo' => 'required',
            'aparelho' => 'required',
            'id_loja' => 'required'
        ]);

        try {
        $usuario = $request->usuario; // USUÁRIO LOGADO
        
        // BUSCAR O PRODUTO
        $samsung = SamsungModel::find($request->id_loja);
        
        if (!$samsung) {
            return response()->json([
                'erro' => 's',
                'msg' => 'Produto não encontrado'
            ], 404);
        }
        
        // VERIFICAR SE O USUÁRIO É O DONO
        if ($samsung->user_id != $usuario->id) {
            return response()->json([
                'erro' => 's',
                'msg' => 'Você não tem permissão para alterar este produto'
            ], 403); // 403 = Forbidden
        }
        
        // SE PASSOU NA VERIFICAÇÃO, ALTERA
        $samsung->cor = $request->cor;
        $samsung->ano = $request->ano;
        $samsung->modelo = $request->modelo;
        $samsung->aparelho = $request->aparelho;
        $samsung->save();

            $data = [
                'erro' => 'n',
                'samsung' => $samsung,
            ];

            return response()->json($data, 200);

        } catch(\Throwable $th) {
            throw $th;
        }
    }

    public function deleta_samsung($id_loja)
    {
        $samsung = SamsungModel::find($id_loja);

        return view('deleta_samsung')->with('samsung', $samsung);
    }

    public function deletar_samsung(Request $request)
    {
        $request->validate([
            'id_loja' => 'required'
        ]);

        try {
        $usuario = $request->usuario; // USUÁRIO LOGADO
        
        // BUSCAR O PRODUTO
        $samsung = SamsungModel::find($request->id_loja);
        
        if (!$samsung) {
            return response()->json([
                'erro' => 's',
                'msg' => 'Produto não encontrado'
            ], 404);
        }
        
        // VERIFICAR SE O USUÁRIO É O DONO
        if ($samsung->user_id != $usuario->id) {
            return response()->json([
                'erro' => 's',
                'msg' => 'Você não tem permissão para deletar este produto'
            ], 403); // 403 = Forbidden
        }
        
        // SE PASSOU NA VERIFICAÇÃO, DELETA
        $samsung->delete();

        $data = [
            'erro' => 'n',
            'msg' => 'Produto deletado com sucesso',
            'samsung' => $samsung
        ];

        return response()->json($data, 200);

        } catch(\Throwable $th) {
            throw $th;
        }
    }
}