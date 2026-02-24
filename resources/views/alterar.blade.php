<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samsung - Alterar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <style>
        :root {
            --samsung-blue: #1428A0;
            --samsung-light-blue: #3672D1;
            --samsung-dark-blue: #0E1E5F;
            --samsung-gray: #F2F2F2;
            --samsung-black: #1A1A1A;
        }

        body { 
            background: linear-gradient(135deg, #FFFFFF 0%, var(--samsung-gray) 100%);
            font-family: 'Samsung Sharp Sans', 'Inter', system-ui, -apple-system, sans-serif;
            color: var(--samsung-black);
            min-height: 100vh;
        }

        /* Navbar Estilizada - Tema Samsung */
        .navbar-custom { 
            background: linear-gradient(135deg, var(--samsung-blue), var(--samsung-dark-blue));
            padding: 1.5rem 0;
            border-bottom: 3px solid var(--samsung-light-blue);
            box-shadow: 0 4px 20px rgba(20, 40, 160, 0.3);
        }

        /* Cards com efeito de flutuação */
        .card { 
            border: none; 
            border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(20, 40, 160, 0.08);
            transition: transform 0.3s ease;
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(20, 40, 160, 0.12);
        }

        .card-header-custom {
            background: linear-gradient(135deg, #FFFFFF, var(--samsung-gray));
            border-bottom: 2px solid var(--samsung-gray);
            padding: 20px;
            font-weight: 700;
            color: var(--samsung-blue);
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.2rem;
        }

        .card-header-custom i {
            font-size: 1.5rem;
            color: var(--samsung-blue);
        }

        /* Inputs e Botões */
        .form-control {
            border-radius: 12px;
            border: 1px solid #E0E0E0;
            padding: 12px;
            background-color: var(--samsung-gray);
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: var(--samsung-blue);
            box-shadow: 0 0 0 0.25rem rgba(20, 40, 160, 0.1);
            background-color: #FFFFFF;
        }

        .form-label {
            font-weight: 600;
            color: var(--samsung-dark-blue);
            margin-bottom: 8px;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }

        .btn-samsung { 
            background: linear-gradient(135deg, var(--samsung-blue), var(--samsung-dark-blue));
            color: white; 
            font-weight: 600; 
            border-radius: 30px; 
            padding: 12px;
            border: none;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }
        .btn-samsung:hover { 
            background: linear-gradient(135deg, var(--samsung-dark-blue), var(--samsung-blue));
            color: white;
            box-shadow: 0 8px 20px rgba(20, 40, 160, 0.3);
            transform: scale(1.02);
        }

        .btn-outline-samsung {
            background: transparent;
            border: 2px solid var(--samsung-blue);
            color: var(--samsung-blue);
            font-weight: 600;
            border-radius: 30px;
            padding: 10px 20px;
            transition: all 0.3s;
        }
        .btn-outline-samsung:hover {
            background: var(--samsung-blue);
            color: white;
            transform: translateY(-2px);
        }

        /* Tabela */
        .table {
            margin-bottom: 0;
        }
        .table thead th {
            background: linear-gradient(135deg, var(--samsung-gray), #FFFFFF);
            color: var(--samsung-dark-blue);
            border: none;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            padding: 15px;
            font-weight: 700;
        }
        .table tbody td {
            padding: 15px;
            border-bottom: 1px solid var(--samsung-gray);
            vertical-align: middle;
        }

        .badge-id { 
            background-color: var(--samsung-gray); 
            color: var(--samsung-blue); 
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            border-left: 3px solid var(--samsung-light-blue);
        }

        /* Status Dot */
        .status-dot {
            height: 10px;
            width: 10px;
            background: linear-gradient(135deg, #00C851, #007E33);
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.1); }
            100% { opacity: 1; transform: scale(1); }
        }

        /* Breadcrumb */
        .breadcrumb-custom {
            background: white;
            padding: 15px 20px;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(20, 40, 160, 0.05);
        }

        /* Alertas */
        .alert-edit {
            background: linear-gradient(135deg, var(--samsung-gray), #FFFFFF);
            border-left: 4px solid var(--samsung-blue);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }

        /* Badges */
        .badge-blue {
            background: var(--samsung-blue);
            color: white;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.7rem;
        }

        /* Produto atual */
        .current-product {
            background: linear-gradient(135deg, var(--samsung-gray), #FFFFFF);
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .product-highlight {
            color: var(--samsung-blue);
            font-weight: 700;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
    <input type="hidden" id="id_loja" value="{{$loja->id}}">

    <nav class="navbar navbar-custom mb-5 shadow">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand text-white fw-bold italic" href="#">
                <i class="fa-solid fa-mobile-screen-button me-2"></i> SAMSUNG/STORE
            </a>
            <div class="d-flex align-items-center gap-4">
                <span class="text-white-50 small">
                    <span class="status-dot"></span> Sistema Ativo
                </span>
                <a href="/index" class="btn btn-sm btn-outline-light">
                    <i class="fa-regular fa-arrow-left me-1"></i> Voltar
                </a>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        <!-- Breadcrumb -->
        <div class="breadcrumb-custom d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <i class="fa-solid fa-house" style="color: var(--samsung-blue);"></i>
                <span class="text-muted">/</span>
                <span class="fw-bold" style="color: var(--samsung-dark-blue);">Dashboard</span>
                <span class="text-muted">/</span>
                <span class="text-muted">Alterar Produto</span>
            </div>
            <div>
                <span class="badge-blue">
                    <i class="fa-regular fa-pen-to-square me-1"></i> Modo Edição
                </span>
            </div>
        </div>

        <!-- Alerta de edição -->
        <div class="alert-edit d-flex align-items-center">
            <i class="fa-solid fa-circle-info me-3" style="color: var(--samsung-blue); font-size: 1.5rem;"></i>
            <div>
                <strong>Modo de Edição</strong>
                <p class="small text-muted mb-0">Você está alterando o produto #{{$loja->id}}. Após as modificações, clique em "SALVAR ALTERAÇÕES".</p>
            </div>
        </div>

        <!-- Produto em edição -->
        <div class="current-product d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <div style="width: 40px; height: 40px; background: var(--samsung-gray); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-mobile" style="color: var(--samsung-blue);"></i>
                </div>
                <div>
                    <span class="small text-muted">Produto em edição</span>
                    <div class="product-highlight">
                        {{$loja->aparelho}} {{$loja->modelo}}
                    </div>
                </div>
            </div>
            <div class="text-end">
                <span class="badge-id">ID #{{$loja->id}}</span>
            </div>
        </div>

        <div class="row g-4">
            <!-- Formulário de Alteração -->
            <div class="col-lg-5">
                <div class="card p-2">
                    <div class="card-header-custom">
                        <i class="fa-solid fa-pen-to-square"></i> Alterar Produto
                    </div>
                    <div class="card-body">
                        <form id="formSamsung">
                            <!-- ID (somente leitura) -->
                            <div class="mb-4">
                                <label class="form-label small text-uppercase fw-bold">
                                    <i class="fa-regular fa-hashtag me-1"></i> ID do Produto
                                </label>
                                <input type="text" class="form-control" value="#{{$loja->id}}" disabled style="background: var(--samsung-gray); color: var(--samsung-blue); font-weight: 600;">
                            </div>

                            <div class="mb-3">
                                <label class="form-label small text-uppercase fw-bold">
                                    <i class="fa-solid fa-mobile me-1"></i> Aparelho
                                </label>
                                <input value="{{ $loja->aparelho }}" type="text" id="aparelho" class="form-control" placeholder="Ex: Galaxy S24">
                                <small class="text-muted">Nome do aparelho</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small text-uppercase fw-bold">
                                    <i class="fa-solid fa-microchip me-1"></i> Modelo
                                </label>
                                <input value="{{ $loja->modelo }}" type="text" id="modelo" class="form-control" placeholder="Ex: Ultra / Plus">
                                <small class="text-muted">Variante do modelo</small>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label small text-uppercase fw-bold">
                                        <i class="fa-solid fa-palette me-1"></i> Cor
                                    </label>
                                    <input value="{{ $loja->cor }}" type="text" id="cor" class="form-control" placeholder="Titanium">
                                    <div class="d-flex mt-2 gap-1">
                                        <span style="width: 20px; height: 20px; background: #333; border-radius: 50%;" title="Preto"></span>
                                        <span style="width: 20px; height: 20px; background: #C0C0C0; border-radius: 50%;" title="Prata"></span>
                                        <span style="width: 20px; height: 20px; background: #FFD700; border-radius: 50%;" title="Dourado"></span>
                                        <span style="width: 20px; height: 20px; background: #1428A0; border-radius: 50%;" title="Azul Samsung"></span>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label small text-uppercase fw-bold">
                                        <i class="fa-solid fa-calendar me-1"></i> Ano
                                    </label>
                                    <input value="{{ $loja->ano }}" type="number" id="ano" class="form-control" placeholder="2024">
                                </div>
                            </div>

                            <!-- Resumo das alterações -->
                            <div class="current-product mt-4 mb-3 p-2">
                                <div class="small text-muted mb-2">Resumo das alterações:</div>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <span class="badge-id" style="font-size: 0.7rem;">Original</span>
                                        <div class="small">{{ $loja->aparelho }} / {{ $loja->ano }}</div>
                                    </div>
                                    <div class="col-6">
                                        <span class="badge-id" style="font-size: 0.7rem;">Novo</span>
                                        <div class="small" id="previewAlteracoes">Aguardando...</div>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="button" id="salvaraparelho" class="btn-samsung w-100 mt-3">
                                <i class="fa-solid fa-cloud-arrow-up me-2"></i> SALVAR ALTERAÇÕES
                            </button>

                            <div class="d-flex gap-2 mt-3">
                                <a href="/index" class="btn btn-outline-samsung w-50">
                                    <i class="fa-regular fa-xmark me-1"></i> Cancelar
                                </a>
                                <a href="/deleta_samsung/{{$loja->id}}" class="btn btn-outline-samsung w-50" style="border-color: #dc3545; color: #dc3545;" onclick="return confirm('Tem certeza que deseja deletar este produto?')">
                                    <i class="fa-regular fa-trash-can me-1"></i> Deletar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Dica -->
                <div class="card mt-3 p-3" style="background: linear-gradient(135deg, var(--samsung-gray), white);">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fa-solid fa-lightbulb" style="color: var(--samsung-blue); font-size: 1.5rem;"></i>
                        <div>
                            <small class="fw-bold">Dica de edição</small>
                            <p class="small text-muted mb-0">As alterações serão salvas imediatamente após confirmar.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Estoque Atual -->
            <div class="col-lg-7">
                <div class="card overflow-hidden">
                    <div class="card-header-custom d-flex justify-content-between w-100">
                        <div>
                            <i class="fa-solid fa-list-check"></i> Estoque Atual
                            <span class="badge-id ms-2" id="contadorItens">0</span>
                        </div>
                        <button onclick="carregarProdutos()" class="btn btn-sm btn-link text-decoration-none p-0" style="color: var(--samsung-blue)">
                            <i class="fa-solid fa-rotate"></i> Atualizar
                        </button>
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
                                </tr>
                            </thead>
                            <tbody id="tabelaCorpo">
                                <!-- Dados serão inseridos via JavaScript -->
                            </tbody>
                        </table>
                    </div>

                    <div id="loader" class="text-center py-5 d-none">
                        <div class="spinner-grow text-primary" role="status" style="color: var(--samsung-blue) !important;"></div>
                        <p class="mt-2 text-muted small italic">Carregando produtos...</p>
                    </div>

                    <!-- Rodapé -->
                    <div class="card-footer bg-transparent border-0 p-3">
                        <div class="small text-muted">
                            <i class="fa-regular fa-hard-drive me-1"></i>
                            <span id="totalRegistros">0</span> produtos no estoque
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        const API_URL = '/api';

        // Preview das alterações
        $(document).ready(function() {
            function atualizarPreview() {
                const aparelho = $("#aparelho").val() || "{{ $loja->aparelho }}";
                const ano = $("#ano").val() || "{{ $loja->ano }}";
                $("#previewAlteracoes").text(aparelho + " / " + ano);
            }

            $("#aparelho, #ano, #modelo, #cor").on('input', atualizarPreview);
            atualizarPreview();
        });
      
        async function carregarProdutos() {
            const tabela = document.getElementById('tabelaCorpo');
            const loader = document.getElementById('loader');
            
            tabela.innerHTML = ''; 
            loader.classList.remove('d-none');

            try {
                const response = await fetch(`${API_URL}/todos_samsung`);
                const data = await response.json();

                if (data.samsung && data.samsung.length > 0) {
                    document.getElementById('contadorItens').textContent = data.samsung.length;
                    document.getElementById('totalRegistros').textContent = data.samsung.length;
                    
                    data.samsung.forEach(item => {
                        // Destacar o item que está sendo editado
                        const isEditing = item.id == {{ $loja->id }};
                        const rowStyle = isEditing ? 'style="background: linear-gradient(135deg, rgba(20, 40, 160, 0.05), transparent); border-left: 3px solid var(--samsung-blue);"' : '';
                        
                        tabela.innerHTML += `
                            <tr ${rowStyle}>
                                <td>
                                    <span class="badge-id">#${item.id}</span>
                                    ${isEditing ? '<span class="badge-blue ms-1">Editando</span>' : ''}
                                </td>
                                <td><span class="fw-bold">${item.aparelho}</span></td>
                                <td><span class="text-secondary">${item.modelo}</span></td>
                                <td>
                                    <i class="fa-solid fa-circle me-1" style="color: ${getCorColor(item.cor)};"></i>
                                    ${item.cor}
                                </td>
                                <td><span class="badge rounded-pill bg-light text-dark border">${item.ano}</span></td>
                            </tr>
                        `;
                    });
                } else {
                    tabela.innerHTML = '<tr><td colspan="5" class="text-center py-5">Nenhum produto cadastrado no momento.</td></tr>';
                }
            } catch (error) {
                console.error("Erro ao carregar:", error);
                tabela.innerHTML = '<tr><td colspan="5" class="text-center py-5 text-danger">Erro ao conectar com a API.</td></tr>';
            } finally {
                loader.classList.add('d-none');
            }
        }

        // Função para determinar cor do ícone
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
                'Azul': '#1428A0',
                'Blue': '#1428A0'
            };
            return cores[cor] || '#1428A0';
        }

        window.onload = carregarProdutos;
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
                btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin me-2"></i> SALVANDO...');

                $.ajax({
                    url: "../api/altera_loja",
                    method: "PUT",
                    data: {
                        cor: $("#cor").val(),
                        ano: $("#ano").val(),
                        modelo: $("#modelo").val(),
                        aparelho: $("#aparelho").val(),
                        id_loja: $("#id_loja").val()
                    },
                    success: function (res) {
                        console.log(res);
                        alert("Produto alterado com sucesso!");
                        
                        // Redirecionar ou atualizar
                        window.location.href = '/index';
                    },
                    error: function (xhr) {
                        console.log("Erro", xhr.responseText);
                        alert("Erro ao alterar produto. Tente novamente.");
                        btn.prop('disabled', false).html('<i class="fa-solid fa-cloud-arrow-up me-2"></i> SALVAR ALTERAÇÕES');
                    }
                });
            });

        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>