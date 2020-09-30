//Variaveis para o carusel 
var htmlSlide = '';
var htmlLiSlide = '';
//Variavel que vai armazenar os produtos em destaque
var htmlCardPDestaque = '';
//Variavel que vai armazenar os menu
var htmlCategoria = '';
//Variavel que vai armazenar os sub-menu
var htmlSubMenu = '';
var filtroProduto = '';

//Variavel que vai armazenar os produtos
var result = [];
//Quantidade de produtos por pagina
var tamanhoPagina = 3;
//Pagina atual
var pagina = 0;
//Cache de pesquisa
var cache = {};
var idCategoriaorSub;
$(document).ready(function () {
    //Modal icon de carregamento
    $("#reload").modal('show');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    addKeyupEvent($('#inputPesquisa'));
    slide();
    cardProdutoDestaque();
    categoria();
});

// $("#inputPesquisa").on('keyup', function () {
//     if ($(this).val().length >= 3) {
//         console.log($(this).val());
//     }
// });

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

                        $("#reload").modal('hide');

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

//Funão para Produtos em destaque
function cardProdutoDestaque() {
    $("#h2-produtos").text('Produtos em destaque');
    $.ajax({
        type: "POST",
        url: "/inicial/produto/destaque",
        dataType: "JSON",
        success: function (data) {
            //Passando os valores para uma variavel global
            result = data;
            //execultando as funções para receber os novos valores
            paginar();
            ajustarBotoes();
        }, error: function (erros) {

        }
    });
}

//Função para produtos filtrados
function filtroCategoriaProduto(idCategoria) {
    idCategoriaorSub = idCategoria;
    $("#h2-produtos").text('Produtos');
    htmlCardPDestaque = '';
    $.ajax({
        type: "POST",
        url: "/inicial/filtro/produto",
        data: {
            idCategoria: idCategoria
        },
        dataType: "JSON",
        success: function (data) {
            console.log(data);
            if (data != '') {
                result = data;
                paginar();
                ajustarBotoes();
            } else {
                result = '';
                paginar();
                ajustarBotoes();
                $('#divProdutoDestaque').empty();
                $("#divProdutoDestaque").html('<div><h1>Ainda não temos produtos para essa categoria</h1></div>');
            }

            // $.each(data, function (indexInArray, valueOfElement) {
            //     filtroProduto += '<div class="col-sm-4"><div class="product-image-wrapper"><div class="single-products"><div class="productinfo text-center"> <img class="cardProduto" src="https://dev.loja.avantz.com.br/images/imagensProdutos/' + valueOfElement.nome_arquivo + '" alt="" ><h2>' + valueOfElement.id + '</h2><p>Easy Polo Black Edition</p> <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a></div><div class="product-overlay"><div class="overlay-content"><h2>$56</h2><p>Easy Polo Black Edition</p> <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a></div></div></div></div></div>';
            //     // console.log(valueOfElement.nome_arquivo);

            //     //ANALIZAR DPS 
            //     // <div class="choose"><ul class="nav nav-pills nav-justified"><li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li><li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li></ul></div>
            // });
            // $("#divProdutoDestaque").html(filtroProduto);
        }, error: function (erros) {

        }
    });
}

//Função para popução da DIV
function paginar() {
    //limpando a variavel que vai receber o HTML 
    htmlCardPDestaque = '';
    //Limpando a DIV que vai receber os produtos
    $('#divProdutoDestaque').empty();

    for (var i = pagina * tamanhoPagina; i < result.length && i < (pagina + 1) * tamanhoPagina; i++) {
        //Armazenando os produtos na variavel
        htmlCardPDestaque += '<div class="col-sm-4"><div class="product-image-wrapper"><div class="single-products"><div class="productinfo text-center"> <img class="cardProduto" src="https://dev.loja.avantz.com.br/images/imagensProdutos/' + result[i].nome_arquivo + '" alt="" ><h2>' + result[i].id + '</h2><p>Easy Polo Black Edition</p> <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a></div><div class="product-overlay"><div class="overlay-content"><h2>$56</h2><p>Easy Polo Black Edition</p> <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a></div></div></div></div></div>';

    }
    //Populando a DIV
    $("#divProdutoDestaque").html(htmlCardPDestaque);
    //Exibir a quantidade de pagina e onde o mesmo se encontra
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

//****************************************************************************//

function addKeyupEvent(element) {
    element.keyup(function (e) {
        var keyword = $(this).val();
        clearTimeout($.data(this, 'timer'));

        if (e.keyCode == 13)
            updateListData(search(keyword, true));
        else
            $(this).data('timer', setTimeout(function () {
                updateListData(search(keyword));
            }, 500));
    });
}

function search(keyword, force) {
    if (!force && keyword.length < 4)
        return '';

    if (cache.hasOwnProperty(keyword))
        return cache[keyword];

    $.ajax({
        type: 'POST',
        url: "/inicial/filtro/produto/pesquisa",
        async: false,
        data: {
            textProduto: keyword,
            idCategoriaorSub: idCategoriaorSub
        },
        success: function (data) {
            cache[keyword] = data;
            return data;
        },
        error: function () {
            throw new Error('Error occured');
        }
    });
}

function updateListData(data) {
    $('#listafornecedores').html(data);
}