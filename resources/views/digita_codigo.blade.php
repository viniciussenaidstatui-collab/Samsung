<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticação em Duas Etapas</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 20px 20px 0 0 !important;
            padding: 20px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px;
            font-weight: 600;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .code-input {
            font-size: 24px;
            letter-spacing: 10px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="mb-0">
                            <i class="fas fa-shield-alt me-2"></i>
                            Autenticação em Duas Etapas
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-muted text-center mb-4">
                            Digite o código de 6 dígitos enviado para seu e-mail
                        </p>
                        
                        <input type="hidden" id="email" class="form-control">
                        <input type="text" id="codigo" class="form-control code-input mb-3" placeholder="000000" maxlength="6" autocomplete="off">
                        
                        <button id="enviar_codigo" class="btn btn-primary w-100">
                            <i class="fas fa-check-circle me-2"></i>
                            Verificar Código
                        </button>
                        
                        <div class="text-center mt-3">
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>
                                Código expira em 10 minutos
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function(){
        // Recuperar email do localStorage
        var emailSalvo = localStorage.getItem('email_2fa');
        if (emailSalvo) {
            $("#email").val(emailSalvo);
        } else {
            // Se não tiver email salvo, perguntar
            Swal.fire({
                title: 'E-mail necessário',
                text: 'Digite seu e-mail para continuar',
                input: 'email',
                inputPlaceholder: 'seu@email.com',
                showCancelButton: false,
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    $("#email").val(result.value);
                    localStorage.setItem('email_2fa', result.value);
                }
            });
        }

        $("#enviar_codigo").click(function(){
            var codigo = $("#codigo").val();
            var email = $("#email").val();
            
            if (!codigo || codigo.length !== 6) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Código inválido',
                    text: 'Digite o código de 6 dígitos'
                });
                return;
            }
            
            if (!email) {
                Swal.fire({
                    icon: 'warning',
                    title: 'E-mail necessário',
                    text: 'Digite seu e-mail'
                });
                return;
            }

            $.ajax({
                type: 'GET',
                url: "/api/enviar_codigo",
                data: {
                    codigo: codigo,
                    email: email,
                },
                dataType: "json",
                success: function (response) {
                    if (response.erro == "n"){
                        $.cookie('token', response['token'], { expires: 7, path: '/' });
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Código correto!',
                            text: 'Redirecionando para a página inicial...',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        
                        setTimeout(function() {
                            localStorage.removeItem('email_2fa');
                            window.location.href = "/inicio";
                        }, 2000);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Código inválido',
                            text: 'Verifique o código e tente novamente'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: 'Não foi possível verificar o código'
                    });
                }
            });
        });
        
        // Permitir Enter
        $("#codigo").keypress(function(e) {
            if (e.which === 13) {
                $("#enviar_codigo").click();
            }
        });
    });
    </script>
</body>
</html>