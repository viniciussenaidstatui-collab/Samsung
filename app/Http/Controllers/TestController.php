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
        'preco' => 'required|numeric|min:0',
        'estoque' => 'required|integer|min:0',
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
        $samsung->preco = $request->preco;
        $samsung->estoque = $request->estoque;
        $samsung->imagem_url = $request->imagem_url;
        $samsung->descricao = $request->descricao;
        $samsung->save();

        // Limpar cache
        Cache::forget('todos_samsung');
        Cache::forget('samsung_' . $samsung->id);
        Cache::forget('dashboard_samsung');

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
    public function checkout(Request $request)
    {
        try {
            // Validação dos dados recebidos
            $request->validate([
                'token' => 'required|string',
                'payment_method' => 'required|in:pix,card,boleto',
                'coupon_code' => 'nullable|string'
            ]);

            // 1. Buscar usuário pelo token
            $tokenUser = TokenUser::where('token', $request->token)->first();
            
            if (!$tokenUser) {
                return response()->json([
                    'erro' => 's',
                    'msg' => 'Usuário não autenticado. Faça login novamente.'
                ], 401);
            }

            // 2. Buscar dados do usuário
            $usuario = Usuario::find($tokenUser->user_id);
            
            if (!$usuario) {
                return response()->json([
                    'erro' => 's',
                    'msg' => 'Usuário não encontrado.'
                ], 404);
            }

            // 3. Buscar itens do carrinho do usuário
            $itensCarrinho = Carrinho::where('user_id', $usuario->id)->get();
            
            if ($itensCarrinho->isEmpty()) {
                return response()->json([
                    'erro' => 's',
                    'msg' => 'Carrinho vazio. Adicione produtos antes de finalizar.'
                ], 400);
            }

            // 4. Calcular o total do carrinho
            $subtotal = $itensCarrinho->sum(function($item) {
                return $item->preco_unitario * $item->quantidade;
            });

            // 5. Aplicar cupom de desconto se existir
            $desconto = 0;
            $cupomAplicado = null;

            if ($request->has('coupon_code') && !empty($request->coupon_code)) {
                // Buscar cupom no banco de dados (exemplo)
                $cupom = CupomDesconto::where('codigo', strtoupper($request->coupon_code))
                    ->where('valido_ate', '>', Carbon::now())
                    ->where('ativo', true)
                    ->first();

                if ($cupom) {
                    $desconto = ($subtotal * $cupom->percentual) / 100;
                    $cupomAplicado = $cupom;
                }
            }

            // 6. Calcular o total final
            $totalFinal = $subtotal - $desconto;

            // 7. Criar o pedido no banco de dados
            $pedido = new Pedido();
            $pedido->user_id = $usuario->id;
            $pedido->subtotal = $subtotal;
            $pedido->desconto = $desconto;
            $pedido->total = $totalFinal;
            $pedido->status = 'pendente';
            $pedido->payment_method = $request->payment_method;
            $pedido->data_pedido = Carbon::now();
            
            // Se tiver cupom, salva o ID do cupom
            if ($cupomAplicado) {
                $pedido->cupom_id = $cupomAplicado->id;
            }
            
            $pedido->save();

            // 8. Preparar resposta base
            $response = [
                'erro' => 'n',
                'pedido_numero' => $pedido->id,
                'subtotal' => number_format($subtotal, 2, ',', '.'),
                'desconto' => number_format($desconto, 2, ',', '.'),
                'total' => number_format($totalFinal, 2, ',', '.'),
                'payment_method' => $request->payment_method
            ];

            // 9. Processar conforme o método de pagamento
            switch ($request->payment_method) {
                case 'pix':
                    // Lógica para PIX
                    $chavePix = 'samsung.store@empresa.com';
                    $qrCodeData = json_encode([
                        'chave' => $chavePix,
                        'valor' => $totalFinal,
                        'pedido' => $pedido->id
                    ]);
                    
                    $response['pix_dados'] = [
                        'chave_pix' => $chavePix,
                        'qr_code' => 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . urlencode($qrCodeData),
                        'valor' => number_format($totalFinal, 2, ',', '.')
                    ];
                    break;

                case 'boleto':
                    // Gerar dados do boleto
                    $valorFormatado = number_format($totalFinal, 2, ',', '.');
                    $vencimento = Carbon::now()->addDays(3)->format('Y-m-d');
                    $nossoNumero = '12345-' . str_pad($pedido->id, 5, '0', STR_PAD_LEFT);
                    $codigoBarras = $this->gerarCodigoBarrasFalso($pedido->id);
                    $linhaDigitavel = $this->gerarLinhaDigitavelFalsa($pedido->id);

                    // Enviar e-mail com o boleto
                    try {
                        // Envia o e-mail usando a classe BoletoMail
                        Mail::to($usuario->email)->send(new BoletoMail(
                            $usuario,
                            $totalFinal,
                            $vencimento,
                            $nossoNumero,
                            $codigoBarras
                        ));

                        Log::info('Boleto enviado para: ' . $usuario->email . ' - Pedido: ' . $pedido->id);

                        $response['boleto_dados'] = [
                            'valor' => $valorFormatado,
                            'vencimento' => date('d/m/Y', strtotime($vencimento)),
                            'nosso_numero' => $nossoNumero,
                            'codigo_barras' => $codigoBarras,
                            'linha_digitavel' => $linhaDigitavel
                        ];

                    } catch (\Exception $e) {
                        // Log do erro mas não interrompe o fluxo
                        Log::error('Erro ao enviar e-mail do boleto: ' . $e->getMessage());
                        
                        // Ainda retorna os dados do boleto mesmo se o e-mail falhar
                        $response['boleto_dados'] = [
                            'valor' => $valorFormatado,
                            'vencimento' => date('d/m/Y', strtotime($vencimento)),
                            'nosso_numero' => $nossoNumero,
                            'codigo_barras' => $codigoBarras,
                            'linha_digitavel' => $linhaDigitavel
                        ];
                        
                        $response['aviso_email'] = 'E-mail não pôde ser enviado, mas o boleto foi gerado. Verifique os dados abaixo.';
                    }
                    break;

                case 'card':
                    // Lógica para cartão de crédito/débito
                    // Validar dados do cartão recebidos
                    if ($request->has('card_number') && !empty($request->card_number)) {
                        $response['card_dados'] = [
                            'tipo' => $request->card_type ?? 'credito',
                            'bandeira' => $request->card_brand ?? 'visa',
                            'ultimos_digitos' => substr(str_replace(' ', '', $request->card_number), -4)
                        ];
                        
                        // Aqui você pode adicionar lógica de processamento de cartão
                        // Simulação de aprovação
                        $response['status_pagamento'] = 'aprovado';
                        $response['autorizacao'] = 'AUTH-' . strtoupper(substr(md5($pedido->id . time()), 0, 8));
                    } else {
                        // Cartão de teste para demonstração
                        $response['card_dados'] = [
                            'tipo' => $request->card_type ?? 'credito',
                            'bandeira' => $request->card_brand ?? 'visa',
                            'ultimos_digitos' => '****'
                        ];
                        $response['status_pagamento'] = 'simulado';
                        $response['autorizacao'] = 'AUTH-' . strtoupper(substr(md5($pedido->id . 'test'), 0, 8));
                    }
                    break;

                default:
                    return response()->json([
                        'erro' => 's',
                        'msg' => 'Método de pagamento não suportado.'
                    ], 400);
            }

            // 10. Limpar o carrinho após a compra
            Carrinho::where('user_id', $usuario->id)->delete();

            // 11. Retornar resposta de sucesso
            return response()->json($response, 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Erro de validação
            return response()->json([
                'erro' => 's',
                'msg' => 'Dados inválidos',
                'errors' => $e->errors()
            ], 422);
            
        } catch (\Exception $e) {
            // Erro geral
            Log::error('Erro no checkout: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return response()->json([
                'erro' => 's',
                'msg' => 'Erro ao processar checkout. Tente novamente.',
                'debug' => env('APP_DEBUG', false) ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Gera um código de barras falso para o boleto
     * 
     * @param int $pedidoId
     * @return string
     */
    private function gerarCodigoBarrasFalso($pedidoId)
    {
        // Código de barras falso para demonstração
        $codigo = '00190.00009 01234.567890 12345.678901 2 12345678901234';
        return $codigo;
    }

    /**
     * Gera uma linha digitável falsa para o boleto
     * 
     * @param int $pedidoId
     * @return string
     */
    private function gerarLinhaDigitavelFalsa($pedidoId)
    {
        // Linha digitável falsa para demonstração
        $linha = '00190.00009 01234.56789 01234.56789 0 12345678901234';
        return $linha;
    }

    /**
     * Verifica o status de um pedido
     * 
     * @param int $pedidoId
     * @return \Illuminate\Http\JsonResponse
     */
    public function statusPedido($pedidoId)
    {
        try {
            $pedido = Pedido::find($pedidoId);
            
            if (!$pedido) {
                return response()->json([
                    'erro' => 's',
                    'msg' => 'Pedido não encontrado'
                ], 404);
            }

            return response()->json([
                'erro' => 'n',
                'pedido' => [
                    'id' => $pedido->id,
                    'status' => $pedido->status,
                    'total' => number_format($pedido->total, 2, ',', '.'),
                    'payment_method' => $pedido->payment_method,
                    'data_pedido' => $pedido->data_pedido->format('d/m/Y H:i')
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'erro' => 's',
                'msg' => 'Erro ao buscar status do pedido'
            ], 500);
        }
    }

    /**
     * Cancela um pedido
     * 
     * @param int $pedidoId
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancelarPedido($pedidoId, Request $request)
    {
        try {
            $request->validate([
                'token' => 'required|string'
            ]);

            // Verificar token
            $tokenUser = TokenUser::where('token', $request->token)->first();
            
            if (!$tokenUser) {
                return response()->json([
                    'erro' => 's',
                    'msg' => 'Usuário não autenticado'
                ], 401);
            }

            $pedido = Pedido::where('id', $pedidoId)
                ->where('user_id', $tokenUser->user_id)
                ->first();

            if (!$pedido) {
                return response()->json([
                    'erro' => 's',
                    'msg' => 'Pedido não encontrado'
                ], 404);
            }

            if ($pedido->status === 'cancelado') {
                return response()->json([
                    'erro' => 's',
                    'msg' => 'Pedido já está cancelado'
                ], 400);
            }

            $pedido->status = 'cancelado';
            $pedido->save();

            return response()->json([
                'erro' => 'n',
                'msg' => 'Pedido cancelado com sucesso',
                'pedido_id' => $pedido->id
            ]);

        } catch (\Exception $e) {
            Log::error('Erro ao cancelar pedido: ' . $e->getMessage());
            
            return response()->json([
                'erro' => 's',
                'msg' => 'Erro ao cancelar pedido'
            ], 500);
        }
    }
}
