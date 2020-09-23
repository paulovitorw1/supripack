var htmlSlide = '';
var htmlLiSlide = '';
var htmlCardPDestaque = '';
$(document).ready(function () {
    slide();
    cardProdutoDestaque();
});

function slide() {
    $.ajax({
        type: "GET",
        url: "/inicial/slide",
        // data: "data",
        dataType: "JSON",
        success: function (data) {
            $.each(data, function (indexInArray, valueOfElement) {
                console.log(indexInArray);
                if (indexInArray == 0) {
                    htmlSlide += '<div class="item active"><div class="col-sm-12 col_pl-pr-0"><img src="http://192.168.15.127:8000/img_carousel/' + valueOfElement.imagem + '" class="girl img-responsive-index" alt=""></div></div>';
                }
                htmlLiSlide += '<li data-target="#slider-carousel" data-slide-to="' + indexInArray + '" class=""></li>';
                htmlSlide += '<div class="item"><div class="col-sm-12 col_pl-pr-0"><img src="http://192.168.15.127:8000/img_carousel/' + valueOfElement.imagem + '" class="girl img-responsive-index" alt=""></div></div>';

            });
            $(".itemProximoImg").html(htmlSlide);
            $(".ol_li").html(htmlLiSlide);

        }, error: function (errros) {
            console.log(errros);

        }
    });
}

function cardProdutoDestaque() {
    $.ajax({
        type: "GET",
        url: "/inicial/produto/destaque",
        dataType: "JSON",
        success: function (data) {
            $.each(data, function (indexInArray, valueOfElement) {
                htmlCardPDestaque += '<div class="col-sm-4"><div class="product-image-wrapper"><div class="single-products"><div class="productinfo text-center"> <img class="cardProduto" src="https://dev.loja.avantz.com.br/images/imagensProdutos/' + valueOfElement.nome_arquivo + '" alt="" ><h2>$56</h2><p>Easy Polo Black Edition</p> <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a></div><div class="product-overlay"><div class="overlay-content"><h2>$56</h2><p>Easy Polo Black Edition</p> <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a></div></div></div></div></div>';
                console.log(valueOfElement.nome_arquivo);
                
                //ANALIZAR DPS 
                // <div class="choose"><ul class="nav nav-pills nav-justified"><li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li><li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li></ul></div>
            });
            $("#divProdutoDestaque").html(htmlCardPDestaque);
            // 
            // https://dev.loja.avantz.com.br/
        }, error: function (erros) {

        }
    });
}