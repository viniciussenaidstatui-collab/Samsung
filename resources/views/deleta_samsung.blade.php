<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samsung - Deletar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
            background: linear-gradient(135deg, var(--bg-page) 0%, #fff 100%);
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: #444;
            min-height: 100vh;
        }

        .navbar-custom { 
            background: linear-gradient(135deg, var(--primary-purple), var(--dark-purple));
            padding: 1.2rem 0;
            border-bottom: 4px solid rgba(255,255,255,0.1);
        }

        .card { 
            border: none; 
            border-radius: 28px; 
            box-shadow: 0 20px 40px rgba(111, 66, 193, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(111, 66, 193, 0.12);
        }

        .card-header-custom {
            background: linear-gradient(135deg, rgba(111,66,193,0.03), rgba(111,66,193,0.08));
            border-bottom: 2px solid var(--soft-purple);
            padding: 24px 28px;
            font-weight: 700;
            color: var(--primary-purple);
            display: flex;
            align-items: center;
            gap: 12px;
            border-radius: 28px 28px 0 0;
            font-size: 1.2rem;
        }

        .form-control {
            border-radius: 14px;
            border: 1px solid #e5e5e5;
            padding: 12px 16px;
            background-color: #fdfdfd;
            transition: all 0.2s;
        }
        .form-control:focus {
            border-color: var(--primary-purple);
            box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.1);
        }

        .form-control:disabled {
            background-color: var(--soft-purple);
            opacity: 0.8;
            cursor: not-allowed;
        }

        .btn-purple { 
            background: linear-gradient(135deg, var(--primary-purple), var(--dark-purple));
            color: white; 
            font-weight: 600; 
            border-radius: 14px; 
            padding: 12px;
            border: none;
            transition: all 0.3s;
        }
        .btn-purple:hover { 
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(111, 66, 193, 0.3);
            color: white;
        }

        .btn-delete {
            background: linear-gradient(135deg, #dc3545, #bb2d3b);
        }
        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(220, 53, 69, 0.3);
        }

        .btn-cancel {
            border-radius: 14px;
            padding: 12px;
            font-weight: 500;
            transition: all 0.2s;
        }
        .btn-cancel:hover {
            background-color: #f8f9fa;
            transform: translateY(-1px);
        }

        .badge-id { 
            background: linear-gradient(135deg, var(--soft-purple), #e9e4ff);
            color: var(--primary-purple); 
            padding: 8px 16px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .status-dot {
            height: 10px;
            width: 10px;
            background-color: #2ecc71;
            border-radius: 50%;
            display: inline-block;
            margin-right: 6px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.2); }
        }

        .badge-purple {
            background: linear-gradient(135deg, var(--primary-purple), var(--dark-purple));
            color: white;
            padding: 6px 14px;
            border-radius: 10px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .alert-custom {
            background: linear-gradient(135deg, #fff3e0, #ffe8cc);
            border-left: 5px solid #ff9800;
            border-radius: 16px;
            padding: 18px 22px;
            margin-bottom: 28px;
        }

        .product-info {
            background: linear-gradient(135deg, white, var(--soft-purple));
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 24px;
            border: 1px solid rgba(111,66,193,0.15);
        }

        .info-label {
            color: var(--dark-purple);
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-weight: 600;
        }

        .info-value {
            font-weight: 700;
            color: var(--primary-purple);
            font-size: 1.1rem;
            margin-top: 4px;
        }

        .icon-shield {
            background: rgba(220, 53, 69, 0.1);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container-custom {
            max-width: 700px;
            margin: 0 auto;
        }

        .form-check-input:checked {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        hr {
            background: linear-gradient(90deg, transparent, var(--primary-purple), transparent);
            height: 1px;
            opacity: 0.2;
        }
    </style>
</head>
<body>
    @php
        // Verificação de segurança
        if(!isset($samsung) || !$samsung) {
            echo '<div class="alert alert-danger m-5">Produto não encontrado! <a href="/index">Voltar</a></div>';
            exit;
        }
    @endphp

    <input type="hidden" id="id_loja" value="{{ $samsung->id }}">

<nav class="navbar navbar-custom mb-4 shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand text-white fw-bold" href="#">
            <i class="fa-solid fa-mobile-screen-button me-2"></i> SAMSUNG/STORE
        </a>
        <div class="d-flex align-items-center gap-4">
            <span class="text-white-50 small">
                <span class="status-dot"></span> Sistema Ativo
            </span>
            <span class="badge-purple">
                <i class="fa-regular fa-user me-1"></i> Admin
            </span>
        </div>
    </div>
</nav>

<div class="container container-custom pb-5">
    <!-- Breadcrumb -->
    <div class="d-flex align-items-center gap-2 mb-4">
        <i class="fa-solid fa-house" style="color: var(--primary-purple);"></i>
        <span class="text-muted">/</span>
        <span class="text-muted">Deletar Produto</span>
        <span class="text-muted">/</span>
        <span class="text-dark fw-semibold">Confirmar Exclusão</span>
    </div>

    <!-- Alerta de confirmação -->
    <div class="alert-custom d-flex align-items-start">
        <div class="icon-shield me-3 flex-shrink-0">
            <i class="fa-solid fa-triangle-exclamation" style="color: #ff9800; font-size: 1.5rem;"></i>
        </div>
        <div>
            <strong class="d-block mb-1" style="font-size: 1rem;">⚠️ Atenção! Operação Irreversível</strong>
            <span class="small">Você está prestes a deletar o produto abaixo permanentemente. Esta ação não pode ser desfeita.</span>
        </div>
    </div>

    <!-- Card de deleção centralizado -->
    <div class="card">
        <div class="card-header-custom">
            <i class="fa-solid fa-trash-can" style="color: #dc3545; font-size: 1.3rem;"></i> 
            Exclusão de Produto
            <span class="ms-auto badge-id">
                <i class="fa-regular fa-clock me-1"></i> {{ date('d/m/Y') }}
            </span>
        </div>
        <div class="card-body p-4">
            
            <!-- Resumo do produto sendo deletado -->
            <div class="product-info">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <i class="fa-solid fa-box-open" style="color: var(--primary-purple);"></i>
                    <span class="info-label">PRODUTO SELECIONADO PARA EXCLUSÃO</span>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="info-label">ID DO PRODUTO</div>
                        <div class="info-value">
                            <i class="fa-regular fa-hashtag me-1"></i>{{ $samsung->id }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-label">APARELHO</div>
                        <div class="info-value">{{ $samsung->aparelho }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-label">MODELO</div>
                        <div class="info-value">{{ $samsung->modelo }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-label">COR / ANO</div>
                        <div class="info-value">{{ $samsung->cor }} / {{ $samsung->ano }}</div>
                    </div>
                </div>
            </div>

            <form id="formSamsung">
                <div class="mb-3">
                    <label class="form-label small text-uppercase fw-bold text-secondary">
                        <i class="fa-solid fa-mobile me-1"></i>Aparelho
                    </label>
                    <input value="{{ $samsung->aparelho }}" disabled type="text" id="aparelho" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label small text-uppercase fw-bold text-secondary">
                        <i class="fa-solid fa-microchip me-1"></i>Modelo
                    </label>
                    <input value="{{ $samsung->modelo }}" disabled type="text" id="modelo" class="form-control">
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label small text-uppercase fw-bold text-secondary">
                            <i class="fa-solid fa-palette me-1"></i>Cor
                        </label>
                        <input value="{{ $samsung->cor }}" disabled type="text" id="cor" class="form-control">
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label small text-uppercase fw-bold text-secondary">
                            <i class="fa-solid fa-calendar me-1"></i>Ano
                        </label>
                        <input value="{{ $samsung->ano }}" disabled type="number" id="ano" class="form-control">
                    </div>
                </div>
                
                <hr class="my-4">

                <!-- Confirmação adicional com estilo melhorado -->
                <div class="form-check mb-4 p-3" style="background-color: rgba(220, 53, 69, 0.05); border-radius: 14px;">
                    <input class="form-check-input" type="checkbox" id="confirmDelete" style="cursor: pointer; transform: scale(1.1);">
                    <label class="form-check-label text-danger fw-semibold" for="confirmDelete" style="cursor: pointer;">
                        <i class="fa-solid fa-check-circle me-1"></i> Confirmo que desejo deletar este produto permanentemente
                    </label>
                </div>

                <button type="button" id="salvaraparelho" class="btn btn-purple btn-delete w-100 mb-2" disabled>
                    <i class="fa-solid fa-trash-can me-2"></i> DELETAR PRODUTO
                </button>
                
                <a href="/index" class="btn btn-cancel border w-100 d-flex align-items-center justify-content-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i> Cancelar e Voltar
                </a>
            </form>

            <!-- Dica de segurança -->
            <div class="text-center mt-4">
                <small class="text-muted">
                    <i class="fa-solid fa-shield-haltered me-1"></i> 
                    Produto será removido permanentemente do sistema
                </small>
            </div>
        </div>
    </div>

    <!-- Cards decorativos inferiores -->
    <div class="row mt-4 g-3">
        <div class="col-md-6">
            <div class="p-3 bg-white rounded-4 shadow-sm text-center">
                <i class="fa-solid fa-database me-2" style="color: var(--primary-purple);"></i>
                <small class="text-muted">Exclusão permanente do banco de dados</small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-3 bg-white rounded-4 shadow-sm text-center">
                <i class="fa-solid fa-clock-rotate-left me-2" style="color: var(--primary-purple);"></i>
                <small class="text-muted">Ação não pode ser desfeita</small>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // ===== VERIFICAÇÃO DE TOKEN AO CARREGAR A PÁGINA =====
        let token = $.cookie('token');
        
        console.log("=== VERIFICANDO ACESSO À PÁGINA DE DELETAR ===");
        console.log("Token encontrado:", token ? "✅ SIM" : "❌ NÃO");
        
        if (!token) {
            console.log("❌ USUÁRIO NÃO LOGADO! Bloqueando acesso...");
            
            // Desabilitar tudo
            $('#confirmDelete, #salvaraparelho').prop('disabled', true);
            
            // Mostrar alerta bonito
            Swal.fire({
                icon: 'warning',
                title: 'Acesso Negado',
                text: 'Você precisa estar logado para acessar esta página!',
                confirmButtonColor: '#6f42c1',
                confirmButtonText: 'Ir para Login',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/login';
                }
            });
            
            return; // IMPEDE O RESTO DO CÓDIGO DE EXECUTAR
        }
        
        console.log("✅ ACESSO PERMITIDO! Token válido:", token.substring(0, 15) + "...");
        
        // Controle do checkbox de confirmação
        $('#confirmDelete').change(function() {
            $('#salvaraparelho').prop('disabled', !this.checked);
            
            // Efeito visual ao habilitar
            if(this.checked) {
                $('#salvaraparelho').addClass('animate__animated animate__pulse');
                setTimeout(() => $('#salvaraparelho').removeClass('animate__animated animate__pulse'), 500);
            }
        });

        $("#salvaraparelho").click(function () {
            if(!$('#confirmDelete').is(':checked')) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Confirmação necessária',
                    text: 'Por favor, confirme que deseja deletar o produto marcando a caixa de confirmação.',
                    confirmButtonColor: '#6f42c1',
                    confirmButtonText: 'Entendi'
                });
                return;
            }

            // Usar SweetAlert para confirmação
            Swal.fire({
                title: '⚠️ Tem certeza?',
                text: "Esta ação não pode ser desfeita! O produto será removido permanentemente.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fa-solid fa-trash-can me-2"></i>Sim, deletar!',
                cancelButtonText: '<i class="fa-solid fa-times me-2"></i>Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    // PEGAR O TOKEN DO COOKIE NOVAMENTE
                    let tokenAtual = $.cookie('token');
                    
                    if (!tokenAtual) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Sessão expirada',
                            text: 'Faça login novamente para continuar.',
                            confirmButtonColor: '#6f42c1'
                        }).then(() => {
                            window.location.href = '/login';
                        });
                        return;
                    }

                    $.ajax({
                        url: "/api/d_samsung",
                        method: "DELETE",
                        data: {
                            id_loja: $("#id_loja").val(),
                            token: tokenAtual
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: '<span style="color:#6f42c1">Processando exclusão...</span>',
                                html: 'Removendo produto do sistema<br><small>Aguarde um momento</small>',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                        },
                        success: function (res) {
                            console.log(res);
                            if(res['erro'] == 'n') {
                                // ✅ SUCESSO - Mostrar mensagem de sucesso e redirecionar
                                Swal.fire({
                                    icon: 'success',
                                    title: '✅ Produto deletado!',
                                    text: 'O produto foi removido com sucesso do sistema.',
                                    timer: 2000,
                                    showConfirmButton: false,
                                    background: '#fff',
                                    backdrop: true
                                }).then(() => {
                                    window.location.href = '/index';
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erro ao deletar',
                                    text: res['msg'] || 'Não foi possível deletar o produto. Tente novamente.',
                                    confirmButtonColor: '#6f42c1'
                                });
                            }
                        },
                        error: function (xhr) {
                            console.log("Erro", xhr.responseText);
                            
                            // Tentar parsear a resposta
                            try {
                                let response = JSON.parse(xhr.responseText);
                                
                                if (xhr.status === 403) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Permissão Negada',
                                        text: response.msg || 'Você não tem permissão para deletar este produto.',
                                        confirmButtonColor: '#6f42c1'
                                    });
                                } else if (xhr.status === 401 || xhr.status === 419) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Sessão expirada',
                                        text: 'Sua sessão expirou. Faça login novamente.',
                                        confirmButtonColor: '#6f42c1'
                                    }).then(() => {
                                        window.location.href = '/login';
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Erro',
                                        text: response.msg || 'Erro ao conectar com o servidor.',
                                        confirmButtonColor: '#6f42c1'
                                    });
                                }
                            } catch(e) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erro no servidor',
                                    text: 'Não foi possível processar sua solicitação. Tente novamente.',
                                    confirmButtonColor: '#6f42c1'
                                });
                            }
                        }
                    });
                }
            });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>