<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samsung</title>
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
        }
        .form-control:focus {
            border-color: var(--primary-purple);
            box-shadow: 0 0 0 0.25rem rgba(111, 66, 193, 0.1);
        }

        .form-control:disabled {
            background-color: var(--soft-purple);
            opacity: 0.8;
            cursor: not-allowed;
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
        }

        .btn-delete {
            background-color: #dc3545;
        }
        .btn-delete:hover {
            background-color: #bb2d3b;
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
        }
        .table tbody td {
            padding: 15px;
            border-bottom: 1px solid #f1f1f1;
        }

        .badge-id { 
            background-color: var(--soft-purple); 
            color: var(--primary-purple); 
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
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
            }
            50% {
                opacity: 0.5;
            }
            100% {
                opacity: 1;
            }
        }

        /* Links */
        a {
            color: var(--primary-purple);
            transition: all 0.3s;
        }
        a:hover {
            color: var(--dark-purple);
        }

        /* Badges adicionais */
        .badge-purple {
            background-color: var(--soft-purple);
            color: var(--primary-purple);
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        /* Alertas */
        .alert-custom {
            background-color: var(--soft-purple);
            border-left: 4px solid var(--primary-purple);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }

        /* Informações do produto */
        .product-info {
            background-color: white;
            border-radius: 10px;
            padding: 10px 15px;
            margin-top: 10px;
            border: 1px solid var(--soft-purple);
        }

        .info-label {
            color: var(--dark-purple);
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-weight: 600;
            color: var(--primary-purple);
            font-size: 1rem;
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
            <span class="badge-purple text-white">
                <i class="fa-regular fa-user me-1"></i> Admin
            </span>
        </div>
    </div>
</nav>

<div class="container pb-5">
    <!-- Breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-2">
            <i class="fa-solid fa-house text-purple" style="color: var(--primary-purple);"></i>
            <span class="text-muted">/</span>
            <span class="text-muted">Deletar Produto</span>
        </div>
        <div class="text-muted small">
            <i class="fa-regular fa-clock me-1"></i> {{ date('d/m/Y H:i') }}
        </div>
    </div>

    <!-- Alerta de confirmação -->
    <div class="alert-custom d-flex align-items-center">
        <i class="fa-solid fa-circle-exclamation me-3" style="color: var(--primary-purple); font-size: 1.5rem;"></i>
        <div>
            <strong>Atenção!</strong> Você está prestes a deletar o produto abaixo. Esta ação não pode ser desfeita.
        </div>
    </div>

    <div class="row g-4">
        
        <!-- Card de deleção -->
        <div class="col-lg-4">
            <div class="card p-2">
                <div class="card-header-custom">
                    <i class="fa-solid fa-trash-can" style="color: #dc3545;"></i> Deletar Produto
                </div>
                <div class="card-body">
                    <!-- Informações do produto sendo deletado -->
                    <div class="product-info mb-4">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="fa-solid fa-circle-info" style="color: var(--primary-purple);"></i>
                            <span class="info-label">Produto Selecionado</span>
                        </div>
                        <div class="row g-2">
                            <div class="col-6">
                                <div class="info-label">ID</div>
                                <div class="info-value">#{{ $loja->id }}</div>
                            </div>
                            <div class="col-6">
                                <div class="info-label">Aparelho</div>
                                <div class="info-value">{{ $loja->aparelho }}</div>
                            </div>
                            <div class="col-6">
                                <div class="info-label">Modelo</div>
                                <div class="info-value">{{ $loja->modelo }}</div>
                            </div>
                            <div class="col-6">
                                <div class="info-label">Cor/Ano</div>
                                <div class="info-value">{{ $loja->cor }} / {{ $loja->ano }}</div>
                            </div>
                        </div>
                    </div>

                    <form id="formSamsung">
                        <div class="mb-3">
                            <label class="form-label small text-uppercase fw-bold">
                                <i class="fa-solid fa-mobile me-1"></i>Aparelho
                            </label>
                            <input value="{{ $loja->aparelho }}" disabled type="text" id="aparelho" class="form-control" placeholder="Ex: Galaxy S24">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-uppercase fw-bold">
                                <i class="fa-solid fa-microchip me-1"></i>Modelo
                            </label>
                            <input value="{{ $loja->modelo }}" disabled type="text" id="modelo" class="form-control" placeholder="Ex: Ultra / Plus">
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label small text-uppercase fw-bold">
                                    <i class="fa-solid fa-palette me-1"></i>Cor
                                </label>
                                <input value="{{ $loja->cor }}" disabled type="text" id="cor" class="form-control" placeholder="Titanium">
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label small text-uppercase fw-bold">
                                    <i class="fa-solid fa-calendar me-1"></i>Ano
                                </label>
                                <input value="{{ $loja->ano }}" disabled type="number" id="ano" class="form-control" placeholder="2024">
                            </div>
                        </div>
                        
                        <!-- Confirmação adicional -->
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="confirmDelete">
                            <label class="form-check-label small text-danger" for="confirmDelete">
                                Confirmo que desejo deletar este produto permanentemente
                            </label>
                        </div>

                        <button type="button" id="salvaraparelho" class="btn btn-purple btn-delete w-100 mt-2" disabled>
                            <i class="fa-solid fa-trash-can me-2"></i> DELETAR ITEM
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabela de estoque -->
        <div class="col-lg-8">
            <div class="card overflow-hidden">
                <div class="card-header-custom d-flex justify-content-between w-100">
                    <div>
                        <i class="fa-solid fa-list-check"></i> Estoque Atual
                        <span class="badge-id ms-2" id="totalItems">0</span>
                    </div>
                    <div class="d-flex gap-2">
                        <button onclick="carregarProdutos()" class="btn btn-sm btn-link text-decoration-none p-0" style="color: var(--primary-purple)">
                            <i class="fa-solid fa-rotate"></i> Atualizar
                        </button>
                        <a href="/index" class="btn btn-sm btn-link text-decoration-none p-0" style="color: var(--primary-purple)">
                            <i class="fa-solid fa-arrow-left"></i> Voltar
                        </a>
                    </div>
                </div>
                
                <div class="table-responsive" style="max-height: 500px;">
                    <table class="table table-hover align-middle">
                        <thead>
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
                    <div class="spinner-grow text-primary" role="status" style="color: var(--primary-purple) !important;"></div>
                    <p class="mt-2 text-muted small italic">Sincronizando com a nuvem...</p>
                </div>

                <!-- Rodapé da tabela -->
                <div class="card-footer bg-transparent border-0 p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="small text-muted">
                            <i class="fa-regular fa-hard-drive me-1"></i>
                            <span id="itemsCount">0</span> itens no estoque
                        </div>
                        <div class="small text-muted">
                            <i class="fa-regular fa-clock me-1"></i>
                            Última atualização: agora
                        </div>
                    </div>
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
        
        tabela.innerHTML = ''; 
        loader.classList.remove('d-none');

        try {
            const response = await fetch(`${API_URL}/todos_samsung`);
            const data = await response.json();

            if (data.samsung && data.samsung.length > 0) {
                document.getElementById('totalItems').textContent = data.samsung.length;
                document.getElementById('itemsCount').textContent = data.samsung.length;
                
                data.samsung.forEach(item => {
                    // Destacar o item que está sendo deletado
                    const isCurrentItem = item.id == {{ $loja->id }};
                    const rowStyle = isCurrentItem ? 'style="background-color: rgba(220, 53, 69, 0.05); border-left: 3px solid #dc3545;"' : '';
                    
                    tabela.innerHTML += `
                        <tr ${rowStyle}>
                            <td>
                                <span class="badge-id">#${item.id}</span>
                                ${isCurrentItem ? '<span class="badge-purple ms-1">Deletando</span>' : ''}
                            </td>
                            <td><span class="fw-bold">${item.aparelho}</span></td>
                            <td><span class="text-secondary">${item.modelo}</span></td>
                            <td>
                                <i class="fa-solid fa-palette me-1" style="color: ${getCorColor(item.cor)};"></i> 
                                ${item.cor}
                            </td>
                            <td>
                                <span class="badge rounded-pill bg-light text-dark border">${item.ano}</span>
                            </td>
                        </tr>
                    `;
                });
            } else {
                tabela.innerHTML = '<tr><td colspan="5" class="text-center py-5">Nenhum produto cadastrado no momento.</td></tr>';
                document.getElementById('totalItems').textContent = '0';
                document.getElementById('itemsCount').textContent = '0';
            }
        } catch (error) {
            console.error("Erro ao carregar:", error);
            tabela.innerHTML = '<tr><td colspan="5" class="text-center py-5 text-danger">Erro ao conectar com a API.</td></tr>';
        } finally {
            loader.classList.add('d-none');
        }
    }

    // Função para retornar cor baseada no nome da cor
    function getCorColor(cor) {
        const cores = {
            'Titanium': '#808080',
            'Black': '#000000',
            'White': '#FFFFFF',
            'Silver': '#C0C0C0',
            'Gold': '#FFD700',
            'Blue': '#0000FF',
            'Red': '#FF0000',
            'Purple': '#800080',
            'Green': '#008000'
        };
        return cores[cor] || '#6f42c1';
    }

    window.onload = carregarProdutos;
</script>

<script>
    $(document).ready(function () {
        // Controle do checkbox de confirmação
        $('#confirmDelete').change(function() {
            $('#salvaraparelho').prop('disabled', !this.checked);
        });

        $("#salvaraparelho").click(function () {
            if(!$('#confirmDelete').is(':checked')) {
                alert('Por favor, confirme que deseja deletar o produto.');
                return;
            }

            if(confirm('Tem certeza que deseja deletar este produto? Esta ação não pode ser desfeita!')) {
                $.ajax({
                    url: "/api/d_samsung",
                    method: "DELETE",
                    data: {
                        cor: $("#cor").val(),
                        ano: $("#ano").val(),
                        modelo: $("#modelo").val(),
                        aparelho: $("#aparelho").val(),
                        id_loja: $("#id_loja").val()
                    },
                    beforeSend: function() {
                        $('#salvaraparelho').prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin me-2"></i> DELETANDO...');
                    },
                    success: function (res) {
                        console.log(res);
                        alert('Produto deletado com sucesso!');
                        window.location.href = '/index';
                    },
                    error: function (xhr) {
                        console.log("Erro", xhr.responseText);
                        alert('Erro ao deletar produto. Tente novamente.');
                        $('#salvaraparelho').prop('disabled', false).html('<i class="fa-solid fa-trash-can me-2"></i> DELETAR ITEM');
                    }
                });
            }
        });

    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>