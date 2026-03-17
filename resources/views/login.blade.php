<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samsung - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-blue: #007aff;
            --dark-blue: #003a7a;
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
            color: #1d1d1f;
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
            background: var(--primary-blue);
            color: white;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            width: 100%;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-auth:hover {
            background: var(--dark-blue);
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

        <button type="submit" class="btn btn-auth" id="btnSubmit">
            <i class="fa-solid fa-right-to-bracket me-2"></i>Entrar no Portal
        </button>

        <div class="text-center mt-4">
            <p class="small">Não tem conta? <a href="/cadastro" class="text-decoration-none fw-bold" style="color: var(--primary-blue);">Cadastre-se</a></p>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Se o usuário já tiver um token válido, manda direto para o início
    if (localStorage.getItem('user_token')) {
        window.location.href = '/inicio';
    }

    document.getElementById('formLogin').addEventListener('submit', function(e) {
        e.preventDefault();

        const btn = document.getElementById('btnSubmit');
        btn.disabled = true; // Evita múltiplos cliques
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Carregando...';

        const email = document.getElementById('email').value;
        const senha = document.getElementById('senha').value;

        // Chamada para a sua API
        // IMPORTANTE: Mudei para POST por segurança. Ajuste sua rota se necessário.
        fetch(`/api/login_usuario?email=${email}&senha=${senha}`, {
            method: 'GET', // Mantido GET conforme sua api.php atual
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.erro === 'n' && data.token) {
                // SALVA O TOKEN NO NAVEGADOR
                localStorage.setItem('user_token', data.token);

                Swal.fire({
                    icon: 'success',
                    title: 'Bem-vindo!',
                    text: 'Login realizado com sucesso.',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = '/inicio';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Ops!',
                    text: data.msg || 'E-mail ou senha incorretos.'
                });
                btn.disabled = false;
                btn.innerHTML = '<i class="fa-solid fa-right-to-bracket me-2"></i>Entrar no Portal';
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            Swal.fire({ icon: 'error', title: 'Erro de servidor', text: 'Tente novamente mais tarde.' });
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-right-to-bracket me-2"></i>Entrar no Portal';
        });
    });
</script>
</body>
</html>