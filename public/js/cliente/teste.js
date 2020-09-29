
var result = [];
var tamanhoPagina = 3;
var pagina = 0;

var htmlCardPDestaque = '';
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    cardProdutoDestaque();

});
function cardProdutoDestaque() {
    $.ajax({
        type: "POST",
        url: "/inicial/produto/destaque",
        dataType: "JSON",
        success: function (data) {
            result = data;
            paginar();
            ajustarBotoes();
        }, error: function (erros) {

        }
    });
}

function paginar() {
    htmlCardPDestaque = '';
    $('#divProdutoDestaque').empty();
    for (var i = pagina * tamanhoPagina; i < result.length && i < (pagina + 1) * tamanhoPagina; i++) {

        htmlCardPDestaque += '<div class="col-sm-4"><div class="product-image-wrapper"><div class="single-products"><div class="productinfo text-center"> <img class="cardProduto" src="https://dev.loja.avantz.com.br/images/imagensProdutos/' + result[i].nome_arquivo + '" alt="" ><h2>' + result[i].id + '</h2><p>Easy Polo Black Edition</p> <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a></div><div class="product-overlay"><div class="overlay-content"><h2>$56</h2><p>Easy Polo Black Edition</p> <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a></div></div></div></div></div>';

    }
    $("#divProdutoDestaque").html(htmlCardPDestaque);

    $('#numeracao').text('Página ' + (pagina + 1) + ' de ' + Math.ceil(result.length / tamanhoPagina));
}

function ajustarBotoes() {
    $('#proximo').prop('disabled', result.length <= tamanhoPagina || pagina >= Math.ceil(result.length / tamanhoPagina) - 1);
    $('#anterior').prop('disabled', result.length <= tamanhoPagina || pagina == 0);
}

$('#proximo').click(function () {
    if (pagina < result.length / tamanhoPagina - 1) {
        pagina++;
        paginar();
        ajustarBotoes();
    }
});
$('#anterior').click(function () {
    if (pagina > 0) {
        pagina--;
        paginar();
        ajustarBotoes();
    }
});


