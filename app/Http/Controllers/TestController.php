<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SamsungModel;

class TestController extends Controller
{
    public function envia_teste(Request $request) 
    
    {

    $data = [
        'palmeiras'=> "5x1",
        'Numero'=>$request->numero
    ];

    return response() ->json($data, 200);   
    }


    public function soma(Request $request) {
    $data = [
        'Soma' => $request->numero + $request->numero_dois,
    ];

    return response()->json($data, 200);

    }

    public function salva_samsung(Request $request)  {

    $request->validate(  [
        'cor' => 'required',
        'ano' => 'required',
        'modelo' => 'required',
        'aparelho' => 'required'

    ]);

    try {

    $samsung = new SamsungModel();
    $samsung->cor = $request -> cor;
    $samsung->ano = $request -> ano;
    $samsung->modelo = $request -> modelo;
    $samsung->aparelho = $request -> aparelho;
    $samsung->save();

    $data = [
            'erro' => 'n',
            'samsung' => $samsung,
    ];

    return response()->json($data,200);

    }catch(\Throwable $th) {
        throw $th;
        }

    }

    public function exibe_samsung($id)
    
    {
    $samsung=SamsungModel::find($id);

    return view('visualiza_cadastro')->with('id_samsung', $samsung->id);
    
    $data = [
            'erro' => 'n',
            'samsung' => $samsung,

    ];
    return response()->json($data, 200);


    }

    public function todos_samsung(Request $request)
    {
    $samsung=SamsungModel::get()->all();

    $data = [
            'erro' => 'n',
            'samsung' => $samsung,

    ];
    return response()->json($data, 200);
    }

    public function mostra_loja($id_loja){
    
    $loja = SamsungModel::find($id_loja);

    return view('alterar')->with('loja',$loja);

    }

    
    public function altera_loja(Request $request){

    $request->validate(  [
        'cor' => 'required',
        'ano' => 'required',
        'modelo' => 'required',
        'aparelho' => 'required'

    ]);

    try {

    $samsung = SamsungModel::find($request->id_loja);

   
    $samsung->cor = $request -> cor;
    $samsung->ano = $request -> ano;
    $samsung->modelo = $request -> modelo;
    $samsung->aparelho = $request -> aparelho;
    
    $samsung->save();

    $data = [
            'erro' => 'n',
            'samsung' => $samsung,
    ];

    return response()->json($data,200);

    }catch(\Throwable $th) {
        throw $th;
        }

    


    }
    
    public function deleta_samsung ($id_loja){
        $loja = SamsungModel::find($id_loja);


        return view ('deleta_samsung')->with('loja',$loja);



    }

    public function deletar_samsung (Request $request){
        $request->validate([
            'id_loja' => 'required'
        ]);

        try {
            $loja = SamsungModel::find ($request->id_loja);
            $loja-> delete();
            $data = [

            'erro' => 'n',
            'msg' => 'loja deletada'
            ];
            
        } catch (\Throwable $th) {
            throw $th;
        }


    }
    
    }