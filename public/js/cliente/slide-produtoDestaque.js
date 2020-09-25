var htmlSlide = '';
var htmlLiSlide = '';
var htmlCardPDestaque = '';
var htmlCategoria = '';
var htmlSubMenu = '';
var textMinu = '';
var filtroProduto = '';
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    slide();
    cardProdutoDestaque();
    categoria();
});

function slide() {
    $.ajax({
        type: "GET",
        url: "/inicial/slide",
        // data: "data",
        dataType: "JSON",
        success: function (data) {
            $.each(data, function (indexInArray, valueOfElement) {
                // console.log(indexInArray);
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
                // console.log(valueOfElement.nome_arquivo);

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

function categoria() {
    $.ajax({
        type: "GET",
        url: "/inicial/categoria",
        // data: "data",
        dataType: "JSON",
        success: function (data) {
            console.log(data);
            // console.log(sub);

            $.each(data.menu, function (indexInArrayMeunu, valueOfElementMeunu) {

                var textMinusula = valueOfElementMeunu.nv1.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                htmlCategoria += '<div class="panel panel-default"><div class="panel-heading"><h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordian" href="#' + textMinusula + '"> <span class="badge pull-right"><i class="fa fa-plus"></i></span> ' + valueOfElementMeunu.nv1 + ' </a></h4></div><div id="' + textMinusula + '" class="panel-collapse collapse"><div class="panel-body ' + textMinusula + '"></div></div></div>';

                $.ajax({
                    type: "POST",
                    url: "/inicial/tesste",
                    data: {
                        idCategoria: valueOfElementMeunu.id
                    },
                    dataType: "JSON",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        htmlSubMenu = '';
                        $.each(data, function (indexInArray, valueOfElement) {
                            if (valueOfElement.nv1 != '' && valueOfElement.nv3 != '') {
                                htmlSubMenu += '<ul><li><a class="cursoPoint" onclick="filtroCategoriaProduto(' + valueOfElement.id + ')">' + valueOfElement.nv2 + '-' + valueOfElement.nv3 + '</a></li></ul> <input type="hidden" value="' + valueOfElement.id + '"/>';

                            } else {

                                htmlSubMenu += '<ul><li><a class="cursoPoint" onclick="filtroCategoriaProduto(' + valueOfElement.id + ')">' + valueOfElement.nv2 + '</a></li></ul> <input type="hidden" value="' + valueOfElement.id + '"/>';
                            }
                        });
                        $('.' + textMinusula).html(htmlSubMenu);


                    }, error: function (erros) {

                    }
                });

            });
            $('.category-products').html(htmlCategoria);

            // $.each(data.subMenu, function (indexInArraysubMenu, valueOfElementsubMenu) {
            //     textMinu = valueOfElementsubMenu.nv1.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
            //     if (valueOfElementsubMenu. == 2) {
            //         htmlSubMenu += '<ul><li><a href="#">' + valueOfElementsubMenu.nv2 + '</a></li></ul> <input type="hidden" value="' + valueOfElementsubMenu.id + '"/>';

            //     } else if (valueOfElementsubMenu.niv == 3) {
            //         htmlSubMenu += '<ul><li><a href="#">' + valueOfElementsubMenu.nv3 + '</a></li></ul> <input type="hidden" value="' + valueOfElementsubMenu.id + '"/>';

            //         // htmlSubMenu += '<ul><li><a href="#">' + valueOfElementsubMenu.nv1 + '</a></li></ul> <input type="hidden" value="' + valueOfElementsubMenu.id + '"/>';
            //     }else{
            //         console.log("mds");
            //     }
            //     console.log(textMinu);
            //     $('.' + textMinu).html(htmlSubMenu);
            //     // htmlSubMenu = '';

            // });
        }, error: function (erros) {

        }
    });
}

function filtroCategoriaProduto(idCategoria) {
    filtroProduto = '';
    $.ajax({
        type: "POST",
        url: "/inicial/filtro/produto",
        data: {
            idCategoria: idCategoria
        },
        dataType: "JSON",
        success: function (data) {
            console.log(data);
            $.each(data, function (indexInArray, valueOfElement) {
                filtroProduto += '<div class="col-sm-4"><div class="product-image-wrapper"><div class="single-products"><div class="productinfo text-center"> <img class="cardProduto" src="https://dev.loja.avantz.com.br/images/imagensProdutos/' + valueOfElement.nome_arquivo + '" alt="" ><h2>$56</h2><p>Easy Polo Black Edition</p> <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a></div><div class="product-overlay"><div class="overlay-content"><h2>$56</h2><p>Easy Polo Black Edition</p> <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a></div></div></div></div></div>';
                // console.log(valueOfElement.nome_arquivo);

                //ANALIZAR DPS 
                // <div class="choose"><ul class="nav nav-pills nav-justified"><li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li><li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li></ul></div>
            });
            $("#divProdutoDestaque").html(filtroProduto);
        }, error: function (erros) {

        }
    });
}