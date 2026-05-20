<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samsung - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary-purple: #6f42c1;
            --dark-purple: #2d1b4e;
            --bg-gradient: linear-gradient(135deg, #007aff 0%, #003a7a 100%);
        }

        body { 
            background: var(--bg-gradient);
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 28px;
            padding: 50px 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.2);
        }

        .brand-logo {
            font-weight: 800;
            font-size: 1.6rem;
            color: var(--dark-purple);
            text-align: center;
            margin-bottom: 40px;
            letter-spacing: 1px;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px 15px;
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(111, 66, 193, 0.1);
            border-color: var(--primary-purple);
        }

        .btn-auth {
            background: var(--primary-purple);
            color: white;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            width: 100%;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-auth:hover {
            background: var(--dark-purple);
            transform: translateY(-2px);
        }

        .btn-2fa {
            background: linear-gradient(135deg, #28a745, #218838);
            color: white;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            border: none;
            font-size: 0.9rem;
            margin-top: 15px;
        }

        .btn-2fa:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }

        .btn-2fa i {
            margin-right: 8px;
        }

        /* Botão Esqueci a Senha */
        .btn-esqueci {
            background: none;
            border: none;
            color: var(--primary-purple);
            font-size: 0.82rem;
            font-weight: 600;
            padding: 0;
            cursor: pointer;
            text-decoration: none;
            transition: color 0.2s;
        }

        .btn-esqueci:hover {
            color: var(--dark-purple);
            text-decoration: underline;
        }

        .divider {
            text-align: center;
            margin: 20px 0;
            position: relative;
        }

        .divider::before,
        .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 45%;
            height: 1px;
            background: #dee2e6;
        }

        .divider::before { left: 0; }
        .divider::after  { right: 0; }

        .divider span {
            background: white;
            padding: 0 10px;
            color: #6c757d;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

<div class="auth-card">
    <div class="brand-logo">
        <i class="fa-solid fa-mobile-screen-button me-2 text-primary"></i>
        SAMSUNG
    </div>

    <h4 class="fw-bold mb-4 text-center">Acesse sua conta</h4>

    <form id="formLogin">
        <div class="mb-3">
            <label class="form-label fw-bold small">E-mail Corporativo</label>
            <input type="email" id="email" class="form-control" placeholder="nome@samsung.com" required>
        </div>

        <div class="mb-1">
            <label class="form-label fw-bold small">Senha</label>
            <input type="password" id="senha" class="form-control" placeholder="••••••••" required>
        </div>

        <!-- Link Esqueci a Senha -->
        <div class="text-end mb-4">
            <button type="button" class="btn-esqueci" id="btnEsqueciSenha">
                <i class="fa-solid fa-key me-1" style="font-size: 0.75rem;"></i>Esqueci minha senha
            </button>
        </div>

        <button type="button" id="btnLogin" class="btn btn-auth">
            <i class="fa-solid fa-right-to-bracket me-2"></i>Entrar no Portal
        </button>

        <div class="divider">
            <span>ou</span>
        </div>
        
        <button type="button" id="btnAtivar2FA" class="btn-2fa">
            <i class="fa-solid fa-shield-haltered"></i>
            Ativar Autenticação de Dois Fatores
        </button>

        <div class="text-center mt-4">
            <p class="small">Não tem conta? <a href="/cadastro" class="text-decoration-none fw-bold" style="color: var(--primary-purple);">Cadastre-se</a></p>
            <p class="small text-muted">Administrador? <a href="/login_admin" class="text-decoration-none fw-bold" style="color: var(--dark-purple);">Vá por aqui</a></p>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {

    // ──────────────────────────────────────────
    // LOGIN
    // ──────────────────────────────────────────
    $("#btnLogin").click(function() {
        if ($("#email").val() === "" || $("#senha").val() === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Campos obrigatórios',
                text: 'Preencha todos os campos para fazer login.'
            });
            return;
        }

        $.ajax({
            url: "/api/login_usuario",
            method: "POST",
            data: { 
                email: $("#email").val(),
                senha: $("#senha").val()
            },
            success: function(response) {
                if (response['erro'] == 'n' && response['msg'] == 'Usuário Logado') {
                    $.cookie('token', response['token'], { expires: 7, path: '/' });
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Login realizado!',
                        text: 'Redirecionando para o painel...',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    
                    setTimeout(function() {
                        window.location.href = "/inicio";
                    }, 2000);
                } else {
                    if (response['msg'] == 'autentica_ativa') {
                        localStorage.setItem('email_2fa', $("#email").val());
                        
                        Swal.fire({
                            icon: 'info',
                            title: 'Autenticação de dois fatores',
                            text: 'Digite o código enviado para seu e-mail',
                            confirmButtonText: 'OK'
                        });
                        
                        setTimeout(function() {
                            window.location.href = "/digita_codigo";
                        }, 1500);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro no login',
                            text: response['msg'] || 'Email ou senha inválidos.'
                        });
                    }
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro de conexão',
                    text: 'Não foi possível conectar ao servidor.'
                });
            }
        });
    });

    // ──────────────────────────────────────────
    // ESQUECI A SENHA — Etapa 1: solicitar código
    // ──────────────────────────────────────────
    $("#btnEsqueciSenha").click(function() {
        const emailDigitado = $("#email").val();

        Swal.fire({
            icon: 'info',
            title: 'Recuperar senha',
            html: `
                <p class="text-muted small mb-3">Digite seu e-mail para receber o código de recuperação.</p>
                <input type="email" id="emailRecupera" class="swal2-input" 
                       placeholder="seu@email.com" value="${emailDigitado}">
            `,
            confirmButtonText: 'Enviar código',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const email = document.getElementById('emailRecupera').value;
                if (!email) {
                    Swal.showValidationMessage('Informe um e-mail válido');
                    return false;
                }
                return email;
            }
        }).then((result) => {
            if (!result.isConfirmed) return;

            const email = result.value;

            // Chama o endpoint de solicitar recuperação
            $.ajax({
                url: "/api/solicitar_recuperacao",
                method: "POST",
                data: { email: email },
                success: function(response) {
                    if (response.erro == 'n') {
                        // Etapa 2: digitar código + nova senha
                        Swal.fire({
                            icon: 'success',
                            title: 'Código enviado!',
                            html: `
                                <p class="text-muted small mb-3">Verifique seu e-mail e preencha os campos abaixo.</p>
                                <input type="text" id="codigoRecupera" class="swal2-input" 
                                       placeholder="Código de 6 dígitos" maxlength="6">
                                <input type="password" id="novaSenha" class="swal2-input mt-2" 
                                       placeholder="Nova senha">
                                <input type="password" id="confirmaSenha" class="swal2-input mt-2" 
                                       placeholder="Confirme a nova senha">
                            `,
                            confirmButtonText: 'Redefinir senha',
                            showCancelButton: true,
                            cancelButtonText: 'Cancelar',
                            preConfirm: () => {
                                const codigo    = document.getElementById('codigoRecupera').value;
                                const novaSenha = document.getElementById('novaSenha').value;
                                const confirma  = document.getElementById('confirmaSenha').value;

                                if (!codigo || codigo.length !== 6) {
                                    Swal.showValidationMessage('O código deve ter 6 dígitos');
                                    return false;
                                }
                                if (!novaSenha || novaSenha.length < 6) {
                                    Swal.showValidationMessage('A senha deve ter no mínimo 6 caracteres');
                                    return false;
                                }
                                if (novaSenha !== confirma) {
                                    Swal.showValidationMessage('As senhas não coincidem');
                                    return false;
                                }
                                return { codigo, novaSenha };
                            }
                        }).then((etapa2) => {
                            if (!etapa2.isConfirmed) return;

                            // Etapa 3: confirmar código e salvar nova senha
                            $.ajax({
                                url: "/api/confirmar_recuperacao",
                                method: "POST",
                                data: {
                                    email:      email,
                                    codigo:     etapa2.value.codigo,
                                    nova_senha: etapa2.value.novaSenha
                                },
                                success: function(res) {
                                    if (res.erro == 'n') {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Senha redefinida!',
                                            text: 'Sua senha foi alterada com sucesso. Faça login.',
                                            confirmButtonText: 'OK'
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Erro',
                                            text: res.msg || 'Código inválido ou expirado.'
                                        });
                                    }
                                },
                                error: function() {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Erro',
                                        text: 'Não foi possível redefinir a senha.'
                                    });
                                }
                            });
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro',
                            text: response.msg || 'E-mail não encontrado.'
                        });
                    }
                },
                error: function(xhr) {
                    const msg = xhr.responseJSON?.msg || 'E-mail não encontrado.';
                    Swal.fire({ icon: 'error', title: 'Erro', text: msg });
                }
            });
        });
    });

    // ──────────────────────────────────────────
    // ATIVAR 2FA
    // ──────────────────────────────────────────
    $("#btnAtivar2FA").click(function() {
        const email = $("#email").val();
        
        if (!email) {
            Swal.fire({
                icon: 'warning',
                title: 'E-mail necessário',
                text: 'Digite seu e-mail para ativar a autenticação de dois fatores.'
            });
            return;
        }

        $.ajax({
            url: "/api/ativar_2fa",
            method: "POST",
            data: { email: email },
            success: function(response) {
                if (response.erro == 'n') {
                    console.log('Código gerado:', response.codigo);
                    
                    Swal.fire({
                        icon: 'info',
                        title: 'Código gerado!',
                        html: `
                            <hr>
                            <input type="text" id="codigoConfirmacao" class="swal2-input mt-3" placeholder="Digite o código aqui" maxlength="6">
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'Confirmar e Ativar',
                        cancelButtonText: 'Cancelar',
                        preConfirm: () => {
                            const codigo = document.getElementById('codigoConfirmacao').value;
                            if (!codigo || codigo.length !== 6) {
                                Swal.showValidationMessage('Digite o código de 6 dígitos');
                                return false;
                            }
                            return { codigo: codigo };
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "/api/confirmar_ativar_2fa",
                                method: "POST",
                                data: { email: email, codigo: result.value.codigo },
                                success: function(confirmResponse) {
                                    if (confirmResponse.erro == 'n') {
                                        Swal.fire({
                                            icon: 'success',
                                            title: '2FA Ativado!',
                                            text: 'Autenticação de dois fatores ativada com sucesso!',
                                            confirmButtonText: 'OK'
                                        });
                                    } else {
                                        Swal.fire({ icon: 'error', title: 'Erro', text: confirmResponse.msg });
                                    }
                                },
                                error: function() {
                                    Swal.fire({ icon: 'error', title: 'Erro', text: 'Não foi possível confirmar o código.' });
                                }
                            });
                        }
                    });
                } else {
                    Swal.fire({ icon: 'error', title: 'Erro', text: response.msg });
                }
            },
            error: function() {
                Swal.fire({ icon: 'error', title: 'Erro', text: 'Erro ao gerar código. Verifique o console.' });
            }
        });
    });

    // Enter no formulário
    $("#formLogin").on('keypress', function(e) {
        if (e.which === 13) {
            $("#btnLogin").click();
        }
    });
});
</script>
</body>
</html>