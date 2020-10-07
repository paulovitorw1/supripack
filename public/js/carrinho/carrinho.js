//PEGANDO OS VALORES SALVO DO LOCAL STORANGE
var getlocalStorage = JSON.parse(localStorage.getItem('produto'));
//VARIAVEL QUE VAI ARMAZENAR O HTML
var htmlProduto = '';
var table;
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    getProdutoStorange();
});

function getProdutoStorange() {
    if (getlocalStorage == null) {

    } else {

        table = $("#tableProdutoCarrinho").DataTable({
            serverSide: false,
            filter: true,
            bDestroy: true,
            processing: true,
            // dom: 'lrti',
            ajax: {
                url: "/inicial/carrinho/lista/produto",
                data: {
                    idProdutos: getlocalStorage
                },
                cache: true,
                type: "POST",
            },
            columns: [
                { data: 'id' },
                { data: 'descr' },
                { data: 'id_foto', defaultContent: "<i>Not set</i>" },
                // { data: 'valor_uni_tributavel', defaultContent: "<i>Not set</i>" },


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
        // $.ajax({
        //     type: "POST",
        //     url: "/inicial/carrinho/lista/produto",
        //     data: {
        //         idProdutos: getlocalStorage
        //     },
        //     dataType: "JSON",
        //     success: function (data) {
        //         console.log(data)
        //     }, error: function (erros) {
        //         console.log(erros);

        //     }
        // });
    }
}

