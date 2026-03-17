<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samsung - Cadastro de Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-purple: #6f42c1;
            --dark-purple: #2d1b4e;
            --accent-blue: #007aff;
            --bg-gradient: linear-gradient(135deg, #007aff 0%, #003a7a 100%); /* Azul escurecendo conforme pedido */
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
            padding: 40px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.2);
            border: 1px solid rgba(255,255,255,0.3);
        }

        .brand-logo {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--dark-purple);
            text-align: center;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--dark-purple);
            margin-left: 5px;
        }

        .form-control, .form-select {
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-purple);
            box-shadow: 0 0 0 4px rgba(111, 66, 193, 0.1);
            background-color: #fff;
        }

        .btn-auth {
            background: var(--primary-purple);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            width: 100%;
            margin-top: 20px;
            transition: all 0.3s ease;
        }

        .btn-auth:hover {
            background: var(--dark-purple);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            color: white;
        }

        .input-group-text {
            background: none;
            border-right: none;
            border-radius: 12px 0 0 12px;
            color: #6c757d;
        }

        .has-icon .form-control {
            border-left: none;
            border-radius: 0 12px 12px 0;
        }
    </style>
</head>
<body>

<div class="auth-card">
    <div class="brand-logo">
        <i class="fa-solid fa-mobile-screen-button me-2 text-primary"></i>
        SAMSUNG <span class="fw-light opacity-75">Portal</span>
    </div>

    <h4 class="fw-bold mb-4 text-center">Criar sua conta</h4>

    <form id="formCadastro">
        <div class="row">
            <div class="col-12 mb-3">
                <label class="form-label">Nome Completo</label>
                <div class="input-group has-icon">
                    <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                    <input type="text" id="nome" class="form-control" placeholder="Ex: João Silva" required>
                </div>
            </div>

            <div class="col-12 mb-3">
                <label class="form-label">E-mail Corporativo</label>
                <div class="input-group has-icon">
                    <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
                    <input type="email" id="email" class="form-control" placeholder="joao@samsung.com" required>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Telefone</label>
                <input type="text" id="telefone" class="form-control" placeholder="(00) 00000-0000" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Nascimento</label>
                <input type="date" id="nascimento" class="form-control" required>
            </div>

            <div class="col-12 mb-3">
                <label class="form-label">Gênero</label>
                <select id="genero" class="form-select">
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                    <option value="O">Outro / Não informar</option>
                </select>
            </div>

            <div class="col-12 mb-4">
                <label class="form-label">Senha de Acesso</label>
                <div class="input-group has-icon">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" id="senha" class="form-control" placeholder="••••••••" required>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-auth">
            <i class="fa-solid fa-user-plus me-2"></i>Finalizar Cadastro
        </button>
        
        <div class="text-center mt-4">
            <a href="/login" class="text-decoration-none small fw-bold" style="color: var(--primary-purple);">Já possui uma conta? Entrar</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>

$('#formCadastro').on('submit', function(e){

    e.preventDefault();

    const dados = {
        nome: $('#nome').val(),
        email: $('#email').val(),
        telefone: $('#telefone').val(),
        nascimento: $('#nascimento').val(),
        genero: $('#genero').val(),
        senha: $('#senha').val()
    };

    $.ajax({
        url: '/api/cadastro_usuario',
        method: 'POST',
        contentType: 'application/json',
        dataType: 'json',
        data: JSON.stringify(dados),

        success: function(data){

            if(data.erro === 'n'){

                Swal.fire({
                    icon: 'success',
                    title: 'Bem-vindo!',
                    text: 'Usuário ' + data.data.nome + ' cadastrado com sucesso!',
                    confirmButtonColor: '#6f42c1'
                }).then(function(){

                    window.location.href = '/inicio';

                });

            } else {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Erro ao cadastrar.'
                });

            }

        },

        error: function(){

            Swal.fire({
                icon: 'error',
                title: 'Erro de conexão',
                text: 'Não foi possível falar com o servidor.'
            });

        }

    });

});

</script>
</body>
</html>