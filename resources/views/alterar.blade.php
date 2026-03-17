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
            --primary-purple: #6f42c1;
            --soft-purple: #f3f0ff;
            --dark-purple: #5227a1;
            --bg-page: #f8f7ff;
        }

        body { 
            background-color: var(--bg-page); 
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: #444;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar-custom { 
            background: linear-gradient(135deg, var(--primary-purple), var(--dark-purple));
            padding: 1.5rem 0;
            border-bottom: 4px solid rgba(255,255,255,0.1);
            box-shadow: 0 4px 20px rgba(111, 66, 193, 0.2);
        }

        /* Cards */
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
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: var(--primary-purple);
            box-shadow: 0 0 0 0.25rem rgba(111, 66, 193, 0.1);
        }

        .form-label {
            font-weight: 600;
            color: var(--dark-purple);
            margin-bottom: 8px;
            font-size: 0.85rem;
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

        /* Tabela */
        .table thead th {
            background-color: var(--soft-purple);
            color: var(--dark-purple);
            border: none;
            text-transform: uppercase;
            font-size: 0.75rem;
            padding: 15px;
        }

        .badge-id { 
            background-color: var(--soft-purple); 
            color: var(--primary-purple); 
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
        }

        .status-dot {
            height: 10px; width: 10px;
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
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(111, 66, 193, 0.05);
        }

        /* Destaque do Produto Atual */
        .current-product-box {
            background: white;
            border-left: 5px solid var(--primary-purple);
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
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
                <a href="/index" class="btn btn-sm btn-outline-light rounded-pill px-3">
                    <i class="fa-solid fa-arrow-left me-1"></i> Voltar
                </a>
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
                <span class="text-muted">Alterar Produto</span>
            </div>
            <span class="badge rounded-pill bg-primary" style="background-color: var(--primary-purple) !important;">
                Modo Edição
            </span>
        </div>

        <div class="current-product-box shadow-sm">
            <div class="d-flex align-items-center gap-3">
                <div class="action-btn edit" style="width: 45px; height: 45px; border-radius: 12px; background: var(--soft-purple); display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-pen-nib text-primary" style="color: var(--primary-purple) !important;"></i>
                </div>
                <div>
                    <p class="text-muted small mb-0">Editando agora:</p>
                    <h5 class="fw-bold mb-0" style="color: var(--dark-purple);">{{$loja->aparelho}} {{$loja->modelo}}</h5>
                </div>
            </div>
            <span class="badge-id">ID #{{$loja->id}}</span>
        </div>

        <div class="row g-4">
            <div class="col-lg-5">
                <div class="card shadow-sm">
                    <div class="card-header-custom">
                        <i class="fa-solid fa-sliders"></i> Parâmetros do Produto
                    </div>
                    <div class="card-body p-4">
                        <form id="formSamsung">
                            <div class="mb-3">
                                <label class="form-label"><i class="fa-solid fa-mobile-alt me-1"></i> Aparelho</label>
                                <input value="{{ $loja->aparelho }}" type="text" id="aparelho" class="form-control" placeholder="Ex: Galaxy S24">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label"><i class="fa-solid fa-microchip me-1"></i> Modelo</label>
                                <input value="{{ $loja->modelo }}" type="text" id="modelo" class="form-control" placeholder="Ex: Ultra">
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="fa-solid fa-palette me-1"></i> Cor</label>
                                    <input value="{{ $loja->cor }}" type="text" id="cor" class="form-control" placeholder="Ex: Titanium">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="fa-solid fa-calendar-day me-1"></i> Ano</label>
                                    <input value="{{ $loja->ano }}" type="number" id="ano" class="form-control" placeholder="2024">
                                </div>
                            </div>

                            <button type="button" id="salvaraparelho" class="btn-purple w-100 mt-3 shadow-sm">
                                <i class="fa-solid fa-check-double me-2"></i> ATUALIZAR REGISTRO
                            </button>

                            <div class="d-flex gap-2 mt-3">
                                <a href="/index" class="btn btn-light border w-50" style="border-radius: 12px;">
                                    Cancelar
                                </a>
                                <a href="/deleta_samsung/{{$loja->id}}" class="btn btn-outline-danger w-50" style="border-radius: 12px;" onclick="return confirm('Excluir permanentemente?')">
                                    <i class="fa-regular fa-trash-can me-1"></i> Deletar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card shadow-sm h-100">
                    <div class="card-header-custom justify-content-between">
                        <div><i class="fa-solid fa-layer-group"></i> Outros no Estoque</div>
                        <button onclick="carregarProdutos()" class="btn btn-sm text-primary p-0"><i class="fa-solid fa-sync"></i></button>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Aparelho</th>
                                    <th>Cor/Ano</th>
                                </tr>
                            </thead>
                            <tbody id="tabelaCorpo">
                                </tbody>
                        </table>
                    </div>
                    <div id="loader" class="text-center py-4 d-none">
                        <div class="spinner-border spinner-border-sm text-primary"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const API_URL = '/api';

        // Lógica de carregamento de produtos (Versão Roxa)
        async function carregarProdutos() {
            const tabela = document.getElementById('tabelaCorpo');
            const loader = document.getElementById('loader');
            tabela.innerHTML = ''; 
            loader.classList.remove('d-none');

            try {
                const response = await fetch(`${API_URL}/todos_samsung`);
                const data = await response.json();

                if (data.samsung) {
                    data.samsung.forEach(item => {
                        const isEditing = item.id == {{ $loja->id }};
                        tabela.innerHTML += `
                            <tr style="${isEditing ? 'background: var(--soft-purple); font-weight: bold;' : ''}">
                                <td><span class="badge-id">#${item.id}</span></td>
                                <td>${item.aparelho} <small class="text-muted d-block">${item.modelo}</small></td>
                                <td>
                                    <span class="badge bg-light text-dark border">${item.cor}</span>
                                    <span class="badge bg-light text-dark border">${item.ano}</span>
                                </td>
                            </tr>`;
                    });
                }
            } catch (error) {
                console.error("Erro:", error);
            } finally {
                loader.classList.add('d-none');
            }
        }

        $(document).ready(function () {
            window.onload = carregarProdutos;

            $("#salvaraparelho").click(function () {
                const btn = $(this);
                btn.prop('disabled', true).html('<i class="fa-solid fa-circle-notch fa-spin me-2"></i> PROCESSANDO...');

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
                        alert("Alterado com sucesso!");
                        window.location.href = '/index';
                    },
                    error: function (xhr) {
                        alert("Erro ao salvar.");
                        btn.prop('disabled', false).html('<i class="fa-solid fa-check-double me-2"></i> ATUALIZAR REGISTRO');
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>