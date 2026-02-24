$(document).ready(function () {

    $("#salvaraparelho").click(function () {
        $.ajax({
            url: "../api/salva_samsung",
            method: "POST",
            data: {

                cor: $("#cor").val(),
                ano: $("#ano").val(),
                modelo: $("#modelo").val(),
                aparelho: $("#aparelho").val()



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




