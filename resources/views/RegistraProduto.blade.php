<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samsung - Registrar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        :root {
            --primary-purple: #6f42c1;
            --soft-purple: #f3f0ff;
            --dark-purple: #5227a1;
            --bg-page: #f8f7ff;
        }

        body { 
            background-color: var(--bg-page); 
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: #444;
        }

        .navbar-custom { 
            background: linear-gradient(135deg, var(--primary-purple), var(--dark-purple));
            padding: 1.5rem 0;
            border-bottom: 4px solid rgba(255,255,255,0.1);
            box-shadow: 0 4px 20px rgba(111, 66, 193, 0.2);
            margin-bottom: 30px;
        }

        .navbar-brand {
            color: white;
            font-weight: 800;
            font-size: 1.4rem;
            text-decoration: none;
        }

        .card { 
            border: none; 
            border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(111, 66, 193, 0.05);
            transition: transform 0.3s ease;
            margin-bottom: 20px;
        }

        .card-header-custom {
            background-color: transparent;
            border-bottom: 1px solid var(--soft-purple);
            padding: 20px;
            font-weight: 700;
            color: var(--primary-purple);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #e1e1e1;
            padding: 12px;
            background-color: #fdfdfd;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: var(--primary-purple);
            box-shadow: 0 0 0 0.25rem rgba(111, 66, 193, 0.1);
        }

        .btn-purple { 
            background-color: var(--primary-purple); 
            color: white; 
            font-weight: 600; 
            border-radius: 12px; 
            padding: 12px;
            border: none;
            transition: all 0.3s;
            width: 100%;
        }
        .btn-purple:hover { 
            background-color: var(--dark-purple); 
            color: white;
            box-shadow: 0 5px 15px rgba(111, 66, 193, 0.3);
            transform: translateY(-2px);
        }

        .table {
            margin-bottom: 0;
        }
        .table thead th {
            background-color: var(--soft-purple);
            color: var(--dark-purple);
            border: none;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            padding: 15px;
        }
        .table tbody td {
            padding: 15px;
            border-bottom: 1px solid #f1f1f1;
            vertical-align: middle;
        }

        .badge-id { 
            background-color: var(--soft-purple); 
            color: var(--primary-purple); 
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .status-dot {
            height: 10px;
            width: 10px;
            background-color: #2ecc71;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.6; transform: scale(1.1); }
            100% { opacity: 1; transform: scale(1); }
        }

        .breadcrumb-custom {
            background-color: white;
            padding: 12px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(111, 66, 193, 0.05);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="/inicio">
            <i class="fa-solid fa-mobile-screen-button me-2"></i>
            SAMSUNG / STORE
        </a>
        <div class="d-flex gap-3">
            <a href="/inicio" class="btn btn-sm btn-outline-light">Início</a>
            <a href="#" id="btnLogoutNav" class="btn btn-sm btn-outline-light">Sair</a>
        </div>
    </div>
</nav>

<div class="container pb-5">
    <div class="breadcrumb-custom d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <i class="fa-solid fa-house" style="color: var(--primary-purple);"></i>
            <span class="text-muted">/</span>
            <span class="fw-bold" style="color: var(--dark-purple);">Dashboard</span>
            <span class="text-muted">/</span>
            <span class="text-muted">Registro de Produtos</span>
        </div>
        <div class="text-muted small">
            <i class="fa-regular fa-calendar me-1"></i> 
            <span id="dataAtual"></span>
        </div>
    </div>
    
    <div class="row g-4">
        <!-- Formulário de Cadastro -->
        <div class="col-lg-4">
            <div class="card p-2">
                <div class="card-header-custom">
                    <i class="fa-solid fa-plus-circle"></i> Novo Cadastro
                </div>
                <div class="card-body">
                    <form id="formSamsung">
                        <div class="mb-3">
                            <label class="form-label small text-uppercase fw-bold">
                                <i class="fa-solid fa-mobile me-1"></i> Aparelho
                            </label>
                            <input type="text" id="aparelho" class="form-control" placeholder="Ex: Galaxy S24" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-uppercase fw-bold">
                                <i class="fa-solid fa-microchip me-1"></i> Modelo
                            </label>
                            <input type="text" id="modelo" class="form-control" placeholder="Ex: Ultra / Plus" required>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label small text-uppercase fw-bold">
                                    <i class="fa-solid fa-palette me-1"></i> Cor
                                </label>
                                <input type="text" id="cor" class="form-control" placeholder="Titanium" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label small text-uppercase fw-bold">
                                    <i class="fa-solid fa-calendar me-1"></i> Ano
                                </label>
                                <input type="number" id="ano" class="form-control" placeholder="2024" required>
                            </div>
                        </div>
                        
                        <button type="button" id="salvaraparelho" class="btn-purple mt-3">
                            <i class="fa-solid fa-cloud-arrow-up me-2"></i> REGISTRAR ITEM
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabela de Estoque -->
        <div class="col-lg-8">
            <div class="card overflow-hidden">
                <div class="card-header-custom d-flex justify-content-between w-100">
                    <div>
                        <i class="fa-solid fa-list-check"></i> Estoque Atual
                        <span class="badge-id ms-2" id="contadorItens">0</span>
                    </div>
                    <div class="d-flex gap-3">
                        <button onclick="carregarProdutos()" class="btn btn-sm btn-link text-decoration-none p-0" style="color: var(--primary-purple)">
                            <i class="fa-solid fa-rotate"></i> Atualizar
                        </button>
                    </div>
                </div>
                
                <div class="table-responsive" style="max-height: 450px;">
                    <table class="table table-hover align-middle">
                        <thead style="position: sticky; top: 0; z-index: 10;">
                            <tr>
                                <th>ID</th>
                                <th>Aparelho</th>
                                <th>Modelo</th>
                                <th>Cor</th>
                                <th>Ano</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody id="tabelaCorpo">
                            <!-- Dados serão inseridos via JavaScript -->
                            <tr>
                                <td colspan="6" class="text-center py-4">Carregando produtos...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div id="loader" class="text-center py-5 d-none">
                    <div class="spinner-grow text-primary loader-spinner" role="status"></div>
                    <p class="mt-2 text-muted small">Carregando produtos...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// FUNÇÃO PARA ATUALIZAR DATA
function atualizarData() {
    const data = new Date();
    const options = { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    };
    document.getElementById('dataAtual').textContent = data.toLocaleDateString('pt-BR', options);
}

// FUNÇÃO PARA CARREGAR PRODUTOS (FORA DO DOCUMENT.READY)
async function carregarProdutos() {
    console.log("=== CARREGANDO PRODUTOS ===");
    
    const tabela = document.getElementById('tabelaCorpo');
    const loader = document.getElementById('loader');
    
    if (!tabela) {
        console.error("Elemento tabelaCorpo não encontrado!");
        return;
    }
    
    tabela.innerHTML = '<tr><td colspan="6" class="text-center py-4"><div class="spinner-border text-primary" role="status"></div> Carregando...</td></tr>';
    
    try {
        const response = await fetch('/api/todos_samsung');
        const data = await response.json();
        
        console.log("Dados recebidos:", data);
        
        if (data.erro === 'n' && data.samsung && data.samsung.length > 0) {
            // Atualizar contador
            document.getElementById('contadorItens').textContent = data.samsung.length;
            
            let html = '';
            data.samsung.forEach(item => {
                html += `
                    <tr>
                        <td><span class="badge-id">#${item.id}</span></td>
                        <td class="fw-bold">${item.aparelho}</td>
                        <td>${item.modelo}</td>
                        <td>${item.cor}</td>
                        <td>${item.ano}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="/altera_loja/${item.id}" class="btn btn-sm btn-outline-primary" title="Editar">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                <a href="/deleta_samsung/${item.id}" class="btn btn-sm btn-outline-danger" title="Deletar" onclick="return confirm('Tem certeza?')">
                                    <i class="fa-regular fa-trash-can"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                `;
            });
            
            tabela.innerHTML = html;
        } else {
            tabela.innerHTML = '<tr><td colspan="6" class="text-center py-4">Nenhum produto cadastrado.</td></tr>';
            document.getElementById('contadorItens').textContent = '0';
        }
    } catch (error) {
        console.error("Erro ao carregar produtos:", error);
        tabela.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-danger">Erro ao carregar produtos.</td></tr>';
    }
}

// FUNÇÃO PARA VERIFICAR TOKEN E CONFIGURAR LOGOUT
function verificarToken() {
    let token = $.cookie('token');
    
    if (!token) {
        alert("Você precisa estar logado!");
        window.location.href = '/login';
        return false;
    }
    
    console.log("Token OK:", token.substring(0, 15) + "...");
    return token;
}

// DOCUMENT.READY PRINCIPAL
$(document).ready(function() {
    console.log("=== PÁGINA INICIALIZADA ===");
    
    // Verificar token
    let token = verificarToken();
    if (!token) return;
    
    // Atualizar data
    atualizarData();
    setInterval(atualizarData, 60000);
    
    // Carregar produtos ao iniciar
    carregarProdutos();
    
    // Botão Salvar
    $("#salvaraparelho").click(function() {
        console.log("=== BOTÃO SALVAR CLICADO ===");
        
        let tokenAtual = $.cookie('token');
        if (!tokenAtual) {
            alert("Sessão expirada! Faça login novamente.");
            window.location.href = '/login';
            return;
        }
        
        // Validar campos
        if ($("#cor").val() === "" || $("#ano").val() === "" || 
            $("#modelo").val() === "" || $("#aparelho").val() === "") {
            alert("Preencha todos os campos!");
            return;
        }
        
        let dados = {
            cor: $("#cor").val(),
            ano: $("#ano").val(),
            modelo: $("#modelo").val(),
            aparelho: $("#aparelho").val(),
            token: tokenAtual
        };
        
        console.log("Enviando dados:", dados);
        
        $.ajax({
            url: "/api/salva_samsung",
            method: "POST",
            data: dados,
            success: function(res) {
                console.log("Resposta:", res);
                
                if(res['erro'] == 'n') {
                    alert("Produto cadastrado com sucesso!");
                    
                    // Limpar campos
                    $("#cor, #ano, #modelo, #aparelho").val("");
                    
                    // RECARREGAR A TABELA
                    carregarProdutos();
                } else {
                    alert("Erro: " + (res['msg'] || 'Erro desconhecido'));
                }
            },
            error: function(xhr) {
                console.error("Erro AJAX:", xhr);
                alert("Erro ao conectar com o servidor. Status: " + xhr.status);
            }
        });
    });
    
    // Botão Logout
    $("#btnLogoutNav").click(function(e) {
        e.preventDefault();
        
        if (confirm("Deseja realmente sair?")) {
            $.removeCookie('token', { path: '/' });
            window.location.href = '/login';
        }
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>