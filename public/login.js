$(document).ready(function () {
    $("#formCadastro").submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: "/api/cadastro_usuario", // Sua rota Route::post('/cadastro_usuario'...)
            method: "POST",
            data: {
                nome: $("#nome").val(),
                email: $("#email").val(),
                telefone: $("#telefone").val(),
                nascimento: $("#nascimento").val(),
                genero: $("#genero").val(),
                senha: $("#senha").val()
            },
            success: function (res) {
                if (res.erro === 'n') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Cadastrado!',
                        text: 'Conta criada com sucesso!',
                    }).then(() => {
                        window.location.href = "/login";
                    });
                }
            },
            error: function (xhr) {
                // Exibe erros de validação do Laravel ($request->validate)
                alert("Erro ao cadastrar. Verifique os dados.");
                console.log(xhr.responseText);
            }
        });
    });
});