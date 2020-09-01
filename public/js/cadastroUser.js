$(document).ready(function () {

});

$("#btnCadastroUser").on('click', function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "/usuario/adicinar",
        data: new FormData($("#registrarUser form")[0]),
        processData: false,
        contentType: false,
        success: function (data) {
            console.log(data);


        }, error: function (erros) {
            console.log(erros);
        }
    });

});