<?php

namespace App\Http\Controllers;

use App\Models\Boleto;
use App\Models\CodigoEmail;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\TokenUser;
use Carbon\Carbon;
use App\Jobs\RenovaCache;
use App\Jobs\EnviarEmail;
use App\Jobs\EnviarBoletoJob;
use Illuminate\Support\Facades\Cache;
use App\Jobs\AutenticaJob;
use App\Jobs\RecuperaSenhaJob;

class UsuarioController extends Controller
{
    public function cadastra_usuario(Request $request)
    {
        $request->validate([
            'email'      => 'required',
            'telefone'   => 'required',
            'nome'       => 'required',
            'nascimento' => 'required',
            'genero'     => 'required',
            'senha'      => 'required'
        ]);

        try {
            $usuario            = new Usuario();
            $usuario->email     = $request->email;
            $usuario->telefone  = $request->telefone;
            $usuario->nome      = $request->nome;
            $usuario->nascimento = $request->nascimento;
            $usuario->genero    = $request->genero;
            $usuario->senha     = md5($request->senha);
            $usuario->save();

            Cache::forget('todos_cadastros');
            Cache::forget('dashboard_samsung');
            RenovaCache::dispatch();

            return response()->json(['erro' => 'n', 'data' => $usuario], 200);

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

            if ($usuario->dupla_autentica == "1") {
                AutenticaJob::dispatch($usuario);
                return response()->json([
                    'erro' => 'n',
                    'msg'  => 'autentica_ativa',
                ], 200);
            }

            TokenUser::where('user_id', $usuario->id)->delete();

            $token           = new TokenUser();
            $token->user_id  = $usuario->id;
            $data_atual      = date("Y-m-d H:i:s");
            $token->token    = md5($usuario->id . $usuario->email . $data_atual);
            $agora           = Carbon::now()->addDays(7);
            $token->valido_ate = $agora;
            $token->save();

            return response()->json([
                'erro'  => 'n',
                'msg'   => 'Usuário Logado',
                'token' => $token->token
            ], 200);

        } else {
            return response()->json([
                'erro' => 's',
                'msg'  => 'Usuário não encontrado ou senha inválida'
            ], 200);
        }
    }

    public function digita_codigo(Request $request)
    {
        return view('digita_codigo');
    }

    public function enviar_codigo(Request $request)
    {
        $request->validate([
            'email'  => 'required',
            'codigo' => 'required'
        ]);

        $codigo = CodigoEmail::where('email', $request->email)
            ->where('codigo', '=', $request->codigo)
            ->where('valido_ate', '>', Carbon::now())
            ->first();

        if ($codigo) {
            $usuario = Usuario::where('email', $request->email)->first();

            TokenUser::where('user_id', $usuario->id)->delete();

            $token           = new TokenUser();
            $token->user_id  = $usuario->id;
            $data            = date("Y-m-d H:i:s");
            $token->token    = md5($usuario->id . $usuario->email . $data);
            $agora           = Carbon::now()->addDays(7);
            $token->valido_ate = $agora;
            $token->save();

            CodigoEmail::where('email', '=', $request->email)->delete();

            return response()->json([
                'erro'  => 'n',
                'msg'   => 'Código correto! Usuário autenticado.',
                'token' => $token->token
            ], 200);
        }

        return response()->json([
            'erro' => 's',
            'msg'  => 'Código inválido ou expirado.'
        ], 422);
    }

    public function altera_cadastro(Request $request)
    {
        $request->validate([
            'nome'        => 'required',
            'email'       => 'required',
            'telefone'    => 'required',
            'nascimento'  => 'required',
            'genero'      => 'required',
            'id_cadastro' => 'required'
        ]);

        try {
            $usuario             = Usuario::find($request->id_cadastro);
            $usuario->nome       = $request->nome;
            $usuario->email      = $request->email;
            $usuario->telefone   = $request->telefone;
            $usuario->nascimento = $request->nascimento;
            $usuario->genero     = $request->genero;

            if ($request->has('senha') && !empty($request->senha)) {
                $usuario->senha = md5($request->senha);
            }

            $usuario->save();

            // CORREÇÃO: linha estava quebrada antes — faltava Cache::forget(
            Cache::forget('todos_cadastros');
            Cache::forget('usuario_' . $request->id_cadastro);
            Cache::forget('dashboard_samsung');
            RenovaCache::dispatch();

            return response()->json(['erro' => 'n', 'usuario' => $usuario], 200);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function exibe_cadastro($id)
    {
        $usuario = Cache::remember('usuario_' . $id, now()->addMinutes(10), function () use ($id) {
            return Usuario::find($id);
        });

        return response()->json(['erro' => 'n', 'usuario' => $usuario], 200);
    }

    public function todos_cadastros(Request $request)
    {
        $usuarios = Cache::rememberForever('todos_cadastros', function () {
            return Usuario::all();
        });

        return response()->json(['erro' => 'n', 'usuarios' => $usuarios], 200);
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
        $request->validate(['id_cadastro' => 'required']);

        $usuario = Usuario::find($request->id_cadastro);
        $usuario->delete();

        Cache::forget('todos_cadastros');
        Cache::forget('usuario_' . $request->id_cadastro);
        Cache::forget('dashboard_samsung');
        RenovaCache::dispatch();

        return response()->json(['erro' => 'n', 'usuario' => $usuario], 200);
    }

    public function testa_email($id_usuario)
    {
        $usuario = Usuario::find($id_usuario);
        EnviarEmail::dispatch($usuario);

        return response()->json([
            'message' => 'Email enviado para a fila de processamento',
            'usuario' => $usuario
        ]);
    }

    // ─── 2FA ────────────────────────────────────────────────────────────────

    public function ativar_2fa(Request $request)
    {
        try {
            $request->validate(['email' => 'required|email']);

            $usuario = Usuario::where('email', $request->email)->first();

            if (!$usuario) {
                return response()->json(['erro' => 's', 'msg' => 'E-mail não encontrado']);
            }

            if ($usuario->dupla_autentica == "1") {
                return response()->json(['erro' => 's', 'msg' => '2FA já está ativo para esta conta']);
            }

            $codigo     = rand(100000, 999999);
            $valido_ate = Carbon::now()->addMinutes(10);

            CodigoEmail::updateOrCreate(
                ['email' => $request->email],
                ['codigo' => $codigo, 'valido_ate' => $valido_ate]
            );

            session(['email_ativar_2fa' => $request->email, 'codigo_2fa' => $codigo]);

            return response()->json([
                'erro'   => 'n',
                'msg'    => 'Código gerado! Verifique no banco de dados.',
                'codigo' => $codigo
            ]);

        } catch (\Exception $e) {
            return response()->json(['erro' => 's', 'msg' => 'Erro: ' . $e->getMessage()]);
        }
    }

    public function confirmar_ativar_2fa(Request $request)
    {
        try {
            $request->validate([
                'email'  => 'required|email',
                'codigo' => 'required|string|size:6'
            ]);

            $codigoValido = CodigoEmail::where('email', $request->email)
                ->where('codigo', $request->codigo)
                ->where('valido_ate', '>', Carbon::now())
                ->first();

            if (!$codigoValido) {
                return response()->json(['erro' => 's', 'msg' => 'Código inválido ou expirado. Gere um novo código.']);
            }

            $usuario = Usuario::where('email', $request->email)->first();
            $usuario->dupla_autentica = "1";
            $usuario->save();

            CodigoEmail::where('email', $request->email)->delete();
            session()->forget(['email_ativar_2fa', 'codigo_2fa']);

            return response()->json(['erro' => 'n', 'msg' => '2FA ativado com sucesso!']);

        } catch (\Exception $e) {
            return response()->json(['erro' => 's', 'msg' => 'Erro: ' . $e->getMessage()]);
        }
    }

    // ─── Recuperação de senha ────────────────────────────────────────────────

    public function solicitar_recuperacao(Request $request)
    {
        $request->validate(['email' => 'required']);

        $usuario = Usuario::where('email', $request->email)->first();

        if (!$usuario) {
            return response()->json(['erro' => 's', 'msg' => 'E-mail não encontrado'], 404);
        }

        $codigo     = rand(100000, 999999);
        $valido_ate = Carbon::now()->addMinutes(10);

        CodigoEmail::updateOrCreate(
            ['email' => $request->email],
            ['codigo' => $codigo, 'valido_ate' => $valido_ate]
        );

        return response()->json([
            'erro'   => 'n',
            'msg'    => 'Código gerado! Verifique na tabela codigo_email.',
            'codigo' => $codigo
        ], 200);
    }

    public function confirmar_recuperacao(Request $request)
    {
        $request->validate([
            'email'      => 'required|email',
            'codigo'     => 'required|string|size:6',
            'nova_senha' => 'required|string|min:6',
        ]);

        $codigo = CodigoEmail::where('email', $request->email)
            ->where('codigo', $request->codigo)
            ->where('valido_ate', '>', Carbon::now())
            ->first();

        if (!$codigo) {
            return response()->json(['erro' => 's', 'msg' => 'Código inválido ou expirado'], 422);
        }

        $usuario = Usuario::where('email', $request->email)->first();

        if (!$usuario) {
            return response()->json(['erro' => 's', 'msg' => 'Usuário não encontrado'], 404);
        }

        $usuario->senha = md5($request->nova_senha);
        $usuario->save();

        CodigoEmail::where('email', $request->email)->delete();

        return response()->json(['erro' => 'n', 'msg' => 'Senha alterada com sucesso'], 200);
    }

    // ─── Boleto ─────────────────────────────────────────────────────────────

    public function gerar_boleto(Request $request)
    {
        try {
            $request->validate([
                'email'      => 'required|email',
                'valor'      => 'required|numeric|min:0.01',
                'vencimento' => 'required|date|after:today',
            ]);

            $usuario = Usuario::where('email', $request->email)->first();

            if (!$usuario) {
                return response()->json(['erro' => 's', 'msg' => 'Usuário não encontrado'], 404);
            }

            $nosso_numero  = '12345-' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $codigo_barras = $this->gerarCodigoBarrasFalso();

            // ✅ Salva o boleto na tabela com status "pendente"
            $boleto = Boleto::create([
                'usuario_id'   => $usuario->id,
                'email'        => $usuario->email,
                'valor'        => $request->valor,
                'vencimento'   => $request->vencimento,
                'nosso_numero' => $nosso_numero,
                'codigo_barras' => $codigo_barras,
                'status_email' => 'pendente',
            ]);

            // ✅ Dispara o Job que envia o e-mail e atualiza o status na tabela
            EnviarBoletoJob::dispatch(
                $usuario,
                $request->valor,
                $request->vencimento,
                $nosso_numero,
                $codigo_barras,
                $boleto->id
            );

            return response()->json([
                'erro' => 'n',
                'msg'  => 'Boleto gerado! O e-mail será enviado em instantes.',
                'dados_boleto' => [
                    'id'            => $boleto->id,
                    'valor'         => $request->valor,
                    'vencimento'    => $request->vencimento,
                    'nosso_numero'  => $nosso_numero,
                    'codigo_barras' => $codigo_barras,
                    'status_email'  => 'pendente',
                ]
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'erro'   => 's',
                'msg'    => 'Erro de validação',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'erro' => 's',
                'msg'  => 'Erro ao gerar boleto: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Lista todos os boletos de um usuário (pelo e-mail).
     */
    public function listar_boletos(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $usuario = Usuario::where('email', $request->email)->first();

        if (!$usuario) {
            return response()->json(['erro' => 's', 'msg' => 'Usuário não encontrado'], 404);
        }

        $boletos = Boleto::where('usuario_id', $usuario->id)
            ->orderByDesc('created_at')
            ->get();

        return response()->json(['erro' => 'n', 'boletos' => $boletos], 200);
    }

    private function gerarCodigoBarrasFalso(): string
    {
        return '00190.00009 01234.567890 12345.678901 2 ' . rand(10000000000000, 99999999999999);
    }
}