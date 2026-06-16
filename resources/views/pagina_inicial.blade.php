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
            --bg-page: #f5f4fa;
            --glass: rgba(255, 255, 255, 0.9);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body { 
            background-color: var(--bg-page); 
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1d1d1f;
            overflow-x: hidden;
        }

        /* ══════════════════════════════
           NAVBAR
        ══════════════════════════════ */
        .navbar-custom { 
            background: linear-gradient(175deg, #2d1b4e 0%, #1a0533 100%);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-top {
            padding: 12px 0;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.05rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: white !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand .brand-icon {
            width: 36px; height: 36px;
            background: var(--primary-purple);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }

        .user-info {
            color: rgba(255,255,255,0.85);
            font-size: 0.82rem;
            font-weight: 600;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            padding: 6px 16px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-middle {
            padding: 10px 0;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .nav-menu {
            display: flex;
            gap: 8px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .nav-item-custom {
            background: rgba(255,255,255,0.07);
            color: rgba(255,255,255,0.75) !important;
            padding: 8px 20px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.2s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.88rem;
            border: 1px solid rgba(255,255,255,0.08);
        }

        .nav-item-custom:hover {
            background: var(--primary-purple);
            color: white !important;
            border-color: transparent;
            transform: translateY(-1px);
        }

        .nav-item-custom.danger:hover {
            background: #dc3545;
            color: white !important;
            border-color: transparent;
        }

        .navbar-bottom {
            padding: 6px 0;
            background: rgba(0,0,0,0.15);
        }

        .status-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: rgba(255,255,255,0.45);
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-badge {
            background: rgba(46,204,113,0.15);
            color: #2ecc71;
            padding: 3px 10px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.72rem;
            border: 1px solid rgba(46,204,113,0.2);
        }

        .dot-pulse {
            width: 7px; height: 7px;
            background: #2ecc71;
            border-radius: 50%;
            display: inline-block;
            margin-right: 6px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%   { box-shadow: 0 0 0 0 rgba(46,204,113,0.6); }
            70%  { box-shadow: 0 0 0 7px rgba(46,204,113,0); }
            100% { box-shadow: 0 0 0 0 rgba(46,204,113,0); }
        }

        /* ══════════════════════════════
           HERO
        ══════════════════════════════ */
        .hero-section {
            padding: 70px 0 50px;
            position: relative;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(111,66,193,0.07) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-section .status-badge {
            background: var(--soft-purple);
            color: var(--primary-purple);
            border: 1px solid rgba(111,66,193,0.15);
            font-size: 0.78rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--dark-purple) 0%, var(--primary-purple) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.1;
            margin-bottom: 18px;
        }

        .hero-section .fs-5 {
            font-size: 0.98rem !important;
            color: #777;
            line-height: 1.7;
            max-width: 480px;
        }

        .btn-purple {
            background: var(--primary-purple);
            color: white;
            padding: 12px 28px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.9rem;
            border: none;
            transition: all 0.25s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-purple:hover {
            background: var(--dark-purple);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(111,66,193,0.3);
        }

        .btn-outline-purple {
            border: 1.5px solid var(--primary-purple);
            color: var(--primary-purple);
            padding: 11px 28px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.25s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-outline-purple:hover {
            background: var(--primary-purple);
            color: white;
            transform: translateY(-2px);
        }

        /* ══════════════════════════════
           CONTAINER DO CUBO 3D
        ══════════════════════════════ */
        #canvas-container {
            width: 350px;
            height: 350px;
            margin: 0 auto;
            border-radius: 50%;
            overflow: hidden;
            position: relative;
            background: linear-gradient(135deg, #f0ebff, #e8f4ff);
            box-shadow: 0 20px 60px rgba(111,66,193,0.15);
            border: 2px solid rgba(111,66,193,0.1);
            cursor: grab;
            user-select: none;
        }

        #canvas-container:active {
            cursor: grabbing;
        }

        #canvas-container canvas {
            display: block;
            width: 100% !important;
            height: 100% !important;
            pointer-events: auto;
        }

        /* Anel decorativo */
        #canvas-container::before {
            content: '';
            position: absolute;
            inset: -14px;
            border-radius: 50%;
            border: 1px dashed rgba(111,66,193,0.2);
            pointer-events: none;
            z-index: 1;
        }

        #canvas-container::after {
            content: '';
            position: absolute;
            inset: -28px;
            border-radius: 50%;
            border: 1px solid rgba(111,66,193,0.06);
            pointer-events: none;
            z-index: 0;
        }

        /* ══════════════════════════════
           SEARCH SECTION
        ══════════════════════════════ */
        .search-section {
            background: white;
            border-radius: 20px;
            padding: 28px 32px;
            border: 1px solid #ebebf0;
            box-shadow: none !important;
        }

        .search-section h5 {
            font-size: 0.78rem !important;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #aaa;
            margin-bottom: 16px !important;
        }

        .search-section h5 i { color: var(--primary-purple) !important; }

        .search-tags { display: flex; flex-wrap: wrap; gap: 8px; }

        .search-tag {
            background: var(--bg-page);
            color: #555;
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 0.82rem;
            font-weight: 600;
            transition: all 0.2s;
            border: 1px solid #e8e8f0;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin: 0;
        }

        .search-tag:hover {
            background: var(--soft-purple);
            color: var(--primary-purple);
            border-color: rgba(111,66,193,0.2);
            transform: translateY(-1px);
        }

        /* ══════════════════════════════
           CARDS
        ══════════════════════════════ */
        .card-clean {
            background: white;
            border: 1px solid #ebebf0;
            border-radius: 20px;
            padding: 28px;
            box-shadow: none;
            transition: all 0.3s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .card-clean::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 4px; height: 100%;
            background: var(--primary-purple);
            border-radius: 4px 0 0 4px;
            opacity: 0;
            transition: opacity 0.25s;
        }

        .card-clean:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 40px rgba(111,66,193,0.1);
            border-color: rgba(111,66,193,0.2);
        }

        .card-clean:hover::before { opacity: 1; }

        .card-icon {
            width: 52px; height: 52px;
            background: var(--soft-purple);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 18px;
        }

        .card-clean h3 {
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--dark-purple);
            margin-bottom: 8px;
        }

        .card-clean .text-muted {
            font-size: 0.85rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        /* ══════════════════════════════
           BANNER CTA
        ══════════════════════════════ */
        .installment-banner {
            background: linear-gradient(135deg, var(--dark-purple) 0%, #4a2a9a 60%, var(--primary-purple) 100%);
            color: white;
            border-radius: 20px;
            padding: 48px 52px;
            position: relative;
            overflow: hidden;
            box-shadow: none !important;
        }

        .installment-banner::before {
            content: '';
            position: absolute;
            width: 350px; height: 350px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            top: -100px; right: -60px;
            pointer-events: none;
        }

        .installment-banner .display-5 {
            font-size: 1.8rem !important;
            font-weight: 800 !important;
            position: relative; z-index: 1;
        }

        .installment-banner p {
            color: rgba(255,255,255,0.65) !important;
            font-size: 0.95rem !important;
            position: relative; z-index: 1;
        }

        .installment-banner .btn-light {
            background: white !important;
            color: var(--primary-purple) !important;
            border: none;
            padding: 14px 32px !important;
            border-radius: 14px !important;
            font-weight: 800 !important;
            font-size: 0.9rem;
            transition: all 0.25s;
            position: relative; z-index: 1;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .installment-banner .btn-light:hover {
            background: var(--soft-purple) !important;
            color: var(--dark-purple) !important;
            transform: translateY(-2px);
        }

        /* ══════════════════════════════
           FOOTER
        ══════════════════════════════ */
        footer.bg-white {
            background: white !important;
            border-top: 1px solid #ebebf0 !important;
            padding: 20px 0 !important;
            margin-top: 48px;
        }

        footer .text-muted { font-size: 0.8rem; color: #bbb !important; }
        footer a.text-muted { font-size: 0.8rem; color: #bbb !important; text-decoration: none; transition: color 0.2s; }
        footer a.text-muted:hover { color: var(--primary-purple) !important; }

        /* ══════════════════════════════
           RESPONSIVO
        ══════════════════════════════ */
        @media (max-width: 768px) {
            .hero-title { font-size: 2.2rem; }
            .installment-banner { padding: 32px 24px; }
            .search-section { padding: 20px; }
            #canvas-container {
                width: 250px;
                height: 250px;
            }
        }

        @media (max-width: 576px) {
            #canvas-container {
                width: 200px;
                height: 200px;
            }
        }

        /* Tooltip para as faces */
        .face-tooltip {
            position: fixed;
            background: rgba(45, 27, 78, 0.9);
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            pointer-events: none;
            z-index: 9999;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
            display: none;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body>

<!-- Tooltip para as faces -->
<div class="face-tooltip" id="faceTooltip"></div>

<nav class="navbar-custom">
    <!-- Primeira Linha - Logo e Usuário -->
    <div class="navbar-top">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a class="navbar-brand" href="/inicio">
                    <div class="brand-icon">
                        <i class="fa-solid fa-mobile-screen-button" style="color:white; font-size:0.9rem;"></i>
                    </div>
                    SAMSUNG ADMIN
                </a>
                <div class="d-flex align-items-center gap-3">
                    <span class="user-info" id="userEmail">
                        <i class="fa-regular fa-circle-user"></i>
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
                 <a href="/vitrine" class="nav-item-custom">
                    <i class="fa-solid fa-store"></i>
                    Ver Produtos
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
                <div class="d-flex gap-3 flex-wrap">
                    <a href="/index" class="btn-purple">
                        <i class="fa-solid fa-plus me-2"></i>Novo Produto
                    </a>
                    <a href="#" class="btn-outline-purple">
                        <i class="fa-solid fa-chart-simple me-2"></i>Relatórios
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center d-none d-lg-block">
                <!-- CONTAINER DO CUBO 3D COM IMAGENS -->
                <div id="canvas-container"></div>
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
                <a href="#" class="btn-outline-purple w-100 text-center justify-content-center">Abrir Painel</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-clean">
                <div class="card-icon">
                    <i class="fa-solid fa-microchip fs-3" style="color: var(--primary-purple);"></i>
                </div>
                <h3 class="fw-bold">Suporte Técnico</h3>
                <p class="text-muted">Acesse documentação técnica e atualizações de firmware.</p>
                <a href="#" class="btn-outline-purple w-100 text-center justify-content-center">Ver Docs</a>
            </div>
        </div>
    </div>

    <div class="installment-banner my-5 shadow-lg">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2 class="display-5 fw-bold mb-3">Expanda o Inventário</h2>
                <p class="opacity-75 fs-5">Adicione novos modelos à base de dados global e sincronize com as lojas em segundos.</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
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

<!-- ════════════════════════════════════════════════
     THREE.JS VIA CDN
     ════════════════════════════════════════════════ -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

<script>
// ════════════════════════════════════════════════
// CUBO 3D COM CLIQUE NAS FACES
// ════════════════════════════════════════════════

document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('canvas-container');
    const tooltip = document.getElementById('faceTooltip');
    
    if (!container) {
        console.error('Container não encontrado!');
        return;
    }

    const width = container.clientWidth;
    const height = container.clientHeight;

    // 1. CENA
    const scene = new THREE.Scene();
    scene.background = new THREE.Color(0xf0ebff);

    // 2. CÂMERA
    const camera = new THREE.PerspectiveCamera(50, width / height, 0.1, 1000);
    camera.position.set(2.5, 1.5, 4.5);
    camera.lookAt(0, 0, 0);

    // 3. RENDERIZADOR
    const renderer = new THREE.WebGLRenderer({ 
        antialias: true,
        alpha: false 
    });
    renderer.setSize(width, height);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    renderer.shadowMap.enabled = true;
    container.appendChild(renderer.domElement);

    // ════════════════════════════════════════════════
    // 4. IMAGENS PARA CADA FACE DO CUBO (SEM BRILHO)
    // ════════════════════════════════════════════════
    
    const imagens = [
        '/images/cubo/Bunny.jpg',
        '/images/cubo/Hugo.jpg',
        '/images/cubo/Kaiser.jpg',
        '/images/cubo/Loki.jpg',
        '/images/cubo/Lorenzo.jpg',
        '/images/cubo/Sae.jpg'
    ];

    // Nomes para exibir no tooltip
    const nomesFaces = [
        'Bunny',
        'Hugo',
        'Kaiser',
        'Loki',
        'Lorenzo',
        'Sae'
    ];

    // URLs para redirecionamento
    const urlsFaces = [
        '/BL/bunny',
        '/BL/hugo',
        '/BL/kaiser',
        '/BL/loki',
        '/BL/lorenzo',
        '/BL/sae'
    ];

    function carregarTextura(url) {
        const loader = new THREE.TextureLoader();
        // Configura a textura para não ter bordas estranhas
        const texture = loader.load(url);
        texture.minFilter = THREE.LinearFilter;
        texture.magFilter = THREE.LinearFilter;
        texture.wrapS = THREE.ClampToEdgeWrapping;
        texture.wrapT = THREE.ClampToEdgeWrapping;
        return texture;
    }

    // ════════════════════════════════════════════════
    // MATERIAIS SEM BRILHO (roughness alto, metalness 0)
    // ════════════════════════════════════════════════
    const materials = imagens.map((url, index) => 
        new THREE.MeshStandardMaterial({
            map: carregarTextura(url),
            roughness: 0.9,      // Alto = sem brilho
            metalness: 0.0,      // Zero = sem efeito metálico
            emissive: null,      // Sem emissividade
            emissiveIntensity: 0,
            side: THREE.DoubleSide,
            flatShading: false
        })
    );

    // 5. CRIA O CUBO
    const geometry = new THREE.BoxGeometry(1.8, 1.8, 1.8);
    const cube = new THREE.Mesh(geometry, materials);
    cube.castShadow = true;
    cube.receiveShadow = true;
    scene.add(cube);

    // 6. LUZES (mais suaves para não criar brilho)
    const ambientLight = new THREE.AmbientLight(0x404060, 0.8);
    scene.add(ambientLight);

    const mainLight = new THREE.DirectionalLight(0xffffff, 1.2);
    mainLight.position.set(5, 5, 5);
    mainLight.castShadow = true;
    scene.add(mainLight);

    const fillLight = new THREE.DirectionalLight(0x8888ff, 0.5);
    fillLight.position.set(-5, 0, 5);
    scene.add(fillLight);

    // ════════════════════════════════════════════════
    // 7. RAYCASTER PARA DETECTAR CLIQUE NAS FACES
    // ════════════════════════════════════════════════
    const raycaster = new THREE.Raycaster();
    const mouse = new THREE.Vector2();

    // Função para obter a face clicada
    function getFaceIntersection(event) {
        const rect = renderer.domElement.getBoundingClientRect();
        mouse.x = ((event.clientX - rect.left) / rect.width) * 2 - 1;
        mouse.y = -((event.clientY - rect.top) / rect.height) * 2 + 1;

        raycaster.setFromCamera(mouse, camera);
        const intersects = raycaster.intersectObject(cube);

        if (intersects.length > 0) {
            const intersect = intersects[0];
            const faceIndex = intersect.face.materialIndex;
            return faceIndex;
        }
        return null;
    }

    // Evento de clique no canvas
    renderer.domElement.addEventListener('click', function(event) {
        const faceIndex = getFaceIntersection(event);
        
        if (faceIndex !== null && faceIndex < urlsFaces.length) {
            // Efeito visual de clique (opcional)
            const originalColor = materials[faceIndex].color ? materials[faceIndex].color.getHex() : null;
            
            // Mostra um feedback visual (pisca a face)
            const originalEmissive = materials[faceIndex].emissive ? materials[faceIndex].emissive.getHex() : null;
            materials[faceIndex].emissive = new THREE.Color(0x6f42c1);
            materials[faceIndex].emissiveIntensity = 0.3;
            
            setTimeout(() => {
                materials[faceIndex].emissive = new THREE.Color(0x000000);
                materials[faceIndex].emissiveIntensity = 0;
            }, 300);
            
            // Redireciona para a página
            const url = urlsFaces[faceIndex];
            console.log(`🔗 Redirecionando para: ${url}`);
            
            // Usa SweetAlert para confirmar antes de redirecionar
            Swal.fire({
                title: `Ir para ${nomesFaces[faceIndex]}?`,
                text: `Você será redirecionado para a página de ${nomesFaces[faceIndex]}.`,
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#6f42c1',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Ir agora',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
    });

    // ════════════════════════════════════════════════
    // 8. TOOLTIP AO PASSAR O MOUSE NAS FACES
    // ════════════════════════════════════════════════
    renderer.domElement.addEventListener('mousemove', function(event) {
        const faceIndex = getFaceIntersection(event);
        
        if (faceIndex !== null && faceIndex < nomesFaces.length) {
            tooltip.textContent = `Clique para ir para ${nomesFaces[faceIndex]}`;
            tooltip.style.display = 'block';
            tooltip.style.left = (event.clientX + 15) + 'px';
            tooltip.style.top = (event.clientY - 10) + 'px';
            renderer.domElement.style.cursor = 'pointer';
        } else {
            tooltip.style.display = 'none';
            renderer.domElement.style.cursor = 'grab';
        }
    });

    renderer.domElement.addEventListener('mouseleave', function() {
        tooltip.style.display = 'none';
    });

    // ════════════════════════════════════════════════
    // 9. CONTROLE DE ROTAÇÃO POR MOUSE (DRAG)
    // ════════════════════════════════════════════════
    
    let isDragging = false;
    let previousMousePosition = { x: 0, y: 0 };
    let rotationX = 0;
    let rotationY = 0;
    const rotationSpeed = 0.8;
    let velocityX = 0;
    let velocityY = 0;

    container.addEventListener('mousedown', (event) => {
        isDragging = true;
        previousMousePosition.x = event.clientX;
        previousMousePosition.y = event.clientY;
        container.style.cursor = 'grabbing';
        tooltip.style.display = 'none';
    });

    window.addEventListener('mousemove', (event) => {
        if (!isDragging) return;
        
        const deltaX = event.clientX - previousMousePosition.x;
        const deltaY = event.clientY - previousMousePosition.y;
        
        velocityX = deltaY * 0.01 * rotationSpeed * 0.9;
        velocityY = deltaX * 0.01 * rotationSpeed * 0.9;
        
        rotationY += deltaX * 0.01 * rotationSpeed;
        rotationX += deltaY * 0.01 * rotationSpeed;
        
        cube.rotation.x = rotationX;
        cube.rotation.y = rotationY;
        
        previousMousePosition.x = event.clientX;
        previousMousePosition.y = event.clientY;
    });

    window.addEventListener('mouseup', () => {
        if (isDragging) {
            isDragging = false;
            container.style.cursor = 'grab';
        }
    });

    // ════════════════════════════════════════════════
    // 10. LOOP DE ANIMAÇÃO
    // ════════════════════════════════════════════════
    
    let time = 0;

    function animate() {
        requestAnimationFrame(animate);
        
        time += 0.01;
        
        // Inércia
        if (!isDragging) {
            if (Math.abs(velocityX) > 0.0001 || Math.abs(velocityY) > 0.0001) {
                rotationX += velocityX;
                rotationY += velocityY;
                velocityX *= 0.97;
                velocityY *= 0.97;
                cube.rotation.x = rotationX;
                cube.rotation.y = rotationY;
            }
        }
        
        // Flutuação
        cube.position.y = Math.sin(time * 0.6) * 0.1;
        
        renderer.render(scene, camera);
    }
    
    animate();

    // 11. RESPONSIVO
    function resizeRenderer() {
        const newWidth = container.clientWidth;
        const newHeight = container.clientHeight;
        
        if (newWidth > 0 && newHeight > 0) {
            camera.aspect = newWidth / newHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(newWidth, newHeight);
        }
    }

    window.addEventListener('resize', resizeRenderer);

    const resizeObserver = new ResizeObserver(() => resizeRenderer());
    resizeObserver.observe(container);

    console.log('🚀 Cubo 3D com clique nas faces carregado!');
    console.log('📐 Dimensões:', width, 'x', height);
    console.log('🖱️ Clique em cada face para navegar!');
});

// ════════════════════════════════════════════════
// SCRIPT DO LOGIN/LOGOUT
// ════════════════════════════════════════════════
$(document).ready(function() {
    let token = $.cookie('token');
    
    if (!token) {
        window.location.href = '/login';
        return;
    }

    let userEmail = localStorage.getItem('userEmail') || 'Admin';
    $('#userEmailText').text(userEmail);

    function updateTime() {
        let now = new Date();
        let timeStr = now.toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });
        $('#currentTime').text(timeStr);
    }
    updateTime();
    setInterval(updateTime, 1000);

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