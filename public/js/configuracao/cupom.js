var table;
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

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
        columns: [
            { data: 'e_id_cupom' },
            { data: 'nome_cupom' },
            { data: 'action', name: 'action', orderable: false, searchable: false }

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

    //Masks
    $('.data').mask('00/00/0000');
    $('.valor').mask('0.000,00', { reverse: true });


});
//Mudando a mascara de tipo do cupom
$('#tipoValor').change(function () {
    if ($(this).val() == 1) {
        $('.valor').val('');
        $('.valor').mask('0.000,00', { reverse: true });
    } else {
        $('.valor').val('');
        $('.valor').mask('000,00%', { reverse: true });

    }
});
function addCupom() {
    //Resetando os dados
    $('#formAddCupom').each(function () {
        this.reset();
    });
    //Abrindo o modal
    $("#modalAddCupom").modal('show');

}



