<?php

namespace App\Http\Controllers;

use App\Models\CodigoEmail;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\TokenUser;
use Carbon\Carbon;
use App\Jobs\RenovaCache;
use App\Jobs\EnviarEmail;
use Illuminate\Support\Facades\Cache;
use App\Jobs\AutenticaJob;

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

            
            Cache::forget('todos_cadastros');
            Cache::forget('dashboard_samsung');
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


            if($usuario->dupla_autentica == "1"){
                AutenticaJob::dispatch($usuario);
                $data = [
                    'erro' => 'n',
                    'msg' => 'autentica_ativa', 

                ];

                return response()->json($data, 200);

            }
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

    public function digita_codigo(Request $request){

        return view('digita_codigo');

    }

    public function enviar_codigo(Request $request){

    $request->validate([
        'email' => 'required',
        'codigo' => 'required'
    ]);

    $codigo = CodigoEmail::where('email', $request->email)
        ->where('codigo','=' ,$request->codigo)
        ->where('valido_ate', '>', Carbon::now())->get()->first();

        if($codigo){
            $usuario = Usuario::where('email', $request->email)->get()->first();
            TokenUser::where('user_id', $usuario->id)->delete();
            $token = new TokenUser();
            $token->user_id = $usuario->id;
            $data = date("Y-m-d H:i:s");
            $token->token = md5($usuario->id . $usuario->email . $data);
            $agora = Carbon::now();
            $agora->addDays(7);
            $token->valido_ate = $agora;
            $token->save();

            CodigoEmail::where('email','=', $request->email)->delete();

            $data = [
                'erro' => 'n',
                'msg' => 'Código correto! Usuário autenticado.',
                'token' => $token->token
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

            
            Cache::forget('todos_cadastros');
                        ('usuario_' . $request->id_cadastro);
            Cache::forget('dashboard_samsung');
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
        $usuario = Cache::remember('usuario_' . $id, now()->addMinutes(10), function() use ($id) {
            return Usuario::find($id);
        });

        $data = [
            'erro' => 'n',
            'usuario' => $usuario,
        ];

        return response()->json($data, 200);
    }


    public function todos_cadastros(Request $request)
    {
        $usuarios = Cache::rememberForever('todos_cadastros', function() {
            return Usuario::all();
        });

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

        
        Cache::forget('todos_cadastros');
        Cache::forget('usuario_' . $request->id_cadastro);
        Cache::forget('dashboard_samsung');
        RenovaCache::dispatch();

        $data = [
            'erro' => 'n',
            'usuario' => $usuario,
        ];

        return response()->json($data, 200);
    }

    public function testa_email($id_usuario){
        $usuario = Usuario::find($id_usuario);
        EnviarEmail::dispatch($usuario);

        $data = [
            'message' => 'Email enviado para a fila de processamento',
            'usuario' => $usuario
        ];

        return response()->json($data);
    }

    // Adicione estes métodos ao final do seu UsuarioController.php

public function ativar_2fa(Request $request)
{
    try {
        $request->validate([
            'email' => 'required|email'
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if (!$usuario) {
            return response()->json([
                'erro' => 's',
                'msg' => 'E-mail não encontrado'
            ]);
        }

        if ($usuario->dupla_autentica == "1") {
            return response()->json([
                'erro' => 's',
                'msg' => '2FA já está ativo para esta conta'
            ]);
        }

        // Gerar código diretamente (sem fila)
        $codigo = rand(100000, 999999);
        $valido_ate = Carbon::now()->addMinutes(10);

        // Salvar código no banco
        CodigoEmail::updateOrCreate(
            ['email' => $request->email],
            [
                'codigo' => $codigo,
                'valido_ate' => $valido_ate
            ]
        );

        // Salvar o email na sessão para usar depois
        session(['email_ativar_2fa' => $request->email]);
        session(['codigo_2fa' => $codigo]);

        return response()->json([
            'erro' => 'n',
            'msg' => 'Código gerado! Verifique no banco de dados.',
            'codigo' => $codigo // Mostra o código no console do navegador
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'erro' => 's',
            'msg' => 'Erro: ' . $e->getMessage()
        ]);
    }
}

public function confirmar_ativar_2fa(Request $request)
{
    try {
        $request->validate([
            'email' => 'required|email',
            'codigo' => 'required|string|size:6'
        ]);

        $codigoValido = CodigoEmail::where('email', $request->email)
            ->where('codigo', $request->codigo)
            ->where('valido_ate', '>', Carbon::now())
            ->first();

        if (!$codigoValido) {
            return response()->json([
                'erro' => 's',
                'msg' => 'Código inválido ou expirado. Gere um novo código.'
            ]);
        }

        // Ativar 2FA
        $usuario = Usuario::where('email', $request->email)->first();
        $usuario->dupla_autentica = "1";
        $usuario->save();

        // Limpar código usado
        CodigoEmail::where('email', $request->email)->delete();
        
        // Limpar sessão
        session()->forget(['email_ativar_2fa', 'codigo_2fa']);

        return response()->json([
            'erro' => 'n',
            'msg' => '2FA ativado com sucesso!'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'erro' => 's',
            'msg' => 'Erro: ' . $e->getMessage()
        ]);
    }
}

}