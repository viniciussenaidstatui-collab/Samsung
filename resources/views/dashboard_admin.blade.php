{{-- resources/views/dashboard_admin.blade.php --}}
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samsung - Dashboard Admin</title>
    
    <!-- Bootstrap + Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/dashboard.css">

</head>
<body>

<div class="loading-overlay" id="loadingOverlay">
    <div class="spinner"></div>
    <div class="loading-text">Carregando dados...</div>
</div>

<!-- Sidebar -->
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="icon-box">
            <i class="fa-solid fa-mobile-screen-button" style="color:white;"></i>
        </div>
        <span>SAMSUNG</span>
    </div>
    <div class="nav-label">Painel</div>
    <a class="nav-item active" href="#">
        <i class="fa-solid fa-chart-pie"></i> Dashboard
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

<!-- Main -->
<div class="main">
    <div class="topbar">
        <div>
            <h1><i class="fa-solid fa-chart-pie me-2" style="color:var(--primary-purple);"></i>Dashboard Admin</h1>
            <div class="meta" id="dataAtual"></div>
        </div>
        <div class="topbar-right">
            <div class="status-dot"></div>
            <span class="status-text">Sistema Online</span>
            <button class="btn-export" id="btnExport">
                <i class="fa-solid fa-file-arrow-down"></i> Obter dados
            </button>
            <button class="btn-logout" id="btnLogout">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Sair
            </button>
        </div>
    </div>
    
    <div class="content" id="printArea">
        <div class="print-header">
            <div class="ph-brand">
                <div class="ph-logo">SAM</div>
                <div>
                    <h2>Samsung — Relatório do Dashboard</h2>
                </div>
            </div>
            <div class="ph-meta">
                <div id="printData"></div>
            </div>
        </div>
        
        <!-- Cards -->
        <div class="metric-grid">
            <div class="metric-card purple">
                <div class="metric-icon"><i class="fa-solid fa-mobile-screen-button"></i></div>
                <div class="metric-label">Total de Aparelhos</div>
                <div class="metric-value" id="totalAparelhos">—</div>
            </div>
            <div class="metric-card blue">
                <div class="metric-icon"><i class="fa-solid fa-users"></i></div>
                <div class="metric-label">Total de Contas</div>
                <div class="metric-value" id="totalContas">—</div>
            </div>
            <div class="metric-card green">
                <div class="metric-icon"><i class="fa-solid fa-palette"></i></div>
                <div class="metric-label">Cores Distintas</div>
                <div class="metric-value" id="totalCores">—</div>
            </div>
            <div class="metric-card orange">
                <div class="metric-icon"><i class="fa-solid fa-calendar-days"></i></div>
                <div class="metric-label">Anos Distintos</div>
                <div class="metric-value" id="totalAnos">—</div>
            </div>
        </div>
        
        <!-- Gráficos -->
        <div class="charts-grid">
            <div class="chart-card">
                <div class="chart-header">
                    <div class="chart-title">Aparelhos por Modelo</div>
                </div>
                <div style="height:280px;">
                    <canvas id="chartModelo"></canvas>
                </div>
            </div>
            <div class="chart-card">
                <div class="chart-header">
                    <div class="chart-title">Aparelhos por Cor</div>
                </div>
                <div style="height:280px;">
                    <canvas id="chartCor"></canvas>
                </div>
            </div>
            <div class="chart-card full">
                <div class="chart-header">
                    <div class="chart-title">Aparelhos por Ano</div>
                </div>
                <div style="height:240px;">
                    <canvas id="chartAno"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Tabelas -->
        <div class="table-card">
            <div class="chart-header">
                <div class="chart-title">Últimos Aparelhos</div>
            </div>
            <table class="table-admin">
                <thead>
                    <tr><th>ID</th><th>Aparelho</th><th>Modelo</th><th>Cor</th><th>Ano</th></tr>
                </thead>
                <tbody id="tabelaAparelhos">
                    <tr><td colspan="5">Carregando...</td></tr>
                </tbody>
            </table>
        </div>
        
        <div class="table-card">
            <div class="chart-header">
                <div class="chart-title">Usuários Cadastrados</div>
            </div>
            <table class="table-admin">
                <thead>
                    <tr><th>ID</th><th>Nome</th><th>Email</th><th>Gênero</th><th>Telefone</th></tr>
                </thead>
                <tbody id="tabelaUsuarios">
                    <tr><td colspan="5">Carregando...</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="/dashboard.js"></script>

</body>
</html>