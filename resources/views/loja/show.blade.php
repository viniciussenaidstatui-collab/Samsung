<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $produto->aparelho }} — Samsung Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        :root {
            --purple-light: #f3e8ff;
            --purple-medium: #c084fc;
            --purple-dark: #7e22ce;
            --purple-soft: #e9d5ff;
            --purple-bg: #faf5ff;
            --text-dark: #2d1b4e;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, var(--purple-bg) 0%, #f5f0ff 100%);
            color: var(--text-dark);
        }

        /* Navbar Roxa */
        .navbar-purple {
            background: linear-gradient(135deg, var(--purple-dark) 0%, #9b4dff 100%);
            padding: 1rem 0;
            box-shadow: 0 4px 20px rgba(126, 34, 206, 0.2);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            color: white !important;
            font-weight: 800;
            font-size: 1.5rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-link-custom {
            color: rgba(255,255,255,0.9) !important;
            text-decoration: none;
            padding: 8px 18px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link-custom:hover {
            background: rgba(255,255,255,0.15);
            color: white !important;
            transform: translateY(-2px);
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ff4444;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 0.7rem;
            font-weight: bold;
        }

        /* Animações */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .animate-fade-up {
            animation: fadeInUp 0.6s ease-out;
        }

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }

        /* Cards */
        .product-detail-card {
            background: white;
            border-radius: 32px;
            box-shadow: 0 20px 40px rgba(126, 34, 206, 0.08);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .product-detail-card:hover {
            box-shadow: 0 25px 50px rgba(126, 34, 206, 0.15);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%);
        }

        /* Botões */
        .btn-purple-gradient {
            background: linear-gradient(135deg, #7e22ce 0%, #9b4dff 100%);
            color: white;
            border: none;
            border-radius: 16px;
            padding: 14px 28px;
            font-weight: 700;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-purple-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(126, 34, 206, 0.3);
            color: white;
        }

        .btn-purple-gradient:active {
            transform: translateY(0);
        }

        .btn-outline-purple-custom {
            border: 2px solid #7e22ce;
            color: #7e22ce;
            background: transparent;
            border-radius: 16px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-purple-custom:hover {
            background: linear-gradient(135deg, #7e22ce 0%, #9b4dff 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(126, 34, 206, 0.2);
        }

        /* Preço */
        .price-large {
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(135deg, #7e22ce, #9b4dff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Especificações */
        .spec-item {
            padding: 12px 0;
            border-bottom: 1px solid rgba(126, 34, 206, 0.1);
            transition: all 0.3s ease;
        }

        .spec-item:hover {
            transform: translateX(5px);
            background: rgba(126, 34, 206, 0.05);
            padding-left: 10px;
            border-radius: 12px;
        }

        /* Produtos relacionados */
        .related-product-card {
            transition: all 0.3s ease;
            cursor: pointer;
            border-radius: 20px;
        }

        .related-product-card:hover {
            transform: translateX(8px);
            box-shadow: 0 5px 20px rgba(126, 34, 206, 0.1);
            border-color: #9b4dff !important;
        }

        /* Badge de estoque */
        .stock-badge-modern {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        /* Feature icon */
        .feature-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #f3e8ff, #e9d5ff);
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #7e22ce;
        }

        .divider-custom {
            height: 4px;
            background: linear-gradient(90deg, #7e22ce, #9b4dff, #c084fc);
            width: 60px;
            border-radius: 2px;
            margin: 15px 0;
        }

        /* Badge produto */
        .badge-premium {
            position: absolute;
            top: 20px;
            left: 20px;
            background: linear-gradient(135deg, #7e22ce, #9b4dff);
            color: white;
            padding: 8px 16px;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.8rem;
            z-index: 10;
            box-shadow: 0 4px 15px rgba(126, 34, 206, 0.3);
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--purple-dark), #6b21a5);
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
        }

        footer a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: color 0.3s;
        }

        footer a:hover {
            color: white;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar-purple">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center w-100">
            <a class="navbar-brand" href="/inicio">
                <i class="fa-solid fa-mobile-screen-button"></i>
                SAMSUNG STORE
            </a>
            <div class="d-flex align-items-center gap-3">
                <a href="/inicio" class="nav-link-custom">
                    <i class="fa-solid fa-house"></i> Início
                </a>
                <a href="/vitrine" class="nav-link-custom">
                    <i class="fa-solid fa-store"></i> Produtos
                </a>
                <a href="/roleta" class="nav-link-custom">
                    <i class="fa-solid fa-gift"></i> Roleta
                </a>
                <a href="/carrinho" class="nav-link-custom position-relative">
                    <i class="fa-solid fa-cart-shopping"></i> Carrinho
                    <span class="cart-badge" id="cartCount" style="display: none;">0</span>
                </a>
                <a href="#" id="logoutBtn" class="nav-link-custom">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Sair
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Conteúdo Principal -->
<main>
    <div class="container py-5">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-5 animate-fade-up">
            <div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <div class="feature-icon">
                        <i class="fa-solid fa-mobile-alt"></i>
                    </div>
                    <span class="text-muted small">Produto Premium</span>
                </div>
                <h1 class="display-5 fw-bold mb-2" style="background: linear-gradient(135deg, #7e22ce, #9b4dff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    Detalhes do Produto
                </h1>
                <p class="text-muted mb-0">Confira as informações completas antes da compra</p>
            </div>
            <a href="/vitrine" class="btn-outline-purple-custom">
                <i class="fa-solid fa-arrow-left me-2"></i>Voltar à Vitrine
            </a>
        </div>

        <div class="row g-4">
            <!-- Coluna da Imagem -->
            <div class="col-lg-6 animate-fade-up delay-1">
                <div class="product-detail-card position-relative">
                    <div class="badge-premium">
                        <i class="fa-solid fa-crown me-2"></i>Produto Oficial
                    </div>
                    <img src="{{ $produto->imagem_url ?: 'https://images.samsung.com/is/image/samsung/p6pim/br/feature/163786000/br-feature-gallery-samsung-zk-545150600?$684_547_JPG$' }}" 
                         alt="{{ $produto->aparelho }}" 
                         class="img-fluid w-100" 
                         style="max-height: 500px; object-fit: contain; background: linear-gradient(135deg, #faf5ff, #fff); padding: 2rem;">
                    
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h2 class="h2 fw-bold mb-2" style="color: #2d1b4e;">{{ $produto->aparelho }}</h2>
                                <p class="text-muted mb-0">
                                    <i class="fa-regular fa-circle-check text-success me-1"></i>
                                    {{ $produto->modelo }} • {{ $produto->cor }} • {{ $produto->ano }}
                                </p>
                            </div>
                            <div class="feature-icon">
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                        
                        <div class="divider-custom"></div>

                        <!-- Status de Estoque -->
                        <div class="d-flex align-items-center gap-3 mb-4">
                            @php
                                if ($produto->estoque > 20) {
                                    $stockClass = '#d4edda';
                                    $stockTextColor = '#155724';
                                    $stockIcon = 'fa-check-circle';
                                    $stockText = $produto->estoque . ' unidades disponíveis';
                                } elseif ($produto->estoque > 5) {
                                    $stockClass = '#fff3cd';
                                    $stockTextColor = '#856404';
                                    $stockIcon = 'fa-clock';
                                    $stockText = $produto->estoque . ' unidades';
                                } elseif ($produto->estoque > 0) {
                                    $stockClass = '#f8d7da';
                                    $stockTextColor = '#721c24';
                                    $stockIcon = 'fa-exclamation-triangle';
                                    $stockText = 'Últimas ' . $produto->estoque . ' unidades!';
                                } else {
                                    $stockClass = '#e9ecef';
                                    $stockTextColor = '#6c757d';
                                    $stockIcon = 'fa-times-circle';
                                    $stockText = 'Esgotado';
                                }
                            @endphp
                            <div class="stock-badge-modern" style="background: {{ $stockClass }}; color: {{ $stockTextColor }};">
                                <i class="fa-solid {{ $stockIcon }}"></i>
                                <span>{{ $stockText }}</span>
                            </div>
                            @if($produto->estoque > 0)
                                <div class="stock-badge-modern" style="background: linear-gradient(135deg, #7e22ce20, #9b4dff20); color: #7e22ce;">
                                    <i class="fa-solid fa-truck-fast"></i>
                                    <span>Entrega Rápida</span>
                                </div>
                            @endif
                        </div>

                        <!-- Preço -->
                        <div class="mb-4 text-center py-3 gradient-bg rounded-4">
                            <div class="price-large">
                                R$ {{ number_format($produto->preco, 2, ',', '.') }}
                            </div>
                            <div class="text-muted mt-2">
                                <i class="fa-regular fa-credit-card me-1"></i>ou 12x de R$ {{ number_format($produto->preco / 12, 2, ',', '.') }} sem juros
                            </div>
                            <div class="small text-success mt-1">
                                <i class="fa-solid fa-lock me-1"></i>Compra 100% segura
                            </div>
                        </div>

                        <!-- Especificações -->
                        <div class="mb-4">
                            <h5 class="mb-3 fw-bold" style="color: #7e22ce;">
                                <i class="fa-solid fa-microchip me-2"></i>Especificações Técnicas
                            </h5>
                            <dl class="row mb-0">
                                <div class="spec-item">
                                    <dt class="col-sm-4 text-muted">
                                        <i class="fa-solid fa-mobile me-2"></i>Modelo
                                    </dt>
                                    <dd class="col-sm-8 fw-semibold">{{ $produto->modelo }}</dd>
                                </div>

                                <div class="spec-item">
                                    <dt class="col-sm-4 text-muted">
                                        <i class="fa-solid fa-palette me-2"></i>Cor
                                    </dt>
                                    <dd class="col-sm-8 fw-semibold">{{ $produto->cor }}</dd>
                                </div>

                                <div class="spec-item">
                                    <dt class="col-sm-4 text-muted">
                                        <i class="fa-regular fa-calendar me-2"></i>Ano
                                    </dt>
                                    <dd class="col-sm-8 fw-semibold">{{ $produto->ano }}</dd>
                                </div>

                                @if(!empty($produto->capacidade))
                                    <div class="spec-item">
                                        <dt class="col-sm-4 text-muted">
                                            <i class="fa-solid fa-database me-2"></i>Capacidade
                                        </dt>
                                        <dd class="col-sm-8 fw-semibold">{{ $produto->capacidade }}</dd>
                                    </div>
                                @endif
                            </dl>
                        </div>

                        <!-- Descrição -->
                        <div class="mb-4 p-3 gradient-bg rounded-4">
                            <h5 class="mb-3 fw-bold" style="color: #7e22ce;">
                                <i class="fa-regular fa-message me-2"></i>Sobre este produto
                            </h5>
                            <p class="text-muted mb-0">{{ $produto->descricao ?? 'Um produto Samsung de alta qualidade, pronto para acompanhar seu dia a dia com performance e design premium.' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Coluna de Compra -->
            <div class="col-lg-6 animate-fade-up delay-2">
                <div class="product-detail-card p-4 h-100 d-flex flex-column">
                    <div class="mb-4">
                        <div class="feature-icon mb-3">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </div>
                        <h4 class="fw-bold" style="color: #7e22ce;">Resumo da Compra</h4>
                        <div class="divider-custom"></div>
                        <p class="text-muted">Complete sua compra com segurança e agilidade</p>
                    </div>

                    <!-- Informações de compra -->
                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <div class="p-3 gradient-bg rounded-4 text-center">
                                <i class="fa-solid fa-tag fa-2x mb-2" style="color: #7e22ce;"></i>
                                <div class="small text-muted">Preço</div>
                                <div class="fw-bold fs-5" style="color: #7e22ce;">R$ {{ number_format($produto->preco, 2, ',', '.') }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 gradient-bg rounded-4 text-center">
                                <i class="fa-solid fa-boxes fa-2x mb-2" style="color: #7e22ce;"></i>
                                <div class="small text-muted">Estoque</div>
                                <div class="fw-bold fs-5" style="color: #7e22ce;">{{ $produto->estoque }} unidades</div>
                            </div>
                        </div>
                    </div>

                    <!-- Benefícios -->
                    <div class="mb-4 p-3 bg-white rounded-4 border" style="border-color: rgba(126, 34, 206, 0.1) !important;">
                        <h6 class="fw-bold mb-3">
                            <i class="fa-solid fa-gift me-2" style="color: #7e22ce;"></i>Benefícios exclusivos
                        </h6>
                        <div class="d-flex flex-column gap-2">
                            <div class="small"><i class="fa-solid fa-check-circle me-2" style="color: #7e22ce;"></i>Frete grátis para todo Brasil</div>
                            <div class="small"><i class="fa-solid fa-check-circle me-2" style="color: #7e22ce;"></i>Garantia oficial de 12 meses</div>
                            <div class="small"><i class="fa-solid fa-check-circle me-2" style="color: #7e22ce;"></i>Parcele em até 12x sem juros</div>
                            <div class="small"><i class="fa-solid fa-check-circle me-2" style="color: #7e22ce;"></i>Devolução grátis em até 7 dias</div>
                        </div>
                    </div>

                    <!-- Botões -->
                    <div class="d-grid gap-3 mt-auto">
                        @if($produto->estoque > 0)
                            <button type="button" class="btn-purple-gradient btn-lg add-to-cart" data-id="{{ $produto->id }}">
                                <i class="fa-solid fa-cart-plus me-2"></i>Adicionar ao Carrinho
                            </button>
                            <button type="button" class="btn-outline-purple-custom buy-now" data-id="{{ $produto->id }}">
                                <i class="fa-solid fa-bolt me-2"></i>Comprar Agora
                            </button>
                        @else
                            <button class="btn-purple-gradient btn-lg" disabled style="opacity: 0.5; cursor: not-allowed;">
                                <i class="fa-solid fa-times me-2"></i>Indisponível
                            </button>
                        @endif
                        <a href="/vitrine" class="btn-outline-purple-custom text-center">
                            <i class="fa-solid fa-store me-2"></i> Continuar Comprando
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Produtos Relacionados -->
        @if(isset($relacionados) && $relacionados->count())
        <div class="mt-5 animate-fade-up delay-3">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <div class="feature-icon mb-2">
                        <i class="fa-solid fa-thumbs-up"></i>
                    </div>
                    <h4 class="fw-bold" style="color: #7e22ce;">Você também pode gostar</h4>
                    <div class="divider-custom"></div>
                </div>
                <a href="/vitrine" class="text-decoration-none" style="color: #7e22ce;">
                    Ver todos <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
            
            <div class="row g-3">
                @foreach($relacionados as $relacionado)
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 related-product-card" style="border-radius: 20px; transition: all 0.3s ease; cursor: pointer;" onclick="window.location.href='/loja/produto/{{ $relacionado->id }}'">
                            <div class="card-body p-3">
                                <div class="d-flex gap-3">
                                    <img src="{{ $relacionado->imagem_url ?: 'https://images.samsung.com/is/image/samsung/p6pim/br/feature/163786000/br-feature-gallery-samsung-zk-545150600?$684_547_JPG$' }}" 
                                         alt="{{ $relacionado->aparelho }}" 
                                         class="rounded-3" 
                                         style="width: 80px; height: 80px; object-fit: contain; background: #faf5ff; padding: 8px;">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 fw-bold" style="color: #2d1b4e;">{{ $relacionado->aparelho }}</h6>
                                        <p class="text-muted small mb-2">{{ $relacionado->modelo }}</p>
                                        <div class="fw-bold" style="color: #7e22ce; font-size: 0.9rem;">
                                            R$ {{ number_format($relacionado->preco, 2, ',', '.') }}
                                        </div>
                                        <div class="small text-success">
                                            <i class="fa-solid fa-truck"></i> Frete grátis
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</main>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-center text-md-start">
                <h5><i class="fa-solid fa-mobile-screen-button me-2"></i>Samsung Store</h5>
                <p class="text-white-50">A melhor experiência em tecnologia</p>
            </div>
            <div class="col-md-4 text-center">
                <h5>Links Rápidos</h5>
                <ul class="list-unstyled">
                    <li><a href="/inicio">Início</a></li>
                    <li><a href="/vitrine">Produtos</a></li>
                    <li><a href="/roleta">Roleta</a></li>
                </ul>
            </div>
            <div class="col-md-4 text-center text-md-end">
                <h5>Contato</h5>
                <p class="text-white-50">
                    <i class="fa-regular fa-envelope"></i> contato@samsungstore.com<br>
                    <i class="fa-solid fa-phone"></i> (11) 4002-8922
                </p>
            </div>
        </div>
        <hr class="bg-white-50">
        <div class="text-center">
            <p class="mb-0">© 2026 Samsung Store - Todos os direitos reservados</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function atualizarCarrinho() {
    let token = $.cookie('token');
    if (token) {
        $.ajax({
            url: "/api/carrinho/count",
            method: "GET",
            headers: { 'Authorization': 'Bearer ' + token },
            success: function(res) {
                if (res.count > 0) {
                    $('#cartCount').text(res.count).show();
                } else {
                    $('#cartCount').hide();
                }
            }
        });
    }
}

function addToCart(produtoId) {
    let token = $.cookie('token');

    if (!token) {
        Swal.fire({
            icon: 'warning',
            title: 'Faça login',
            text: 'Você precisa estar logado para comprar',
            confirmButtonColor: '#7e22ce',
            background: '#faf5ff'
        }).then(() => {
            window.location.href = '/login';
        });
        return;
    }

    Swal.fire({
        title: 'Adicionando...',
        text: 'Aguarde um momento',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        },
        background: '#faf5ff'
    });

    $.ajax({
        url: '/api/carrinho/adicionar',
        method: 'POST',
        headers: { 'Authorization': 'Bearer ' + token },
        data: {
            produto_id: produtoId,
            quantidade: 1
        },
        success: function(res) {
            Swal.close();
            if (res.erro === 'n') {
                const toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: '#faf5ff'
                });
                toast.fire({
                    icon: 'success',
                    title: 'Produto adicionado!',
                    text: 'Continue comprando ou vá ao carrinho',
                    color: '#2d1b4e'
                });
                
                $('.add-to-cart').css('transform', 'scale(0.95)');
                setTimeout(() => {
                    $('.add-to-cart').css('transform', '');
                }, 200);
                
                atualizarCarrinho();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: res.msg || 'Erro ao adicionar produto',
                    confirmButtonColor: '#7e22ce',
                    background: '#faf5ff'
                });
            }
        },
        error: function(xhr) {
            Swal.close();
            let msg = xhr.responseJSON?.msg || 'Erro ao adicionar produto';
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: msg,
                confirmButtonColor: '#7e22ce',
                background: '#faf5ff'
            });
        }
    });
}

function buyNow(produtoId) {
    addToCart(produtoId);
    setTimeout(() => {
        window.location.href = '/carrinho';
    }, 1000);
}

$(document).ready(function() {
    atualizarCarrinho();
    
    $(document).on('click', '.add-to-cart', function() {
        addToCart($(this).data('id'));
    });
    
    $(document).on('click', '.buy-now', function() {
        buyNow($(this).data('id'));
    });
    
    $('#logoutBtn').click(function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Deseja sair?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#7e22ce',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Sim, sair',
            background: '#faf5ff'
        }).then((result) => {
            if (result.isConfirmed) {
                $.removeCookie('token', { path: '/' });
                localStorage.removeItem('userEmail');
                window.location.href = '/login';
            }
        });
    });
});
</script>
</body>
</html>