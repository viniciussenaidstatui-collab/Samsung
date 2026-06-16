<?php


namespace App\Http\Controllers;

use App\Models\Boleto;
use App\Models\SamsungModel;
use App\Models\Carrinho;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\DiscountSpin;
use App\Models\TokenUser;
use App\Models\Usuario;
use App\Mail\BoletoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LojaController extends Controller
{
    // Vitrine principal
    public function index()
    {
        $produtos = SamsungModel::where('estoque', '>', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        
        $destaques = SamsungModel::where('estoque', '>', 0)
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();
        
        return view('vitrine', compact('produtos', 'destaques'));
    }
    
    // Detalhe do produto
    public function show($id)
    {
        $produto = SamsungModel::findOrFail($id);
        
        $relacionados = SamsungModel::where('id', '!=', $id)
            ->where('estoque', '>', 0)
            ->where(function($q) use ($produto) {
                $q->where('modelo', $produto->modelo)
                  ->orWhere('aparelho', $produto->aparelho);
            })
            ->limit(4)
            ->get();
        
        return view('loja.show', compact('produto', 'relacionados'));
    }
    
    // Adicionar ao carrinho
    public function addToCart(Request $request)
    {
        $request->validate([
            'produto_id' => 'required|exists:samsung,id',
            'quantidade' => 'required|integer|min:1'
        ]);
        
        $produto = SamsungModel::findOrFail($request->produto_id);
        
        if (!$produto->hasStock($request->quantidade)) {
            return response()->json([
                'erro' => 's',
                'msg' => 'Estoque insuficiente. Disponível: ' . $produto->estoque
            ], 422);
        }
        
        $user = $this->getUsuarioFromRequest($request);
        $sessionId = session()->getId();
        
        $cartItem = Carrinho::where('produto_id', $request->produto_id)
            ->when($user, fn($q) => $q->where('user_id', $user->id))
            ->when(!$user, fn($q) => $q->where('session_id', $sessionId))
            ->first();
        
        if ($cartItem) {
            $novaQuantidade = $cartItem->quantidade + $request->quantidade;
            if (!$produto->hasStock($novaQuantidade)) {
                return response()->json([
                    'erro' => 's',
                    'msg' => 'Estoque insuficiente para a quantidade total'
                ], 422);
            }
            $cartItem->quantidade = $novaQuantidade;
            $cartItem->save();
        } else {
            Carrinho::create([
                'user_id'        => $user?->id,
                'session_id'     => !$user ? $sessionId : null,
                'produto_id'     => $produto->id,
                'quantidade'     => $request->quantidade,
                'preco_unitario' => $produto->preco
            ]);
        }
        
        $cartCount = $this->getCartCount($request);
        session(['cart_count' => $cartCount]);
        
        return response()->json([
            'erro'       => 'n',
            'msg'        => 'Produto adicionado ao carrinho!',
            'cart_count' => $cartCount
        ]);
    }
    
    // Ver carrinho
    public function cart()
    {
        $cartItems = $this->getCartItems(request());
        $subtotal  = $cartItems->sum('subtotal');
        $cupom     = session('cupom');
        
        $desconto = 0;
        if ($cupom && isset($cupom['percent'])) {
            $desconto = $subtotal * ($cupom['percent'] / 100);
        }
        
        $total = $subtotal - $desconto;
        
        return view('cart', compact('cartItems', 'subtotal', 'desconto', 'total', 'cupom'));
    }

    public function spinPage()
    {
        return view('roleta');
    }
    
    // Atualizar quantidade no carrinho
    public function updateCart(Request $request)
    {
        $request->validate([
            'cart_id'    => 'required|exists:carrinhos,id',
            'quantidade' => 'required|integer|min:1'
        ]);
        
        $cartItem = $this->findCartItemOrFail($request, $request->cart_id);
        $produto  = SamsungModel::findOrFail($cartItem->produto_id);
        
        if (!$produto->hasStock($request->quantidade)) {
            return response()->json([
                'erro' => 's',
                'msg'  => 'Estoque insuficiente. Máximo: ' . $produto->estoque
            ], 422);
        }
        
        $cartItem->quantidade = $request->quantidade;
        $cartItem->save();
        
        session(['cart_count' => $this->getCartCount($request)]);
        
        return response()->json([
            'erro'       => 'n',
            'msg'        => 'Carrinho atualizado',
            'cart_count' => session('cart_count')
        ]);
    }
    
    // Remover do carrinho
    public function removeFromCart($id)
    {
        $request  = request();
        $cartItem = $this->findCartItemOrFail($request, $id);
        $cartItem->delete();
        
        $cartCount = $this->getCartCount($request);
        session(['cart_count' => $cartCount]);
        
        return response()->json([
            'erro'       => 'n',
            'msg'        => 'Item removido',
            'cart_count' => $cartCount
        ]);
    }
    
    // Aplicar cupom
    public function applyCoupon(Request $request)
    {
        $request->validate(['coupon_code' => 'required|string']);

        $user = $this->getUsuarioFromRequest($request);

        if (!$user) {
            return response()->json([
                'erro' => 's',
                'msg'  => 'Faca login para usar o cupom'
            ], 401);
        }
        
        $coupon = $this->findValidCoupon($request->coupon_code, $user->id);
        
        if (!$coupon) {
            return response()->json([
                'erro' => 's',
                'msg'  => 'Cupom inválido ou expirado'
            ], 422);
        }
        
        session(['cupom' => [
            'code'    => $coupon->coupon_code,
            'percent' => $coupon->discount_percent,
            'label'   => $coupon->prize_label,
            'id'      => $coupon->id
        ]]);
        
        return response()->json([
            'erro'    => 'n',
            'msg'     => 'Cupom aplicado!',
            'coupon'  => $this->formatCoupon($coupon),
            'percent' => $coupon->discount_percent
        ]);
    }
    
    // Remover cupom
    public function removeCoupon()
    {
        session()->forget('cupom');
        return response()->json(['erro' => 'n', 'msg' => 'Cupom removido']);
    }
    
    // ─── Finalizar compra ────────────────────────────────────────────────────
    public function checkout(Request $request)
    {
        $user = $this->getUsuarioFromRequest($request);
        
        if (!$user) {
            return response()->json([
                'erro' => 's',
                'msg'  => 'Faça login para finalizar a compra'
            ], 401);
        }
        
        $cartItems = $this->getCartItems($request);
        
        if ($cartItems->isEmpty()) {
            return response()->json([
                'erro' => 's',
                'msg'  => 'Carrinho vazio'
            ], 422);
        }
        
        DB::beginTransaction();
        
        try {
            $subtotal      = $cartItems->sum('subtotal');
            $coupon        = null;
            $couponCode    = $request->input('coupon_code');
            $paymentMethod = $request->input('payment_method', 'card'); // card | pix | boleto

            if ($couponCode) {
                $coupon = $this->findValidCoupon($couponCode, $user->id);

                if (!$coupon) {
                    DB::rollBack();
                    return response()->json([
                        'erro' => 's',
                        'msg'  => 'Cupom invalido ou expirado'
                    ], 422);
                }
            }

            $descontoPercent = $coupon?->discount_percent ?? 0;
            $descontoValor   = $subtotal * ($descontoPercent / 100);
            $total           = $subtotal - $descontoValor;
            
            // Criar pedido
            $pedido = Pedido::create([
                'user_id'          => $user->id,
                'numero_pedido'    => 'SAM-' . strtoupper(Str::random(10)),
                'cupom_aplicado'   => $coupon?->coupon_code,
                'desconto_percent' => $descontoPercent,
                'valor_total'      => $total,
                'status'           => 'pendente'
            ]);
            
            // Criar itens do pedido e dar baixa no estoque
            foreach ($cartItems as $item) {
                PedidoItem::create([
                    'pedido_id'      => $pedido->id,
                    'produto_id'     => $item->produto_id,
                    'quantidade'     => $item->quantidade,
                    'preco_unitario' => $item->preco_unitario,
                    'subtotal'       => $item->subtotal
                ]);
                
                $produto = SamsungModel::find($item->produto_id);
                $produto->estoque -= $item->quantidade;
                $produto->save();
            }
            
            // Marcar cupom como usado
            if ($coupon) {
                DiscountSpin::where('id', $coupon->id)->update([
                    'used'    => true,
                    'used_at' => now()
                ]);
            }
            
            // Limpar carrinho
            Carrinho::where('user_id', $user->id)->delete();
            session()->forget(['cart_count', 'cupom']);
            
            DB::commit();

            // ─── Boleto: gera, salva na tabela e tenta enviar e-mail ─────────
            if ($paymentMethod === 'boleto') {
                $boletoData = $this->gerarERegistrarBoleto($user, $total, $pedido->id);

                return response()->json([
                    'erro'          => 'n',
                    'msg'           => 'Boleto gerado com sucesso!',
                    'pedido_numero' => $pedido->numero_pedido,
                    'boleto_dados'  => [
                        'valor'         => number_format($total, 2, '.', ''),
                        'vencimento'    => $boletoData['vencimento'],
                        'nosso_numero'  => $boletoData['nosso_numero'],
                        'codigo_barras' => $boletoData['codigo_barras'],
                        'boleto_id'     => $boletoData['boleto_id'],
                        'email_status'  => $boletoData['email_status'],
                    ]
                ]);
            }
            
            return response()->json([
                'erro'          => 'n',
                'msg'           => 'Pedido realizado com sucesso!',
                'pedido_numero' => $pedido->numero_pedido
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'erro' => 's',
                'msg'  => 'Erro ao processar pedido: ' . $e->getMessage()
            ], 500);
        }
    }

    // ─── Gera boleto, salva na tabela e envia e-mail (síncrono, sem fila) ──
    private function gerarERegistrarBoleto(Usuario $user, float $total, int $pedidoId): array
    {
        $nosso_numero  = 'SAM-' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
        $codigo_barras = $this->gerarCodigoBarrasFalso($total);
        $vencimento    = now()->addDays(3)->format('Y-m-d');   // vence em 3 dias úteis

        // Salva na tabela boletos com status "pendente"
        $boleto = Boleto::create([
            'usuario_id'    => $user->id,
            'email'         => $user->email,
            'valor'         => $total,
            'vencimento'    => $vencimento,
            'nosso_numero'  => $nosso_numero,
            'codigo_barras' => $codigo_barras,
            'status_email'  => 'pendente',
        ]);

        $emailStatus = 'pendente';

        // Tenta enviar o e-mail de forma síncrona (sem queue:work)
        try {
            Mail::to($user->email)->send(new BoletoMail(
                $user,
                $total,
                $vencimento,
                $nosso_numero,
                $codigo_barras
            ));

            // Atualiza status para "enviado"
            $boleto->update([
                'status_email' => 'enviado',
                'enviado_em'   => now(),
            ]);

            $emailStatus = 'enviado';

        } catch (\Throwable $e) {
            // Mailtrap bloqueado (rede da escola): registra no log e marca como erro
            // O boleto ainda fica salvo na tabela para consulta
            $boleto->update([
                'status_email' => 'erro',
                'erro_msg'     => $e->getMessage(),
            ]);

            $emailStatus = 'erro';

            // Loga os dados completos — você vê em storage/logs/laravel.log
            Log::warning('📧 [BOLETO] E-mail não enviado (rede bloqueada). Dados do boleto:', [
                'boleto_id'     => $boleto->id,
                'usuario'       => $user->nome,
                'email'         => $user->email,
                'valor'         => 'R$ ' . number_format($total, 2, ',', '.'),
                'vencimento'    => date('d/m/Y', strtotime($vencimento)),
                'nosso_numero'  => $nosso_numero,
                'codigo_barras' => $codigo_barras,
                'erro'          => $e->getMessage(),
            ]);
        }

        return [
            'boleto_id'     => $boleto->id,
            'nosso_numero'  => $nosso_numero,
            'codigo_barras' => $codigo_barras,
            'vencimento'    => $vencimento,
            'email_status'  => $emailStatus,
        ];
    }

    private function gerarCodigoBarrasFalso(float $valor): string
    {
        $valorFormatado = str_pad((int)($valor * 100), 10, '0', STR_PAD_LEFT);
        return '00190.00009 01234.567890 12345.' . $valorFormatado . ' 2 ' . rand(10000000000000, 99999999999999);
    }

    // ─── Métodos auxiliares ──────────────────────────────────────────────────

    public function cartCount(Request $request)
    {
        return response()->json([
            'erro'  => 'n',
            'count' => $this->getCartCount($request)
        ]);
    }

    public function cartItems(Request $request)
    {
        $cartItems = $this->getCartItems($request);
        $subtotal  = $cartItems->sum('subtotal');
        $user      = $this->getUsuarioFromRequest($request);
        $coupon    = ($user && $request->input('coupon_code'))
            ? $this->findValidCoupon($request->input('coupon_code'), $user->id)
            : null;
        $desconto  = $coupon ? $subtotal * ($coupon->discount_percent / 100) : 0;

        return response()->json([
            'erro'     => 'n',
            'items'    => $cartItems->values(),
            'subtotal' => $subtotal,
            'desconto' => $desconto,
            'total'    => $subtotal - $desconto,
            'cupom'    => $coupon ? $this->formatCoupon($coupon) : null
        ]);
    }

    public function spinStatus(Request $request)
    {
        $user = $this->getUsuarioFromRequest($request);

        if (!$user) {
            return response()->json([
                'erro' => 's',
                'msg'  => 'Faca login para girar a roleta'
            ], 401);
        }

        $availableCoupons = DiscountSpin::where('user_id', $user->id)
            ->where('used', false)
            ->where(function($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
            })
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(fn($coupon) => $this->formatCoupon($coupon));

        $lastSpin = DiscountSpin::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();

        return response()->json([
            'erro'         => 'n',
            'can_spin'     => !$lastSpin || $lastSpin->created_at->lt(now()->subDay()),
            'next_spin_at' => $lastSpin ? $lastSpin->created_at->addDay()->toDateTimeString() : null,
            'coupons'      => $availableCoupons
        ]);
    }

    public function spin(Request $request)
    {
        $user = $this->getUsuarioFromRequest($request);

        if (!$user) {
            return response()->json([
                'erro' => 's',
                'msg'  => 'Faca login para girar a roleta'
            ], 401);
        }

        $lastSpin = DiscountSpin::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastSpin && $lastSpin->created_at->gte(now()->subDay())) {
            return response()->json([
                'erro'         => 's',
                'msg'          => 'Voce ja girou a roleta nas ultimas 24 horas',
                'next_spin_at' => $lastSpin->created_at->addDay()->toDateTimeString()
            ], 429);
        }

        $prizes = [
            ['percent' => 5,  'label' => '5% OFF'],
            ['percent' => 10, 'label' => '10% OFF'],
            ['percent' => 15, 'label' => '15% OFF'],
            ['percent' => 20, 'label' => '20% OFF'],
            ['percent' => 25, 'label' => '25% OFF'],
            ['percent' => 30, 'label' => '30% OFF']
        ];

        $selectedIndex = random_int(0, count($prizes) - 1);
        $prize         = $prizes[$selectedIndex];

        $coupon = DiscountSpin::create([
            'user_id'          => $user->id,
            'coupon_code'      => 'SAM' . strtoupper(Str::random(8)),
            'discount_percent' => $prize['percent'],
            'prize_label'      => $prize['label'],
            'used'             => false,
            'expires_at'       => now()->addDays(7)
        ]);

        return response()->json([
            'erro'           => 'n',
            'msg'            => 'Cupom gerado com sucesso!',
            'selected_index' => $selectedIndex,
            'coupon'         => $this->formatCoupon($coupon)
        ]);
    }

    public function vitrine()
    {
        return view('vitrine');
    }

    private function getCartItems(?Request $request = null)
    {
        $request   = $request ?: request();
        $user      = $this->getUsuarioFromRequest($request);
        $sessionId = session()->getId();
        
        $items = Carrinho::with('produto')
            ->when($user, fn($q) => $q->where('user_id', $user->id))
            ->when(!$user, fn($q) => $q->where('session_id', $sessionId))
            ->get();
        
        return $items->map(function($item) {
            $item->subtotal = $item->quantidade * $item->preco_unitario;
            return $item;
        });
    }

    private function getCartCount(?Request $request = null)
    {
        $request   = $request ?: request();
        $user      = $this->getUsuarioFromRequest($request);
        $sessionId = session()->getId();
        
        return Carrinho::when($user, fn($q) => $q->where('user_id', $user->id))
            ->when(!$user, fn($q) => $q->where('session_id', $sessionId))
            ->sum('quantidade');
    }

    private function getUsuarioFromRequest(Request $request)
    {
        if ($request->usuario) {
            return $request->usuario;
        }

        $tokenValue = $request->input('token') ?: $request->bearerToken();

        if (!$tokenValue) {
            return auth()->user();
        }

        $token = TokenUser::where('token', $tokenValue)
            ->where('valido_ate', '>=', now())
            ->first();

        return $token ? Usuario::find($token->user_id) : null;
    }

    private function findCartItemOrFail(Request $request, $id)
    {
        $user      = $this->getUsuarioFromRequest($request);
        $sessionId = session()->getId();

        return Carrinho::when($user, fn($q) => $q->where('user_id', $user->id))
            ->when(!$user, fn($q) => $q->where('session_id', $sessionId))
            ->findOrFail($id);
    }

    private function findValidCoupon(string $couponCode, int $userId): ?DiscountSpin
    {
        return DiscountSpin::where('coupon_code', trim($couponCode))
            ->where('user_id', $userId)
            ->where('used', false)
            ->where(function($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
            })
            ->first();
    }

    private function formatCoupon(DiscountSpin $coupon): array
    {
        return [
            'id'         => $coupon->id,
            'code'       => $coupon->coupon_code,
            'percent'    => $coupon->discount_percent,
            'label'      => $coupon->prize_label,
            'expires_at' => $coupon->expires_at?->toDateTimeString()
        ];
    }
}
