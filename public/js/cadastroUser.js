
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
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
            jsonErro = erros.responseJSON.errors;
            $.each(jsonErro, function (indexInArray, valueOfElement) {
                $(".erro_" + indexInArray).addClass('control-label');
                $("." + indexInArray).html(valueOfElement);
                $("." + indexInArray).click(function (e) {
                    $(".erro_" + indexInArray).removeClass('control-label');
                    $("." + indexInArray).html('');


                });
            });
        }
    });

});