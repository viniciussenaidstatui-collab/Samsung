<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samsung - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

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

        <button type="submit" class="btn btn-auth">
            <i class="fa-solid fa-right-to-bracket me-2"></i>Entrar no Portal
        </button>

        <div class="text-center mt-4">
            <p class="small">Não tem conta? <a href="/cadastro" class="text-decoration-none fw-bold" style="color: var(--primary-purple);">Cadastre-se</a></p>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('formLogin').addEventListener('submit', function(e) {
        e.preventDefault();

        const email = document.getElementById('email').value;
        const senha = document.getElementById('senha').value;

        // Note: sua rota na api.php está como GET. 
        // Para passar parâmetros no GET via fetch, usamos a Query String:
        fetch(`/api/login_usuario?email=${email}&senha=${senha}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.erro === 'n' && data.msg === 'Usuario Logado') {
                // SALVAR O TOKEN: Muito importante para manter o usuário logado
                localStorage.setItem('user_token', data.token);

                Swal.fire({
                    icon: 'success',
                    title: 'Login realizado!',
                    text: 'Redirecionando para o painel...',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = '/inicio';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Falha no Login',
                    text: data.msg || 'Credenciais incorretas.'
                });
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            Swal.fire({ icon: 'error', title: 'Erro de conexão' });
        });
    });
</script>
</body>
</html>