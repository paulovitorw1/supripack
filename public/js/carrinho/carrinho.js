//PEGANDO OS VALORES SALVO DO LOCAL STORANGE
var getlocalStorage = JSON.parse(localStorage.getItem('produto'));
//VARIAVEL QUE VAI ARMAZENAR O HTML
var htmlProduto = '';
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
        $.ajax({
            type: "POST",
            url: "/inicial/carrinho/lista/produto",
            data: {
                idProdutos: getlocalStorage
            },
            dataType: "JSON",
            success: function (data) {
               var ssss =  JSON.parse(JSON.stringify(data))
                console.log(ssss); // ['a', 1, 2, '1']
            }, error: function (erros) {
                console.log(erros);

            }
        });
    }
}

