<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samsung - Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>

    <style>
        :root {
            --primary-purple: #6f42c1;
            --soft-purple: #f3f0ff;
            --dark-purple: #2d1b4e;
            --accent-blue: #007aff;
            --bg-page: #f5f4fa;
            --sidebar-w: 240px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-page);
            color: #1d1d1f;
            min-height: 100vh;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: linear-gradient(175deg, #2d1b4e 0%, #1a0533 100%);
            display: flex;
            flex-direction: column;
            padding: 28px 18px;
            z-index: 100;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 8px 28px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 24px;
        }

        .sidebar-brand .icon-box {
            width: 40px; height: 40px;
            background: var(--primary-purple);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
        }

        .sidebar-brand span {
            font-weight: 800;
            font-size: 1rem;
            color: white;
            letter-spacing: 1px;
        }

        .nav-label {
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255,255,255,0.35);
            padding: 0 10px;
            margin-bottom: 8px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: 12px;
            color: rgba(255,255,255,0.65);
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 4px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .nav-item:hover, .nav-item.active {
            background: rgba(255,255,255,0.1);
            color: white;
        }

        .nav-item.active {
            background: var(--primary-purple);
            color: white;
        }

        .nav-item i { width: 18px; text-align: center; font-size: 0.9rem; }

        .sidebar-footer {
            margin-top: auto;
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 16px;
        }

        .admin-chip {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            background: rgba(255,255,255,0.07);
            border-radius: 12px;
        }

        .admin-avatar {
            width: 34px; height: 34px;
            background: var(--primary-purple);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.85rem;
            font-weight: 700;
            color: white;
        }

        .admin-info span { display: block; }
        .admin-info .name { font-size: 0.82rem; font-weight: 700; color: white; }
        .admin-info .role { font-size: 0.72rem; color: rgba(255,255,255,0.45); }

        /* ── MAIN ── */
        .main {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── TOPBAR ── */
        .topbar {
            background: white;
            border-bottom: 1px solid #ebebf0;
            padding: 16px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .topbar h1 {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--dark-purple);
        }

        .topbar .meta {
            font-size: 0.82rem;
            color: #999;
            margin-top: 2px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .status-dot {
            width: 8px; height: 8px;
            background: #2ecc71;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%   { box-shadow: 0 0 0 0 rgba(46,204,113,0.6); }
            70%  { box-shadow: 0 0 0 8px rgba(46,204,113,0); }
            100% { box-shadow: 0 0 0 0 rgba(46,204,113,0); }
        }

        .status-text {
            font-size: 0.8rem;
            font-weight: 600;
            color: #2ecc71;
        }

        .btn-logout {
            background: #fff0f0;
            color: #dc3545;
            border: 1px solid #ffd0d0;
            border-radius: 10px;
            padding: 7px 16px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-logout:hover {
            background: #dc3545;
            color: white;
        }

        /* ── CONTENT ── */
        .content {
            padding: 32px;
            flex: 1;
        }

        /* ── METRIC CARDS ── */
        .metric-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .metric-card {
            background: white;
            border-radius: 20px;
            padding: 24px;
            border: 1px solid #ebebf0;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .metric-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 4px;
            height: 100%;
            border-radius: 4px 0 0 4px;
        }

        .metric-card.purple::before { background: var(--primary-purple); }
        .metric-card.blue::before   { background: var(--accent-blue); }
        .metric-card.green::before  { background: #2ecc71; }
        .metric-card.orange::before { background: #f39c12; }

        .metric-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.07);
        }

        .metric-icon {
            width: 44px; height: 44px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 16px;
            font-size: 1.1rem;
        }

        .metric-card.purple .metric-icon { background: var(--soft-purple); color: var(--primary-purple); }
        .metric-card.blue   .metric-icon { background: #e8f4ff; color: var(--accent-blue); }
        .metric-card.green  .metric-icon { background: #eafaf1; color: #27ae60; }
        .metric-card.orange .metric-icon { background: #fef9e7; color: #e67e22; }

        .metric-label {
            font-size: 0.78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #999;
            margin-bottom: 6px;
        }

        .metric-value {
            font-size: 2rem;
            font-weight: 800;
            color: var(--dark-purple);
            line-height: 1;
        }

        .metric-sub {
            font-size: 0.78rem;
            color: #bbb;
            margin-top: 6px;
        }

        /* ── CHARTS ── */
        .charts-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 32px;
        }

        .chart-card {
            background: white;
            border-radius: 20px;
            padding: 24px;
            border: 1px solid #ebebf0;
        }

        .chart-card.full { grid-column: 1 / -1; }

        .chart-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 1rem;
            font-weight: 800;
            color: var(--dark-purple);
        }

        .chart-subtitle {
            font-size: 0.78rem;
            color: #aaa;
            margin-top: 2px;
        }

        .chart-badge {
            background: var(--soft-purple);
            color: var(--primary-purple);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        /* ── TABELA ── */
        .table-card {
            background: white;
            border-radius: 20px;
            padding: 24px;
            border: 1px solid #ebebf0;
            margin-bottom: 32px;
        }

        .table-admin {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.88rem;
        }

        .table-admin thead th {
            text-align: left;
            padding: 10px 14px;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #aaa;
            border-bottom: 1px solid #f0f0f5;
        }

        .table-admin tbody tr {
            border-bottom: 1px solid #f9f9fb;
            transition: background 0.15s;
        }

        .table-admin tbody tr:hover { background: #fafafc; }

        .table-admin tbody td {
            padding: 12px 14px;
            color: #333;
        }

        .tag {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .tag-purple { background: var(--soft-purple); color: var(--primary-purple); }
        .tag-blue   { background: #e8f4ff; color: var(--accent-blue); }

        /* ── LOADING ── */
        .loading-overlay {
            position: fixed;
            inset: 0;
            background: rgba(255,255,255,0.85);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            gap: 16px;
        }

        .spinner {
            width: 48px; height: 48px;
            border: 4px solid #f0f0f0;
            border-top-color: var(--primary-purple);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        .loading-text {
            font-size: 0.9rem;
            font-weight: 600;
            color: #888;
        }

        /* ── RESPONSIVO ── */
        @media (max-width: 900px) {
            .sidebar { display: none; }
            .main { margin-left: 0; }
            .charts-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<!-- Loading -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="spinner"></div>
    <div class="loading-text">Carregando dados...</div>
</div>

<!-- ── SIDEBAR ── -->
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="icon-box">
            <i class="fa-solid fa-mobile-screen-button" style="color:white; font-size:1rem;"></i>
        </div>
        <span>SAMSUNG</span>
    </div>

    <div class="nav-label">Painel</div>
    <a class="nav-item active" href="#">
        <i class="fa-solid fa-chart-pie"></i> Dashboard
    </a>
    <a class="nav-item" href="/inicio">
        <i class="fa-solid fa-house"></i> Início
    </a>

    <div class="nav-label mt-3">Dados</div>
    <a class="nav-item" href="/index">
        <i class="fa-solid fa-mobile-screen"></i> Aparelhos
    </a>
    <a class="nav-item" href="#">
        <i class="fa-solid fa-users"></i> Usuários
    </a>

    <div class="sidebar-footer">
        <div class="admin-chip">
            <div class="admin-avatar">AD</div>
            <div class="admin-info">
                <span class="name">Admin</span>
                <span class="role">Administrador</span>
            </div>
        </div>
    </div>
</aside>

<!-- ── MAIN ── -->
<div class="main">

    <!-- Topbar -->
    <div class="topbar">
        <div>
            <h1><i class="fa-solid fa-chart-pie me-2" style="color:var(--primary-purple);"></i>Dashboard Admin</h1>
            <div class="meta" id="dataAtual"></div>
        </div>
        <div class="topbar-right">
            <div class="status-dot"></div>
            <span class="status-text">Sistema Online</span>
            <button class="btn-logout" id="btnLogout">
                <i class="fa-solid fa-arrow-right-from-bracket me-1"></i>Sair
            </button>
        </div>
    </div>

    <!-- Content -->
    <div class="content">

        <!-- Métricas -->
        <div class="metric-grid">
            <div class="metric-card purple">
                <div class="metric-icon"><i class="fa-solid fa-mobile-screen-button"></i></div>
                <div class="metric-label">Total de Aparelhos</div>
                <div class="metric-value" id="totalAparelhos">—</div>
                <div class="metric-sub">cadastrados no sistema</div>
            </div>
            <div class="metric-card blue">
                <div class="metric-icon"><i class="fa-solid fa-users"></i></div>
                <div class="metric-label">Total de Contas</div>
                <div class="metric-value" id="totalContas">—</div>
                <div class="metric-sub">usuários registrados</div>
            </div>
            <div class="metric-card green">
                <div class="metric-icon"><i class="fa-solid fa-palette"></i></div>
                <div class="metric-label">Cores Distintas</div>
                <div class="metric-value" id="totalCores">—</div>
                <div class="metric-sub">variações de cor</div>
            </div>
            <div class="metric-card orange">
                <div class="metric-icon"><i class="fa-solid fa-calendar-days"></i></div>
                <div class="metric-label">Anos Distintos</div>
                <div class="metric-value" id="totalAnos">—</div>
                <div class="metric-sub">períodos cadastrados</div>
            </div>
        </div>

        <!-- Gráficos -->
        <div class="charts-grid">

            <!-- Aparelhos por Modelo -->
            <div class="chart-card">
                <div class="chart-header">
                    <div>
                        <div class="chart-title">Aparelhos por Modelo</div>
                        <div class="chart-subtitle">distribuição por linha de produto</div>
                    </div>
                    <span class="chart-badge">Bar</span>
                </div>
                <div style="position:relative; height:280px;">
                    <canvas id="chartModelo"></canvas>
                </div>
            </div>

            <!-- Aparelhos por Cor -->
            <div class="chart-card">
                <div class="chart-header">
                    <div>
                        <div class="chart-title">Aparelhos por Cor</div>
                        <div class="chart-subtitle">variações de cor cadastradas</div>
                    </div>
                    <span class="chart-badge">Doughnut</span>
                </div>
                <div style="position:relative; height:280px;">
                    <canvas id="chartCor"></canvas>
                </div>
            </div>

            <!-- Aparelhos por Ano (full width) -->
            <div class="chart-card full">
                <div class="chart-header">
                    <div>
                        <div class="chart-title">Aparelhos por Ano de Lançamento</div>
                        <div class="chart-subtitle">evolução histórica do catálogo</div>
                    </div>
                    <span class="chart-badge">Line</span>
                </div>
                <div style="position:relative; height:240px;">
                    <canvas id="chartAno"></canvas>
                </div>
            </div>
        </div>

        <!-- Tabela de últimos aparelhos -->
        <div class="table-card">
            <div class="chart-header">
                <div>
                    <div class="chart-title">Últimos Aparelhos Cadastrados</div>
                    <div class="chart-subtitle">registros mais recentes no sistema</div>
                </div>
                <a href="/index" style="font-size:0.8rem; color:var(--primary-purple); font-weight:700; text-decoration:none;">
                    Ver todos <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
            <table class="table-admin">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Aparelho</th>
                        <th>Modelo</th>
                        <th>Cor</th>
                        <th>Ano</th>
                    </tr>
                </thead>
                <tbody id="tabelaAparelhos">
                    <tr><td colspan="5" style="text-align:center; color:#ccc; padding:20px;">Carregando...</td></tr>
                </tbody>
            </table>
        </div>

        <!-- Tabela de usuários -->
        <div class="table-card">
            <div class="chart-header">
                <div>
                    <div class="chart-title">Contas Cadastradas</div>
                    <div class="chart-subtitle">usuários registrados no sistema</div>
                </div>
            </div>
            <table class="table-admin">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Gênero</th>
                        <th>Telefone</th>
                    </tr>
                </thead>
                <tbody id="tabelaUsuarios">
                    <tr><td colspan="5" style="text-align:center; color:#ccc; padding:20px;">Carregando...</td></tr>
                </tbody>
            </table>
        </div>

    </div><!-- /content -->
</div><!-- /main -->

<script>
$(document).ready(function () {

    // ── VERIFICAR SE ESTÁ LOGADO COMO ADMIN ──
    if (sessionStorage.getItem('admin_logado') !== 'true') {
        window.location.href = '/login_admin';
        return;
    }

    // ── DATA ATUAL ──
    const agora = new Date();
    $('#dataAtual').text(agora.toLocaleDateString('pt-BR', {
        weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
    }));

    // ── LOGOUT ──
    $('#btnLogout').click(function () {
        Swal.fire({
            title: 'Deseja sair?',
            text: 'Você será desconectado do painel admin.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#6f42c1',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Sim, sair',
            cancelButtonText: 'Cancelar'
        }).then(result => {
            if (result.isConfirmed) {
                sessionStorage.removeItem('admin_logado');
                window.location.href = '/login_admin';
            }
        });
    });

    // ── INSTÂNCIAS DOS GRÁFICOS ──
    let chartModelo, chartCor, chartAno;

    const COLORS = [
        '#6f42c1','#007aff','#2ecc71','#f39c12',
        '#e74c3c','#1abc9c','#9b59b6','#3498db',
        '#e67e22','#34495e','#e91e63','#00bcd4'
    ];

    // ── CARREGAR DADOS ──
    function carregarDados() {

        // ── 1. APARELHOS ──
        $.ajax({
            url: '/api/todos_samsung',
            method: 'GET',
            success: function (res) {
                if (res.erro !== 'n') return;

                const lista = res.samsung || [];

                // Métricas
                $('#totalAparelhos').text(lista.length);

                // Cores distintas
                const cores  = [...new Set(lista.map(i => i.cor).filter(Boolean))];
                const anos   = [...new Set(lista.map(i => i.ano).filter(Boolean))].sort();
                const modelos = [...new Set(lista.map(i => i.modelo).filter(Boolean))];

                $('#totalCores').text(cores.length);
                $('#totalAnos').text(anos.length);

                // ── Gráfico: Aparelhos por Modelo ──
                const contagemModelo = {};
                lista.forEach(i => { contagemModelo[i.modelo] = (contagemModelo[i.modelo] || 0) + 1; });

                if (chartModelo) chartModelo.destroy();
                chartModelo = new Chart(document.getElementById('chartModelo'), {
                    type: 'bar',
                    data: {
                        labels: Object.keys(contagemModelo),
                        datasets: [{
                            label: 'Quantidade',
                            data: Object.values(contagemModelo),
                            backgroundColor: COLORS.slice(0, Object.keys(contagemModelo).length),
                            borderRadius: 8,
                            borderSkipped: false
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f0f0f5' } },
                            x: { grid: { display: false }, ticks: { autoSkip: false, maxRotation: 30 } }
                        }
                    }
                });

                // ── Gráfico: Aparelhos por Cor ──
                const contagemCor = {};
                lista.forEach(i => { contagemCor[i.cor] = (contagemCor[i.cor] || 0) + 1; });

                if (chartCor) chartCor.destroy();
                chartCor = new Chart(document.getElementById('chartCor'), {
                    type: 'doughnut',
                    data: {
                        labels: Object.keys(contagemCor),
                        datasets: [{
                            data: Object.values(contagemCor),
                            backgroundColor: COLORS.slice(0, Object.keys(contagemCor).length),
                            borderWidth: 3,
                            borderColor: '#fff'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'right', labels: { boxWidth: 12, padding: 16, font: { size: 12 } } }
                        }
                    }
                });

                // ── Gráfico: Aparelhos por Ano ──
                const contagemAno = {};
                lista.forEach(i => { contagemAno[i.ano] = (contagemAno[i.ano] || 0) + 1; });
                const anosOrdenados = Object.keys(contagemAno).sort();

                if (chartAno) chartAno.destroy();
                chartAno = new Chart(document.getElementById('chartAno'), {
                    type: 'line',
                    data: {
                        labels: anosOrdenados,
                        datasets: [{
                            label: 'Aparelhos',
                            data: anosOrdenados.map(a => contagemAno[a]),
                            borderColor: '#6f42c1',
                            backgroundColor: 'rgba(111,66,193,0.08)',
                            borderWidth: 2.5,
                            pointBackgroundColor: '#6f42c1',
                            pointRadius: 5,
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f0f0f5' } },
                            x: { grid: { display: false } }
                        }
                    }
                });

                // ── Tabela de aparelhos (últimos 8) ──
                const ultimos = lista.slice(-8).reverse();
                let html = '';
                if (ultimos.length === 0) {
                    html = '<tr><td colspan="5" style="text-align:center;color:#ccc;padding:20px;">Nenhum aparelho cadastrado.</td></tr>';
                } else {
                    ultimos.forEach(ap => {
                        html += `
                        <tr>
                            <td style="color:#bbb;">#${ap.id}</td>
                            <td><strong>${ap.aparelho || '—'}</strong></td>
                            <td><span class="tag tag-purple">${ap.modelo || '—'}</span></td>
                            <td>${ap.cor || '—'}</td>
                            <td><span class="tag tag-blue">${ap.ano || '—'}</span></td>
                        </tr>`;
                    });
                }
                $('#tabelaAparelhos').html(html);
            },
            error: function () {
                $('#totalAparelhos').text('Erro');
            }
        });

        // ── 2. USUÁRIOS ──
        // Para acessar todos_cadastros é necessário token válido.
        // Aqui usamos o token salvo em cookie (se existir) ou tentamos sem token
        // já que o admin pode não ter token da API regular.
        const tokenApi = document.cookie.split(';').find(c => c.trim().startsWith('token='));
        const tokenVal = tokenApi ? tokenApi.split('=')[1] : null;

        $.ajax({
            url: '/api/todos_cadastros' + (tokenVal ? '?token=' + tokenVal : ''),
            method: 'GET',
            success: function (res) {
                if (res.erro !== 'n') {
                    $('#totalContas').text('—');
                    $('#tabelaUsuarios').html(
                        '<tr><td colspan="5" style="text-align:center;color:#f39c12;padding:20px;">' +
                        '<i class="fa-solid fa-triangle-exclamation me-1"></i>' +
                        'Token de API necessário para listar usuários.</td></tr>'
                    );
                    return;
                }

                const lista = res.usuarios || [];
                $('#totalContas').text(lista.length);

                let html = '';
                if (lista.length === 0) {
                    html = '<tr><td colspan="5" style="text-align:center;color:#ccc;padding:20px;">Nenhum usuário cadastrado.</td></tr>';
                } else {
                    lista.forEach(u => {
                        html += `
                        <tr>
                            <td style="color:#bbb;">#${u.id}</td>
                            <td><strong>${u.nome || '—'}</strong></td>
                            <td style="color:#666;">${u.email || '—'}</td>
                            <td><span class="tag tag-purple">${u.genero || '—'}</span></td>
                            <td>${u.telefone || '—'}</td>
                        </tr>`;
                    });
                }
                $('#tabelaUsuarios').html(html);
            },
            error: function () {
                $('#totalContas').text('Erro');
                $('#tabelaUsuarios').html(
                    '<tr><td colspan="5" style="text-align:center;color:#e74c3c;padding:20px;">Erro ao carregar usuários.</td></tr>'
                );
            }
        });
    }

    // Carregar dados e esconder loading
    carregarDados();

    setTimeout(function () {
        $('#loadingOverlay').fadeOut(400);
    }, 800);

});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>