<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samsung - Alterar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        :root {
            --primary-blue: #1428A0;
            --dark-blue: #0A1870;
            --soft-blue: #E8EDF9;
            --bg-page: #F5F7FC;
        }

        body { 
            background-color: var(--bg-page); 
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: #333;
            min-height: 100vh;
        }

        .navbar-custom { 
            background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));
            padding: 1.2rem 0;
            border-bottom: 4px solid rgba(255,255,255,0.1);
            box-shadow: 0 4px 20px rgba(20, 40, 160, 0.25);
        }

        .card { 
            border: none; 
            border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(20, 40, 160, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }
        .card:hover {
            box-shadow: 0 15px 40px rgba(20, 40, 160, 0.12);
        }

        .card-header-custom {
            background: linear-gradient(135deg, #f8f9ff, #ffffff);
            border-bottom: 2px solid var(--soft-blue);
            padding: 20px 25px;
            font-weight: 700;
            color: var(--primary-blue);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .form-control, .form-select {
            border-radius: 12px;
            border: 2px solid #E8EDF9;
            padding: 12px 16px;
            background-color: #ffffff;
            transition: all 0.3s;
            font-size: 0.95rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 4px rgba(20, 40, 160, 0.08);
        }

        .form-label {
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 6px;
            font-size: 0.85rem;
            letter-spacing: 0.3px;
        }

        .btn-primary-custom { 
            background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));
            color: white; 
            font-weight: 600; 
            border-radius: 12px; 
            padding: 14px;
            border: none;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
        }
        .btn-primary-custom:hover { 
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(20, 40, 160, 0.3);
            color: white;
        }

        .table thead th {
            background-color: var(--soft-blue);
            color: var(--dark-blue);
            border: none;
            text-transform: uppercase;
            font-size: 0.7rem;
            padding: 15px;
            letter-spacing: 0.5px;
            font-weight: 700;
        }

        .table tbody tr {
            transition: all 0.2s;
        }
        .table tbody tr:hover {
            background-color: var(--soft-blue) !important;
        }

        .badge-id { 
            background: linear-gradient(135deg, var(--soft-blue), #d4dff5); 
            color: var(--primary-blue); 
            padding: 6px 14px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.8rem;
        }

        .status-dot {
            height: 10px; width: 10px;
            background-color: #2ecc71;
            border-radius: 50%;
            display: inline-block;
            margin-right: 6px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.2); }
            100% { opacity: 1; transform: scale(1); }
        }

        .breadcrumb-custom {
            background: white;
            padding: 14px 24px;
            border-radius: 14px;
            margin-bottom: 25px;
            box-shadow: 0 2px 15px rgba(20, 40, 160, 0.06);
        }

        .current-product-box {
            background: white;
            border-left: 5px solid var(--primary-blue);
            border-radius: 16px;
            padding: 18px 24px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 15px rgba(20, 40, 160, 0.06);
        }

        .product-img-preview {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid var(--soft-blue);
        }

        .input-group-custom {
            position: relative;
        }
        .input-group-custom .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9aa8c7;
            z-index: 10;
        }
        .input-group-custom .form-control,
        .input-group-custom .form-select {
            padding-left: 42px;
        }

        .btn-outline-danger-custom {
            border-radius: 12px;
            border: 2px solid #f5c6cb;
            color: #dc3545;
            transition: all 0.3s;
        }
        .btn-outline-danger-custom:hover {
            background-color: #dc3545;
            color: white;
            border-color: #dc3545;
        }

        .btn-outline-secondary-custom {
            border-radius: 12px;
            border: 2px solid #e8edf9;
            color: #6c757d;
            transition: all 0.3s;
        }
        .btn-outline-secondary-custom:hover {
            background-color: #e8edf9;
            border-color: #c5d0e6;
        }

        .badge-stock {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .badge-stock.in-stock {
            background-color: #d4edda;
            color: #155724;
        }
        .badge-stock.low-stock {
            background-color: #fff3cd;
            color: #856404;
        }
        .badge-stock.out-stock {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Loading shimmer */
        .shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
    </style>
</head>
<body>
    @php
        if(!isset($samsung) || !$samsung) {
            echo '<div class="alert alert-danger m-5">Produto não encontrado! <a href="/index" class="alert-link">Voltar</a></div>';
            exit;
        }
    @endphp

    <input type="hidden" id="id_loja" value="{{ $samsung->id }}">

    <nav class="navbar navbar-custom mb-4 shadow">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand text-white fw-bold" href="#">
                <i class="fa-solid fa-mobile-screen-button me-2"></i> SAMSUNG STORE
            </a>
            <div class="d-flex align-items-center gap-4">
                <span class="text-white-50 small d-none d-md-inline">
                    <span class="status-dot"></span> Sistema em Operação
                </span>
                <a href="/index" class="btn btn-sm btn-outline-light rounded-pill px-4">
                    <i class="fa-solid fa-arrow-left me-2"></i> Voltar
                </a>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        <!-- Breadcrumb -->
        <div class="breadcrumb-custom d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <i class="fa-solid fa-house" style="color: var(--primary-blue);"></i>
                <span class="text-muted">/</span>
                <span class="fw-bold" style="color: var(--dark-blue);">Painel</span>
                <span class="text-muted">/</span>
                <span class="text-muted">Produtos</span>
                <span class="text-muted">/</span>
                <span class="text-muted">Editar</span>
            </div>
            <span class="badge rounded-pill px-3 py-2" style="background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));">
                <i class="fa-solid fa-pen me-1"></i> Edição
            </span>
        </div>

        <!-- Produto Atual -->
        <div class="current-product-box">
            <div class="d-flex align-items-center gap-3">
                <img src="{{ $samsung->imagem_url ?? 'https://images.samsung.com/is/image/samsung/p6pim/br/feature/163786000/br-feature-gallery-samsung-zk-545150600?$684_547_JPG$' }}" 
                     alt="{{ $samsung->aparelho }}" 
                     class="product-img-preview">
                <div>
                    <p class="text-muted small mb-0">
                        <i class="fa-regular fa-pen-to-square me-1"></i> Editando:
                    </p>
                    <h5 class="fw-bold mb-0" style="color: var(--dark-blue);">
                        {{ $samsung->aparelho }} {{ $samsung->modelo }}
                    </h5>
                    <small class="text-muted">
                        <i class="fa-regular fa-circle-check text-success me-1"></i>
                        ID #{{ $samsung->id }}
                    </small>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="badge-id">
                    <i class="fa-regular fa-hashtag me-1"></i> #{{ $samsung->id }}
                </span>
            </div>
        </div>

        <!-- Conteúdo Principal -->
        <div class="row g-4">
            <!-- Formulário -->
            <div class="col-lg-5">
                <div class="card shadow-sm">
                    <div class="card-header-custom">
                        <i class="fa-solid fa-sliders-h"></i> 
                        <span>Editar Produto</span>
                    </div>
                    <div class="card-body p-4">
                        <form id="formSamsung">
                            <!-- Nome do Aparelho -->
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fa-solid fa-mobile-screen me-1"></i> Aparelho *
                                </label>
                                <div class="input-group-custom">
                                    <span class="input-icon"><i class="fa-solid fa-mobile-alt"></i></span>
                                    <input value="{{ $samsung->aparelho }}" 
                                           type="text" 
                                           id="aparelho" 
                                           class="form-control" 
                                           placeholder="Ex: Galaxy S24 Ultra"
                                           required>
                                </div>
                            </div>

                            <!-- Modelo -->
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fa-solid fa-microchip me-1"></i> Modelo
                                </label>
                                <div class="input-group-custom">
                                    <span class="input-icon"><i class="fa-solid fa-tag"></i></span>
                                    <input value="{{ $samsung->modelo }}" 
                                           type="text" 
                                           id="modelo" 
                                           class="form-control" 
                                           placeholder="Ex: SM-S928B">
                                </div>
                            </div>

                            <!-- Cor e Ano -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="fa-solid fa-palette me-1"></i> Cor
                                    </label>
                                    <div class="input-group-custom">
                                        <span class="input-icon"><i class="fa-solid fa-paint-brush"></i></span>
                                        <input value="{{ $samsung->cor }}" 
                                               type="text" 
                                               id="cor" 
                                               class="form-control" 
                                               placeholder="Ex: Titanium Black">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="fa-regular fa-calendar me-1"></i> Ano
                                    </label>
                                    <div class="input-group-custom">
                                        <span class="input-icon"><i class="fa-regular fa-calendar-alt"></i></span>
                                        <input value="{{ $samsung->ano }}" 
                                               type="number" 
                                               id="ano" 
                                               class="form-control" 
                                               placeholder="2024"
                                               min="2010"
                                               max="{{ date('Y') + 1 }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Preço -->
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fa-solid fa-dollar-sign me-1"></i> Preço (R$)
                                </label>
                                <div class="input-group-custom">
                                    <span class="input-icon"><i class="fa-solid fa-brazilian-real-sign"></i></span>
                                    <input value="{{ $samsung->preco ?? '' }}" 
                                           type="number" 
                                           step="0.01" 
                                           id="preco" 
                                           class="form-control" 
                                           placeholder="Ex: 5499.99"
                                           min="0">
                                </div>
                            </div>

                            <!-- Estoque -->
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fa-solid fa-boxes-stacked me-1"></i> Estoque
                                </label>
                                <div class="input-group-custom">
                                    <span class="input-icon"><i class="fa-solid fa-cubes"></i></span>
                                    <input value="{{ $samsung->estoque ?? 0 }}" 
                                           type="number" 
                                           id="estoque" 
                                           class="form-control" 
                                           placeholder="Quantidade disponível"
                                           min="0">
                                </div>
                            </div>

                            <!-- URL da Imagem -->
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fa-solid fa-image me-1"></i> URL da Imagem
                                </label>
                                <div class="input-group-custom">
                                    <span class="input-icon"><i class="fa-solid fa-link"></i></span>
                                    <input value="{{ $samsung->imagem_url ?? '' }}" 
                                           type="url" 
                                           id="imagem_url" 
                                           class="form-control" 
                                           placeholder="https://images.samsung.com/...">
                                </div>
                                <small class="text-muted">
                                    <i class="fa-regular fa-info-circle me-1"></i> 
                                    Deixe em branco para usar a imagem padrão
                                </small>
                            </div>

                            <!-- Descrição (opcional) -->
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fa-regular fa-file-lines me-1"></i> Descrição
                                </label>
                                <textarea id="descricao" 
                                          class="form-control" 
                                          rows="3" 
                                          placeholder="Descrição detalhada do produto...">{{ $samsung->descricao ?? '' }}</textarea>
                            </div>

                            <!-- Categoria (se existir) -->
                            @if(isset($samsung->categoria))
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fa-solid fa-tags me-1"></i> Categoria
                                </label>
                                <select id="categoria" class="form-select">
                                    <option value="smartphone" {{ ($samsung->categoria ?? '') == 'smartphone' ? 'selected' : '' }}>Smartphone</option>
                                    <option value="tablet" {{ ($samsung->categoria ?? '') == 'tablet' ? 'selected' : '' }}>Tablet</option>
                                    <option value="wearable" {{ ($samsung->categoria ?? '') == 'wearable' ? 'selected' : '' }}>Wearable</option>
                                    <option value="acessorio" {{ ($samsung->categoria ?? '') == 'acessorio' ? 'selected' : '' }}>Acessório</option>
                                    <option value="tv" {{ ($samsung->categoria ?? '') == 'tv' ? 'selected' : '' }}>TV</option>
                                    <option value="audio" {{ ($samsung->categoria ?? '') == 'audio' ? 'selected' : '' }}>Áudio</option>
                                    <option value="outro" {{ ($samsung->categoria ?? '') == 'outro' ? 'selected' : '' }}>Outro</option>
                                </select>
                            </div>
                            @endif

                            <!-- Botões -->
                            <button type="button" id="salvaraparelho" class="btn-primary-custom w-100 mt-2">
                                <i class="fa-solid fa-check-double me-2"></i> Atualizar Produto
                            </button>

                            <div class="d-flex gap-2 mt-3">
                                <a href="/index" class="btn btn-outline-secondary-custom w-50">
                                    <i class="fa-regular fa-circle-xmark me-1"></i> Cancelar
                                </a>
                                <a href="/deleta_samsung/{{$samsung->id}}" 
                                   class="btn btn-outline-danger-custom w-50" 
                                   onclick="return confirm('Tem certeza que deseja excluir este produto permanentemente?')">
                                    <i class="fa-regular fa-trash-can me-1"></i> Excluir
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Lista de Produtos -->
            <div class="col-lg-7">
                <div class="card shadow-sm h-100">
                    <div class="card-header-custom justify-content-between">
                        <div>
                            <i class="fa-solid fa-layer-group me-2"></i> 
                            <span>Produtos em Estoque</span>
                            <span class="badge bg-light text-dark ms-2" id="totalProdutos">0</span>
                        </div>
                        <div class="d-flex gap-2">
                            <button onclick="carregarProdutos()" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                <i class="fa-solid fa-sync"></i> <span class="d-none d-md-inline">Atualizar</span>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive p-0">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Produto</th>
                                    <th>Preço</th>
                                    <th>Estoque</th>
                                </tr>
                            </thead>
                            <tbody id="tabelaCorpo">
                                <!-- Dados via JS -->
                            </tbody>
                        </table>
                    </div>
                    <div id="loader" class="text-center py-5 d-none">
                        <div class="spinner-border text-primary" role="status"></div>
                        <p class="text-muted mt-2">Carregando produtos...</p>
                    </div>
                    <div class="card-footer bg-transparent border-0 p-3 text-center text-muted small" id="footerLista">
                        <i class="fa-regular fa-database me-1"></i> Produtos disponíveis no estoque
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const API_URL = '/api';

        async function carregarProdutos() {
            const tabela = document.getElementById('tabelaCorpo');
            const loader = document.getElementById('loader');
            const totalProdutos = document.getElementById('totalProdutos');
            
            tabela.innerHTML = '';
            loader.classList.remove('d-none');

            try {
                const response = await fetch(`${API_URL}/todos_samsung`);
                const data = await response.json();

                if (data.samsung && data.samsung.length > 0) {
                    totalProdutos.textContent = data.samsung.length;
                    
                    data.samsung.forEach(item => {
                        const isEditing = item.id == {{ $samsung->id }};
                        const estoque = item.estoque || 0;
                        const preco = item.preco || 0;
                        
                        let stockBadge = '';
                        if (estoque <= 0) {
                            stockBadge = '<span class="badge-stock out-stock">Esgotado</span>';
                        } else if (estoque < 10) {
                            stockBadge = `<span class="badge-stock low-stock">${estoque} und</span>`;
                        } else {
                            stockBadge = `<span class="badge-stock in-stock">${estoque} und</span>`;
                        }
                        
                        tabela.innerHTML += `
                            <tr style="${isEditing ? 'background: var(--soft-blue); font-weight: 500;' : ''}">
                                <td><span class="badge-id">#${item.id}</span></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="${item.imagem_url || 'https://images.samsung.com/is/image/samsung/p6pim/br/feature/163786000/br-feature-gallery-samsung-zk-545150600?$684_547_JPG$'}" 
                                             style="width: 35px; height: 35px; object-fit: cover; border-radius: 8px; border: 1px solid #e8edf9;">
                                        <div>
                                            <div class="fw-semibold" style="font-size: 0.9rem;">${item.aparelho}</div>
                                            <small class="text-muted">${item.modelo || ''} • ${item.cor || ''}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="fw-bold" style="color: var(--dark-blue);">
                                    R$ ${preco.toLocaleString('pt-BR', {minimumFractionDigits: 2})}
                                </td>
                                <td>${stockBadge}</td>
                            </tr>`;
                    });
                } else {
                    totalProdutos.textContent = '0';
                    tabela.innerHTML = `
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                <i class="fa-regular fa-box-open fa-2x d-block mb-2"></i>
                                Nenhum produto cadastrado
                            </td>
                        </tr>`;
                }
            } catch (error) {
                console.error("Erro:", error);
                tabela.innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center py-4 text-danger">
                            <i class="fa-regular fa-circle-exclamation fa-2x d-block mb-2"></i>
                            Erro ao carregar produtos
                        </td>
                    </tr>`;
            } finally {
                loader.classList.add('d-none');
            }
        }

        $(document).ready(function () {
            // Verificação de token
            let token = $.cookie('token');
            
            console.log("=== VERIFICANDO ACESSO ===");
            console.log("Token:", token ? "✅ Presente" : "❌ Ausente");
            
            if (!token) {
                console.log("❌ Acesso negado - redirecionando para login");
                
                $('#salvaraparelho').prop('disabled', true);
                
                Swal.fire({
                    icon: 'warning',
                    title: 'Acesso Restrito',
                    text: 'Faça login para acessar esta página',
                    confirmButtonColor: '#1428A0',
                    confirmButtonText: 'Ir para Login',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/login';
                    }
                });
                return;
            }
            
            console.log("✅ Acesso permitido");
            
            // Carregar produtos
            carregarProdutos();

            // Evento de salvar
            $("#salvaraparelho").click(function () {
                const btn = $(this);
                btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin me-2"></i> Salvando...');

                let tokenAtual = $.cookie('token');
                
                if (!tokenAtual) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Sessão expirada',
                        text: 'Faça login novamente',
                        confirmButtonColor: '#1428A0'
                    }).then(() => {
                        window.location.href = '/login';
                    });
                    return;
                }

                // Coletar dados do formulário
                const formData = {
                    cor: $("#cor").val(),
                    ano: $("#ano").val(),
                    modelo: $("#modelo").val(),
                    aparelho: $("#aparelho").val(),
                    preco: $("#preco").val(),
                    estoque: $("#estoque").val(),
                    imagem_url: $("#imagem_url").val(),
                    descricao: $("#descricao").val(),
                    categoria: $("#categoria").val(),
                    id_loja: $("#id_loja").val(),
                    token: tokenAtual
                };

                console.log("Enviando dados:", formData);

                $.ajax({
                    url: "/api/altera_loja",
                    method: "PUT",
                    data: formData,
                    success: function (res) {
                        console.log("Resposta:", res);
                        
                        if(res['erro'] == 'n') {
                            Swal.fire({
                                icon: 'success',
                                title: '✅ Produto Atualizado!',
                                text: res['msg'] || 'Produto alterado com sucesso',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.href = '/index';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erro ao atualizar',
                                text: res['msg'] || 'Erro desconhecido'
                            });
                            btn.prop('disabled', false).html('<i class="fa-solid fa-check-double me-2"></i> Atualizar Produto');
                        }
                    },
                    error: function (xhr) {
                        console.error("Erro:", xhr);
                        let msg = 'Erro ao atualizar produto';
                        
                        if (xhr.responseJSON && xhr.responseJSON.msg) {
                            msg = xhr.responseJSON.msg;
                        }
                        
                        if(xhr.status === 401 || xhr.status === 419) {
                            msg = 'Sessão expirada. Faça login novamente.';
                            Swal.fire({
                                icon: 'warning',
                                title: 'Sessão expirada',
                                text: msg
                            }).then(() => {
                                window.location.href = '/login';
                            });
                            return;
                        }
                        
                        Swal.fire({
                            icon: 'error',
                            title: '❌ Falha na atualização',
                            text: msg
                        });
                        
                        btn.prop('disabled', false).html('<i class="fa-solid fa-check-double me-2"></i> Atualizar Produto');
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>