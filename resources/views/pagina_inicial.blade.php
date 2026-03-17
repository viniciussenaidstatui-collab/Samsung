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

        /* Navbar Refinada */
        .navbar-custom { 
            background: rgba(111, 66, 193, 0.95);
            backdrop-filter: blur(10px);
            padding: 0.8rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.4rem;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .nav-link-custom {
            background: rgba(255, 255, 255, 0.2);
            color: white !important;
            padding: 8px 20px !important;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .nav-link-custom:hover {
            background: white;
            color: var(--primary-purple) !important;
            transform: translateY(-2px);
        }

        /* Hero Moderno */
        .hero-section {
            padding: 100px 0 60px;
            background: radial-gradient(circle at top right, #f3f0ff, transparent);
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--dark-purple), var(--primary-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1;
            margin-bottom: 25px;
        }

        /* Cards Estilo Glassmorphism */
        .card-clean {
            background: var(--glass);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 28px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.03);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .card-clean:hover {
            transform: translateY(-12px);
            box-shadow: 0 30px 60px rgba(111, 66, 193, 0.12);
            border-color: var(--primary-purple);
        }

        .card-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--soft-purple), #fff);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            box-shadow: inset 0 0 10px rgba(111, 66, 193, 0.05);
        }

        /* Seção de Tags */
        .search-section {
            background: white;
            border-radius: 32px;
            padding: 40px;
            border: 1px solid #f0f0f5;
        }

        .search-tag {
            background: #f8f9fa;
            color: #555;
            padding: 10px 24px;
            border-radius: 14px;
            font-size: 0.9rem;
            font-weight: 600;
            transition: 0.3s;
            border: 1px solid #eee;
        }

        .search-tag:hover {
            background: var(--primary-purple);
            color: white;
            border-color: var(--primary-purple);
        }

        /* Botões */
        .btn-purple {
            background: var(--primary-purple);
            padding: 14px 35px;
            border-radius: 16px;
            font-weight: 700;
            box-shadow: 0 10px 20px rgba(111, 66, 193, 0.2);
        }

        .btn-outline-purple {
            border: 2px solid var(--primary-purple);
            padding: 12px 30px;
            border-radius: 16px;
            font-weight: 700;
        }

        /* Banner Flutuante */
        .installment-banner {
            background: linear-gradient(135deg, var(--dark-purple), var(--primary-purple));
            color: white;
            border-radius: 35px;
            padding: 60px;
            position: relative;
            overflow: hidden;
        }

        .installment-banner::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }

        /* Status Indicador */
        .status-pill {
            background: rgba(46, 204, 113, 0.15);
            color: #1fb161;
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .dot-pulse {
            width: 8px;
            height: 8px;
            background: #2ecc71;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(46, 204, 113, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(46, 204, 113, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(46, 204, 113, 0); }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-custom">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center w-100">
            <a class="navbar-brand text-white d-flex align-items-center" href="#">
                <i class="fa-solid fa-mobile-screen-button me-2"></i>
                SAMSUNG <span class="fw-light ms-2 opacity-75">Admin</span>
            </a>
            
            <div class="d-flex align-items-center gap-4">
                    
                <a href="/index" class="nav-link-custom">
                    <i class="fa-solid fa-plus me-2"></i>Adicionar Aparelho
                </a>
                <div class="d-flex gap-3 text-white fs-5">
                    <i class="fa-regular fa-circle-user cursor-pointer"></i>
                    <i class="fa-regular fa-bell cursor-pointer"></i>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="container">
    <div class="hero-section">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="badge-purple mb-3">Portal de Gestão 2026</div>
                <h1 class="hero-title">Inovação na<br>sua mão.</h1>
                <p class="hero-subtitle fs-5">Gerencie o ecossistema de produtos Samsung com uma interface intuitiva e poderosa.</p>
                <div class="d-flex gap-3">
                    <a href="#" class="btn btn-purple text-white">Explorar Dashboard</a>
                    <a href="#" class="btn btn-outline-purple">Relatórios</a>
                </div>
            </div>
            <div class="col-lg-6 text-center d-none d-lg-block">
                <div class="position-relative">
                    <i class="fa-solid fa-layer-group fa-10x" style="color: var(--primary-purple); opacity: 0.1;"></i>
                    <i class="fa-solid fa-mobile-screen fa-8x position-absolute top-50 start-50 translate-middle" style="color: var(--primary-purple);"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="search-section shadow-sm mb-5">
        <h5 class="fw-bold mb-4"><i class="fa-solid fa-magnifying-glass me-2 text-primary"></i>Acesso Rápido por Modelo</h5>
        <div class="search-tags">
            <a href="#" class="search-tag text-decoration-none">Galaxy S24 Ultra</a>
            <a href="#" class="search-tag text-decoration-none">Galaxy Z Fold5</a>
            <a href="#" class="search-tag text-decoration-none">Neo QLED 8K</a>
            <a href="#" class="search-tag text-decoration-none">Bespoke AI</a>
            <a href="#" class="search-tag text-decoration-none">Galaxy Watch6</a>
            <a href="#" class="search-tag text-decoration-none">Tab S9 Ultra</a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card-clean">
                <div class="card-icon">
                    <i class="fa-solid fa-chart-line text-primary"></i>
                </div>
                <h3>Análise de Vendas</h3>
                <p>Monitore o desempenho de cada categoria de produto em tempo real com gráficos detalhados.</p>
                <a href="#" class="btn btn-outline-purple w-100">Abrir Painel</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-clean">
                <div class="card-icon">
                    <i class="fa-solid fa-microchip text-primary"></i>
                </div>
                <h3>Suporte Técnico</h3>
                <p>Acesse documentação técnica e atualizações de firmware para todos os dispositivos ativos.</p>
                <a href="#" class="btn btn-outline-purple w-100">Ver Docs</a>
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
                <a href="/altera_loja" class="btn btn-light btn-lg px-5 py-3 rounded-4 fw-bold text-purple" style="color: var(--primary-purple);">Começar Agora</a>
            </div>
        </div>
    </div>

    <div class="text-center py-5">
        <h3 class="fw-bold mb-5">Ações do Sistema</h3>
        <div class="row g-3 justify-content-center">
            <div class="col-6 col-md-auto">
                <a href="/index" class="btn btn-outline-purple px-4 py-3 w-100"><i class="fa-solid fa-house me-2"></i>Início</a>
            </div>
            <div class="col-6 col-md-auto">
                <a href="/visualiza_loja" class="btn btn-outline-purple px-4 py-3 w-100"><i class="fa-solid fa-list-check me-2"></i>Estoque</a>
            </div>
            <div class="col-6 col-md-auto">
                <a href="/deleta_samsung" class="btn btn-outline-danger px-4 py-3 w-100"><i class="fa-solid fa-trash-can me-2"></i>Limpar Base</a>
            </div>
        </div>
    </div>
</div>

<footer class="bg-white border-top py-5 mt-5">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>