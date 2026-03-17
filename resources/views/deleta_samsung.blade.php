<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samsung - Deletar Produto</title>
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
        }

        .navbar-custom { 
            background: linear-gradient(135deg, var(--primary-purple), var(--dark-purple));
            padding: 1.5rem 0;
            border-bottom: 4px solid rgba(255,255,255,0.1);
        }

        .card { 
            border: none; 
            border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(111, 66, 193, 0.05);
            transition: transform 0.3s ease;
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

        .btn-delete {
            background-color: #dc3545;
        }
        .btn-delete:hover {
            background-color: #bb2d3b;
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
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
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }

        .alert-custom {
            background-color: #fff5f5;
            border-left: 4px solid #dc3545;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }

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
        }

        .info-value {
            font-weight: 600;
            color: var(--primary-purple);
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center gap-2">
                <i class="fa-solid fa-house" style="color: var(--primary-purple);"></i>
                <span class="text-muted">/</span>
                <span class="text-muted">Deletar Produto</span>
            </div>
        </div>

        <div class="alert-custom d-flex align-items-center">
            <i class="fa-solid fa-circle-exclamation me-3" style="color: #dc3545; font-size: 1.5rem;"></i>
            <div>
                <strong>Atenção!</strong> Esta ação removerá o item permanentemente do banco de dados.
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card p-2">
                    <div class="card-header-custom">
                        <i class="fa-solid fa-trash-can" style="color: #dc3545;"></i> Confirmar Deleção
                    </div>
                    <div class="card-body">
                        <div class="product-info mb-4">
                            <div class="row g-2">
                                <div class="col-6">
                                    <div class="info-label">ID</div>
                                    <div class="info-value">#{{ $loja->id }}</div>
                                </div>
                                <div class="col-6">
                                    <div class="info-label">Aparelho</div>
                                    <div class="info-value">{{ $loja->aparelho }}</div>
                                </div>
                            </div>
                        </div>

                        <form id="formSamsung">
                            <input type="hidden" id="aparelho" value="{{ $loja->aparelho }}">
                            <input type="hidden" id="modelo" value="{{ $loja->modelo }}">
                            <input type="hidden" id="cor" value="{{ $loja->cor }}">
                            <input type="hidden" id="ano" value="{{ $loja->ano }}">

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="confirmDelete">
                                <label class="form-check-label small text-danger fw-bold" for="confirmDelete">
                                    ESTOU CIENTE E DESEJO EXCLUIR
                                </label>
                            </div>

                            <button type="button" id="btnDeletar" class="btn btn-purple btn-delete w-100 mt-2" disabled>
                                <i class="fa-solid fa-trash-can me-2"></i> DELETAR AGORA
                            </button>
                            <a href="/inicio" class="btn btn-light w-100 mt-2 border">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card overflow-hidden">
                    <div class="card-header-custom justify-content-between">
                        <div><i class="fa-solid fa-list-check"></i> Itens no Banco</div>
                        <button onclick="carregarProdutos()" class="btn btn-sm text-primary p-0"><i class="fa-solid fa-sync"></i></button>
                    </div>
                    <div class="table-responsive" style="max-height: 450px;">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Aparelho</th>
                                    <th>Modelo</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody id="tabelaCorpo"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const API_URL = '/api';
        const userToken = localStorage.getItem('user_token');

        async function carregarProdutos() {
            const tabela = document.getElementById('tabelaCorpo');
            tabela.innerHTML = '<tr><td colspan="4" class="text-center py-4"><div class="spinner-border spinner-border-sm text-primary"></div></td></tr>';

            try {
                const response = await fetch(`${API_URL}/todos_samsung?token=${userToken}`);
                if (response.status === 401) window.location.href = '/login';
                
                const data = await response.json();
                tabela.innerHTML = '';

                if (data.samsung) {
                    data.samsung.forEach(item => {
                        const isCurrent = item.id == {{ $loja->id }};
                        tabela.innerHTML += `
                            <tr class="${isCurrent ? 'table-danger' : ''}">
                                <td><span class="badge-id">#${item.id}</span></td>
                                <td><span class="fw-bold">${item.aparelho}</span></td>
                                <td>${item.modelo}</td>
                                <td>${isCurrent ? '<span class="badge bg-danger">Selecionado</span>' : '-'}</td>
                            </tr>`;
                    });
                }
            } catch (error) {
                tabela.innerHTML = '<tr><td colspan="4" class="text-center text-danger">Erro ao carregar dados.</td></tr>';
            }
        }

        $(document).ready(function () {
            carregarProdutos();

            $('#confirmDelete').change(function() {
                $('#btnDeletar').prop('disabled', !this.checked);
            });

            $("#btnDeletar").click(function () {
                const btn = $(this);
                
                Swal.fire({
                    title: 'Confirmar Exclusão?',
                    text: "Você não poderá reverter isso!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i>');

                        $.ajax({
                            url: `${API_URL}/d_samsung?token=${userToken}`,
                            method: "DELETE",
                            data: {
                                id_loja: $("#id_loja").val(),
                                aparelho: $("#aparelho").val(),
                                modelo: $("#modelo").val(),
                                cor: $("#cor").val(),
                                ano: $("#ano").val()
                            },
                            success: function () {
                                Swal.fire('Deletado!', 'O produto foi removido.', 'success')
                                .then(() => window.location.href = '/inicio');
                            },
                            error: function (xhr) {
                                Swal.fire('Erro!', 'Não foi possível deletar.', 'error');
                                btn.prop('disabled', false).html('<i class="fa-solid fa-trash-can me-2"></i> DELETAR AGORA');
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>