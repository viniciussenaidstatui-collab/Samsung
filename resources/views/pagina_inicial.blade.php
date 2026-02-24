<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samsung - Página Inicial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-purple: #6f42c1;
            --soft-purple: #f3f0ff;
            --dark-purple: #5227a1;
            --bg-page: #f8f7ff;
        }

        body { 
            background-color: var(--bg-page); 
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: #333;
            line-height: 1.6;
        }

        /* Navbar clean */
        .navbar-custom { 
            background: linear-gradient(135deg, var(--primary-purple), var(--dark-purple));
            padding: 1.2rem 0;
            border-bottom: 3px solid rgba(255,255,255,0.1);
            box-shadow: 0 4px 12px rgba(111, 66, 193, 0.15);
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }

        .navbar-brand i {
            font-size: 1.8rem;
            margin-right: 8px;
        }

        /* Cards limpos */
        .card-clean {
            background: white;
            border: none;
            border-radius: 24px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(111, 66, 193, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .card-clean:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(111, 66, 193, 0.1);
        }

        .card-icon {
            width: 60px;
            height: 60px;
            background: var(--soft-purple);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .card-icon i {
            font-size: 2rem;
            color: var(--primary-purple);
        }

        .card-clean h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--dark-purple);
        }

        .card-clean p {
            color: #666;
            margin-bottom: 20px;
        }

        /* Botões */
        .btn-outline-purple {
            border: 2px solid var(--primary-purple);
            color: var(--primary-purple);
            border-radius: 50px;
            padding: 10px 30px;
            font-weight: 600;
            background: transparent;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-outline-purple:hover {
            background: var(--primary-purple);
            color: white;
        }

        .btn-purple {
            background: var(--primary-purple);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 12px 40px;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 5px 15px rgba(111, 66, 193, 0.2);
        }

        .btn-purple:hover {
            background: var(--dark-purple);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(111, 66, 193, 0.3);
            color: white;
        }

        /* Hero Section */
        .hero-section {
            padding: 60px 0;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 20px;
            color: var(--dark-purple);
            letter-spacing: -1px;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 30px;
        }

        /* Badges */
        .badge-purple {
            background: var(--soft-purple);
            color: var(--primary-purple);
            padding: 6px 15px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-block;
            margin-right: 10px;
            margin-bottom: 10px;
            border: 1px solid rgba(111, 66, 193, 0.1);
        }

        /* Seção de pesquisa */
        .search-section {
            background: white;
            border-radius: 30px;
            padding: 30px;
            margin: 40px 0;
            box-shadow: 0 5px 20px rgba(0,0,0,0.02);
        }

        .search-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
        }

        .search-tag {
            background: var(--soft-purple);
            color: var(--dark-purple);
            padding: 8px 20px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
            border: 1px solid transparent;
        }

        .search-tag:hover {
            background: var(--primary-purple);
            color: white;
        }

        /* Banner de parcelamento */
        .installment-banner {
            background: linear-gradient(135deg, var(--soft-purple), white);
            border-radius: 30px;
            padding: 50px;
            margin: 40px 0;
            border: 1px solid rgba(111, 66, 193, 0.1);
        }

        .installment-banner h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-purple);
            margin-bottom: 15px;
        }

        /* Links de informação */
        .info-link {
            display: flex;
            align-items: center;
            background: white;
            border-radius: 20px;
            padding: 20px;
            text-decoration: none;
            color: inherit;
            border: 1px solid rgba(111, 66, 193, 0.1);
            transition: all 0.3s;
            height: 100%;
        }

        .info-link:hover {
            border-color: var(--primary-purple);
            box-shadow: 0 10px 25px rgba(111, 66, 193, 0.05);
        }

        .info-icon {
            width: 50px;
            height: 50px;
            background: var(--soft-purple);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }

        .info-icon i {
            font-size: 1.5rem;
            color: var(--primary-purple);
        }

        .info-content h4 {
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--dark-purple);
        }

        .info-content p {
            margin: 0;
            color: #666;
            font-size: 0.9rem;
        }

        /* Status dot */
        .status-dot {
            height: 8px;
            width: 8px;
            background: #2ecc71;
            border-radius: 50%;
            display: inline-block;
            margin-right: 6px;
        }

        /* Footer */
        .footer {
            background: white;
            border-top: 1px solid rgba(111, 66, 193, 0.1);
            padding: 40px 0;
            margin-top: 60px;
        }

        .footer-links a {
            color: #666;
            text-decoration: none;
            margin-right: 25px;
            font-size: 0.9rem;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: var(--primary-purple);
        }

        /* Responsivo */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            .installment-banner h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

<!-- Navbar Clean -->
<nav class="navbar navbar-custom">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center w-100">
            <a class="navbar-brand text-white" href="#">
                <i class="fa-solid fa-mobile-screen-button"></i>
                SAMSUNG
            </a>
            <div class="d-flex align-items-center gap-4">
                <span class="text-white-50 small">
                    <span class="status-dot"></span>
                    <span>Sistema Ativo</span>
                </span>
                <div class="d-flex gap-3">
                    <i class="fa-regular fa-circle-user text-white"></i>
                    <i class="fa-regular fa-bag-shopping text-white"></i>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="container">

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="hero-title">Compra direta.<br>Obtenha mais.</h1>
                <p class="hero-subtitle">Aproveite benefícios exclusivos comprando diretamente com a Samsung.</p>
                <div class="d-flex gap-3">
                    <a href="#" class="btn-purple">Comprar agora</a>
                    <a href="#" class="btn-outline-purple">Conheça ofertas</a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <i class="fa-solid fa-mobile-screen-button fa-8x" style="color: var(--primary-purple); opacity: 0.8;"></i>
            </div>
        </div>
    </div>

    <!-- Pesquisas Sugeridas -->
    <div class="search-section">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h4 class="fw-bold mb-0" style="color: var(--dark-purple);">Pesquisas sugeridas</h4>
            <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Pesquisas recentes</span>
        </div>
        <div class="search-tags">
            <a href="#" class="search-tag">Galaxy S24 Ultra</a>
            <a href="#" class="search-tag">Smart TV 8K</a>
            <a href="#" class="search-tag">Soundbar</a>
            <a href="#" class="search-tag">Galaxy Tab S9</a>
            <a href="#" class="search-tag">Refrigerador</a>
            <a href="#" class="search-tag">Washtower</a>
            <a href="#" class="search-tag">Galaxy Watch6</a>
            <a href="#" class="search-tag">Buds2 Pro</a>
        </div>
    </div>

    <!-- Cards de Benefícios -->
    <div class="row g-4 my-5">
        <div class="col-md-6">
            <div class="card-clean">
                <div class="card-icon">
                    <i class="fa-regular fa-star"></i>
                </div>
                <h3>Samsung Rewards</h3>
                <p>Conheça um jeito todo seu de aproveitar produtos e serviços com pontos e benefícios.</p>
                <a href="#" class="btn-outline-purple">Conheça</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-clean">
                <div class="card-icon">
                    <i class="fa-regular fa-shield"></i>
                </div>
                <h3>Samsung Care+</h3>
                <p>Cuidado certificado por especialistas da Samsung para seu dispositivo.</p>
                <a href="#" class="btn-outline-purple">Saiba mais</a>
            </div>
        </div>
    </div>

    <!-- Banner de Parcelamento -->
    <div class="installment-banner">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2>Até 18x sem juros em todos os cartões.</h2>
                <p class="fs-5 text-muted">Chegou a hora de garantir o seu novo Samsung com parcelas que cabem no bolso.</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                <a href="#" class="btn-purple">Ver ofertas</a>
            </div>
        </div>
    </div>

    <!-- Links de Informação -->
    <div class="row g-4 my-5">
        <div class="col-md-6">
            <a href="#" class="info-link">
                <div class="info-icon">
                    <i class="fa-regular fa-circle-question"></i>
                </div>
                <div class="info-content">
                    <h4>Informações de Garantia</h4>
                    <p>Desfrute da garantia do fabricante para total tranquilidade.</p>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="#" class="info-link">
                <div class="info-icon">
                    <i class="fa-regular fa-headset"></i>
                </div>
                <div class="info-content">
                    <h4>Ajuda para escolher</h4>
                    <p>Nossos especialistas estão prontos para ajudar você.</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Acesso rápido às páginas -->
    <div class="text-center my-5">
        <h4 class="mb-4" style="color: var(--dark-purple);">Acesse o sistema</h4>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="/index" class="btn-outline-purple"><i class="fa-regular fa-house me-2"></i>Início</a>
            <a href="/altera_loja" class="btn-outline-purple"><i class="fa-regular fa-pen-to-square me-2"></i>Cadastrar</a>
            <a href="/visualiza_loja" class="btn-outline-purple"><i class="fa-regular fa-eye me-2"></i>Visualizar</a>
            <a href="/deleta_samsung" class="btn-outline-purple"><i class="fa-regular fa-trash-can me-2"></i>Deletar</a>
        </div>
    </div>

</div>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="footer-links">
                    <a href="#">Celulares</a>
                    <a href="#">TVs</a>
                    <a href="#">Eletrodomésticos</a>
                    <a href="#">Acessórios</a>
                </div>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="mb-0 text-muted small">© 2025 Samsung. Todos os direitos reservados.</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>