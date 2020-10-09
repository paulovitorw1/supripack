
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
            "columnDefs": [
                { className: "cart_delete", "targets": [6] }
            ],
            columns: [
                { data: 'id' },
                { data: 'descr' },
                { data: 'descr' },
                { data: 'valor_uni_tributavel', defaultContent: "<i>Not set</i>" },
                { data: 'action', name: 'action', orderable: false, searchable: false },
                { data: 'valor_uni_tributavel', defaultContent: "<i>Not set</i>" },
                { data: 'sssss', name: 'sssss', orderable: false, searchable: false }

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


function quantdd(classId) {
    var valorAtual = Number($(".valor" + classId).val());
    var ssjssjs = Number(++valorAtual);

    var novoValor = $(".valor" + classId).val(ssjssjs);

}
function quantRemove(classId) {
    var valorAtual = Number.parseInt($(".valor" + classId).val());
    if (valorAtual > 0) {
        var ssjssjs = parseInt(--valorAtual);
        console.log(ssjssjs);
        var novoValor = $(".valor" + classId).val(ssjssjs);
    }


}

function removeProduto(idProduto) {
    //pegando o valor selecionado
    var index = getlocalStorage.indexOf(idProduto);
    //verificando valor dentro do array e deletando
    if (index > -1) {
        getlocalStorage.splice(index, 1);
    }
    //Inserindo os novos valores
    localStorage.setItem('produto', JSON.stringify(getlocalStorage));
    //Atualizando a tabela
    getProdutoStorange();
}