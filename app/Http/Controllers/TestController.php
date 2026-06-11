<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SamsungModel;
use Illuminate\Support\Facades\Cache;

class TestController extends Controller
{
    public function salva_samsung(Request $request)  
{
    $request->validate([
        'cor' => 'required',
        'ano' => 'required',
        'modelo' => 'required',
        'aparelho' => 'required',
        'preco' => 'required|numeric|min:0',
        'estoque' => 'required|integer|min:0',
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
        $samsung->preco = $request->preco;
        $samsung->estoque = $request->estoque;
        $samsung->imagem_url = $request->imagem_url;
        $samsung->descricao = $request->descricao;
        $samsung->user_id = $usuario->id;
        $samsung->save();

        Cache::forget('todos_samsung');
        Cache::forget('samsung_' . $samsung->id);
        Cache::forget('dashboard_samsung'); 

        return response()->json([
            'erro' => 'n',
            'samsung' => $samsung,
        ], 200);

    } catch(\Throwable $th) {
        return response()->json([
            'erro' => 's',
            'msg' => $th->getMessage()
        ], 500);
    }
}
    public function exibe_samsung($id)
    {
        $samsung = Cache::remember('samsung_' . $id, now()->addMinutes(10), function() use ($id) {
            return SamsungModel::find($id);
        });

        $data = [
            'erro' => 'n',
            'samsung' => $samsung,
        ];

        return response()->json($data, 200);
    }

 
    public function todos_samsung(Request $request)
    {
        $samsung = Cache::rememberForever('todos_samsung', function() {
            return SamsungModel::get()->all();
        });

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
            $usuario = $request->usuario;
            $samsung = SamsungModel::find($request->id_loja);
            
            if (!$samsung) {
                return response()->json([
                    'erro' => 's',
                    'msg' => 'Produto não encontrado'
                ], 404);
            }
            
            if ($samsung->user_id != $usuario->id) {
                return response()->json([
                    'erro' => 's',
                    'msg' => 'Você não tem permissão para alterar este produto'
                ], 403);
            }
            
            $samsung->cor = $request->cor;
            $samsung->ano = $request->ano;
            $samsung->modelo = $request->modelo;
            $samsung->aparelho = $request->aparelho;
            $samsung->save();

            
            Cache::forget('todos_samsung');
            Cache::forget('samsung_' . $samsung->id);
            Cache::forget('dashboard_samsung');

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
            $usuario = $request->usuario;
            $samsung = SamsungModel::find($request->id_loja);
            
            if (!$samsung) {
                return response()->json([
                    'erro' => 's',
                    'msg' => 'Produto não encontrado'
                ], 404);
            }
            
            if ($samsung->user_id != $usuario->id) {
                return response()->json([
                    'erro' => 's',
                    'msg' => 'Você não tem permissão para deletar este produto'
                ], 403);
            }
            
            $samsung->delete();

            
            Cache::forget('todos_samsung');
            Cache::forget('samsung_' . $request->id_loja);
            Cache::forget('dashboard_samsung');

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