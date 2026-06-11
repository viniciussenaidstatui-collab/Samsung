<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Samsung Store - Vitrine de Produtos</title>
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

        /* Navbar */
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

        /* Carrossel */
        .carousel-container {
            margin-bottom: 3rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .carousel-item img {
            height: 400px;
            object-fit: cover;
            filter: brightness(0.85);
        }

        .carousel-caption {
            background: linear-gradient(90deg, rgba(0,0,0,0.7), transparent);
            border-radius: 10px;
            padding: 20px;
        }

        .carousel-caption h3 {
            font-size: 2rem;
            font-weight: 800;
        }

        /* Cards de Produto */
        .products-section {
            padding: 2rem 0 4rem;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }

        .section-title h2 {
            font-size: 2.2rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--purple-dark), #9b4dff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--purple-medium), var(--purple-dark));
            margin: 15px auto 0;
            border-radius: 2px;
        }

        .product-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(126, 34, 206, 0.08);
            margin-bottom: 30px;
            height: 100%;
            border: 1px solid rgba(126, 34, 206, 0.1);
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(126, 34, 206, 0.15);
            border-color: var(--purple-medium);
        }

        .product-img {
            height: 220px;
            object-fit: contain;
            padding: 1.5rem;
            background: linear-gradient(135deg, #faf5ff, #fff);
            width: 100%;
        }

        .product-info {
            padding: 1.2rem;
        }

        .product-title {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--text-dark);
        }

        .product-model {
            font-size: 0.8rem;
            color: #888;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--purple-dark);
            margin-bottom: 15px;
        }

        .product-price small {
            font-size: 0.7rem;
            font-weight: 400;
            color: #999;
        }

        .stock-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .stock-high {
            background: #d4edda;
            color: #155724;
        }

        .stock-medium {
            background: #fff3cd;
            color: #856404;
        }

        .stock-low {
            background: #f8d7da;
            color: #721c24;
        }

        .btn-purple {
            background: linear-gradient(135deg, var(--purple-dark), #9b4dff);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 8px 16px;
            font-weight: 600;
            transition: all 0.3s;
            width: 100%;
        }

        .btn-purple:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(126, 34, 206, 0.4);
            color: white;
        }

        .btn-outline-purple {
            border: 2px solid var(--purple-dark);
            color: var(--purple-dark);
            background: transparent;
            border-radius: 12px;
            padding: 6px 12px;
            font-weight: 600;
            transition: all 0.3s;
            width: 100%;
            margin-top: 8px;
        }

        .btn-outline-purple:hover {
            background: var(--purple-dark);
            color: white;
        }

        /* Loading */
        .loading-spinner {
            text-align: center;
            padding: 4rem;
        }

        .spinner {
            width: 60px;
            height: 60px;
            border: 4px solid var(--purple-soft);
            border-top: 4px solid var(--purple-dark);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Paginação */
        .pagination-custom {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 2rem;
        }

        .pagination-custom button {
            background: white;
            border: 1px solid var(--purple-medium);
            color: var(--purple-dark);
            padding: 8px 16px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .pagination-custom button:hover {
            background: var(--purple-dark);
            color: white;
        }

        .pagination-custom button.active {
            background: var(--purple-dark);
            color: white;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--purple-dark), #6b21a5);
            color: white;
            padding: 2rem 0;
            margin-top: 2rem;
        }

        /* Responsivo */
        @media (max-width: 768px) {
            .carousel-item img {
                height: 250px;
            }
            .carousel-caption h3 {
                font-size: 1.2rem;
            }
            .section-title h2 {
                font-size: 1.5rem;
            }
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

<!-- Carrossel -->
<div class="carousel-inner">
    <div class="carousel-item active">
        <img src="https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?w=1920&h=600&fit=crop" 
             class="d-block w-100" 
             alt="Galaxy S24 Ultra"
             style="object-fit: cover; height: 400px;">
        <div class="carousel-caption d-none d-md-block">
            <h3>Galaxy S24 Ultra</h3>
            <p>O smartphone mais avançado com IA integrada</p>
        </div>
    </div>
    <div class="carousel-item">
        <img src="https://images.unsplash.com/photo-1616348436168-de43ad0db179?w=1920&h=600&fit=crop" 
             class="d-block w-100" 
             alt="Galaxy Z Fold5"
             style="object-fit: cover; height: 400px;">
        <div class="carousel-caption d-none d-md-block">
            <h3>Galaxy Z Fold5</h3>
            <p>Dobrável com tela de 7.6" e multitarefa avançada</p>
        </div>
    </div>
    <div class="carousel-item">
        <img src="https://images.unsplash.com/photo-1579586337278-3befd40fd17a?w=1920&h=600&fit=crop" 
             class="d-block w-100" 
             alt="Galaxy Watch6"
             style="object-fit: cover; height: 400px;">
        <div class="carousel-caption d-none d-md-block">
            <h3>Galaxy Watch6 Classic</h3>
            <p>O relógio inteligente que cuida da sua saúde</p>
        </div>
    </div>
</div>
<!-- Seção de Produtos -->
<div class="products-section">
    <div class="container">
        <div class="section-title">
            <h2><i class="fa-solid fa-mobile-alt me-2"></i> Nossos Produtos</h2>
            <p class="text-muted">Os melhores smartphones, tablets e wearables da Samsung</p>
        </div>

        <div id="produtosContainer">
            <div class="loading-spinner">
                <div class="spinner"></div>
                <p>Carregando produtos incríveis...</p>
            </div>
        </div>

        <div id="paginationContainer" class="pagination-custom"></div>
    </div>
</div>

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
                    <li><a href="/inicio" class="text-white-50 text-decoration-none">Início</a></li>
                    <li><a href="/vitrine" class="text-white-50 text-decoration-none">Produtos</a></li>
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

<script>
let currentPage = 1;
let itemsPerPage = 6; // 6 produtos por página (2 linhas de 3)

function getStockClass(estoque) {
    if (estoque > 20) return 'stock-high';
    if (estoque > 5) return 'stock-medium';
    return 'stock-low';
}

function getStockText(estoque) {
    if (estoque > 20) return `${estoque} unidades disponíveis`;
    if (estoque > 5) return `${estoque} unidades`;
    if (estoque > 0) return `Últimas ${estoque} unidades!`;
    return 'Esgotado';
}

function carregarProdutos(page = 1) {
    let token = $.cookie('token');
    
    if (!token) {
        window.location.href = '/login';
        return;
    }
    
    $('#produtosContainer').html(`
        <div class="loading-spinner">
            <div class="spinner"></div>
            <p>Carregando produtos...</p>
        </div>
    `);
    
    $.ajax({
        url: "/api/todos_samsung",
        method: "POST",
        data: { token: token },
        success: function(res) {
            if (res.erro === 'n' && res.samsung) {
                let todosProdutos = res.samsung;
                let totalProdutos = todosProdutos.length;
                let totalPages = Math.ceil(totalProdutos / itemsPerPage);
                let start = (page - 1) * itemsPerPage;
                let produtosPagina = todosProdutos.slice(start, start + itemsPerPage);
                
                if (produtosPagina.length === 0) {
                    $('#produtosContainer').html(`
                        <div class="text-center py-5">
                            <i class="fa-solid fa-box-open fa-3x text-muted mb-3"></i>
                            <h4>Nenhum produto cadastrado ainda</h4>
                            <a href="/index" class="btn btn-purple mt-3">Cadastrar Produto</a>
                        </div>
                    `);
                    $('#paginationContainer').html('');
                    return;
                }
                
                let html = '<div class="row g-4">';
                
                produtosPagina.forEach(produto => {
                    let preco = produto.preco || 0;
                    let estoque = produto.estoque || 0;
                    let stockClass = getStockClass(estoque);
                    let stockText = getStockText(estoque);
                    
                    html += `
                        <div class="col-md-4 col-sm-6">
                            <div class="product-card">
                                <img src="${produto.imagem_url || 'https://images.samsung.com/is/image/samsung/p6pim/br/feature/163786000/br-feature-gallery-samsung-zk-545150600?$684_547_JPG$'}" 
                                     class="product-img" 
                                     alt="${produto.aparelho}">
                                <div class="product-info">
                                    <h5 class="product-title">${produto.aparelho}</h5>
                                    <p class="product-model">${produto.modelo} • ${produto.cor} • ${produto.ano}</p>
                                    <div class="stock-badge ${stockClass}">${stockText}</div>
                                    <div class="product-price">
                                        R$ ${preco.toLocaleString('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2})}
                                        <small>ou 12x s/ juros</small>
                                    </div>
                                    ${estoque > 0 ? `
                                        <button class="btn-purple add-to-cart" data-id="${produto.id}">
                                            <i class="fa-solid fa-cart-plus me-2"></i>Adicionar ao Carrinho
                                        </button>
                                        <a href="/loja/produto/${produto.id}" class="btn-outline-purple text-center d-inline-block">
                                            <i class="fa-regular fa-eye me-2"></i>Ver Detalhes
                                        </a>
                                    ` : `
                                        <button class="btn-purple" disabled style="background: #ccc; cursor: not-allowed;">
                                            <i class="fa-solid fa-times me-2"></i>Indisponível
                                        </button>
                                    `}
                                </div>
                            </div>
                        </div>
                    `;
                });
                
                html += '</div>';
                $('#produtosContainer').html(html);
                
                // Paginação
                if (totalPages > 1) {
                    let pagHtml = '';
                    for (let i = 1; i <= totalPages; i++) {
                        pagHtml += `<button class="page-btn ${i === page ? 'active' : ''}" data-page="${i}">${i}</button>`;
                    }
                    $('#paginationContainer').html(pagHtml);
                    
                    $('.page-btn').click(function() {
                        currentPage = $(this).data('page');
                        carregarProdutos(currentPage);
                        $('html, body').animate({ scrollTop: 0 }, 500);
                    });
                } else {
                    $('#paginationContainer').html('');
                }
            } else {
                $('#produtosContainer').html(`
                    <div class="text-center py-5">
                        <i class="fa-solid fa-circle-exclamation fa-3x text-danger mb-3"></i>
                        <h4>Erro ao carregar produtos</h4>
                        <p class="text-muted">Tente novamente mais tarde</p>
                    </div>
                `);
            }
        },
        error: function() {
            $('#produtosContainer').html(`
                <div class="text-center py-5">
                    <i class="fa-solid fa-circle-exclamation fa-3x text-danger mb-3"></i>
                    <h4>Erro de conexão</h4>
                    <p class="text-muted">Verifique sua conexão e tente novamente</p>
                </div>
            `);
        }
    });
}

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
            confirmButtonColor: '#7e22ce'
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
        }
    });
    
    $.ajax({
        url: "/api/carrinho/adicionar",
        method: "POST",
        headers: { 'Authorization': 'Bearer ' + token },
        data: {
            produto_id: produtoId,
            quantidade: 1
        },
        success: function(res) {
            if (res.erro === 'n') {
                Swal.fire({
                    icon: 'success',
                    title: 'Adicionado!',
                    text: res.msg,
                    timer: 1500,
                    showConfirmButton: false,
                    background: '#faf5ff'
                });
                atualizarCarrinho();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: res.msg,
                    confirmButtonColor: '#7e22ce'
                });
            }
        },
        error: function(xhr) {
            let msg = xhr.responseJSON?.msg || 'Erro ao adicionar produto';
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: msg,
                confirmButtonColor: '#7e22ce'
            });
        }
    });
}

$(document).ready(function() {
    let token = $.cookie('token');
    if (!token) {
        window.location.href = '/login';
        return;
    }
    
    carregarProdutos(currentPage);
    atualizarCarrinho();
    
    $(document).on('click', '.add-to-cart', function() {
        addToCart($(this).data('id'));
    });
    
    $('#logoutBtn').click(function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Deseja sair?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#7e22ce',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Sim, sair'
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
