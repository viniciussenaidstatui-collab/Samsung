<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samsung - Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary-purple: #6f42c1;
            --dark-purple: #2d1b4e;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1a0533 0%, #2d1b4e 40%, #0d2b52 100%);
            position: relative;
            overflow: hidden;
        }

        /* Decoração de fundo */
        body::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(111,66,193,0.25) 0%, transparent 70%);
            top: -150px;
            right: -150px;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(0,122,255,0.2) 0%, transparent 70%);
            bottom: -100px;
            left: -100px;
            pointer-events: none;
        }

        .login-wrapper {
            display: flex;
            width: 900px;
            max-width: 95vw;
            min-height: 540px;
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 40px 80px rgba(0,0,0,0.5);
            position: relative;
            z-index: 1;
        }

        /* Painel esquerdo - identidade */
        .login-left {
            flex: 1;
            background: linear-gradient(160deg, #6f42c1 0%, #2d1b4e 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 50px 40px;
            text-align: center;
        }

        .login-left .brand-icon {
            width: 80px;
            height: 80px;
            background: rgba(255,255,255,0.12);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            border: 1px solid rgba(255,255,255,0.2);
        }

        .login-left h2 {
            color: white;
            font-weight: 800;
            font-size: 1.8rem;
            letter-spacing: 2px;
            margin-bottom: 12px;
        }

        .login-left p {
            color: rgba(255,255,255,0.65);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .admin-badge {
            margin-top: 32px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            color: rgba(255,255,255,0.85);
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* Painel direito - formulário */
        .login-right {
            flex: 1;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 50px 45px;
        }

        .login-right h4 {
            font-weight: 800;
            font-size: 1.5rem;
            color: #1a0533;
            margin-bottom: 6px;
        }

        .login-right .subtitle {
            color: #888;
            font-size: 0.9rem;
            margin-bottom: 36px;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #444;
            margin-bottom: 6px;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group-custom i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 0.9rem;
            z-index: 2;
        }

        .input-group-custom input {
            width: 100%;
            padding: 13px 14px 13px 40px;
            border: 1.5px solid #e8e8f0;
            border-radius: 12px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.95rem;
            background: #fafafa;
            transition: all 0.25s ease;
            outline: none;
            color: #222;
        }

        .input-group-custom input:focus {
            border-color: var(--primary-purple);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(111,66,193,0.1);
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary-purple), #4a2a9a);
            color: white;
            border: none;
            border-radius: 12px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 8px;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #5a32a8, var(--dark-purple));
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(111,66,193,0.35);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .lock-notice {
            margin-top: 24px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #aaa;
            font-size: 0.8rem;
        }

        @media (max-width: 680px) {
            .login-left { display: none; }
            .login-right { padding: 40px 28px; }
        }
    </style>
</head>
<body>

<div class="login-wrapper">

    <!-- Esquerda -->
    <div class="login-left">
        <div class="brand-icon">
            <i class="fa-solid fa-mobile-screen-button fa-2x" style="color: white;"></i>
        </div>
        <h2>SAMSUNG</h2>
        <p>Painel administrativo interno.<br>Acesso restrito a administradores autorizados.</p>
        <div class="admin-badge">
            <i class="fa-solid fa-shield-halved me-1"></i> Área Restrita
        </div>
    </div>

    <!-- Direita -->
    <div class="login-right">
        <h4>Bem-vindo de volta</h4>
        <p class="subtitle">Faça login com suas credenciais de administrador</p>

        <div>
            <label class="form-label">E-mail</label>
            <div class="input-group-custom">
                <i class="fa-regular fa-envelope"></i>
                <input type="email" id="email" placeholder="seu@email.com">
            </div>

            <label class="form-label">Senha</label>
            <div class="input-group-custom">
                <i class="fa-solid fa-lock"></i>
                <input type="password" id="senha" placeholder="••••••••">
            </div>

            <button class="btn-login" id="btnLogin">
                <i class="fa-solid fa-right-to-bracket me-2"></i>Entrar no Painel
            </button>

            <div class="lock-notice">
                <i class="fa-solid fa-circle-info"></i>
                <span>Este acesso é monitorado e registrado.</span>
            </div>
        </div>
    </div>
</div>

<script>
    // =============================================
    // CREDENCIAIS DO ADMIN (fixas, conforme pedido)
    // =============================================
    const ADMIN_EMAIL = 'vinicius@gmail.com';
    const ADMIN_SENHA = '123456';
    // =============================================

    $(document).ready(function () {

        // Se já está logado, redireciona direto
        if (sessionStorage.getItem('admin_logado') === 'true') {
            window.location.href = '/dashboard_admin';
        }

        function tentarLogin() {
            const email = $('#email').val().trim();
            const senha = $('#senha').val();

            if (!email || !senha) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Campos obrigatórios',
                    text: 'Preencha o e-mail e a senha para continuar.',
                    confirmButtonColor: '#6f42c1'
                });
                return;
            }

            if (email === ADMIN_EMAIL && senha === ADMIN_SENHA) {
                // Login correto
                sessionStorage.setItem('admin_logado', 'true');

                Swal.fire({
                    icon: 'success',
                    title: 'Acesso liberado!',
                    text: 'Redirecionando para o dashboard...',
                    showConfirmButton: false,
                    timer: 1800,
                    timerProgressBar: true,
                    confirmButtonColor: '#6f42c1'
                }).then(() => {
                    window.location.href = '/dashboard_admin';
                });

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Acesso negado',
                    text: 'E-mail ou senha incorretos.',
                    confirmButtonColor: '#6f42c1'
                });
            }
        }

        $('#btnLogin').click(tentarLogin);

        // Login com Enter
        $('input').on('keypress', function (e) {
            if (e.which === 13) tentarLogin();
        });
    });
</script>

</body>
</html>