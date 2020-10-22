var table;
var idCupomEditar;
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    moment.locale('pt-BR');

    //Ativando o dropdown 
    $(".layout-supri").removeClass('collapse');
    $(".layout-supri").addClass('in');
    $(".layout-supri").css('height', 'auto');
    $(".lcupons").addClass('linkselectedConfig');
    table = $("#tableCupom").DataTable({
        serverSide: false,
        filter: true,
        bDestroy: true,
        processing: true,
        // dom: 'lrti',
        ajax: {
            url: "/admin/config/cupom",
            cache: true,
            type: "GET",
        },
        // "columnDefs": [
        //     { className: "cart_delete", "targets": [6] }
        // ],
        columns: [{
            data: 'e_id_cupom'
        },
        {
            data: 'nome_cupom'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        }

        ],
        //Traduzindo a Tabela para o PORTUGUÊS
        "bJQueryUI": true,
        "oLanguage": {
            "lengthChange": false,
            "pageLength": 10,
            "sProcessing": "Processando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "Não foram encontrados resultados",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando de 0 até 0 de 0 registros",
            "sInfoFiltered": "",
            "sInfoPostFix": "",
            "sSearch": "Pesquisar: ",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "Primeiro",
                "sPrevious": "Anterior",
                "sNext": "Próximo",
                "sLast": "Último"
            }
        }
    });


    //substituindo a input de pesquisa do DataTables
    $('#inputPesquisa').on('keyup', function () {
        table.search(this.value).draw();
    });

    maskInput();
});

function maskInput() {
    //Masks
    $('.data').mask('00/00/0000');
    $('.valorCupom').mask('0.000,00', {
        reverse: true
    });
    $('.quantidade').mask('0000');
}
//Mudando a mascara de tipo do cupom
$('.tipoValor').change(function () {
    if ($(this).val() == 1) {
        $('.valorCupom').val('');
        $('.valorCupom').mask('0.000,00', {
            reverse: true
        });
    } else {
        $('.valorCupom').val('');
        $('.valorCupom').mask('000,00%', {
            reverse: true
        });

    }
});
$('.editporcentagemOUvalorreal').change(function () {
    if ($(this).val() == 1) {
        $('.editvalorCupom').val('');
        $('.editvalorCupom').mask('0.000,00', {
            reverse: true
        });
    } else {
        $('.editvalorCupom').val('');
        $('.editvalorCupom').mask('000,00%', {
            reverse: true
        });

    }
});

function addCupom() {
    //Resetando os dados
    $('#formAddCupom').each(function () {
        $('.invalid-feedback').text('');
        $('#formAddCupom .form-control').removeClass('inputError');
        this.reset();
    });
    //Abrindo o modal
    $("#modalAddCupom").modal('show');

}
//Visualizando o cupom
function viewCupom(idCupomview) {
    $.ajax({
        type: "POST",
        url: "/admin/config/cupom/visualizar",
        data: {
            idCupomEdit: idCupomview
        },
        dataType: "JSON",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if ($('.tipoValor').val() == 1) {
                $('.editvalorCupom').val('');
                $('.editvalorCupom').mask('0.000,00', {
                    reverse: true
                });
            } else {
                $('.editvalorCupom').val('');
                $('.editvalorCupom').mask('000,00%', {
                    reverse: true
                });

            }
            $('.viewnomecupom').val(data[0].nome_cupom);
            $('.viewtipoCupom').val(data[0].tipo_cupom);
            $('.viewporcentagemOUvalorreal').val(data[0].porcentagemOUvalorreal);
            $('.viewvalorCupom').val(data[0].valor_cupom);
            $('.viewcupomQuantidade').val(data[0].cupom_quantidade);
            $('.viewvalidadeCupom').val(moment(data[0].data_validade).format('L'));


            $("#modalVisualizarCupom .form-control").each(function () {
                $(this).attr("readonly", true);
                $(this).attr("disabled", true);
            });
            $('#modalVisualizarCupom').modal('show');
        },
        error: function (erros) {

        }
    });
}
//Visualizando o cupom
function editarCupom(idCupomEdit) {
    idCupomEditar = idCupomEdit;
    $.ajax({
        type: "POST",
        url: "/admin/config/cupom/visualizar",
        data: {
            idCupomEdit
        },
        dataType: "JSON",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if ($('.tipoValor').val() == 1) {
                $('.editvalorCupom').val('');
                $('.editvalorCupom').mask('0.000,00', {
                    reverse: true
                });
            } else {
                $('.editvalorCupom').val('');
                $('.editvalorCupom').mask('000,00%', {
                    reverse: true
                });

            }
            $('.editnomecupom').val(data[0].nome_cupom);
            $('.edittipoCupom').val(data[0].tipo_cupom);
            $('.editporcentagemOUvalorreal').val(data[0].porcentagemOUvalorreal);
            $('.editvalorCupom').val(data[0].valor_cupom);
            $('.editcupomQuantidade').val(data[0].cupom_quantidade);
            $('.editvalidadeCupom').val(moment(data[0].data_validade).format('L'));


            $('#modalEditarCupom').modal('show');
        },
        error: function (erros) {

        }
    });
}
//Função para deleta um cupom
function deleteCupom(idCupom) {
    $.ajax({
        type: "POST",
        url: "/admin/config/cupom/delete",
        data: {
            idCupom
        },
        dataType: "JSON",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            Swal.fire({
                title: 'Você tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, exclua!'
            }).then((data) => {
                if (data.isConfirmed) {
                    Swal.fire(
                        'Excluído!',
                        'Cupom deleteado com sucesso !',
                        'success',
                        table.ajax.reload()

                    )
                }
            })
        },
        error: function (erros) {

        }
    });

}

//Editando um cupom
$('#btnformEditarCupom').click(function (e) {
    e.preventDefault();
    var formDataa = new FormData($("#modalEditarCupom form")[0]);
    formDataa.append('idCupomEdit', idCupomEditar);

    $.ajax({
        type: "POST",
        url: "/admin/config/cupom/atualizar",
        data: formDataa,
        processData: false,
        contentType: false,
        success: function (data) {
            Swal.fire({
                icon: 'success',
                title: 'Sucesso',
                text: 'Cupom editado com sucesso!',
                timer: 1500
            });
            setTimeout(() => {
                $("#modalEditarCupom").modal('hide');
                table.ajax.reload();
            }, 1500);
        },
        error: function (errros) {
            var jsonErros = errros.responseJSON.errors
            $.each(jsonErros, function (indexInArray, valueOfElement) {
                $('.editmensagem_' + indexInArray).text(valueOfElement);
                $('.' + indexInArray).addClass('inputError');
                $('.' + indexInArray).click(function (e) {
                    $('.editmensagem_' + indexInArray).text('');
                    $('.' + indexInArray).removeClass('inputError');


                });

            });
        }
    });


});

//Registrando um novo cupom
$('#btnformAddCupom').click(function (e) {
    e.preventDefault();
    var formDataa = new FormData($("#modalAddCupom form")[0]);

    $.ajax({
        type: "POST",
        url: "/admin/config/cupom/adicionar",
        data: formDataa,
        processData: false,
        contentType: false,
        success: function (data) {
            Swal.fire({
                icon: 'success',
                title: 'Sucesso',
                text: 'Cupom cadastrado com sucesso!',
                timer: 1500
            });
            setTimeout(() => {
                $("#modalAddCupom").modal('hide');
                table.ajax.reload();
            }, 1500);
        },
        error: function (errros) {
            var jsonErros = errros.responseJSON.errors
            $.each(jsonErros, function (indexInArray, valueOfElement) {
                $('.mensagem_' + indexInArray).text(valueOfElement);
                $('.' + indexInArray).addClass('inputError');
                $('.' + indexInArray).click(function (e) {
                    $('.mensagem_' + indexInArray).text('');
                    $('.' + indexInArray).removeClass('inputError');


                });

            });
        }
    });

});