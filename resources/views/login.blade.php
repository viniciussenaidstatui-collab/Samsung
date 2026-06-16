<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samsung - Login</title>
    
    <!-- Bootstrap e outros -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    
    <!-- jQuery, Cookie, SweetAlert2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #1b1f2a;
            position: relative;
            overflow: hidden;
        }

        /* ============================================
           FUNDO COM ANIMAÇÃO (estilo Aerial)
           ============================================ */
        
        /* Container do fundo */
        .bg-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 300%;
            height: 100%;
            z-index: 0;
            animation: bgMove 60s linear infinite;
        }

        /* Sua imagem como fundo */
        .bg-container .bg-image {
            width: 100%;
            height: 100%;
            background: url("/images/Walp_Login.jpg") bottom left / auto 100% repeat-x;
            background-size: 1500px auto;
        }

        /* Animação de movimento (parallax) */
        @keyframes bgMove {
            0% {
                transform: translate3d(0, 0, 0);
            }
            100% {
                transform: translate3d(-1500px, 0, 0);
            }
        }

        /* Overlay escuro para contraste */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(27, 31, 42, 0.6);
            background-image: linear-gradient(135deg, rgba(0, 58, 122, 0.5) 0%, rgba(45, 27, 78, 0.7) 100%);
            z-index: 1;
            animation: overlayFade 1.5s 0.5s forwards;
            opacity: 0;
        }

        @keyframes overlayFade {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        /* Container principal */
        .login-wrapper {
            position: relative;
            z-index: 2;
            padding: 20px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            animation: wrapperFade 3s forwards;
            opacity: 0;
        }

        @keyframes wrapperFade {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        :root {
            --primary-purple: #6f42c1;
            --dark-purple: #2d1b4e;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 28px;
            padding: 50px 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
            animation: fadeInUp 0.8s 2s forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.98);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .brand-logo {
            font-weight: 800;
            font-size: 1.6rem;
            color: var(--dark-purple);
            text-align: center;
            margin-bottom: 40px;
            letter-spacing: 1px;
        }

        .brand-logo i {
            color: #007aff;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 6px;
            color: #333;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px 15px;
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            width: 100%;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(111, 66, 193, 0.1);
            border-color: var(--primary-purple);
            outline: none;
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
            font-size: 1rem;
            cursor: pointer;
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
            cursor: pointer;
        }

        .btn-2fa:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }

        .btn-2fa i {
            margin-right: 8px;
        }

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

        .link-cadastro {
            color: var(--primary-purple);
            text-decoration: none;
            font-weight: 700;
        }

        .link-cadastro:hover {
            text-decoration: underline;
        }

        .link-admin {
            color: var(--dark-purple);
            text-decoration: none;
            font-weight: 700;
        }

        .link-admin:hover {
            text-decoration: underline;
        }

        .text-muted-custom {
            color: #6c757d;
            font-size: 0.85rem;
        }

        /* Responsivo */
        @media (max-width: 480px) {
            .auth-card {
                padding: 30px 20px;
            }
            .brand-logo {
                font-size: 1.3rem;
                margin-bottom: 30px;
            }
            
            /* Ajuste da animação para telas menores */
            .bg-container .bg-image {
                background-size: 750px auto;
            }
            
            @keyframes bgMove {
                0% {
                    transform: translate3d(0, 0, 0);
                }
                100% {
                    transform: translate3d(-750px, 0, 0);
                }
            }
        }

        @media (max-width: 768px) {
            .bg-container .bg-image {
                background-size: 1000px auto;
            }
            
            @keyframes bgMove {
                0% {
                    transform: translate3d(0, 0, 0);
                }
                100% {
                    transform: translate3d(-1000px, 0, 0);
                }
            }
        }
    </style>
</head>
<body>

<!-- FUNDO COM ANIMAÇÃO -->
<div class="bg-container">
    <div class="bg-image"></div>
</div>

<!-- OVERLAY -->
<div class="overlay"></div>

<!-- CONTEÚDO PRINCIPAL -->
<div class="login-wrapper">
    <div class="auth-card">
        <div class="brand-logo">
            <i class="fa-solid fa-mobile-screen-button me-2"></i>
            SAMSUNG
        </div>

        <h4 class="fw-bold mb-4 text-center" style="font-weight: 700; color: #1b1f2a;">Acesse sua conta</h4>

        <form id="formLogin">
            <div class="mb-3">
                <label class="form-label">E-mail Corporativo</label>
                <input type="email" id="email" class="form-control" placeholder="nome@samsung.com" required>
            </div>

            <div class="mb-1">
                <label class="form-label">Senha</label>
                <input type="password" id="senha" class="form-control" placeholder="••••••••" required>
            </div>

            <div class="text-end mb-4">
                <button type="button" class="btn-esqueci" id="btnEsqueciSenha">
                    <i class="fa-solid fa-key me-1" style="font-size: 0.75rem;"></i>Esqueci minha senha
                </button>
            </div>

            <button type="button" id="btnLogin" class="btn-auth">
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
                <p class="text-muted-custom">Não tem conta? <a href="/cadastro" class="link-cadastro">Cadastre-se</a></p>
                <p class="text-muted-custom">Administrador? <a href="/login_admin" class="link-admin">Vá por aqui</a></p>
            </div>
        </form>
    </div>
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
        // ESQUECI A SENHA
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

                $.ajax({
                    url: "/api/solicitar_recuperacao",
                    method: "POST",
                    data: { email: email },
                    success: function(response) {
                        if (response.erro == 'n') {
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