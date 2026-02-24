<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samsung - Painel de Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
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

        /* Navbar Estilizada */
        .navbar-custom { 
            background: linear-gradient(135deg, var(--primary-purple), var(--dark-purple));
            padding: 1.5rem 0;
            border-bottom: 4px solid rgba(255,255,255,0.1);
            box-shadow: 0 4px 20px rgba(111, 66, 193, 0.2);
        }

        /* Cards com efeito de flutuação */
        .card { 
            border: none; 
            border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(111, 66, 193, 0.05);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(111, 66, 193, 0.1);
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

        /* Inputs e Botões */
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
            background-color: #ffffff;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark-purple);
            margin-bottom: 8px;
        }

        .btn-purple { 
            background-color: var(--primary-purple); 
            color: white; 
            font-weight: 600; 
            border-radius: 12px; 
            padding: 12px;
            border: none;
            transition: all 0.3s;
        }
        .btn-purple:hover { 
            background-color: var(--dark-purple); 
            color: white;
            box-shadow: 0 5px 15px rgba(111, 66, 193, 0.3);
            transform: translateY(-2px);
        }

        /* Tabela */
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
            font-weight: 700;
        }
        .table tbody td {
            padding: 15px;
            border-bottom: 1px solid #f1f1f1;
            vertical-align: middle;
        }
        .table tbody tr:hover {
            background-color: rgba(111, 66, 193, 0.02);
        }

        .badge-id { 
            background-color: var(--soft-purple); 
            color: var(--primary-purple); 
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        /* Status Dot */
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
            0% {
                opacity: 1;
                transform: scale(1);
            }
            50% {
                opacity: 0.6;
                transform: scale(1.1);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Badges personalizados */
        .badge-year {
            background-color: #f1f1f1;
            color: #666;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            border: 1px solid #ddd;
        }

        /* Loader */
        .loader-spinner {
            color: var(--primary-purple);
        }

        /* Breadcrumb */
        .breadcrumb-custom {
            background-color: white;
            padding: 12px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(111, 66, 193, 0.05);
        }

        .breadcrumb-item {
            color: var(--primary-purple);
        }

        /* Scrollbar personalizada */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--soft-purple);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-purple);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--dark-purple);
        }

        /* Animação de entrada */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .row > * {
            animation: fadeInUp 0.5s ease forwards;
        }

        /* Botões de ação */
        .action-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            margin: 0 2px;
        }
        .action-btn:hover {
            transform: scale(1.1);
        }
        .action-btn.edit {
            background-color: var(--soft-purple);
            color: var(--primary-purple);
        }
        .action-btn.edit:hover {
            background-color: var(--primary-purple);
            color: white;
        }
        .action-btn.delete {
            background-color: #ffeeee;
            color: #dc3545;
        }
        .action-btn.delete:hover {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-custom mb-5 shadow">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand text-white fw-bold italic" href="#">
            <i class="fa-solid fa-mobile-screen-button me-2"></i> SAMSUNG/STORE
        </a>
        <div class="d-flex align-items-center gap-4">
            <span class="text-white-50 small">
                <span class="status-dot"></span> Sistema Ativo
            </span>
            <div class="dropdown">
                <button class="btn btn-sm btn-link text-white text-decoration-none dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fa-regular fa-circle-user me-1"></i> Admin
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="fa-regular fa-user me-2"></i> Perfil</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fa-regular fa-gear me-2"></i> Configurações</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="#"><i class="fa-regular fa-arrow-right-from-bracket me-2"></i> Sair</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="container pb-5">
    <!-- Breadcrumb e Data -->
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
                            <small class="text-muted">Digite o nome do aparelho</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-uppercase fw-bold">
                                <i class="fa-solid fa-microchip me-1"></i> Modelo
                            </label>
                            <input type="text" id="modelo" class="form-control" placeholder="Ex: Ultra / Plus" required>
                            <small class="text-muted">Especifique a variante</small>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label small text-uppercase fw-bold">
                                    <i class="fa-solid fa-palette me-1"></i> Cor
                                </label>
                                <input type="text" id="cor" class="form-control" placeholder="Titanium" required>
                                <div class="d-flex mt-2 gap-1">
                                    <span style="width: 20px; height: 20px; background: #333; border-radius: 50%;" title="Preto"></span>
                                    <span style="width: 20px; height: 20px; background: #C0C0C0; border-radius: 50%;" title="Prata"></span>
                                    <span style="width: 20px; height: 20px; background: #FFD700; border-radius: 50%;" title="Dourado"></span>
                                    <span style="width: 20px; height: 20px; background: #6f42c1; border-radius: 50%;" title="Roxo"></span>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label small text-uppercase fw-bold">
                                    <i class="fa-solid fa-calendar me-1"></i> Ano
                                </label>
                                <input type="number" id="ano" class="form-control" placeholder="2024" required min="2020" max="2025">
                            </div>
                        </div>
                        
                        <button type="button" id="salvaraparelho" class="btn btn-purple w-100 mt-3">
                            <i class="fa-solid fa-cloud-arrow-up me-2"></i> REGISTRAR ITEM
                        </button>
                    </form>
                </div>
            </div>

            <!-- Dica rápida -->
            <div class="card mt-3 p-3" style="background: linear-gradient(135deg, var(--soft-purple), white);">
                <div class="d-flex align-items-center gap-3">
                    <i class="fa-solid fa-lightbulb" style="color: var(--primary-purple); font-size: 1.5rem;"></i>
                    <div>
                        <small class="fw-bold">Dica rápida</small>
                        <p class="small text-muted mb-0">Preencha todos os campos para um registro completo do produto.</p>
                    </div>
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
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <span class="input-group-text bg-transparent border-0" style="color: var(--primary-purple);">
                                <i class="fa-solid fa-search"></i>
                            </span>
                            <input type="text" class="form-control form-control-sm" id="pesquisa" placeholder="Buscar..." style="border-radius: 20px;">
                        </div>
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
                        </tbody>
                    </table>
                </div>

                <div id="loader" class="text-center py-5 d-none">
                    <div class="spinner-grow text-primary loader-spinner" role="status"></div>
                    <p class="mt-2 text-muted small italic">Carregando produtos...</p>
                </div>

                <!-- Rodapé da tabela -->
                <div class="card-footer bg-transparent border-0 p-3 d-flex justify-content-between align-items-center">
                    <div class="small text-muted">
                        <i class="fa-regular fa-hard-drive me-1"></i>
                        <span id="totalRegistros">0</span> registros encontrados
                    </div>
                    <div class="small">
                        <span class="badge-id me-1">
                            <i class="fa-regular fa-clock me-1"></i> Última atualização: <span id="ultimaAtualizacao">agora</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    const API_URL = '/api';

    // Função para atualizar data atual
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

    // Função para buscar produtos
    async function carregarProdutos() {
        const tabela = document.getElementById('tabelaCorpo');
        const loader = document.getElementById('loader');
        
        tabela.innerHTML = ''; 
        loader.classList.remove('d-none');

        try {
            const response = await fetch(`${API_URL}/todos_samsung`);
            const data = await response.json();

            if (data.samsung && data.samsung.length > 0) {
                // Atualizar contadores
                document.getElementById('contadorItens').textContent = data.samsung.length;
                document.getElementById('totalRegistros').textContent = data.samsung.length;
                
                // Atualizar timestamp
                document.getElementById('ultimaAtualizacao').textContent = new Date().toLocaleTimeString('pt-BR');

                // Renderizar tabela
                data.samsung.forEach((item, index) => {
                    setTimeout(() => {
                        tabela.innerHTML += `
                            <tr style="animation: fadeInUp 0.3s ease forwards; animation-delay: ${index * 0.05}s; opacity: 0;">
                                <td><span class="badge-id">#${item.id}</span></td>
                                <td>
                                    <span class="fw-bold">${item.aparelho}</span>
                                    ${item.aparelho.includes('S24') ? '<span class="badge-id ms-1" style="font-size: 0.7rem;">Novo</span>' : ''}
                                </td>
                                <td><span class="text-secondary">${item.modelo}</span></td>
                                <td>
                                    <i class="fa-solid fa-circle me-1" style="color: ${getCorColor(item.cor)}; font-size: 0.8rem;"></i>
                                    ${item.cor}
                                </td>
                                <td><span class="badge-year">${item.ano}</span></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="/altera_loja/${item.id}" class="action-btn edit" title="Editar">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <a href="/deleta_samsung/${item.id}" class="action-btn delete" title="Deletar" onclick="return confirm('Tem certeza que deseja deletar este produto?')">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        `;
                    }, index * 50);
                });
            } else {
                tabela.innerHTML = '<tr><td colspan="6" class="text-center py-5">Nenhum produto cadastrado no momento.</td></tr>';
                document.getElementById('contadorItens').textContent = '0';
                document.getElementById('totalRegistros').textContent = '0';
            }
        } catch (error) {
            console.error("Erro ao carregar:", error);
            tabela.innerHTML = '<tr><td colspan="6" class="text-center py-5 text-danger">Erro ao conectar com a API.</td></tr>';
        } finally {
            loader.classList.add('d-none');
        }
    }

    // Função para determinar cor do ícone baseada no nome da cor
    function getCorColor(cor) {
        const cores = {
            'Preto': '#000000',
            'Black': '#000000',
            'Branco': '#FFFFFF',
            'White': '#FFFFFF',
            'Prata': '#C0C0C0',
            'Silver': '#C0C0C0',
            'Dourado': '#FFD700',
            'Gold': '#FFD700',
            'Titanium': '#808080',
            'Azul': '#0000FF',
            'Blue': '#0000FF',
            'Roxo': '#6f42c1',
            'Purple': '#6f42c1'
        };
        return cores[cor] || '#6f42c1';
    }

    // Inicialização
    window.onload = function() {
        atualizarData();
        carregarProdutos();
        
        // Atualizar data a cada minuto
        setInterval(atualizarData, 60000);
    };

    // Função de busca
    document.getElementById('pesquisa')?.addEventListener('keyup', function(e) {
        const termo = e.target.value.toLowerCase();
        const linhas = document.querySelectorAll('#tabelaCorpo tr');
        
        linhas.forEach(linha => {
            const texto = linha.textContent.toLowerCase();
            linha.style.display = texto.includes(termo) ? '' : 'none';
        });
    });
</script>

<script>
    $(document).ready(function () {
        $("#salvaraparelho").click(function () {
            // Validação básica
            if(!$("#aparelho").val() || !$("#modelo").val() || !$("#cor").val() || !$("#ano").val()) {
                alert("Por favor, preencha todos os campos obrigatórios!");
                return;
            }

            // Loading state
            const btn = $(this);
            btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin me-2"></i> REGISTRANDO...');

            $.ajax({
                url: "/api/altera_loja",
                method: "PUT",
                data: {
                    aparelho: $("#aparelho").val(),
                    modelo: $("#modelo").val(),
                    cor: $("#cor").val(),
                    ano: $("#ano").val()
                },
                success: function (res) {
                    console.log(res);
                    alert("Produto registrado com sucesso!");
                    
                    // Limpar formulário
                    $("#aparelho, #modelo, #cor, #ano").val('');
                    
                    // Recarregar produtos
                    carregarProdutos();
                    
                    // Resetar botão
                    btn.prop('disabled', false).html('<i class="fa-solid fa-cloud-arrow-up me-2"></i> REGISTRAR ITEM');
                },
                error: function (xhr) {
                    console.log("Erro", xhr.responseText);
                    alert("Erro ao registrar produto. Tente novamente.");
                    btn.prop('disabled', false).html('<i class="fa-solid fa-cloud-arrow-up me-2"></i> REGISTRAR ITEM');
                }
            });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>