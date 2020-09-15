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
    $(".lcardsDestaque").addClass('linkselectedConfig');


    table = $('#tableCards').DataTable({
        "processing": true,
        "order": [[0, "asc"]],
        dom: 'Bfrtip',
        ajax: "/admin/config/produto/destaque",
        //Fazendo a listagem dos seguintes dados
        columns: [
            //LISTANDO OS DOIS TIPO DE PESSOA.
            { data: 'id' },
            { data: 'nome' },
            { data: 'id' },
            { data: 'id' },
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

});
function reloadPagina() {
    setInterval(() => {
        location.reload();
    }, 2000);
}

function viewProduto(idProduto) {
    $.ajax({
        type: "POST",
        url: "/admin/config/produto/destaque/visualizar",
        data: {
            idProduto: idProduto
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "JSON",
        success: function (data) {
            console.log(data);
            $("#modalViewProduto").modal('show');

        }, error: function (erros) {
            console.log(erros);

        }
    });

}