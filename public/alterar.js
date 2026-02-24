$(document).ready(function () {
    alert("funfei");
    $("#salvaraparelho").click(function () {
        $.ajax({
            url: "../api/altera",
            method: "PUT",
            data: {
                
                cor: $("#cor").val(),
                ano: $("#ano").val(),
                modelo: $("#modelo").val(),
                aparelho: $("#aparelho").val(),
                id_loja: $("#id_loja").val()



            },
            success: function (res) {
                console.log(res);
                alert("funcionei");

            },
            error: function (xhr) {

                console.log("Erro", xhr.responseText);
            }
        });

    });

});