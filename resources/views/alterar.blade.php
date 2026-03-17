<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samsung - Alterar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <script>
        const token = localStorage.getItem('user_token');
        if (!token) {
            window.location.href = '/login';
        }
    </script>
    
    <style>
        .list-group-item-action:hover {
        background-color: var(--soft-purple) !important;
        color: var(--primary-purple) !important;
    }
    .fw-600 { font-weight: 600; }
    .navbar-toggler:focus { box-shadow: none; }
    .dropdown-item:active { background-color: var(--primary-purple); }
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
            70% { opacity: 0.6; transform: scale(1.1); }
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

    <nav class="navbar navbar-custom shadow-sm">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-3">
                <button class="navbar-toggler text-white border-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu">
                    <i class="fa-solid fa-bars-staggered fs-4"></i>
                </button>
                <a class="navbar-brand text-white d-flex align-items-center mb-0" href="#">
                    <i class="fa-solid fa-mobile-screen-button me-2"></i>
                    SAMSUNG <span class="fw-light ms-2 d-none d-sm-inline opacity-75">Admin</span>
                </a>
            </div>
            
            <div class="d-flex align-items-center gap-3">
                <div class="position-relative cursor-pointer text-white" title="Notificações">
                    <i class="fa-regular fa-bell fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-light" style="font-size: 0.5rem;">
                        3
                    </span>
                </div>
                <div class="vr mx-2 opacity-25 text-white"></div>
                <div class="dropdown">
                    <div class="d-flex align-items-center gap-2 cursor-pointer" data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=fff&color=6f42c1&bold=true" class="rounded-circle border border-2 border-white" width="35" alt="Avatar">
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-3 rounded-4">
                        <li><h6 class="dropdown-header">Olá, Administrador</h6></li>
                        <li><a class="dropdown-item py-2" href="#"><i class="fa-regular fa-circle-user me-2"></i>Meu Perfil</a></li>
                        <li><a class="dropdown-item py-2" href="#"><i class="fa-regular fa-gear me-2"></i>Configurações</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item py-2 text-danger" href="javascript:void(0)" onclick="logout()"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i>Sair</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="offcanvas offcanvas-start border-0 shadow" tabindex="-1" id="sidebarMenu" style="width: 280px; background: var(--bg-page);">
    <div class="offcanvas-header border-bottom py-4" style="background: var(--primary-purple);">
        <h5 class="offcanvas-title text-white fw-bold" id="offcanvasLabel">
            <i class="fa-solid fa-sliders me-2"></i>MENU GESTOR
        </h5>
        <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="list-group list-group-flush mt-3">
            <a href="/inicio" class="list-group-item list-group-item-action border-0 px-4 py-3 d-flex align-items-center gap-3">
                <i class="fa-solid fa-house text-primary" style="width: 20px;"></i>
                <span class="fw-600">Dashboard Geral</span>
            </a>
            <a href="/index" class="list-group-item list-group-item-action border-0 px-4 py-3 d-flex align-items-center gap-3">
                <i class="fa-solid fa-plus-circle text-success" style="width: 20px;"></i>
                <span class="fw-600">Adicionar Aparelho</span>
            </a>
            <a href="/visualiza_loja" class="list-group-item list-group-item-action border-0 px-4 py-3 d-flex align-items-center gap-3">
                <i class="fa-solid fa-boxes-stacked text-warning" style="width: 20px;"></i>
                <span class="fw-600">Controle de Estoque</span>
            </a>
            <div class="px-4 py-2 mt-3 mb-1 small text-uppercase fw-bold text-muted" style="letter-spacing: 1px; font-size: 0.7rem;">Conta e Segurança</div>
            <a href="#" class="list-group-item list-group-item-action border-0 px-4 py-3 d-flex align-items-center gap-3">
                <i class="fa-solid fa-user-gear text-secondary" style="width: 20px;"></i>
                <span class="fw-600">Meu Perfil</span>
            </a>
            <a href="#" class="list-group-item list-group-item-action border-0 px-4 py-3 d-flex align-items-center gap-3 position-relative">
                <i class="fa-solid fa-bell text-secondary" style="width: 20px;"></i>
                <span class="fw-600">Notificações</span>
                <span class="badge rounded-pill bg-primary ms-auto">3</span>
            </a>
            <hr class="mx-4 my-2">
            <a href="javascript:void(0)" onclick="logout()" class="list-group-item list-group-item-action border-0 px-4 py-3 d-flex align-items-center gap-3 text-danger">
                <i class="fa-solid fa-power-off" style="width: 20px;"></i>
                <span class="fw-bold">Encerrar Sessão</span>
            </a>
        </div>
        
        <div class="mt-auto p-4">
            <div class="card bg-light border-0 rounded-4 p-3">
                <small class="text-muted d-block mb-1">Status do Servidor</small>
                <div class="d-flex align-items-center gap-2">
                    <div class="status-dot" style="width: 10px; height: 10px; background: #2ecc71; border-radius: 50%;"></div>
                    <span class="small fw-bold">Online</span>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="container pb-5">
        <div class="breadcrumb-custom d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <i class="fa-solid fa-house" style="color: var(--primary-purple);"></i>
                <span class="text-muted">/</span>
                <span class="fw-bold" style="color: var(--dark-purple);">Portal</span>
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
                                <a href="/inicio" class="btn btn-light border w-50" style="border-radius: 12px;">
                                    Cancelar
                                </a>
                                <button type="button" onclick="deletarAparelho({{$loja->id}})" class="btn btn-outline-danger w-50" style="border-radius: 12px;">
                                    <i class="fa-regular fa-trash-can me-1"></i> Deletar
                                </button>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const API_URL = '/api';
        const userToken = localStorage.getItem('user_token');

        // Carregar produtos usando o token na URL
        async function carregarProdutos() {
            const tabela = document.getElementById('tabelaCorpo');
            const loader = document.getElementById('loader');
            tabela.innerHTML = ''; 
            loader.classList.remove('d-none');

            try {
                const response = await fetch(`${API_URL}/todos_samsung?token=${userToken}`);
                if (response.status === 401) window.location.href = '/login';
                
                const data = await response.json();

                if (data.samsung) {
                    data.samsung.forEach(item => {
                        const isEditing = item.id == document.getElementById('id_loja').value;
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

        function deletarAparelho(id) {
            Swal.fire({
                title: 'Tem certeza?',
                text: "Esta ação não pode ser desfeita!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sim, deletar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Aqui você chamaria sua API de delete passando o token
                    window.location.href = `/deleta_samsung/${id}?token=${userToken}`;
                }
            })
        }

        $(document).ready(function () {
            carregarProdutos();

            $("#salvaraparelho").click(function () {
                const btn = $(this);
                btn.prop('disabled', true).html('<i class="fa-solid fa-circle-notch fa-spin me-2"></i> PROCESSANDO...');

                $.ajax({
                    // Enviando o token via parâmetro na URL para o Middleware capturar
                    url: `../api/altera_loja?token=${userToken}`,
                    method: "PUT",
                    data: {
                        cor: $("#cor").val(),
                        ano: $("#ano").val(),
                        modelo: $("#modelo").val(),
                        aparelho: $("#aparelho").val(),
                        id_loja: $("#id_loja").val()
                    },
                    success: function (res) {
                        Swal.fire('Sucesso!', 'Produto atualizado com sucesso.', 'success')
                        .then(() => {
                            window.location.href = '/inicio';
                        });
                    },
                    error: function (xhr) {
                        if(xhr.status === 401) {
                            window.location.href = '/login';
                        } else {
                            Swal.fire('Erro', 'Falha ao atualizar registro.', 'error');
                            btn.prop('disabled', false).html('<i class="fa-solid fa-check-double me-2"></i> ATUALIZAR REGISTRO');
                        }
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>