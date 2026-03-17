<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\TokenUser;
use Carbon\Carbon;

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
            $date =[
                'erro' => 's',
                'data' => 'erro ao se cadastrar'
            ];
        }

    }

    public function login_usuario(Request $request){

    $request -> validate([
    'email' => 'required',
    'senha' => 'required'
    ]);

    $usuario = Usuario::where('email',"=",$request->email)
    ->where('senha','=',md5($request->senha))->get()->first();

    if($usuario){
        TokenUser::where('user_id', $usuario->id)->delete();
        $token = new TokenUser();
        $token->user_id = $usuario->id;
        $data = date(format:"Y-m-d H:i:s");
        $token->token = md5($request->user_id . $usuario->email . $data);
        $agora = Carbon::now();
        $agora->addDays(7);
        $token->valido_ate = $agora;
        $token->save();

        $data = [
            'erro' => 'n',
            'msg' => 'Usuario Logado',
            'token' => $token->token

        ];

        return response()->json($data,200);

    }else{

      $data = [
            'erro' => 'n',
            'msg' => 'Usuario não encontrado',
            

        ];

        return response()->json($data,200);


    }


    }

}
