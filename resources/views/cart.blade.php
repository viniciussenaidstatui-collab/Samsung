<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Samsung Store - Carrinho</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

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
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, var(--purple-bg) 0%, #f5f0ff 100%);
            color: var(--text-dark);
        }

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

        .nav-link-custom:hover,
        .nav-link-custom.active {
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

        .page-shell {
            padding: 3rem 0 4rem;
        }

        .section-title h1 {
            font-size: 2.2rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--purple-dark), #9b4dff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .cart-item,
        .summary-panel,
        .empty-state {
            background: white;
            border: 1px solid rgba(126, 34, 206, 0.12);
            border-radius: 18px;
            box-shadow: 0 5px 18px rgba(126, 34, 206, 0.08);
        }

        .cart-item {
            display: grid;
            grid-template-columns: 110px minmax(0, 1fr) 160px 130px 44px;
            gap: 18px;
            align-items: center;
            padding: 18px;
            margin-bottom: 16px;
        }

        .product-img {
            width: 110px;
            height: 110px;
            object-fit: contain;
            border-radius: 14px;
            background: linear-gradient(135deg, #faf5ff, #fff);
            padding: 12px;
        }

        .product-title {
            font-weight: 800;
            margin-bottom: 4px;
        }

        .product-model {
            color: #7c718c;
            font-size: 0.92rem;
            margin-bottom: 8px;
        }

        .product-price,
        .line-total {
            color: var(--purple-dark);
            font-weight: 800;
        }

        .qty-control {
            display: grid;
            grid-template-columns: 38px 48px 38px;
            width: 124px;
            border: 1px solid var(--purple-soft);
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
        }

        .qty-control button {
            border: none;
            background: var(--purple-light);
            color: var(--purple-dark);
            font-weight: 800;
            height: 38px;
        }

        .qty-control input {
            width: 48px;
            border: none;
            text-align: center;
            font-weight: 700;
            color: var(--text-dark);
        }

        .remove-btn {
            width: 44px;
            height: 44px;
            border: none;
            border-radius: 12px;
            background: #fee2e2;
            color: #b91c1c;
        }

        .summary-panel {
            padding: 24px;
            position: sticky;
            top: 96px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 12px;
            color: #6d607c;
        }

        .summary-total {
            border-top: 1px solid var(--purple-soft);
            padding-top: 16px;
            margin-top: 16px;
            font-size: 1.2rem;
            color: var(--text-dark);
            font-weight: 800;
        }

        .coupon-box {
            border-top: 1px solid var(--purple-soft);
            border-bottom: 1px solid var(--purple-soft);
            padding: 16px 0;
            margin: 18px 0;
        }

        .coupon-form {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 46px;
            gap: 8px;
        }

        .coupon-form input {
            width: 100%;
            border: 1px solid var(--purple-soft);
            border-radius: 12px;
            padding: 10px 12px;
            font-weight: 700;
            color: var(--text-dark);
            text-transform: uppercase;
        }

        .coupon-form button,
        .coupon-remove {
            width: 46px;
            height: 46px;
            border: none;
            border-radius: 12px;
            background: var(--purple-dark);
            color: white;
        }

        .coupon-active {
            display: none;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            border: 1px dashed var(--purple-medium);
            border-radius: 12px;
            padding: 10px 12px;
            background: var(--purple-bg);
        }

        .coupon-active strong {
            color: var(--purple-dark);
        }

        .btn-purple {
            background: linear-gradient(135deg, var(--purple-dark), #9b4dff);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 11px 18px;
            font-weight: 700;
            transition: all 0.3s;
            width: 100%;
        }

        .btn-purple:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(126, 34, 206, 0.35);
            color: white;
        }

        .btn-outline-purple {
            border: 2px solid var(--purple-dark);
            color: var(--purple-dark);
            background: transparent;
            border-radius: 12px;
            padding: 9px 16px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .loading-spinner,
        .empty-state {
            text-align: center;
            padding: 4rem 1.5rem;
        }

        .spinner {
            width: 58px;
            height: 58px;
            border: 4px solid var(--purple-soft);
            border-top: 4px solid var(--purple-dark);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Payment Method Styles */
        .payment-methods {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
            margin-bottom: 24px;
        }

        .payment-option {
            border: 2px solid #e9d5ff;
            border-radius: 12px;
            padding: 16px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background: white;
        }

        .payment-option:hover {
            border-color: var(--purple-medium);
            box-shadow: 0 4px 12px rgba(126, 34, 206, 0.15);
        }

        .payment-option.active {
            border-color: var(--purple-dark);
            background: var(--purple-bg);
        }

        .payment-option i {
            font-size: 2rem;
            color: var(--purple-dark);
            display: block;
            margin-bottom: 8px;
        }

        .payment-option span {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 0.9rem;
        }

        /* QR Code */
        .qr-code-container {
            text-align: center;
            padding: 20px;
            background: var(--purple-bg);
            border-radius: 12px;
            margin-bottom: 16px;
        }

        .qr-code-container canvas {
            max-width: 100%;
            height: auto;
        }

        /* Card Form */
        .card-form {
            display: none;
        }

        .card-form.active {
            display: block;
        }

        .card-logos {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card-logo {
            width: 60px;
            height: 40px;
            border: 2px solid #e9d5ff;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.3s;
            background: white;
        }

        .card-logo:hover,
        .card-logo.selected {
            border-color: var(--purple-dark);
            background: var(--purple-bg);
            color: var(--purple-dark);
        }

        .form-group-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .form-group-row.full {
            grid-template-columns: 1fr;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: var(--text-dark);
            font-size: 0.9rem;
        }

        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #e9d5ff;
            border-radius: 8px;
            font-size: 0.95rem;
            color: var(--text-dark);
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--purple-medium);
            box-shadow: 0 0 0 3px rgba(192, 132, 252, 0.1);
        }

        /* Boleto */
        .boleto-info {
            display: none;
            background: var(--purple-bg);
            border-left: 4px solid var(--purple-dark);
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 16px;
        }

        .boleto-info.active {
            display: block;
        }

        .boleto-code {
            background: white;
            padding: 12px;
            border-radius: 6px;
            font-family: monospace;
            font-weight: 700;
            word-break: break-all;
            font-size: 0.85rem;
            margin: 12px 0;
        }

        .card-type-selector {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 20px;
        }

        .card-type-btn {
            padding: 12px;
            border: 2px solid #e9d5ff;
            border-radius: 8px;
            background: white;
            cursor: pointer;
            font-weight: 600;
            color: var(--text-dark);
            transition: all 0.3s;
        }

        .card-type-btn:hover,
        .card-type-btn.active {
            border-color: var(--purple-dark);
            background: var(--purple-bg);
            color: var(--purple-dark);
        }

        @media (max-width: 992px) {
            .cart-item {
                grid-template-columns: 92px minmax(0, 1fr) 44px;
            }

            .product-img {
                width: 92px;
                height: 92px;
            }

            .qty-control,
            .line-total {
                grid-column: 2 / 4;
            }

            .line-total {
                text-align: left !important;
            }
        }

        @media (max-width: 768px) {
            .navbar-purple .d-flex.justify-content-between {
                gap: 14px;
                align-items: flex-start !important;
                flex-direction: column;
            }

            .navbar-purple .gap-3 {
                flex-wrap: wrap;
                gap: 8px !important;
            }

            .section-title h1 {
                font-size: 1.65rem;
            }
        }
    </style>
</head>
<body>
<nav class="navbar-purple">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center w-100">
            <a class="navbar-brand" href="/inicio">
                <i class="fa-solid fa-mobile-screen-button"></i>
                SAMSUNG STORE
            </a>
            <div class="d-flex align-items-center gap-3">
                <a href="/inicio" class="nav-link-custom">
                    <i class="fa-solid fa-house"></i> Inicio
                </a>
                <a href="/vitrine" class="nav-link-custom">
                    <i class="fa-solid fa-store"></i> Produtos
                </a>
                <a href="/roleta" class="nav-link-custom">
                    <i class="fa-solid fa-gift"></i> Roleta
                </a>
                <a href="/carrinho" class="nav-link-custom active position-relative">
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

<main class="page-shell">
    <div class="container">
        <div class="section-title mb-4">
            <h1><i class="fa-solid fa-cart-shopping me-2"></i> Meu Carrinho</h1>
            <p class="text-muted mb-0">Confira seus produtos antes de finalizar a compra.</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div id="cartItems">
                    <div class="loading-spinner">
                        <div class="spinner"></div>
                        <p>Carregando carrinho...</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <aside class="summary-panel">
                    <h4 class="fw-bold mb-4">Resumo</h4>
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <strong id="subtotal">R$ 0,00</strong>
                    </div>
                    <div class="summary-row">
                        <span>Desconto</span>
                        <strong id="desconto">R$ 0,00</strong>
                    </div>
                    <div class="summary-row">
                        <span>Entrega</span>
                        <strong>Grátis</strong>
                    </div>
                    <div class="coupon-box">
                        <label class="form-label fw-bold mb-2" for="couponInput">Cupom da roleta</label>
                        <div class="coupon-form" id="couponForm">
                            <input id="couponInput" type="text" placeholder="Digite o cupom">
                            <button id="applyCouponBtn" type="button" title="Aplicar cupom">
                                <i class="fa-solid fa-check"></i>
                            </button>
                        </div>
                        <div class="coupon-active" id="couponActive">
                            <div>
                                <small class="text-muted d-block">Cupom aplicado</small>
                                <strong id="couponLabel"></strong>
                            </div>
                            <button class="coupon-remove" id="removeCouponBtn" type="button" title="Remover cupom">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <a href="/roleta" class="btn-outline-purple w-100 mt-3">
                            <i class="fa-solid fa-gift"></i> Ganhar cupom
                        </a>
                    </div>
                    <div class="summary-row summary-total">
                        <span>Total</span>
                        <strong id="total">R$ 0,00</strong>
                    </div>
                    <button id="checkoutBtn" class="btn-purple mt-3" disabled>
                        <i class="fa-solid fa-check me-2"></i>Finalizar Compra
                    </button>
                    <a href="/vitrine" class="btn-outline-purple w-100 mt-3">
                        <i class="fa-solid fa-arrow-left"></i> Continuar comprando
                    </a>
                </aside>
            </div>
        </div>
    </div>
</main>

<script>
const placeholderImage = 'https://images.samsung.com/is/image/samsung/p6pim/br/feature/163786000/br-feature-gallery-samsung-zk-545150600?$684_547_JPG$';
let activeCouponCode = localStorage.getItem('couponCode') || '';

function formatMoney(value) {
    return Number(value || 0).toLocaleString('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    });
}

function getTokenOrRedirect() {
    let token = $.cookie('token');

    if (!token) {
        window.location.href = '/login';
        return null;
    }

    return token;
}

function authHeaders(token) {
    return { 'Authorization': 'Bearer ' + token };
}

function carregarCarrinho() {
    let token = getTokenOrRedirect();
    if (!token) return;

    $('#cartItems').html(`
        <div class="loading-spinner">
            <div class="spinner"></div>
            <p>Carregando carrinho...</p>
        </div>
    `);

    $.ajax({
        url: '/api/carrinho/itens',
        method: 'GET',
        headers: authHeaders(token),
        data: activeCouponCode ? { coupon_code: activeCouponCode } : {},
        success: function(res) {
            if (res.erro !== 'n') {
                mostrarErro(res.msg || 'Erro ao carregar carrinho');
                return;
            }

            renderCarrinho(res.items || []);
            atualizarResumo(res);
            atualizarBadge(res.items || []);
        },
        error: function(xhr) {
            mostrarErro(xhr.responseJSON?.msg || 'Erro ao carregar carrinho');
        }
    });
}

function renderCarrinho(items) {
    if (!items.length) {
        $('#cartItems').html(`
            <div class="empty-state">
                <i class="fa-solid fa-bag-shopping fa-3x text-muted mb-3"></i>
                <h4>Seu carrinho está vazio</h4>
                <p class="text-muted">Escolha um produto na vitrine para começar.</p>
                <a href="/vitrine" class="btn-outline-purple mt-2">
                    <i class="fa-solid fa-store"></i> Ver produtos
                </a>
            </div>
        `);
        $('#checkoutBtn').prop('disabled', true);
        return;
    }

    let html = '';

    items.forEach(item => {
        const produto = item.produto || {};
        const imagem = produto.imagem_url || placeholderImage;
        const titulo = produto.aparelho || 'Produto Samsung';
        const modelo = [produto.modelo, produto.cor, produto.ano].filter(Boolean).join(' - ');

        html += `
            <article class="cart-item" data-id="${item.id}">
                <img class="product-img" src="${imagem}" alt="${titulo}">
                <div>
                    <h5 class="product-title">${titulo}</h5>
                    <p class="product-model">${modelo}</p>
                    <div class="product-price">${formatMoney(item.preco_unitario)}</div>
                </div>
                <div class="qty-control" aria-label="Quantidade">
                    <button type="button" class="qty-minus" title="Diminuir quantidade">
                        <i class="fa-solid fa-minus"></i>
                    </button>
                    <input class="qty-input" type="number" min="1" max="${produto.estoque || 999}" value="${item.quantidade}">
                    <button type="button" class="qty-plus" title="Aumentar quantidade">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
                <div class="line-total text-end">${formatMoney(item.subtotal)}</div>
                <button type="button" class="remove-btn" title="Remover produto">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </article>
        `;
    });

    $('#cartItems').html(html);
    $('#checkoutBtn').prop('disabled', false);
}

function atualizarResumo(res) {
    $('#subtotal').text(formatMoney(res.subtotal));
    $('#desconto').text(formatMoney(res.desconto));
    $('#total').text(formatMoney(res.total));
    atualizarCupomAtivo(res.cupom);
}

function atualizarCupomAtivo(cupom) {
    if (cupom) {
        activeCouponCode = cupom.code;
        localStorage.setItem('couponCode', cupom.code);
        $('#couponLabel').text(`${cupom.code} - ${cupom.percent}% OFF`);
        $('#couponInput').val('');
        $('#couponForm').hide();
        $('#couponActive').css('display', 'flex');
        return;
    }

    if (activeCouponCode) {
        localStorage.removeItem('couponCode');
        activeCouponCode = '';
    }

    $('#couponForm').show();
    $('#couponActive').hide();
}

function atualizarBadge(items) {
    const count = items.reduce((total, item) => total + Number(item.quantidade || 0), 0);

    if (count > 0) {
        $('#cartCount').text(count).show();
    } else {
        $('#cartCount').hide();
    }
}

function mostrarErro(msg) {
    $('#cartItems').html(`
        <div class="empty-state">
            <i class="fa-solid fa-circle-exclamation fa-3x text-danger mb-3"></i>
            <h4>Não foi possível carregar o carrinho</h4>
            <p class="text-muted">${msg}</p>
        </div>
    `);
    $('#checkoutBtn').prop('disabled', true);
}

function atualizarQuantidade(cartId, quantidade) {
    let token = getTokenOrRedirect();
    if (!token) return;

    $.ajax({
        url: '/api/carrinho/atualizar',
        method: 'POST',
        headers: authHeaders(token),
        data: {
            token: token,
            cart_id: cartId,
            quantidade: quantidade
        },
        success: function(res) {
            if (res.erro === 'n') {
                carregarCarrinho();
                return;
            }

            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: res.msg || 'Não foi possível atualizar o item',
                confirmButtonColor: '#7e22ce'
            });
        },
        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: xhr.responseJSON?.msg || 'Não foi possível atualizar o item',
                confirmButtonColor: '#7e22ce'
            });
            carregarCarrinho();
        }
    });
}

function removerItem(cartId) {
    let token = getTokenOrRedirect();
    if (!token) return;

    $.ajax({
        url: '/api/carrinho/remover/' + cartId,
        method: 'DELETE',
        headers: authHeaders(token),
        data: { token: token },
        success: function(res) {
            if (res.erro === 'n') {
                carregarCarrinho();
                return;
            }

            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: res.msg || 'Não foi possível remover o item',
                confirmButtonColor: '#7e22ce'
            });
        },
        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: xhr.responseJSON?.msg || 'Não foi possível remover o item',
                confirmButtonColor: '#7e22ce'
            });
        }
    });
}

function finalizarCompra() {
    let token = getTokenOrRedirect();
    if (!token) return;

    const total = $('#total').text();

    // Create payment method selector
    const paymentHTML = `
        <div style="text-align: left;">
            <h4 style="margin-bottom: 20px; color: var(--text-dark);">Escolha o método de pagamento</h4>
            <div class="payment-methods">
                <div class="payment-option active" data-method="pix">
                    <i class="fa-solid fa-qrcode"></i>
                    <span>Pix</span>
                </div>
                <div class="payment-option" data-method="card">
                    <i class="fa-solid fa-credit-card"></i>
                    <span>Cartão</span>
                </div>
                <div class="payment-option" data-method="boleto">
                    <i class="fa-solid fa-barcode"></i>
                    <span>Boleto</span>
                </div>
            </div>

            <!-- Pix Method -->
            <div id="pix-payment" class="payment-method-content active">
                <p style="margin-bottom: 16px; color: #666;">Escaneie o código QR com seu aplicativo de banco:</p>
                <div class="qr-code-container">
                    <div id="qrcode"></div>
                </div>
                <p style="font-size: 0.85rem; color: #666; margin: 0;">
                    <strong>Chave Pix:</strong> samsung.store@empresa.com
                </p>
            </div>

            <!-- Card Method -->
            <div id="card-payment" class="payment-method-content" style="display: none;">
                <div class="card-type-selector">
                    <button class="card-type-btn active" data-type="credit">
                        <i class="fa-solid fa-credit-card me-2"></i>Crédito
                    </button>
                    <button class="card-type-btn" data-type="debit">
                        <i class="fa-solid fa-building-columns me-2"></i>Débito
                    </button>
                </div>

                <div class="card-logos">
                    <div class="card-logo selected" data-card="visa">Visa</div>
                    <div class="card-logo" data-card="mastercard">Mastercard</div>
                    <div class="card-logo" data-card="elo">Elo</div>
                    <div class="card-logo" data-card="amex">Amex</div>
                </div>

                <div class="form-group-row full">
                    <div class="form-group">
                        <label>Nome do Titular</label>
                        <input type="text" id="cardholderName" placeholder="Seu nome completo" />
                    </div>
                </div>

                <div class="form-group-row full">
                    <div class="form-group">
                        <label>Número do Cartão</label>
                        <input type="text" id="cardNumber" placeholder="0000 0000 0000 0000" maxlength="19" />
                    </div>
                </div>

                <div class="form-group-row">
                    <div class="form-group">
                        <label>Validade (MM/AA)</label>
                        <input type="text" id="cardExpiry" placeholder="12/25" maxlength="5" />
                    </div>
                    <div class="form-group">
                        <label>CVV</label>
                        <input type="text" id="cardCVV" placeholder="000" maxlength="4" />
                    </div>
                </div>

                <div class="form-group-row full">
                    <div class="form-group">
                        <label>CPF</label>
                        <input type="text" id="cardCPF" placeholder="000.000.000-00" maxlength="14" />
                    </div>
                </div>
            </div>

            <!-- Boleto Method -->
            <div id="boleto-payment" class="payment-method-content" style="display: none;">
                <p style="margin-bottom: 16px; color: #666;">Você receberá o código do boleto após confirmar a compra:</p>
                <div class="boleto-info active">
                    <strong style="display: block; margin-bottom: 8px;">Instruções:</strong>
                    <ol style="margin: 0; padding-left: 20px; font-size: 0.9rem; color: #666;">
                        <li>Você receberá um e-mail com o código do boleto</li>
                        <li>Acesse seu banco ou casa lotérica</li>
                        <li>Efetue o pagamento do boleto</li>
                        <li>Seu pedido será confirmado após a compensação</li>
                    </ol>
                </div>
                <div style="background: #fff3cd; border-left: 4px solid #ffc107; padding: 12px; border-radius: 6px; font-size: 0.9rem;">
                    <strong>⚠️ Aviso:</strong> O boleto pode levar até 2 dias úteis para compensação.
                </div>
            </div>
        </div>
    `;

    Swal.fire({
        title: `Finalizar Compra - ${total}`,
        html: paymentHTML,
        showCancelButton: true,
        confirmButtonText: 'Confirmar Pagamento',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#7e22ce',
        cancelButtonColor: '#dc3545',
        width: 600,
        didOpen: function() {
            initializePaymentUI();
            generateQRCode();
        },
        preConfirm: function() {
            const selectedMethod = document.querySelector('.payment-option.active').dataset.method;
            
            if (selectedMethod === 'card') {
                const cardholderName = document.getElementById('cardholderName').value.trim();
                const cardNumber = document.getElementById('cardNumber').value.trim();
                const cardExpiry = document.getElementById('cardExpiry').value.trim();
                const cardCVV = document.getElementById('cardCVV').value.trim();
                const cardCPF = document.getElementById('cardCPF').value.trim();

                if (!cardholderName || !cardNumber || !cardExpiry || !cardCVV || !cardCPF) {
                    Swal.showValidationMessage('Preencha todos os dados do cartão');
                    return false;
                }

                if (cardNumber.replace(/\s/g, '').length < 13) {
                    Swal.showValidationMessage('Número do cartão inválido');
                    return false;
                }
            }

            return selectedMethod;
        }
    }).then((result) => {
        if (!result.isConfirmed) return;

        processPayment(result.value, token);
    });
}

function aplicarCupom() {
    let token = getTokenOrRedirect();
    if (!token) return;

    const couponCode = ($('#couponInput').val() || '').trim().toUpperCase();

    if (!couponCode) {
        Swal.fire({
            icon: 'warning',
            title: 'Informe um cupom',
            confirmButtonColor: '#7e22ce'
        });
        return;
    }

    $.ajax({
        url: '/api/carrinho/aplicar-cupom',
        method: 'POST',
        headers: authHeaders(token),
        data: {
            token: token,
            coupon_code: couponCode
        },
        success: function(res) {
            if (res.erro === 'n') {
                activeCouponCode = res.coupon.code;
                localStorage.setItem('couponCode', activeCouponCode);
                Swal.fire({
                    icon: 'success',
                    title: 'Cupom aplicado',
                    text: `${res.coupon.percent}% de desconto no carrinho.`,
                    timer: 1400,
                    showConfirmButton: false
                });
                carregarCarrinho();
                return;
            }

            Swal.fire({
                icon: 'error',
                title: 'Cupom inválido',
                text: res.msg || 'Não foi possível aplicar o cupom',
                confirmButtonColor: '#7e22ce'
            });
        },
        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Cupom inválido',
                text: xhr.responseJSON?.msg || 'Não foi possível aplicar o cupom',
                confirmButtonColor: '#7e22ce'
            });
        }
    });
}

function removerCupom() {
    localStorage.removeItem('couponCode');
    activeCouponCode = '';
    atualizarCupomAtivo(null);
    carregarCarrinho();
}

function initializePaymentUI() {
    // Payment method selection
    document.querySelectorAll('.payment-option').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.payment-option').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.payment-method-content').forEach(c => c.style.display = 'none');
            
            this.classList.add('active');
            const method = this.dataset.method;
            document.getElementById(`${method}-payment`).style.display = 'block';

            if (method === 'pix') {
                setTimeout(generateQRCode, 100);
            }
        });
    });

    // Card type selection
    document.querySelectorAll('.card-type-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.card-type-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Card brand selection
    document.querySelectorAll('.card-logo').forEach(logo => {
        logo.addEventListener('click', function() {
            document.querySelectorAll('.card-logo').forEach(l => l.classList.remove('selected'));
            this.classList.add('selected');
        });
    });

    // Format card number
    const cardNumber = document.getElementById('cardNumber');
    if (cardNumber) {
        cardNumber.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s/g, '');
            let formatted = value.match(/.{1,4}/g)?.join(' ') || value;
            e.target.value = formatted;
        });
    }

    // Format expiry
    const cardExpiry = document.getElementById('cardExpiry');
    if (cardExpiry) {
        cardExpiry.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.slice(0, 2) + '/' + value.slice(2, 4);
            }
            e.target.value = value;
        });
    }

    // Format CPF
    const cardCPF = document.getElementById('cardCPF');
    if (cardCPF) {
        cardCPF.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 3) {
                value = value.slice(0, 3) + '.' + value.slice(3);
            }
            if (value.length > 7) {
                value = value.slice(0, 7) + '.' + value.slice(7);
            }
            if (value.length > 11) {
                value = value.slice(0, 11) + '-' + value.slice(11, 14);
            }
            e.target.value = value;
        });
    }

    // Format CVV
    const cardCVV = document.getElementById('cardCVV');
    if (cardCVV) {
        cardCVV.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '').slice(0, 4);
        });
    }
}

function generateQRCode() {
    const container = document.getElementById('qrcode');
    if (!container) return;

    // Clear previous QR code
    container.innerHTML = '';

    // Generate dummy Pix key for QR code
    const pixData = 'pix@samsung.com';
    
    try {
        new QRCode(container, {
            text: pixData,
            width: 200,
            height: 200,
            colorDark: '#7e22ce',
            colorLight: '#ffffff',
            correctLevel: QRCode.CorrectLevel.H
        });
    } catch (e) {
        console.log('QR Code generation error:', e);
    }
}

function processPayment(paymentMethod, token) {
    let token_value = token;
    let paymentData = {
        token: token_value,
        coupon_code: activeCouponCode,
        payment_method: paymentMethod
    };

    // Collect payment-specific data
    if (paymentMethod === 'card') {
        const cardTypeBtn = document.querySelector('.card-type-btn.active');
        const cardLogo = document.querySelector('.card-logo.selected');
        
        paymentData.card_type = cardTypeBtn ? cardTypeBtn.dataset.type : 'credit';
        paymentData.card_brand = cardLogo ? cardLogo.dataset.card : 'visa';
        paymentData.cardholder_name = document.getElementById('cardholderName').value;
        paymentData.card_number = document.getElementById('cardNumber').value.replace(/\s/g, '');
        paymentData.card_expiry = document.getElementById('cardExpiry').value;
        paymentData.card_cvv = document.getElementById('cardCVV').value;
        paymentData.card_cpf = document.getElementById('cardCPF').value.replace(/\D/g, '');
    } else if (paymentMethod === 'pix') {
        paymentData.pix_key = 'samsung.store@empresa.com';
    } else if (paymentMethod === 'boleto') {
        // Para boleto, não precisamos de dados adicionais
        // O backend vai gerar automaticamente
    }

    Swal.fire({
        title: 'Processando pagamento...',
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.ajax({
        url: '/api/carrinho/checkout',
        method: 'POST',
        headers: authHeaders(token_value),
        data: paymentData,
        success: function(res) {
            if (res.erro === 'n') {
                localStorage.removeItem('couponCode');
                activeCouponCode = '';
                
                let successMessage = 'Pedido realizado com sucesso!';
                let detailsText = `Número do pedido: ${res.pedido_numero}`;
                let iconType = 'success';

                if (paymentMethod === 'pix') {
                    successMessage = 'Pedido criado! Escaneie o QR Code Pix.';
                    detailsText = `Pedido: ${res.pedido_numero}\nChave Pix: samsung.store@empresa.com`;
                } else if (paymentMethod === 'boleto') {
                    successMessage = 'Boleto gerado com sucesso!';
                    detailsText = `Pedido: ${res.pedido_numero}\nUm e-mail com o boleto foi enviado para você.`;
                    
                    // Mostrar informações do boleto
                    if (res.boleto_dados) {
                        detailsText += `\n\n📄 Código de Barras: ${res.boleto_dados.codigo_barras}`;
                        detailsText += `\n💰 Valor: R$ ${res.boleto_dados.valor}`;
                        detailsText += `\n📅 Vencimento: ${res.boleto_dados.vencimento}`;
                        detailsText += `\n🔢 Nosso Número: ${res.boleto_dados.nosso_numero}`;
                    }
                } else if (paymentMethod === 'card') {
                    successMessage = 'Pagamento com cartão processado!';
                    detailsText = `Pedido: ${res.pedido_numero}\nForma: Cartão de ${res.card_type || 'crédito'}`;
                }

                Swal.fire({
                    icon: iconType,
                    title: successMessage,
                    text: detailsText,
                    confirmButtonColor: '#7e22ce',
                    confirmButtonText: 'Ok'
                }).then(() => carregarCarrinho());
                return;
            }

            Swal.fire({
                icon: 'error',
                title: 'Erro no pagamento',
                text: res.msg || 'Não foi possível processar o pagamento',
                confirmButtonColor: '#7e22ce'
            });
        },
        error: function(xhr) {
            let errorMsg = 'Não foi possível processar o pagamento';
            if (xhr.responseJSON?.msg) {
                errorMsg = xhr.responseJSON.msg;
            }
            
            Swal.fire({
                icon: 'error',
                title: 'Erro no pagamento',
                text: errorMsg,
                confirmButtonColor: '#7e22ce'
            });
        }
    });
}

$(document).ready(function() {
    carregarCarrinho();

    $(document).on('click', '.qty-minus', function() {
        const item = $(this).closest('.cart-item');
        const input = item.find('.qty-input');
        const nextValue = Math.max(1, Number(input.val()) - 1);
        input.val(nextValue);
        atualizarQuantidade(item.data('id'), nextValue);
    });

    $(document).on('click', '.qty-plus', function() {
        const item = $(this).closest('.cart-item');
        const input = item.find('.qty-input');
        const max = Number(input.attr('max')) || 999;
        const nextValue = Math.min(max, Number(input.val()) + 1);
        input.val(nextValue);
        atualizarQuantidade(item.data('id'), nextValue);
    });

    $(document).on('change', '.qty-input', function() {
        const item = $(this).closest('.cart-item');
        const max = Number($(this).attr('max')) || 999;
        const nextValue = Math.min(max, Math.max(1, Number($(this).val()) || 1));
        $(this).val(nextValue);
        atualizarQuantidade(item.data('id'), nextValue);
    });

    $(document).on('click', '.remove-btn', function() {
        const cartId = $(this).closest('.cart-item').data('id');
        removerItem(cartId);
    });

    $('#checkoutBtn').click(finalizarCompra);
    $('#applyCouponBtn').click(aplicarCupom);
    $('#removeCouponBtn').click(removerCupom);

    $('#couponInput').on('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            aplicarCupom();
        }
    });

    $('#logoutBtn').click(function(e) {
        e.preventDefault();
        $.removeCookie('token', { path: '/' });
        localStorage.removeItem('userEmail');
        localStorage.removeItem('couponCode');
        window.location.href = '/login';
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>