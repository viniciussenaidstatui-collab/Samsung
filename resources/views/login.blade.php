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

        <div class="mb-4">
            <label class="form-label fw-bold small">Senha</label>
            <input type="password" id="senha" class="form-control" placeholder="••••••••" required>
        </div>

        <button type="button" id="btnLogin" class="btn btn-auth">
            <i class="fa-solid fa-right-to-bracket me-2"></i>Entrar no Portal
        </button>

        <div class="text-center mt-4">
            <p class="small">Não tem conta? <a href="/cadastro" class="text-decoration-none fw-bold" style="color: var(--primary-purple);">Cadastre-se</a></p>

            <p class="small text-muted">Administrador? <a href="/login_admin" class="text-decoration-none fw-bold" style="color: var(--dark-purple);">Vá por aqui</a></p>
</div>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
    $("#btnLogin").click(function() {
        // Validação básica
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
                        Swal.fire({
                            icon: 'info',
                            title: 'Autenticação de dois fatores',
                            text: 'Autenticação de dois fatores ativa, por favor digite o código.'
                        });
                        setTimeout(function() {
                            window.location.href = "/digita_codigo";
                        }, 2000);
                    }
                }
            },
            error: function(xhr) {
                console.log("Erro ao fazer login:", xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Erro de conexão',
                    text: 'Não foi possível conectar ao servidor.'
                });
            }
        });
    });

    // Permitir login ao pressionar Enter no formulário
    $("#formLogin").on('keypress', function(e) {
        if (e.which === 13) { // Tecla Enter
            $("#btnLogin").click();
        }
    });
});
</script>
</body>
</html>