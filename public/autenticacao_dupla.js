$(document).ready(function(){

    $("#enviar_codigo").click(function(){

        $.ajax({
            type: 'GET',
            url: "api/enviar_codigo",
            data: {
                codigo: $("#codigo").val(),
                email: $("#email").val(),
            },
            dataType: "json",
            success: function (response) {

                if(response.erro == "n"){
                    
                    $.cookie('token', response['token'], { expires: 7, path: '/' });
                    alert("Código correto! Redirecionando para a página inicial...");
                    
                    setTimeout(function() {
                        window.location.href = "/inicio";
                    }, 2000);
                } 

            }


        })


    })



});