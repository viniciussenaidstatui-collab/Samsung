<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samsung - Portal Interno</title>
    <link rel="icon" href="Logo1.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        :root {
            --primary-purple: #6f42c1;
            --soft-purple: #f3f0ff;
            --dark-purple: #2d1b4e;
            --accent-blue: #007aff;
            --bg-page: #fdfdff;
            --glass: rgba(255, 255, 255, 0.8);
        }

        body { 
            background-color: var(--bg-page); 
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1d1d1f;
            overflow-x: hidden;
        }

        /* Navbar Refinada com 3 linhas */
        .navbar-custom { 
            background: rgba(111, 66, 193, 0.98);
            backdrop-filter: blur(10px);
            padding: 0.5rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        /* Primeira linha da navbar */
        .navbar-top {
            padding: 0.5rem 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.4rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: white !important;
            text-decoration: none;
        }

        .user-info {
            color: white;
            font-size: 0.9rem;
            background: rgba(255,255,255,0.15);
            padding: 5px 15px;
            border-radius: 30px;
        }

        /* Segunda linha da navbar - Menu principal */
        .navbar-middle {
            padding: 0.5rem 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .nav-menu {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .nav-item-custom {
            background: rgba(255, 255, 255, 0.1);
            color: white !important;
            padding: 8px 20px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
        }

        .nav-item-custom:hover {
            background: white;
            color: var(--primary-purple) !important;
            transform: translateY(-2px);
        }

        .nav-item-custom.danger:hover {
            background: #dc3545;
            color: white !important;
        }

        /* Terceira linha - Status e informações */
        .navbar-bottom {
            padding: 0.3rem 0;
            background: rgba(0,0,0,0.1);
        }

        .status-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: rgba(255,255,255,0.8);
            font-size: 0.8rem;
        }

        .status-badge {
            background: rgba(46, 204, 113, 0.2);
            color: #2ecc71;
            padding: 3px 10px;
            border-radius: 20px;
            font-weight: 600;
        }

        .dot-pulse {
            width: 8px;
            height: 8px;
            background: #2ecc71;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(46, 204, 113, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(46, 204, 113, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(46, 204, 113, 0); }
        }

        /* Hero Moderno */
        .hero-section {
            padding: 60px 0 40px;
            background: radial-gradient(circle at top right, #f3f0ff, transparent);
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--dark-purple), var(--primary-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1.1;
            margin-bottom: 20px;
        }

        /* Cards Estilo Glassmorphism */
        .card-clean {
            background: var(--glass);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 28px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.03);
            transition: all 0.4s ease;
            height: 100%;
        }

        .card-clean:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 60px rgba(111, 66, 193, 0.12);
            border-color: var(--primary-purple);
        }

        .card-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--soft-purple), #fff);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        /* Seção de Tags */
        .search-section {
            background: white;
            border-radius: 28px;
            padding: 30px;
            border: 1px solid #f0f0f5;
        }

        .search-tag {
            background: #f8f9fa;
            color: #555;
            padding: 8px 20px;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 600;
            transition: 0.3s;
            border: 1px solid #eee;
            text-decoration: none;
            display: inline-block;
            margin: 5px;
        }

        .search-tag:hover {
            background: var(--primary-purple);
            color: white;
            border-color: var(--primary-purple);
        }

        /* Botões */
        .btn-purple {
            background: var(--primary-purple);
            color: white;
            padding: 12px 30px;
            border-radius: 14px;
            font-weight: 700;
            border: none;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-purple:hover {
            background: var(--dark-purple);
            color: white;
            transform: translateY(-2px);
        }

        .btn-outline-purple {
            border: 2px solid var(--primary-purple);
            color: var(--primary-purple);
            padding: 10px 25px;
            border-radius: 14px;
            font-weight: 700;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-outline-purple:hover {
            background: var(--primary-purple);
            color: white;
        }

        /* Banner Flutuante */
        .installment-banner {
            background: linear-gradient(135deg, var(--dark-purple), var(--primary-purple));
            color: white;
            border-radius: 30px;
            padding: 50px;
            position: relative;
            overflow: hidden;
        }
    </style>
</head>
<body>

<nav class="navbar-custom">
    <!-- Primeira Linha - Logo e Usuário -->
    <div class="navbar-top">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a class="navbar-brand" href="/inicio">
                    <i class="fa-solid fa-mobile-screen-button me-2"></i>
                    SAMSUNG ADMIN
                </a>
                <div class="d-flex align-items-center gap-3">
                    <span class="user-info" id="userEmail">
                        <i class="fa-regular fa-circle-user me-2"></i>
                        <span id="userEmailText">Carregando...</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Segunda Linha - Menu Principal -->
    <div class="navbar-middle">
        <div class="container">
            <div class="nav-menu">
                <a href="/inicio" class="nav-item-custom">
                    <i class="fa-solid fa-house"></i>
                    Início
                </a>
                <a href="/index" class="nav-item-custom">
                    <i class="fa-solid fa-plus-circle"></i>
                    Registrar Produto
                </a>
                <a href="#" id="btnLogout" class="nav-item-custom danger">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    Logout
                </a>
            </div>
        </div>
    </div>

    <!-- Terceira Linha - Status do Sistema -->
    <div class="navbar-bottom">
        <div class="container">
            <div class="status-info">
                <div class="d-flex align-items-center gap-3">
                    <span>
                        <span class="dot-pulse"></span>
                        Sistema Online
                    </span>
                    <span class="status-badge">
                        <i class="fa-regular fa-clock me-1"></i>
                        <span id="currentTime"></span>
                    </span>
                </div>
                <div>
                    <i class="fa-regular fa-bell me-2"></i>
                    <span id="notificationCount">0</span> notificações
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="container">
    <div class="hero-section">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="mb-3">
                    <span class="status-badge">
                        <i class="fa-regular fa-star me-1"></i>
                        Bem-vindo de volta!
                    </span>
                </div>
                <h1 class="hero-title">Inovação na<br>sua mão.</h1>
                <p class="fs-5 mb-4">Gerencie o ecossistema de produtos Samsung com uma interface intuitiva e poderosa.</p>
                <div class="d-flex gap-3">
                    <a href="/index" class="btn-purple">
                        <i class="fa-solid fa-plus me-2"></i>Novo Produto
                    </a>
                    <a href="#" class="btn-outline-purple">
                        <i class="fa-solid fa-chart-simple me-2"></i>Relatórios
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center d-none d-lg-block">
                <div class="position-relative">
                    <i class="fa-solid fa-layer-group fa-8x" style="color: var(--primary-purple); opacity: 0.1;"></i>
                    <i class="fa-solid fa-mobile-screen fa-6x position-absolute top-50 start-50 translate-middle" style="color: var(--primary-purple);"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="search-section shadow-sm mb-5">
        <h5 class="fw-bold mb-4">
            <i class="fa-solid fa-magnifying-glass me-2 text-primary"></i>
            Acesso Rápido por Modelo
        </h5>
        <div class="search-tags">
            <a href="/index?modelo=S24 Ultra" class="search-tag">Galaxy S24 Ultra</a>
            <a href="/index?modelo=Z Fold5" class="search-tag">Galaxy Z Fold5</a>
            <a href="/index?modelo=Neo QLED" class="search-tag">Neo QLED 8K</a>
            <a href="/index?modelo=Bespoke" class="search-tag">Bespoke AI</a>
            <a href="/index?modelo=Watch6" class="search-tag">Galaxy Watch6</a>
            <a href="/index?modelo=Tab S9" class="search-tag">Tab S9 Ultra</a>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card-clean">
                <div class="card-icon">
                    <i class="fa-solid fa-chart-line fs-3" style="color: var(--primary-purple);"></i>
                </div>
                <h3 class="fw-bold">Análise de Vendas</h3>
                <p class="text-muted">Monitore o desempenho de cada categoria de produto em tempo real.</p>
                <a href="#" class="btn-outline-purple w-100 text-center">Abrir Painel</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-clean">
                <div class="card-icon">
                    <i class="fa-solid fa-microchip fs-3" style="color: var(--primary-purple);"></i>
                </div>
                <h3 class="fw-bold">Suporte Técnico</h3>
                <p class="text-muted">Acesse documentação técnica e atualizações de firmware.</p>
                <a href="#" class="btn-outline-purple w-100 text-center">Ver Docs</a>
            </div>
        </div>
    </div>

    <div class="installment-banner my-5 shadow-lg">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2 class="display-5 fw-bold mb-3">Expanda o Inventário</h2>
                <p class="opacity-75 fs-5">Adicione novos modelos à base de dados global e sincronize com as lojas em segundos.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="/index" class="btn btn-light btn-lg px-5 py-3 rounded-4 fw-bold" style="color: var(--primary-purple);">
                    <i class="fa-solid fa-plus me-2"></i>Começar Agora
                </a>
            </div>
        </div>
    </div>
</div>

<footer class="bg-white border-top py-4 mt-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="text-muted mb-0">© 2026 Samsung Electronics. Interface de Gerenciamento Interno.</p>
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                <a href="#" class="text-muted text-decoration-none me-3">Privacidade</a>
                <a href="#" class="text-muted text-decoration-none">Termos de Uso</a>
            </div>
        </div>
    </div>
</footer>

<script>
$(document).ready(function() {
    // Verificar se está logado
    let token = $.cookie('token');
    
    if (!token) {
        window.location.href = '/login';
        return;
    }

    // Mostrar email do usuário (se tiver salvo)
    let userEmail = localStorage.getItem('userEmail') || 'Admin';
    $('#userEmailText').text(userEmail);

    // Atualizar hora atual
    function updateTime() {
        let now = new Date();
        let timeStr = now.toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });
        $('#currentTime').text(timeStr);
    }
    updateTime();
    setInterval(updateTime, 1000);

    // Logout
    $('#btnLogout').click(function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Deseja sair?',
            text: 'Você será desconectado do sistema.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#6f42c1',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Sim, sair',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.removeCookie('token', { path: '/' });
                localStorage.removeItem('userEmail');
                
                Swal.fire({
                    icon: 'success',
                    title: 'Logout realizado!',
                    text: 'Até logo!',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = '/login';
                });
            }
        });
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>