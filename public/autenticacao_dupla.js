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
                    window.location.href = "/inicio";

                    $.cookie('token', response['token'], { expires: 7, path: '/' });
                    
                    setTimeout(function() {
                        window.location.href = "/inicio";
                    }, 2000);
                } else {
                    
                }


            }


        })


    })



});