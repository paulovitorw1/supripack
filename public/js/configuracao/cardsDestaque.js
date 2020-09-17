var table;
var htmlImg = '';
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
    $('.containerImgProduto').empty();
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
            $.each(data, function (indexInArray, valueOfElement) {
                console.log(indexInArray);

                htmlImg += '<div class="col-sm-4 imgUp card"><div class="imagePreview" style="background-image: url(http://192.168.15.127:8000/images/' + valueOfElement.nome_arquivo + ')"></div> <button onclick="" type="button" name="imgDelete[]" value="" class="btn btn-danger btnUploadEdit btnDelete"> Deletar </button></div>';
            });
            $("#formViewProduto .viewProduto").each(function () {
                $(this).attr("readonly", true);
                $(this).attr("disabled", true);
                
            });
            $('.containerImgProduto').html(htmlImg);
            $("#nomeproduto").val(data[0].nome);
            $("#gruoproduto").val(data[0].nv3);
            $("#descProduto").val(data[0].descr);

            $("#modalViewProduto").modal('show');

        }, error: function (erros) {
            console.log(erros);

        }
    });

}